<?php include ("../../bd.php"); 

if($_POST){

    // recolectar datos metodo post
    $recinto=(isset($_POST["recinto"])?$_POST["recinto"]:"");
    // preparar la insercion de los datos
    $sentencia = $conexion->prepare("INSERT INTO recinto (recinto) VALUES (:recinto)");
    // Asignando los valores q vienen del metodo post
    $sentencia->bindParam(":recinto", $recinto);  
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
        
        <h4>Agregar Recinto</h4>
        <form action="" method="post" enctype="multipart/form-data">
        
            <div class="mb-3">
                <label for="recinto">Recinto:</label>
                <input type="text" class="form-control" id="recinto" name="recinto">
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