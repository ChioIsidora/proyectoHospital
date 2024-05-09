<?php include ("../../bd.php"); 

if($_POST){

    // recolectar datos metodo post
    $tipobien=(isset($_POST["tipobien"])?$_POST["tipobien"]:"");
    // preparar la insercion de los datos
    $sentencia = $conexion->prepare("INSERT INTO tipobien (tipobien) VALUES (:tipobien)");
    // Asignando los valores q vienen del metodo post
    $sentencia->bindParam(":tipobien", $tipobien);  
    try {
        // Ejecutar la sentencia
        $sentencia->execute();
        $mensaje = "Registro Agregado";
    } catch (PDOException $e) {
        // Capturar el mensaje de error
        $mensaje = "Error al insertar registro: " . $e->getMessage();
    }
    // Redireccionar la página con el mensaje
    header("Location: index.php?mensaje=" . urlencode($mensaje));

}


?>

<?php include ("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-body">
        
        <h4>Agregar Tipo</h4>
        <form action="" method="post" enctype="multipart/form-data">
        
            <div class="mb-3">
                <label for="tipobien">Tipo de bien:</label>
                <input type="text" class="form-control" id="tipobien" name="tipobien">
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-primary">Agregar</button>
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

</div>

<?php include ("../../templates/footer.php"); ?>