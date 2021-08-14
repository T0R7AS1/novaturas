<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../layouts/header.php';
include '../airlineModel.php';
$airlineModel = new AirlineModel();
$rows = $airlineModel->fetch();
?>
<table class="table">
    <thead>
        <th>Airline name</th>
        <th>Country</th>
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
                <td style="text-align:right;">
                <a href="../airlines/show.php?id=<?php echo $val['id']?>" class="btn btn-success">Show</a>
                <a href="../airlines/edit.php?id=<?php echo $val['id']?>" class="btn btn-warning">Edit</a>
                <a href="../airlines/delete.php?id=<?php echo $val['id']?>" class="btn btn-danger">Delete</a>                
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include '../layouts/footer.php';?>