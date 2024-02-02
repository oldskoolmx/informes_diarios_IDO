<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatgpt";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT CASE WHEN departamento.nombre_departamento IS NULL THEN 'Total' ELSE departamento.nombre_departamento END AS nombre_departamento,
       COUNT(CASE WHEN empleado.edad BETWEEN 20 AND 29 THEN 1 END) AS empleados_20_29,
       COUNT(CASE WHEN empleado.edad BETWEEN 30 AND 39 THEN 1 END) AS empleados_30_39,
       COUNT(CASE WHEN empleado.edad BETWEEN 40 AND 49 THEN 1 END) AS empleados_40_49,
       COUNT(empleado.id_empleado) AS total_empleados,
       SUM(salario.monto_salario) AS total_salarios
FROM departamentos departamento
INNER JOIN empleados empleado ON departamento.id_departamento = empleado.id_departamento
INNER JOIN salarios salario ON empleado.id_empleado = salario.id_empleado
GROUP BY departamento.nombre_departamento
WITH ROLLUP";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una tabla
    echo "<table>";
    echo "<tr>
              <th>Departamento</th>
              <th>Empleados (20-29)</th>
              <th>Empleados (30-39)</th>
              <th>Empleados (40-49)</th>
              <th>Total Empleados</th>
              <th>Total Salarios</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nombre_departamento'] . "</td>";
        echo "<td>" . $row['empleados_20_29'] . "</td>";
        echo "<td>" . $row['empleados_30_39'] . "</td>";
        echo "<td>" . $row['empleados_40_49'] . "</td>";
        echo "<td>" . $row['total_empleados'] . "</td>";
        echo "<td>" . $row['total_salarios'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar conexión
$conn->close();
?>
