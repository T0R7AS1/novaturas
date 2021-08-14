<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../layouts/header.php';
include '../countryModel.php';
$countryModel = new CountryModel();
$id = $_REQUEST['id'];
$row = $countryModel->fetch_single($id);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h1 class="text-center"> Novaturas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 mx-auto">
        <a href="../countries/index.php" class="btn btn-primary btn-block m-0 ">Back</a>
            <div class="card">
                <div class="card-header">
                    Showing country <?php echo $row['name'];?>
                </div>
                <div class="card-body">
                    <p>Country code: <?php echo $row['country_code'];?></p>
                    <p>Country name: <?php echo $row['name'];?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php';?>