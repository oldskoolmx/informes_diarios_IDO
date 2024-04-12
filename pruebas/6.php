<?php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "ido";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database); // 1

// Verificar conexión
if ($conn->connect_error) { // 2
    die("Connection failed: " . $conn->connect_error); // 3
}

// Consulta SQL para obtener todos los textos
$sql = "SELECT * FROM idos"; // 4

$result = $conn->query($sql); // 5

echo "<table border='1'>"; // 6
echo "<tr>
<th>Id</th>
<th>Linea</th>
<th>Hora</th>
<th>Texto</th>
<th>Vueltas Perdidas</th>
<th>Número de Vueltas Perdidas</th>
</tr>"; // 7

$totalVueltasPerdidas = 0; // Variable para almacenar el total de vueltas perdidas // 8

if ($result->num_rows > 0) { // 9
    // Iterar sobre cada fila de resultados
    while ($row = $result->fetch_assoc()) { // 10
        $texto = $row["descripcion"]; // 11
        $id = $row["id"]; // 12
        $linea = $row["linea"]; // 13
        $hora = $row["hora"]; // 14

        // Buscar la posición de la palabra "Pierde" en el texto
        $posicionPierde = strpos($texto, "Pierde"); // 15

        // Si se encuentra la palabra "Pierde" en el texto
        if ($posicionPierde !== false) {
            // Utilizar expresiones regulares para encontrar el número de vueltas perdidas
            if (preg_match("/\b(\d+(?:\.\d+)?)\s?vueltas?/", $texto, $matches)) {
                // Extraer solo el número de vueltas encontrado
                $vueltasPerdidas = $matches[1];
            } else {
                $vueltasPerdidas = "No especificado";
            }

            // Mostrar el texto y el número de vueltas perdidas en la tabla
            echo "<tr>
            <td>$id</td>
            <td>$linea</td>
            <td>$hora</td>
            <td>$texto</td>
            <td>Perdida</td>
            <td>$vueltasPerdidas</td>
            </tr>"; // 16
        }
    }

    // No se necesita mostrar el total de vueltas perdidas aquí, ya que no se están contando
} else {
    echo "<tr><td colspan='6'>No se encontraron resultados en la base de datos.</td></tr>"; // 17
}

echo "</table>"; // 18

$conn->close(); // 19
