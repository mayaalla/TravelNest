<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
if($_SESSION['admin'] == ''){
    header('location: index.php');
}



include("../db.php");
$sql = 'select * from admin';
$rslt = mysqli_query($conn, $sql);


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin</title>
</head>
<style>
.inpt:focus-visible{
    border: 1px solid #FF731D !important;
    outline: none !important;
}
.inpt:focus{
    border: 1px solid #FF731D !important;
    outline: none !important;
}
@media (max-width: 769px) {
    .a33{
        border: none !important;
    }
}
.a33{
    
    height: max-content;
}



</style>
<body>
    <?php include('header.php'); ?>
    <section>

        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-lg-2 a33 p-0  border-primary border">
                <nav class="navbar navbar-expand-lg p-0">
  <div class="container-fluid p-0">
    <button class="navbar-toggler w-100" type="button" data-bs-toggle="collapse" data-bs-target="#dash" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="dash">
      <ul class=" navbar-nav d-flex flex-column p-0 w-100">

        
        <li class="nav-item"><a href="dashboard.php" ><i class="fa-solid fa-user-gear"></i> Admins</a></li>
        <li class="nav-item"><a href="hoteldashboard.php" ><i class="fa-solid fa-hotel"></i> Hotels</a></li>
        <li class="nav-item"><a href="users.php" ><i class="fa-solid fa-user"></i> Users</a></li>
        <li class="nav-item"><a href="feedbacks.php"><i class="fa-solid fa-message"></i> Feedbacks</a></li>
        
        
      </ul>
    </div>
  </div>
</nav>
             
                </div>
                <div class="col  border border-primary py-3  px-4">
                <div class="row mb-4">
                    <div class="col">
                        <form action="dashboard.php" method="post" class="d-flex flex-row flex-wrap align-items-end" style="border-bottom:#FF731D solid 1px; padding-bottom: 1rem;" >
                            <div class="mb-3 mx-2">
                                <label for="username" class="form-label" style="font-weight:600;">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3 mx-2">
                                <label for="password" class="form-label" style="font-weight:600;">Password</label>
                                <input minlength="8" type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3 mx-3">
                                <button type="submit" name="submit" class="btn btn-primary" style="font-weight:600; color: white;">Add New Admin</button>
                            </div>
                        </form>
                    </div>
                </div> 
                <?php
                $i = 0;
                $y=0;
                $x=0;
                $z=0;
                            while($row = mysqli_fetch_assoc($rslt)){
                            ?>
                            <form action="dashboard.php" method="post">
                <div class="row gap-0">
                    <div class="col">
                        <?php
                        if($y==0){
                            echo "<p class='text-center' style='font-weight:600;'>Username</p>";
                            $y++;
                        }
                        ?>
                        <ul class="list-group">
                            <!-- <?php
                            
                                echo '<input class="list-group-item inpt text-center" style="border-radius:0; color:black !important;" value="'.$row['username'].'">';
                            
                            ?> -->
                            <input name="usernameToEdit" value="<?php echo $row['username']; ?>" class="list-group-item inpt text-center" style="border-radius:0; color:black !important;">
                        </ul>
                    </div>
                    <div class="col">
                        <?php
                        if($x==0){
                            echo "<p class='text-center' style='font-weight:600; '>Password</p>";
                            $x++;
                        }
                        ?>
                        
                        <ul class="list-group">
                            <?php
                                // echo '<input class="list-group-item inpt text-center" style="border-radius:0; color:black !important;" value="'.$row['password'].'">';
                            ?>
                            <input name="passwordToEdit" value="<?php echo $row['password']; ?>" class="list-group-item inpt text-center" style="border-radius:0; color:black !important;">
                        </ul>
                    </div>
                    <div class="col-1">
                        <?php
                        if($z==0){
                            echo "<p class='text-center' style='font-weight:600;'>Action</p>";
                            $z++;
                        }
                        ?>
                        
                        
                        <ul class="list-group">
                            <li class="list-group-item px-1 d-flex justify-content-center" style="border-radius:0">
                                <input type="hidden" name="usernameToDelete" value="<?php echo $row['username']; ?>">
                                <button name= "edit" type="submit" style="background:none; outline: none; border: none; box-shadow: none; padding: 0; margin: 0;" class="text-primary mx-1 "><i class="fa-solid fa-pen-to-square"></i></button>
                                <button name= "delete" type="submit" style="background:none; outline: none; border: none; box-shadow: none; padding: 0; margin: 0;" class="text-danger mx-1 "><i class="fa-solid fa-trash"></i></button>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                </form>
                <?php 
                   $i++; }
                ?>
                </div>
            </div>
        </div> 
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

<?php 

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sqlexiste = 'select * from admin where username = "'.$username.'"';
    if(mysqli_num_rows(mysqli_query($conn, $sqlexiste)) > 0){
        echo "<script>alert('Username already exists')</script>";
    }
    else{
        $sql = "insert into admin (username, password) values ('$username', '$password')";
        $rslt = mysqli_query($conn, $sql);
        echo "<script> window.location.href = 'dashboard.php';</script>";
    }
    
}
if(isset($_POST['logout'])){
    session_destroy();
    header('location: index.php');
}
echo $i;
// for($j=0; $j<$i; $j++){
//     // if(isset($_POST['edit'.$j])){
//     //     $username = $_POST['username'.$j];
//     //     $password = $_POST['password'.$j];
//     //     $sql = 'update admin set username = "'.$username.'", password = "'.$password.'" where username = "'.$username.'"';
//     //     $rslt = mysqli_query($conn, $sql);
//     // }
//     if(isset($_POST['delete'.$j])){
//         $username = $_POST['username'.$j];
//         echo $username;


//     }
// }

if(isset($_POST['delete'])){
    $usernameToDelete = $_POST['usernameToDelete'];
    $deleteSql = "DELETE FROM admin WHERE username = '$usernameToDelete'";
    if(mysqli_query($conn, $deleteSql)){
        echo "<script>alert('Admin deleted successfully');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting admin');</script>";
    }
}
if(isset($_POST['edit'])){
    $usernameToEdit = $_POST['usernameToEdit'];
    $passwordToEdit = $_POST['passwordToEdit'];
    $sql = "update admin set username = '$usernameToEdit', password = '$passwordToEdit' where username = '$usernameToEdit'";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Admin updated successfully');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating admin');</script>";
    }
}



?>