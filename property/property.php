<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
include('../db.php');
if($_SESSION['partner'] == "" ){
  header('Location: login.php');
}else{
  $sqlpartner = 'select * from partner where username = "'.$_SESSION['partner'].'"';
  $rsltpartner = mysqli_query($conn, $sqlpartner);
  $rowpartner = mysqli_fetch_assoc($rsltpartner);
}
$sqlproperty = 'select * from partnerhotel where partner_id = "'.$rowpartner['id'].'"';
$rsltproperty = mysqli_query($conn, $sqlproperty);
$numrow = mysqli_num_rows($rsltproperty);

$sqloption = 'select * from option where type in("H", "HR")';
$resultoption = mysqli_query($conn, $sqloption);

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
    <title>Document</title>
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
<body class="d-grid">
    <?php include('header.php'); ?>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-2 dash-nav py-2 bg-info text-white" style="overflow-x:hidden !important; font-size: 14px !important">
              <form action="" method="post">
              <ul class="list-group dash-nav-ui  bg-info text-white" id="dash-nav-ui">
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="partner.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-user"></i> <span>Compte</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2 active" style="border: none !important;" ><a class="text-white bg-info link" href="property.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-hotel"></i> <span>Property</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="rooms.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bed"></i> <span>Rooms</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="booking.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i> <span>Booking</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="occupedroom.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-lock"></i> <span>Occupied room</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="commentrate.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i> <span>Comments and Rate</span></a></li>
              </ul>
              </form>
            </div>
            <div class="col py-3">
                <?php 
                if($numrow > 0){
                    include('modifyproperty.php');
                    ?>
                <?php
                }else{ 
                    include('addproperty.php');
                }
                ?>
            </div>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script>
    // get the header hieght
    let header =document.getElementById('header');
let headerHeight = header.clientHeight;
let dashNav = document.getElementById('dash-nav-ui');
dashNav.style.height = 'calc(100vh - '+headerHeight+'px)';
let q3 =document.getElementById('q3');
console.log(q3.name);
  </script>
</body>
</html>
<?php


//Modify property information
if(isset($_POST['modifyproperty'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $stars = $_POST['stars'];
    $email = $_POST['email'];

    $sqlstates = 'select * from states where name LIKE "%'.$city.'%"';
    $rsltstates = mysqli_query($conn, $sqlstates);
    $rowstate = mysqli_fetch_assoc($rsltstates);
    $state_id = $rowstate['id_state'];
    
    $sqlcountry = 'select * from countries where name LIKE "%'.$country.'%"';
    $rsltcountry = mysqli_query($conn, $sqlcountry);
    $rowcountry = mysqli_fetch_assoc($rsltcountry);
    $country_id = $rowcountry['countries_id'];

    $sqlhotel = 'update hotel set name = "'.$name.'", adresse = "'.$address.'", phone = "'.$phone.'", countries_id = "'.$country_id.'", id_state = "'.$state_id.'", email = "'.$email.'", nbrstar = "'.$stars.'" where id = "'.$rowhotel['id'].'"';
    $rslthotel = mysqli_query($conn, $sqlhotel);
    echo '<script>alert("Property information modified successfully")</script>';
    echo '<script>window.location.href = "property.php"</script>';
}

//Add images to the property
if(isset($_POST['addimageproperty'])){
    $uploadDirectory = '../images/hotelspic/';
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
        $sqlimage = 'INSERT INTO hotel_images (hotel_id, url) VALUES ("'.$rowhotel['id'].'", "'.$filePath.'")';
        mysqli_query($conn, $sqlimage);
    }
    echo '<script>alert("Images added successfully")</script>';
    echo '<script>window.location.href = "property.php"</script>';
}

//Modify option price
if(isset($_POST['modifyoptionprice'])){
    $option = $_POST['option'];
    $price = $_POST['price'];
    $sqlupdate = 'update hotel_option set price = "'.$price.'" where hotel_id = "'.$rowhotel['id'].'" and option_name = "'.$option.'"';
    $rsltupdate = mysqli_query($conn, $sqlupdate);
    echo '<script>alert("Option price modified successfully")</script>';
    echo '<script>window.location.href = "property.php"</script>';
}
// Delete option
if(isset($_POST['deleteoption'])){
    $option = $_POST['option'];
    $sqldelete = 'delete from hotel_option where hotel_id = "'.$rowhotel['id'].'" and option_name = "'.$option.'"';
    $rsltdelete = mysqli_query($conn, $sqldelete);
    echo '<script>alert("Option deleted successfully")</script>';
    echo '<script>window.location.href = "property.php"</script>';
}

// Add option
if(isset($_POST['addoption'])){
    $options = $_POST['option'];
    $prices = $_POST['price'];
    $prices = array_filter($prices);
    $prices = array_values($prices);

    foreach ($options as $key => $option) {
        $price = $prices[$key];
        $sqlinsert = 'insert into hotel_option (hotel_id, option_name, price) values ("'.$rowhotel['id'].'", "'.$option.'", "'.$price.'")';
        $rsltinsert = mysqli_query($conn, $sqlinsert);
    }
    echo '<script>alert("Option added successfully")</script>';
    echo '<script>window.location.href = "property.php"</script>';
}
?>

