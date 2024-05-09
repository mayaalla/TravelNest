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
  $sqlhotel = 'select * from hotel where id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'")';
    $rslthotel = mysqli_query($conn, $sqlhotel);
    $rowhotel = mysqli_fetch_assoc($rslthotel);
    $hotelid = $rowhotel['id'];
    $id = $_GET['id'];
    $sql = 'select * from reservation where id = "'.$id.'"';
    $rslt = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($rslt);
    // check if user_id != null
    if($row['user_id'] != null){
        $sqluser = 'select * from user where id = "'.$row['user_id'].'"';
        $rsltuser = mysqli_query($conn, $sqluser);
        $rowuser = mysqli_fetch_assoc($rsltuser);
        $name = $rowuser['name'];
        $email = $rowuser['email'];
        $phone = $rowuser['phone'];
    }else{
        $name = 'User Deleted';
        $email = 'User Deleted';
        $phone = 'User Deleted';
    }
    $action = 'editbooking.php?id='.$id;
    
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
.col-2{
    min-height: 100vh;
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
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="rooms.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bed"></i> <span>Rooms</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2 active" style="border: none !important;" ><a class="text-white bg-info link" href="booking.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i> <span>Booking</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="occupedroom.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-lock"></i> <span>Occupied room</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="commentrate.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i> <span>Comments and Rate</span></a></li>
              </ul>
              </form>
            </div>
            <div class="col py-3">
                <h3>Edit Reservation <?php echo $id ?> </h3>
                <form action="<?php echo $action ?>" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control mb-2" value="<?php echo $name ?>" disabled>
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control mb-2" value="<?php echo $email ?>" disabled>
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control mb-2" value="<?php echo $phone ?>" disabled>
                <label for="checkin">Check In</label>
                <input type="date" name="checkin" class="form-control mb-2" value="<?php echo $row['date_debut'] ?>">
                <label for="checkout">Check Out</label>
                <input type="date" name="checkout" class="form-control mb-2" value="<?php echo $row['date_fin'] ?>">
                <label for="room">Room</label>
                <select name="room" class='form-select mb-2'>
                    <?php 
                        $sqlroom = 'select * from room where hotel_id = "'.$hotelid.'"';
                        $rsltroom = mysqli_query($conn, $sqlroom);
                        while($rowroom = mysqli_fetch_assoc($rsltroom)){
                            if($row['room_id'] == $rowroom['id']){
                                echo '<option value="'.$rowroom['id'].'" selected>'.$rowroom['id'].'</option>';
                            }else{
                                echo '<option value="'.$rowroom['id'].'">'.$rowroom['id'].'</option>';
                            }
                        }
                    ?>
                </select>
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control mb-2" value="<?php echo $row['Total_price'] ?>" disabled>
                <label for="guest">Guest Number</label>
                <input type="text" name="guest" class="form-control mb-2" value="<?php echo $row['nbr_person']  ?>">
                <label for="status">Child Number</label>
                <input type="text" name="child" class="form-control mb-2" value="<?php echo $row['nbr_child']  ?>">
                <label for="status">Status</label>
                <select name="status" class='form-select mb-2'>
                    <option value="pending" <?php if($row['status'] == 'pending'){echo 'selected';} ?>>Pending</option>
                    <option value="confirmed" <?php if($row['status'] == 'confirmed'){echo 'selected';} ?>>Confirmed</option>
                    <option value="cancelled" <?php if($row['status'] == 'cancelled'){echo 'selected';} ?>>Cancelled</option>
                </select>
                <button type="submit" name="editreservation" class="btn btn-primary text-white fw-bold mb-5" style="width: 100%; margin-top: 16px;">Edit Reservation</button>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
<?php 

if(isset($_POST['editreservation'])){
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room = $_POST['room'];
    $price = $_POST['price'];
    $guest = $_POST['guest'];
    $child = $_POST['child'];
    $status = $_POST['status'];
    $sql = 'update reservation set date_debut = "'.$checkin.'", date_fin = "'.$checkout.'", room_id = "'.$room.'", Total_price = "'.$price.'", nbr_person = "'.$guest.'", status = "'.$status.'", nbr_child = "'.$child.'" where id = "'.$id.'"';
    $rslt = mysqli_query($conn, $sql);
    if($rslt){
        echo '<script>alert("Reservation Updated")</script>';
        echo '<script>window.location.href = "booking.php"</script>';
    }else{
        echo '<script>alert("Error")</script>';
    }
}


