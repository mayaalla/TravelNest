<?php 
$sqlimages = 'select * from hotel_images where hotel_id = "'.$rowhotel['id'].'"';
$rsltimages = mysqli_query($conn, $sqlimages);
$x = true;
$i = 1;
?>

<style>
    .carousel-item {
        position: relative;
        max-width: 100%;
        height: 400px;
    }
    .carousel-item  img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: filter 0.3s;
    }
    .delete-btn {
        position: absolute;
        top: 50%; /* Center vertically */
        left: 50%; /* Center horizontally */
        transform: translate(-50%, -50%); /* Adjust to exact center */
        display: none;
        z-index: 100;
    }
    .carousel-item:hover .delete-btn {
        display: block;
    }
    .carousel-item:hover img {
        filter: brightness(50%); /* Darken the image */
    }
</style>

<div id="carouselExampleIndicators" class="carousel slide" style="max-width:100%; height:400px">
  <div class="carousel-indicators">
    <?php while($rowimages = mysqli_fetch_assoc($rsltimages)){ 
        if($x){
        ?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <?php }else{ ?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to='<?php echo $i?>' aria-label="Slide <?php echo ++$i?>"></button>
        <?php } $x=false; } 
        $rsltimages = mysqli_query($conn, $sqlimages); $x=true; 
        ?>
  </div>
  <div class="carousel-inner">
    <?php while($rowimages = mysqli_fetch_assoc($rsltimages)){ 
        if($x){
        ?>
        
    <div class="carousel-item active">
      
        <img src="../images/hotelspic/<?php echo $rowimages['url'] ?>" class="d-block w-100" alt="...">
        <form action="property.php" method="post">
        <input type="hidden" name="deleteimage" value="<?php echo $rowimages['id'] ?>">
        <button name="deleteimg" class="btn btn-danger delete-btn" style="width:64px; height:64px"><i style="font-size: 1.5rem;" class="fa-solid fa-trash"></i></button>
        </form>
    </div>
        
        <?php }else{ ?>
        
    <div class="carousel-item">
        
          <img src="../images/hotelspic/<?php echo $rowimages['url'] ?>" class="d-block w-100" alt="...">
          <form action="property.php" method="post">
          <input type="hidden" name="deleteimage" value="<?php echo $rowimages['id'] ?>">
          <button name="deleteimg" class="btn btn-danger delete-btn" style="width:64px; height:64px"><i style="font-size: 1.5rem;" class="fa-solid fa-trash"></i></button>
          </form>
    </div>
        
        <?php } $x=false; } ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" style="width: 48px ; height:48px" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" style="width: 48px ; height:48px" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<?php 
$sqltotalimages = 'select count(*) as total from hotel_images where hotel_id = "'.$rowhotel['id'].'"';
$rslttotalimages = mysqli_query($conn, $sqltotalimages);
$rowtotalimages = mysqli_fetch_assoc($rslttotalimages);
?>
<p class="fw-bold text-primary">Total images: <?php echo $rowtotalimages['total'] ?></p>
<?php
if(isset($_POST['deleteimg'])){
    $sqldelete = 'delete from hotel_images where id = "'.$_POST['deleteimage'].'"';
    $rsltdelete = mysqli_query($conn, $sqldelete);
    if($rsltdelete){
        echo '<script>alert("Image deleted successfully")</script>';
        echo '<script>window.location.href = "property.php"</script>';
    }else{
        echo '<script>alert("Error while deleting the image")</script>';
        echo '<script>window.location.href = "property.php"</script>';
    }
}