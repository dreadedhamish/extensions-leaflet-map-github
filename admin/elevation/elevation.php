<?php
/**
 * Admin for Leaflet.elevation
 * extensions-leaflet-map
 */
// Direktzugriff auf diese Datei verhindern:
defined( 'ABSPATH' ) or die();

function leafext_eleparams_init(){
	register_setting( 'leafext_settings_eleparams', 'leafext_eleparams', 'leafext_validate_ele_options' );
	$ele_settings = array('chartlook','chart','info','look','points','other');
	foreach ( $ele_settings as $ele_setting ) {
		add_settings_section( 'eleparams_settings_'.$ele_setting, '', 'leafext_ele_help_'.$ele_setting, 'leafext_settings_eleparams' );
		$fields = leafext_elevation_params(array($ele_setting));
		foreach($fields as $field) {
			add_settings_field("leafext_eleparams[".$field['param']."]", $field['shortdesc'], 'leafext_form_elevation','leafext_settings_eleparams', 'eleparams_settings_'.$ele_setting, $field['param']);
		}
	}
}
add_action('admin_init', 'leafext_eleparams_init' );

// Baue Abfrage der Params
function leafext_form_elevation($field) {
	//var_dump($field);
	$options = leafext_elevation_params(array("changeable"));
	//var_dump($options);
	$option = leafext_array_find2($field, $options);
	//var_dump($option);echo '<br>';
	$settings = leafext_elevation_settings(array("changeable"));
	$setting = $settings[$field];
	$name_id = "leafext_eleparams[".$option['param']."]";

	if ( $option['desc'] != "" ) echo '<p>'.$option['desc'].'</p>';

	echo __("You can change it for each map with", "extensions-leaflet-map").' <code>'.$option['param']. '</code><br>';

	//var_dump(gettype($option['values']));
	switch(gettype($option['values'])) {
		case "string":   //z.B. Height
		if ($setting != $option['default'] ) {
			echo __("Plugins Default:", "extensions-leaflet-map").' '. $option['default'] . '<br>';
		}
		echo '<input name="'.$name_id.'" placeholder="'.$setting.'" '.$option['values'].'/>';
		break;
		case "integer": // true/false
		if ($setting != $option['default'] ) {
			//var_dump($setting,$option['default']);
			echo __("Plugins Default", "extensions-leaflet-map").': ';
			echo $option['default'] ? "true" : "false";
			echo '<br>';
		}
		echo '<input type="radio" name="'.$name_id.'" value="1" ';
		echo $setting ? 'checked' : '' ;
		echo '> true &nbsp;&nbsp; ';
		echo '<input type="radio" name="'.$name_id.'" value="0" ';
		echo (!$setting) ? 'checked' : '' ;
		echo '> false ';
		break;
		case "array":  // array of Values
		$plugindefault = is_string($option['default']) ? $option['default'] : ($option['default'] ? "1" : "0");
		$setting = is_string($setting) ? $setting : ($setting ? "1" : "0");
		if ($setting != $plugindefault ) {
			echo __("Plugins Default:", "extensions-leaflet-map").' '. $plugindefault . '<br>';
		}
		echo '<select name="'.$name_id.'">';
		foreach ( $option['values'] as $para) {
			echo '<option ';
			if (is_bool($para)) $para = ($para ? "1" : "0");
			if ($para === $setting) echo ' selected="selected" ';
			echo 'value="'.$para.'">'.$para.'</option>';
		}
		echo '</select>';
		break;
		default:
		var_dump(gettype($option['values']));
		wp_die();
	}
	echo "\n";
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function leafext_validate_ele_options($options) {
	//var_dump($options);
	if (isset($_POST['submit'])) {
		if ($options['height'] == "") return false;
		$defaults=array();
		$params = leafext_elevation_params(array('changeable'));
		foreach($params as $param) {
			$defaults[$param['param']] = $param['default'];
		}
		$params = get_option('leafext_eleparams', $defaults);
		foreach ($options as $key => $value) {
			$params[$key] = $value;
		}
		return $params;
	}
	if (isset($_POST['delete'])) delete_option('leafext_eleparams');
	return false;
}

// Helptext
function leafext_ele_help_text () {
	leafext_enqueue_elevation_css ();
	leafext_enqueue_awesome();
	$text = "";
	$text = $text.'<p><img src="'.LEAFEXT_PLUGIN_PICTS.'elevation.png" alt="elevation"></p>
	<h2>'.__('Note','extensions-leaflet-map').'</h2>';
	$text = $text.sprintf(
				__(
				'If you want to display a track only, use %s functions. If you want to display a track with an elevation profile use %s.',"extensions-leaflet-map"),
				"<code>[leaflet-...]</code>",
				"<code>[elevation]</code>");
	$text = $text." ";
	$text = $text.sprintf(
				__(
				'The %s parameter is called %s, but it works with gpx, kml, geojson and tcx files.',"extensions-leaflet-map"),
				"<code>[elevation]</code>",
				"<code>gpx</code>");
	$text = $text."<p>";
	$text = $text.__('The elevation shortcode has many configuration options. Some things are not trivial. If you can\'t configure something, ask in the forum.',"extensions-leaflet-map");
	$text = $text."</p>";
	$text = $text.'<h2>Shortcode</h2>
	<pre><code>[leaflet-map ....]
[elevation gpx="url_gpx_file" option1=value1 option2 !option3 ...]</code></pre>
	<h3>'.__('Options', "extensions-leaflet-map").'</h3>
	<p>';
	$text = $text.__('For boolean values applies', "extensions-leaflet-map").':<br>';
	$text = $text.'<code>false</code> = <code>!parameter</code> || <code>parameter="0"</code> || <code>parameter=0</code><br>';
	$text = $text.'<code>true</code> = <code>parameter</code> || <code>parameter="1"</code> || <code>parameter=1</code>';
	$text = $text.'</p>';

	if (is_singular() || is_archive() ) {
		return $text;
	} else {
		echo $text;
		echo '<h2>'.__('Detailed documentation and examples',"extensions-leaflet-map").'</h2>';
		echo '<p>'.sprintf(
			__('in %sGerman%s and %sEnglish%s',
				"extensions-leaflet-map"),
				'<a href="https://leafext.de/elevation/">',
				'</a>',
				'<a href="https://leafext.de/en/elevation/">',
				'</a>');
		echo '</p>';
		echo '<div style="border-top: 3px solid #646970"></div>';
	}
}

function leafext_ele_help_look () {
	echo '<div style="border-top: 3px solid #646970"></div>';
	echo '<h3>';
	echo __('Appearance','extensions-leaflet-map');
	echo '</h3>';
}

function leafext_ele_help_points () {
	echo '<div style="border-top: 3px solid #646970"></div>';
	echo '<h3>';
	echo __('Markers and Waypoints','extensions-leaflet-map');
	echo '</h3>';
}

function leafext_ele_help_info () {
	echo '<div style="border-top: 3px solid #646970"></div>';
	echo '<h3>';
	echo __('Distance and time','extensions-leaflet-map');
	echo '</h3>';
}

function leafext_ele_help_chartlook () {
	echo '<h3>';
	leafext_ele_help_text ();
	echo '</h3>';
	//echo '<div style="border-top: 3px solid #646970"></div>';
	echo '<h3>';
	echo __('Information display','extensions-leaflet-map');
	echo '</h3>';
}

function leafext_ele_help_chart () {
	echo '<div style="border-top: 3px solid #646970"></div>';
	echo '<h3>';
	echo __('Charts','extensions-leaflet-map');
	echo '</h3>';
	$options = leafext_elevation_settings(array("changeable"));
	$summary = $options['summary'];
	$span_off='</span>';
	$sum_on    = ($options['summary'] == "0")              ? '<span style="color: #c3c4c7">' : "";
	$leg_on    = ($options['legend']  == "0")              ? '<span style="color: #c3c4c7">' : "";
	$marker_on = ($options['marker']  != "elevation-line") ? '<span style="color: #c3c4c7">' : "";
	echo '
	<figure class="wp-block-table aligncenter is-style-stripes">
	<table class="form-table" border="1" >
	<thead>
	<tr class="alternate">
	<th style="text-align:center">'.__('Setting','extensions-leaflet-map').'</th>
	<th style="text-align:center" colspan="2">'.__('Display diagram','extensions-leaflet-map').'</th>
	<th style="text-align:center">'.__('Axis display','extensions-leaflet-map').'</th>
	<th style="text-align:center">'.$marker_on.__('Tooltip display','extensions-leaflet-map').$span_off.'</th>
	<th style="text-align:center">'.$sum_on.__('Summary','extensions-leaflet-map').$span_off.'</th>
	</tr></thead>
	<tbody>
	<tr>
	<td style="text-align:center"> </td>
	<td style="text-align:center">';
	if ( $leg_on != "" ) echo __('Your setting:','extensions-leaflet-map').'<br>';
	echo '<code>legend="0"</code></td>
	<td style="text-align:center">';
	if ( $leg_on == "" ) echo __('Your setting:','extensions-leaflet-map').'<br>';
	echo '<code>legend="1"</code></td>
	<td style="text-align:center"><img src="'.LEAFEXT_PLUGIN_PICTS.'yachse.png" alt="yachse"></td>
	<td style="text-align:center">';
	if ( $marker_on != "" ) echo __('Your setting:','extensions-leaflet-map').'<br><code>marker="'.$options['marker'].'"</code><br>';
	echo $marker_on.'<code>marker="elevation-line"</code>'.$span_off.'<br>
	<img src="'.LEAFEXT_PLUGIN_PICTS.'tooltip_values.png" alt="tooltip_values">
	<img src="'.LEAFEXT_PLUGIN_PICTS.'marker_values.png" alt="marker_values"></td>
	<td style="text-align:center">'.__('Your setting:','extensions-leaflet-map').'<br><code>summary="'.$options['summary'].'"</code></td>
	</tr>
	<tr class="alternate">
	<td style="text-align:center">1</td>
	<td style="text-align:center">'.__('yes','extensions-leaflet-map').'</td>
	<td style="text-align:center">'.__('yes','extensions-leaflet-map').'<br>
	<img src="'.LEAFEXT_PLUGIN_PICTS.'on_speed.png" alt="on_speed"></td>
	<td style="text-align:center">'.__('yes','extensions-leaflet-map').'</td>
	<td style="text-align:center">'.$marker_on.__('yes','extensions-leaflet-map').$span_off.'</td>
	<td style="text-align:center">'.$sum_on.__('yes','extensions-leaflet-map').$span_off.'</td>
	</tr>
	<tr>
	<td style="text-align:center">summary</td>
	<td style="text-align:center" colspan="2">'.__('no','extensions-leaflet-map').' </td>
	<td style="text-align:center">'.__('no','extensions-leaflet-map').'</td>
	<td style="text-align:center">'.$marker_on.__('yes','extensions-leaflet-map').$span_off.'</td>
	<td style="text-align:center">'.$sum_on.__('yes','extensions-leaflet-map').$span_off.'</td>
	</tr>
	<tr  class="alternate">
	<td style="text-align:center">disabled</td>
	<td style="text-align:center">'.__('no','extensions-leaflet-map').'</td>
	<td style="text-align:center">'.$leg_on.__('hidden','extensions-leaflet-map').$span_off.' <br>
	<img src="'.LEAFEXT_PLUGIN_PICTS.'off_speed.png" alt="off_speed"></td>

	<td style="text-align:center">'.__('yes','extensions-leaflet-map').'</td>
	<td style="text-align:center">'.$marker_on.__('yes','extensions-leaflet-map').$span_off.'</td>
	<td style="text-align:center">'.$sum_on.__('yes','extensions-leaflet-map').$span_off.'</td>
	</tr>
	<tr>
	<td style="text-align:center">0</td>
	<td style="text-align:center" colspan="2">'.__('no','extensions-leaflet-map').'</td>
	<td style="text-align:center">'.__('no','extensions-leaflet-map').'</td>
	<td style="text-align:center">'.$marker_on.__('no','extensions-leaflet-map').$span_off.'</td>
	<td style="text-align:center">'.$sum_on.__('no','extensions-leaflet-map').$span_off.'</td>
	</tr></tbody></table></figure>
	';
	echo '</p>';
}

function leafext_ele_help_other () {
	echo '<div style="border-top: 3px solid #646970"></div>';
	echo '<h3>';
	echo __('Others','extensions-leaflet-map');
	echo '</h3>';
}
