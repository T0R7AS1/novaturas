<?php

    Class AirlineModel{
        
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
                if (isset($_POST['name']) && isset($_POST['country_name'])) {
                    if (!empty($_POST['name']) && !empty($_POST['country_name'])) {
                        $isValidName = (bool) strlen(trim($_POST['name']));
                        $isValidCountryName = (bool) strlen(trim($_POST['country_name']));
                        if (!$isValidName && !$isValidCountryName) {
                            ?>
                            <div class="alert alert-danger">
                                <h5>Airline name or country contains only spaces</h5>
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
                        
                        $name = $_POST['name'];
                        $country_name = $_POST['country_name'];
                        
                        $query = "INSERT INTO airline (name, country_name) VALUES ('$name', '$country_name')";
                        
                        if ($sql = $this->conn->query($query)) {
                            echo "<script> alert('Airline created successfully');</script>";
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger">
                            <h5>Airline name or country is empty</h5>
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

            $query = "SELECT * FROM airline";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function delete($id){
            $query = "DELETE FROM airline WHERE id = '$id'";
            if ($sql = $this->conn->query($query)) {
                return true;
            }else{
                return false;
            }
        }
        public function fetch_single($id)
        {
            $data = null;
            $query = "SELECT * FROM airline WHERE id = '$id'";
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
            $query = "SELECT * FROM airline WHERE id = '$id'";
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
                if (isset($_POST['name']) && isset($_POST['country_name'])) {
                    if (!empty($_POST['name']) && !empty($_POST['country_name'])) {
                        $isValidName = (bool) strlen(trim($_POST['name']));
                        $isValidCountryName = (bool) strlen(trim($_POST['country_name']));
                        if (!$isValidName && !$isValidCountryName) {
                            ?>
                            <div class="alert alert-danger">
                                <h5>Airline name or country contains only spaces</h5>
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
                        
                        $query = "UPDATE airline SET name='$data[name]', country_name='$data[country_name]' WHERE id='$data[id]'";

                        if ($sql = $this->conn->query($query)) {
                            echo "<script> alert('Airline updated successfully');</script>";
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger">
                            <h5>Airline name or country is empty</h5>
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