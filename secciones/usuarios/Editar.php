<?php 
include("../../bd.php");

// Inicialización de variables
$mensaje = "";
$Idusuario = $nombre = $apellidopaterno = $apellidomaterno = $rut = $contrasena = $correo = "";

if(isset($_GET['Idusuario'])) {
    // Obtener el ID del usuario de la URL
    $Idusuario = isset($_GET['Idusuario']) ? $_GET['Idusuario'] : "";

    // Obtener los datos del usuario de la base de datos
    $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE Idusuario=:Idusuario");
    $sentencia->bindParam(":Idusuario", $Idusuario);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Asignar los valores obtenidos a las variables
    $nombre = $registro["nombre"];
    $apellidopaterno = $registro["apellidopaterno"];
    $apellidomaterno = $registro["apellidomaterno"];
    $rut = $registro["rut"];
    $contrasena = $registro["contrasena"];
    $correo = $registro["correo"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recolectar datos del método POST
    $Idusuario = isset($_POST["Idusuario"]) ? $_POST["Idusuario"] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellidopaterno = isset($_POST["apellidopaterno"]) ? $_POST["apellidopaterno"] : "";
    $apellidomaterno = isset($_POST["apellidomaterno"]) ? $_POST["apellidomaterno"] : "";
    $rut = isset($_POST["rut"]) ? $_POST["rut"] : "";
    $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";

    // Actualizar los datos del usuario en la base de datos
    try {
        $sentencia = $conexion->prepare("UPDATE usuarios SET
            nombre=:nombre,
            apellidopaterno=:apellidopaterno,
            apellidomaterno=:apellidomaterno,
            rut=:rut,
            contrasena=:contrasena,
            correo=:correo
            WHERE Idusuario=:Idusuario");

        // Asignar los valores que vienen del método POST
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":apellidopaterno", $apellidopaterno);
        $sentencia->bindParam(":apellidomaterno", $apellidomaterno);
        $sentencia->bindParam(":rut", $rut);
        $sentencia->bindParam(":contrasena", $contrasena);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":Idusuario", $Idusuario);

        $sentencia->execute();
    } catch (PDOException $e) {
        // Capturar el mensaje de error
        $mensaje = "Error al insertar registro: " . $e->getMessage();
    }
    // Redireccionar la página con el mensaje
    header("Location: index.php?mensaje=" . urlencode($mensaje));
}

include("../../templates/header.php");
?>
<br/>
<div class="card">
    <div class="card-body">
        <h2>Formulario de Actualización de Usuario</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Idusuario">ID:</label>
                <input type="text" value="<?php echo $Idusuario;?>" class="form-control" readonly id="Idusuario" name="Idusuario">
            </div>
            <div class="mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" value="<?php echo $nombre;?>" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="apellidopaterno">A. Paterno:</label>
                <input type="text" value="<?php echo $apellidopaterno;?>" class="form-control" id="apellidopaterno" name="apellidopaterno">
            </div>
            <div class="mb-3">
                <label for="apellidomaterno">A. Materno:</label>
                <input type="text"  value="<?php echo $apellidomaterno;?>"class="form-control" id="apellidomaterno" name="apellidomaterno">
            </div>
            <div class="mb-3">
                <label for="rut">Rut (Sin DV y sin "-"):</label>
                <input type="text" value="<?php echo $rut;?>" class="form-control" id="rut" name="rut">
            </div>
            <div class="mb-3">
                <label for="contrasena">Contraseña:</label>
                <input type="password"  value="<?php echo $contrasena;?>" class="form-control" id="contrasena" name="contrasena">
            </div>
            <div class="mb-3">
                <label for="correo">Correo:</label>
                <input type="text" value="<?php echo $correo;?>" class="form-control" id="correo" name="correo">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a name="cancelar" id="cancelar" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php");?>
