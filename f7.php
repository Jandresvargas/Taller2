<?php 
	define("PG_DB"  , "t2p");
	define("PG_HOST", "localhost");
	define("PG_USER", "postgres");
	define("PG_PSWD", "12345");
	define("PG_PORT", "5433");
	
	$conexion = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
    if (!$conexion) {
        echo "Error de conexión con la base de datos.";
        exit;
    }
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sitios de interes</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.2/dist/leaflet.ie.css" /><![endif]-->

    <link rel="stylesheet" href="sidebar/css/leaflet-sidebar.css" />


    <style>
        #map {
            height: 600px;
        }
        #form {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px;
            z-index: 9999;
        }
        #form input {
            margin-bottom: 10px;
        }

        #form button {
            margin-top: 10px;
        }
        html, body, #map {
            height: 100%;
            font: 10pt "Helvetica Neue", Arial, Helvetica, sans-serif;
        }
        .legend {
            background-color: #e9eacb;
            padding: 5px;
            opacity: 0.8;
            border: 10px;
            height: 150px;
            width: 200px;
            position: 'bottomleft'
            }
        .lorem {
            font-style: italic;
            text-align: justify;
            color: #AAA;
        }
        #sidebar {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: white;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            z-index: 9999;
        }
        #norte{
            position:fixed;
            width:3.5%;
            left: 8%;
            padding: 0.5%;
            }
        label {
            display: block;
            font-weight: bold;
            font-size: 12px;
            color: #333;
            margin-bottom: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para enviar la solicitud de eliminación del punto
            function eliminarPunto(id2) {
                $.ajax({
                    url: 'bdg/eliminar.php',
                    type: 'POST',
                    data: { id: id2 },
                    success: function(response) {
                        alert(response);
                    },
                    error: function() {
                        alert('Error al eliminar el punto.');
                    }
                });
            }

            // Manejador de eventos para el botón de eliminación
            $('#btnEliminar').on('click', function() {
                var id2 = $('#id2').val();
                eliminarPunto(id2);
            });
        });
    </script>

