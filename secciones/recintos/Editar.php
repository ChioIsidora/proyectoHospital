<?php
include ("../../bd.php");

if(isset($_GET['recinto'])) {
    $Idrecinto = isset($_GET['Idrecinto']) ? $_GET['Idrecinto'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM recinto WHERE Idrecinto=:Idrecinto");
    $sentencia->bindParam(":Idrecinto", $Idrecinto);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $recinto=$registro["recinto"];
}
if($_POST){

    // recolectar datos metodo post
    $Idrecinto = isset($_POST['Idrecinto']) ? $_POST['Idrecinto'] : "";
    $recinto=(isset($_POST["recinto"])?$_POST["recinto"]:"");
    // preparar la insercion de los datos

try {
    $sentencia = $conexion->prepare("UPDATE recinto SET recinto=:recinto WHERE Idrecinto=:Idrecinto");
    
    // Asignando los valores q vienen del metodo post
    $sentencia->bindParam(":recinto", $recinto);  
    $sentencia->bindParam(":Idrecinto", $Idrecinto); 
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
        
        <h4>Agregar Recinto</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Idrecinto">Idrecinto:</label>
                <input type="text" value="<?php echo $Idrecinto;?>" class="form-control" readonly id="Idrecinto" name="Idrecinto">
            </div>
            <div class="mb-3">
                <label for="recinto">Recinto:</label>
                <input type="text" value="<?php echo $recinto;?>" class="form-control" id="recinto" name="recinto">
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