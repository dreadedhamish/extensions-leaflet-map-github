��    7      �      �      �     �  @   �    �  D   �     *  .   3  &   b     �  !   �  6   �     �     �     �       A   '  o   i  S   �  f   -  p   �  �     �   �  F   �	     �	  	   �	     �	  	   �	  �   
     �
     �
     �
  ~     ,   �  �   �  >   A     �     �     �  8   �  ;   �  c     ;   �     �  L   �  y   *  N   �  7   �  3   +  ]   _  <   �  0   �     +     2     @     C  �  ^       J     (  j  M   �  	   �  C   �  %   /     U  !   ^  :   �     �     �     �  3   �  M   ,  �   z  }     t   �  �   �  �   �  �   �  S   O     �     �     �     �  �   �     �     �     �  �   �  7   u  �   �  O   M     �     �     �  l   �  K   4  v   �  4   �  0   ,  @   ]  �   �  U   5  B   �  E   �  {      F   �   0   �      !     !     !     #!   Altitude At this zoom level and below, markers will not be clustered, see Brings the basic functionality of Gesture Handling into Leaflet Map.
	Prevents users from getting trapped on the map when scrolling a long page.
	You can enable it for all maps or for particular maps. It becomes active
	only when dragging or scrollWheelZoom is enabled. Configure a mapid, attribution and a tile url for each tile service. Default: Default: true. You can change it for each map: Display a track with elevation profile Example Extensions for Leaflet Map Github Extensions for the WordPress plugin Leaflet Map Github Found an issue? Help Help and Settings If 0, it is disabled. If a GPX track contains waypoints that you do not want to display If it is true, it is valid for any map and you can't change it. If it is false, you can change it for each map: If you are using <code>!fit</code>, you have to define how the map should fit, e.g. If you use the <code>elevation</code> shortcode, please use at least one marker (e.g. starting point). If you want use an own style, select "other" theme and give it a name. Put in your functions.php following code: In your elevation.css put the styles like the theme styles in <a href='https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.css'>https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.css</a> It resets the view to all markers (leaflet-marker), lines (leaflet-line), circles (leaflet-circle), geojsons (leaflet-geojson, leaflet-gpx, leaflet-kml) and a track (elevation). Many markers on a map become confusing. That is why they are clustered Max Elevation Max Slope Min Elevation Min Slope Please see the <a href="https://github.com/Leaflet/Leaflet.markercluster#options">Leaflet.markercluster</a> page for options. If you want to change other ones, please post it to the forum. Plugins Default Post it to the support forum Switching Tile Layers The maximum radius that a cluster will cover from the central marker (in pixels). Decreasing will make more, smaller clusters. The number of strings and groups must match. There are certainly more examples. Test it yourself with the parameters <code>fitbounds</code> (leaflet-) or <code>fit</code> (zoomhomemap). To reset all values to their defaults, simply clear the values Total Ascent Total Descent Total Length Use it to highlight a geojson area or line on mouse over When the map is loaded, it zooms to all objects by default. When you click a cluster at the bottom zoom level we spiderfy it so you can see all of its markers. You can also define to zoom at the first call to a geojson: You can change it for each map: You can change this with the attribute <code>fit</code> / <code>!fit</code>. You may be interested in dynamically add/remove groups of markers from Marker Cluster with Leaflet.FeatureGroup.SubGroup. appears in the switching control. To delete a service simply clear the values. button to reset the view. A must for clustering markers comma separated labels appear in the selection menu comma separated strings to distinguish the markers, e.g. an unique string in iconUrl or title dynamically add/remove groups of markers from Marker Cluster https://github.com/hupe13/extensions-leaflet-map hupe13 must end with or possible meaningful values PO-Revision-Date: 2021-06-12 18:29+0000
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: Loco https://localise.biz/
Language: de_DE
Project-Id-Version: Plugins - Extensions for Leaflet Map - Development (trunk)
Language-Team: Deutsch
Report-Msgid-Bugs-To: 
POT-Creation-Date: 2021-05-19 10:16+0000
Last-Translator: 
X-Loco-Version: 2.5.2; wp-5.7.2 Höhe Ab dieser Zoomstufe und darunter werden die Marker nicht geclustert. Siehe Liefert die Grundfunktionalität der Gestensteuerung in Leaflet Map.
	Verhindert, dass Benutzer beim Scrollen einer langen Seite in der Karte hängen bleiben.
	Du kannst es für alle Maps oder für bestimmte Maps aktivieren. Sie wird 
	nur aktiv, wenn dragging oder scrollWheelZoom aktiviert ist. Definiere ein mapid, das Copyright und die Tileserver für jeden Tileservice. Standard: Standard: true. Du kannst den Wert für jede Karte einzeln angeben. Anzeige eines Tracks mit Höhenprofil Beispiel Extensions for Leaflet Map Github Erweiterungen für das WordPress Plugin Leaflet Map Github Hast du einen Fehler gefunden? Hilfe Hilfe und Einstellungen Wenn der Wert 0 ist, ist es nicht aktiv (disabled). Falls ein GPX-Track Wegpunkte enthält, die man nicht anzeigen lassen möchte Wenn der Wert true ist, gilt er für alle Maps und du kannst ihn nicht ändern. Ist der Wert false, kannst du ihn für jedes Map ändern: Wenn du <code>!fit</code> verwendest, muss der Kartenausschnitt definiert werden, welcher zuerst angezeigt werden soll, z. B. Wenn du den Shortcode <code>elevation</code> verwendest, definiere  bitte mindestens einen Marker (z.B. Startpunkt). Wenn du ein anderes Thema als die vorgegebenen verwenden möchtest, wähle das Thema „other“ und benenne es. Trage in die functions.php folgenden Code ein: Definiere die Styles in deinem elevation.css. Nimm als Vorlage das Original CSS von <a href='https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.css'>https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.css</a> Er setzt die Kartenansicht auf alle Marker (leaflet-marker), Linien (leaflet-line), Kreise (leaflet-circle), Geojsons (leaflet-geojson, leaflet-gpx, leaflet-kml) und einen Track (elevation) zurück.
 Viele Marker auf einer Karte werden unübersichtlich. Deshalb werden sie geclustert Maximale Höhe max. Steigung Minimale Höhe max. Gefälle Sieh dir die <a href="https://github.com/Leaflet/Leaflet.markercluster#options">Seite von Leaflet.markercluster</a> für Optionen an. Wenn du weitere ändern möchte, poste es ins Forum. Plugins Standard Poste ihn ins Support Forum Umschalten von Tilelayers Der maximale Radius, den ein Cluster vom zentralen Marker aus abdeckt (in Pixel). Je kleiner er ist, desto mehr und kleinere Cluster werden gebildet. Die Anzahl von strings und groups muss übereinstimmen. Es gibt sicherlich noch mehr Beispiele. Teste es für deine Anwendung mit den Parametern <code>fitbounds</code> (leaflet-) oder <code>fit</code> (zoomhomemap). Um alle Werte auf ihre Standardwerte zurückzusetzen, lösche einfach die Werte Gesamtanstieg Gesamtabstieg Gesamtstrecke Verwende diese Option, um einen Geojson-Bereich oder einen Track beim Überfahren mit der Maus hervorzuheben Wenn die Karte geladen wird, wird standardmäßig auf alle Objekte gezoomt. Wenn man ein Cluster in der untersten Zoomstufe anklickt, wird es gespidert, so dass man alle seine Marker sehen kann. Du kannst zuerst auch auf ein geojson-Objekt zoomen: Du kannst es für jede Karte einzeln einstellen: Du kannst das mit  <code>fit</code> / <code>!fit</code> ändern. Dich könnte auch das dynamische Hinzufügen bzw. Entfernen von Markern in bzw. aus dem Markercluster mit Leaflet.FeatureGroup.SubGroup interessieren. erscheint im Menü. Um einen Tileserver zu löschen, lösche den Text in den Feldern. Button um die Ansicht zurückzusetzen. Ein Muss für Markercluster durch Komma getrennte Beschriftungen werden im Auswahlmenü angezeigt durch Komma getrennte Zeichenketten zur Unterscheidung der Marker, z. B. eine eindeutige Zeichenkette in iconUrl oder title Dynamisches Hinzufügen/Entfernen von Markergruppen aus Marker Cluster https://github.com/hupe13/extensions-leaflet-map hupe13 muss enden mit oder mögliche sinnvolle Werte 