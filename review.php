<div class="container">
<div class="row gap-3">
    <div class="col-md-4 ">
        <div class="row">
            <div class="col-auto" style="padding-right: 0 !important">
                <P class="fw-bold" style="font-size: 3rem; line-height: 2.30rem !important;">
                <?php echo $rownote['average_note']; ?>
                </P>
            </div>
            <div class="col pl-2 ">
                <p class="m-0 fw-bold" style="font-size : 0.75rem">
                <?Php 
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
                </p>
                <p class="m-0 text-primary fw-bold" style="font-size : .75rem">
                    <?php echo $row['nbrcomment'] ?> reviews
                </p>
            </div>
        </div>
        <div id="note">
            <?php 
            $sqlcomment = 'select * from comment where hotel_id = '.$row['id'].'';
            $resultcomment = $conn->query($sqlcomment);
            $dix = 0; $huit = 0; $six=0; $quatre=0; $deux=0; $total=0;
            while($rowcomment = $resultcomment->fetch_assoc()){
                $total ++;
                if($rowcomment['note'] >= 9){
                    $dix++;
                }elseif($rowcomment['note'] >= 8 && $rowcomment['note'] < 9){
                    $huit++;
                }elseif($rowcomment['note'] >= 6 && $rowcomment['note'] < 8){
                    $six++;
                }elseif($rowcomment['note'] >= 4 && $rowcomment['note'] < 6){
                    $quatre++;
                }elseif($rowcomment['note'] >= 1 && $rowcomment['note'] < 4){
                    $deux++;
                }
            }
            // 6 -> 100%      
            ?>
            <p class="m-0 fw-bold" style="font-size: .75rem" >
                <?php if($row['nbrcomment'] != 0){ $width= ($dix*100)/$row['nbrcomment'];  }else{$width =0;}?>
                <span>10 - Excellent</span> <span class="float-end"><?php echo $dix ?></span>
            </p>
            <div class="rounded my-2 moy border border-info" style= <?php echo "' height: 6px; background: linear-gradient(to right, #0c045a " . $width . "%, transparent 0%); width:100% '"  ?> ></div>
            <p class="m-0 fw-bold" style="font-size: .75rem" >
                <?php if($row['nbrcomment'] != 0){ $width= ($huit*100)/$row['nbrcomment']; }else{$width =0;} ?>
                <span>8 - Very Good</span> <span class="float-end"><?php echo $huit ?></span>
            </p>
            <div class="rounded border border-info my-2 moy" style= <?php echo "'height: 6px; background: linear-gradient(to right, #0c045a " . $width . "%, transparent 0%); width:100% '"  ?> ></div>
            <p class="m-0 fw-bold" style="font-size: .75rem" >
                <?php if($row['nbrcomment'] != 0){ $width= ($six*100)/$row['nbrcomment'];  }else{$width =0;}?>
                <span>6 - Good</span> <span class="float-end"><?php echo $six ?></span>
            </p>
            <div class="rounded border border-info my-2 moy" style= <?php echo "'height: 6px; background: linear-gradient(to right, #0c045a " . $width . "%, transparent 0%); width:100% '"  ?> ></div>
            <p class="m-0 fw-bold" style="font-size: .75rem" >
                <?php if($row['nbrcomment'] != 0){ $width= ($quatre*100)/$row['nbrcomment']; }else{$width =0;} ?>
                <span>4 - Fair</span> <span class="float-end"><?php echo $quatre ?></span>
            </p>
            <div class="rounded border border-info my-2 moy" style= <?php echo "'height: 6px; background: linear-gradient(to right, #0c045a " . $width . "%, transparent 0%); width:100% '"  ?> ></div>
            <p class="m-0 fw-bold" style="font-size: .75rem" >
                <?php if($row['nbrcomment'] != 0){ $width= ($deux*100)/$row['nbrcomment']; }else{$width =0;} ?>
                <span>2 - Poor</span> <span class="float-end"><?php echo $deux ?></span>
            </p>
            <div class="rounded border border-info my-2 moy" style= <?php echo "'height: 6px; background: linear-gradient(to right, #0c045a " . $width . "%, transparent 0%); width:100% '"  ?> ></div>
            
        </div>
    </div>
    <div class="col">
        <p class="fw-bold">Recent reviews</p>

    <?php 
    $sqlcomment = 'select * from comment where hotel_id = '.$row['id'].'
    order by date_comment desc';
    $resultcomment = $conn->query($sqlcomment);
    $k=0;
    while($rowcomment = $resultcomment->fetch_assoc()){
        $k++;
        if($k == 4){
            break;
        }
        $sqluser = 'select * from user where id = '.$rowcomment['user_id'].'';
        $resultuser = $conn->query($sqluser);
        $rowuser = $resultuser->fetch_assoc();
    ?>
        <div class="rounded mb-3 p-2" style="border: #0c045a 1px solid !important">
            <p class="fw-bold m-0" style="font-size: 14px" ><?php echo $rowcomment['note'] ?>/10
            <?php
            if($rowcomment['note'] >= 7 && $rowcomment['note'] < 8){
                echo "Good";
            }elseif($rowcomment['note'] >= 8 && $rowcomment['note'] < 9){
                echo "Very Good";
            }elseif($rowcomment['note'] >= 9){
                echo "Excellent";
            }else{
                echo "";
            }
            ?>
            </p>
            <p class="" style="font-size: 14px"><?php echo $rowcomment['comment_text'] ?></p>
            <p class="mb-1 fw-bold" style="font-size: 14px">
            <spna>
                <?php 
                if($rowuser['image'] != ""){
                    echo '<img src="images/profilepic/'.$rowuser['image'].'" alt="" style="width: 20px; height: 20px; border-radius: 50%">';
                }else{
                    echo '<i class="text-primary fa-solid fa-user"></i>';
                }
                ?>
            </spna>
            <?php echo $rowuser['name'] ?>
            </p>
            <p class="m-0" style="font-size: 12px"><?php echo $rowcomment['date_comment'] ?></p>
        </div>
<?php } 
$resultcomment = $conn->query($sqlcomment);
?>
<!-- Button trigger modal -->
<button type="button" class="text-primary p-0 text-decoration-underline" style="font-size:.75rem; outline: none; border:none; background:none;" data-bs-toggle="modal" data-bs-target="#cmnt">
  See all the <?php echo $row['nbrcomment'] ?> reviews >
