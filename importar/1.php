<?php
require_once("header.php");
require_once("connect.php");
date_default_timezone_set("America/Lima");
?>
<!-- FORMULARIO PARA ESTE EJERCICIO -->
<div class="container">
    <h2>Cargar e importar archivo excel a MySQL</h2>
    <form name="importa" method="post" action="" enctype="multipart/form-data">
        <div class="col-xs-4">
            <div class="form-group">
                <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="excel">
            </div>
        </div>
        <div class="col-xs-2">
            <input class="btn btn-default btn-file" type='submit' name='enviar' value="Importar" />
        </div>
        <input type="hidden" value="upload" name="action" />
        <input type="hidden" value="usuarios" name="mod">
        <input type="hidden" value="masiva" name="acc">
    </form>

    <!-- PROCESO DE CARGA Y PROCESAMIENTO DEL EXCEL-->
    <?php
    extract($_POST);
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    }

    if (isset($action) && $action == "upload") {
        //cargamos el fichero
        $archivo = $_FILES['excel']['name'];
        $tipo = $_FILES['excel']['type'];
        $destino = "cop_" . $archivo; //Le agregamos un prefijo para identificarlo el archivo cargado
        if (copy($_FILES['excel']['tmp_name'], $destino)) echo "Archivo Cargado Con Éxito <br>";
        else echo "Error Al Cargar el Archivo ";

        if (file_exists("cop_" . $archivo)) {
            /** Llamamos las clases necesarias PHPEcel */
            require_once('Classes/PHPExcel.php');
            require_once('Classes/PHPExcel/Reader/Excel2007.php');
            // Cargando la hoja de excel
            $objReader = new PHPExcel_Reader_Excel2007();
            $objPHPExcel = $objReader->load("cop_" . $archivo);
            $objFecha = new PHPExcel_Shared_Date();
            // Asignamon la hoja de excel activa

            $sheetCount = $objPHPExcel->getSheetCount();

            // Importante - conexión con la base de datos 


            // Rellenamos el arreglo con los datos  del archivo xlsx que ha sido subido

            for ($sheetIndex = 0; $sheetIndex < $sheetCount; $sheetIndex++) {
                $objPHPExcel->setActiveSheetIndex($sheetIndex);
                $columnas = $objPHPExcel->getActiveSheet()->getHighestColumn();
                $filas = $objPHPExcel->getActiveSheet()->getHighestRow();

                echo "<h3>Hoja " . ($sheetIndex + 1) . "</h3>";

                echo '<table border="1" class="table">';
                echo '<thead>';
                echo '<tr>';

                for ($col = 'A'; $col <= $columnas; $col++) {
                    echo '<th>' . $col . '</th>';
                }

                echo '</tr> ';
                echo '</thead> ';
                echo '<tbody> ';

                for ($i = 1; $i <= $filas; $i++) {
                    echo '<tr>';

                    for ($col = 'A'; $col <= $columnas; $col++) {
                        $value = $objPHPExcel->getActiveSheet()->getCell($col . $i)->getValue();
                        echo '<td>' . $value . '</td>';
                    }

                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            }

            //Borramos el archivo que esta en el servidor con el prefijo cop_
            unlink($destino);

            echo "<hr> <div class='col-xs-12'>
            <div class='form-group'>";
            echo "<strong><center>ARCHIVO IMPORTADO CON EXITO</center></strong>";
            echo "</div>
    </div>  ";
        } else {
            echo "Primero debes cargar el archivo con extencion .xlsx";
        }
    }
    ?>
</div>
<?php
include("footer.php");
?>