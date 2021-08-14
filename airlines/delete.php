<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include '../airportModel.php';
    include '../airlineModel.php';
    $airlineModel = new AirlineModel();
    $id = $_REQUEST['id'];
    $delete = $airlineModel->delete($id);

    if ($delete) {
        header('Location: ../airlines/index.php');
    }else{
        header('Location: ../airlines/index.php');
    }

?>