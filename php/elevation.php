<?php
/**
 * Functions for elevation shortcode
 * extensions-leaflet-map
 */
// Direktzugriff auf diese Datei verhindern:
defined( 'ABSPATH' ) or die();

//Parameter and Values
function leafext_elevation_params() {
	$params = array(

// Aussehen

		// Default chart colors: theme lime-theme, magenta-theme, ...
		//theme: "lightblue-theme",
		array(
			'param' => 'theme',
			'shortdesc' => __('Theme Colors',"extensions-leaflet-map"),
			'desc' => '<p>
				lime - <img src="'.LEAFEXT_ELEVATION_URL.'/images/elevation-lime.svg" alt="lime" /> /
				steelblue - <img width=26px height=26px src="'.LEAFEXT_ELEVATION_URL.'/images/elevation-steelblue.svg" alt="steelblue" /> /
				purple - <img src="'.LEAFEXT_ELEVATION_URL.'/images/elevation-purple.svg" alt="purple" /> /
				yellow - <img src="'.LEAFEXT_PLUGIN_PICTS.'/elevation-yellow.svg" alt="yellow" /> /
				red - <img src="'.LEAFEXT_PLUGIN_PICTS.'/elevation-red.svg" alt="red" /> /
				magenta - <img src="'.LEAFEXT_PLUGIN_PICTS.'/elevation-magenta.svg" alt="magenta" /> /
				lightblue - <img src="'.LEAFEXT_PLUGIN_PICTS.'/elevation-lightblue.svg" alt="lightblue" />
				</p>',
			'default' => "lime-theme",
			'values' => array("lime-theme","steelblue-theme","purple-theme","yellow-theme","red-theme","magenta-theme","lightblue-theme"),
			'next' => "3",
			'multielevation' => true,
		),

		//Default hupe13 polyline: { weight: 3, }, Default Raruto 5
		array(
			'param' => 'polyline',
			'shortdesc' => __('Polyline weight',"extensions-leaflet-map"),
			'desc' => '',
			'default' => "{ weight: 3, }",
			'values' => array("{ weight: 3, }","{ weight: 4, }","{ weight: 5, }","{ weight: 6, }"),
			'multielevation' => false,
		),

		// https://github.com/Raruto/leaflet-elevation/issues/86#issuecomment-735274347
		// marker: "elevation-line" || "position-marker" || false
		array(
			'param' => 'marker',
			'shortdesc' => __('position/height indicator marker drawn onto the map',"extensions-leaflet-map"),
			'desc' => '<p>elevation-line <img src="'.LEAFEXT_PLUGIN_PICTS.'vert-line.svg" alt="line" align="middle"/> / position-marker
				<img src="'.LEAFEXT_ELEVATION_URL.'/images/elevation-position.svg" alt="elevation-position" align="middle"/> / '.__('nothing',"extensions-leaflet-map").' </p>',
			'default' => 'elevation-line',
			'values' => array("elevation-line", "position-marker",false),
			'multielevation' => true,
		),

		// Display track waypoints: true || "markers" || "dots" || false
		// plugins default true
		array(
			'param' => 'waypoints',
			'shortdesc' => __('Display track waypoints',"extensions-leaflet-map"),
			'desc' => __('Display waypoints in map and in chart / only in map / only in chart / none',"extensions-leaflet-map"),
			'default' => true,
			'values' => array (true, "markers", "dots", false),
			'multielevation' => false,
		),

		// Toggle waypoint labels: true || "markers" || "dots" || false
	 	//wptLabels: true,
		array(
			'param' => 'wptLabels',
			'shortdesc' => __('Toggle waypoint labels',"extensions-leaflet-map"),
			'desc' => '<p>'.__('Show waypoint labels in map and in chart / only in map / only in chart / none',"extensions-leaflet-map").'</p>
			<p>'.sprintf(__('Only meaningful, if %swaypoints%s is not %s.',"extensions-leaflet-map"),'<code>','</code>','<code>0</code>').'</p>',
			'default' => true,
			'values' => array (true, "markers", "dots", false),
			'multielevation' => false,
		),

		// // Toggle custom waypoint icons: true || { associative array of <sym> tags } || false
		// wptIcons: {
		// 	'': L.divIcon({
		// 		className: 'elevation-waypoint-marker',
		// 		html: '<i class="elevation-waypoint-icon"></i>',
		// 		iconSize: [30, 30],
		// 		iconAnchor: [8, 30],
		// 		}),
		// 		},
		array(
			'param' => 'wptIcons',
			'shortdesc' => __('Toggle custom waypoint icons',"extensions-leaflet-map"),
			'desc' => '<p>'.'true / "defined" / false'.'</p>
				<p>'.__('Only meaningful, if waypoints are shown in the map.',"extensions-leaflet-map").'</p>
				<p>'.sprintf (__('If %s is selected, you must define some %ssettings for the icons',"extensions-leaflet-map"),
					'"defined"',
					'<a href="?page='.LEAFEXT_PLUGIN_SETTINGS.'&tab=elevationwaypoints">').'</a>.'
				.'</p>',
			'default' => true,
			'values' => array (true, "defined", false),
			'multielevation' => true,
		),

		// Toggle "leaflet-distance-markers" integration
		//distanceMarkers: false,
		array(
			'param' => 'distanceMarkers',
			'shortdesc' => __('Toggle "leaflet-distance-markers" integration',"extensions-leaflet-map"),
			'desc' => '',
			'default' => false,
			'values' => 1,
			'multielevation' => true,
		),

// Zusaetze

		// Download link: "link" || false || "modal"
		array(
			'param' => 'downloadLink',
			'shortdesc' => __('Download Link',"extensions-leaflet-map"),
			'desc' => '',
			'default' => false,
			'values' => array("link", false, "modal"),
			'multielevation' => false,
		),

//Welche Infos?

		// Summary track info style: "inline" || "multiline" || false
		// hupe13: true historical
		array(
			'param' => 'summary',
			'shortdesc' => __('Summary track info style',"extensions-leaflet-map"),
			'desc' => '<p>'.
				__('some predefined settings / summary on one line / summary on multiple lines / without summary',"extensions-leaflet-map").
				'</p><p>'.
				__('If it is disabled, settings for summary below are without function.',"extensions-leaflet-map").'</p>',
			'default' => 'multiline',
			'values' => array(true, "inline","multiline",false),
			'next' => "3",
			'multielevation' => true,
		),

		// Toggle chart legend filter.
		//legend: true,
		array(
			'param' => 'legend',
			'shortdesc' => __('Toggle chart legend filter.',"extensions-leaflet-map"),
			'desc' => '<img src="'.LEAFEXT_PLUGIN_PICTS.'on.png" alt="on"/>
				<p>'.
				__('If it is disabled, you can\'t toggle the initial state of graphs.',"extensions-leaflet-map").'</p>',
			'default' => true,
			'values' => 1,
			'multielevation' => true,
		),

// Graphen

		// Display altitude info: true || "summary"
		//altitude: true,
		array(
			'param' => 'altitude',
			'shortdesc' => __('Display altitude graph',"extensions-leaflet-map"),
			'desc' => '<p>'.
				__('graph initial state displayed and data in summary / data in summary only / graph initial state hidden and data in summary',"extensions-leaflet-map").'</p>',
			'default' => true,
			//'values' => array(true,"summary"),
			'values' => array(true,"summary","disabled"),
			'next' => "1",
			'multielevation' => true,
		),

		// Acceleration chart profile: true || "summary" || "disabled" || false
		//acceleration: false,
		array(
			'param' => 'acceleration',
			'shortdesc' => __('Acceleration chart profile',"extensions-leaflet-map"),
			'desc' => '<p>'.__('graph initial state displayed and data in summary / data in summary only / graph initial state hidden and data in summary / nothing',"extensions-leaflet-map").'</p>',
			'default' => false,
			'values' => array(true,"summary","disabled",false),
			'multielevation' => true,
		),

		// Slope chart profile: true || "summary" || "disabled" || false
		//slope: false,
		array(
			'param' => 'slope',
			'shortdesc' => __('Slope chart profile',"extensions-leaflet-map"),
			'desc' => '<p>'.
				__('graph initial state displayed and data in summary / data in summary only / graph initial state hidden and data in summary / nothing',"extensions-leaflet-map").'</p>',
			'default' => false,
			'values' => array(true,"summary","disabled",false),
			'multielevation' => true,
		),

		// Speed chart profile: true || "summary" || "disabled" || false
		//speed: false,
		array(
			'param' => 'speed',
			'shortdesc' => __('Speed chart profile',"extensions-leaflet-map"),
			'desc' => '<p>'.
				__('graph initial state displayed and data in summary / data in summary only / graph initial state hidden and data in summary / nothing',"extensions-leaflet-map").'</p>',
			'default' => false,
			'values' => array(true,"summary","disabled",false),
			'multielevation' => true,
		),

// Informationen

		// Display time info: true || "summary" || false
		//time: false,
		array(
			'param' => 'time',
			'shortdesc' => __('Display time info',"extensions-leaflet-map"),
			'desc' => '<p>'.
				__('show time data in graph and summary / show time data in summary only / nothing',"extensions-leaflet-map").'</p>',
			'default' => false,
			'values' => array(true,"summary",false),
			'next' => "1",
			'multielevation' => true,
		),

		// Display distance info: true || "summary"
		//distance: true,
		array(
			'param' => 'distance',
			'shortdesc' => __('Display distance info',"extensions-leaflet-map"),
			'desc' => '<p>'.
				__('show distance data in graph and summary / show distance data in summary only',"extensions-leaflet-map").'</p>',
			'default' => true,
			'values' => array(true,"summary"),
			'multielevation' => true,
		),

//

		// Toggle chart. https://github.com/Raruto/leaflet-elevation/discussions/139
		//chart: true,
		array(
			'param' => 'chart',
			'shortdesc' => __('Toggle diagram and summary block',"extensions-leaflet-map"),
			'desc' => '<p>'.
				sprintf(__('show always the block / show the block and toggle %s to hide / hide the block and toggle %s to show',"extensions-leaflet-map"),"<i class=\"fa fa-area-chart\" aria-hidden=\"true\"></i>","<i class=\"fa fa-area-chart\" aria-hidden=\"true\"></i>").
				'</p>',
			'default' => true,
			'values' => array(true, "on", "off"),
			'multielevation' => false,
		),

// Verhalten u.a.

		// Autoupdate map center on chart mouseover.
		//followMarker: true,
		array(
			'param' => 'followMarker',
			'shortdesc' => __('Autoupdate map center on chart mouseover.',"extensions-leaflet-map"),
			'desc' => '',
			'default' => true,
			'values' => 1,
			'next' => "3",
			'multielevation' => true,
		),

		// Autoupdate map bounds on chart update.
		//autofitBounds: true,
		array(
			'param' => 'autofitBounds',
			'shortdesc' => __('Autoupdate map bounds on chart update.',"extensions-leaflet-map"),
			'desc' => '',
			'default' => true,
			'values' => 1,
			'multielevation' => true,
		),

		// Chart distance/elevation units.
		//imperial: false,
		array(
			'param' => 'imperial',
			'shortdesc' => __('Chart distance/elevation units.',"extensions-leaflet-map"),
			'desc' => __('miles or kilometers',"extensions-leaflet-map"),
			'default' => false,
			'values' => 1,
			'multielevation' => true,
		),

		// [Lat, Long] vs [Long, Lat] points. (leaflet default: [Lat, Long])
		//reverseCoords: false,
		array(
			'param' => 'reverseCoords',
			'shortdesc' => __('[Lat, Long] vs [Long, Lat] points. (leaflet default: [Lat, Long])',"extensions-leaflet-map"),
			'desc' => '',
			'default' => false,
			'values' => 1,
			'multielevation' => true,
		),

		//Toggle chart ruler filter.
		//ruler: true,
		// array(
		// 	'param' => 'ruler',
		// 	'shortdesc' => __('Toggle chart ruler filter.',"extensions-leaflet-map"),
		// 	'desc' => '',
		// 	'default' => true,
		// 	'values' => 1,
		// ),

		// Toggle "leaflet-almostover" integration
		//almostOver: true,
		// auskommentiert. true sollte nicht geaendert werden
		// array(
		// 	'param' => 'almostOver',
		// 	'shortdesc' => __('Toggle "leaflet-almostover" integration',"extensions-leaflet-map"),
		// 	'desc' => '',
		// 	'default' => true,
		// 	'values' => 1,
		// ),

		// Render chart profiles as Canvas or SVG Paths
		//preferCanvas: true
		array(
			'param' => 'preferCanvas',
			'shortdesc' => __('Render chart profiles as Canvas or SVG Paths.',"extensions-leaflet-map"),
			'desc' => sprintf ( __('Due to a bug in MacOS and iOS, see %shere%s, it is automatically set to false in Safari.',"extensions-leaflet-map"), '<a href="https://github.com/Raruto/leaflet-elevation/issues/123">','</a>'),
			'default' => true,
			'values' => 1,
			'multielevation' => false,
		),

		// Chart container outside/inside map container
		//detached: true,
		//array('detached', 'Chart container outside/inside map container', true, 1),

		// if (detached), the elevation chart container
		//elevationDiv: "#elevation-div",

		// if (!detached) autohide chart profile on chart mouseleave
		//autohide: false,
		//array('autohide', 'if (!detached) autohide chart profile on chart mouseleave', false, 1),

		// if (!detached) initial state of chart profile control
		//collapsed: false,
		//array('collapsed', 'if (!detached) initial state of chart profile control', false, 1),

		// if (!detached) control position on one of map corners
		//position: "topright",

	);
	return $params;
}

