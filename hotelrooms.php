<div class="container">
            <div class="row flex-wrap">
        <?php 
        $sqltype = "SELECT DISTINCT type FROM room WHERE hotel_id = $hotel_id";
        $resulttype = mysqli_query($conn, $sqltype);
        $j=0;
        while($rowtype = mysqli_fetch_assoc($resulttype)){
          $type = $rowtype['type'];
          echo "<script>console.log('".$type."')</script>";
          // convert checkin and checkout to string
          $checkin = date('Y-m-d', strtotime($checkin));
          $checkout = date('Y-m-d', strtotime($checkout));          
          // get the number of rooms available
          $sqlroomavlbl = "SELECT COUNT(*) as count FROM room WHERE hotel_id = $hotel_id and type = '".$rowtype['type']."' and id NOT IN (SELECT room_id FROM room_reservee WHERE date_dbt < '$checkout' AND date_fin > '$checkin')";
          $resroomavlbl = mysqli_query($conn, $sqlroomavlbl);
          $rowroomavlbl = mysqli_fetch_assoc($resroomavlbl);
          echo "<script>console.log('".$rowroomavlbl['count']."')</script>";
          $roomavlbl = $rowroomavlbl['count'];
            $sqlroom = "select * from room where hotel_id = $hotel_id and type = '".$rowtype['type']."' limit 1";
            $resroom = mysqli_query($conn, $sqlroom);
            $rowroom = mysqli_fetch_array($resroom);
            $sqlimgroom = "SELECT * FROM room_images WHERE room_id = ".$rowroom['id'];
            $resultimgroom = mysqli_query($conn, $sqlimgroom); 
        ?>
                    <div class="col-lg-4 h-100 mb-3">
                    <div class="card">
                    <div id=<?php echo "carousel".$j ?> class="carousel slide">
  <div class="carousel-inner">
  <?php 
  $k =0;
  while($rowimgroom = mysqli_fetch_assoc($resultimgroom)){
    if($k==0){
        $k++;
        echo '<div class="carousel-item active">';
        echo '<img src="images/roompic/'.$rowimgroom['url'].'" class="d-block  w-100" alt="..." height="300px">';
        echo '</div>';
    }else{
        echo '<div class="carousel-item">';
        echo '<img src="images/roompic/'.$rowimgroom['url'].'" class="d-block  w-100" alt="..." height="300px">';
        echo '</div>';
    }
  }
  ?>
  <button class="carousel-control-prev" type="button" data-bs-target=<?php echo "#carousel".$j ?>  data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target=<?php echo "#carousel".$j ?>  data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $rowroom['type'] ?></h5>
                            <p class="m-0 card-text" style="font-size:14px"><i class="fa-solid fa-users text-primary"></i> <?php echo $rowroom['capacity'] . " Persons" ?></p>
                            <p class="m-0 card-text" style="font-size:14px"><i class="fa-solid fa-up-right-and-down-left-from-center text-primary"></i> <?php echo $rowroom['size'] ?>m²</p>
                            <p class="m-0 card-text" style="font-size:14px"><i class="fa-solid fa-bed text-primary"></i> <?php echo $rowroom['bedtype'] ?></p>                          
                            <?php 
                            $sqloption = 'select * from room_option where room_id = '.$rowroom['id'] . ' and hotel_id = '.$hotel_id; 
                            $resultoption = mysqli_query($conn, $sqloption);
                            // // $resultoption = mysqli_query($conn, $sqloption);
                            
                            $x = false;
                            while($rowoption = mysqli_fetch_array($resultoption)){
                                
                              if($rowoption['name'] == 'Free WiFi'){
                                $x = true;
                              }
                            }
                            if($x){
                              echo '<p class="card-text" style="font-size:14px"><i class="fa-solid fa-wifi text-primary"></i> Free wifi</p>';
                            }
                            ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="p-0 m-0 text-primary text-decoration-underline more-dtl" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size:14px; outline: none; border: none;" >
                              More details>
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Room information</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body p-0" style="overflow-x: hidden !important" > 
                                  <?php 
                                  $resultimgroom = mysqli_query($conn, $sqlimgroom);
                                  ?>
                                  <div id=<?php echo "carousele".$j ?> class="carousel slide mb-34">
                                  <div class="carousel-inner">
  <?php 
  $k =0;
  while($rowimgroom = mysqli_fetch_assoc($resultimgroom)){
    if($k==0){
        $k++;
        echo '<div class="carousel-item active">';
        echo '<img src="images/roompic/'.$rowimgroom['url'].'" class="d-block w-100" alt="...">';
        echo '</div>';
    }else{
        echo '<div class="carousel-item">';
        echo '<img src="images/roompic/'.$rowimgroom['url'].'" class="d-block w-100" alt="...">';
        echo '</div>';
    }
  }
  ?>
  <button class="carousel-control-prev" type="button" data-bs-target=<?php echo "#carousele".$j ?>  data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target=<?php echo "#carousele".$j ?>  data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
                                  <?php
                                  // make the $rowoption query again to get the first row
                                  $sqloption = 'select * from room_option where room_id = '.$rowroom['id'] . ' and hotel_id = '.$hotel_id;
                                  $resultoption = mysqli_query($conn, $sqloption);
                                  
                                  ?>
                                  <div class="p-2">
                                  <h5 class=""><?php echo $rowroom['type'] ?></h5>
                                  <p class="m-0 " style="font-size:14px"><i class="fa-solid fa-users text-primary"></i> <?php echo $rowroom['capacity'] . " Persons" ?></p>
                                  <p class="m-0 " style="font-size:14px"><i class="fa-solid fa-up-right-and-down-left-from-center text-primary"></i> <?php echo $rowroom['size'] ?>m²</p>
                                  <p class="m-0 mb-2" style="font-size:14px"><i class="fa-solid fa-bed text-primary"></i> <?php echo $rowroom['bedtype'] ?></p>
                                  <?php
                                  $n=0;
                                  while($rowoption = mysqli_fetch_array($resultoption)){
                                    $n++;                                    
                                    // echo "<p class='m-0 p-0 fw-bold' style='font-size:14px'><i class='fa-solid fa-check text-primary'></i> ".$rowoption['name']."</p>";
                                  }
                                  $resultoption = mysqli_query($conn, $sqloption);
                                  $nn = $n/2;
                                  ?>
                                  <div class="row">
                                  <div class="col">
                                  <?php 
                                  while($rowoption = mysqli_fetch_array($resultoption)){
                                    if($nn<0){
                                      $name = $rowoption['name'];
                                      break;
                                    }else{
                                      
                                      echo "<p class='m-0 p-0 fw-bold' style='font-size:14px'><i class='fa-solid fa-check text-primary'></i> ".$rowoption['name']."</p>";
                                      
                                      $nn--;
                                    }
                                  }
                                  ?>
                                  </div>
                                  <div class="col">
                                    <?php
                                    if(isset($name)){
                                      echo "<p class='m-0 p-0 fw-bold' style='font-size:14px'><i class='fa-solid fa-check text-primary'></i> ". $name    ."</p>";
                                    }else{
                                      echo '';
                                    }
                                  // echo "<p class='m-0 p-0 fw-bold' style='font-size:14px'><i class='fa-solid fa-check text-primary'></i> ". $name    ."</p>";
                                  while($rowoption = mysqli_fetch_array($resultoption)){
                                    echo "<p class='m-0 p-0 fw-bold' style='font-size:14px'><i class='fa-solid fa-check text-primary'></i> ".$rowoption['name']."</p>";
                                  }
                                  ?>
                                  </div>
                                  </div>
                                  <?php 
                                  
                                  // echo "</div>";
                                  
                                  // echo "</div>";
                                  // ?>
                                  </div>
                                  </div>
                                  <div class="modal-footer row align-items-baseline">
                                    <div class="col">
                                      <p class="m-0">
                                      <?php if($roomavlbl==0){ ?>
                                      <i class="fa-solid fa-circle" style="color: red;"></i> <?php echo $roomavlbl ?> rooms left
                                      <?php }else{ ?>
                                      <i class="fa-solid fa-circle" style="color: green;"></i> <?php echo $roomavlbl ?> rooms left
                                      <?php } ?>
                                      </p>
                                    </div>
                                    <div class="col d-flex flex-row gap-2 flex-wrap justify-content-end">
                                      <?php if($roomavlbl==0){ ?>
                                  <button type="submit" d class="btn btn-primary mt-2" disabled>Book now</button>
                                  <?php }else{ ?>
                                  <button type="submit" d class="btn btn-primary mt-2">Book now</button>
                                  <?php } ?>
                                    
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="card-footer" style=" line-height: 1.5 !important;" >
                        <p  class="card-text price text-primary m-0" style=" line-height: 1.5 !important; font-size:24px; font-weight:600" data-original-price="<?php echo $rowroom['price']*$numberOfDays*$rooms + 40*$adults + 20*$children ?>"><?php echo $rowroom['price']*$numberOfDays*$rooms + 40*$adults + 20*$children?>$</p>
                        <p  class="price" style="font-size:14px" data-original-price="<?php echo $rowroom['price'];?>"><?php echo $rowroom['price'];?>$<span style="font-size:16px; color: black; font-weight: 300;">/night</span></p>
                        <form action="reservation.php" method="get">
                            <input type="hidden" name="hotel_id" value="<?php echo $hotel_id ?>">
                            <input type="hidden" name="room_id" value="<?php echo $rowroom['id'] ?>">
                            <input type="hidden" name="destination" value="<?php echo $destination ?>">
                            <input type="hidden" name="checkin" value="<?php echo $checkin ?>">
                            <input type="hidden" name="checkout" value="<?php echo $checkout ?>">
                            <!-- total price and price per night -->
                            <?php 
                            $sqlroomoption = 'select * from room_option where room_id = '.$rowroom['id'] . ' and hotel_id = '.$hotel_id;
                            $resultoption = mysqli_query($conn, $sqloption);
                            $price = 0;
                            while($rowoption = mysqli_fetch_array($resultoption)){
                              $price += $rowoption['price'];
                            }
                            $sqlhoteloption = 'select * from hotel_option where hotel_id = '.$hotel_id;
                            $resulthoteloption = mysqli_query($conn, $sqlhoteloption);
                            while($rowhoteloption = mysqli_fetch_array($resulthoteloption)){
                              $price += $rowhoteloption['price'];
                            }
                            ?>
                            <input type="hidden" name="totalprice" value="<?php echo ($rowroom['price']+$price)*$numberOfDays*$rooms + 40*$adults + 20*$children ?>">
                            <input type="hidden" name="pricepernight" value="<?php echo $rowroom['price']+$price ?>">
                            <input type="hidden" name="numberOfDays" value="<?php echo $numberOfDays ?>">
                            <!-- adults and child hidden input -->
                            <input type="hidden" name="adults" value="<?php echo $adults ?>">
                            <input type="hidden" name="children" value="<?php echo $children ?>">
                            <?php if($roomavlbl==0){ ?>
                              <p class="m-0" style="font-weight:700 font-size:12px" ><i class="fa-solid fa-circle" style="color:red"></i> <?php echo $roomavlbl ?> rooms left</p>
                            <button type="submit" name="submit" class="btn btn-primary w-100 mt-2" disabled>Book now</button>
                            <?php }else{ 
                              if(isset($_SESSION['username'])){
                                $username = $_SESSION['username'];
                                echo "<input type='hidden' name='username' value = '" . $username . "'>"; 
                              }else {
                                $username = null;
                              }
                              ?>
                              <p class="m-0" style="font-weight:700 font-size:12px" ><i class="fa-solid fa-circle" style="color:green"></i> <?php echo $roomavlbl ?> rooms left</p>
                            <button type="submit" name="submit" class="btn btn-primary w-100 mt-2">Book now</button>
                            <?php } ?>
                        </form>
                        </div>
                    </div>
                </div>
                <?php $j++; } ?>
                </div>
                
        </div>
