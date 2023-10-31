<?php
    // Obtiene la IP del parámetro en la URL
    $ipSeleccionada = $_GET['ip'];

    echo "Has seleccionado modificar la IP: $ipSeleccionada";
    echo "<br>";
    echo "<a href='read.php'>Volver</a>";
?>