<?php include ("../../bd.php"); 

if ($_POST) {
    // Imprime los datos POST para depuración

    // Recolectar datos del método POST
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellidopaterno = isset($_POST["apellidopaterno"]) ? $_POST["apellidopaterno"] : "";
    $apellidomaterno = isset($_POST["apellidomaterno"]) ? $_POST["apellidomaterno"] : "";
    $rut = isset($_POST["rut"]) ? $_POST["rut"] : "";
    $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";

    // Preparar la inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO usuarios (nombre, apellidopaterno, apellidomaterno, rut, contrasena,correo)
   VALUES (:nombre, :apellidopaterno, :apellidomaterno, :rut, :contrasena,:correo)");

    // Asignar los valores que vienen del método POST
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellidopaterno", $apellidopaterno);
    $sentencia->bindParam(":apellidomaterno", $apellidomaterno);
    $sentencia->bindParam(":rut", $rut);
    $sentencia->bindParam(":contrasena", $contrasena);  // Corregir nombre del parámetro
    $sentencia->bindParam(":correo", $correo);

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

<?php include ('../../templates/header.php');?>

<br/>
<div class="card">
    <div class="card-body">
        
        <h2>Formulario de Registro de Usuario</h2>
        <form action="" method="post" enctype="multipart/form-data">
        
            <div class="mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="apellidopaterno">A. Paterno:</label>
                <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno">
            </div>
            <div class="mb-3">
                <label for="apellidomaterno">A. Materno:</label>
                <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno">
            </div>
            <div class="mb-3">
                <label for="rut">Rut (Sin DV y sin "-"):</label>
                <input type="number" class="form-control" id="rut" name="rut">
            </div>
            <div class="mb-3">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena">
            </div>
            <div class="mb-3">
                <label for="correo">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo">
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-primary">Registrar</button>
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

<?php include ('../../templates/footer.php');?>