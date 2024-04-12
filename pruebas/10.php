<?php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "ido";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los textos
$sql = "SELECT * FROM idos";

$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>Id</th><th>Hora</th><th>Texto</th><th>Total de Vueltas Perdidas</th></tr>";

$totalVueltasPerdidas = 0; // Variable para almacenar el total de vueltas perdidas

if ($result->num_rows > 0) {
    // Iterar sobre cada fila de resultados
    while ($row = $result->fetch_assoc()) {
        $texto = $row["descripcion"];
        $id = $row["id"];
        $linea = $row["linea"];
        $hora = $row["hora"];

        // Buscar la posición de la palabra "Pierde"
        $posicionPierde = strpos($texto, "Pierde");

        // Obtener la subcadena a partir de la posición de "Pierde"
        $subcadena = substr($texto, $posicionPierde);

        // Utilizar expresiones regulares para encontrar el número de vueltas
        if (preg_match("/(?:\d+)?\.?\d+ vuelta/i", $subcadena, $matches)) {
            // Extraer solo el número de vueltas encontrado
            $vueltasPerdidas = floatval(preg_replace('/[^0-9.]/', '', $matches[0]));
            // Sumar las vueltas perdidas al total
            $totalVueltasPerdidas += $vueltasPerdidas;

            // Mostrar el texto y el total de vueltas perdidas en la tabla
            if ($vueltasPerdidas <= 1) {
                echo "<tr><td>$id</td><td>$linea</td><td>$hora</td><td>$texto</td><td>" . number_format($vueltasPerdidas, 2) . " vueltas</td></tr>";
            }
        }
    }

    // Imprimir el total de vueltas perdidas después de terminar de iterar
    echo "<tr><td><b>Total</b></td><td>$totalVueltasPerdidas vueltas</td></tr>";
} else {
    echo "<tr><td colspan='2'>No se encontraron resultados en la base de datos.</td></tr>";
}

echo "</table>";

$conn->close();
