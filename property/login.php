<?php

include("../db.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
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
     .nav-link{
   display: none;
  }
  #devise{
    display: none;
  }
  label{
    font-size: 14px;
  }
  body{
    overflow-x: hidden;
  }
  #seconecter{
    display: none;
  }
  body{
    background-color: #0c045a !important;
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
        background-color: #e2e0ff6e !important;
    }
    #password{
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right:0 ;
    }
    label{
        font-size: 14px !important;
    
    }
</style>
<body>
    <?php include('../header.php'); ?>
    <div class="countainer d-flex justify-content-center align-item-center" style="padding-top:98px">
    <div class="card">
  <div class="card-body">
    <h5 class="card-title pb-3 mb-3 text-center" style="border-bottom: #FF731D solid 1px;">Login to Partner Account</h5>
    <form action="login.php" method="post">
      <label class="fw-bold" for="username">Username</label>
        <input type="text" name="username" class="form-control mb-2" required>
      <label for="password" class="d-flex justify-content-between">
        <span class="fw-bold">Password</span>
        <a href="forgetpassword.php" class="float-end" style="font-size: 14px;">Forget Password?</a>
      </label>
      <!-- <input type="password" name="password" class="form-control mb-2" required> -->
      <div class="passwordcontainer d-flex">
            <input type="password" name="password" id="password" class="form-control mb-4" required>
            <span onclick="togglePasswordVisibility()"  id="eye"><i class="bi bi-eye-fill"></i></span>
      </div>
      <button type="submit" name="login" class="btn btn-primary text-white fw-bold" style="width: 100%; margin-top: 16px;">Login</button>
      <a href="index.php" class="text-center d-block" style="font-size:14px">Create an account</a>

    </form>
  </div>
</div>
    </div>

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
var viewportWidth = window.innerWidth;

// Set the width of the body element
document.body.style.width = viewportWidth + 'px';

var viewportHeight = window.innerHeight;

// Set the height of the body element
document.body.style.height = viewportHeight + 'px';

    </script>
</body>
</html>
<?php
include("../db.php");
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'select * from partner where username = "'.$username.'"';
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num != 0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $_SESSION['partner'] = $row['username'];
            echo '<script>window.location.href = "partner.php"</script>';
        }else{
            echo '<script>alert("Incorrect password!")</script>';
            echo '<script>window.location.href = "login.php"</script>';
        }
    }else{
        echo '<script>alert("Username does not exist!")</script>';
        echo '<script>window.location.href = "login.php"</script>';
    }
}

