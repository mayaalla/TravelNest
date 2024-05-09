
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
include ('../db.php');
$username = $_SESSION['username'];
$sql1 = "select password from user where username = '$username'";
$rslt1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($rslt1);
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
#eye3, #eye4, #eye5{
        display: flex;
        border: var(--bs-border-width) solid var(--bs-border-color);;
        height: 100%;
        padding: 6px 10px;
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        border-left: 0;
        font-size: 1rem;
        color: #FF731D;
    }
    #oldpassword, #newpassword, #confirmpassword {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right:0 ;
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

<section style="padding-top: 120px;" class="container">
    <div class="row gap-2 px-2">
        <div class="col-lg-2 a33 p-0 border rounded  ">
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
                    <a href="profile.php" class="btn text-primary p-2 gap-3 d-flex align-items-baseline border flex-row text-center p-0" style= " border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                <i  class=" fa-solid fa-user"></i>
                <p class="m-0 p-0 ">Profile</p>
                
            </a>
            <a href="reservation.php" class="btn border p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= " border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="text-primary fa-solid fa-bookmark"></i>
                <P class="text-primary m-0 p-o">My Reservation</p>
            </a>
            <a href="reviews.php" class="btn border p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "border-radius:0 !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important;">
                <i  class="text-primary fa-solid fa-comment"></i>
                <P class="m-0 p-o text-primary">My reviews</p>
            </a>
            <a href="setting.php" class="btn border btn-primary rounded p-2 gap-3 d-flex align-items-baseline flex-row text-center p-0" style= "color: white !important; border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important;">
                <i  class="fa-solid fa-gear"></i>
                <p class="m-0 p-o">Settings</p>
            </a>
            </div>
                  </div>
               </div>
            </nav>
            



        </div>
        <div class="col px-4 py-3 border rounded" style="box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22) !important; backdrop-filter: blur(6px) !important;">
            <h1 id="h1" class="text-center mb-4">Settings</h1>
            <form action="setting.php" class="d-flex flex-column" method="post">
            <label for="Password">Old Password</label>
            <div class="passwordcontainer d-flex mb-4">
            <input type="password" name="oldpassword" id="oldpassword" class="form-control " required>
            <span onclick="togglePasswordVisibility3()"  id="eye3"><i class="bi bi-eye-fill"></i></span>
            </div>
            <label for="Password">New Password</label>
            <div class="passwordcontainer d-flex mb-4">
            <input minlength="8" maxlength="30" type="password" name="newpassword" id="newpassword" class="form-control " required>
            <span onclick="togglePasswordVisibility4()"  id="eye4"><i class="bi bi-eye-fill"></i></span>
            </div>
            <label for="Password">Confirm Password</label>
            <div  id="pc" class="passwordcontainer d-flex">
            <input minlength="8" maxlength="30" type="password" name="confirmpassword" id="confirmpassword" style="border: var(--bs-border-width) solid var(--bs-border-color) !important" class="form-control " required>
            <span onclick="togglePasswordVisibility5()"  id="eye5"><i class="bi bi-eye-fill"></i></span>
            </div>
            <label style="font-size: 12px; color:red; display:none" id="pdnm" >Password does not match</label>
            
            
            <!-- <button class="btn btn-primary" style="font-weight: 600; color:white">Change Password</button> -->
            <!-- Button trigger modal -->
<button type="submit" name="sumbit" class="btn btn-primary mt-4" style="color: white; font-weight:600">
  Change Password
</button>



<!-- Button trigger modal -->

<!-- Modal -->

            </form>
        </div>
    </div>
</section>
<script>
let oldpassword = document.getElementById('oldpassword');
let newpassword = document.getElementById('newpassword');
let confirmpassword = document.getElementById('confirmpassword');
let eye3 = document.getElementById('eye3');
let eye4 = document.getElementById('eye4');
let eye5 = document.getElementById('eye5');
function togglePasswordVisibility3(){
    if(oldpassword.type === 'password'){
        oldpassword.setAttribute('type', 'text');
        eye3.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }else{
        oldpassword.setAttribute('type', 'password');
        eye3.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}
function togglePasswordVisibility4(){
    if(newpassword.type === 'password'){
        newpassword.setAttribute('type', 'text');
        eye4.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }else{
        newpassword.setAttribute('type', 'password');
        eye4.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}
function togglePasswordVisibility5(){
    if(confirmpassword.type === 'password'){
        confirmpassword.setAttribute('type', 'text');
        eye5.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }else{
        confirmpassword.setAttribute('type', 'password');
        eye5.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}



</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
if(isset($_POST['sumbit'])){
$oldpassword= $_POST['oldpassword'];
$newpassword= $_POST['newpassword'];
$confirmpassword = $_POST['confirmpassword'];
$np = password_hash($newpassword, PASSWORD_DEFAULT);
if(password_verify($oldpassword, $row1['password'])){
    if($newpassword == $confirmpassword){
        $sql = "update user set password = '$np' where username = '$username'";
        $rslt = mysqli_query($conn, $sql);
        if($rslt){
            echo "<script>alert('Password has been changed successfully')</script>";
        }
    }else{
        echo "<script>
        let pc = document.getElementById('pc');
        document.getElementById('pdnm').style.display = 'block';
        eye4.style = 'border: var(--bs-border-width) solid red !important; border-left: none !important';
        eye5.style = 'border: var(--bs-border-width) solid red !important; border-left: none !important';
        confirmpassword.style = 'border: var(--bs-border-width) solid red !important; border-right: none !important';
        newpassword.style = 'border: var(--bs-border-width) solid red !important; border-right: none !important';
    
        </script>";
    }
}
else{
    echo "<script>alert('Old password is incorrect')</script>";
}
}

?>