<?php

    include '../airportModel.php';
    $airportModel = new AirportModel();
    $id = $_REQUEST['id'];
    $delete = $airportModel->delete($id);

    if ($delete) {
        header('Location: ../airports/index.php');
    }else{
        header('Location: ../airports/index.php');
    }

?>