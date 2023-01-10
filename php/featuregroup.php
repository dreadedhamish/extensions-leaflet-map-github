<?php
/**
 * Functions for 	Leaflet.FeatureGroup.SubGroup featureSubgroup shortcode
 * extensions-leaflet-map
 */
// Direktzugriff auf diese Datei verhindern:
defined( 'ABSPATH' ) or die();

//Shortcode: [featureSubgroup]
function leafext_featuregroup_script($options,$params){
	$text = '
	<script>
		window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
		window.WPLeafletMapPlugin.push(function () {
			let att_property = '.json_encode($options['property']).';
			let att_option = '.json_encode($options['option']).';
			let groups  = '.json_encode($options['groups']).';
			let visible = '.json_encode($options['visible']).';
			let substr = '.json_encode($options['substr']).';
			let	alle = new L.markerClusterGroup({';
					$text=$text.leafext_java_params ($params);
					$text = $text.'
				});
			';
			$text = $text.file_get_contents(LEAFEXT_PLUGIN_URL.'/js/featuregroup.js');
		$text = $text.'
		});
		</script>';
		//$text = \JShrink\Minifier::minify($text);
		return "\n".$text."\n";
}

function leafext_featuregroup_function( $atts, $content, $shortcode){
	if (is_singular() || is_archive()) {
		//var_dump($atts); wp_die();
		leafext_enqueue_markercluster ();
		leafext_enqueue_clustergroup ();
		$options = shortcode_atts(
			array(
				'property' => '',
				'option' => '',
				'values' => '',
				'groups' => '',
				'substr' => $shortcode == "leaflet-featuregroup" ? false : true,
				'visible' => false,
			), leafext_clear_params($atts)
		);

		if (($options['values'] == '' || $options['groups'] == '')) {
			$text = "['.$shortcode.' ";
			foreach ($atts as $key=>$item){
				$text = $text. "$key=$item ";
			}
			$text = $text. "]";
			$text = $text." - no values and/or groups. ";
			return $text;
		}

		if ($options['property'] == '' && $options['option'] == '') {
			$text = "['.$shortcode.' ";
			foreach ($atts as $key=>$item){
				$text = $text. "$key=$item ";
			}
			$text = $text. "]";
			if ($shortcode == "leaflet-featuregroup") {
				$missing = "property";
			} else {
				$missing = "option";
			}
			$text = $text." - ".$missing." is missing.";
			return $text;
		}

		$cl_values= array_map('trim', explode( ',', $options['values'] ));
		$cl_groups = array_map('trim', explode( ',', $options['groups'] ));

		if ($options['visible'] === false) {
			$options['visible'] = array_fill(0, count($cl_values), '1');
			$cl_on = array_fill(0, count($cl_values), '1');
		} else {
			$cl_on = array_map('trim', explode( ',', $options['visible'] ));
			if (count($cl_on) == 1) {
				$cl_on = array_fill(0, count($cl_values), '0');
			}
		}

		if ( count($cl_values) != count($cl_groups) && count($cl_values) != count($cl_on) ) {
			$text = "['.$shortcode.' ";
			foreach ($atts as $key=>$item){
				$text = $text. "$key=$item ";
			}
			$text = $text. "]";
			$text = $text." - values and groups (and visible) do not match. ";
			return $text;
		}

		$options = array(
			'property' => sanitize_text_field($options['property']),
			'option' => sanitize_text_field($options['option']),
			'values' => sanitize_text_field($options['values']),
			'groups'  => array_combine($cl_values, $cl_groups),
			'substr' => (bool)$options['substr'],
			'visible' => array_combine($cl_values, $cl_on),
		);

		$clusteroptions = leafext_cluster_atts ($atts);
		return leafext_featuregroup_script($options,$clusteroptions);
	} else {
		$text = "['.$shortcode.' ";
		foreach ($atts as $key=>$item){
			$text = $text. "$key=$item ";
		}
		$text = $text. "]";
		return $text;
	}
}
add_shortcode('leaflet-featuregroup', 'leafext_featuregroup_function');
add_shortcode('leaflet-optiongroup', 'leafext_featuregroup_function');
