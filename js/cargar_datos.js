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
	