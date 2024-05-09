<?php 
include ("../../bd.php"); 

if (isset($_GET['IDinventario'])) {
    $IDinventario = isset($_GET['IDinventario']) ? $_GET['IDinventario'] : "";

    $sentencia = $conexion->prepare("SELECT * ,(SELECT servicio FROM servicios WHERE servicios.Idservicio=activos.servicio limit 1) as servicio,
    (SELECT recinto FROM recinto WHERE recinto.Idrecinto=activos.recinto limit 1) as recinto FROM activos WHERE IDinventario=:IDinventario");
    $sentencia->bindParam(":IDinventario", $IDinventario);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);


    // Asignar valores a las variables
    $nombre = $registro["nombre"];
    $ValorInicial = $registro["ValorInicial"];
    $CCSIGFE = $registro["CCSIGFE"];
    $estado = $registro["estado"];
    $servicio = $registro["servicio"];
    $recinto = $registro["recinto"];
    $proveedor = $registro["proveedor"];
    $marca = $registro["marca"];
    $modelo = $registro["modelo"];
    $trespaldo = $registro["trespaldo"];
    $documentorespaldo = $registro["documentorespaldo"];
    $fechaingreso = $registro["fechaingreso"];
    $vidautil = $registro["vidautil"];
    $valorcomercial = $registro["valorcomercial"];
    $adquisicion = $registro["adquisicion"];
    $calidadjuridica = $registro["calidadjuridica"];
    $mantencion = $registro["mantencion"];
    $numeromantencion = $registro["numeromantencion"];
    $observaciones = $registro["observaciones"];
    $foto = $registro["foto"];
    $documento = $registro["documento"];

}

ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro del Bien</title>
</head>
<body>

<h4><?php echo $nombre?></h4>

Código de inventario: 33 - <?php echo $IDinventario?>
<br/><br/>


<img src="./temp/qr_<?php echo $IDinventario?>">


</body>
</html>

<?php

$HTML=ob_get_clean();

require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf= new Dompdf();
$opciones=$dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));
$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment"=>false));

?>

// no puedo linquear la imagen y hacer la etiqueta, hay que cambiar el tamaño del pdf del htlm