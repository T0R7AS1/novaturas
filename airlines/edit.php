<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include '../layouts/header.php';
    include '../countryModel.php';
    include '../airlineModel.php';
    $countries = new CountryModel();
    $countries = $countries->fetch();
    $airlineModel = new AirlineModel();
    $id = $_REQUEST['id'];
    $row = $airlineModel->edit($id);

    $update = $airlineModel->update($_POST, $id);

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <a href="../airlines/index.php" class="btn btn-primary btn-block m-0 ">Back</a>
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Updating a airline</h3></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label class="mb-1" for="inputProjectname">Airline name</label>
                            <input type="text" class="form-control" placeholder="Enter airline name" value="<?php echo $row['name'];?>" name="name">
                        </div>
                        <div class="form-group"> 
                            <label class=" mb-1" for="inputProjectname">Airline country</label>
                            <select name="country_name" id="" class="form-control">
                                <option disabled> Select</option>
                                <?php foreach ($countries as $country): ?>
                                    <option name="country_name" value="<?php echo $country['name']; ?>"
                                    <?php 
                                        if($country['name'] == $row['country_name']){
                                            echo 'selected';
                                        }
                                    ?>><?php echo $country['name'];?></option>                              <?php endforeach ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-block mt-4">Update a country</button>
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