</button>

<!-- Modal -->
<div class="modal fade" id="cmnt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hotel Reviews</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
        while($rowcomment = $resultcomment->fetch_assoc()){
            $sqluser = 'select * from user where id = '.$rowcomment['user_id'].'';
            $resultuser = $conn->query($sqluser);
            $rowuser = $resultuser->fetch_assoc();
            ?>
        <div class="rounded mb-3 p-2" style="border: #1605b0 1px solid !important">
            <p class="fw-bold m-0" style="font-size: 14px" ><?php echo $rowcomment['note'] ?>/10
            <?php
            if($rowcomment['note'] >= 7 && $rowcomment['note'] < 8){
                echo "Good";
            }elseif($rowcomment['note'] >= 8 && $rowcomment['note'] < 9){
                echo "Very Good";
            }elseif($rowcomment['note'] >= 9){
                echo "Excellent";
            }else{
                echo "";
            }
            ?>
            </p>
            <p class="" style="font-size: 14px"><?php echo $rowcomment['comment_text'] ?></p>
            <p class="mb-1 fw-bold" style="font-size: 14px">
            <spna>
                <?php 
                if($rowuser['image'] != ""){
                    echo '<img src="images/profilepic/'.$rowuser['image'].'" alt="" style="width: 20px; height: 20px; border-radius: 50%">';
                }else{
                    echo '<i class="text-primary fa-solid fa-user"></i>';
                } 
                $sqlres = 'select * from reservation where user_id in (select id from user where username = "'.$rowuser['username'].'") and hotel_id = '.$row['id'].'';
                $resultres = $conn->query($sqlres);
                $rowres = $resultres->fetch_assoc();
                // calculer le nombre des jours entre la date de reservation et la date fin de reservation
                if(isset($rowres['date_debut']) && isset($rowres['date_fin'])){
                    $date1 = new DateTime($rowres['date_debut']);
                    $date2 = new DateTime($rowres['date_fin']);
                    $diff = $date1->diff($date2);
                    $days = $diff->days;
                }
                ?>
            </spna>
            <?php echo $rowuser['name'] ?>
            </p>

            <p class="m-0" style="font-size: 12px"><?php echo $rowcomment['date_comment'] ?> 
            <?php
            if(isset($days)){


                ?>
                <span>Stayed for <?php echo $days ?> nights</span>
                <?php
            }
             ?>
        </p>
        </div>
<?php } 
$resultcomment = $conn->query($sqlcomment);
        ?>
      </div>
    </div>
  </div>
</div>
<div class="py-3">
    <?php
    if(isset($_SESSION['username'])){ 
        $sqlres = 'select * from reservation where user_id in (select id from user where username = "'.$_SESSION['username'].'") and hotel_id = '.$row['id'].'';
        $resultres = $conn->query($sqlres);
        $r=0;
        while($rowres = $resultres->fetch_assoc()){
            $r++;
        }
        if($r == 0){ 
            
        }else{ 
            ?>
            <form action="comment.php" method="post">
                <p class="fw-bold mb-2">Leave a review</p>
                <input type="hidden" name="hotel_id" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
                <div class="form-group ">
                    <label class="fw-bold" style="font-size: 14px;" for="comment">Your Comment</label>
                    <textarea placeholder="Write your experience here" class="form-control" name="comment" id="comment" rows="3"></textarea>
                    <input type="hidden" name="destination" value="<?php echo $destination ?>">
                    <input type="hidden" name="checkin" value="<?php echo $checkin ?>">
                    <input type="hidden" name="checkout" value="<?php echo $checkout ?>">
                    <input type="hidden" name="adults" value="<?php echo $adults ?>">
                    <input type="hidden" name="children" value="<?php echo $children ?>">
                    <input type="hidden" name="room" value="<?php echo $rooms ?>">
                    <!-- <button type="submit" name="submit" class="btn btn-primary mt-2">Comment</button> -->
                    <label class="fw-bold mt-2 " style="font-size: 14px;" for="note">Note</label>
                    <div class="mt-1 align-items-center p-0 d-flex flex-wrap justify-content-between flex-row ">
                    <div class="form-group">
                    <select class="form-select w-auto" name="note" id="note">
                        <option value="10">10 - Excellent</option>
                        <option value="9">9 - Very Good</option>
                        <option value="8">8 - Good</option>
                        <option value="7">7 - Fair</option>
                        <option value="6">6 - Poor</option>
                        <option value="5">5 - Very Poor</option>
                        <option value="4">4 - Very Poor</option>
                        <option value="3">3 - Very Poor</option>
                        <option value="2">2 - Very Poor</option>
                        <option value="1">1 - Very Poor</option>
                    </select>
                </div>
                    <button type="submit" name="submit" class="btn btn-primary">Comment</button>
                    </div>
                </div>
            </form>
        <?php
        }
        ?>
    <?php
    }
    ?>
</div>
</div>
</div>
</div>
