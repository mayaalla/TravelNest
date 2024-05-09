<?php
include("../db.php");
$value = $_GET['search'];
// check if value is int
$table = $_GET['table'];
if($table == 'user'){
  if(is_numeric($value)){
    $sql = "select * from user where id = $value or phone LIKE '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}else{
    $sql = "select * from user where username like '%$value%' or name like '%$value%' or prename like '%$value%' or email like '%$value%' or pays like '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}
if($value == ''){
  $sql = "select * from $table";
  $rslt = mysqli_query($conn, $sql);
}
}elseif($table == 'reservation'){
  if(is_numeric($value)){
    $sql = "select * from reservation where id = $value or user_id LIKE '%$value%' or room_id LIKE '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}else{
    $sql = "select * from reservation where date_debut like '%$value%' or date_fin like '%$value%' or hotel_id in (select id from hotel where name like '%$value%') or status like '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}
if($value == ''){
  $sql = "select * from $table";
  $rslt = mysqli_query($conn, $sql);
}
}elseif($table == 'hotel'){
  if(is_numeric($value)){
    $sql = "select * from hotel where id = $value or nbrstar LIKE '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}else{
    $sql = "select * from hotel where name like '%$value%' or adresse like '%$value%' or countries_id in (select countries_id from countries where name like '%$value%') or id_state in (select id_state from states where name like '%$value%') or phone like '%$value%' or email like '%$value%' or nbrcomment like '%$value%'";
    $rslt = mysqli_query($conn, $sql);

}
if($value == ''){
  $sql = "select * from $table";
  $rslt = mysqli_query($conn, $sql);
}
}elseif($table == 'comment'){
  if(is_numeric($value)){
    $sql = "select * from comment where id = $value or hotel_id LIKE '%$value%' or user_id LIKE '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}else{
    $sql = "select * from comment where comment_text like '%$value%' or hotel_id in (select id from hotel where name like '%$value%') or user_id in (select id from user where username like '%$value%') or date_comment like '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}
if($value == ''){
  $sql = "select * from comment";
  $rslt = mysqli_query($conn, $sql);
}
}elseif($table == 'room'){
  if(is_numeric($value)){
    $sql = "select * from room where id LIKE '%$value%' or hotel_id LIKE '%$value%' or capacity LIKE '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}
else{
    $sql = "select * from room where type like '%$value%' or hotel_id in (select id from hotel where name like '%$value%') or price like '%$value%' or size like '%$value%' or capacity like '%$value%'";
    $rslt = mysqli_query($conn, $sql);
}
if($value == ''){
  $sql = "select * from room";
  $rslt = mysqli_query($conn, $sql);
}
}


?>
<?php if($table=='user'){ ?>
<thead>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Prename</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Country</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysqli_fetch_assoc($rslt)){ ?>
                  <form action="users.php" method="post">
                  <tr>
                  <th><?php echo $row['id'] ?></th>
                  <td><?php echo $row['username'] ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['prename'] ?></td>
                  <td><?php echo $row['email'] ?></td>
                  <td><?php echo $row['phone'] ?></td>
                  <td><?php echo $row['pays'] ?></td>
                  <td><button type="submit" name="delete" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></td>
                  </tr>
                  <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                  </form>
                  <?php } ?>
                  </tbody>
<?php }elseif($table=='reservation'){ ?>
  <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hotel ID</th>
                            <th>Room ID</th>
                            <th>User ID</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Number of Guests</th>
                            <th>Reservation Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($rslt)){
                        ?>
                        <form action="reservations.php" method="post">
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php 
                            $sqlhotel = "SELECT * FROM hotel WHERE id = '".$row['hotel_id']."'";
                            $rslthotel = mysqli_query($conn, $sqlhotel);
                            $rowhotel = mysqli_fetch_assoc($rslthotel);
                            echo $rowhotel['name'];
                            ?></td>
                            <td><?php echo $row['room_id']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['date_debut']; ?></td>
                            <td><?php echo $row['date_fin']; ?></td>
                            <td><?php echo $row['nbr_person'] + $row['nbr_child']; ?></td>
                            <td><?php echo $row['reservation_date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><button type="submit" class="btn btn-danger" name="delete" value="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i> </button></td>
                        </tr>
                        <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                        </form>
                        </tbody>
                        <?php
                        }}elseif($table=='hotel'){ ?>
                        <table id="table">
                    <?PHP
                    // $sql = 'select * from hotel';
                    // $rslt = mysqli_query($conn, $sql);
                    ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contry</th>
                            <th>State</th>
                            <th>Adresse</th>
                            <th>Phone</th>
                            <th>Rooms</th>
                            <th>Stars</th>
                            <th>Review Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $checkin = date('Y-m-d');
                        $checkout = date('Y-m-d', strtotime($checkin. ' + 1 days'));
                        $adults = 1;
                        $children = 0;
                        $rooms = 1;
                        while($row = mysqli_fetch_assoc($rslt)){
                            $country_id = $row['countries_id'];
                            $sql2 = "SELECT * FROM countries WHERE countries_id = '$country_id'";
                            $rslt2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($rslt2);
                            $destination = $row2['name'];
                        ?>
                        <form action="hotels.php" method="post">
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <a class="text-light" target="_blank" href="../hotel.php?hotel_id=<?php echo $row['id'] ?>&destination=<?php echo $destination ?>&checkin=<?php echo $checkin ?>&checkout=<?php echo $checkout ?>&adults=<?php echo $adults ?>&children=<?php echo $children ?>&rooms=<?php echo $rooms ?>"><?php echo $row['name']; ?></a>
                            </td>
                            <td>
                                <?php
                                $country_id = $row['countries_id'];
                                $sql2 = "SELECT * FROM countries WHERE countries_id = '$country_id'";
                                $rslt2 = mysqli_query($conn, $sql2);
                                $row2 = mysqli_fetch_assoc($rslt2);
                                echo $row2['name'];
                                ?>
                            </td>
                            <td>
                                <?php
                                $state_id = $row['id_state'];
                                $sql3 = "SELECT * FROM states WHERE id_state = '$state_id'";
                                $rslt3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_assoc($rslt3);
                                echo $row3['name'];
                                ?>
                            <td><?php echo $row['adresse'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <td>
                                <a class="btn btn-info text-light" href="rooms.php?hotel_id=<?php echo $row['id']; ?>">Rooms</a>
                            </td>
                            <td><?php echo $row['nbrstar'] ?></td>
                            <td><?php echo $row['nbrcomment'] ?></td>
                            <td><button type="submit" class="btn btn-danger" name="delete" value="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i> </button></td>
                        </tr>
                        <input type="hidden" name="hotel_id" value="<?php echo $row['id']; ?>">
                        </form>
                        </tbody>
                        
                        <?php
                        }
                        }elseif($table=='comment'){ ?>
                        ?>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hotel Name</th>
                            <th>Username</th>
                            <th>Comment</th>
                            <th>Comment date</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($rslt)){
                        ?>
                        <form action="comment.php" method="post">
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <a class="text-light" target="_blank" href="#"><?php 
                                $sqlhotel = "SELECT * FROM hotel WHERE id = '".$row['hotel_id']."' ";
                                $rslthotel = mysqli_query($conn, $sqlhotel);
                                $rowhotel = mysqli_fetch_assoc($rslthotel);
                                echo $rowhotel['name'];
                                ?></a>
                            </td>
                            <td>
                                <?php
                                $sqluser = "SELECT * FROM user WHERE id = '".$row['user_id']."' ";
                                $rsltuser = mysqli_query($conn, $sqluser);
                                $rowuser = mysqli_fetch_assoc($rsltuser);
                                echo $rowuser['username'];
                                ?>
                            </td>
                            <td><?php echo $row['comment_text'] ?></td>
                            <td><?php echo $row['date_comment'] ?>
                            <td><?php echo $row['note'] ?></td>
                            <td><button type="submit" class="btn btn-danger" name="delete" value="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i> </button></td>
                        </tr>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        </form>
                        </tbody>
                        <?php
                        }}elseif($table=='room'){ ?>
                         <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hotel name</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th>Size</th>
                            <th>Beds type</th>
                            <th>Beds number</th>
                            <th>Action</th>
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
                                $hotel_id = $row['hotel_id'];
                                $sql1 = "SELECT * FROM hotel WHERE id = '$hotel_id'";
                                $rslt1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_assoc($rslt1);
                                echo $row1['name'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $row['price'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $row['type'];
                                ?>
                            <td><?php echo $row['capacity'] ?></td>
                            <td><?php echo $row['size'] ?></td>
                            <td>
                                <?php
                                echo $row['bedtype'];
                                ?>
                            </td>
                            <td><?php echo $row['bednbr'] ?></td>

                            <td><button type="submit" class="btn btn-danger" name="delete" value="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i> </button></td>
                        </tr>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        </form>
                        <?php
                        }}
                        ?>

                        

