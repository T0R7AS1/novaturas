<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include '../layouts/header.php';
    include '../countryModel.php';
    $countryModel = new CountryModel();
    $insert = $countryModel->insert();

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <a href="../countries/index.php" class="btn btn-primary btn-block m-0 ">Back</a>
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Adding a new country</h3></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label class="mb-1" for="inputProjectname">Country code (ISO)</label>
                            <input type="text" class="form-control" placeholder="Enter country code" name="country_code">
                        </div>
                        <div class="form-group">
                            <label class="mb-1" for="inputProjectname">Country name</label>
                            <input class="form-control" placeholder="Enter country name" name="name">
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-4">Add a country</button>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>
<script>


</script>
<?php
include '../layouts/footer.php';
?>