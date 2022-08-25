<?php

    include("conexion.php");
    include("funciones.php");
    
    if (isset($_POST["id_empleado"])) {
        $salida = array();
        $stmt = $conexion->prepare("SELECT * FROM empleados WHERE id='".$_POST["id_empleado"]."' LIMIT 1");        
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $fila){
            $salida["nombre"] = $fila["nombre"];
            $salida["email"] = $fila["email"];
            $salida["sexo"] = $fila["sexo"];
            $salida["areas_id"] = $fila["areas_id"];
            $salida["descripcion"] = $fila["descripcion"];
            $salida["boletin"] = $fila["boletin"];                                    
        }        
        echo json_encode($salida);
    }
?>