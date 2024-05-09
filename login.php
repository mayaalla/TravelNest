<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
include ('db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
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
    #password{
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
    label{
        font-size: 14px;
    }
</style>
<body class="d-grid bg-info" style="height: 100vh">
    <div class="container m-auto d-grid">
    <div class="card m-auto col-lg-5 col-md-6 col-sm-10 px-2 py-3">
  <h5 class="text-center pb-4 card-header position-relative border-0">LOGIN</h5>
  <div class="card-body py-4">
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control mb-4" required>
        <label class="pass" for="password">Password <span class="text-primary"><a href="forgotpassword.php">Forgot password?</a></span></label>
        <div class="passwordcontainer d-flex">
            <input type="password" name="password" id="password" class="form-control mb-4" required>
            <span onclick="togglePasswordVisibility()"  id="eye"><i class="bi bi-eye-fill"></i></span>
        </div>
        
    <input type="submit" id="sbt" name="submit" value="Login" class="btn btn-primary login">
    </div>
    <div class="card-footer pt-4 border-0 text-body-secondary text-center">
    <label for="signup" >Don't have an account? <a href="signup.php">Sign up</a></label>
    </div>
    </form>
</div>
</div>
<script src="js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php


// Start session


if(isset($_POST['submit'])){ 
    // Check if the form is submitted
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT password FROM user WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        if(password_verify($password, $row['password'])){
            // Set session variables
            
            $_SESSION['username'] = $username;
            // save the image in the session and redirect to the profile page
            
            header('Location: client/profile.php');
            exit();
        }
        else{
            echo "<script>alert('Invalid username or password')</script>";
        }
    }
    else{
        echo "<script>alert('Invalid username or password')</script>";
    }
}
?>