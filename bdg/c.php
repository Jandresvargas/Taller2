<?php
// Establecer la conexión con la base de datos

define("PG_DB"  , "t2_pruebas");
	define("PG_HOST", "localhost");
	define("PG_USER", "postgres");
	define("PG_PSWD", "12345");
	define("PG_PORT", "5433");
	
	$conexion = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");

// Consulta para obtener la información de la base de datos
$sql = "SELECT * FROM sitios_interes";
$resultado = pg_query($conexion, $sql);

// Construir la tabla con la información obtenida
$html = '<table>';
$html .= '<tr><th>ID</th><th>Nombre</th><th>Descripción</th></tr>';
while ($fila = pg_fetch_assoc($resultado)) {
  $html .= '<tr>';
  $html .= '<td>' . $fila['id'] . '</td>';
  $html .= '<td>' . $fila['nombre'] . '</td>';
  $html .= '<td>' . $fila['tipo'] . '</td>';
  $html .= '</tr>';
}
$html .= '</table>';

// Devolver la tabla como respuesta
echo $html;

// Cerrar la conexión
pg_close($conexion);
?>
