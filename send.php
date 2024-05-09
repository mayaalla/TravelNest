<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

include("db.php");

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 0){
        echo "<script>alert('Email not found')</script>";
        echo "<script>window.location.href = 'forgotpassword.php'</script>";
    }else{
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mayaalla888@gmail.com';
        $mail->Password = 'mwtu hxdw mlzw qddm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('mayaalla888@gmail.com', 'Travel Nest');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verfication Code';
        $verfication_code = rand(100000, 999999);
        $sql = 'insert into mailcode (email, code) values ("'.$email.'", "'.$verfication_code.'")';
        mysqli_query($conn, $sql);
        $mail->Body = "Your verfication code is $verfication_code";
        $mail->send();
        header("location: verfication.php?email=$email");
    }
}
if(isset($_POST['send'])){
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
    if($password1 != $password2){
        echo '<script>alert("Passwords do not match")</script>';
        echo '<script>window.location.href = "signup.php"</script>';
    }
        else{
            // verify if the image is valid
            $profilepicext = explode('.', $profilepicname);
            $profilepicactualext = strtolower(end($profilepicext));
            if(!in_array($profilepicactualext, $allowedtype)){
                echo "<script>alert('Invalid image type')</script>";
                echo "<script>window.location.href = 'signup.php'</script>";
            }
            else{
                // verify if the username already exists
                move_uploaded_file($profilepictmpname, "images/profilepic/".$profilepicname);
                $sql2 = "Select username from user where username = '$username'";
                $res = mysqli_query($conn, $sql2);
                if(mysqli_num_rows($res) != 0){
                    echo "<script>alert('Username already exists')</script>";
                    echo "<script>window.location.href = 'signup.php'</script>";
                }
            }
            $sql = "Select email from user where email = '$email'";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) != 0){
                echo "<script>alert('Email already exists')</script>";
                echo "<script>window.location.href = 'signup.php'</script>";
            }
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mayaalla888@gmail.com';
            $mail->Password = 'mwtu hxdw mlzw qddm';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('mayaalla888@gmail.com', 'Travel Nest');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Verfication Code';
            $verfication_code = rand(100000, 999999);
            $sql = 'insert into mailcode (email, code) values ("'.$email.'", "'.$verfication_code.'")';
            mysqli_query($conn, $sql);
            $mail->Body = "Your verfication code is $verfication_code";
            $mail->send();
            header("location: verficationemail.php?email=$email&nom=$nom&prenom=$prenom&username=$username&nationalite=$nationalite&phone=$phone&age=$age&password=$password1&profilepic=$profilepicname");
    
}
}
?>




