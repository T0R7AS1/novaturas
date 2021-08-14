<?php

Class AirportModel{
    
    private $server = "127.0.0.1";
    private $username = 't0r7as';
    private $password = '2452';
    private $db = "novaturas";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server,$this->username,$this->password,$this->db);
        } catch (Exception $e) {
            echo "connection failed" . $e->getMessage();
        }
    }

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && isset($_POST['country_name']) && isset($_POST['longitude']) && isset($_POST['latitude']) && isset($_POST['airline_name'])) {
                if (!empty($_POST['name']) && !empty($_POST['country_name']) && !empty($_POST['longitude']) && !empty($_POST['latitude']) && !empty($_POST['airline_name'])) {
                    $isValidName = (bool) strlen(trim($_POST['name']));
                    $isValidCountryName = (bool) strlen(trim($_POST['country_name']));
                    $isValidLatitude = (bool) strlen(trim($_POST['latitude']));
                    $isValidLongitude = (bool) strlen(trim($_POST['longitude']));
                    if (!$isValidName && !$isValidCountryName && !$isValidLatitude && !$isValidLongitude) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Airport name, country, latitude or longitude contains only spaces</h5>
                        </div>
                        <?php
                        return;
                    }
                    if (ctype_alpha(str_replace(' ', '', $_POST['name'])) === false) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Name must contain only letters</h5>
                        </div>
                        <?php
                        return;
                    }
                    $longitude = $_POST['longitude'];
                    $latitude = $_POST['latitude'];
                    if ($longitude < -180 || $longitude > 180) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Longitude is too high or to low</h5>
                        </div>
                        <?php
                        return;
                    }
                    if ($latitude < -90 || $latitude > 90) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Latitude is too high or to low</h5>
                        </div>
                        <?php
                        return;
                    }
                    if (!is_numeric($latitude) || !is_numeric($longitude)) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Latitude or longitude isnt numbers</h5>
                        </div>
                        <?php
                        return;
                    }
                    
                    
                    $name = $_POST['name'];
                    $country_name = $_POST['country_name'];
                    $location = $longitude . ', ' . $latitude;
                    $airline_name = implode(", ", $_POST['airline_name']);
                    
                    $query = "INSERT INTO airport (name, country_name, location, airline_name) VALUES ('$name', '$country_name', '$location', '$airline_name')";
                    
                    if ($sql = $this->conn->query($query)) {
                        echo "<script> alert('Airport created successfully');</script>";
                    }
                }else{
                    ?>
                    <div class="alert alert-danger">
                        <h5>Airport name, country, location or airline is empty</h5>
                    </div>
                    <?php
                    return;
                }
            }else{
                ?>
                <div class="alert alert-danger">
                    <h5>All fields must be valid</h5>
                </div>
                <?php
                return;
            }
        }
    }

    public function fetch()
    {
        $data = null;

        $query = "SELECT * FROM airport";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function delete($id){
        $query = "DELETE FROM airport WHERE id = '$id'";
        if ($sql = $this->conn->query($query)) {
            return true;
        }else{
            return false;
        }
    }
    public function fetch_single($id)
    {
        $data = null;
        $query = "SELECT * FROM airport WHERE id = '$id'";
        if ($sql = $this->conn->query($query)) {
            while ($row = $sql->fetch_assoc()) {
                $data = $row;
            }
        }
        return $data;
    }

    public function edit($id)
    {
        $data = null;
        $query = "SELECT * FROM airport WHERE id = '$id'";
        if ($sql = $this->conn->query($query)) {
            while ($row = $sql->fetch_assoc()) {
                $data = $row;
            }
        }
        return $data;
    }

    public function update($updateData, $id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && isset($_POST['country_name']) && isset($_POST['longitude']) && isset($_POST['latitude']) && isset($_POST['airline_name'])) {
                if (!empty($_POST['name']) && !empty($_POST['country_name']) && !empty($_POST['longitude']) && !empty($_POST['latitude']) && !empty($_POST['airline_name'])) {
                    $isValidName = (bool) strlen(trim($_POST['name']));
                    $isValidCountryName = (bool) strlen(trim($_POST['country_name']));
                    $isValidLatitude = (bool) strlen(trim($_POST['latitude']));
                    $isValidLongitude = (bool) strlen(trim($_POST['longitude']));
                    if (!$isValidName && !$isValidCountryName && !$isValidLatitude && !$isValidLongitude) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Airport name, country, latitude or longitude contains only spaces</h5>
                        </div>
                        <?php
                        return;
                    }
                    $longitude = $_POST['longitude'];
                    $latitude = $_POST['latitude'];
                    if ($longitude < -180 || $longitude > 180) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Longitude is too high or to low</h5>
                        </div>
                        <?php
                        return;
                    }
                    if ($latitude < -90 || $latitude > 90) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Latitude is too high or to low</h5>
                        </div>
                        <?php
                        return;
                    }
                    if (!is_numeric($latitude) || !is_numeric($longitude)) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Latitude or longitude isnt numbers</h5>
                        </div>
                        <?php
                        return;
                    }
                    if (ctype_alpha(str_replace(' ', '', $_POST['name'])) === false) {
                        ?>
                        <div class="alert alert-danger">
                            <h5>Name must contain only letters</h5>
                        </div>
                        <?php
                        return;
                    }

                    $data['id'] = $id;
                    $data['name'] = $updateData['name'];
                    $data['country_name'] = $updateData['country_name'];
                    $data['location'] = $updateData['longitude']. ', '. $updateData['latitude'];
                    $data['airline_name'] = implode(", ", $updateData['airline_name']);
                    
                    $query = "UPDATE airport SET name='$data[name]', country_name='$data[country_name]', location='$data[location]', airline_name='$data[airline_name]' WHERE id='$data[id]'";

                    if ($sql = $this->conn->query($query)) {
                        echo "<script> alert('Airport updated successfully');</script>";
                    }
                }else{
                    ?>
                    <div class="alert alert-danger">
                        <h5>Airport name, country, location or airline is empty</h5>
                    </div>
                    <?php
                    return;
                }
            }else{
                ?>
                <div class="alert alert-danger">
                    <h5>All fields must be valid</h5>
                </div>
                <?php
                return;
            }
        }
    }
}


?>