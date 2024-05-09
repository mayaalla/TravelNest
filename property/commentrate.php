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
$sqlproperty = 'select * from partnerhotel where partner_id = "'.$rowpartner['id'].'"';
$rsltproperty = mysqli_query($conn, $sqlproperty);
$numrow = mysqli_num_rows($rsltproperty);

$sql = 'select * from comment where hotel_id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'")';
$rslt = mysqli_query($conn, $sql);
$num = mysqli_num_rows($rslt);
$sqlnote = 'select * from hotel_average_notes where hotel_id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'")';
$rsltnote = mysqli_query($conn, $sqlnote);
$note = mysqli_fetch_assoc($rsltnote);
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
</style>
<body class="d-grid">
    <?php include('header.php'); ?>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-2 dash-nav py-2 bg-info text-white" style="overflow-x:hidden !important; font-size: 14px !important">
              <form action="" method="post">
              <ul class="list-group dash-nav-ui  bg-info text-white" id="dash-nav-ui">
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="partner.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-user"></i> <span>Compte</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="property.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-hotel"></i> <span>Property</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="rooms.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bed"></i> <span>Rooms</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="booking.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-bookmark"></i> <span>Booking</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2" style="border: none !important;" ><a class="text-white bg-info link" href="occupedroom.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-lock"></i> <span>Occupied room</span></a></li>
                <li class="list-group-item rounded bg-info text-white bg-info my-2 active" style="border: none !important;" ><a class="text-white bg-info link" href="commentrate.php"><i style="margin-left:0 !important" class="mx-1 fa-solid fa-comment"></i> <span>Comments and Rate</span></a></li>
              </ul>
              </form>
            </div>
            <div class="col py-3">
                <h3>Comments and Rate</h3>
                <?php if($num == 0){ ?>
                    <p class="text-muted">No comments yet</p>
                <?php }else{ ?>
                <P class="fw-bold mb-0 mt-3 text-muted">Your Property Rate : <?php echo $note['average_note']; ?></P>
                <P class="fw-bold text-muted mb-0"> Comments Number : <?php echo $num; ?></P>
                <?php } ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Comment</th>
                            <th>Rate</th>
                            <th>User Name</th>
                            <th>Comment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($rslt)){
                            $sqluser = 'select * from user where id = "'.$row['user_id'].'"';
                            $rsltuser = mysqli_query($conn, $sqluser);
                            $rowuser = mysqli_fetch_assoc($rsltuser);
                            $name = $rowuser['name'].' '.$rowuser['prename'];
                            echo '<tr>';
                            echo '<td>'.$row['comment_text'].'</td>';
                            echo '<td>'.$row['note'].'</td>';
                            echo '<td>'.$name.'</td>';
                            echo '<td>'.$row['date_comment'].'</td>';
                            echo '</tr>';
                        }
                        ?>
                </table>
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
let q3 =document.getElementById('q3');
console.log(q3.name);
  </script>
</body>
</html>
