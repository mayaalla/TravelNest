<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
  include('../db.php');


  if($_SESSION['partner'] == "" ){
    echo '<script>window.location.href = "index.php"</script>';
  }
  $room_id = $_GET['id'];
    $hotel_id = $_GET['hotel_id'];
    $sql = 'select * from room where id = "'.$room_id.'" and hotel_id = "'.$hotel_id.'"';
    $rslt = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($rslt);
    $sqlimages = 'select * from room_images where room_id = "'.$room_id.'" and hotel_id = "'.$hotel_id.'"';
    $rsltimages = mysqli_query($conn, $sqlimages);
    $x = true;
    $i = 1;
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

    .carousel-item {
        position: relative;
        max-width: 100%;
        height: 400px;
    }
    .carousel-item  img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: filter 0.3s;
    }
    .delete-btn {
        position: absolute;
        top: 50%; /* Center vertically */
        left: 50%; /* Center horizontally */
        transform: translate(-50%, -50%); /* Adjust to exact center */
        display: none;
        z-index: 100;
    }
    .carousel-item:hover .delete-btn {
        display: block;
    }
    .carousel-item:hover img {
        filter: brightness(50%); /* Darken the image */
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
                <h3>Edit Images of Room <?php echo $room_id ?></h3>
                <?php 
                $action = 'roomimages.php?id='.$room_id.'&hotel_id='.$hotel_id.'';
                ?>
                <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <label for="image">Add Images</label>
                            <input type="file" name="file[]" class="form-control m-0" multiple required>
                            <p style="font-size: 0.75rem" class="text-primary m-0 mb-2 p-0">you can add multiple images</p>
                            <input type="hidden" name="room_id" value="<?php echo $room_id ?>">
                            <input type="hidden" name="hotel_id" value="<?php echo $hotel_id ?>"> 
                        </div>
                        
                    </div>
                    <button type="submit" name="addimage" class="btn btn-primary text-white mt-3 mb-3"><i class="fa-solid fa-plus"></i> Add Images</button>
                </form>
                <div class="col-12 mb-5 d-flex justify-content-center">
                <div style="width:50%; height:400px">
                <div id="carouselExampleIndicators" class="carousel slide" style="max-width:100%; height:400px">
  <div class="carousel-indicators">
    <?php while($rowimages = mysqli_fetch_assoc($rsltimages)){ 
        if($x){
        ?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <?php }else{ ?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to='<?php echo $i?>' aria-label="Slide <?php echo ++$i?>"></button>
        <?php } $x=false; } 
        $rsltimages = mysqli_query($conn, $sqlimages); $x=true; 
        ?>
  </div>
  <div class="carousel-inner">
    <?php while($rowimages = mysqli_fetch_assoc($rsltimages)){ 
        if($x){
        ?>
        
    <div class="carousel-item active">
      
        <img src="../images/roompic/<?php echo $rowimages['url'] ?>" class="d-block w-100" alt="...">
        <form action='<?php echo $action ?>' method="post">   
        <input type="hidden" name="room_id" value="<?php echo $rowimages['room_id'] ?>">
        <input type="hidden" name="hotel_id" value="<?php echo $rowimages['hotel_id'] ?>">
        <input type="hidden" name="image_id" value="<?php echo $rowimages['id'] ?>">
        <button name="deleteimg" class="btn btn-danger delete-btn" style="width:64px; height:64px"><i style="font-size: 1.5rem;" class="fa-solid fa-trash"></i></button>
        </form>
    </div>
        
        <?php $x=false; }else{ ?>
        
    <div class="carousel-item">
        
          <img src="../images/roompic/<?php echo $rowimages['url'] ?>" class="d-block w-100" alt="...">
          <form action='<?php echo $action ?>' method="post">
          <input type="hidden" name="room_id" value="<?php echo $rowimages['room_id'] ?>">
            <input type="hidden" name="hotel_id" value="<?php echo $rowimages['hotel_id'] ?>">
            <input type="hidden" name="image_id" value="<?php echo $rowimages['id'] ?>">
          <button name="deleteimg" class="btn btn-danger delete-btn" style="width:64px; height:64px"><i style="font-size: 1.5rem;" class="fa-solid fa-trash"></i></button>
          </form>
    </div>
        
        <?php }  } ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" style="width: 48px ; height:48px" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" style="width: 48px ; height:48px" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<?php 
$sqltotalimages = 'select count(*) as total from room_images where room_id = "'.$room_id.'" and hotel_id = "'.$hotel_id.'"';
$rslttotalimages = mysqli_query($conn, $sqltotalimages);
$rowtotalimages = mysqli_fetch_assoc($rslttotalimages);
?>
<p class="fw-bold text-primary ">Total images: <?php echo $rowtotalimages['total'] ?></p>
        </div>

                </div>
            </div>

        </div>
    </div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php

if(isset($_POST['addimage'])){

    $room_id = $_POST['room_id'];
    $hotel_id = $_POST['hotel_id'];
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
        if($sqlimage){
            echo '<script>alert("Images Added Successfully")</script>';
            echo '<script>window.location.href = "roomimages.php?id='.$room_id.'&hotel_id='.$hotel_id.'"</script>';
        }else{
            echo '<script>alert("Images Not Added")</script>';
        }
}

if(isset($_POST['deleteimg'])){
    $hotel_id = $_POST['hotel_id'];
    $room_id = $_POST['room_id'];
    $image_id = $_POST['image_id'];
    $sqldelete = 'delete from room_images where id = "'.$image_id.'"';
    $rsltdelete = mysqli_query($conn, $sqldelete);
    if($rsltdelete){
        echo '<script>alert("Image Deleted Successfully")</script>';
        echo '<script>window.location.href = "roomimages.php?id='.$_POST['room_id'].'&hotel_id='.$_POST['hotel_id'].'"</script>';
    }else{
        echo '<script>alert("Image Not Deleted")</script>';
    }
}