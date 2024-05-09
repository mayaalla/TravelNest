<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
include('../db.php');
if($_SESSION['partner'] == "" ){
  header('Location: login.php');
}else{
  $sqlpartner = 'select * from partner where username = "'.$_SESSION['partner'].'"';
  $rsltpartner = mysqli_query($conn, $sqlpartner);
  $rowpartner = mysqli_fetch_assoc($rsltpartner);
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
    <title>Document</title>
</head>
<style>
  h1, h2, h3, h4, p, .btn, label, input, select, option,a{
    font-family: 'Noto Sans', sans-serif !important;
}
a{
  text-decoration: none;

}
body{
        background-color: #f3f3f5;
    }
    li{
        transition: 0.2s background-color;
    }
    a{
        transition: 0.2s background-color;
    }
     li:hover{
        background-color: #58538e !important;
        cursor: pointer;
    }
    li:hover a{
        background-color: #58538e !important;
    }
    /* .list-group-item:hover a{
        background-color: #ffffff25 !important;
    
    } */
    .dash-nav-ui{
        /* height: 100vh; */
        position: relative;
        flex-shrink: 0;
    }
    .logout{
        position: absolute;
        bottom: 8px;
        width: 90%;
    }
    .logout:hover{
        background-color: #ff8845 !important;        cursor: pointer;
    }

    
    .link{
        white-space: nowrap !important;
        overflow: hidden;
    }
    .active a{
        background-color: #58538e !important;
    }
    .active{
        background-color: #58538e !important;
    }
    @media (max-width: 769px) {
        .list-group-item span{
            display: none !important;
        }
        .dash-nav{
            transition: 0.2s width;
        }
        .dash-nav:hover{
            width: 33.333333333% !important;
        }
        .dash-nav:hover span{
            display: inline-block !important;
        }
        .dash-nav:hover .logout{
            width: 85% !important;
        }
        .logout{
            width: 75% !important;
        }
}
#eye, #eye1, #eye2{
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
    #password, #password1, #password2{
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right:0 ;
    }
label{
  font-size: 14px;
}
</style>
<body>
    <?php include('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 dash-nav py-2 bg-info text-white" style="overflow-x:hidden !important; font-size: 14px !important">
              <form action="" method="post">
              <ul class="list-group dash-nav-ui  bg-info text-white" id="dash-nav-ui">
                <li class="list-group-item rounded bg-info text-white bg-info my-2 active" style="border: none !important;" ><a class="text-white bg-info link" href="partner.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-user"></i> <span>Compte</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="property.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-hotel"></i> <span>Property</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="rooms.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bed"></i> <span>Rooms</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="booking.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i> <span>Booking</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="occupedroom.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-lock"></i> <span>Occupied room</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="commentrate.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i> <span>Comments and Rate</span></a></li>
              </ul>
              </form>
            </div>
            <div class="col py-3">
              <h3>Partner Information</h3>
              <form action="partner.php" method="post">
              <label for="username" class="form-label fw-bold mb-0">Username</label>
              <input type="text" name="username" class="form-control mb-2" disabled value=<?php echo $rowpartner['username'] ?>>
              <label for="name" class="form-label fw-bold mb-0 mt-3">First Name</label>
              <input type="text" name="name" class="form-control mb-2" required value=<?php echo $rowpartner['first_name'] ?>>
              <label for="name" class="form-label fw-bold mb-0 mt-3">Last Name</label>
              <input type="text" name="lname" class="form-control mb-2" required value=<?php echo $rowpartner['last_name'] ?>>
              <label for="email" class="form-label fw-bold mb-0 mt-3">Email</label>
              <input type="text" name="lname" class="form-control mb-2" disabled value=<?php echo $rowpartner['email'] ?>>
              <label for="phone" class="form-label fw-bold mb-0 mt-3">Phone</label>
              <input type="text" name="phone" class="form-control mb-2" required value=<?php echo $rowpartner['phone'] ?>>
              <button type="submit" name="update" class="btn mb-3 btn-primary text-white fw-bold" style="width: 100%; margin-top: 16px;">Update</button>
              </form>
              <h3 class="mt-4">Change your password</h3>
              <form action="partner.php" method="post">
              <label for="password" class="form-label fw-bold mb-0">Old Password</label>
              <div class="passwordcontainer d-flex">
                    <input type="password" name="password" id="password" class="form-control mb-4" required>
                    <span onclick="togglePasswordVisibility()"  id="eye"><i class="bi bi-eye-fill"></i></span>
              </div>
              <label for="password" class="form-label fw-bold mb-0">New Password</label>
              <div class="passwordcontainer d-flex">
                    <input minlength="8" type="password" name="npassword" id="password1" class="form-control mb-4" required>
                    <span onclick="togglePasswordVisibility1()"  id="eye1"><i class="bi bi-eye-fill"></i></span>
              </div>
              <label for="password" class="form-label fw-bold mb-0">Confirm Password</label>
              <div class="passwordcontainer d-flex">
                    <input minlength="8" type="password" name="cpassword" id="password2" class="form-control mb-4" required>
                    <span onclick="togglePasswordVisibility2()"  id="eye2"><i class="bi bi-eye-fill"></i></span>
              </div>
              <button type="submit" name="changepassword" class="btn btn-primary text-white fw-bold" style="width: 100%; margin-top: 16px;">Change Password</button>
              </form>
            </div>
        </div>
    </div>
  <script src="../js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script>
    // get the header hieght
    let header =document.getElementById('header');
let headerHeight = header.clientHeight;
let dashNav = document.getElementById('dash-nav-ui');
dashNav.style.height = `calc(100vh - ${headerHeight}px)`;

    



  </script>
</body>
</html>
<?php
if(isset($_POST['update'])){
  $name = $_POST['name'];
  $lname = $_POST['lname'];
  $phone = $_POST['phone'];
  $sql = 'update partner set first_name = "'.$name.'", last_name = "'.$lname.'", phone = "'.$phone.'" where username = "'.$_SESSION['partner'].'"';
  $rslt = mysqli_query($conn, $sql);
  if($rslt){
    echo '<script>alert("Updated Successfully")</script>';
    echo '<script>window.location.href = "partner.php"</script>';
  }else{
    echo '<script>alert("Error")</script>';
  }
}

if(isset($_POST['changepassword'])){
  $password = $_POST['password'];
  $npassword = $_POST['npassword'];
  $cpassword = $_POST['cpassword'];
  $sql = 'select * from partner where username = "'.$_SESSION['partner'].'"';
  $rslt = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($rslt);
  if(password_verify($password, $row['password'])){
    if($npassword == $cpassword){
      $p = password_hash($npassword, PASSWORD_DEFAULT);
      $sql = 'update partner set password = "'.$p.'" where username = "'.$_SESSION['partner'].'"';
      $rslt = mysqli_query($conn, $sql);
      if($rslt){
        echo '<script>alert("Password Changed Successfully")</script>';
        echo '<script>window.location.href = "partner.php"</script>';
      }else{
        echo '<script>alert("Error")</script>';
      }
    }else{
      echo '<script>alert("Passwords do not match")</script>';
    }
  }else{
    echo '<script>alert("Incorrect Password")</script>';
  }
}