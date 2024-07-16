<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "parking";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id_Cajon, Hora_Salida, Hora_Entrada, N_Nivel, Tiempo_Transcurrido FROM niveles";
$result = $conn->query($sql);

$datos = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
} 

$conn->close();

echo json_encode(array("datos" => $datos));
?>
