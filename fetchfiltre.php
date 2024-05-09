<?php 


include("db.php");

// Retrieve variables from the query string
$destination = isset($_GET['destination']) ? $_GET['destination'] : 'Tokyo';
$checkin = isset($_GET['checkin']) ? $_GET['checkin'] : date('Y-m-d');
$checkout = isset($_GET['checkout']) ? $_GET['checkout'] : date('Y-m-d', strtotime('+1 day'));
$adults = isset($_GET['adults']) ? (int)$_GET['adults'] : 1;
$children = isset($_GET['children']) ? (int)$_GET['children'] : 0;
$rooms = isset($_GET['rooms']) ? (int)$_GET['rooms'] : 1;
$equipmentlist = isset($_GET['equipmentlist']) ? $_GET['equipmentlist'] : '';
$starslist = isset($_GET['starslist']) ? $_GET['starslist'] : '';
$notelist = isset($_GET['notelist']) ? $_GET['notelist'] : '';
$max = isset($_GET['max']) ? $_GET['max'] : 1000;
$min = isset($_GET['min']) ? $_GET['min'] : 0;

$array = [];
$condition = '';
    $c1 = 'id in (select hotel_id from hotel_option where option_name in('.$equipmentlist.'))';
    $c2 = 'nbrstar in('.$starslist.')';
    $c3 = 'id in (select hotel_id from hotel_average_notes where cast(average_note as SIGNED) in('.$notelist.'))';
    $c4 = 'id in (select hotel_id from total_price where total between '.$min.' and '.$max.')';
    if($equipmentlist != ''){
        array_push($array, $c1);
    }
    if($starslist != ''){
        array_push($array, $c2);
    }
    if($notelist != ''){
        array_push($array, $c3);
    }
    
    if($min != '' && $max != ''){
        array_push($array, $c4);
    }
    

    for($i = 0; $i < count($array); $i++){
        if($i == 0){
            $condition = $array[$i];
        }else{
            $condition = $condition.' AND '.$array[$i];
        }
    }
    // $sql = 'select * from hotel where '.$condition;
    // $result = mysqli_query($conn, $sql);
    // $i = 0;
    if($condition != ''){
        $sqlhotel = 'select * from hotel where '.$condition;
    }else{
        $sqlhotel = 'select * from hotel';
    }
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
            break;
        }
    }

    $sqlimage = 'SELECT url FROM hotel_images WHERE hotel_id = '.$row['id'];
    $resultimage = mysqli_query($conn, $sqlimage);
    $imgarray = [];
    while($rowimage = mysqli_fetch_assoc($resultimage)) {
    $imgarray[] = $rowimage['url'];
    }
    include('hotelscard.php');
    $i++;
}