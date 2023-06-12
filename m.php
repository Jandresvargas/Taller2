<!DOCTYPE html>
<html>
<head>
    <title>Mapa con formulario - Leaflet</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="sidebar/css/leaflet-sidebar.css" />


    <script src="sidebar/js/leaflet-sidebar.js"></script>
    <style>
        #map {
            height: 400px;
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
            function eliminarPunto(id) {
                $.ajax({
                    url: 'bdg/eliminar.php',
                    type: 'POST',
                    data: { id: id },
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
                var id = $('#id').val();
                eliminarPunto(id);
            });
        });
    </script>
</head>
<body>
    <div id="map">
        <div id="sidebar" >
            <h2>Eliminar Punto</h2>
                <label for="id">ID del Punto:</label>
                <input type="text" id="id" required>
                <button id="btnEliminar">Eliminar</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; OpenStreetMap contributors'
        }).addTo(map);

        // Código para mostrar/ocultar el sidebar
        var sidebar = L.control.sidebar({
            container: 'sidebar'
        });


    </script>
</body>
</html>
