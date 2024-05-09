<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Incluir la librería QRcode
require '../../phpqrcode/qrlib.php';

// Directorio donde se almacenarán los códigos QR
$dir = 'temp/';

if (!file_exists($dir))
    mkdir($dir);

if (isset($_GET['IDinventario'])) {
    $IDinventario = $_GET['IDinventario'];
    
    // Preparar la consulta utilizando PDO
    $sentencia = $conexion->prepare("SELECT * FROM activos WHERE IDinventario=:IDinventario");
    $sentencia->bindParam(":IDinventario", $IDinventario);
    $sentencia->execute();

    // Obtener el resultado de la consulta
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron registros
    if ($registro) {
        // Generar el nombre de archivo para el código QR basado en el ID de inventario
        $filename = $dir . 'qr_' . $IDinventario . '.png';

        // Tamaño y nivel de corrección de error para el código QR
        $tamanio = 10;
        $level = 'H';
        $frameSize = 3;

        // Contenido del código QR (en este caso, el ID de inventario)
        $contenido = $IDinventario;

        // Generar el código QR
        QRcode::png($contenido, $filename, $level, $tamanio, $frameSize);

        // Mostrar el código QR en la página
        echo '<img src="' . $filename . '" />';
    } else {
        echo "No se encontró ningún activo con el ID de inventario proporcionado.";
    }
} else {
    echo "No se proporcionó ningún ID de inventario.";
}
?>