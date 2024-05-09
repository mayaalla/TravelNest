<?php
include("db.php");

// Retrieve variables from the query string
$destination = isset($_GET['destination']) ? $_GET['destination'] : 'Tokyo';
$checkin = isset($_GET['checkin']) ? $_GET['checkin'] : date('Y-m-d');
$checkout = isset($_GET['checkout']) ? $_GET['checkout'] : date('Y-m-d', strtotime('+1 day'));
$adults = isset($_GET['adults']) ? (int)$_GET['adults'] : 1;
$children = isset($_GET['children']) ? (int)$_GET['children'] : 0;
$rooms = isset($_GET['rooms']) ? (int)$_GET['rooms'] : 1;


$sqlhotel = 'select * from hotel order by nbrstar DESC';

$result = mysqli_query($conn, $sqlhotel);
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
    // Determine if the hotel has a pool
    $sqloption = 'SELECT option_name FROM hotel_option WHERE hotel_id = '. $row['id'];
    $resultoption = mysqli_query($conn, $sqloption);
    $pool = false;
    while($rowoption = mysqli_fetch_assoc($resultoption)){
        if($rowoption['option_name'] == 'Pool'){
            $pool = true;
            break; // Exit the loop once a pool is found
        }
    }

    // Fetch hotel images
    $sqlimage = 'SELECT url FROM hotel_images WHERE hotel_id = '.$row['id'];
    $resultimage = mysqli_query($conn, $sqlimage);
    $imgarray = [];
    while($rowimage = mysqli_fetch_assoc($resultimage)) {
        $imgarray[] = $rowimage['url'];
    }

    include('hotelscard.php'); // This will output each hotel card
    $i++;
}
?>