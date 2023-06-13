<?php
  // Crear la conexión a la base de datos
  define("PG_DB"  , "t2p");
  define("PG_HOST", "localhost");
  define("PG_USER", "postgres");
  define("PG_PSWD", "12345");
  define("PG_PORT", "5433");
  
  $conexion = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
	//Verificar conexion
	if (!$conexion) {
		echo "Error de conexión a la base de datos.";
		exit;
	}

$sql = "SELECT ST_AsGeoJSON(geom) AS geometry FROM sitios_interes";
$result = pg_query($conexion, $sql);

$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

pg_close($conexion);

echo json_encode($data);
?>
