<?php

// Texto completo
$texto = "Tren 10 M-0690/0691 NM-16, es circulado desalojado de la Estación Isabel la Católica a la Terminal Pantitlán, donde se retira, por no contarse con Trenes disponibles para la operación, a través del CDV-83 de la zona de maniobras de Zaragoza, realizándose el comando para el movimiento del Aparato de Vía A23CZAR desde la IHM del Equipo ATS instalado en el TCO del PCC-C5, quedando debidamente estacionado en la posición G-7. Pierde 5.50 vueltas.";

// Buscar la posición de la palabra "Pierde"
$posicionPierde = strpos($texto, "Pierde");

// Obtener la subcadena a partir de la posición de "Pierde"
$subcadena = substr($texto, $posicionPierde);

// Utilizar expresiones regulares para encontrar el número de vueltas
if (preg_match("/[\d\.]+ vueltas/", $subcadena, $matches)) {
    // Extraer el número de vueltas encontrado
    $vueltasPerdidas = $matches[0];
    // Imprimir el resultado
    echo "El tren pierde: " . $vueltasPerdidas;
} else {
    // Si no se encuentra ninguna coincidencia
    echo "No se encontraron vueltas perdidas.";
}
