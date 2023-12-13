<?php
$host="localhost";
$bd="pastelesmc";
$usuario="root";
$contraseña="";

try {
       $conexion= new PDO("mysql:host=$host;dbname=$bd", $usuario, $contraseña );
    //    if($conexion){echo "Conectado... a sistema ";}

} catch (Exeption $ex) {
    echo $ex->getMessage();
}

?>