//Shortcode: [elevation gpx="...url..."]

function leafext_elevation_script($gpx,$theme,$settings,$chart){
	$text = '
	<script>
	window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
	window.WPLeafletMapPlugin.push(function () {
		var map = window.WPLeafletMapPlugin.getCurrentMap();
		var elevation_options = {
		//lime-theme (default), magenta-theme, steelblue-theme, purple-theme, yellow-theme, lightblue-theme
			theme: '.json_encode($theme).',
			almostOver: true,
		';
		//old settings
		if ( $settings['summary'] == "1" ) {
			$text = $text.'
				summary: "inline",
				slope: "summary",
				speed: false,
				acceleration: false,
				time: false,
				downloadLink: false,
				preferCanvas: false,
				legend: false,
				polyline: { weight: 3, },
				';
				//old settings end
		} else {
			foreach ($settings as $k => $v) {
				switch ($k) {
					case "polyline":
						$text = $text. "$k: ". $v .',';
						unset ($settings[$k]);
						break;
					case "wptIcons":
						if (strpos($v, '{') !== false){
							$text = $text. "$k: ". $v .',';
							unset ($settings[$k]);
						}
						break;
					case "distanceMarkers":
						if ($settings[$k] == true && $settings['imperial'] == "1") {
							$text = $text .
							'distanceMarkers: {
								offset: 1000/0.621371,
								textFunction: function(distance, i, offset) {
									return Math.round(distance*0.621371/1000);
								}
							},';
							unset($settings[$k]);
						}
						break;
					default:
				}
			}
			$text = $text.leafext_java_params ($settings);

		}//old settings end

	$text = $text.'	};
		var mylocale = {
			"Acceleration"	: "'._x("Acceleration", "In Frontend", "extensions-leaflet-map").'",
			"Altitude"		: "'._x("Altitude", "In Frontend", "extensions-leaflet-map").'",
			"Slope"			: "'._x("Slope", "In Frontend", "extensions-leaflet-map").'",
			"Speed"			: "'._x("Speed", "In Frontend", "extensions-leaflet-map").'",
			"Total Time: "			: "'._x("Total Time", "In Frontend", "extensions-leaflet-map").': ",
			"Total Length: "	: "'._x("Total Length", "In Frontend", "extensions-leaflet-map").': ",
			"Max Elevation: "	: "'._x("Max Elevation", "In Frontend", "extensions-leaflet-map").': ",
			"Min Elevation: "	: "'._x("Min Elevation", "In Frontend", "extensions-leaflet-map").': ",
			"Total Ascent: "	: "'._x("Total Ascent", "In Frontend", "extensions-leaflet-map").': ",
			"Total Descent: "	: "'._x("Total Descent", "In Frontend", "extensions-leaflet-map").': ",
			"Min Slope: "	: "'._x("Min Slope", "In Frontend", "extensions-leaflet-map").': ",
			"Max Slope: "	: "'._x("Max Slope", "In Frontend", "extensions-leaflet-map").': ",
			"Min Speed: "	: "'._x("Min Speed", "In Frontend", "extensions-leaflet-map").': ",
			"Max Speed: "	: "'._x("Max Speed", "In Frontend", "extensions-leaflet-map").': ",
			"Avg Speed: "	: "'._x("Avg Speed", "In Frontend", "extensions-leaflet-map").': ",
			"Min Acceleration: "	: "'._x("Min Acceleration", "In Frontend", "extensions-leaflet-map").': ",
			"Max Acceleration: "	: "'._x("Max Acceleration", "In Frontend", "extensions-leaflet-map").': ",
			"Avg Acceleration: "	: "'._x("Avg Acceleration", "In Frontend", "extensions-leaflet-map").': ",
			"Download" 	: "'._x("Download", "In Frontend", "extensions-leaflet-map").'",
			"Elevation" : "'._x("Elevation", "In Frontend", "extensions-leaflet-map").'",

			"a: " 			: "'._x("a", "In Frontend: Abbreviation for acceleration in the chart", "extensions-leaflet-map").': ",
			"cad: " 		: "'._x("cad", "In Frontend: Abbreviation for cadence in the chart", "extensions-leaflet-map").': ",
			"hr: " 		: "'._x("hr", "In Frontend: Abbreviation for heart rate in the chart", "extensions-leaflet-map").': ",
			"m: " 			: "'._x("m", "In Frontend: Abbreviation for slope in the chart", "extensions-leaflet-map").': ",
			"t: " 			: "'._x("t", "In Frontend: Abbreviation for time in the chart", "extensions-leaflet-map").': ",
			"T: " 			: "'._x("T", "In Frontend: Abbreviation for duration in the chart", "extensions-leaflet-map").': ",
			"v: " 			: "'._x("v", "In Frontend: Abbreviation for speed in the chart", "extensions-leaflet-map").': ",
			"x: " 			: "'._x("x", "In Frontend: Abbreviation for length in the chart", "extensions-leaflet-map").': ",
			"y: " 			: "'._x("y", "In Frontend: Abbreviation for altitude in the chart", "extensions-leaflet-map").': ",
		};
		L.registerLocale("wp", mylocale);
		L.setLocale("wp");

		// Instantiate elevation control.
		var controlElevation = L.control.elevation(elevation_options);
		var track_options= { url: "'.$gpx.'" };
		controlElevation.addTo(map);';

		$text = $text.'
		//
		var is_chrome = navigator.userAgent.indexOf("Chrome") > -1;
		var is_safari = navigator.userAgent.indexOf("Safari") > -1;
		if ( !is_chrome && is_safari && controlElevation.options.preferCanvas != false ) {
			console.log("is_safari - setting preferCanvas to false");
			controlElevation.options.preferCanvas = false;
		}
		//
		';

		if ($chart != "1") {
		$text=$text.'var controlButton = L.easyButton(
			"<i class=\"fa fa-area-chart\" aria-hidden=\"true\"></i>",
			function(btn, map) {
				controlElevation._toggle(); },
				"Elevation",
				{ position: "topright" }
				).addTo( map );';
		}

		$text=$text.'
		// Load track from url (allowed data types: "*.geojson", "*.gpx")
		controlElevation.load(track_options.url);';

		if ($chart != "1") {
		$text=$text.'map.on("eledata_added", function(e) {
			//console.log("eledata_added");
			//Ja 2x!!!
			controlElevation._toggle();';
			if ($chart == "off") {
				$text=$text.'
				controlElevation._toggle();';
			}
			$text=$text.'
		});';
		}
	$text=$text.'
	});
	</script>';
	$text = \JShrink\Minifier::minify($text);
	return "\n".$text."\n";
}

