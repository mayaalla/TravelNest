<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
  include('../db.php');


  if($_SESSION['partner'] == "" ){
    echo '<script>window.location.href = "index.php"</script>';
  }else{
    $sqlpartner = 'select * from partner where username = "'.$_SESSION['partner'].'"';
    $rsltpartner = mysqli_query($conn, $sqlpartner);
    $rowpartner = mysqli_fetch_assoc($rsltpartner);
  }
    $sql = 'select * from room where hotel_id in (select id from hotel where id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'"))';
    $rslt = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($rslt);
    $sqlhotel = 'select * from hotel where id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'")';
    $rslthotel = mysqli_query($conn, $sqlhotel);
    $rowhotel = mysqli_fetch_assoc($rslthotel);

    $sqlopen = 'select * from option where type in ("R")';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Travel Nest</title>
</head>
<style>
  h1, h2, h3, h4, p, .btn, label, input, select, option,a{
    font-family: 'Noto Sans', sans-serif !important;
}
a{
  text-decoration: none;

}
body{
        background-color: #f3f3f5;
    }
    li{
        transition: 0.2s background-color;
    }
    a{
        transition: 0.2s background-color;
    }
     li:hover{
        background-color: #58538e !important;
        cursor: pointer;
    }
    li:hover a{
        background-color: #58538e !important;
    }
    /* .list-group-item:hover a{
        background-color: #ffffff25 !important;
    
    } */
    .dash-nav-ui{
        /* height: 100vh; */
        position: relative;
        flex-shrink: 0;
    }
    .logout{
        position: absolute;
        bottom: 8px;
        width: 90%;
    }
    .logout:hover{
        background-color: #ff8845 !important;        cursor: pointer;
    }

    
    .link{
        white-space: nowrap !important;
        overflow: hidden;
    }
    .active a{
        background-color: #58538e !important;
    }
    .active{
        background-color: #58538e !important;
    }
    @media (max-width: 769px) {
        .list-group-item span{
            display: none !important;
        }
        .dash-nav{
            transition: 0.2s width;
        }
        .dash-nav:hover{
            width: 33.333333333% !important;
        }
        .dash-nav:hover span{
            display: inline-block !important;
        }
        .dash-nav:hover .logout{
            width: 85% !important;
        }
        .logout{
            width: 75% !important;
        }
}
label{
  font-size: 14px;
  font-weight: 600;
}
table > *{
    background-color: #58538e !important;
    text-align: center !important;
    width: 100% !important;
}
th, td{
    padding: 0.5rem !important;
    background-color: #58538e !important;
    color: white !important;
    
}
/* change the place holder opcity */
input::placeholder{
    color: #00000050 !important;
    font-weight: 600 !important;
}
</style>
<body>
    <?php include('header.php'); ?>
    <div class="container-fluid">
        <div class="row  flex-nowrap">
            <div class="col-2 dash-nav py-2 bg-info text-white" style="overflow-x:hidden !important; font-size: 14px !important">
              <form action="" method="post">
              <ul class="list-group dash-nav-ui  bg-info text-white" id="dash-nav-ui">
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="partner.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-user"></i> <span>Compte</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="property.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-hotel"></i> <span>Property</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2 active" style="border: none !important;" ><a class="text-white bg-info link" href="rooms.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bed"></i> <span>Rooms</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="booking.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i> <span>Booking</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="occupedroom.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-lock"></i> <span>Occupied room</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="commentrate.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i> <span>Comments and Rate</span></a></li>
                
                
              </ul>
              </form>
            </div>
            <div class="col py-3">
                <h3>Add room</h3>
                <form action="addroom.php" method="post" enctype="multipart/form-data">
                    <div class="d-flex flex-row flex-wrap gap-3">
                    <div class="col">
                    <label for="room">Room Type</label>
                    <input type="text" name="type" class="form-control mb-2" required>
                    </div>
                    <div class="col">
                    <label for="room">Number of rooms with this type</label>
                    <input type="number" name="number" class="form-control mb-2" required></div>
                    </div>
                    <label for="room">Room Price</label>
                    <input placeholder="$" type="text" name="price" class="form-control mb-2" required>
                    <label for="room">Bed Number</label>
                    <input type="text" name="bed" class="form-control mb-2" required>
                    <label for="room">Bed Type</label>
                    <input type="text" name="bedtype" class="form-control mb-2" required>
                    <!-- capacitye of persone -->
                    <label for="room">Capacity</label>
                    <input type="number" name="capacity" class="form-control mb-2" required>
                    <!-- size -->
                    <label for="room">Size</label>
                    <input type="text" name="size" placeholder=m&sup2 class="form-control mb-2" required>
                    <!-- view -->
                    <label for="room">View</label>
                    <input type="text" name="view" class="form-control mb-2">
                    <!-- images -->
                    <label for="room">Images</label>
                    <input type="file" name="file[]" class="form-control" multiple required>
                    <p style="font-size: 0.75rem;" class="text-primary m-0 p-0 mb-2">you can add multiple images</p>
                    <h5 for="room">Services</h5>
                    <div class="row m-0 gap-5">
                    <?php
                    $rsltopen = mysqli_query($conn, $sqlopen);
                    while($rowopen = mysqli_fetch_assoc($rsltopen)){
                    ?>
                    <div class="form-check col-5">
                        <input class="form-check-input" type="checkbox" name='option[]' value='<?php echo $rowopen['name'] ?>' >
                        <label class="form-check-label" for="flexCheckDefault">
                            <?php echo $rowopen['name'] ?>
                        </label>
                        <br>
                        <label  class="form-check-label">Price</label>
                        <input type="text" placeholder="$" name="price0[]" class="form-control mb-2">
                    </div>
                    <?php } ?>
                    </div>
                    

                    <button type="submit" name="addroom" class="btn btn-primary text-white fw-bold" style="width: 100%; margin-top: 16px;">Add Room</button>
                </form>

            </div>

        </div>
    </div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
