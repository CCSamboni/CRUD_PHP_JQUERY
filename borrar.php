<?php

    include("conexion.php");
    include("funciones.php");

    if (isset($_POST["id_empleado"])) {
        $stmt1 = $conexion->prepare("DELETE FROM empleados_has_roles WHERE empleados_id=:empleados_id");
        $resultado1 = $stmt1->execute(
            array(
                ':empleados_id'     => $_POST["id_empleado"]
            )
        );
        if($resultado1==1){
            $stmt = $conexion->prepare("DELETE FROM empleados WHERE id=:id");
            $resultado = $stmt->execute(
                array(
                    ':id'   => $_POST["id_empleado"]
                )
            );
        }
        if(!empty($resultado)){
            echo 'Registro borrado';
        }
    }
    // elseif (isset($_POST["id_empleado"])) {
    //     
        
    // }       

    
    
?>