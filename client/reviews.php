<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
}
include ('../db.php');
$username = $_SESSION['username'];
$sqluser = 'select * from user where username = "'.$username.'"';
$resultuser = mysqli_query($conn, $sqluser);
$rowuser = mysqli_fetch_assoc($resultuser);
$sqlcomment = 'select * from comment where user_id = '.$rowuser['id'];
$resultcomment = mysqli_query($conn, $sqlcomment);


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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <title>Document</title>
</head>
<style>
     h1, h2, h3, h4, p, .btn, label, input, select, option,a{
     font-family: 'Noto Sans', sans-serif !important;
     }
     .profilepic{
    color: white !important;
     }
     @media (min-width: 768px) {
  .fltr{
    display: none !important;
  }

}
   @media (max-width: 769px) {
    .a33{
        border: none !important;
    }
}
.a33{
    
    height: max-content;
}
h1{
    border-bottom: 1px solid #FF731D !important;
    padding-bottom: 16px;
}
</style>
<body>
<header>
<?php 
include ('header.php');
?>
</header>
<section style="padding: 120px 0;">
  <div class="container px-2">
    <div class="row gap-2">
        <div class="col-lg-2 a33 rounded ">
            <nav class="navbar p-0 w-100 navbar-expand-md">
            <div class="w-100" >
                  <button class="navbar-toggler w-100" type="button" data-bs-toggle="collapse" data-bs-target="#navbara" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand fltr" style=" color: rgba(0, 0, 0, 0) !important;" href="#">
                   Filtre
                    </a>
                  <div class="collapse w-100 navbar-collapse" id="navbara">
                    <div class="d-flex flex-column w-100">
                    <a href="profile.php" class="btn border text-primary p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= " border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                <i  class=" fa-solid fa-user"></i>
                <p class="m-0 p-0 ">Profile</p>
                
            </a>
            <a href="reservation.php" class=" btn border p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= " border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="fa-solid fa-bookmark text-primary"></i>
                <P class="m-0 p-o text-primary">My Reservation</p>
            </a>
            <a href="reviews.php" class="btn border btn-primary p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "color: white !important; border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="fa-solid fa-comment"></i>
                <P class="m-0 p-o ">My reviews</p>
            </a>
            <a href="setting.php" class="btn border p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="text-primary fa-solid fa-gear"></i>
                <p class="m-0 p-o text-primary">Settings</p>
            </a>
            </div>
                </div>
            </div>
            </nav>
            </div>
        <div class="col border-white px-4 py-3 border rounded" style="box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22) !important;
    backdrop-filter: blur(6px) !important;">
            <h1 class="text-center mb-4">My reviews</h1>
            <?php 
           
            ?>
            <div class="row gap-2">
                <?php 
                while($rowcomment = mysqli_fetch_assoc($resultcomment)){ 
                    $sqlhotel = 'select * from hotel where id = '.$rowcomment['hotel_id'];
                    $resulthotel = mysqli_query($conn, $sqlhotel);
                    $rowhotel = mysqli_fetch_assoc($resulthotel);
                    $sqlstate = 'select * from states where id_state = '.$rowhotel['id_state'];
                    $resultstate = $conn->query($sqlstate);
                    $rowstate = $resultstate->fetch_assoc();
                    //get the current day and stock it in checkin variable and the day after 7 days and stock it in checkout variable
                    $checkin = date('Y-m-d');
                    $checkout = date('Y-m-d', strtotime($checkin. ' + 7 days'));
                    $destination = $rowstate['name'];
                    ?>
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
                        <h5> 
                            <a target="_blank" class="text-primary" href="../hotel.php?hotel_id=<?php echo $rowhotel['id'] ?>&destination=<?php echo $destination ?>&checkin=<?php echo $checkin ?>&checkout=<?php echo $checkout ?>&adults=1&children=0&rooms=1">
                                <?php echo $rowhotel['name'] ?>
                            </a>
                        </h5>
                        <p>
                            <label for="note" class="fw-bold">Your comment:</label><br>
                            <?php echo $rowcomment['comment_text'] ?>
                        </p>
                        <p class="m-0">
                            <label for="note" class="fw-bold mb-2">Your note:</label>
                            <span class=""><?php echo $rowcomment['note'] ?>/10</span><br>
                            <span><span class="fw-bold">Comment date: </span> <?php echo $rowcomment['date_comment'] ?></span>
                        </p>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>