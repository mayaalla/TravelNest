<?php
include ('db.php');
$sql4 = "SELECT name FROM countries";
$res4 = mysqli_query($conn, $sql4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Sign Up</title>
</head>
<style>
    .card-header{
        font-size: 2.25rem;
    }
    #sbt{
        width: 100% !important;
        font-weight: 700;
        color: white !important;
        margin: 16px 0;
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
    #eye1, #eye2{
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
    #password2, #password1{
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right:0 ;
    }
    /* .card{
        /* box-shadow: 0px 2px 23px 6px rgba(14,0,110,0.51);
        -webkit-box-shadow: 0px 2px 23px 6px rgba(14,0,110,0.51);
        -moz-box-shadow: 0px 2px 23px 6px rgba(14,0,110,0.51); */
    
    input{
        background-color: #e2e0ff6e !important;
    
    }
    .btn{
        background-color: #FF731D !important;
    
    }
    label{
        font-weight: 600;
        font-size: 14px;
    }
</style>
<body class=" py-5 d-grid bg-info">
     <div class="container m-auto d-grid" >
    <div class="card m-auto col-lg-5 col-md-6 col-sm-10 px-2 py-4">
  <h4 class="text-center pb-4 card-header position-relative border-0">SIGN UP</h4>
  <div class="card-body py-4">
    <form action="send.php" method="post" enctype="multipart/form-data">
        <label for="nom">Name</label>
        <input type="text" name="nom" id="nom" class="form-control mb-4" required>
        <label for="prenom">Last Name</label>
        <input type="text" name="prenom" id="prenom" class="form-control mb-4" required>
        <label for="username">Username</label>
        <input type="text" minlength="4" maxlength="30" name="username" id="username" class="form-control mb-4" required>
        <label for="nationalite">Nationality</label>
        <select name="nationalite" id="nationalite" style="background-color: #e2e0ff6e;" class="form-select mb-4" required>
            <?php
            while($row = mysqli_fetch_assoc($res4)){
                echo "<option value='".$row['name']."'>".$row['name']."</option>";
            }
            ?>
        </select>
        <label>Profile Picture</label>
        <input type="file" name="image" class="form-control m-0" >
        <p class="p-0 m-0 mb-4 text-primary" style="font-size: 14px; font-weight:400;">allowed type : png, jpg, jpeg</p>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control mb-4" required>
        <label for="numero-de-telephone">Phone Number</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">+</span>
            <input name="phone" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <label for-="l'age">Date of Birth</label>
        <input type="date" name="age" id="age" class="form-control mb-4" required>
        <label for="password">Password</label>
        <div class="passwordcontainer d-flex">
            <input style="margin-bottom: 24px;" type="password" minlength="8" maxlength="30" name="password1" id="password1" class="form-control" required>
            <span onclick="togglePasswordVisibility1()"  id="eye1"><i class="bi bi-eye-fill"></i></span>
        </div>
        <p id="vrf" style="margin:0; font-size: 12px; font-weight:500; color:rgb(220, 53, 69) !important; display:none">
            </p>
        <label for="password">Confirm Password</label>
        <div class="passwordcontainer d-flex">
            <input type="password" name="password2" id="password2" class="form-control mb-4" required>
            <span onclick="togglePasswordVisibility2()"  id="eye2"><i class="bi bi-eye-fill"></i></span>
        </div>
        <input type="submit" id="sbt" name="send" value="Sign Up" class="btn btn-primary">
    </div>
    <div class="card-footer pt-4 border-0 text-body-secondary text-center">
    <label for="signup" class="mx-2">You have an account? <a href="login.php">Login</a></label>
    </div>
    </form>
</div>
</div>
</div> 
<script src="js/script.js"></script>
<script src="js/codevrf.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
<?php
if(isset($_POST["submit"])){
    $profilepic = $_FILES['image'];
    $profilepicname = $_FILES['image']['name'];
    $profilepictmpname = $_FILES['image']['tmp_name'];
    $allowedtype = array('png', 'jpg', 'jpeg', '');
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $username = $_POST["username"];
    $nationalite = $_POST["nationalite"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    // paswword haching
    $p1 = password_hash($password1, PASSWORD_DEFAULT);
    
    if($password1 != $password2){
        echo "<script>alert('Passwords do not match')</script>";
    }
    else{
        // verify if the image is valid
        $profilepicext = explode('.', $profilepicname);
        $profilepicactualext = strtolower(end($profilepicext));
        if(!in_array($profilepicactualext, $allowedtype)){
            echo "<script>alert('Invalid image type')</script>";
        }
        else{
            // verify if the username already exists
            $sql2 = "Select username from user where username = '$username'";
            $res = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($res) != 0){
                echo "<script>alert('Username already exists')</script>";
            }
            else{
                move_uploaded_file($profilepictmpname, "images/profilepic/".$profilepicname);
                $sql1 = "INSERT INTO user (name, prename, username, pays, email, phone, birthdate, password, image) VALUES ('$nom', '$prenom', '$username', '$nationalite', '$email', '$phone', '$age', '$p1', '$profilepicname')";
                mysqli_query($conn, $sql1);
                // go to login page with a message
                echo "<script>alert('Account created successfully')</script>";
                echo "<script>window.location.href='login.php'</script>";
            }
        }
    }
}
?>