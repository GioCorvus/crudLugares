<?php


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $proceso = $_GET['proceso'];
    $ip= $_GET['ip'];

    if ($proceso === 'borrar') {
        // redireccionar a redireccionBorrar.php
        header("Location: redireccionBorrar.php?ip=$ip");
    } elseif ($proceso === 'modificar') {
        // redireccionar a redireccionModificar.php
        header("Location: redireccionModificar.php?ip=$ip");
    }else{
        echo "error, le has dado a un boton que ni existe";
    }
    
}

?>
