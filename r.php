<!DOCTYPE html>
<html>
<head>
  <title>Zoom en marcadores desde tabla - Leaflet</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
  <style>
    #map {
      height: 400px;
    }
  </style>
</head>
<body>
  <div id="map"></div>

  <table id="locationsTable">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Conexión a la base de datos
      // Crear la conexión a la base de datos
      define("PG_DB"  , "t2p");
      define("PG_HOST", "localhost");
      define("PG_USER", "postgres");
      define("PG_PSWD", "12345");
      define("PG_PORT", "5433");
      
      $conn = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
      //Verificar conexion
      if (!$conn) {
        echo "Error de conexión a la base de datos.";
        exit;
      }

        // Consulta para obtener los puntos
        $query = "SELECT id, nombre, tipo, ST_X(geom) as lng, ST_Y(geom) as lat FROM sitios_interes";
        $result = pg_query($conn, $query);
        if (!$result) {
          echo "Error al obtener los puntos.";
          exit;
        }

        // Iterar sobre los resultados y generar las filas de la tabla
        while ($row = pg_fetch_assoc($result)) {
          $id = $row['id'];
          $nombre = $row['nombre'];
          $lat = $row['lat'];
          $lng = $row['lng'];
          echo "<tr>";
          echo "<td>$id</td>";
          echo "<td>$nombre</td>";
          echo "<td>$lat</td>";
          echo "<td>$lng</td>";
          echo "<td><button onclick=\"zoomToLocation($lat, $lng)\">Zoom</button></td>";
          echo "</tr>";
        }

        // Cerrar la conexión a la base de datos
        pg_close($conn);
      ?>
    </tbody>
  </table>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
  <script>
    var map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; OpenStreetMap contributors'
    }).addTo(map);

    function zoomToLocation(lat, lng) {
      map.flyTo([lat, lng], 15);
    }
  </script>
</body>
</html>
