<?php
    require_once '../clases/Lugar.php';

        $ip = $_GET['ip'];

        $objeto = new Lugar();
        $objeto->borrar($ip);

        echo $mensaje;

        // Redirect back to read.php after deleting
        header("Location: read.php");
        exit();

?>