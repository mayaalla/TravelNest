<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
  include('../db.php');


  if($_SESSION['partner'] == "" ){
    echo '<script>window.location.href = "index.php"</script>';
  }else{
    $sqlpartner = 'select * from partner where username = "'.$_SESSION['partner'].'"';
    $rsltpartner = mysqli_query($conn, $sqlpartner);
    $rowpartner = mysqli_fetch_assoc($rsltpartner);
  }
  if(isset($_GET['id'])){
    $value = $_GET['id'];
  }else{
    $value = "";
  }
    $sqlreservation = 'select * from reservation where room_id in (select id from room where hotel_id in (select id from hotel where id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'")))';
    $rsltreservation = mysqli_query($conn, $sqlreservation);
    $numreservation = mysqli_num_rows($rsltreservation);
    
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
label{
  font-size: 14px;
  font-weight: 600;
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
/* change the place holder opcity */
input::placeholder{
    color: #00000050 !important;
    font-weight: 600 !important;
}
.col-2{
    min-height: 100vh;
}
</style>
<body>
    <?php include('header.php'); ?>
    <div class="container-fluid">
        <div class="row  flex-nowrap">
            <div class="col-2 dash-nav py-2 bg-info text-white" style="overflow-x:hidden !important; font-size: 14px !important">
              <form action="" method="post">
              <ul class="list-group dash-nav-ui  bg-info text-white" id="dash-nav-ui">
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="partner.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-user"></i> <span>Compte</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="property.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-hotel"></i> <span>Property</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="rooms.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bed"></i> <span>Rooms</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2 active" style="border: none !important;" ><a class="text-white bg-info link" href="booking.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i> <span>Booking</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="occupedroom.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-lock"></i> <span>Occupied room</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="commentrate.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i> <span>Comments and Rate</span></a></li>
              </ul>
              </form>
            </div>
            <div class="col py-3">
                <h3>List of Reservation</h3>
                <?php if($numreservation > 0){ ?>
                <!-- <input type="text" id="search" class="form-control mb-2" placeholder="Search reservation..."> -->
                <?php if($value != ""){ ?>
                    <input type="text" id="search" class="form-control mb-3" placeholder="Search reservation..." value="<?php echo $value; ?>">
                <?php }else{ ?>
                    <input type="text" id="search" class="form-control mb-3" placeholder="Search reservation...">
                <?php } ?>
                <p class="text-muted m-0 fw-bold">Total reservation: <?php echo $numreservation; ?></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>User</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Price</th>
                            <th>Guest</th>
                            <th>Reservation Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rowreservation = mysqli_fetch_assoc($rsltreservation)){ ?>
                        <tr>
                            <td><?php 
                            $sqlroom = 'select * from room where id = "'.$rowreservation['room_id'].'" and hotel_id in (select id from hotel where id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'"))';
                            $rsltroom = mysqli_query($conn, $sqlroom);
                            $rowroom = mysqli_fetch_assoc($rsltroom);
                            echo $rowroom['id'];
                            ?></td>
                            <td><?php 
                            $sqluser = 'select * from user where id = "'.$rowreservation['user_id'].'"';
                            $rsltuser = mysqli_query($conn, $sqluser);
                            $rowuser = mysqli_fetch_assoc($rsltuser);
                            // check if there is a reslut
                            if($rowuser['id'] == ""){
                                echo 'User Deleted';
                            }else{
                                echo $rowuser['username'];
                            }

                            ?></td>
                            <td><?php echo $rowreservation['date_debut']; ?></td>
                            <td><?php echo $rowreservation['date_fin']; ?></td>
                            <td><?php echo $rowreservation['Total_price']."$"; ?></td>
                            <td><?php echo $rowreservation['nbr_person'] + $rowreservation['nbr_child']; ?></td>
                            <td><?php echo $rowreservation['reservation_date']; ?></td>
                            <td><?php echo $rowreservation['status']; ?></td>
                            <td>
                                <a href="booking.php?id=<?php echo $rowreservation['id']; ?>" class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i></a>
                                <a href="editbooking.php?id=<?php echo $rowreservation['id']; ?>" class="btn btn-info text-white"><i class="fa-solid fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php } ?>


                    <?php }else{ ?>
                        <!-- alert -->
                        <div class="alert alert-warning" role="alert">
                            No reservation yet
                        </div>
                        <?php } ?>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    // get the header hieght
    let header =document.getElementById('header');
let headerHeight = header.clientHeight;
let dashNav = document.getElementById('dash-nav-ui');
dashNav.style.height = 'calc(100vh - '+headerHeight+'px)';

// search
let search = document.getElementById('search')
        document.addEventListener('DOMContentLoaded', function() {
            search.addEventListener('keyup', function(e){
                e.preventDefault();
                let value = search.value;
                let table = 'room';
                searchTable(value, table);
            })
        });
        // whene the window onload
        window.onload = function(){
            let value = search.value;
            let table = 'room';
            searchTable(value, table);
        }
        function searchTable(value, table){
            let search = value.toLowerCase();
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                let all = row.querySelectorAll('td');
                let found = false;
                all.forEach(cell => {
                    let text = cell.innerText;
                    if(text.toLowerCase().indexOf(search) > -1){
                        found = true;
                    }
                });
                if(found){
                    row.style.display = '';
                }else{
                    row.style.display = 'none';
                }
            });
        }




  </script>
</body>
</html>
<?php 


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqldelete = 'delete from reservation where id = "'.$id.'"';
    $rsltdelete = mysqli_query($conn, $sqldelete);
    if($rsltdelete){
        echo '<script>window.location.href = "booking.php"</scrip>';
    }
}