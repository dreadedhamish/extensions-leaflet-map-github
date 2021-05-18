// For use with only one map on a webpage
window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
window.WPLeafletMapPlugin.push(function () {
	var map = window.WPLeafletMapPlugin.getCurrentMap();
	if ( WPLeafletMapPlugin.markers.length > 0 ) {
		clmarkers = L.markerClusterGroup({
			maxClusterRadius: function(zoom)
				//{ return 60; },
				{return ((zoom <= 13) ? 50 : 30);},
			spiderfyOnMaxZoom: true,
			disableClusteringAtZoom: 17,
		});
		for (var i = 0; i < WPLeafletMapPlugin.markers.length; i++) {
			var a = WPLeafletMapPlugin.markers[i];
			clmarkers.addLayer(a);
			map.removeLayer(a);
		}
		clmarkers.addTo( map );
		WPLeafletMapPlugin.markers.push( clmarkers );
	}
});
