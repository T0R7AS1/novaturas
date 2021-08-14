<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include '../layouts/header.php';
    include '../countryModel.php';
    include '../airlineModel.php';

    $countryModel = new CountryModel();
    $countries = $countryModel->fetch();

    $airlineModel = new AirlineModel();
    $insert = $airlineModel->insert();
    ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <a href="index.php" class="btn btn-primary btn-block m-0 ">Back</a>
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Adding a new airline</h3></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label class="mb-1" for="inputProjectname">Name</label>
                            <input type="text" class="form-control" placeholder="Enter airline name" name="name">
                        </div>
                        <div class="form-group"> 
                            <label class=" mb-1" for="inputProjectname">Airline country</label>
                            <select name="country_name" id="" class="form-control">
                                <option disabled> Select</option>
                                <?php foreach ($countries as $country): ?>
                                    <option name="country_name" value="<?php echo $country['name']; ?>"><?php echo $country['name']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-4">Add a airline</button>
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