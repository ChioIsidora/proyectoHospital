<?php

session_start();

$url_base="http://localhost/activos/";

if(!isset($_SESSION['rut'])){
    header("Location:".$url_base."./login.php");

}

?>

<!doctype html>
<html lang="es">
    <head>
        <title>Activos Fijos</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
            
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    </head>
    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $url_base; ?>">
            <img src="<?php echo $url_base; ?>imagenes/logo.jpg" alt="Bootstrap" width="80" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $url_base; ?>secciones/inventario/" aria-current="page">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base; ?>secciones/planchetas/">Planchetas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mantenedores</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo $url_base; ?>secciones/servicios/">Servicios</a></li>
                        <li><a class="dropdown-item" href="<?php echo $url_base; ?>secciones/recintos/">Recintos</a></li>
                        <li><a class="dropdown-item" href="<?php echo $url_base; ?>secciones/usuarios/">Usuarios</a></li>
                        <li><a class="dropdown-item" href="<?php echo $url_base; ?>secciones/tipobien/">Tipo de Bien</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                
            <a
                name="cerrar"
                id="cerrar"
                class="btn btn-outline-secondary"
                href="<?php echo $url_base; ?>cerrar.php"
                role="button"
                >Cerrar Sesión</a
            >
            
            </form>
        </div>
    </div>
</nav>
        <main class="container">

        <?php if(isset($_GET['mensaje'])) {?>
        <script>
            Swal.fire({icon:"success", title:"<?php echo$_GET['mensaje'];?>"});
        </script>
        <?php }?>