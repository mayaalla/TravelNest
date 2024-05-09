// Purpose: This file is used to insert a comment into the database
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
  }
include('db.php');
if(isset($_POST['submit'])){
    $destination = $_POST['destination'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $room = $_POST['room'];
    $hotel_id = $_POST['hotel_id'];
    $username = $_POST['username'];
    $note = $_POST['note'];
    $comment = $_POST['comment'];
    $sqluser = 'select * from user where username = "'.$username.'"';
    $resultuser = $conn->query($sqluser);
    $rowuser = $resultuser->fetch_assoc();
    $datecomment = date('Y-m-d');
    $sql = 'insert into comment (hotel_id, user_id, note, comment_text, date_comment) values ('.$hotel_id.', '.$rowuser['id'].', '.$note.', "'.$comment.'", "'.$datecomment.'")';
    $conn->query($sql);
    echo "<script>location.href='hotel.php?hotel_id=".$hotel_id."&destination=".$_POST['destination']."&checkin=".$_POST['checkin']."&checkout=".$_POST['checkout']."&adults=".$_POST['adults']."&children=".$_POST['children']."&rooms=".$_POST['room']."'</script>";
}



