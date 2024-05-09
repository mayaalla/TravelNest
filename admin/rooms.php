
<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  ob_start();
}
if($_SESSION['admin'] == ''){
  header('location: index.php');
}

include("../db.php");
$hotel_id = $_GET['hotel_id'];


?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet">
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
    border: 1px white solid !important;
    font-size: 14px;
}
table{
  border: 1px white solid !important;
  width:100%;
}

</style>
<body>
<section>
  <div class="container-fluid">
    <div class="row" style="flex-wrap: nowrap !important">
      <div class="col-2 dash-nav  bg-info py-2" style="overflow-x:hidden !important; font-size: 14px !important">
                <ul class="list-group dash-nav-ui  bg-info text-white">
                    <form action="rooms.php" method="post">
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="dash.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-user-tie"></i><span>Admins</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="users.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-users"></i><span>Users</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded active" style="border: none !important;" ><a href="hotels.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-hotel"></i><span>Hotels > <i class="fa-solid fa-door-open"></i> Rooms</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="partners.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-key"></i><span>Partners</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="resrvations.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i><span>Bookings</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="comment.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i><span>Comments</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="settings.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-gear"></i><span>Settings</span></a></li>
                    <li class="my-2 list-group-item bg-info text-white rounded" style="border: none !important;" ><a href="devise.php" class="list-group-item list-group-item-action bg-info text-white px-0" style="border:none !important" ><i class="fa-solid fa-sack-dollar"></i> <span>Devise</span></a></li>
                    <li class="my-2 list-group-item text-white bg-danger rounded logout p-0" style="border: none !important; margin-right:1.5rem !important" ><button name="logout" class="p-3 btn bg-danger fw-bold list-group-item list-group-item-action bg-primary text-white" style="border:none !important" ><i style="margin-left:0 !important" class="mx-1 fa-solid fa-right-from-bracket"></i><span>Logout</span></button></li>
                    </form>
                </ul>
                </div>
                <div class="col py-3 p-3 cc  text-white" style="background-color: #f7f7ff">
                <div class="d-flex mb-4 justify-content-between p-3 rounded bg-primary fw-bold text-white">
                    <span>Rooms</span>
                    <span><i class="fa-solid fa-door-open"></i></span>
                </div>
                <!-- search input whith button -->
                <div class="d-flex gap-2 mb-5">
                    <input id="search" type="text" class="form-control" placeholder="Search..." value="" >
                </div>
                <h4 class="text-dark">
                    <?Php 
                    $sql = 'select * from room where hotel_id = '.$hotel_id.'';
                    $rslt = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($rslt);
                    $hotel_id = $row['hotel_id'];
                    $sql1 = "SELECT * FROM hotel WHERE id = '$hotel_id'";
                    $rslt1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($rslt1);
                    echo $row1['name'] . ' Hotel Rooms';
                    ?>

                </h4>
                <table id="table">
                    <?PHP
                    $sql = 'select * from room where hotel_id = '.$hotel_id.'';
                    $rslt = mysqli_query($conn, $sql);
                    ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Price</th>
                        
                            <th>Capacity</th>
                            <th>Size</th>
                            <th>Beds type</th>
                            <th>Beds number</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($rslt)){
                        ?>
                        <form action="rooms.php" method="post">
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                           
                            <td>
                                <?php
                                echo $row['type'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $row['price'];
                                ?>
                            </td>
                            <td><?php echo $row['capacity'] ?></td>
                            <td><?php echo $row['size'] ?></td>
                            <td>
                                <?php
                                echo $row['bedtype'];
                                ?>
                            </td>
                            <td><?php echo $row['bednbr'] ?></td>

                            
                        </tr>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        </form>
                        <?php
                        }
                        ?>
                </table>
                </div>
    </div>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        let search = document.getElementById('search')
        document.addEventListener('DOMContentLoaded', function() {
            search.addEventListener('keyup', function(e){
                e.preventDefault();
                let value = search.value;
                let table = 'room';
                searchTable(value, table);
            })
                
        });
        function searchTable(value, table){
            let url = 'search.php?search='+value+'&table='+table;
            fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('table').innerHTML = data;
            })
        }
    </script>
</body>
</html>
<?php 
if(isset($_POST['logout'])){
    session_destroy();
    header('location: index.php');
  }


?>