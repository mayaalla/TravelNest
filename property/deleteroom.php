<?php 
include('../db.php');
$id = $_GET['id'];
$hotel_id = $_GET['hotel_id'];

$sql = 'delete from room where id = "'.$id.'" and hotel_id = "'.$hotel_id.'"';
mysqli_query($conn, $sql);
echo '<script>window.location.href = "rooms.php"</script>';