function leafext_elevation_settings() {
	$defaults=array();
	$params = leafext_elevation_params();
	foreach($params as $param) {
		$defaults[$param['param']] = $param['default'];
	}
	$options = shortcode_atts($defaults, get_option('leafext_eleparams'));
	return $options;
}

function leafext_elevation_theme() {
	$ownoptions = get_option('leafext_values');
	if (is_array($ownoptions)) {
		if ( $ownoptions['theme'] == 'other' ) {
			$theme = $ownoptions['othertheme'];
		} else {
			$theme=$ownoptions['theme'].'-theme';
		}
	} else {
		$newoptions=leafext_elevation_settings();
		$theme = $newoptions['theme'];
	}
	return($theme);
}

function leafext_elevation_function( $atts ) {
	if ( ! $atts['gpx'] ) {
		$text = "[elevation ";
		foreach ($atts as $key=>$item){
			$text = $text. "$key=$item ";
		}
		$text = $text. "]";
		return $text;
	}
	leafext_enqueue_elevation ();

	$atts1=leafext_case(array_keys(leafext_elevation_settings()),leafext_clear_params($atts));
	$options = shortcode_atts(leafext_elevation_settings(), $atts1);

	$track = $atts['gpx'];

	if ( array_key_exists('theme', $atts) ) {
		$theme = $atts['theme'];
	} else {
		$theme = leafext_elevation_theme();
	}
	unset($options['theme']);

	$chart = $options['chart'];
	if ( $chart != "1" ) {
		leafext_enqueue_easybutton();
	}
	unset($options['chart']);

	$wptIcons = $options['wptIcons'];
	if ( !is_bool($wptIcons) && $wptIcons == "defined" ) {
		unset($options['wptIcons']);
		$waypoints = get_option('leafext_waypoints', "");
		if ( $waypoints != "" && ( $options['waypoints'] == "markers" || $options['waypoints'] == "1" )) {
			$wptvalue="{";
			foreach ( $waypoints as $wpt ) {
				$wptvalue = $wptvalue.'"'.$wpt['css'].'":  L.divIcon({
					className: "elevation-waypoint-marker",
					html: '."'".'<i class="elevation-waypoint-icon '.$wpt['css'].'"></i>'."'".','.
					$wpt['js'].'}),';
			}
			$wptvalue = $wptvalue.'}';
			$options['wptIcons'] =  $wptvalue;
		}
	}

	return leafext_elevation_script($track,$theme,$options,$chart);
}
add_shortcode('elevation', 'leafext_elevation_function' );
