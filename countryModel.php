<?php

    Class CountryModel{
        
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
                if (isset($_POST['country_code']) && isset($_POST['name'])) {
                    if (!empty($_POST['country_code']) && !empty($_POST['name'])) {
                        $isValidCode = (bool) strlen(trim($_POST['country_code']));
                        $isValidName = (bool) strlen(trim($_POST['name']));
                        if (!$isValidCode && !$isValidName) {
                            ?>
                            <div class="alert alert-danger">
                                <h5>Country code or name contains only spaces</h5>
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

                        $country_code = $_POST['country_code'];
                        $name = $_POST['name'];

                        $query = "INSERT INTO country (country_code, name) VALUES ('$country_code', '$name')";

                        if ($sql = $this->conn->query($query)) {
                            echo "<script>alert('country added successfully');</script>";
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger">
                            <h5>Country code or name is empty</h5>
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

            $query = "SELECT * FROM country";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function delete($id){
            $query = "DELETE FROM country WHERE id = '$id'";
            if ($sql = $this->conn->query($query)) {
                return true;
            }else{
                return false;
            }
        }
        public function fetch_single($id)
        {
            $data = null;
            $query = "SELECT * FROM country WHERE id = '$id'";
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
            $query = "SELECT * FROM country WHERE id = '$id'";
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
                if (isset($_POST['country_code']) && isset($_POST['name'])) {
                    if (!empty($_POST['country_code']) && !empty($_POST['name'])) {
                        $isValidCode = (bool) strlen(trim($_POST['country_code']));
                        $isValidName = (bool) strlen(trim($_POST['name']));
                        if (!$isValidCode && !$isValidName) {
                            ?>
                            <div class="alert alert-danger">
                                <h5>Country code or name contains only spaces</h5>
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

                        $validationQuery = "SELECT * FROM country";
                        if ($sql = $this->conn->query($validationQuery)) {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                $validationData[] = $row;
                            }
                        }
                        $data['id'] = $id;
                        $data['country_code'] = $updateData['country_code'];
                        $data['name'] = $updateData['name'];
                        
                        $query = "UPDATE country SET country_code='$data[country_code]', name='$data[name]' WHERE id='$data[id]'";

                        if ($sql = $this->conn->query($query)) {
                            echo "<script>alert('country updated successfully');</script>";
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger">
                            <h5>Country code or name is empty</h5>
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