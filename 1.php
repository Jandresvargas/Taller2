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
    <meta charset="utf-8" />
    <title>SiIn Comuna 22</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Container js -->
    <script src="js/container.js"></script>
    <!-- Estilos -->
    <link rel="stylesheet" href="css/estilo.css" />
    <!--SIDEBAR-->
    <link rel="stylesheet" href="sidebar/css/leaflet-sidebar.css" />
    <!-- Estilo leaflet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- plugin jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>  

    
    <!-- plugin jquery -->
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
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
                            <img class="mx-auto d-block rounded" src="img/Univalle.png" width="200" height="250" >   

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
    
    <!-- Container -->
    <div class="container">
    <div id="map"></div>
        

    </div>

</body>
</html>
