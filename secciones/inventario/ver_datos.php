<?php include ("../../bd.php"); 

if (isset($_GET['IDinventario'])) {
    $IDinventario = isset($_GET['IDinventario']) ? $_GET['IDinventario'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM activos WHERE IDinventario=:IDinventario");
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

    // Obtener listas de opciones (estados, servicios, recintos, etc.)
    $sentencia = $conexion->prepare("SELECT * FROM estado");
    $sentencia->execute();
    $lista_estado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = $conexion->prepare("SELECT * FROM servicios");
    $sentencia->execute();
    $lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = $conexion->prepare("SELECT * FROM recinto");
    $sentencia->execute();
    $lista_recinto = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = $conexion->prepare("SELECT * FROM trespaldo");
    $sentencia->execute();
    $lista_trespaldo = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = $conexion->prepare("SELECT * FROM adquisicion");
    $sentencia->execute();
    $lista_adquisicion = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = $conexion->prepare("SELECT * FROM calidadjuridica");
    $sentencia->execute();
    $lista_calidadjuridica = $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

if ($_POST) {
    // Recolectar datos del método POST
    $IDinventario = isset($_POST['IDinventario']) ? $_POST['IDinventario'] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $ValorInicial = isset($_POST["ValorInicial"]) ? $_POST["ValorInicial"] : "";
    $CCSIGFE = isset($_POST["CCSIGFE"]) ? $_POST["CCSIGFE"] : "";
    $estado = isset($_POST["estado"]) ? $_POST["estado"] : "";
    $servicio = isset($_POST["servicio"]) ? $_POST["servicio"] : "";
    $recinto = isset($_POST["recinto"]) ? $_POST["recinto"] : "";
    $proveedor = isset($_POST["proveedor"]) ? $_POST["proveedor"] : "";
    $marca = isset($_POST["marca"]) ? $_POST["marca"] : "";
    $modelo = isset($_POST["modelo"]) ? $_POST["modelo"] : "";
    $trespaldo = isset($_POST["trespaldo"]) ? $_POST["trespaldo"] : "";
    $documentorespaldo = isset($_POST["documentorespaldo"]) ? $_POST["documentorespaldo"] : "";
    $fechaingreso = isset($_POST["fechaingreso"]) ? $_POST["fechaingreso"] : "";
    $vidautil = isset($_POST["vidautil"]) ? $_POST["vidautil"] : "";
    $valorcomercial = isset($_POST["valorcomercial"]) ? $_POST["valorcomercial"] : "";
    $adquisicion = isset($_POST["adquisicion"]) ? $_POST["adquisicion"] : "";
    $calidadjuridica = isset($_POST["calidadjuridica"]) ? $_POST["calidadjuridica"] : "";
    $mantencion = isset($_POST["mantencion"]) ? $_POST["mantencion"] : "";
    $numeromantencion = isset($_POST["numeromantencion"]) ? $_POST["numeromantencion"] : "";
    $observaciones = isset($_POST["observaciones"]) ? $_POST["observaciones"] : "";

    try {
    // Preparar la sentencia de actualización
    $sentencia = $conexion->prepare("
        UPDATE activos 
        SET
            nombre=:nombre,
            ValorInicial=:ValorInicial,
            CCSIGFE=:CCSIGFE,
            estado=:estado,
            servicio=:servicio,
            recinto=:recinto,
            proveedor=:proveedor,
            marca=:marca,
            modelo=:modelo,
            trespaldo=:trespaldo,
            documentorespaldo=:documentorespaldo,
            fechaingreso=:fechaingreso,
            vidautil=:vidautil,
            valorcomercial=:valorcomercial,
            adquisicion=:adquisicion,
            calidadjuridica=:calidadjuridica,
            mantencion=:mantencion,
            numeromantencion=:numeromantencion,
            observaciones=:observaciones
        WHERE IDinventario=:IDinventario
    ");

    // Asignar los valores que vienen del método POST
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":ValorInicial", $ValorInicial);
    $sentencia->bindParam(":CCSIGFE", $CCSIGFE);
    $sentencia->bindParam(":estado", $estado);
    $sentencia->bindParam(":servicio", $servicio);
    $sentencia->bindParam(":recinto", $recinto);
    $sentencia->bindParam(":proveedor", $proveedor);
    $sentencia->bindParam(":marca", $marca);
    $sentencia->bindParam(":modelo", $modelo);
    $sentencia->bindParam(":trespaldo", $trespaldo);
    $sentencia->bindParam(":documentorespaldo", $documentorespaldo);
    $sentencia->bindParam(":fechaingreso", $fechaingreso);
    $sentencia->bindParam(":vidautil", $vidautil);
    $sentencia->bindParam(":valorcomercial", $valorcomercial);
    $sentencia->bindParam(":adquisicion", $adquisicion);
    $sentencia->bindParam(":calidadjuridica", $calidadjuridica);
    $sentencia->bindParam(":mantencion", $mantencion);
    $sentencia->bindParam(":numeromantencion", $numeromantencion);
    $sentencia->bindParam(":observaciones", $observaciones);
    $sentencia->bindParam(":IDinventario", $IDinventario);


    // Ejecutar la sentencia
    $sentencia->execute();
    $mensaje = "Registro Editado correctamente";

    // actualizar foto y documento
    $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");

    $fecha_foto= new DateTime();
    $nombreArchivo_foto = ($foto != '') ? $fecha_foto->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
    $tmp_foto = $_FILES["foto"]['tmp_name'];
    if ($tmp_foto != '') {
        move_uploaded_file($tmp_foto, "img/" . $nombreArchivo_foto);
    $sentencia = $conexion->prepare("SELECT foto FROM activos WHERE IDinventario=:IDinventario");
    $sentencia->bindParam(":IDinventario", $IDinventario);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
        if(file_exists("img/".$registro_recuperado["foto"])){
            unlink("img/".$registro_recuperado["foto"]);
        }
    }
        $sentencia = $conexion->prepare("UPDATE activos SET foto=:foto WHERE IDinventario=:IDinventario");
        $sentencia->bindParam(":foto", $nombreArchivo_foto);
        $sentencia->bindParam(":IDinventario", $IDinventario);
        $sentencia->execute();
    }

    $documento=(isset($_FILES["documento"]['name'])?$_FILES["documento"]['name']:"");
    $fecha_documento= new DateTime();
    $nombreArchivo_documento = ($documento != '') ? $fecha_documento->getTimestamp() . "_" . $_FILES["documento"]['name'] : "";
    $tmp_documento = $_FILES["documento"]['tmp_name'];
    if ($tmp_documento != '') {
        move_uploaded_file($tmp_documento, "documento/" . $nombreArchivo_documento);
        $sentencia = $conexion->prepare("SELECT documento FROM activos WHERE IDinventario=:IDinventario");
        $sentencia->bindParam(":IDinventario", $IDinventario);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
    if(isset($registro_recuperado["documento"]) && $registro_recuperado["documento"]!=""){
        if(file_exists("documento/".$registro_recuperado["documento"])){
                unlink("documento/".$registro_recuperado["documento"]);
        } 
    }
    $sentencia = $conexion->prepare("UPDATE activos SET documento=:documento WHERE IDinventario=:IDinventario");
    $sentencia->bindParam(":documento", $nombreArchivo_documento);
    $sentencia->bindParam(":IDinventario", $IDinventario);
    $sentencia->execute();
    }

    
    } catch (PDOException $e) {
        // Capturar el mensaje de error
        $mensaje = "Error al insertar registro: " . $e->getMessage();
    }
    // Redireccionar la página con el mensaje
    header("Location: index.php?mensaje=" . urlencode($mensaje));

}

?>

<?php include ('../../templates/header.php');?>






<!-- Crea el modal -->
<div class="modal fade" id="verDetallesModal<?php echo $IDinventario; ?>" tabindex="-1" role="dialog" aria-labelledby="verDetallesModalLabel<?php echo $IDinventario; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verDetallesModalLabel<?php echo $IDinventario; ?>">Detalles del Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Incluye aquí el código PHP para mostrar los detalles del registro -->
        <p><strong>ID:</strong> <?php echo $IDinventario; ?></p>
        <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
        <p><strong>Valor Inicial:</strong> <?php echo $ValorInicial; ?></p>
        <p><strong>Cuenta Contable SIGFE:</strong> <?php echo $CCSIGFE; ?></p>
        <p><strong>Estado:</strong> <?php echo $estado; ?></p>
        <p><strong>Servicio de Destino:</strong> <?php echo $servicio; ?></p>
        <p><strong>Recinto:</strong> <?php echo $recinto; ?></p>
        <p><strong>Proveedor:</strong> <?php echo $proveedor; ?></p>
        <p><strong>Marca:</strong> <?php echo $marca; ?></p>
        <p><strong>Modelo:</strong> <?php echo $modelo; ?></p>
        <p><strong>Tipo Documento de respaldo:</strong> <?php echo $trespaldo; ?></p>
        <p><strong>N° de Documento de Respaldo:</strong> <?php echo $documentorespaldo; ?></p>
        <p><strong>Fecha de ingreso:</strong> <?php echo $fechaingreso; ?></p>
        <p><strong>Vida Útil (meses):</strong> <?php echo $vidautil; ?></p>
        <p><strong>Valor Comercial del Bien:</strong> <?php echo $valorcomercial; ?></p>
        <p><strong>Tipo de Adquisición:</strong> <?php echo $adquisicion; ?></p>
        <p><strong>Calidad jurídica del Bien:</strong> <?php echo $calidadjuridica; ?></p>
        <p><strong>Mantención Preventiva:</strong> <?php echo ($mantencion == 's') ? 'Sí' : 'No'; ?></p>
        <p><strong>Periodicidad de la Mantención Preventiva:</strong> <?php echo $numeromantencion; ?></p>
        <p><strong>Observaciones:</strong> <?php echo $observaciones; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>