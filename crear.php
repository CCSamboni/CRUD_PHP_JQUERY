<?php
    include("conexion.php");
    include("funciones.php");

    if ($_POST['operacion'] == "Crear")
     {
        $stmt = $conexion->prepare("INSERT INTO empleados(nombre, email, sexo, boletin, descripcion, areas_id) VALUES (:nombre, :email, :sexo, :boletin, :descripcion, :areas_id)");
        $resultado = $stmt->execute(
                array(
                    ':nombre'          => $_POST["nombre"],
                    ':email'           => $_POST["email"],
                    ':sexo'            => $_POST["sexo"],
                    ':boletin'         => $_POST["boletin"],
                    ':descripcion'     => $_POST["descripcion"],
                    ':areas_id'        => $_POST["areas_id"],                   
                    )                
                );
        $empleado_id=$conexion->lastInsertId();
        if ($resultado == 1) {  
            $stmt1= $conexion->prepare("INSERT INTO empleados_has_roles(empleados_id, roles_id) VALUES (:empleados_id, :roles_id)");
            $resultado1 = $stmt1->execute(
                array(
                    ':empleados_id'    => $empleado_id,
                    ':roles_id'        => $_POST["roles_id"],
                )        
            );  
        }                     
                
        if (!empty($resultado && $resultado1)) {
                echo 'Registro creado';
        }
    }

    if ($_POST['operacion'] == "Editar")
    {
        $stmt = $conexion->prepare("UPDATE empleados SET nombre=:nombre, email=:email, sexo=:sexo, boletin=:boletin, descripcion=:descripcion, areas_id=:areas_id WHERE id = :id");
        $resultado = $stmt->execute(            
            array(
                ':nombre'          => $_POST["nombre"],
                ':email'           => $_POST["email"],
                ':sexo'            => $_POST["sexo"],
                ':boletin'         => $_POST["boletin"],
                ':descripcion'     => $_POST["descripcion"],
                ':areas_id'        => $_POST["areas_id"],
                ':id'              => $_POST["id_empleado"],                  
            )
        );            
            if (!empty($resultado)) 
            {
                echo 'Registro actualizado';
            }
    }
?>