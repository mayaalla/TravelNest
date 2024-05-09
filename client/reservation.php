
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
include ('../db.php');
$username = $_SESSION['username'];

$sql = "select * from reservation where user_id in (select id from user where username = '$username')";

$res = mysqli_query($conn, $sql);


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
label{
    font-weight: 600;
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
<!-- <section  style="padding: 120px;" >
    <div class="row gap-5">
        <div class="col d-flex flex-column p-0 border rounded ">
            
        </div>
        <div class="col-9 border rounded">a3333333333333</div>
    </div>
</section> -->

<section class="px-2 container" style="padding-top:120px; padding-bottom: 120px; ">
    <div class="row gap-2">
        <div class="col-lg-2 a33 p-0 ">
            <nav class="navbar p-0 w-100 navbar-expand-md">
            <div class="w-100 px-2" >
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
            <a href="reservation.php" class="btn border btn-primary p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "color: white !important; border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="fa-solid fa-bookmark"></i>
                <P class="m-0 p-o">My Reservation</p>
            </a>
            <a href="reviews.php" class="btn border p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="text-primary fa-solid fa-comment"></i>
                <P class="m-0 p-o text-primary">My reviews</p>
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
        <div class="col px-4 py-3 border-white rounded" style="box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22) !important; backdrop-filter: blur(6px) !important;">
            <h1 class="text-center mb-4">My Reservation</h1>
            <?php
            $sqlroom = 'select * from room where id in (select room_id from reservation where user_id in (select id from user where username = "'.$username.'"))';
            $resroom = mysqli_query($conn, $sqlroom);
            while ($rowroom = mysqli_fetch_array($resroom)) {
                echo "<script>console.log('".$rowroom['id']."')</script>";
                $sqlhotel ='select * from hotel where id in(select hotel_id from room where id = '.$rowroom['id'].')';
                $reshotel = mysqli_query($conn, $sqlhotel);
                $rowhotel = mysqli_fetch_array($reshotel);
                $sqlrsrv = 'select * from reservation where room_id = '.$rowroom['id'].' and user_id in (select id from user where username = "'.$username.'")';
                $resrsrv = mysqli_query($conn, $sqlrsrv);
                $rowrsrv = mysqli_fetch_array($resrsrv);
            ?>
            <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php 
                                //get the current day and stock it in checkin variable and the day after 7 days and stock it in checkout variable
                                $checkin = date('Y-m-d');
                                $checkout = date('Y-m-d', strtotime($checkin. ' + 7 days'));
                                $sqlstate = 'select * from states where id_state = '.$rowhotel['id_state'];
                                $resultstate = $conn->query($sqlstate);
                                $rowstate = $resultstate->fetch_assoc();
                                $destination = $rowstate['name'];
                                ?>
                                <a href="../hotel.php?hotel_id=<?php echo $rowhotel['id'];?>&destination=<?php echo $destination ?>&checkin=<?php echo $checkin ?>&checkout=<?php echo $checkout ?>&adults=1&children=0&rooms=1" class="text-primary">
                                    <?php echo $rowhotel['name'];?>
                                </a>
                            </h5>
                            <p class="card-text fw-bold">
                                <?php echo $rowroom['type'];?>
                            </p>
                            <p class='fw-bold mb-0'>
                                <?php 
                                $date = date('Y-m-d');
                                
                                if($rowrsrv['date_fin'] > $date){
                                    if($rowrsrv['status'] == 'Confirmer' ){
                                        echo '<span><i class="fa-solid fa-check text-success"></i> Confirmed</span>';
                                    } else{
                                        echo '<span><i class="fa-solid fa-times text-danger"></i> Canceled</span>';
                                    }
                                }
                                   
                                
                                ?>
                            </P>
                            <form action="reservation.php" method="post">
                                <?php if($rowrsrv['nbr_child'] == 0){
                                    $nbrchild = 0;
                                }else{
                                    $nbrchild = $rowrsrv['nbr_child'];
                                } ?>
                            <p class="card-text d-flex justify-content-between align-items-center flex-wrap">
                                <span class="mb-2 text-dark"><?php echo '<i class="fa-solid fa-money-bill text-primary"></i> '. $rowroom['price'] . '$/night'; ?></span>
                                <span class="mb-2 text-dark" style="text-decoration: none !important;" ><?php echo '<i class="fa-regular fa-calendar-days text-primary"></i> ' . $rowrsrv['date_debut'] . ' to ' . $rowrsrv['date_fin']; ?></span>
                                <span class="mb-2 text-dark" style="text-decoration: none !important;" ><?php echo '<i class="fa-solid fa-person text-primary"></i> '.$rowrsrv['nbr_person'] . ' Persons(s)'; ?></span>
                                <span class="mb-2 text-dark" style="text-decoration: none !important;" ><?php echo '<i class="fa-solid fa-child text-primary"></i> ' . $nbrchild . ' Child(s)'; ?></span>
                                <span class="mb-2 text-dark" style="text-decoration: none !important;" ><?php echo '<i class="fa-solid fa-sack-dollar text-primary"></i> Total price: ' . $rowrsrv['Total_price'] . '$'; ?></span>
                                <input type="hidden" name="rsv_id" value="<?php echo $rowrsrv['id'];?>">
                                <?php
                                $date = date('Y-m-d'); 
                                if($rowrsrv['date_fin'] > $date){
                                    
                                    if($rowrsrv['status'] == 'Confirmer'){
                                        
                                        echo '<button type="submit" class="btn btn-danger text-white" style="font-weight: 500" name="delete">Cancel</button>';
                                    }   
                                }
                                ?>
                                
                                <!-- <button type="submit" class="btn btn-primary text-white" style="font-weight: 500" name="delete">Annuler</button> -->
                            </p>
                        </div>
                  
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php 
if(isset($_POST['delete'])){
    $rowrsv = $_POST['rsv_id'];
    $sqlrsrv = 'update reservation set status = "Annuler" where id = '.$rowrsv;
    $result = mysqli_query($con,$sqlrsrv);
    $sql = "delete from room_reservee where reservation_id = $rowrsv";
    $res = mysqli_query($conn, $sql);
    if($res){
        echo "<script>alert('Reservation annulée avec succès')
        Window.location.href = 'reservation.php'
        </script>;";
    }
    else{
        echo "<script>alert('Erreur lors de l'annulation de la réservation')
        Window.location.href = 'reservation.php'
        </script>";
    }
}
?>