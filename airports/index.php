<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../layouts/header.php';
include '../airportModel.php';
$airportModel = new AirportModel();
$rows = $airportModel->fetch();

?>
<table class="table">
    <thead>
        <th>Airport name</th>
        <th>Country</th>
        <th>Location(longitude, latitude)</th>
        <th>Airlines</th>
        <th style="text-align:right; width: 30%" >Actions</th>
    </thead>
    <tbody>
        <?php 
            if (empty($rows)) {
                echo "No data to display";
                return;
            }
        ?>
        <?php foreach ($rows as $val): ?>
            <tr>
                <td><?php echo $val['name']?></td>
                <td><?php echo $val['country_name']?></td>
                <td><?php echo $val['location']?></td>
                <td><?php echo $val['airline_name']?></td>
                <td style="text-align:right;">
                <a href="../airports/show.php?id=<?php echo $val['id']?>" class="btn btn-success">Show</a>
                <a href="../airports/edit.php?id=<?php echo $val['id']?>" class="btn btn-warning">Edit</a>
                <a href="../airports/delete.php?id=<?php echo $val['id']?>" class="btn btn-danger">Delete</a>                
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include '../layouts/footer.php';?>