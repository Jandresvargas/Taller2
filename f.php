<?php 

	define("PG_DB"  , "t2_pruebas");
	define("PG_HOST", "localhost");
	define("PG_USER", "postgres");
	define("PG_PSWD", "12345");
	define("PG_PORT", "5433");
	
	$conexion = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
 ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>sidebar-v2 example</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.2/dist/leaflet.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.2/dist/leaflet.ie.css" /><![endif]-->

    <link rel="stylesheet" href="sidebar/css/leaflet-sidebar.css" />

    <style>
        body {
            padding: 0;
            margin: 0;
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
    </style>
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
                    <h1>Información de Hurtos</h1>
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
                    Editar datos
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> En esta sección usted puede editar informacion referente a alguno de los registros de sitios de interes
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <div style="margin-top:20px;">
                    <h1>Información de Hurtos</h1>
                    <input type="text" placeholder="Ingresa identificación" style="width: 200px;" maxlength="50">
                    <button onclick="addUser()">Guardar</button>
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
            <!-- AGREGAR Y ELIMINAR -->

            <div class="leaflet-sidebar-pane" id="agregar">
                <h1 class="leaflet-sidebar-header">
                    Editar datos
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Aca va la </code> En esta sección usted puede editar informacion referente a alguno de los registros de sitios de interes
                </p>
                    <!-- Agrega la tabla dentro del panel -->
                    <div style="margin-top:20px;">
                    <h1>Información de Hurtos</h1>
                    <button onclick="sidebar.disablePanel('mail')">Buscar</button>
                    <button onclick="addUser()">Eliminar</button>
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


            <div class="leaflet-sidebar-pane" id="messages">
                <h1 class="leaflet-sidebar-header">Messages<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
                
            </div>
        </div>
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
        var sidebar = L.control.sidebar({ container: 'sidebar' })
            .addTo(map);

        // add panels dynamically to the sidebar
        sidebar
            .addPanel({
                id:   'editar',
                tab:  '<i class="fa fa-pencil fa-fw"></i>'
            })
            .addPanel({
                id:   'agregar',
                tab:  '<i class="fa fa-cog fa-fw"></i>'
            })
            // add a tab with a click callback, initially disabled
            .addPanel({
                id:   'mail',
                tab:  '<i class="fa fa-envelope"></i>',
                title: 'Messages',
                button: function() { alert('opened via JS callback') },
                disabled: false,
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
