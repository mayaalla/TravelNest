
            <nav class="navbar navbar-expand-lg" style="background-color:white;" >
               <div class="">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbara33" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                   <a class="navbar-brand" style="font-family: 'Noto Sans', sans-serif !important; font-weight:600; font-size: 1.75rem;" href="#">
                   Filtre
                    </a>
                  <div class="collapse navbar-collapse" id="navbara33">

                     <ul class="d-flex flex-column" style="list-style:none; padding:0; margin:0;">
                     <li>
                        <label for="roomtype" style="font-weight: 600;" class="form-label">Price</label>
                        
                        <div class="input-group flex-column mb-3">
                            <span class="input-group-text bg-primary text-white text-center rounded" id="basic-addon1">Min</span>
                            <input style="width: 100%;" type="number" min="0" class="form-control rounded mt-2 mb-2" placeholder="0" aria-label="Username" aria-describedby="basic-addon1" id="min">
                            <span class="input-group-text bg-primary text-white rounded" id="basic-addon2">Max</span>
                            <input style="width: 100%;" type="number" min="1" class="form-control rounded mt-2 mb-2" placeholder="1000" aria-label="Server" aria-describedby="basic-addon2" id="max">
                        </div>
                        
                     </li>
                     
                     
                     <li>
                     <label for="roomtype" style="font-weight: 600; " class="mt-2 mb-0 form-label">Categorie</label>
        <div class="form-check">
            <input class="form-check-input stars " type="checkbox" value="5" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                5 stars
            </label>
        </div>
    </li>
    <li>
        <div class="form-check">
            <input class="form-check-input stars " type="checkbox" value="4" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                4 stars
            </label>
        </div>
    </li>
    <li>
        <div class="form-check">
            <input class="form-check-input stars " type="checkbox" value="3" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                3 stars
            </label>
        </div>
    </li>
    <li>
        <div class="form-check">
            <input class="form-check-input stars " type="checkbox" value="2" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                2 stars
            </label>
        </div>
    </li>
    <li>
        <div class="form-check">
            <input class="form-check-input stars " type="checkbox" value="1" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                1 star
            </label>
        </div>
    </li>
    <?php  
            $sqloption = 'select * from option';
            $resultoption = mysqli_query($conn, $sqloption);
            $k=0;
            while ($row = mysqli_fetch_assoc($resultoption)) {
                if($k==0){
    ?>
    <li>
    <label for="roomtype" style="font-weight: 600; " class="mt-2 mb-0 form-label">Equipment</label>
    <div class="form-check">
        <input class="form-check-input equipment" type="checkbox" value="<?php echo $row['name'] ?>" >
        <label class="form-check-label" for="spa">
            <?php echo $row['name']   ?>
        </label>
    </div>
</li>
<?php $k++; }else{  ?>

<li>
    <div class="form-check">
        <input class="form-check-input equipment" type="checkbox" value="<?php echo $row['name'] ?>">
        <label class="form-check-label" for="piscine">
            <?php echo $row['name']   ?>
        </label>
    </div>
</li>
<?php }} ?>

<li>
    <label for="roomtype" style="font-weight: 600;" class="form-label mt-2 mb-0">Comment rating</label>
</li>
<li>
    <div class="form-check">
        <input class="form-check-input note" type="checkbox" value="9, 10" id="plus-9">
        <label class="form-check-label" for="plus-9">
            +9 Excellent
        </label>
    </div>
</li>
<li>
    <div class="form-check">
        <input class="form-check-input note" type="checkbox" value="9, 8" id="plus-8">
        <label class="form-check-label" for="plus-8">
            +8 Very Good
        </label>
    </div>
</li>
<li>
    <div class="form-check">
        <input class="form-check-input note" type="checkbox" value="8, 7" id="plus-7">
        <label class="form-check-label" for="plus-7">
            +7 Good
        </label>
    </div>
</li>

                        
                     </ul>
                  </div>
               </div>
            </nav>


            <script src="js/trier.js"></script>
