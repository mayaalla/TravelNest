<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  ob_start();
}
include('db.php');
$sqleventon = 'SET GLOBAL event_scheduler="ON"';
$resulteventon = mysqli_query($conn, $sqleventon);
if(isset($_POST['logout'])){
    $_SESSION['username'] = '';
    header('location: index.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Mr+Dafoe&family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <title>
      TravelNest
    </title>
  </head>
  <style>
    @media (min-width: 577px) {
      .border-left-md {
        border-right: 2px solid white !important;
      }
    }
    @media (max-width: 993px) {
      #image{
        display: none;
      }
    }
    /* #home {
     background-image: url(../Hotel/images/Untitled\ design.png);
     background-size: cover;
     background-position: center;
     background-repeat: no-repeat;
} */
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
.allura-regular {
  font-family: "Allura", cursive;
  font-weight: 400;
  font-style: normal;
}
#body{
    background-color: #f3f3f5;
}

  </style>
  <body id="body">
    <header>
    <?php include ('header.php'); ?>
    </header>
    <main id="home" class="d-flex justify-content-center
    align-items-center" style="padding-top: 68px; background-color: #f3f3f5; ">
      <div class="container d-flex flex-column py-5">
        <div class="d-flex flex-row justify-content-between flex-wrap mb-5">
        <div class="d-flex flex-column justify-content-between flex-wrap">
        <h1 class="display-3 text-left text-black fw-bolder">
          Get started your<br> exciting 
          <span style="color:#FF731D;">
            journey<br>
          </span>
          with us
        </h1>
        <p class="text-black" style="font-size: 1rem;">
        Find the perfect accommodation for every moment of your travels,<br>start exploring now and let TravelNest inspire your next adventure.
        </p>
        <form action="room.php" method="get">
        <a href="#search" class="btn btn-primary" style="font-size: 1rem; max-width: 200px"><i class="fa-solid fa-circle-play"></i> Explore Now</a>
        </form>
        </div>
        <div>
            <img id="image" src="images/Group 36 (1).png" alt="hotel" class="img-fluid" style="max-width: 500px; height:400px;">
        </div>
        </div>
        <div id="search">
        <?php include ('searchcard.php'); ?> 
        </div>
      </div>
    </main>
      <section class="" id="room" style="background-color: #f3f3f5" >
      <div class="container d-flex flex-column gap33">
        <h1 class="text-center mb-4 a33-4">
          Exclusive
          <span class="text-primary">
            deals & discounts
          </span>
        </h1>
        <?php include ('roomcards.php'); ?>
        </div>
    </section>
    <?php include ('contact.php'); ?>
    <main id="lockout" class="text-center text-info d-none">
        <h1 style="font-size:7rem">404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you are looking for could not be found.</p>
    </main>
    <?php include ('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
      let devise = document.getElementById('devise');
        console.log(devise);
      let price = document.getElementsByClassName('price');
      console.log(price);
      devise.addEventListener('change', function(){
        console.log(devise.value);
        for (let i = 0; i < price.length; i++) {
          let value = parseFloat(devise.value.match(/[\d]*[.]{0,1}[\d]+/)[0]);
          let sign = devise.value.replace(/[^^\D.]/g, "");
          sign = sign.replace(/\./g, "");
          price[i].innerHTML = (price[i].getAttribute('data-original-price') * value).toFixed(0) + sign + '<span class="" style="font-size:16px; color: black; font-weight: 300;">/night</span>';
        }
      });
      let contact = document.getElementById('contact');
      let home = document.getElementById('home');
      let room = document.getElementById('room');
      let body = document.getElementById('body');
      let lockout = document.getElementById('lockout');
      let footer = document.getElementById('footer');
      let navlink = document.getElementsByClassName('nav-link');
      let seconecter = document.getElementById('seconecter');
      var anchorElement = document.querySelector('a.navbar-brand#brand');
      // make the image none whene the width is less than the medium
      
    </script> 
  </body>
</html>
<?php
if(isset($_POST['lockout'])){
    session_destroy();
    echo "<script>
    contact.style.display = 'none';
    home.classList.remove('d-flex');
    home.style.display = 'none';
    room.style.display = 'none';
    body.style.height = '100vh';
    
    for(let i = 0; i < navlink.length; i++){
        navlink[i].style.display = 'none';
    }
    seconecter.style.display = 'none';
    devise.style.display = 'none';
    lockout.classList.remove('d-none');
    lockout.classList.add('d-flex');
    lockout.classList.add('justify-content-center');
    lockout.classList.add('align-items-center');
    lockout.classList.add('text-center');
    lockout.classList.add('flex-column');
    fotterheight = footer.offsetHeight;
    lockout.style.height = 'calc(100vh - ' + fotterheight + 'px)';
    if (anchorElement) {
      // Create a new <div> element
      var divElement = document.createElement('div');
  
      // Copy the content of the <a> element to the <div> element
      divElement.innerHTML = anchorElement.innerHTML;
  
      // Copy attributes from <a> to <div>, excluding href
      var attributes = anchorElement.getAttributeNames();
      attributes.forEach(function(attr) {
          if (attr !== 'href') {
              divElement.setAttribute(attr, anchorElement.getAttribute(attr));
          }
      });
  
      // Replace the <a> element with the new <div> element
      anchorElement.parentNode.replaceChild(divElement, anchorElement);
  }
    </script>";
  }

?>