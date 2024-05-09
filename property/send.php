
      <style>
    *{
        color: white !important; 
    }
</style>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// require '../vendor/autoload.php';
require '../vendor/autoload.php';

include("../db.php");
if(isset($_POST['send'])){
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $p1 = password_hash($password, PASSWORD_DEFAULT);
    $p2 = password_hash($cpassword, PASSWORD_DEFAULT);
    if($password != $cpassword){
        echo '<script>alert("Passwords do not match")</script>';
        echo '<script>window.location.href = "index.php"</script>';
    }else{
        $sql = 'select * from partner where email = "'.$email.'"';
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num !=0 ){
            echo '<script>alert("Email already exists")</script>';
            echo '<script>window.location.href = "index.php"</script>';
        }else{
            $sql = 'select * from partner where username = "'.$username.'"';
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if($num !=0 ){
                echo '<script>alert("Username already exists")</script>';
                echo '<script>window.location.href = "index.php"</script>';
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
            // header('location: verfication.php?name='.$name.'&lname='.$lname.'&email='.$email.'&phone='.$phone.'&password='.$p1);
            echo '<script>window.location.href = "verfication.php?name='.$name.'&lname='.$lname.'&email='.$email.'&phone='.$phone.'&password='.$p1.'&username='.$username.'"</script>';
        }
    }
}

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $sql = 'select * from partner where email = "'.$email.'"';
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 0){
        echo '<script>alert("Email does not exist")</script>';
        echo '<script>window.location.href = "forgotpassword.php"</script>';
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
        echo '<script>window.location.href = "resetverfication.php?email='.$email.'"</script>';
    }
}
?>
