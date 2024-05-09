<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
    ob_start();
}
include('db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
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
main{
    /* background-color: #2B32B2; */
    padding: 120px 0 45px 0;
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
.more-dtl{
    color: #FF731D !important;
    background: none;
    transition: color 0.3s;
}
.more-dtl:hover{
    color: #c44d04 !important;
}
@media (max-width: 992px )  {
  .iframe{
    display: flex;
    justify-content: center;
    margin: 24px 0;
  }
  .iframe iframe{
    width: 100%;
    height: 250px;
  }
  .hotel-description{
    flex-direction: column;
  }
  .hotel-description .col-8{
    width: 100% !important;
  }
}
</style>
<body>
    <header>
    <?php 
include('header.php');
?>
    </header>
    <main class="bg-info">
      <div class="container">

          <?php $hotel_id = $_GET['hotel_id']; include ('searchcardforhotel.php'); ?>
      </div>
        <?php
        if(isset($_GET['destination']) && isset($_GET['checkin']) && isset($_GET['checkout']) && isset($_GET['adults']) && isset($_GET['children']) && isset($_GET['rooms'])){
            $destination = $_GET['destination'];
            $checkin = $_GET['checkin'];
            $checkout = $_GET['checkout'];
            $adults = $_GET['adults'];
            $children = $_GET['children'];
            $rooms = $_GET['rooms'];
        }
        echo "<script>
        let destination = document.getElementById('destination');
        destination.value = '".$destination."';
        let checkin = document.getElementById('checkin');
        checkin.value = '".$checkin."';
        let checkout = document.getElementById('checkout');
        checkout.value = '".$checkout."';
        let adults = document.getElementById('adults');
        adults.value = '".$adults."';
        let children = document.getElementById('children');
        children.value = '".$children."';
        let rooms = document.getElementById('rooms');
        rooms.value = '".$rooms."';
        </script>";

if(isset($_GET['checkin']) && isset($_GET['checkout'])){
  $checkinDate = new DateTime($checkin);
$checkoutDate = new DateTime($checkout);
$interval = $checkinDate->diff($checkoutDate);
$numberOfDays = $interval->days;
}
?>
    </main>
    <section>
      <?php include('hotelinfo.php'); ?>
    </section>
    <section class="pb-4">
      <?php include('hotelrooms.php') ?>
    </section>
    <section class="py-4">
      <?php include('review.php') ?>
    </section>
    <?php include ("footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script >
      let devise = document.getElementById('devise');

      let price = document.getElementsByClassName('price');
  
      devise.addEventListener('change', function(){

        for (let i = 0; i < price.length; i++) {
          let value = parseFloat(devise.value.match(/[\d]*[.]{0,1}[\d]+/)[0]);
          let sign = devise.value.replace(/[^^\D.]/g, "");
          sign = sign.replace(/\./g, "");

          if(price[i].tagName != "H5"){
            price[i].innerHTML = (price[i].getAttribute('data-original-price') * value).toFixed(0) + sign + '<span class="" style="font-size:16px; color: black; font-weight: 300;">/night</span>';
            }else{
              price[i].innerHTML = (price[i].getAttribute('data-original-price') * value).toFixed(0) + sign;
            }
        }
      });
</script> 
</body>
</html>