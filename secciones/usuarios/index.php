<?php include ("../../bd.php"); 

//borrado
if(isset($_GET['Idusuario'])) {
    $Idusuario = isset($_GET['Idusuario']) ? $_GET['Idusuario'] : "";
    $sentencia = $conexion->prepare("DELETE FROM usuarios WHERE Idusuario=:Idusuario");
    $sentencia->bindParam(":Idusuario", $Idusuario);
    $sentencia->execute();
    $mensaje="Registro Eliminado";
    header("Location: index.php?mensaje=".$mensaje);
    exit();
}

$sentencia=$conexion->prepare("SELECT * FROM usuarios");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include ('../../templates/header.php');?>

<br/>

<h4> Usuarios </h4>

<div class="card">
    <div class="card-header">

        <a
            name=""
            id=""
            class="btn btn-success"
            href="crear.php"
            role="button"
            >Agregar Usuario</a
        >
        
    </div>
    <div class="card-body">
    
    <div class="card-body">
    
    <div
        class="table-responsive-sm"
    >
        <table
            class="table" id="tabla_id"
        >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Rut</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>

            <?php foreach ($lista_usuarios as $registro) {   ?>

                <tr class="">
                    <td scope="row"><?php echo $registro['Idusuario']; ?></td>
                    <td><?php echo $registro['nombre']; ?> 
                        <?php echo $registro['apellidopaterno']; ?>
                        <?php echo $registro['apellidomaterno']; ?>
                
                    </td>

                    <td><?php echo $registro['rut']; ?></td>
                    <td>******</td>
                    <td><?php echo $registro['correo']; ?></td>
                    
                    <td> 
                    <a
                    class="btn btn-outline-info btn-sm "
                    href="editar.php?Idusuario=<?php echo $registro['Idusuario']; ?>"
                    role="button"
                    ><img src="../../imagenes/editar.svg" alt="editar" width="20" height="20"></a
                    > 
                    <a
                    class="btn btn-outline-danger btn-sm"
                    href="javascript:borrar(<?php echo $registro['Idusuario']; ?>);"
                    role="button"
                     ><img src="../../imagenes/eliminar.svg" alt="eliminar" width="20" height="20"></a>

                    
                    </td>
                                       

                </tr>

            <?php } ?>
            </tbody>
        
        </table>
    </div>
    

    </div>
    
</div>

<?php include ('../../templates/footer.php');?>
