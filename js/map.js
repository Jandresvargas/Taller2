////  Crea mapa 
var map = L.map('map',
	{
		zoom: 10,
    minZoom:13,
    maxZoom: 16,

	}).setView([3.351602, -76.536017], 14);           
	//// Mapabase 1 
	var mapabase = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
		{
      minZoom:13,
      maxZoom: 16,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		});
	///Mapa base 2
	var mapabase2 = L.tileLayer('https://tileserver.memomaps.de/tilegen/{z}/{x}/{y}.png', 
  /// https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png
		{
      minZoom:13,
      maxZoom: 16
		})
	mapabase.addTo(map);
    var leyenda = L.control.layers({mapabase,mapabase2}).addTo(map);
    //// Agregar capas wfs y wms 



    var comunas = L.tileLayer.wms('http://ws-idesc.cali.gov.co:8081/geoserver/wfs?',
    {
    layers: 'idesc:mc_comunas',
    format: 'image/png',
    transparent: true,
    CQL_FILTER: "nombre='Comuna 22'",
    });

    
    /// Marker cluster o agrupacion de puntos 
    var markers = L.markerClusterGroup({spiderfyOnMaxZoom: true});
    // Carga el archivo GeoJSON
      //estilo
function style_nombre(feature){
	return{
		fillColor: '#E0F2F7',
		fillOpacity: 0.5,
		color: '#0000FF',
		opacity: 1,
		weight: 0.5
	};
}

function info_popup(feature, layer){
	layer.bindPopup("<h2>" + feature.properties.nombre + "</h2><hr>"+"<strong> Tipo: </strong>"+feature.properties.tipo+"<br/>");
}

//carga la capa como geojson desde la gdb
var sitios_interes = L.geoJSON();
	$.post("bdg/cargar.php",
		{
			peticion: 'cargar',
		},function (data, status, feature)
		{
		if(status=='success')
		{
			sitios_interes = eval('('+data+')');
			var sitios_interes = L.geoJSON(sitios_interes, {
				onEachFeature: info_popup,
			}).addTo(map);
			
			sitios_interes.eachLayer(function (layer) {
			layer.setZIndexOffset(1000);
			});
		}
	});
	




      //mapa de calor
      fetch('geojson/sitios_interes.geojson')
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        comuna22sitios_interes.addData(data);

        var coordinates = [];
        data.features.forEach(function (feature) {
          coordinates.push(feature.geometry.coordinates.reverse());
        });
      
        var heatLayer = L.heatLayer(coordinates);
        //Botton de control
        var button = L.easyButton('<img src="img/heatmap.png"  align="absmiddle" height="16px" >', function () {
          if (map.hasLayer(heatLayer)) {
            map.removeLayer(heatLayer);
          } else {
            map.addLayer(heatLayer);
          }
        }, 'Mapa de calor').addTo(map);
      });



    //// Agregar o superponer capas de comunas (WFS), Comuna 22 al mapa y sitios de interes 

    leyenda.addOverlay(comunas, 'Comunas');
    leyenda.addOverlay(markers, 'Sitios de interés agrupados');
    leyenda.addOverlay(sitios_interes, 'sss');
    
    

// Crear un icono personalizado de localizador
var IconLoca = L.icon({
  iconUrl: 'img/localiza.png',
  iconSize: [32, 32], // Tamaño del icono en píxeles
  iconAnchor: [16, 32] // Punto de anclaje del icono
});
// Crear una instancia de Leaflet-locatecontrol y agregarla al mapa
lc = L.control
  .locate({
    strings: {
      title: "Mostrar mi ubicación"
    }
  })
  .addTo(map);
//// Agregar minimapa 
var minimap = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',{attribution:'Universidad del Valle',subdomains: '2023'});

