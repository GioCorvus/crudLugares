<?php

require_once '../config/config.php';

class Lugar {
    private $conn;
    
    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    /*
        private function esIPValida($ip) {
        // Utilizamos la función filter_var para validar la IP
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }
    */

    public function leer() {
        $result = $this->conn->query("SELECT * FROM lugar");
        $datos = array();

        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }

        $this->conn->close(); 

        return $datos;
    }

    public function insertar($ip, $lugar, $descripcion) { //METODO QUE AÑADE UNA LINEA A LA TABLA DE LUGARES
    
        // verificar si ya existe un registro con el mismo ip
        $consulta = "SELECT ip FROM lugar WHERE ip = '$ip'";
        $resultado = $this->conn->query($consulta);
    
        if ($resultado->num_rows > 0) {
            // ya existe un registro con el mismo ip
            $mensaje = "Ya existe un Lugar con la IP $ip.";
        } else {
            $consulta = "INSERT INTO lugar (ip, lugar, descripcion) VALUES ('$ip', '$lugar', '$descripcion')";
            $insertar = $this->conn->query($consulta);
    
            $mensaje = "Lugar insertado con éxito.";
        }
    
        // Cerrar la conexión
        $this->conn->close(); 
    
        return $mensaje;
    }

    public function borrar($ip) { //METODO QUE BORRA UNA LINEA DE LA TABLA DE LUGARES
    
        // verifica si el Lugar con la IP dada existe
        $consulta = "SELECT ip FROM lugar WHERE ip = '$ip'";
        $resultado = $this->conn->query($consulta);
    
        if ($resultado->num_rows === 0) {
            $this->conn->close(); 
            $mensaje = "No existe un Lugar con la IP $ip.";
        }else{
            $borrar = "DELETE FROM lugar WHERE ip = '$ip'";
            $resultado = $this->conn->query($borrar);
        
            $this->conn->close(); 
        
            if ($resultadoBorrar) {
                $mensaje = "Lugar borrado con éxito.";
            } else {
                $mensaje = "Error al borrar el lugar.";
            }
        }

        return $mensaje;
    
    }

    public function modificar($ip, $lugar, $descripcion) {

        // Verificar si el Jesuita con el ID dado existe
        $consultaExistencia = "SELECT ip FROM lugar WHERE ip = '$ip'";
        $resultadoExistencia = $this->conn->query($consultaExistencia);

        if ($resultadoExistencia->num_rows === 0) {
            $this->conn->close(); 
            $mensaje = "No existe un lugar con la IP $ip.";
        }else{

                    // El lugar existe, procede con la modificación
        $consultaModificar = "UPDATE lugar SET lugar = '$lugar', descripcion = '$descripcion' WHERE ip = '$ip'";
        $resultadoModificar = $this->conn->query($consultaModificar);

        $this->conn->close(); 

        $mensaje = "Lugar modificado con éxito";
        }

        return $mensaje;

        
    }

}
?>
