<?php 
include('db.php');
?>
<input type="hidden" name="hotel_id" value="<?php echo $hotel_id ?>">
    <input type="hidden" name="room_id" value="<?php echo $room_id ?>">
    <input type="hidden" name="destination" value="<?php echo $destination ?>">
    <input type="hidden" name="checkin" value="<?php echo $checkin ?>">
    <input type="hidden" name="checkout" value="<?php echo $checkout ?>">
    <!-- adults and user if existe -->
    <input type="hidden" name="adults" value="<?php echo $adult ?>">
    <input type="hidden" name="children" value="<?php echo $child ?>">
    <input type="hidden" name="totalprice" value="<?php echo $totalprice ?>">   
    <?php
if(isset($_POST['book'])){
    $cuurentdate = date('Y-m-d');
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $hotel_id = $_POST['hotel_id'];
    $room_id = $_POST['room_id'];
    $destination = $_POST['destination'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $totalprice = $_POST['totalprice'];
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $sqluser = "SELECT * FROM user WHERE username = '$username'";
        $resultuser = mysqli_query($conn, $sqluser);
        $row = mysqli_fetch_assoc($resultuser);
        $user_id = $row['id'];
        $query = "INSERT INTO reservation (user_id, room_id, date_debut, date_fin, nbr_person, status, hotel_id, Total_price, nbr_child, reservation_date) VALUES ('$user_id', '$room_id', '$checkin', '$checkout', '$adults', 'Confirmer', '$hotel_id', '$totalprice', '$children', '$cuurentdate')";
        $result = mysqli_query($conn, $query);
        echo "<script>alert('Reservation made successfully'); window.location.href = 'index.php';</script>";
    }else{
        $query = "INSERT INTO reservation (room_id, date_debut, date_fin, nbr_person, status, hotel_id, Total_price, nbr_child, reservation_date) VALUES ('$room_id', '$checkin', '$checkout', '$adults', 'Confirmer', '$hotel_id', '$totalprice', '$children', '$cuurentdate')";
        $result = mysqli_query($conn, $query);
        echo "<script>alert('Reservation made successfully'); window.location.href = 'index.php';</script>";
        // make asychrone fuction after 10s to redirect to home page
        
    }

}
    ?>