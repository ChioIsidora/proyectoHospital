<?php include ("../../bd.php"); 

//borrado
if(isset($_GET['Idtipobien'])) {
    $Idtipobien = isset($_GET['Idtipobien']) ? $_GET['Idtipobien'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tipobien WHERE Idtipobien=:Idtipobien");
    $sentencia->bindParam(":Idtipobien", $Idtipobien);
    $sentencia->execute();
    $mensaje="Registro Eliminado";
    header("Location: index.php?mensaje=".$mensaje);
    exit(); 
}

//a continuacion llama a la BD , pero el nombre de la tabla (select)
$sentencia=$conexion->prepare("SELECT * FROM tipobien");
$sentencia->execute();
$lista_tipobien=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include ("../../templates/header.php"); ?>

<br/>
<h4>Tipo de bien</h4>
<div class="card">
    <div class="card-header">
        <a
            name=""
            id=""
            class="btn btn-success"
            href="crear.php"
            role="button"
            >Agregar Tipo</a
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
                    <th scope="col">Tipo de bien</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($lista_tipobien as $registro) {   ?>
               
                <tr class="">
                    <td scope="row"><?php echo $registro['Idtipobien']; ?></td>
                    <td><?php echo $registro['tipobien']; ?></td>

                    <td> 
                    <a
                    class="btn btn-outline-info btn-sm "
                    href="editar.php?Idtipobien=<?php echo $registro['Idtipobien']; ?>"
                    role="button"
                    ><img src="../../imagenes/editar.svg" alt="editar" width="20" height="20"></a
                    > 
                    <a
                    class="btn btn-outline-danger btn-sm "
                    href="javascript:borrar(<?php echo $registro['Idtipobien']; ?>);"
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