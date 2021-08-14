<?php

    include '../countryModel.php';
    $countryModel = new CountryModel();
    $id = $_REQUEST['id'];
    $delete = $countryModel->delete($id);

    if ($delete) {
        header('Location: ../countries/index.php');
    }else{
        header('Location: ../countries/index.php');
    }

?>