<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $vehiculo = $_POST['vehiculo'];
    $retiro = $_POST['fecha_retiro'];
    $devolucion = $_POST['fecha_devolucion'];

    echo "<h2>Solicitud recibida</h2>";
    echo "<p>Gracias, $nombre. Nos comunicaremos contigo al $telefono</p>";
    echo "<p>Vehículo solicitado: $vehiculo</p>";
    echo "<p>Retiro: $retiro</p>";
    echo "<p>Devolución: $devolucion</p>";
} else {
    echo "Acceso no permitido.";
}
?>
