<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
if($_SESSION['username'] == "" ){
    header('Location: ../login.php');
}

include ('../db.php');
$username = $_SESSION['username'];
$sql1 = "select * from user where username = '$_SESSION[username]'";
$res = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($res);
$name = $row['name'];
$age = $row['birthdate'];
echo '<script>console.log("'.$age.'")</script>';
$prename = $row['prename'];
$email = $row['email'];
$phone = $row['phone'];
$pays = $row['pays'];
$imagepic = $row['image'];

$sql2 = "SELECT name FROM countries";
$res2 = mysqli_query($conn, $sql2);
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
    <title>TravelNest</title>
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
<header>
<?php 
include ('header.php');
?>
</header>
<section style="padding-top: 120px;" class="container pb-5">
    <div class="row gap-3 px-2">
        <div class="col-lg-2 a33 p-0 border rounded ">
            <nav class="navbar p-0 w-100 navbar-expand-md">
            <div class="w-100" >
                  <button class="navbar-toggler w-100" type="button" data-bs-toggle="collapse" data-bs-target="#navbara" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand fltr" style="color: rgba(0, 0, 0, 0) !important;" href="#">
                   Filtre
                    </a>
                  <div class="collapse w-100 navbar-collapse" id="navbara">
                    <div class="d-flex flex-column w-100">
                  <a href="profile.php" class="w-100 border btn btn-primary p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "color: white !important; border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                <i  class=" fa-solid fa-user"></i>
                <p class="m-0 p-0 ">Profile</p>
                
            </a>
            <a href="reservation.php" class="btn border  w-100 p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
            <i  class="text-primary fa-solid fa-bookmark"></i>
                <P class="m-0 p-o text-primary">My Reservation</p>
            </a>
            <a href="reviews.php" class="btn  border w-100 p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
            <i  class="text-primary fa-solid fa-comment"></i>
                <P class="m-0 p-o text-primary">My reviews</p>
            </a>
            <a href="setting.php" class="btn border  w-100 p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="text-primary fa-solid fa-gear"></i>
                <p class="m-0 p-o text-primary">Settings</p>
            </a>
            </div>
                  </div>
               </div>
            </nav>
        </div>
        <div class="col border-white px-4 py-3 border rounded" style="box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22) !important; backdrop-filter: blur(6px) !important;">
            <h1 class="text-center mb-4">Profile</h1>
            <form action="profile.php" method="post" enctype="multipart/form-data">
            <h3 class="text-center text-primary" id="updt" style="display:none;">Update succesefuly!!</h3>
            <div class="d-flex flex-row flex-wrap gap-3 mb-4 align-items-center">
            <?php
            if($imagepic != ""){
                echo "<img src='../images/profilepic/".$imagepic."' class='rounded-circle' style='width: 200px; height: 200px;'>";
            }
            else{
                echo "<i class='fa-solid fa-user' style='font-size: 200px;'></i>";
            }
            ?>
            <div> 
                
                <label class="mt-2">Modify Profile Picture</label>
                <input type="file" name="image" class="form-control" >
                <p class="p-0 m-0 text-primary" style="font-size: 14px; font-weight:400;">allowed type : png, jpg, jpeg</p>
                
            </div>
            </div>
            
            <label>Username</label>
            <input class="form-control mb-4" disabled value="<?php echo $username; ?>" name="username">
            <label>Name</label>
            <?php 
            echo '<input name="name" class="form-control mb-4" type="text" value="'.$name.'">'
            ?>

            <label>Last Name</label>
            <?php
            echo '<input name="prename" class="form-control mb-4" type="text" value="'.$prename.'">'
            ?>

            <label>Date of Birth</label>
            <input name="age" class="form-control mb-4" type="date" value="<?php echo $age; ?>">

            <label>Email</label>
            <?php
            echo '<input name="email" class="form-control mb-4" type="email" value="'.$email.'">'
            ?>

            <label>Phone</label>
            <?php
            echo '<input name="phone" class="form-control mb-4" type="tel" value="'.$phone.'">'
            ?>

            <label>Pays</label>
            <select name="pays" id="pays" class="form-select mb-4">
            <?php
            echo "<option value='".$pays."'>".$pays."</option>";
            while($row2 = mysqli_fetch_assoc($res2)){
                echo "<option value='".$row2['name']."'>".$row2['name']."</option>";
            }
            ?>
            </select>
            <button class="btn btn-primary" name="submit" style="color : white; font-weight:600;">Update</button>
            </form>
        </div>
    </div>
</section>


<!-- <select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select> -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $prename = $_POST['prename'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pays = $_POST['pays'];
    if($_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        $allowedtype = array('png', 'jpg', 'jpeg');
        //verify if the image valid
        $profilepicext = explode('.', $image);
        $profilepicactualext = strtolower(end($profilepicext));
        if(in_array($profilepicactualext, $allowedtype)){
            $sql3 = "update user set name = '$name', birthdate = '$age', prename = '$prename', email = '$email', phone = '$phone', pays = '$pays', image = '$image' where username = '$_SESSION[username]'";
            $res3 = mysqli_query($conn, $sql3);
            if($res3){
                move_uploaded_file($_FILES['image']['tmp_name'],"../images/profilepic/".$image);
                header('Location: profile.php');
                echo "
                <script>
                let updt = document.getElementById('updt');
                updt.style='display: block !important';
                </script>
                ";
            }
            else{
                echo "<script>alert('Failed to update profile')</script>";
            }
        }
        else{
            echo "<script>alert('Invalid image type')</script>";
        }
        

        }else{
            $sql3 = "update user set name = '$name', birthdate = '$age', prename = '$prename', email = '$email', phone = '$phone', pays = '$pays' where username = '$_SESSION[username]'";
            $res3 = mysqli_query($conn, $sql3);
            if($res3){
                // header('Location: profile.php');
                echo "
                <script>
                let updt = document.getElementById('updt');
                updt.style='display: block !important';
                </script>
                ";
            }
            else{
                echo "<script>alert('Failed to update profile')</script>";
            }
        }
}
?>