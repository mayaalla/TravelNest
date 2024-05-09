<?php 
include('../db.php');
$email = $_GET['email'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<style>
     label{
        font-weight: 600;
    }
    .card-header{
        font-size: 2.25rem;
    }
    .pass{
        display: flex;
        justify-content: space-between;
    }
    #sbt{
        width: 100% !important;
        font-weight: 700;
        color: white !important;
        margin: 16px 0;
        position: relative;
        transition: color 0.3s;
    }
    .card-header::after{
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 32px);
        height: 1px;
        background-color: #FF731D;
    }
    .card-footer{
        position: relative;
    }
    .card-footer::after{
        content: "";
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 32px);
        height: 1px;
        background-color: #FF731D;
    }
    #eye{
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
    #password1, #password{
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right:0 ;
    }
    .login::after{
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        z-index: 10000;
    
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>
<body class="bg-info">
    <div class="container m-auto">
    <div class="card m-auto col-lg-5 col-md-6 col-sm-10 px-2 py-3">
  <h5 class="text-center pb-4 card-header position-relative border-0">Reset Your Password</h5>
  <div class="card-body py-4">
    <?php $action = "resetpassword.php?email=$email"; ?>
    <form action="<?php echo $action; ?>" method="post">
        <label class="pass" for="password"> New Password </label>
        <div class="passwordcontainer d-flex">
            <input minlength="8" type="password" name="password1" id="password" class="form-control mb-4" required>
            <span onclick="togglePasswordVisibility()"  id="eye"><i class="bi bi-eye-fill"></i></span>
        </div>
        <label class="pass" for="password"> Repeat Password  </label>
        <div class="passwordcontainer d-flex">
            <input minlength="8" type="password" name="password2" id="password1" class="form-control mb-4" required>
            <span onclick="togglePasswordVisibility1()"  id="eye"><i class="bi bi-eye-fill"></i></span>
        </div>
        <input type="hidden" name="email" value="<?php echo$_GET['email'];; ?>">
    <input type="submit" id="sbt" name="submit" value="Reset" class="btn btn-primary login">
    </form>
    </div>
</div>
</div>
<script src="../js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if($password1 == $password2){
        $password = password_hash($password1, PASSWORD_DEFAULT);
        $sql = "UPDATE partner SET password = '$password' WHERE email = '$email'";
        if(mysqli_query($conn, $sql)){
            echo '<script>alert("Password reset successfully")</script>';
            echo '<script>window.location.href = ""</script>';
        }else{
            echo '<script>alert("Password reset failed")</script>';
        }
    }else{
        echo '<script>alert("Password and Confirm Password do not match")</script>';
    }
}
$dropmailcode = "DELETE FROM mailcode WHERE email = '$email'";

?>

