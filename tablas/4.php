<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 4. Tablas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>TABLA DE INTERRUPCIONES</h1>
                <div class="table-responsive">
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

                    // Consulta SQL para obtener los datos por departamento
                    $sql = "SELECT departamento.nombre_departamento, 
                            COUNT(CASE WHEN empleado.edad BETWEEN 20 AND 29 THEN 1 END) AS empleados_20_29,
                            COUNT(CASE WHEN empleado.edad BETWEEN 30 AND 39 THEN 1 END) AS empleados_30_39,
                            COUNT(CASE WHEN empleado.edad BETWEEN 40 AND 49 THEN 1 END) AS empleados_40_49,
                            COUNT(empleado.id_empleado) AS total_empleados,
                            SUM(salario.monto_salario) AS total_salarios
                            FROM departamentos departamento
                            INNER JOIN empleados empleado ON departamento.id_departamento = empleado.id_departamento
                            INNER JOIN salarios salario ON empleado.id_empleado = salario.id_empleado
                            GROUP BY departamento.nombre_departamento";

                    // Ejecutar la consulta para obtener los datos por departamento
                    $result = $conn->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Mostrar los resultados por departamento en una tabla
                        echo '<h2>Resultados por Departamento</h2>';
                        echo '<table class="table table-striped">';
                        echo '<thead class="thead-dark">
                                <tr>
                                    <th>Departamento</th>
                                    <th>Empleados (20-29)</th>
                                    <th>Empleados (30-39)</th>
                                    <th>Empleados (40-49)</th>
                                    <th>Total Empleados</th>
                                    <th>Total Salarios</th>
                                </tr>
                            </thead>';
                        echo '<tbody>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['nombre_departamento'] . '</td>';
                            echo '<td>' . $row['empleados_20_29'] . '</td>';
                            echo '<td>' . $row['empleados_30_39'] . '</td>';
                            echo '<td>' . $row['empleados_40_49'] . '</td>';
                            echo '<td>' . $row['total_empleados'] . '</td>';
                            echo '<td>' . $row['total_salarios'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '<tfoot>';

                        // Consulta SQL para obtener el total general
                        $sql_total = "SELECT 
                                        COUNT(CASE WHEN empleado.edad BETWEEN 20 AND 29 THEN 1 END) AS total_empleados_20_29,
                                        COUNT(CASE WHEN empleado.edad BETWEEN 30 AND 39 THEN 1 END) AS total_empleados_30_39,
                                        COUNT(CASE WHEN empleado.edad BETWEEN 40 AND 49 THEN 1 END) AS total_empleados_40_49,
                                        COUNT(empleado.id_empleado) AS total_empleados,
                                        SUM(salario.monto_salario) AS total_salarios
                                        FROM empleados empleado
                                        INNER JOIN salarios salario ON empleado.id_empleado = salario.id_empleado";

                        // Ejecutar la consulta para obtener el total general
                        $result_total = $conn->query($sql_total);

                        // Verificar si hay resultados
                        if ($result_total->num_rows > 0) {
                            // Mostrar el total general en una tabla

                            $row_total = $result_total->fetch_assoc();
                            echo '<tr>';
                            echo '<td> TOTAL</td>';
                            echo '<td>' . $row_total['total_empleados_20_29'] . '</td>';
                            echo '<td>' . $row_total['total_empleados_30_39'] . '</td>';
                            echo '<td>' . $row_total['total_empleados_40_49'] . '</td>';
                            echo '<td>' . $row_total['total_empleados'] . '</td>';
                            echo '<td>' . $row_total['total_salarios'] . '</td>';
                            echo '</tr>';
                            echo '</tfoot>';
                            echo '</table>';
                        }
                    } else {
                        echo "No se encontraron resultados.";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>