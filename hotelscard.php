<?php 


?>
<div class="card mt-4 px-0" style="position:relative" id="hotelscard" >
  <div class="row g-0">
    <div class="col-md-4">
      
    <div id="<?php echo  'c' . $i ?>" class="carousel slide carousel-fade">
  <div class="carousel-inner">
    <div class="carousel-item active" style="aspect-ratio: 16/10 !important;">
      <img src="images/hotelspic/<?php echo $imgarray[0] ?>" class="d-block w-100 h-100" alt="...">
    </div>
    <div class="carousel-item" style="aspect-ratio: 16/10 !important;">
      <img src="images/hotelspic/<?php echo $imgarray[1] ?>" class="d-block w-100 h-100" alt="...">
    </div>
    <div class="carousel-item" style="aspect-ratio: 16/10 !important;">
      <img src="images/hotelspic/<?php echo $imgarray[2] ?>" class="d-block w-100 h-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo 'c' . $i ?>" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#<?php echo  'c' . $i ?>" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
    <a class="col-md-8 text-black" href="hotel.php?hotel_id=<?php echo $row['id'] ?>&destination=<?php echo $destination ?>&checkin=<?php echo $checkin ?>&checkout=<?php echo $checkout ?>&adults=<?php echo $adults ?>&children=<?php echo $children ?>&rooms=<?php echo $rooms ?>" target='_blank'>
      <div class="card-body pb-0 pt-2 #carouselExampleFade">
        <h4 class="card-title m-0" style="font-weight: 600;"><?php echo $row['name']?></h4>
        <p class="card-text m-0" style="font-size:12px">
        <?php 
        $sqlstate = 'select name from states where id_state = '.$row['id_state'];
        $resultstate = mysqli_query($conn, $sqlstate);
        $rowstate = mysqli_fetch_assoc($resultstate);
        $sqlcountries = 'select name from countries where countries_id = '.$row['countries_id'];
        $resultcountries = mysqli_query($conn, $sqlcountries);
        $rowcountries = mysqli_fetch_assoc($resultcountries);
        echo $rowcountries['name']. ', ' . $rowstate['name'];
        $i++;
        ?>
        </p>
        <p class="card-text m-0"><small class="text-primary">
        <!-- <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i> -->
        <?php 
        for($i=0; $i<$row['nbrstar']; $i++){
            echo '<i class="fa-solid fa-star text-primary"></i>';
        }
        ?>
        </small></p>
        <p class="card-text m-0" style="font-size:12px">
        <!-- <i class="fa-solid fa-person-swimming text-primary"></i> Pool -->
        <?php if($pool == true){
            echo '<i class="fa-solid fa-person-swimming text-primary"></i> Pool';
        }else{
            echo '';
        }
        ?>
        </p>
        <p class="card-text m-0" style="font-size:24px; color: white;">
        a333333333333333333333333333333333333333333333333333333333333333333
         </p>
      </div>
      <?php 
        $checkinDate = new DateTime($checkin);
        $checkoutDate = new DateTime($checkout);
        $interval = $checkinDate->diff($checkoutDate);
        $numberOfDays = $interval->days;
        $sqlminprice = 'select id, min(price) as minprice from room where hotel_id = '.$row['id'];
        $resultminprice = mysqli_query($conn, $sqlminprice);
        $rowminprice = mysqli_fetch_assoc($resultminprice);
        $minprice = $rowminprice['minprice'];
        $sqloption = 'select * from room_option where room_id = '.$rowminprice['id'];
        $resultoption = mysqli_query($conn, $sqloption);
        while($rowoption = mysqli_fetch_assoc($resultoption)){
            $minprice += $rowoption['price'];
        }
        $sqlhotelo = 'select * from hotel_option where hotel_id = '.$row['id'];
        $resulthotelo = mysqli_query($conn, $sqlhotelo);
        while($rowhotelo = mysqli_fetch_assoc($resulthotelo)){
            $minprice += $rowhotelo['price'];
        }

        $totalprice = $minprice*$numberOfDays*$rooms + 40*$adults + 20*$children;
        $sqltotal = ' insert into total_price (hotel_id, total) values ('.$row['id'].', '.$totalprice.')';
        $resulttotal = mysqli_query($conn, $sqltotal);
        ?>
      <div class="card-footer text-black p-0 " style="background: none; margin-bottom: 8px; text-align: right; position:absolute; border: none !important; bottom: 0; right:0; margin-right:16px">
        <p class="card-text m-0 price " data-original-price=<?php echo $totalprice; ?> style="font-size:24px; font-weight: 600; ">
        <?php echo $totalprice; ?>$
        </p>
        <p class="card-text m-0 price-night" data-original-price=<?php echo $minprice; ?>  style="font-size:12px; ">
       <?php echo $minprice; ?>$/night
        </p>
        <p class="card-text m-0 " style="font-size:12px; ">
        inluded tax and fees
        </p>
     </div>
     <div class="card-footer p-0  d-flex gap-1" style=" background:none; position:absolute; margin-bottom: 8px; border: none !important; bottom: 0; margin-left:16px">
        <p class="card-text m-0 text-center py-1 px-2 d-flex align-items-center justify-content-center bg-primary rounded" style="color:white; font-weight:500; font-size:16px">
        <?php 
        $sqlavg = 'select average_note from hotel_average_notes where hotel_name like "'.$row['name'].'"';
        $resultavg = mysqli_query($conn, $sqlavg);
        $rowavg = mysqli_fetch_assoc($resultavg);
        if($rowavg['average_note'] == null){
            echo '0.0';
        }else{
            echo $rowavg['average_note'];
        }
        
        $avg = $rowavg['average_note'];
        ?>
        </p>
        <span class="card-text m-0" style="font-size:12px; font-weight: 500;">
        <p class="p-0 m-0"  >
        <?php 
        if($avg>=9){
            echo 'Excellent';
        }elseif($avg>=8){
            echo 'Very Good';
        }elseif($avg>=7){
            echo 'Good';
        }else{
            echo '';
        }
        ?>
        </p>
        <p class="p-0 m-0" ><?php echo $row['nbrcomment'] ?> reviwes</p>
        </span>
     </div>
    </a>
  </div>
</div>