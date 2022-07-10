<?php
// Direktzugriff auf diese Datei verhindern:
defined( 'ABSPATH' ) or die();

function leafext_color_name_to_hex($color_name) {
  $colors  =  array(
    'blue'=>'0000FF',
    'green'=>'008000',
    'orange'=>'FFA500',
    'red'=>'FF0000',
    'yellow'=>'FFFF00',
  );
  //
  $color_name = strtolower($color_name);
  if (isset($colors[$color_name])) {
    return ('#' . $colors[$color_name]);
  } else {
    return ($color_name);
  }
}

//Shortcode: [leaflet_dir dir=...]

function leafext_directory_function($atts) {
  $defaults = array (
    'src' => "",
    'url' => "",
    'type' => "gpx",
    'start' => false,
    'cmd' => "track", //leaflet, track
  );
  $options = shortcode_atts($defaults, leafext_clear_params($atts));
  //var_dump($options);

  if ( $options['src'] == "" ) {
    $options['src'] = '...missing...';
    $text = '[leaflet_dir ';
    foreach ($options as $key=>$item){
      $text = $text. $key.'="'.$item.'" ';
    }
    $text = $text. "]";
    return $text;
  }
  $dir = $atts['src'];

  $upload_dir = wp_get_upload_dir();
  $upload_path = $upload_dir['path'];
  $upload_url = $upload_dir['url'];
  if ($options['url'] == "") {
    $url = $upload_url;
  } else {
    $url = $options['url'];
  }

  if (!is_dir($dir) && !is_dir($upload_path.'/'.$dir)) {
    $text = '[leaflet_dir ';
    $options['src'] = '...not exists... '.$options['src'];
    foreach ($options as $key=>$item){
      $text = $text. $key.'="'.$item.'" ';
    }
    $text = $text. "]";
    return $text;
  }

  if (!is_dir($dir)) {
    $dirpath = $upload_path;
  } else {
    $dirpath = "";
  }

  if ( $options['cmd'] == "track") {
    $type = "gpx";
  } else {
    $valid = array_diff(explode(",",$options['type']), array ("gpx","kml","geojson","json"));
    if (count($valid) > 0) {
      $options['type'] = '...not valid... '.$options['type'];
      $text = '[leaflet_dir ';
      foreach ($options as $key=>$item){
        $text = $text. $key.'="'.$item.'" ';
      }
      $text = $text. "]";
      return $text;
    } else {
      $type = $options['type'];
    }
  }

  //var_dump($dirpath.$dir."/*".$options['type']);
  $files = glob($dirpath.$dir.'/*.{'.$type.'}', GLOB_BRACE);
  if (count($files) == 0) {
    $options['type'] = '...not found any... '.$options['type'];
    $text = '[leaflet_dir ';
    foreach ($options as $key=>$item){
      $text = $text. $key.'="'.$item.'" ';
    }
    $text = $text. "]";
    return $text;
  }

  if ( $options['cmd'] == "leaflet") {
    $farben=array("green","red","blue","yellow","orange");
    $count=1;
    $shortcode='';

    foreach ( $files as $file) {
      $farbe=leafext_color_name_to_hex($farben[$count % count($farben)]);
      $count=$count+1;
      if ($dirpath != "" ) $file = str_replace($dirpath.'/',"",$file);
      $ext = pathinfo($file, PATHINFO_EXTENSION);
      if ($ext == "json") $ext = "geojson";
      if (!in_array($ext,array ("gpx","kml","geojson"))) {
        $text = '[leaflet_dir ... ';
        $text = $text . $ext.' not valid ... ';
        foreach ($options as $key=>$item){
          $text = $text. $key.'="'.$item.'" ';
        }
        $text = $text. "]";
        return $text;
      }
      $shortcode = $shortcode.'[leaflet-'.$ext.' src="'.$url.'/'.$file.'" color="'.$farbe.'"]{name}[/leaflet-'.$ext.']';
    }
    $shortcode = $shortcode.'[hidemarkers]';
    if ( $options['start'] ) {
      foreach ( $files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) == "gpx") {
          $gpx = simplexml_load_file($file);
          $trackname = isset($gpx->trk->name) ? $gpx->trk->name : basename($file) ;
          $startlat =  isset($gpx->trk->trkseg->trkpt[0]->attributes()->lat) ? (float)$gpx->trk->trkseg->trkpt[0]->attributes()->lat : "";
          $startlon =  isset($gpx->trk->trkseg->trkpt[0]->attributes()->lon) ? (float)$gpx->trk->trkseg->trkpt[0]->attributes()->lon : "";
          if ( $startlat != "" && $startlon != "" ) {
            $shortcode = $shortcode.'[leaflet-marker lat='.$startlat.' lng='.$startlon.']'.$trackname.'[/leaflet-marker]';
          }
        }
      }
      $shortcode = $shortcode.'[cluster]';
    }
    $text=do_shortcode($shortcode);
    //$text=$shortcode;
    return $text;
  } else {
    //[elevation-track file="..." ]
    $shortcode='';
    foreach ( $files as $file) {
      if ($dirpath != "" ) $file = str_replace($dirpath.'/',"",$file);
      $shortcode = $shortcode.'[elevation-track file="'.$url.'/'.$file.'"]';
    }
    $text=do_shortcode($shortcode);
    //$text = $shortcode;
    return $text;
  }
}
add_shortcode('leaflet-dir', 'leafext_directory_function' );
