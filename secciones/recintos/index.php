<?php include ("../../bd.php"); 

//borrado
if(isset($_GET['Idrecinto'])) {
    $Idrecinto = isset($_GET['Idrecinto']) ? $_GET['Idrecinto'] : "";
    $sentencia = $conexion->prepare("DELETE FROM recinto WHERE Idrecinto=:Idrecinto");
    $sentencia->bindParam(":Idrecinto", $Idrecinto);
    $sentencia->execute();
    $mensaje="Registro Eliminado";
    header("Location: index.php?mensaje=".$mensaje);
    exit(); 
}

//a continuacion llama a la BD , pero el nombre de la tabla (select)
$sentencia=$conexion->prepare("SELECT * FROM recinto");
$sentencia->execute();
$lista_recinto=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include ("../../templates/header.php"); ?>

<br/>
<h4>Recintos del Hospital</h4>
<div class="card">
    <div class="card-header">
        <a
            name=""
            id=""
            class="btn btn-success"
            href="crear.php"
            role="button"
            >Agregar Recinto</a
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
                    <th scope="col">Recinto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($lista_recinto as $registro) {   ?>
               
                <tr class="">
                    <td scope="row"><?php echo $registro['Idrecinto']; ?></td>
                    <td><?php echo $registro['recinto']; ?></td>

                    <td> 
                    <a
                    class="btn btn-outline-info btn-sm "
                    href="editar.php?Idrecinto=<?php echo $registro['Idrecinto']; ?>"
                    role="button"
                    ><img src="../../imagenes/editar.svg" alt="editar" width="20" height="20"></a
                    > 
                    <a
                    class="btn btn-outline-danger btn-sm "
                    href="javascript:borrar(<?php echo $registro['Idrecinto']; ?>);"
                    role="button"
                    ><img src="../../imagenes/eliminar.svg" alt="eliminar" width="20" height="20"></a
                    >
                    </td>            
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>
    </div>
</div>

<?php include ("../../templates/footer.php"); ?>