<?php
/**
 * Plugin Name:       Extensions for Leaflet Map Github
 * Plugin URI:        https://github.com/hupe13/extensions-leaflet-map-github
 * GitHub Plugin URI: https://github.com/hupe13/extensions-leaflet-map-github
 * Primary Branch:    main
 * Description:       Extensions for the WordPress plugin Leaflet Map Github Version
 * Version:           3.4.4-230503
 * Requires PHP:      7.4
 * Author:      hupe13
 * License:     GPL v2 or later
 * Text Domain: extensions-leaflet-map
**/

// Direktzugriff auf diese Datei verhindern:
defined( 'ABSPATH' ) or die();

define('LEAFEXT_PLUGIN_FILE', __FILE__); // /pfad/wp-content/plugins/extensions-leaflet-map/extensions-leaflet-map.php
define('LEAFEXT_PLUGIN_DIR', plugin_dir_path(__FILE__)); // /pfad/wp-content/plugins/extensions-leaflet-map-github/
define('LEAFEXT_PLUGIN_URL', WP_PLUGIN_URL . '/' . basename (LEAFEXT_PLUGIN_DIR)); // https://url/wp-content/plugins/extensions-leaflet-map-github/
define('LEAFEXT_PLUGIN_PICTS', LEAFEXT_PLUGIN_URL . '/pict/'); // https://url/wp-content/plugins/extensions-leaflet-map-github/pict/
define('LEAFEXT_PLUGIN_SETTINGS', dirname( plugin_basename( __FILE__ ) ) ); // extensions-leaflet-map

function leafext_plugin_init() {
  if (is_admin()) {
    if ( ! defined('LEAFLET_MAP__PLUGIN_DIR') ) {
      function leafext_require_leaflet_map_plugin(){
        echo '<div class="notice notice-error" ><p> '
        .sprintf(__('Please install and activate %s before using %s.','extensions-leaflet-map'),
        '<a href="https://wordpress.org/plugins/leaflet-map/">Leaflet Map</a>',
        'Extensions for Leaflet Map').
        '</p></div>';
      }
      add_action('admin_notices','leafext_require_leaflet_map_plugin');
      //register_activation_hook(__FILE__, 'leafext_require_leaflet_map_plugin');
    }
  }
}
add_action( 'plugins_loaded', 'leafext_plugin_init' );

if (is_admin()) include_once LEAFEXT_PLUGIN_DIR . 'admin.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/enqueue-leafletplugins.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/functions.php';
include_once LEAFEXT_PLUGIN_DIR . '/pkg/JShrink/Minifier.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/elevation.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/sgpx.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/multielevation.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/fullscreen.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/gesture.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/hover.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/markercluster.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/placementstrategies.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/clustergroup.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/featuregroup.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/extramarker.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/geojsonmarker.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/hidemarkers.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/choropleth.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/zoomhome.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/tileserver.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/leaflet-search.php';

include_once LEAFEXT_PLUGIN_DIR . '/php/leaflet-directory.php';
include_once LEAFEXT_PLUGIN_DIR . '/php/managefiles.php';

// Add settings to plugin page
function leafext_add_action_links ( $actions ) {
  $actions[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page='.LEAFEXT_PLUGIN_SETTINGS) ) .'">'. esc_html__( "Settings").'</a>';
  return $actions;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'leafext_add_action_links' );

// for translating a plugin
function leafext_extra_textdomain() {
  if (get_locale() == 'sv_SE') {
    load_plugin_textdomain('extensions-leaflet-map', false, LEAFEXT_PLUGIN_SETTINGS . '/lang/');
  }
}
add_action( 'plugins_loaded', 'leafext_extra_textdomain' );
