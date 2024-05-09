<?php
include('../db.php');
$country_name = $_GET['country_name'];
$sql = 'select * from countries where name = "'.$country_name.'"';
$rslt = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rslt);
$country_id = $row['countries_id'];
?>

    <label class="mt-3" for="city">City</label>
    <?php 
    $sqlstate = 'select * from states where countries_id = '.$country_id;
    $rsltstate = mysqli_query($conn, $sqlstate);
        ?>
    <select name="city" class="form-select">
        <?php while($rowstate = mysqli_fetch_assoc($rsltstate)){ ?>
            <option value="<?php echo $rowstate['name'] ?>"><?php echo $rowstate['name'] ?></option>
        <?php } ?>
    </select>
