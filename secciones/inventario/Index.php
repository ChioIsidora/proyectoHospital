<?php include ("../../bd.php"); 

//borrado
if(isset($_GET['IDinventario'])) {
    $IDinventario = isset($_GET['IDinventario']) ? $_GET['IDinventario'] : "";
    
    // buscar el archivo relacionado con el empleado
    $sentencia = $conexion->prepare("SELECT foto,documento FROM activos WHERE IDinventario=:IDinventario");
    $sentencia->bindParam(":IDinventario", $IDinventario);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
        if(file_exists("img/".$registro_recuperado["foto"])){
            unlink("img/".$registro_recuperado["foto"]);
        }
    }
    if(isset($registro_recuperado["documento"]) && $registro_recuperado["documento"]!=""){
        if(file_exists("documento/".$registro_recuperado["documento"])){
            unlink("documento/".$registro_recuperado["documento"]);
        } 
    }
    $sentencia = $conexion->prepare("DELETE FROM activos WHERE IDinventario=:IDinventario");
    $sentencia->bindParam(":IDinventario", $IDinventario);
    $sentencia->execute();
    $mensaje="Registro Eliminado";
    header("Location: index.php?mensaje=".$mensaje);
    exit(); 
    
}

//datos de la tabla
$sentencia=$conexion->prepare("SELECT *, 
    (SELECT servicio FROM servicios WHERE servicios.Idservicio=activos.servicio limit 1) as servicio,
    (SELECT recinto FROM recinto WHERE recinto.Idrecinto=activos.recinto limit 1) as recinto,
    (SELECT estado FROM estado WHERE estado.Idestado=activos.estado limit 1) as Idestado,
    (SELECT tipobien FROM tipobien WHERE tipobien.Idtipobien=activos.tipobien limit 1) as tipobien
FROM activos");
$sentencia->execute();
$lista_activos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include ('../../templates/header.php');?>


<?php if(isset($_GET['mensaje'])) {?>
<script>
    Swal.fire({icon:"success", title:"<?php echo$_GET['mensaje'];?>"});
</script>
<?php }?>

<br/>

<div class="card">
    <div class="card-header">
    <a
        name="solicitud"
        id="solicitud"
        class="btn btn-success"
        href="crear.php"
        role="button"
        >Agregar Activo Fijo</a
    >
    
    </div>
    <div class="card-body">
 
<div
    class="table-responsive-sm"
>
    <table
        class="table" id="tabla_id"
    >
        <thead>
            <tr>
                <th scope="col">ID Inventario </th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col">Servicio</th>
                <th scope="col">Recinto</th>
                <th scope="col">Fecha de ingreso</th>
                <th scope="col">Ultimo inventario</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Foto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($lista_activos as $registro) {   ?>

            <tr class="">
                <td scope="row">33-<?php echo $registro['IDinventario']; ?></td>
                <td><?php echo $registro['nombre']; ?></td>
                <td><?php echo $registro['tipobien']; ?></td>
                <td><?php echo $registro['Idestado']; ?></td>
                <td><?php echo $registro['servicio']; ?></td>
                <td><?php echo $registro['recinto']; ?></td>
                <td><?php echo $registro['fechaingreso']; ?></td>
                <td><?php echo $registro['fechaactualizacion']; ?></td>
                <td><?php echo $registro['observaciones']; ?></td>
                <td> 
                    <img width="50" 
                    src="img/<?php echo $registro['foto']; ?>" 
                    class="img-fluid rounded" alt=""/>
                    </td>
                <td><a
                    name="Imprimir_registro"
                    id="Imprimir_registro"
                    class="btn btn-outline-primary btn-sm "
                    href="etiqueta.php?IDinventario=<?php echo $registro['IDinventario']; ?>"
                    target="_blank"
                    role="button"
                    ><img src="../../imagenes/print.svg" alt="imprimir" width="20" height="20"></a>
                
                    <a
                    name="Imprimir_codigo"
                    id="Imprimir_codigo"
                    class="btn btn-outline-primary btn-sm "
                    href="codigoqr.php?IDinventario=<?php echo $registro['IDinventario']; ?>"
                    target="_blank"
                    role="button"
                    ><img src="../../imagenes/qr.svg" alt="imprimircodigo" width="20" height="20"></a>
                    
                    <a
                    name="Imprimir_respaldo"
                    id="Imprimir_respaldo"
                    class="btn btn-outline-primary btn-sm "
                    href="documento/<?php echo $registro['documento']; ?>"
                    target="_blank"
                    role="button"
                    ><img src="../../imagenes/pdf.svg" alt="imprimirrespaldo" width="20" height="20"></a>

                    <a
                    name="informacion"
                    id="informacion"
                    class="btn btn-outline-warning btn-sm "
                    data-toggle="modal"
                    data-target="#verDetallesModal<?php echo $IDinventario; ?>"
                    href="#"
                    target="_blank"
                    role="button"
                    ><img src="../../imagenes/info.svg" alt="imprimirrespaldo" width="20" height="20"></a>

                    <a
                    class="btn btn-outline-info btn-sm "
                    href="editar.php?IDinventario=<?php echo $registro['IDinventario']; ?>"
                    role="button"
                    ><img src="../../imagenes/editar.svg" alt="editar" width="20" height="20"></a
                    > 
                    <a
                    class="btn btn-outline-danger btn-sm "
                    href="javascript:borrar(<?php echo $registro['IDinventario']; ?>);"
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


<?php include ('../../templates/footer.php');?>