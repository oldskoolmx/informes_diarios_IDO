<?php
// Simulación de datos desde la base de datos
$subcategories = array(
    '1' => array('1' => 'Subcategoría 1.1', '2' => 'Subcategoría 1.2', '3' => 'Subcategoría 1.3'),
    '2' => array('4' => 'Subcategoría 2.1', '5' => 'Subcategoría 2.2', '6' => 'Subcategoría 2.3'),
    '3' => array('7' => 'Subcategoría 3.1', '8' => 'Subcategoría 3.2', '9' => 'Subcategoría 3.3')
);

if (isset($_POST['category_id'])) {
    $categoryID = $_POST['category_id'];
    if (isset($subcategories[$categoryID])) {
        echo '<label for="subcategory">Subcategoría:</label>';
        echo '<select name="subcategory" id="subcategory">';
        echo '<option value="">Selecciona una subcategoría</option>';
        foreach ($subcategories[$categoryID] as $key => $value) {
            echo '<option value="' . $key . '">' . $value . '</option>';
        }
        echo '</select>';
    } else {
        echo '<select name="subcategory" id="subcategory"><option value="">No hay subcategorías disponibles</option></select>';
    }
}