<?php

if(isset($_POST['addroom'])){
    $type = $_POST['type'];
    $number = $_POST['number'];
    $price = $_POST['price'];
    $bed = $_POST['bed'];
    $bedtype = $_POST['bedtype'];
    $capacity = $_POST['capacity'];
    $size = $_POST['size'];
    // $view = $_POST['view'];
    if($_POST['view'] == ""){
        $view = "";
    }else{
        $view = $_POST['view'];
    }


    if($view != ""){
        $type = $type . ' with '. $view;
    }
    // hotel_id, type, price, bedtype, bednmbr, capacity, size
    $hotel_id = $rowhotel['id'];

    if($number > 1){
        for($i = 0; $i < $number; $i++){
            $sql = 'insert into room (hotel_id, type, price, bedtype, bednbr, capacity, size) values ("'.$hotel_id.'", "'.$type.'", "'.$price.'", "'.$bedtype.'", "'.$bed.'", "'.$capacity.'", "'.$size.'")';
            $rslt = mysqli_query($conn, $sql);
        }
    }else{
        $sql = 'insert into room (hotel_id, type, price, bedtype, bednbr, capacity, size) values ("'.$hotel_id.'", "'.$type.'", "'.$price.'", "'.$bedtype.'", "'.$bed.'", "'.$capacity.'", "'.$size.'")';
        $rslt = mysqli_query($conn, $sql);
    }





    // Get the last inserted room id
    $sqlroom = 'select * from room where hotel_id = "'.$hotel_id.'" order by id desc limit '.$number;
    $rsltroom = mysqli_query($conn, $sqlroom);
    while($rowroom = mysqli_fetch_assoc($rsltroom)){
        $room_id = $rowroom['id'];
        $uploadDirectory = '../images/roompic/';
        $filePaths = array();
    
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['file']['name'][$key];
            $file_path = $uploadDirectory . $file_name;
    
            // Move uploaded file to the server
            move_uploaded_file($tmp_name, $file_path);
            $file_path = $file_name;
    
            // Store file path in an array
            $filePaths[] = $file_path;
        }
    
        // Insert file paths into the database
        foreach ($filePaths as $filePath) {
            $sqlimage = 'INSERT INTO room_images (room_id, hotel_id, url) VALUES ("'.$room_id.'", "'.$hotel_id.'", "'.$filePath.'")';
            mysqli_query($conn, $sqlimage);
        }
    }

    $options = $_POST['option'];
    $prices = $_POST['price0'];
    $prices = array_filter($prices);
    $prices = array_values($prices);// This will capture all prices as an array

    foreach ($options as $key => $option) {
        $price1 = $prices[$key];
        $sqlinsert = 'insert into room_option (room_id, hotel_id, name, price) values ("'.$room_id.'", "'.$hotel_id.'", "'.$option.'", "'.$price1.'")';
        $rsltinsert = mysqli_query($conn, $sqlinsert);
    }
    

   
    echo '<script>alert("Room added successfully")</script>';
    echo '<script>window.location.href = "rooms.php"</script>';


    
    

}