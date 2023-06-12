<?php
 #Archivo de configuracion de la base de datos
 
    define("PG_DB"  , "t2_pruebas");
	define("PG_HOST", "localhost");
	define("PG_USER", "postgres");
	define("PG_PSWD", "12345");
	define("PG_PORT", "5433");
	
	$dbcon = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <!-- Descripcion de la pagina -->
    <meta name="description" content="Esta es la biografía de Andrés Vargas">
    <!-- Vista de compatibilidad-->        
    <meta http-equiv="X-UAV-Compatible" content = "IE=edge">
    <meta name="viewport" content ="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Jorge Andres Vargas">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Estilo para el mapa -->
    <link rel="stylesheet" href="css/style2.css">



    <title>Mapa comuna 22</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


    <!-- plugin jquery -->
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>  
	
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>


    <!-- Complemento Leaflet.markercluster -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster-src.js"></script>


    <script src="https://leaflet.github.io/Leaflet.heat/dist/leaflet-heat.js"></script>
    <!-- Easy Button -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.css" />    

    <!-- Localización  -->
    <link rel="stylesheet" href="css/L.Control.Locate.css">
    <script src="Location/L.Control.Locate.js"></script>

    <!-- Geocodificador -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script src="grilla/Leaflet.Graticule2.js"></script> 




    <link rel="stylesheet" href="sidebar/">
    <script src="sidemenu/L.Control.SlideMenu.js"></script>



	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>
    <!-- Encabezado -->
    <header>
        <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <span class="badge bg-secondary">Sitios de interés</span>
                <a class="navbar-brand">Comuna 22</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Offcanvas lateral -->
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- Contenido Offcanvas -->
                <div class="offcanvas-body">
                    <div class="card" style="width:350px">
                        <br>
                        <div class="card-body">
                          <h4 class="card-title">Mapa de sitios de interés de la comuna 22</h4>
                          <p class="card-text">Este mapa contiene algunos de los sitios de interes que se pueden encontrar en la comuna 22 en la ciudad de Cali - Colombia</p>
                          <p><em>Cali - Colombia</em></p>
                          <p><em>2023</em></p>
                        </div>
                      </div>
                </div>
              </div>
            </div>
          </nav>
        </header>
    <div class="cajon rounded">
      
        <div id="map" style="z-index:0">
            <img id="norte" src="img/norte2.png" style="z-index:9999">

            <!-- Tabla slide  -->
            <script>
            var slide = 
            <table class="table table-striped table-bordered" id="table1">
			  	<thead class="thead-dark">
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Tipo</th>

				    </tr>
			  	</thead>
				
			  	<tbody>
				
				<?php 
		$sql="SELECT * from sitios_interes";
		$result=pg_query($dbcon,$sql);

		while($mostrar=pg_fetch_array($result)){
		 ?>
				    <tr>
				     <th  scope="row"><?php echo $mostrar['id'] ?></th>
				      <td contenteditable="true"> <?php echo $mostrar['nombre'] ?></td>
				      <td contenteditable="true"><?php echo $mostrar['tipo'] ?> </td>

					</tr>
					<?php 
					}
					 ?>
			  	</tbody>
			</table>
        </div>
        </script> 
        <script src="js/map3.js" style="z-index:0"></script>


        <!-- Minimapa -->
        <link rel="stylesheet" href="Leaflet-MiniMap-master/Control.MiniMap.css" />
        <script src="Leaflet-MiniMap-master/Control.MiniMap.js" type="text/javascript"></script>
        <script src="js/minimap.js" type="text/javascript"></script>

        <script>
            /// Leyenda
            var legend = L.control({position: "bottomright"});
            legend.onAdd = function(map) {
            var div = L.DomUtil.create("div", "legend");
            div.innerHTML = 
            '<h><b>Comuna 22</b></h>' +
            '<li id="legend-coordinates"></li>' +
            '</ul></p>' +
            'Andrés Vargas <br>' +
            'SIG WEB <br>' +
            '<img src="img/logovalle.png" style="width:90%">';
            return div;
            };

            //// Boton de reseteo de Zoom 

            var resetButton = L.easyButton({
            position:  'topright',
            states: [{
                stateName: 'reset-view',
                icon: '<img src="img/slide.png"  align="absmiddle" height="20px" >',
                title: 'Reiniciar vista',
                onClick: function(control) {
                // Restablecer la vista del mapa a la posición inicial
                map.setView([3.351602, -76.536017], 14);
                }
            }]
            }).addTo(map);

            // Agregar el botón al mapa
            resetButton.addTo(map);

        /// Reticula de coordendas
        var graticule = L.latlngGraticule({
            showLabel: true,
            color: '#222',
            zoomInterval: [
                {start: 12, end: 13, interval: 0.05},
                {start: 14, end: 15, interval: 0.025},
                {start: 16, end: 17, interval: 0.01}
            ]});
        // Crear un botón de visualizar reticula con Leaflet.EasyButton
            var graticuleButton = L.easyButton('<img src="img/grilla.png"  align="absmiddle" height="16px" >', function(){
                if (map.hasLayer(graticule)) {
                    map.removeLayer(graticule);
                } else {
                    graticule.addTo(map);
                }
                }, 'Reticula').addTo(map);

        L.control.scale().addTo(map);
        L.Control.geocoder().addTo(map);
        legend.addTo(map)
        function updateLegendCoordinates(e) {
            var legendCoordinates = document.getElementById('legend-coordinates');
            legendCoordinates.innerHTML = '<strong>Lat: </strong> ' + e.latlng.lat.toFixed(3) + '<strong>  Long:</strong> ' + e.latlng.lng.toFixed(3);
            }

        map.on('mousemove', updateLegendCoordinates);
            

	
            

        </script>


      <div class="map-c text-white">
        <h1 style="text-align: center;">Mapa de sitios de interés</h1>
        <h4 style="text-align: center;">Comuna 22</h4>
        <p style="text-align: justify;">Los sitios de interés son destinos populares que atraen a turistas y contribuyen al turismo de una ciudad. También pueden ser lugares de reunión y esparcimiento para los residentes locales. Estos sitios suelen reflejar la identidad y la historia de la ciudad, y muchos de ellos están asociados con eventos históricos, personajes famosos o características únicas de la localidad.</p>
        <div class="det"><i class="fa fa-map-marker"></i> <em><strong>Creado por:</strong> Andrés Vargas</em></div>
        <div class="det"><i class="fa fa-phone"></i> <em>Ingeniería Topográfica </em></div>
        <div class="det" style="text-align: center;"><i class="fa fa-globe" ></i> Código </div>
        <center>
          <p class="lead">
            <a href="https://github.com/Jandresvargas/ejercicioleaflet" class="btn btn-lg btn-success" style="background-image: url(img/GIT.png);background-repeat: no-repeat; background-size: cover; width: 50px; height: 50px;"> </a>
          </p>
        </center>
      </div>
      </div>
  </body>
</html>

