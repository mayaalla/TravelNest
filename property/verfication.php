<?php
include("../db.php");
$name = $_GET['name'];
$lname = $_GET['lname'];
$username = $_GET['username'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$password = $_GET['password'];
$sql = "SELECT * FROM mailcode WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>TravelNest</title>
</head>
<style>
    *{
        font-family: 'Noto Sans', sans-serif !important;
    }
    label{
    font-size: 14px;
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
                        <h3 class="text-center">Partner Email Verification</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="verfication.php">
                            <label for="email" style=" font-weight: 600; ">Enter your verification code</label>
                            <input type="number" name="vrfcode" id="email" class="form-control mb-2" required>
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="code" value="<?php echo $row['code']; ?>">
                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                            <input type="hidden" name="lname" value="<?php echo $lname; ?>">
                            <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                            <input type="hidden" name="password" value="<?php echo $password; ?>">
                            <input type="submit" value="Verify" class="btn btn-primary my-2" style="color: white;" name="verify">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php
if(isset($_POST['verify'])){
    $vrfcode = $_POST['vrfcode'];
    $email = $_POST['email'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    if($vrfcode == $code){
        $sql = "INSERT INTO partner (first_name, last_name, username, email, phone, password) VALUES ('$name', '$lname', '$username', '$email', '$phone', '$password')";
        $sqldrop = "DELETE FROM mailcode WHERE email = '$email'";
        mysqli_query($conn, $sqldrop);
        if(mysqli_query($conn, $sql)){
            echo '<script>alert("Account created successfully!")</script>';
            echo '<script>window.location.href = "login.php"</script>';
        }else{
            echo '<script>alert("Error creating account")</script>';
            echo '<script>window.location.href = "index.php"</script>';
        }
    }else{
        echo '<script>alert("Invalid verfication code")</script>';
        echo '<script>window.location.href = "index.php"</script>';
    }
    $drop = "DELETE FROM mailcode WHERE email = '$email'";
    mysqli_query($conn, $drop);
}
?>