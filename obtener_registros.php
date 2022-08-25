<?php

    include("conexion.php");
    include("funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT emp.id AS id, emp.nombre, emp.email, emp.sexo, are.nombre AS area, emp.boletin FROM empleados emp INNER JOIN  areas AS are ON emp.areas_id = are.id"; //Selecionar todo de la tabla.
    // if (isset($_POST["search"]["value"])) {
    //     $querys .='WHERE nombre LIKE "%' . $_POST["search"]["value"] .'%" ';
    // }
    // if (isset($_POST["order"])) {
    //     $querys .= 'ORDER BY' . $_POST['order']['0']['column'] . ' '.$_POST["order"][0]['dir']. ' ';
    // }else {
    //     $querys .= 'ORDER BY id DESC ';
    // }

    // if ($_POST["length"] != -1) {
    //     $querys .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
    // }
    
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila){
        if ($fila["boletin"]==1) {
            $boletin= 'Si';
        }else {
            $boletin= 'No';
        }
        $sub_array = array();
        $sub_array[] = $fila["nombre"];
        $sub_array[] = $fila["email"];
        $sub_array[] = $fila["sexo"];
        $sub_array[] = $fila["area"];
        $sub_array[] = $boletin;
        $sub_array[] = '<button type = "button" name="editar" id="'.$fila["id"].'" class="btn btn-warning btn-xs editar"><i class="fa-solid fa-pen-to-square"></i></button>';
        $sub_array[] = '<button type = "button" name="borrar" id="'.$fila["id"].'" class="btn btn-danger btn-xs borrar"><i class="fa-solid fa-trash-can"></i></button>';
        $datos[] = $sub_array;
    }
    $salida = array(
        "draw"              => intval($_POST["draw"]),
        "recordsTotal"      => $filtered_rows,
        "recordsFiltered"   => obtener_todos_registros(),
        "data"              => $datos
    ); 
      
    echo json_encode($salida);

?>