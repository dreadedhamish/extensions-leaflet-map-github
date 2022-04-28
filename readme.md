<a href="https://wordpress.org/plugins/extensions-leaflet-map/">Official WordPress Plugin</a>

# Extensions for Leaflet Map Github Version

Requires at least: 5.5.3  
Requires PHP: 7.4   
Tested up to: 5.9  
License: GPLv2 or later  
Tags: leaflet, gpx, elevation, markercluster, zoomhome, hover, fullscreen  
Contributors: hupe13  

Differences to the WordPress version: [Changes](changes.md)

## Description

Extends the WordPress Plugin <a href="https://wordpress.org/plugins/leaflet-map/">Leaflet Map</a> with Leaflet Plugins and other functions.

### Used Leaflet Plugins and Elements

*   [leaflet-elevation](https://github.com/Raruto/leaflet-elevation), [Leaflet.i18n](https://github.com/yohanboniface/Leaflet.i18n): Track with Elevation Profile
*   [leaflet-gpxgroup](https://github.com/Raruto/leaflet-elevation/blob/master/libs/leaflet-gpxgroup.js), [Leaflet.GeometryUtil](https://github.com/makinacorpus/Leaflet.GeometryUtil): Multiple tracks with elevation profiles on one map
*   [L.control.layers](https://leafletjs.com/examples/layers-control/): Switching Tilelayers
*   [Leaflet-providers](https://github.com/leaflet-extras/leaflet-providers): An extension that contains configurations for various tile providers.
*   [Leaflet.Control.Opacity](https://github.com/dayjournal/Leaflet.Control.Opacity): makes multiple tile layers transparent.
*   [Leaflet.markercluster](https://github.com/Leaflet/Leaflet.markercluster): Marker Cluster
*   [Leaflet.FeatureGroup.SubGroup](https://github.com/ghybs/Leaflet.FeatureGroup.SubGroup): add/remove groups of markers from Marker Cluster.
*   [Leaflet.MarkerCluster.PlacementStrategies](https://github.com/adammertel/Leaflet.MarkerCluster.PlacementStrategies): implements new possibilities how to place clustered children markers
*   [leaflet.zoomhome](https://github.com/torfsen/leaflet.zoomhome): Reset the view
*   [leaflet.fullscreen](https://github.com/brunob/leaflet.fullscreen): Fullscreen mode
*   [Leaflet.GestureHandling](https://github.com/Raruto/leaflet-gesture-handling): Gesture Handling

### Other functions

*   hover: Use it to highlight a gpx, kml or geojson element or get a tooltip on mouse over.
*   Hide Markers: Use it when a track in a GPX file contains some markers and you don't want to display them on the map.
*   Option to migrate from [WP GPX Maps](https://wordpress.org/plugins/wp-gpx-maps/) to elevation

## Screenshots

1. Track with elevation and other profiles and Switching Tile Layers<br>![Track with elevation profile](.wordpress-org/screenshot-1.png)
1. Track with elevation profile only and Switching Tile Layers<br>![Track with elevation profile](.wordpress-org/screenshot-2.png)
2. Multiple Tracks with elevation profile<br>![Multiple Tracks with elevation profile](.wordpress-org/screenshot-3.png)
3. Hover a Geojson area <br>![Hover a Geojson area](.wordpress-org/screenshot-4.png)
4. Markercluster and Groups <br>![Markercluster](.wordpress-org/screenshot-5.png)
5. Markercluster PlacementStrategies <br>![PlacementStrategies](.wordpress-org/screenshot-6.png)
6. GestureHandling <br>![GestureHandling](.wordpress-org/screenshot-7.png)

## Documentation

Detailed documentation and examples in <a href="https://leafext.de/">German</a> and <a href="https://leafext.de/en/">English</a>.

## Installation

* First you need to install and configure the plugin <a href="https://wordpress.org/plugins/leaflet-map/">Leaflet Map</a>.
* Then install this plugin.
* Go to Settings - Leaflet Map - Extensions for Leaflet Map and get documentation and settings options.

## Changelog

### 2.2.7 / 220409

* hover: bug with geojson fixed
* hover: tooltip on click in circle, polygon, line removed
* elevation: some strings for translation added
* swedish translation frontend from @argentum

### Previous

[Changelog](CHANGELOG.md)
