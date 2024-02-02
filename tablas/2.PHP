<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 4. Tablas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

    <h3>Análisis de ventas</h3>

    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered table-hover">
                    <caption>Análisis de ventas anuales</caption>
                    <thead>
                        <tr>
                            <th rowspan="2" scope="col">AÑO</th>
                            <th colspan="2" scope="col">Expansión de ventas</th>
                            <th colspan="2" scope="col">Expansión de ventas 2</th>
                        </tr>
                        <tr>
                            <th scope="col">Producto A</th>
                            <th scope="col">Producto B</th>
                            <th scope="col">Producto C</th>
                            <th scope="col">Producto D</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th rowspan="2" scope="col">AÑO</th>
                            <th scope="col">Producto A</th>
                            <th scope="col">Producto B</th>
                            <th scope="col">Producto C</th>
                            <th scope="col">Producto D</th>
                        </tr>
                        <tr>
                            <th colspan="4" scope="col">Expansión de ventas</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <tr>
                            <th scope="row">N-3</th>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <th scope="row">N-2</th>
                            <td>3</td>
                            <td>5</td>
                            <td>8</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <th scope="row">N-1</th>
                            <td>4</td>
                            <td>4</td>
                            <td>7</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">N</th>
                            <td>5</td>
                            <td>7</td>
                            <td>6</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>