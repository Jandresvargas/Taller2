
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
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!--FONT-AWESOME-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <!--SIDEBAR-->
    <link rel="stylesheet" href="sidebar/css/leaflet-sidebar.css" />

    <!-------------------------------ESTILOS------------------------------------>
    <style>
        #map {

	        display: flex;
            height:100%;
            border-radius: 2rem;
            
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
        html{
            height: 100%;
            font: 10pt "Helvetica Neue", Arial, Helvetica, sans-serif;
        }
        body {
            background-image: url('img/princfondo.JPG');
            align-items: center;
            justify-content: center;
            height: 90vh;
	        width: 90vw;
            display: block;
            margin-left: 65px;

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
            font: 12pt "Helvetica Neue", Arial, Helvetica, sans-serif, bold;
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
            right: 17%;
            padding: 0.5%;
            }
        label {
            display: block;
            font-weight: bold;
            font-size: 12px;
            color: #333;
            margin-bottom: 10px;
            z-index: 9999;
        }
        p {
            text-align: justify;
        }
    </style>
    <!--Plugin jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--Script para realizar la solicitud de eliminacion de un dato -->
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
    
 <!----------------------------------------------- Encabezado --------------------------------------------->
<header>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <!--Texto a la zona izquierda--> 
            <span class="badge bg-secondary">Sitios de interés</span>
            <!--Titulo central -->
            <a class="navbar-brand">Comuna 22</a>
            <!--Boton del menú en la parte superior derecha-->
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
                        <img class="mx-auto d-block rounded" src="img/Univalle.png" width="200" height="250" >
                        <h4 class="card-title">Mapa de sitios de interés de la comuna 22</h4>
                        <p class="card-text" style="text-align: justify">Este mapa contiene algunos de los sitios de interes que se pueden encontrar en la comuna 22 en la ciudad de Cali - Colombia</p>
                        <p><em>Cali - Colombia</em></p>
                        <p><em>2023</em></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </nav>
</header>
<br>
<br>
<br>
    <!-- Barra (sidebar) de la parte izquierda del mapa donde se presentan las opciones de información -->
