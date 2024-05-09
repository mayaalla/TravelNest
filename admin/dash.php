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
include('statistique.php');
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
        height: 100vh;
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

    
    .list-group-item-action{
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
.content{
    /* flex-basis: 48%; */
    flex-grow: 1;
}
table > *{
    background-color: #58538e !important;
    text-align: center !important;
    width: 100% !important;
}
th, td{
    padding: 0.5rem !important;
    background-color: #58538e !important;
    color: white !important;
    
}
</style>
<body>
    <div class="container-fluid">
        <div class="row" style="flex-wrap:nowrap !important">
            
            <div class="col-2 dash-nav  bg-info py-2" style="overflow-x:hidden !important; font-size: 14px !important">
                <ul class="list-group dash-nav-ui  bg-info text-white">
                    <form action="dash.php" method="post">
                    <li class="my-2 list-group-item bg-info text-white rounded active" style="border: none !important;" ><a href="dash.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-user-tie"></i><span>Admins</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="users.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-users"></i><span>Users</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="hotels.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-hotel"></i><span>Hotels</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="partners.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-key"></i><span>Partners</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="resrvations.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i><span>Bookings</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="comment.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i><span>Comments</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="comment.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-gear"></i><span>Settings</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="devise.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i class="fa-solid fa-sack-dollar"></i> <span>Devise</span></a></li>
                    <li class="my-2 list-group-item text-white bg-danger rounded logout p-0" style="border: none !important; margin-right:1.5rem !important" ><button name="logout" class="p-3 btn bg-danger fw-bold list-group-item list-group-item-action bg-primary text-white" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-right-from-bracket"></i><span>Logout</span></button></li>
                    </form>
                </ul>
            </div>
            
            <div class="col py-3 p-3 cc  text-white" style="background-color: #f7f7ff">
                <div class="d-flex mb-4 justify-content-between p-3 rounded bg-primary fw-bold text-white">
                    <span>Dashboard</span>
                    <span><i class="fa-solid fa-chart-line"></i></span>
                </div>
                <div class="d-flex flex-wrap justify-content-between gap-2" style="font-size: 1rem;">
                    <div class="my-2 p-3 bg-info rounded content" style="white-space: nowrap !important; overflow:hidden;"><i style="font-size:1.25rem !important" class="fa-solid fa-user mx-2"></i> <?php echo $rowusers['t'] ?> Users</div>
                    <div class="my-2 p-3 bg-info rounded content" style="white-space: nowrap !important; overflow:hidden;"><i style="font-size:1.25rem !important" class="fa-solid fa-hotel mx-2"></i> <?php echo $rowhotels['t'] ?> Hotels</div>
                    <div class="my-2 p-3 bg-info rounded content" style="white-space: nowrap !important; overflow:hidden;"><i style="font-size:1.25rem !important" class="fa-solid fa-bookmark mx-2"></i> <?php echo $rowreservations['t'] ?>  Reservations</div>
                    <div class="my-2 p-3 bg-info rounded content" style="white-space: nowrap !important; overflow:hidden;"><i style="font-size:1.25rem !important" class="fa-solid fa-comment mx-2"></i> <?php echo $rowcomments['t'] ?> Comments</div>
                </div>
                <div class="d-flex my-4 justify-content-between p-3 rounded bg-primary fw-bold text-white">
                    <span>Admins</span>
                    <span><i class="fa-solid fa-table"></i></span>
                </div>
                <div class="d-flex justify-content-center w-100 mb-4">
                    <form action="dash.php" method="post" class="d-flex flex-row flex-wrap align-items-end gap-2" style="padding-bottom: 1rem;" >
                            <div class="mb-3">
                                <label for="username" class="form-label m-0 p-0 fw-bold text-dark" style="font-size: 14px;">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label m-0 p-0 fw-bold text-dark" style="font-size: 14px;">Password</label>
                                <input minlength="8" type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-primary" style="font-weight:600; color: white;">Add New Admin</button>
                            </div>
                    </form>
                </div>
                
                <label class="text-primary" style="font-size:.75rem"><i class="fa-solid fa-circle-exclamation"></i> Click on the username or password to modify it</label>
                <table class="w-100 table table-bordered" style="background-color: #58538e !important; border-spacing:8px !important;">
  <thead class="bg-primary">
    <tr>
      <th scope="col">ID</th>
      <th  scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($rslt)){ ?>
        <form action="dash.php" method="post">
    <tr>
      <th scope="row"> <?php echo $row['id']?> </th>
      <td> <input name="usernameToEdit" class="bg-none p-0 m-0 w-0 text-white text-center" style="background: none; outline:none; border:none"  type="text" value=<?php echo $row['username'] ?> >  </td>
      <td> <input name="usernameToEdit" class="bg-none p-0 m-0 w-0 text-white text-center" style="background: none; outline:none; border:none"  type="text" value=<?php echo $row['password'] ?> > </td>
      
      <td class="d-flex flex-wrap justify-content-center">
        <button name="edit" class="btn p-0 mx-2 text-light" style="font-size: 1.25rem;" ><i class="fa-solid fa-pen-to-square"></i></button>
        <button name="delete" class="btn p-0 mx-2 text-danger" style="font-size: 1.25rem;" ><i class="fa-solid fa-trash"></i></button>
      </td>
        <input type="hidden" name="usernameToDelete" value="<?php echo $row['username'] ?>">
        <input type="hidden" name="passwordToDelete" value="<?php echo $row['password'] ?>">
    </tr>
    </form>
    <?php } ?>
  </tbody>
</table>
               
                
            </div>
        </div>
    </div>
    















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
        echo "<script> window.location.href = 'dash.php';</script>";
    }
    
}
if(isset($_POST['logout'])){
    session_destroy();
    header('location: index.php');
}
if(isset($_POST['delete'])){
    $usernameToDelete = $_POST['usernameToDelete'];
    $deleteSql = "DELETE FROM admin WHERE username = '$usernameToDelete'";
    if(mysqli_query($conn, $deleteSql)){
        echo "<script>alert('Admin deleted successfully');</script>";
        echo "<script>window.location.href = 'dash.php';</script>";
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
        echo "<script>window.location.href = 'dash.php';</script>";
    } else {
        echo "<script>alert('Error updating admin');</script>";
    }
}

?>