</head>
<body>
    <!-- optionally define the sidebar content via HTML markup -->
    <div id="sidebar" class="leaflet-sidebar collapsed">
        <!-- nav tabs -->
        <div class="leaflet-sidebar-tabs">
            <!-- top aligned tabs -->
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-home fa-fw"></i></a></li>
                <li><a href="#autopan" role="tab"><i class="fa fa-table"></i></a></li>
            </ul>

            <!-- bottom aligned tabs -->
            <ul role="tablist">
                <li><a href="https://github.com/Jandresvargas/Taller2"><i class="fa fa-github"></i></a></li>
            </ul>
        </div>

        <!-- panel -->
        <div class="leaflet-sidebar-content">
            <div class="leaflet-sidebar-pane" id="home">
                <!-- Descripcion general -->
                <h1 class="leaflet-sidebar-header">
                    Sitios de interes
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <h2>Contexto</h2>
                <h3 class="lorem" style="text-align: justify;">Los sitios de interés son destinos populares que atraen a turistas y contribuyen al turismo de una ciudad. También pueden ser lugares de reunión y esparcimiento para los residentes locales. Estos sitios suelen reflejar la identidad y la historia de la ciudad, y muchos de ellos están asociados con eventos históricos, personajes famosos o características únicas de la localidad.</h3>
                <p><b>Select the other panes for a showcase of each feature.</b></p>

                <h2>More examples</h2>


                <p class="lorem"> Universidad del Valle </p>
                <p class="lorem"> Ingenieria topografíca </p>
                <p class="lorem"> Jorge Andrés Vargas</p>
                <p class="lorem"> 2023</p>

            </div>
            <!-- Mostrar tabla de datos  -->
            <div class="leaflet-sidebar-pane" id="autopan">
                <h1 class="leaflet-sidebar-header">
                    Tabla Sitios de interes
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> 
                    A continuacion se presentan los sitios de interés presentes en la comuna 22 de la ciudad de Santiago de Cali
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <div style="margin-top:20px;">
                    <h1>Sitios de interes</h1>
                        <table class="table table-striped table-bordered" id="table1" style="border: 1px;">
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
                        $result=pg_query($conexion,$sql);
                        while($mostrar=pg_fetch_array($result)){
                        ?>
                            <tr>
                            <th  scope="row"><?php echo $mostrar['id'] ?></th>
                            <td> <?php echo $mostrar['nombre'] ?></td>
                            <td><?php echo $mostrar['tipo'] ?> </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- Mostrar tabla de datos  -->
            <div class="leaflet-sidebar-pane" id="visualiza">
                <h1 class="leaflet-sidebar-header">
                    Visualización de puntos individuales
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> 
                    A continuacion se presentan los sitios de interés presentes en la comuna 22 de la ciudad de Santiago de Cali
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <table class="table table-striped table-bordered" id="locationsTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Consulta para obtener los puntos
                            $query = "SELECT id, nombre, tipo,ST_X(geom) as lng, ST_Y(geom) as lat FROM sitios_interes";
                            $result = pg_query($conexion, $query);
                            if (!$result) {
                            echo "Error al obtener los puntos.";
                            exit;
                            }

                            // Crear un array para almacenar los marcadores
                            $markers = [];

                            // Iterar sobre los resultados y generar las filas de la tabla y los marcadores
                            while ($row = pg_fetch_assoc($result)) {
                            $id = $row['id'];
                            $nombre = $row['nombre'];
                            $tipo = $row['tipo'];
                            $lat = $row['lat'];
                            $lng = $row['lng'];
                            echo "<tr>";
                            echo "<td>$id</td>";
                            echo "<td>$nombre</td>";
                            echo "<td>$tipo</td>";
                            echo "<td><button onclick=\"zoomToLocation($lat, $lng)\">Zoom</button></td>";
                            echo "</tr>";

                            // Agregar el marcador al array

                            }
                        ?>
                        </tbody>
                    </table>
            </div>


            <!-- EDITAR -->
            <div class="leaflet-sidebar-pane" id="editar">
                <h1 class="leaflet-sidebar-header">
                    Editar dato
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> En esta sección usted puede editar informacion referente a alguno de los registros de sitios de interes
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <div style="margin-top:20px;">
                    <h1>Sitios de interes</h1>
                    <!-- formulario para agregar datos  -->
                    <button class="btn btn-primary" id="startEditingBtn">Comenzar Edición</button>
                    <form id="editForm" action="bdg/editar3.php" method="POST" style="display: none;">
                        <fieldset>
                            <br>
                            <div class="form-group">
                                <input type="hidden" id="lat" name="lat">
                                <input type="hidden" id="long" name="long">
                            </div>
                            <div class="form-group">
                                <label for="id">ID:</label>
                                <input type="text" class="form-control" id="id" name="id" placeholder="Identificador" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de establecimiento" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo de establecimiento" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Guardar">
                                <button type="button" class="btn btn-danger" id="cancelEditingBtn">Cancelar</button>
                            </div>
                        </fieldset>
                    </form>

                    <br>
                </div>
            </div>
            <!-- AGREGAR Y ELIMINAR -->
            <div class="leaflet-sidebar-pane" id="eliminar">
                <h1 class="leaflet-sidebar-header">
                    Eliminar
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> En esta sección usted puede editar informacion referente a alguno de los registros de sitios de interes
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <div style="margin-top:20px;">
                    <h1>Eliminar Dato</h1>
                        <label for="idlbl">ID del Punto:</label>
                        <input type="text" class="form-control" id="id2" required>
                        <br>
                        <button class="btn btn-danger" id="btnEliminar">Eliminar</button>

                </div>
            </div>


            <div class="leaflet-sidebar-pane" id="agregar">

                <h1 class="leaflet-sidebar-header">Agregar datos<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
                <button class="btn btn-primary" id="btnAgregarDatos">Agregar Datos</button>
            </div>
        </div>
    </div>

    <div id="form">
        <h3>Agregar Punto</h3>
        <form id="pointForm" method="POST" action="bdg/agregar.php">
            <input class="form-control" type="text" id="id" name="id" placeholder="Identificación" required>
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre" required>
            <input class="form-control" type="text" id="tipo"  name="tipo" placeholder="Tipo" required>
            <br>
            <h4>Localización</h4>
            <input class="form-control" type="text" id="latitude" name="latitude" placeholder="Latitud" readonly>
            <input class="form-control" type="text" id="longitude" name="longitude" placeholder="Longitud" readonly>

            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-danger" type="button" onclick="cancelForm()">Cancelar</button>
        </form>
    </div>

    <div id="map"style="z-index:0">
        <img id="norte" src="img/norte2.png" style="z-index:9999">
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script src="sidebar/js/leaflet-sidebar.js"></script>
    <link rel="stylesheet" href="Leaflet-MiniMap-master/Control.MiniMap.css" />
    <script src="Leaflet-MiniMap-master/Control.MiniMap.js" type="text/javascript"></script>



    <script>
        // standard leaflet map setup
        var map = L.map('map');
        map.setView([3.351602, -76.536017], 14);
        var OpenStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: 'Map data &copy; OpenStreetMap contributors'
            }).addTo(map);
        ///Mapa base 2
	    var Memomaps = L.tileLayer('https://tileserver.memomaps.de/tilegen/{z}/{x}/{y}.png', 
        /// https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png
                {
            minZoom:13,
            maxZoom: 16
		});

        var leyenda = L.control.layers({OpenStreetMap,Memomaps}).addTo(map);

        var miniMap = new L.Control.MiniMap(L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'), {
            toggleDisplay: true,
            minimized: false,
            position: "bottomleft",
            width: 200,
            height: 200,
            strings: {hideText: 'Ocultar MiniMapa', showText: 'Mostrar MiniMapa'}
        }).addTo(map);


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



        legend.addTo(map)
        leyenda.addOverlay(comunas, 'Comuna 22');
        leyenda.addOverlay(barrios, 'Barrios y sectores');
        /// Funcion para poner las coordenadas del puntero en la leyenda
        function updateLegendCoordinates(e) {
            var legendCoordinates = document.getElementById('legend-coordinates');
            legendCoordinates.innerHTML = '<strong>Lat: </strong> ' + e.latlng.lat.toFixed(3) + '<strong>  Long:</strong> ' + e.latlng.lng.toFixed(3);
            }
        map.on('mousemove', updateLegendCoordinates);

        var marker = L.marker([0, 0]).addTo(map);
        var editingEnabled = false;

        var currentMarker;
            // Agregar los marcadores al mapa
        var markersLayer = L.layerGroup([<?php echo implode(',', $markers); ?>]);
        markersLayer.addTo(map).bindPopup('nombre');

        map.on('click', function(e) {
         if (editingEnabled) {
            var lat = e.latlng.lat;
            var long = e.latlng.lng;

            marker.setLatLng([lat, long]);
            document.getElementById('lat').value = lat;
            document.getElementById('long').value = long;
         }
        });
        document.getElementById('startEditingBtn').addEventListener('click', function() {
         editingEnabled = true;
         document.getElementById('editForm').style.display = 'block';
        });
        document.getElementById('cancelEditingBtn').addEventListener('click', function() {
            editingEnabled = false;
            document.getElementById('editForm').style.display = 'none';
        });



        function zoomToLocation(lat, lng, nombre) {
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            currentMarker = L.marker([lat, lng]).addTo(map);
            //currentMarker.bindPopup('<?php echo $nombre?>' + nombre).openPopup();
            map.flyTo([lat, lng], 15);
            }




        // create the sidebar instance and add it to the map
        var sidebar = L.control.sidebar({ container: 'sidebar' 
        }).addTo(map);
        var clickedLatLng;
        var marker;
        // Manejador de eventos para el clic en el mapa
        function onMapClick(e) {
            if (marker){
                map.removeLayer(marker)
            }
            clickedLatLng = e.latlng;
            document.getElementById('latitude').value = clickedLatLng.lat;
            document.getElementById('longitude').value = clickedLatLng.lng;
            marker = L.marker(clickedLatLng).addTo(map)
        
        }
        // Agregar el evento clic al mapa
        map.on('click', onMapClick);
        // Función para abrir el formulario
        function openForm() {
            document.getElementById('form').style.display = 'block';
        }
        // Función para cancelar el formulario
        function cancelForm() {
            document.getElementById('form').style.display = 'none';
            if (marker) {
                map.removeLayer(marker);
            }
        }
        
        // Manejador de eventos para enviar el formulario
        $('#pointForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response);
                    // Aquí puedes realizar alguna acción adicional después de guardar los datos
                },
                error: function() {
                    alert('Error al guardar el punto.');
                }
            });
        });
        // Agregar un evento de clic al botón del sidebar
        var btnAgregarDatos = document.getElementById('btnAgregarDatos');
        btnAgregarDatos.addEventListener('click', openForm);
        // add panels dynamically to the sidebar
        sidebar
            .addPanel({
                id:   'editar',
                title: 'Editar registro',
                tab:  '<i class="fa fa-pencil fa-fw"></i>'
            })
            .addPanel({
                id:   'visualiza',
                title: 'Visualizar puntos individuales',
                tab:  '<i class="fa fa-map-marker"></i>'
            })
            .addPanel({
                id:   'eliminar',
                title: 'Eliminar registro',
                tab:  '<i class="fa fa-trash-o"></i>'
            })
            // add a tab with a click callback, initially disabled
            .addPanel({
                id:   'agregar',
                tab:  '<i class="fa fa-file-text-o"></i>',
                title: 'Agregar registro',
                
            })



        var userid = 0
        function addUser() {
            sidebar.addPanel({
                id:   'user' + userid++,
                tab:  '<i class="fa fa-user"></i>',
                title: 'User Profile ' + userid,
                pane: '<p>user ipsum dolor sit amet</p>',
            });
        }
        
    </script>
</body>
</html>