<div id="sidebar" class="leaflet-sidebar collapsed">
    <!-- Menús de navegación -->
    <div class="leaflet-sidebar-tabs">
        <!-- Menus de la parte superior del sidebar -->
        <ul role="tablist">
            <li><a href="#home" role="tab"><i class="fa fa-home fa-fw"></i></a></li>
            <li><a href="#autopan" role="tab"><i class="fa fa-table"></i></a></li>
        </ul>

        <!-- Menú de la parte inferior del sidebar (GitHub) -->
        <ul role="tablist">
            <li><a href="https://github.com/Jandresvargas/Taller2"><i class="fa fa-github"></i></a></li>
        </ul>
    </div>
        <!-- Contenido de paneles  -->
    <div class="leaflet-sidebar-content">
        <div class="leaflet-sidebar-pane" id="home">
            <!-- Descripcion general -->
            <h1 class="leaflet-sidebar-header">
                CONTEXTUALIZACIÓN
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <br>
            <a href="https://twitter.com/PythonMaps/status/1625184022879158272/photo/1" target="u_blank">
                <img class="img-thumbnail" style="align-content: center; margin-left: 8rem;" src="img/Univalle.png" width="150" height="150">
            </a>
            <!-- Parrafos de presentación -->
            <h2>Sitios de interés </h2>
            <p>Los sitios de interés son destinos populares que atraen a turistas y contribuyen al turismo de una ciudad. También pueden ser lugares de reunión y esparcimiento para los residentes locales. Estos sitios suelen reflejar la identidad y la historia de la ciudad, y muchos de ellos están asociados con eventos históricos, personajes famosos o características únicas de la localidad.</p>
            <h2>Realizado por</h2>
            <p><em> Universidad del Valle </em></p>
            <p><em> Ingenieria topografíca </em></p>
            <p><em> Jorge Andrés Vargas</em></p>
            <p><em> 2023</em></p>
        </div>
        <!-- Mostrar tabla de datos  -->
        <div class="leaflet-sidebar-pane" id="autopan">
            <h1 class="leaflet-sidebar-header">
                TABLA SITIOS DE INTERES
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <br>
            <!-- Imagen -->
            <a href="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.flaticon.es%2Ficono-gratis%2Ftabla-de-datos_5199005&psig=AOvVaw05X8bOedTlqyb5RD_giSmw&ust=1686953351305000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCLDsioylxv8CFQAAAAAdAAAAABAE" target="u_blank">
                <img class="img-thumbnail" style="align-content: center; margin-left: 8rem;" src="img/tabla.png" width="150" height="150">
            </a>
            <!-- Descripción -->
            <p>
            <br>
                A continuacion se presentan una tabla de datos de sitios de interés de una manera estructurada y organizada que almacena y muestra información relevante sobre diferentes lugares o puntos de interés (Restaurantes, Hoteles, Bares, Centros comerciales, etc.) que se encuentran en la Comuna 22 de la ciudad de Santiago de Cali en el departamento del Valle del Cauca.
            </p>
            <p>
                Para visualizar los puntos totales de la base de datos, usted debe utilizar la herramienta de selección de capas que se encuentra en la parte superior derecha del visor y seleccionar la capa de “Sitios de interes”. 
            </p>
            <p>
                Para una mejor visualización usted puede ocultar el MiniMapa dando clic en la opción de “Ocultar MiniMapa”.
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
                    <!-- Consulta SQL -->
                        <?php 
                            $sql="SELECT * from sitios_interes";
                            $result=pg_query($conexion,$sql);
                            while($mostrar=pg_fetch_array($result)){
                        ?>
                        <tr>
                            <!-- Mostrar valores de las variables -->
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


        <!-- Panel de visualización de datos  individuales  -->
        <div class="leaflet-sidebar-pane" id="visualiza">
            <h1 class="leaflet-sidebar-header">
                VISUALIZACIÓN DE PUNTOS INDIVIDUALES
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <br>
            <a href="https://publicdomainvectors.org/photos/location-context.png" target="u_blank">
                <img class="img-thumbnail" style="align-content: center; margin-left: 7rem;" src="img/visualiza.png" width="200" height="200">
            </a> 
            <!-- Descripcion panel -->
            <p>
                <br>
                En esta sección usted puede visualizar la ubicación especifica de cada uno de los sitios de interés que se encuentran en la base de datos, para lo cual solamente es necesario dar clic en el botón “Zoom” de cada uno de los registros de la tabla para hacer un acercamiento a la ubicación del establecimiento, la representación se hace mediante un marcador. 
            </p>
            <h1>Vizualizar</h1>
            <!-- Agrega la tabla dentro del panel -->
            <table class="table table-striped table-bordered" id="locationsTable">
                <!-- Encabezado de tabla -->
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
                        // Consulta SQL para obtener los puntos
                        $query = "SELECT id, nombre, tipo,ST_X(geom) as lng, ST_Y(geom) as lat FROM sitios_interes";
                        $result = pg_query($conexion, $query);
                        if (!$result) {
                        echo "Error al obtener los puntos.";
                        exit;
                        }
                        // Array para almacenar marcadores
                        $markers = [];

                        // Iterar resultados, generar las filas de la tabla y marcadores
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
                        }
                    ?>
                </tbody>
            </table>
        </div>


        <!-- Panel de EDITAR DATOS-->
        <div class="leaflet-sidebar-pane" id="editar">
            <h1 class="leaflet-sidebar-header">
                EDITAR DATO
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <br>
            <a href="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ina-pidte.ac.cr%2Fmod%2Fbook%2Fview.php%3Fid%3D13057%26chapterid%3D560&psig=AOvVaw06CFwAzJnrEpmVe7utJ_AL&ust=1686953470015000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCIDNwsSlxv8CFQAAAAAdAAAAABAE" target="u_blank">
                <img class="img-thumbnail" style="align-content: center;margin-left: 7rem;" src="img/editar.png" width="200" height="200">
            </a>
            <br>
            <!-- Descripcion panel -->
            <p>En esta sección es posible realizar la edición de información referente a alguno de los registros que se encuentran en la base de datos de sitios de interés. Para ello, inicialmente es necesario conocer el identificador (id) del dato al cual se desea realizar la edición, a continuación al dar clic en el botón "Comenzar Edición" que se presenta a continuación aparecerá un formulario en el cual usted debe ingresar el identificador del establecimiento (id) y la información nueva (Nombre y Tipo de establecimiento) que desea actualizar en la base de datos, luego es necesario que de clic en el mapa para indicar la nueva ubicación que tendrá este establecimiento de ser necesario. Finalmente es necesario "Guardar" la informacion para terminar el proceso.                 </p>
                <!-- Agrega la tabla dentro del panel -->
            <div style="margin-top:20px;">
                <h1>Sitios de interes</h1>
                <!-- Botón de iniciar edición  -->
                <button class="btn btn-primary" id="startEditingBtn">Comenzar Edición</button>
                <!-- Formulario que aparece al dar clic en el boton de editar -->
                <form id="editForm" action="bdg/editar3.php" method="POST" style="display: none;">
                    <fieldset>
                        <br>
                        <!-- Localización -->
                        <div class="form-group">
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="long" name="long">
                        </div>
                        <!-- Información del dato -->
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
                        <!-- Botones del formulario -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Guardar">
                            <button type="button" class="btn btn-danger" id="cancelEditingBtn">Cancelar</button>
                        </div>
                    </fieldset>
                </form>
                <br>
            </div>
        </div>
        <!-- Panel de ELIMINAR dato-->
        <div class="leaflet-sidebar-pane" id="eliminar">
            <h1 class="leaflet-sidebar-header">
                Eliminar
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <br>
            <a href="https://www.trecebits.com/wp-content/uploads/2020/05/Borrar-cach%C3%A9-cookies-historial-del-navegador.jpg" target="u_blank">
                <img class="img-thumbnail" style="align-content: center; margin-left: 3rem;" src="img/Eliminar.webp" width="300" height="300">
            </a>
            <!-- Descripcion general -->
            <br>
            <p>
                En esta sección usted puede eliminar registros de la base de datos conociendo el identificador del punto al cual desea eliminar, para lo cual es necesario ingresar en el recuadro el identificador (id) del punto que desea eliminar y dar clic en "Eliminar"  para finalizar la solicitud
            </p>
            <!-- Agrega formulario de eliminar dentro del panel -->
            <div style="margin-top:20px;">
                <h1>Eliminar Dato</h1>
                <label for="idlbl">ID del Punto:</label>
                <input type="text" class="form-control" id="id2" required>
                <br>
                <!-- Botón de eliminar -->
                <button class="btn btn-danger" id="btnEliminar">Eliminar</button>
            </div>
        </div>
        <!-- Panel de agregar datos -->
        <div class="leaflet-sidebar-pane" id="agregar">
            <h1 class="leaflet-sidebar-header">Agregar datos<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            <br>
            <a href="https://previews.123rf.com/images/sarahdesign/sarahdesign1706/sarahdesign170601634/80793320-un-bot%C3%B3n-agregar-icono-de-archivo-en-verde.jpg" target="u_blank">
                <img class="img-thumbnail" style="align-content: center; margin-left: 7rem;" src="img/agregar.jfif" width="200" height="200">
            </a>
            <!-- Descripcion de panel -->
            <p>
                En esta sección usted puede agregar datos, establecimientos o sitios de interés que desea que sean incluidos en la base de datos, con el objetivo de ampliar la lista de sitios disponibles para que los usuarios puedan explorar y disfrutar de ellos.
            </p>
            <!-- Botón para ajecutar la herramienta -->
            <button class="btn btn-primary" id="btnAgregarDatos">Agregar Datos</button>
        </div>
    </div>
