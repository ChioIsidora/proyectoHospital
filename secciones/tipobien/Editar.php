<?php
include ("../../bd.php");

if(isset($_GET['Idtipobien'])) {
    $Idtipobien = isset($_GET['Idtipobien']) ? $_GET['Idtipobien'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tipobien WHERE Idtipobien=:Idtipobien");
    $sentencia->bindParam(":Idtipobien", $Idtipobien);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $tipobien=$registro["tipobien"];
}
if($_POST){

    // recolectar datos metodo post
    $Idtipobien = isset($_POST['Idtipobien']) ? $_POST['Idtipobien'] : "";
    $tipobien=(isset($_POST["tipobien"])?$_POST["tipobien"]:"");
    // preparar la insercion de los datos

try {
    $sentencia = $conexion->prepare("UPDATE tipobien SET tipobien=:tipobien WHERE Idtipobien=:Idtipobien");
    
    // Asignando los valores q vienen del metodo post
    $sentencia->bindParam(":tipobien", $tipobien);  
    $sentencia->bindParam(":Idtipobien", $Idtipobien); 
    $sentencia->execute(); 
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
        
        <h4>Agregar Tipo de bien</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Idtipobien">Idtipobien:</label>
                <input type="text" value="<?php echo $Idtipobien;?>" class="form-control" readonly id="Idtipobien" name="Idtipobien">
            </div>
            <div class="mb-3">
                <label for="tipobien">Tipo de bien:</label>
                <input type="text" value="<?php echo $tipobien;?>" class="form-control" id="tipobien" name="tipobien">
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

</div>

<?php include ("../../templates/footer.php"); ?>