<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
  include('../db.php');
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
  #eye1, #eye{
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
    #password, #password1{
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right:0 ;
    }
    h1, h2, h3, h4, p, .btn, label, input, select, option,a{
  font-family: 'Noto Sans', sans-serif !important;
}

</style>
<body class="bg-info">
  <?php include('../header.php'); ?>


    <div class="countainer d-grid" style="padding-top:98px">
    <div class="card m-auto">
  <div class="card-body">
    <h5 class="card-title pb-3 mb-3 text-center" style="border-bottom: #FF731D solid 1px;">Create a Partner Account</h5>
    <form action="send.php" method="post">
      <label class="fw-bold" for="name">First Name</label>
      <input type="text" name="name" class="form-control mb-2" required>
      <label class="fw-bold" for="name">Last Name</label>
      <input type="text" name="lname" class="form-control mb-2" required>
      <label class="fw-bold" for="email">Username</label>
      <input type="text" name="username" class="form-control mb-2" required>
      <label class="fw-bold" for="email">Email</label>
      <input type="text" name="email" class="form-control mb-2" required>
      <label class="fw-bold" for="phone">Phone</label>
      <input type="text" name="phone" class="form-control mb-2" required>
      <label class="fw-bold" for="password">Password</label>
      <!-- <input type="password" name="password" class="form-control mb-2" required> -->
      <div class="passwordcontainer d-flex">
            <input type="password" name="password" id="password" class="form-control mb-4" required>
            <span onclick="togglePasswordVisibility()"  id="eye"><i class="bi bi-eye-fill"></i></span>
      </div>
      <label class="fw-bold" for="password">Confirm Password</label>
      <!-- <input type="password" name="cpassword" class="form-control mb-2" required> -->
      <div class="passwordcontainer d-flex">
            <input type="password" name="cpassword" id="password1" class="form-control mb-4" required>
            <span onclick="togglePasswordVisibility1()"  id="eye1"><i class="bi bi-eye-fill"></i></span>
      </div>
      <button type="submit" name="send" class="btn btn-primary text-white fw-bold" style="width: 100%; margin-top: 16px;">Create Account</button>
      <a href="login.php" class="btn btn-link text-center w-100 " style="font-size:14px">Already have an account?</a>

    </form>
  </div>
</div>
    </div>
 
  



  <script src="../js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script>
    // Get the width of the viewport
var viewportWidth = window.innerWidth;

// Set the width of the body element
document.body.style.width = viewportWidth + 'px';

var viewportHeight = window.innerHeight;

// Set the height of the body element
document.body.style.height = viewportHeight + 190 + 'px';

  </script>
</body>
</html>