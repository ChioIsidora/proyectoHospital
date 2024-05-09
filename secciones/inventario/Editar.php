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

<br/>
<div class="card">
<div class="card-header">Formulario de Registro de Bienes</div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">

                    <div class="mb-1">
                    <label for="IDinventario">ID:</label>
                    <input type="text" value="<?php echo $IDinventario;?>" class="form-control" readonly id="IDinventario" name="IDinventario">
                    </div>

                    <div class="mb-1">
                        <label for="nombre">Nombre del Bien (*):</label>
                        <input type="text" value="<?php echo $nombre;?>"class="form-control" id="nombre" name="nombre" require>
                    </div>
                    <div class="mb-1">
                        <label for="ValorInicial">Valor Inicial del Bien (*): $</label>
                        <input type="number" value="<?php echo $ValorInicial;?>" class="form-control" id="ValorInicial" name="ValorInicial" require>
                    </div>
                    <div class="mb-1">
                        <label for="CCSIGFE">Cuenta Contable SIGFE (*):</label>
                        <input type="text" value="<?php echo $CCSIGFE;?>" class="form-control" id="CCSIGFE" name="CCSIGFE" require>
                    </div>
                    <div class="mb-1">
                        <label for="estado">Estado (*):</label>
                        <select class="form-control" id="estado" name="estado">
                        <option value="seleccionar">Seleccionar</option>
                            <?php foreach ($lista_estado as $registro) {   ?>
                            <option <?php echo ($estado== $registro['Idestado'])?"selected":""?> value="<?php echo $registro['Idestado']?>"> 
                                <?php echo $registro['estado']?></option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="servicio">Servicio de Destino (*):</label>
                        <select class="form-control" id="servicio" name="servicio">
                            <option  value="seleccionar">Seleccionar</option>
                            <?php foreach ($lista_servicios as $registro) {   ?>
                            <option <?php echo ($servicio== $registro['Idservicio'])?"selected":""?> value="<?php echo $registro['Idservicio']?>">
                                <?php echo $registro['servicio']?></option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="recinto">Recinto (*):</label>
                        <select class="form-control" id="recinto" name="recinto">
                        <option  value="seleccionar">Seleccionar</option>
                            <?php foreach ($lista_recinto as $registro) {   ?>
                            <option <?php echo ($recinto== $registro['Idrecinto'])?"selected":""?> value="<?php echo $registro['Idrecinto']?>">
                                <?php echo $registro['recinto']?></option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="proveedor">Proveedor:</label>
                        <input type="text" value="<?php echo $proveedor;?>" class="form-control" id="proveedor" name="proveedor">
                    </div>
                    <div class="mb-1">
                        <label for="marca">Marca:</label>
                        <input type="text" value="<?php echo $marca;?>" class="form-control" id="marca" name="marca">
                    </div>
                    <div class="mb-1">
                        <label for="modelo">Modelo:</label>
                        <input type="text" value="<?php echo $modelo;?>" class="form-control" id="modelo" name="modelo">
                    </div>
                    <div class="mb-1">
                        <label for="trespaldo">Tipo Documento de respaldo (*):</label>
                        <select class="form-control" id="trespaldo" name="trespaldo">
                        <option value="seleccionar">Seleccionar</option>
                            <?php foreach ($lista_trespaldo as $registro) {   ?>
                            <option <?php echo ($trespaldo== $registro['IdTrespaldo'])?"selected":""?> value="<?php echo $registro['IdTrespaldo']?>">
                                <?php echo $registro['Trespaldo']?></option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="documentorespaldo">N° de Documento de Respaldo:</label>
                        <input type="text" value="<?php echo $documentorespaldo;?>" class="form-control" id="documentorespaldo" name="documentorespaldo" require>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-1">
                        <label for="fechaingreso">Fecha de ingreso:</label>
                        <input type="date" value="<?php echo $fechaingreso;?>" class="form-control" id="fechaingreso" name="fechaingreso" require>
                    </div>
                    <div class="mb-1">
                        <label for="vidautil">Vida Útil (meses):</label>
                        <input type="number" value="<?php echo $vidautil;?>" class="form-control" id="vidautil" name="vidautil" require>
                    </div>
                    <div class="mb-1">
                        <label for="valorcomercial">Valor Comercial del Bien: $</label>
                        <input type="number" value="<?php echo $valorcomercial;?>" class="form-control" id="valorcomercial" name="valorcomercial">
                    </div>
                    <div class="mb-1">
                        <label for="valoractual">Valor Actual del Bien (Depreciado): $ </label>
                        <input type="number" value="<?php echo $valoractual;?>" class="form-control" id="valoractual" name="valoractual">
                    </div>
                    <div class="mb-1">
                            <label for="valormensual">Valor depreciacion mensual: $</label>
                            <input type="text" class="form-control" id="valormensual" name="valormensual" readonly>
                    </div>

                    <div class="mb-1">
                            <label for="valoranual">Valor depreciacion anual: $</label>
                            <input type="text" class="form-control" id="valoranual" name="valoranual" readonly>
                    </div>
                    <div class="mb-1">
                        <label for="adquisicion">Tipo de Adquisición:</label>
                        <select class="form-control" id="adquisicion" name="adquisicion">
                        <option value="seleccionar">Seleccionar</option>
                            <?php foreach ($lista_adquisicion as $registro) {   ?>
                            <option <?php echo ($adquisicion== $registro['Idadquisicion'])?"selected":""?> value="<?php echo $registro['Idadquisicion']?>">
                                <?php echo $registro['adquisicion']?></option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="calidadjuridica">Calidad jurídica del Bien:</label>
                        <select class="form-control" id="calidadjuridica" name="calidadjuridica">
                        <option value="seleccionar">Seleccionar</option>
                            <?php foreach ($lista_calidadjuridica as $registro) {   ?>
                            <option <?php echo ($calidadjuridica== $registro['Idcalidadjuridica'])?"selected":""?> value="<?php echo $registro['Idcalidadjuridica']?>">
                                <?php echo $registro['calidadjuridica']?></option>
                             <?php } ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="mantencion">Mantención Preventiva:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mantencion" id="mantencion_si" value="si" <?php echo ($mantencion == 's') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="mantencion_si">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mantencion" id="mantencion_no" value="no" <?php echo ($mantencion == 'n') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="mantencion_no">No</label>
                        </div>
                    </div>
                    
                    <div class="mb-1">
                        <label for="numeromantencion">Periodicidad de la Mantención Preventiva:</label>
                        <input type="text" value="<?php echo $numeromantencion;?>" class="form-control" id="numeromantencion" name="numeromantencion">
                    </div>
                    <div class="mb-1">
                        <label for="observaciones">Observaciones:</label>
                        <textarea class="form-control" value="<?php echo $observaciones;?>" id="observaciones" name="observaciones" rows="3"></textarea>
                    </div>
                </div>
            </div>
              <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <br/>
                <img width="100" 
                    src="img/<?php echo $foto; ?>" 
                    class="rounded" alt=""/>
                    <br/> <br/>
                <input
                  type="file"
                  class="form-control"
                  name="foto"
                  id="foto"
                  aria-describedby="helpId"
                  placeholder="foto"
                />
              </div>

              <div class="mb-3">
                <label for="documento" class="form-label">Documento de respaldo</label>
                <br/>
                <a href="documento/<?php echo $documento;?>"><?php echo $documento;?></a>
                <input
                  type="file"
                  class="form-control"
                  name="documento"
                  id="documento"
                  aria-describedby="helpId"
                  placeholder="documento"
                />
              </div>
              <div class="mb-3">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a
      name="cancelar"
      id="cancelar"
      class="btn btn-danger"
      href="index.php"
      role="button"
      >Cancelar</a
    >


        </form>

    </div>

<?php include ('../../templates/footer.php');?>