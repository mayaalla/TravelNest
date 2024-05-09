
<?php
include ("../db.php");
$sql = 'select * from admin';
$rslt = mysqli_query($conn, $sql);
$i = 0;
while($row = mysqli_fetch_assoc($rslt)){
    $i++;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
       height: 100vh;
       display: flex;
       justify-content: center;
       align-items: center;
    }
</style>
<body>
    
</body>
</html>

<?php
// Place this code at the top of your file or before any HTML output
if(isset($_POST['delete'])){
    $usernameToDelete = $_POST['usernameToDelete'];
    $deleteSql = "DELETE FROM admin WHERE username = '$usernameToDelete'";
    if(mysqli_query($conn, $deleteSql)){
        echo "<script>alert('Admin deleted successfully');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting admin');</script>";
    }
}
?>