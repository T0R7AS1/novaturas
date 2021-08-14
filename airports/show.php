<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../layouts/header.php';
include '../airportModel.php';
$airportModel = new AirportModel();
$id = $_REQUEST['id'];
$row = $airportModel->fetch_single($id);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h1 class="text-center"> Novaturas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 mx-auto">
        <a href="../airports/index.php" class="btn btn-primary btn-block m-0 ">Back</a>
            <div class="card">
                <div class="card-header">
                    Showing airport <?php echo $row['name'];?>
                </div>
                <div class="card-body">
                    <p>Airport name: <?php echo $row['name'];?></p>
                    <p>Airport country: <?php echo $row['country_name'];?></p>
                    <p>Airport location(longitude, latitude): <?php echo $row['location'];?></p>
                    <p>Airport airlines: <?php echo $row['airline_name'];?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php';?>