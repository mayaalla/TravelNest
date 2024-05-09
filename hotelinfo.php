<?php   
        $hotel_id = $_GET['hotel_id'];
        $sql = "SELECT * FROM hotel WHERE id = $hotel_id";
        $sqlimg = "SELECT * FROM hotel_images WHERE hotel_id = $hotel_id";
        $sqlnote = "select average_note from hotel_average_notes where hotel_id = $hotel_id";
        $resultnote = mysqli_query($conn, $sqlnote);
        $rownote = mysqli_fetch_assoc($resultnote);
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $resultimg = mysqli_query($conn, $sqlimg);
        $sqloption = 'select * from hotel_option where hotel_id = '.$hotel_id;
        $resoption = mysqli_query($conn,$sqloption);
        ?>
<div id="carouselExampleFade" class="carousel slide carousel-fade">
  <div class="carousel-inner">
    <?php $i=0; while($rowimg = mysqli_fetch_assoc($resultimg)){ ?>
        <?php if($i==0){ $i++; ?>
    <div class="carousel-item active">
      <img src="images/hotelspic/<?php echo $rowimg['url'] ?>" class="d-block w-100" style="aspect-ratio: 16/ 9;">
    </div>
    <?php }else{ ?>
    <div class="carousel-item">
      <img src="images/hotelspic/<?php echo $rowimg['url'] ?>" class="d-block w-100" style="aspect-ratio: 16/ 9;">
    </div>
    <?php } ?>
    <?php } ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" style="height: 80px; width:100px; " aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" style="height: 80px; width:100px; " aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        <div class="container">
          <div class="row py-3 hotel-description">
            <div class="col-8 hotel-description">
                <h1 class="m-0 p-0">
                    <?php echo $row['name'] ?> <br>
                </h1>
                <p style="font-size: 14px;" class="mb-4">
            <?php 
            $i = 0;
            for($i=0; $i<5; $i++){
                if($i<$row['nbrstar']){
                    echo '<i class="bi bi-star-fill" style="color: #FF731D;"></i>';
                }else{
                    echo '<i class="bi bi-star" style="color: #FF731D;"></i>';
                }
            }
            ?>
            </p>
            <P class="mb-2" style="font-weight:600; font-size:14px;">
             <span class="text-white p-2 bg-primary rounded"><?php if($rownote['average_note'] == null){
              echo "0.0";
             }else{
              echo $rownote['average_note'];
             } ?></span>
             <?php 
                if($rownote['average_note'] >= 7 && $rownote['average_note'] < 8){
                    echo "Good";
                }elseif($rownote['average_note'] >= 8 && $rownote['average_note'] < 9){
                    echo "Very Good";
                }elseif($rownote['average_note'] >= 9){
                    echo "Excellent";
                }else{
                    echo "";
                }
             ?>
            </P>
            <button type="button" class="text-primary p-0 mb-3 text-decoration-underline" style="font-size: .75rem; outline: none; border:none; background:none;" data-bs-toggle="modal" data-bs-target="#cmnt">
  See all the <?php echo $row['nbrcomment'] ?> reviews >
</button>
            <p class="m-0" style="font-size: 14px;">
            <i class="fa-solid fa-phone text-primary"></i>
              <?php echo $row['phone'] ?>
            </p>
            <p style="font-size: 14px;">
            <?php 
            $sqlcountries = "SELECT * FROM countries WHERE countries_id = ".$row['countries_id']; 
            $rescountries = mysqli_query($conn,$sqlcountries);
            $rowcountries = mysqli_fetch_array($rescountries);
            $sqlstate = "SELECT * FROM states WHERE id_state = ".$row['id_state'];
            $resstate = mysqli_query($conn,$sqlstate);
            $rowstate = mysqli_fetch_array($resstate);
            echo '<i class="fa-solid fa-location-dot text-primary"></i> '. $row['adresse'] ;
            ?>
            </p>
            <div class="row">
              <h5>Popular equipment</h5>
              <?php $l=0; etq: ?>
              <div class="col">
              
            <?php
            $n=0;
            while($rowoption = mysqli_fetch_assoc($resoption)){ 
              if($l <6){
                if($n<3){
                    $n++;
                    echo "<p style='font-size:14px' class='fw-bold mb-2'> <i class='fa-solid fa-check text-primary'></i> " . $rowoption['option_name'] . "</p>";
                }elseif($n==3){
                    $n=0;
                    echo "</div>";
                    goto etq;
                }
              }elseif($l=6){
                ;
              }
              $l++;
              ?>
            
          <?php }?>
          
            </div>
            </div>
            <!-- Button trigger modal -->
<button type="button" class="text-primary text-decoration-underline p-0" style="font-size:.75rem; outline: none; border:none; background:none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  See all the equipment >
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hotel equipment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <?php $resoption = mysqli_query($conn,$sqloption);
        $m = 0;
        while($rowoption = mysqli_fetch_assoc($resoption)){
          $m++;
        }
        $mm = $m/2;
        $resoption = mysqli_query($conn,$sqloption);
        ?> 
        <div class="col">
        <?php
        while($rowoption = mysqli_fetch_assoc($resoption)){ 
          if($mm==0){
            $name = $rowoption['option_name'];
            break;
          }else{
            
          
          ?>
          
            <p style="font-size:14px" class="fw-bold"> <i class="fa-solid fa-check text-primary"></i> <?php echo $rowoption['option_name'] ?></p>
          
        <?php
        
        $mm--;
        }
        }
        ?>
        </div>
        <div class="col">
          <p style="font-size:14px" class="fw-bold"> <?php if(isset($name)){
            echo '<i class="fa-solid fa-check text-primary"></i>'. $name;
          } ?></p>
        <?php
        while($rowoption = mysqli_fetch_assoc($resoption)){ 
          echo "<p style='font-size:14px' class='fw-bold'> <i class='fa-solid fa-check text-primary'></i> " . $rowoption['option_name'] . "</p>";
        }
         ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
$sqlframe = 'select * from iframe where hotel_id = '.$hotel_id;
$resframe = mysqli_query($conn,$sqlframe);
$rowframe = mysqli_fetch_assoc($resframe);
?>
            </div>
            <div class="col iframe" >
              <?php $addrs = '<iframe src="'.$rowframe['url'].'" height="250" width="250"  class="rounded" style="border:1px #0c045a solid;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'; ?>
              <?php echo $addrs; ?>
            </div>
        </div>
        </div>
