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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.2/dist/leaflet.css" />
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
            border-radius: 5px;
            z-index: 9999;
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
                <li><a href="#autopan" role="tab"><i class="fa fa-book fa-fw"></i></a></li>
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
            <!-- EDITAR -->
            <div class="leaflet-sidebar-pane" id="editar">
                <h1 class="leaflet-sidebar-header">
                    Aaaaaaaaaaaaaaaaaaaaaaaahhhhhhhhhhhhh
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> En esta sección usted puede editar informacion referente a alguno de los registros de sitios de interes
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <div style="margin-top:20px;">
                    <h1>Sitios de interes</h1>
                    <!-- formulario para agregar datos  -->
                    
                    <form action="bdg/editar.php" method="POST" style="width: 100%; margin: 0 auto;">
                        <fieldset>
                            <legend class="text-center text-success"> Datos del sitio </legend>
                            <div class="form-group">
                                <label for="id">Id     </label> <!-- Nombre  -->
                                <input type="text" class="form-control" name="id">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label> <!-- email  -->
                                <input type="text" class="form-control" name="nombre">
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo</label> <!-- telefono  -->
                                <input type="text" class="form-control" name="tipo">
                            </div>
                            <div class="form-group">
                                <label for="lat">Latitud</label> <!-- telefono  -->
                                <input type="text" class="form-control" name="lat">
                            </div>
                            <div class="form-group">
                                <label for="long">Longitud</label> <!-- telefono  -->
                                <input type="text" class="form-control" name="long">
                            </div>
                            <div>
                                <input type="submit" class="btn btn-success form-control" name="guardar">
                            </div>
                        </fieldset>
                    </form>
                    <br>
                </div>
            </div>
            <!-- AGREGAR Y ELIMINAR -->
            <div class="leaflet-sidebar-pane" id="eliminar">
                <h1 class="leaflet-sidebar-header">
                    Agregar o eliminar
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> En esta sección usted puede editar informacion referente a alguno de los registros de sitios de interes
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <div style="margin-top:20px;">
                    <h1>Eliminar Dato</h1>
                        <label for="idlbl">ID del Punto:</label>
                        <input type="text" id="id2" required>
                        <button id="btnEliminar">Eliminar</button>

                </div>
            </div>


            <div class="leaflet-sidebar-pane" id="agregar">
                <h1 class="leaflet-sidebar-header">Messages<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
                <button id="btnAgregarDatos">Agregar Datos</button>
            </div>
        </div>
    </div>

    <div id="form">
        <h3>Agregar Punto</h3>
        <form id="pointForm" method="POST" action="bdg/agregar.php">
            <input type="text" id="id" name="id" placeholder="Identificación" required>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
            <input type="text" id="tipo"  name="tipo" placeholder="Tipo" required>
            <br>
            <label for="id">Latitud:</label>
            <input type="text" id="latitude" name="latitude" placeholder="Latitud" readonly>
            <label for="id">Longitud:</label>
            <input type="text" id="longitude" name="longitude" placeholder="Longitud" readonly>

            <button type="submit">Guardar</button>
            <button type="button" onclick="cancelForm()">Cancelar</button>
        </form>
    </div>

    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@0.7.2/dist/leaflet.js"></script>
    <script src="sidebar/js/leaflet-sidebar.js"></script>
    

    <script>
        // standard leaflet map setup
        var map = L.map('map');
        map.setView([3.351602, -76.536017], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; OpenStreetMap contributors'
        }).addTo(map);

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
                id:   'eliminar',
                title: 'Eliminar registro',
                tab:  '<i class="fa fa-cog fa-fw"></i>'
            })
            // add a tab with a click callback, initially disabled
            .addPanel({
                id:   'agregar',
                tab:  '<i class="fa fa-envelope"></i>',
                title: 'Agregar registro',
                
            })

        // be notified when a panel is opened
        sidebar.on('content', function (ev) {
            switch (ev.id) {
                case 'autopan':
                sidebar.options.autopan = true;
                break;
                default:
                sidebar.options.autopan = false;
            }
        });

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
