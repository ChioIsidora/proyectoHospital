<?php
#El script PHP está gestionando el envío del formulario de acceso.
session_start();
#session_start()`: Inicializa la sesión PHP.
if($_POST){
    #Si la variable `$_POST` no está vacía 
    #(es decir, el formulario ha sido enviado), procede a validar 
    #las credenciales del usuario.

    include("./bd.php");
    # Incluye el fichero `bd.php`, que presumiblemente contiene la lógica de 
    #conexión a la base de datos.

    
    $sentencia=$conexion->prepare("SELECT *,count(*) as n_usuario
    FROM usuarios 
    WHERE rut=:rut 
    AND contrasena=:contrasena");

    # Prepara una consulta SQL utilizando una sentencia preparada para seleccionar el registro 
    #de usuario en función de la `rut` (nombre de usuario) y la `contrasena` 
    #(contraseña) dadas.
    $rut=$_POST["rut"];
    $contrasena=$_POST["contrasena"];

    #Vincula las variables `rut` y `contrasena` a los parámetros de 
    #consulta «:rut» y «:contrasena», respectivamente.

    $sentencia->bindParam(":rut", $rut);
    $sentencia->bindParam(":contrasena", $contrasena);

    $sentencia->execute();
    #Ejecuta la consulta.
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    #Obtiene la primera fila del resultado usando `fetch(PDO::FETCH_LAZY)`, 
    #que devuelve un objeto con los nombres de las columnas como propiedades.

if($registro["n_usuario"]>0){
    # Comprueba si la propiedad `n_usuario` del objeto es mayor que 0, 
    #indicando que se ha encontrado un registro coincidente.
    $_SESSION['rut']=$registro["rut"];
    $_SESSION['logeado']=true;
    header("Location:index.php");
}else{
    $mensaje="Error: El usuario o contraseña son incorrectos";

}
#Si se encuentra un registro coincidente:
#Establece la propiedad `$_SESSION['rut']` al `rut` del usuario.
#Establece `$_SESSION['logeado']` a `true` para indicar que el usuario ha iniciado sesión.
#Redirige al usuario a la página `index.php` usando `header(«Location:index.php»)`.

#Si no se encuentra ningún registro coincidente, muestra un mensaje de error 
#almacenado en la variable `$mensaje`.
}
?>

<!-- El código HTML es la interfaz del formulario de login -->
<!doctype html>
<html lang="es">
    <head>
        <title>Login</title>
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
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main class="container">

        <div class="row">
        <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
            <br/><br/><br/>
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">

                    <?php if(isset($mensaje)){?>
                    <div
                        class="alert alert-danger"
                        role="alert"
                    >
                        <strong><?php echo $mensaje;?></strong>
                    </div>

                    <?php }?>
                    <!-- En la sección del cuerpo principal, 
                    tiene un formulario con campos de entrada para `rut` y `contrasena`. -->
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Usuario:</label>
                            <input
                                type="text"
                                class="form-control"
                                name="rut"
                                id="rut"
                                placeholder="Escriba su rut sin punto (.) ni dv"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Contraseña:</label>
                            <input
                                type="password"
                                class="form-control"
                                name="contrasena"
                                id="contrasena"
                                placeholder="Escriba su contraseña"
                            />
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Acceder
                        </button>
                        

                    </form>

                    </div>
                    
                </div>
                
            </div>
        </div>



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
    </body>
</html>
