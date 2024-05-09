<?php include ('templates/header.php');?>
<br/>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenidos</h1>
        <h3> Aca encontraran los activos fijos del Hospital San Jose de Melipilla</h3>
        <p class="col-md-8 fs-4">
            Usuario conectado: <?php echo $_SESSION['rut']?>
        </p>

    </div>
</div>

<?php include ('templates/footer.php');?>