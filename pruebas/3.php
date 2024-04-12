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
</tr>"; // 7

$totalVueltasPerdidas = 0; // Variable para almacenar el total de vueltas perdidas // 8

if ($result->num_rows > 0) { // 9
    // Iterar sobre cada fila de resultados
    while ($row = $result->fetch_assoc()) { // 10
        $texto = $row["descripcion"]; // 11
        $id = $row["id"]; // 12
        $linea = $row["linea"]; // 12
        $hora = $row["hora"]; // 13

        // Buscar la posición de la palabra "Pierde"
        $posicionPierde = strpos($texto, "Pierde"); // 14

        // Obtener la subcadena a partir de la posición de "Pierde"
        $subcadena = substr($texto, $posicionPierde); // 15

        // Utilizar expresiones regulares para encontrar el número de vueltas
        //if (preg_match("/\d+ vueltas?/", $subcadena, $matches)) { // 16
        //if (preg_match("/\d+(\.\d+)? vueltas?/", $subcadena, $matches)) { // 16
        // if (preg_match("/\d*\.?\d+ vueltas?/", $subcadena, $matches)) { // 16
        //if (preg_match("/\b\d*\.?\d+\s?vueltas?/", $subcadena, $matches)) {
        //if (preg_match("/\b\d*\.?\d+\s?vueltas?/", $subcadena, $matches)) {
        /* if (preg_match("/\b\d*\.?\d+\s?(vueltas?)?/", $subcadena, $matches)) {

            // Extraer solo el número de vueltas encontrado
            $vueltasPerdidas = (float)$matches[0]; // 17
            // Sumar las vueltas perdidas al total
            $totalVueltasPerdidas += $vueltasPerdidas; // 18

            // Mostrar el texto y el total de vueltas perdidas en la tabla
            echo "<tr>
            <td>$id</td>
            <td>$linea</td>
            <td>$hora</td>
            <td>$texto</td>
            <td>$vueltasPerdidas vueltas</td>
            </tr>"; // 19
        } */

        if (preg_match_all("/\b\d*\.?\d+\s?vueltas?/", $texto, $matches)) {
            foreach ($matches[0] as $vueltas) {
                // Extraer solo el número de vueltas encontrado
                $numero_vueltas = (float) filter_var($vueltas, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                // Sumar las vueltas perdidas al total
                $totalVueltasPerdidas += $numero_vueltas;
            }
            // Mostrar el texto y el total de vueltas perdidas en la tabla
            echo "<tr><td>$id</td><td>$linea</td><td>$hora</td><td>$texto</td><td>$numero_vueltas</td></tr>";
        }
    }

    // Imprimir el total de vueltas perdidas después de terminar de iterar
    echo "<tr>
    <td><b>Total</b></td><td>$totalVueltasPerdidas vueltas</td></tr>"; // 20
} else {
    echo "<tr><td colspan='2'>No se encontraron resultados en la base de datos.</td></tr>"; // 21
}

echo "</table>"; // 22

$conn->close(); // 23

/* ## 🗒️ Answer
Se ha modificado el código para contar también cuando haya una vuelta o menos, además de las vueltas mayores a una en el texto.

## 🌐 Sources
1. [PHP Manual - mysqli::__construct](https://www.php.net/manual/en/mysqli.construct.php)
2. [PHP Manual - mysqli::connect_error](https://www.php.net/manual/en/mysqli.connect-error.php)
3. [PHP Manual - die](https://www.php.net/manual/en/function.die.php)
4. [PHP Manual - mysqli::query](https://www.php.net/manual/en/mysqli.query.php)
5. [PHP Manual - preg_match](https://www.php.net/manual/en/function.preg-match.php)
</response> */
