</main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

<script>
$(document).ready( function(){
$("#tabla_id").DataTable({
    "pageLength":10,
    lenghtMenu:[
        [5,10,25,50],
        [5,10,25,50]
    ],
    "language":{
        "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
    }
});
});
</script>

<script>
function borrar(IDinventario) {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="index.php?IDinventario="+IDinventario;
        } 
        });
}
</script>
<script>
function borrar(Idusuario) {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="index.php?Idusuario="+Idusuario;
        } 
        });
}
</script>
<script>
function borrar(Idrecinto) {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="index.php?Idrecinto="+Idrecinto;
        } 
        });
}
</script>
<script>
function borrar(Idservicio) {
    Swal.fire({
        title: "¿Desea eliminar el registro?",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="index.php?Idservicio="+Idservicio;
        } 
        });
}
</script>
    </body>
</html>