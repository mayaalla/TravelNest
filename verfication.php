<?php
include("db.php");
$email = $_GET['email'];
$sql = "SELECT * FROM mailcode WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>TravelNest</title>
</head>
<style>
    *{
        font-family: 'Noto Sans', sans-serif !important;
    }
    .card-header{
        position: relative;
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
    .card{
        /* box-shadow: 0 4px 6px -1px rgba(0,0,0,.1),
  0 2px 4px -2px rgba(0,0,0,.1) !important; */
  border: 1px solid white !important;
  box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22) !important;
  background-color: #f3f3f5 !important;

  backdrop-filter: blur(6px) !important;
    }
</style>
<body class="bg-info">
    <section class="container py-5">
        <div class="row">
            <div class="col-lg-6 m-auto ">
                <div class="card border-primary" >
                    <div class="card-header text-black mb-2" style="border: none !important; background: none !important;">
                        <h1 class="text-center">Forget Password</h1>
                    </div>
                    <div class="card-body">
                        <?php 
                        $action = "resetpassword.php?email=$email";
                        ?>
                        <form method="post" action=<?php echo $action ?>>
                            <label for="email" style=" font-weight: 600; ">Enter your verification code</label>
                            <input type="number" name="vrfcode" id="email" class="form-control mb-2" required>
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="code" value="<?php echo $row['code']; ?>">
                            <input type="submit" value="Reset" class="btn btn-primary my-2" style="color: white;" name="reset">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>