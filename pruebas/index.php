<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combo Box Dependiente</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <form>
        <label for="category">Categoría:</label>
        <select name="category" id="category">
            <option value="">Selecciona una categoría</option>
            <option value="1">Categoría 1</option>
            <option value="2">Categoría 2</option>
            <option value="3">Categoría 3</option>
        </select>

        <div id="subCategoryContainer">
            <!-- Combo Box de subcategorías se cargará aquí -->
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#category').change(function() {
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        type: 'POST',
                        url: 'get_subcategorias.php',
                        data: 'category_id=' + categoryID,
                        success: function(html) {
                            $('#subCategoryContainer').html(html);
                        }
                    });
                } else {
                    $('#subCategoryContainer').html('<select name="subcategory" id="subcategory"><option value="">Selecciona una subcategoría</option></select>');
                }
            });
        });
    </script>

</body>

</html>