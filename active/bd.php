<?php

$servidor="localhost"; // 127.0.0.1
$baseDeDatos="activos";
$usuario="root";
$contrasenia="";

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
}catch(Exception $ex){
    echo $ex->getMessage();
}

#El código que has proporcionado en PHP es una conexión a una base de datos, utilizando el PDO (PHP Data Object) de MySQL.
#Intenta conectarse a una base de datos llamada «activos» en «localhost» (que es el nombre del servidor que está ejecutando el código PHP) con el usuario «root» y sin contraseña.
#Si la conexión tiene éxito, el objeto PDO `$conexion` será creado y puede ser usado para ejecutar consultas contra la base de datos.
#Si la conexión falla, el objeto de excepción `$ex` será creado y el mensaje de error será impreso en la salida estándar.

?>

