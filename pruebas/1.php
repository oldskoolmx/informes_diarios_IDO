<?php

// Texto completo
$texto = "Se establece el Servicio Provisional SP-1 de la Terminal Provisional Pino Suárez a la Terminal Pantitlán, hasta nuevo aviso, a fin de satisfacer la demanda del servicio, debido a la Modernización Integral de Trenes. Sistema de Control y Vías de Línea 1, efectuándolo 10 Trenes, dejándose de realizar .50 vueltas.";

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
