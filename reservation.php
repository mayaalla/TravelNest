
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
include('db.php');
$x=0;

// virify that username session is set
if(!isset($_SESSION['username'])){
    echo '<script>window.location.href = "login.php"</script>';
}


if(isset($_GET['submit'])){
    $hotel_id = $_GET['hotel_id'];
    $room_id = $_GET['room_id'];
    $destination = $_GET['destination'];
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
    $totalprice = $_GET['totalprice'];
    $pricepernight = $_GET['pricepernight'];
    $numberOfDays = $_GET['numberOfDays'];
    $adult = $_GET['adults'];
    $child = $_GET['children'];
    if(isset($_GET['username'])){
        $username = $_GET['username'];
        $sqluser = "select * from user where username = '$username'";
        $resultuser = mysqli_query($conn, $sqluser);
        $rowuser = mysqli_fetch_assoc($resultuser);
        $x=1;
    }else{
        $username = 'guest';
    }
    $sqlhotel = "select * from hotel where id = $hotel_id";
    $resulthotel = mysqli_query($conn, $sqlhotel);
    $rowhotel = mysqli_fetch_assoc($resulthotel);
    $sqlroom = "select * from room where id = $room_id";
    $resultroom = mysqli_query($conn, $sqlroom);
    $rowroom = mysqli_fetch_assoc($resultroom);
    $sqlimg = "select * from hotel_images where hotel_id = $hotel_id";
    $resultimg = mysqli_query($conn, $sqlimg);
    $sqlnote = "select average_note from hotel_average_notes where hotel_id = $hotel_id";
    $resultnote = mysqli_query($conn, $sqlnote);
    $rownote = mysqli_fetch_assoc($resultnote);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title></title>
</head>
<style>
    body{
        background-color: #f3f3f5 !important;
    }
     @media (min-width: 577px) {
      .border-left-md {
        border-right: 2px solid white !important;
      }
      .big-row{
        flex-direction: row !important;
      }
    }
    main {
     background-image: url(../Hotel/images/photo_5913270656731037523_y.jpg);
     background-size: cover;
     background-position: center;
     background-repeat: no-repeat;
}
 h1, h2, h3, h4, p, .btn, label, input, select, option,a{
     font-family: 'Noto Sans', sans-serif !important;
}

 a{
     text-decoration: none;
     color: white;
}
 #signup{
     color: #FF731D !important;
}
 #signup:hover{
     color: white !important;
}
 .form-select{
     border: #FF731D 1px solid !important ;
     color: #FF731D;
}
 .check-avblt{
     background-color: white !important;
     border-radius: 10px;
}
 .btn{
     color: white !important;
}
.nav-item{
    display: none !important;
}
.nav-link{
    font-weight: 600 !important;
    position: relative;
    transition: color 0.3s;
}
.nav-link::before{
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background-color: #FF731D;
    transition: width 0.3s;
}
.nav-link:hover::before{
    width: 100%;
}
.nav-link:hover{
    color: #FF731D !important;
}
.navbar-brand {
  font-family: "Orbitron", sans-serif !important;
  font-optical-sizing: auto;
  font-weight: 600;
  font-style: normal;
  font-size: 1.75rem;
}
</style>
<body>

    <header><?php include('header.php') ?></header>
    <form action="reservations.php" method="post">
    <section style="padding:120px 0"> 
        <div class="container ">
            <div class="row gap-2 big-row flex-column">
                <div class="col-md-4 mb-3 px-0 mx-1 order-md-2 rounded border bg-white">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade">
                        <div class="carousel-inner">
                            <?php $i=0; while($rowimg = mysqli_fetch_assoc($resultimg)){ ?>
                                <?php if($i==0){ $i++; ?>
                            <div class="carousel-item active">
                                <img src="images/hotelspic/<?php echo $rowimg['url'] ?>" class="d-block w-100" style="aspect-ratio: 16/ 9;">
                            </div>
                            <?php }else{ ?>
                            <div class="carousel-item">
                                <img src="images/hotelspic/<?php echo $rowimg['url'] ?>" class="d-block w-100" style="aspect-ratio: 16/ 9;">
                            </div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="px-3 mt-2">
                        <h4 class="m-0">
                            <?php echo $rowhotel['name'] ?>
                        </h4>
                        <p class="fw-bold mb-0" style="font-size:.75rem">
                            <?php  
                            $sqlcontry = "select * from countries where countries_id = ".$rowhotel['countries_id'];
                            $resultcontry = mysqli_query($conn, $sqlcontry);
                            $rowcontry = mysqli_fetch_assoc($resultcontry);
                            $sqlstate = "select * from states where id_state = ".$rowhotel['id_state'];
                            $resultstate = mysqli_query($conn, $sqlstate);
                            $rowstate = mysqli_fetch_assoc($resultstate);
                            echo $rowcontry['name'].", ".$rowstate['name'];
                            ?>
                        </p>
                        <p style="font-size:.75rem">
                            <?php for($i=0; $i<$rowhotel['nbrstar']; $i++){
                                echo "<i class='fa-solid fa-star text-primary'></i>";
                            } ?>
                        </p>
                        <p class="mb-3" style="font-weight:600; font-size:14px">
                            <span class="text-white p-2 bg-primary rounded"><?php if($rownote['average_note']== null){echo "0.0";}else{echo $rownote['average_note'];} ?></span>
                            <?php 
                                if($rownote['average_note'] >= 7 && $rownote['average_note'] < 8){
                                    echo "Good";
                                }elseif($rownote['average_note'] >= 8 && $rownote['average_note'] < 9){
                                    echo "Very Good";
                                }elseif($rownote['average_note'] >= 9){
                                    echo "Excellent";
                                }else{
                                    echo "";
                                }
                            ?>
                        </p>
                        <p class="fw-bold mb-2" style="font-size:.75rem">Room: <?php echo $rowroom['type'] ?></p>
                        <p class="fw-bold mb-2" style="font-size:.75rem">Room capacity: <?php echo $rowroom['capacity'] ?></p>
                        <p class="fw-bold mb-2" style="font-size:.75rem">Check in: 
                            <?php echo $checkin ?>
                        </p>
                        <p class="fw-bold mb-1 pb-3" style="font-size:.75rem; border-bottom: solid 1px var(--bs-border-color);">Check out: 
                            <?php echo $checkout ?>
                        </p>
                        <h5 class="fw-bold">
                            Payment details:
                        </h5>
                        <p class="fw-bold mb-0 d-flex flex-wrap flex-row justify-content-between" style="font-size: 16px">
                        <span><?php echo $numberOfDays; 
                        if($numberOfDays==1){
                            echo " night";
                        }else {
                            echo " nights";
                        }
                        ?> </span>
                        <span class="price" data-original-price=<?php echo $totalprice ?>>
                            <?php echo $totalprice ?>$
                        </span>
                        </p>
                        <p class="mb-2 d-flex flex-wrap flex-row justify-content-between" style="font-size:0.75rem">
                        <span class="price-night" data-original-price=<?php echo $pricepernight ?>><?php echo $pricepernight ?>$/night</span>
                        <span>include tax and fees</span>
                        </p>
                    </div>
                </div>
                <div class="col order-md-1 mb-3 ">
                    <div class="row mb-3 py-3 rounded border bg-white">
                        <div class="col">
                            <h5 class="text-dark">Welcome back, <?php echo $rowuser['prename'] ?></h5>
                            
                        </div>
                    </div>
                    <div class="row p-3 rounded border bg-white">
                        <h5 class="text-dark mx-0 px-0"><i class="fa-solid fa-user text-primary"></i> Your Information</h5>
                        <label for="name" style="font-size:0.75rem" class="form-label fw-bold text-dark mx-0 p-0">Name</label>
                        <?php if($x==1){ ?>
                        <input type="text" class="form-control mb-2" id="name" value="<?php echo $rowuser['name'] ?>">
                        <?php }else{ ?>
                        <input type="text" class="form-control mb-2" id="name" value="">
                        <?php } ?>
                        <label for="prename" style="font-size:0.75rem" class="form-label fw-bold text-dark mx-0 p-0">Last Name</label>
                        <?php if($x==1){ ?>
                        <input type="text" class="form-control mb-2" id="prename" value="<?php echo $rowuser['prename'] ?>">
                        <?php }else{ ?>
                        <input type="text" class="form-control mb-2" id="prename" value="">
                        <?php } ?>
                        <label for="email" style="font-size:0.75rem" class="form-label fw-bold text-dark mx-0 p-0">Email</label>
                        <?php if($x==1){ ?>
                        <input type="email" class="form-control mb-2" id="email" value="<?php echo $rowuser['email'] ?>">
                        <?php }else{ ?>
                        <input type="email" class="form-control mb-2" id="email" value="">
                        <?php } ?>
                        <label for="phone" style="font-size:0.75rem" class="form-label fw-bold text-dark mx-0 p-0">Phone</label>
                        <?php if($x==1){ ?>
                        <input type="text" class="form-control mb-2" id="phone" value="<?php echo $rowuser['phone'] ?>">
                        <?php }else{ ?>
                        <input type="text" class="form-control mb-2" id="phone" value="">
                        <?php } ?>
                        <P class="fw-bold px-0" style="font-size:0.75rem">
                        Check in: <?php echo $checkin ?>
                        </P>
                        <P class="fw-bold px-0" style="font-size:0.75rem">
                        Check out: <?php echo $checkout ?>
                        </P>
                        <div class="p-0 mt-2 d-flex flex-wrap flex-row justify-content-between align-items-baseline">
                        <label for="address" style="font-size:0.75rem" class="form-label fw-bold text-primary mx-0 p-0"><i class="fa-solid fa-circle-exclamation"></i> No prepayment needed – pay at the property</label>
                        <button type="submit" name="book" class="btn btn-primary fw-bold">Book</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" name="hotel_id" value="<?php echo $hotel_id ?>">
    <input type="hidden" name="room_id" value="<?php echo $room_id ?>">
    <input type="hidden" name="destination" value="<?php echo $destination ?>">
    <input type="hidden" name="checkin" value="<?php echo $checkin ?>">
    <input type="hidden" name="checkout" value="<?php echo $checkout ?>">
    <!-- adults and user if existe -->
    <input type="hidden" name="adults" value="<?php echo $adult ?>">
    <input type="hidden" name="children" value="<?php echo $child ?>">
    <input type="hidden" name="totalprice" value="<?php echo $totalprice ?>">
    
    <input type="hidden" name="username" value="<?php echo $username ?>">

    </form>
    <?php include ('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        let devise = document.getElementById('devise');
        console.log(devise);
        let price = document.getElementsByClassName('price');
        console.log(price);
        let priceNight = document.getElementsByClassName('price-night');
        devise.addEventListener('change', function(){
        console.log(devise.value);
        let value = parseFloat(devise.value.match(/[\d]*[.]{0,1}[\d]+/)[0]);
        let sign = devise.value.replace(/[^^\D.]/g, "");
        sign = sign.replace(/\./g, "");
        console.log(sign);
        console.log(value);
        for(let i=0; i<price.length; i++){
            price[i].innerHTML = (price[i].getAttribute('data-original-price') * value).toFixed(0) + sign;
            priceNight[i].innerHTML = (priceNight[i].getAttribute('data-original-price') * value).toFixed(0) + sign + '/night';
        }
        });
    </script> 
</body>
</html>
<?php
if(isset($_POST['book'])){
$cuurentdate = date('Y-m-d');
if($usename != 'guest'){
    $sql = "insert into reservation (user_id, room_id, date_debut, date_fin, nbr_person, status, hotel_id, Total_price, nbr_child, reservation_date) values (".$rowuser['id'].", $room_id, '$checkin', '$checkout', $adult, 'Confirmed', $hotel_id, $totalprice, $child, '$cuurentdate')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('Reservation done successfully')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }else{
        echo "<script>alert('Reservation failed')</script>";
    }
}else{
    $sql = "insert into reservation (room_id, date_debut, date_fin, nbr_person, status, hotel_id, Total_price, nbr_child, reservation_date) values ($room_id, '$checkin', '$checkout', $adult, 'Confirmed', $hotel_id, $totalprice, $child, '$cuurentdate')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('Reservation done successfully')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }else{
        echo "<script>alert('Reservation failed')</script>";
}
}
}
?>