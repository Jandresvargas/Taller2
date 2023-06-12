<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="CraftingGamerTom">

<title>ejemplo 2</title>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- Bootstrap core CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">


<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<!-- JQuery library -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
<style>
	body { background-color: #fafafa; }
	

	.botones2{
		background-color: LightSalmon;
	}
</style>

</head>

<body>
    <main role="main" class="container" style="margin-top:150px;">

    	<div style="margin-top:20px;">
    		<h1>Información de Hurtos</h1>
		  	<table class="table table-striped table-bordered" id="table1">
			  	<thead class="thead-dark">
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Tipo</th>
					  <th scope="col">geom</th>
				    </tr>
			  	</thead>
				
			  	<tbody>
				
				<?php 
				include ('bdg/conect.php');
				while($mostrar=pg_fetch_array($result)){
		 		?>
				    <tr>
				     <th  scope="row"><?php echo $mostrar['id'] ?></th>
				      <td> <?php echo $mostrar['nombre'] ?></td>
				      <td><?php echo $mostrar['tipo'] ?></td>
				      <td><?php echo $mostrar['geom'] ?></td>

					</tr>
					<?php 
					}
					 ?>

			  	</tbody>
			</table>
    </main>
	
	<!-- /.container -->
	<script>
	function del(b) 
		{	
			$.post("base_de_datos/ejemplo2.php",
				{
					peticion:'borrar_admin', 
					parametros: {gid:b}
				},
				function(data, status){
					console.log("Datos recibidos: " + data + "\nStatus: " + status);
					if(status=='success')
					{
						alert("reporte borrado");
						location.reload();
					}
				});	
			//Para cerrar la ventana modal	
		};		
		

		
		
	
	</script>


</body>

</html>
