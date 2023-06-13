<?php
define("PG_DB"  , "t2p");
define("PG_HOST", "localhost");
define("PG_USER", "postgres");
define("PG_PSWD", "12345");
define("PG_PORT", "5433");


$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$conn = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
if (!$conn) {
   echo "Error al conectar a la base de datos.";
   exit;
}

$query = "UPDATE sitios_interes SET nombre='$nombre',tipo='$tipo', geom=ST_SetSRID(ST_MakePoint($longitude, $latitude), 4326) WHERE id='$id'";
$result = pg_query($conn, $query);
if (!$result) {
   echo "Error al actualizar el registro.";
   exit;
}

echo "Registro actualizado correctamente.";

pg_close($conn);
?>