</div>
<!-- Formulario para agregar punto a la base de datos  -->
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
        <!-- Botones -->
        <button class="btn btn-success" type="submit">Guardar</button>
        <button class="btn btn-danger" type="button" onclick="cancelForm()">Cancelar</button>
    </form>
</div>
    
<!--------------------------------------------- Division del mapa -------------------------------------------->
<div id="map"style="z-index:0">
    <!-- Norte -->
    <img id="norte" src="img/norte2.png" style="z-index:9999">
</div>
    <!-- JS leaflet -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <!-- JS sidebar -->
<script src="sidebar/js/leaflet-sidebar.js"></script>
    <!-- Minimapa -->
<link rel="stylesheet" href="Leaflet-MiniMap-master/Control.MiniMap.css" />
<script src="Leaflet-MiniMap-master/Control.MiniMap.js" type="text/javascript"></script>
    <!-- Easy Button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.css" />  
    <!-- Localización  -->
<link rel="stylesheet" href="css/L.Control.Locate.css">
<script src="Location/L.Control.Locate.js"></script>
    <!-- Geocodificador -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Definición del mapa
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
    /// Boton para reiniciar zoom o visualizacion
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
        }).addTo(map);

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


    L.Control.geocoder().addTo(map);
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
        map.flyTo([lat, lng], 18);
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
        lc = L.control.locate({
                strings: {
                title: "Mostrar mi ubicación"
                }
            }).addTo(map);


    
</script>
</body>
</html>
