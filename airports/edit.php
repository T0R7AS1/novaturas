<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../layouts/header.php';
    include '../countryModel.php';
    include '../airlineModel.php';
    include '../airportModel.php';

    $countryModel = new CountryModel();
    $countries = $countryModel->fetch();

    $airlineModel = new AirlineModel();
    $airlines = $airlineModel->fetch();

    $id = $_REQUEST['id'];
    $airportModel = new AirportModel();
    $row = $airportModel->edit($id);
    $update = $airportModel->update($_POST, $id);

?>

<body onload="initialize();">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <a href="../airports/index.php" class="btn btn-primary btn-block m-0 ">Back</a>
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Editing Airport</h3></div>
                <div class="card-body">
                <form method="POST">
                <div class="form-group">
                            <label class="mb-1" for="inputProjectname">Name</label>
                            <input type="text" class="form-control" placeholder="Enter airport name" name="name" value="<?php echo $row['name'] ?>">
                        </div>
                        <div class="form-group"> 
                            <label class=" mb-1" for="inputProjectname">Airport country</label>
                            <select name="country_name" id="" class="form-control">
                                <option disabled> Select</option>
                                <?php foreach ($countries as $country): ?>
                                    <option name="country_name" value="<?php echo $country['name']; ?>"
                                    <?php 
                                        if($country['name'] == $row['country_name']){
                                            echo 'selected';
                                        }
                                    ?>><?php echo $country['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-1" for="inputProjectname">Longitude</label>
                            <?php $lngLat = explode(', ', $row['location'])?>
                            <input type="text" class="form-control" placeholder="Airport longitude" name="longitude" id="txtLng" value="<?php echo $lngLat[0]?>">
                        </div>
                        <div class="form-group">
                            <label class="mb-1" for="inputProjectname">Latitude</label>
                            <input type="text" class="form-control" placeholder="Airport latitude" name="latitude" id="txtLat" value="<?php echo $lngLat[1]?>">
                        </div>
                        <div class="form-group">
                        <h5>Drag the mouse to choose a location</h5>
                            <div id="map_canvas" style="width: auto; height: 500px;"></div>
                        </div>
                        <label class="mb-1">Select</label>
                            <div class="form-group pl-4 d-block">
                            <?php $airlinesArray = explode(', ', $row['airline_name'])?>
                                <?php foreach($airlines as $airline): ?>
                                    <div style="width: 48%;" class="d-inline-block mt-2">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $airline['name'];?>"
                                        <?php 
                                            foreach ($airlinesArray as $str) {
                                                if ($str == $airline['name']) {
                                                    echo 'checked';
                                                }
                                            }
                                        ?>
                                         name="airline_name[]">
                                        <label class="form-check-label mt-1"> <?php echo $airline['name']; ?> </label>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <button type="submit" class="btn btn-success btn-block mt-4">Add a airport</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYbYepini3Q3ZmLibxzz_D_vtmRNzjSto&callback=initMap"></script>
    <script type="text/javascript">
        function initialize() {
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(54.901097, 23.899247),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(54.901097, 23.899247),
                draggable: true
            });

            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#txtLat").val(evt.latLng.lat().toFixed(6));
                $("#txtLng").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });

            map.setCenter(vMarker.position);

            vMarker.setMap(map);
        }
    </script>

<?php
include '../layouts/footer.php';
?>