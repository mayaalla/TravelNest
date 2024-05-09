<?php 
include("../db.php");
$sqlusers = 'select count(*) as t from user';
$rsltusers = mysqli_query($conn, $sqlusers);
$rowusers = mysqli_fetch_assoc($rsltusers);
$sqlhotels = 'select count(*) as t from hotel';
$rslthotels = mysqli_query($conn, $sqlhotels);
$rowhotels = mysqli_fetch_assoc($rslthotels);
$sqlreservations = 'select count(*) as t from reservation';
$rsltreservations = mysqli_query($conn, $sqlreservations);
$rowreservations = mysqli_fetch_assoc($rsltreservations);
$sqlcomments = 'select count(*) as t from comment';
$rsltcomments = mysqli_query($conn, $sqlcomments);
$rowcomments = mysqli_fetch_assoc($rsltcomments);
