<?php
 #Archivo de configuracion de la base de datos
 
    define("PG_DB"  , "t2_pruebas");
	define("PG_HOST", "localhost");
	define("PG_USER", "postgres");
	define("PG_PSWD", "12345");
	define("PG_PORT", "5433");
	
	$dbcon = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");

	$sql="SELECT * from sitios_interes";
	$result=pg_query($dbcon,$sql);
	$contenido[id]=$result[0][id];
	echo json_encode($result);
?>
