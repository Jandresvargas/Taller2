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

    var barrios = L.tileLayer.wms('http://ws-idesc.cali.gov.co:8081/geoserver/wfs?',
    {
    layers: 'idesc:mc_barrios',
    format: 'image/png',
    transparent: true,
    CQL_FILTER: "comuna='22'",
    tms: true
    });

    // POP UP de puntos 

function info_popup(feature, layer){
	layer.bindPopup("<h1>" + feature.properties.nombre + "</h1><hr>"+"<strong> Identificación: </strong>"+feature.properties.id+"<br/>"+"<strong> Tipo: </strong>"+feature.properties.tipo+"<br/>");
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
        onEachFeature: info_popup
			});
			
			sitios_interes.eachLayer(function (layer) {
			layer.setZIndexOffset(1000);
			});
      leyenda.addOverlay(sitios_interes, 'Sitios de interes');
		}
	});
	


    //// Agregar o superponer capas base con Geoservicios de la IDESC

    leyenda.addOverlay(comunas, 'Comuna 22');
    leyenda.addOverlay(barrios, 'Barrios y sectores');
      

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

