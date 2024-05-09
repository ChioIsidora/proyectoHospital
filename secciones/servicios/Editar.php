<?php
include ("../../bd.php");

if(isset($_GET['Idservicio'])) {
    $Idservicio = isset($_GET['Idservicio']) ? $_GET['Idservicio'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM servicios WHERE Idservicio=:Idservicio");
    $sentencia->bindParam(":Idservicio", $Idservicio);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $servicio=$registro["servicio"];
}
if($_POST){

    // recolectar datos metodo post
    $Idservicio = isset($_POST['Idservicio']) ? $_POST['Idservicio'] : "";
    $servicio=(isset($_POST["servicio"])?$_POST["servicio"]:"");
    // preparar la insercion de los datos

try {
    $sentencia = $conexion->prepare("UPDATE servicios SET servicio=:servicio WHERE Idservicio=:Idservicio");
    
    // Asignando los valores q vienen del metodo post
    $sentencia->bindParam(":servicio", $servicio);  
    $sentencia->bindParam(":Idservicio", $Idservicio); 
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
        
        <h4>Agregar Servicio</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Idservicio">Idservicio:</label>
                <input type="text" value="<?php echo $Idservicio;?>" class="form-control" readonly id="Idservicio" name="Idservicio">
            </div>
            <div class="mb-3">
                <label for="servicio">Servicio:</label>
                <input type="text" value="<?php echo $servicio;?>" class="form-control" id="servicio" name="servicio">
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