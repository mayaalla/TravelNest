
<?php 
$sqlcountry = 'select * from countries';
$rsltcountry = mysqli_query($conn, $sqlcountry);


?>


<h3>Add Your Property</h3>
                    <form action="property.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- tow check boxes one for "One single hotel" and "Multiples Hotels with the same name" -->
                                <label class="mt-3" for="type">Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="1">One single hotel</option>
                                    <option value="2">Multiples Hotels with the same name</option>
                                </select>

                                
                            </div>
                            <div class="col-md-6">
                                <label class="mt-3" for="name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="mt-3" for="address">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="mt-3" for="city">Iframe Google Map URL</label>
                                <input type="text" name="url" class="form-control" required>
                                <button type="button" style="outline: none; font-size:14px; border:none; text-decoration: underline;" class="text-primary m-0 p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                How to get the URL?
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">How to Get The Iframe URL</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body fw-bold">
                                        1. Go to Google Maps<br>
                                        2. Search for your location<br>
                                        3. Click on the three dots on the left<br>
                                        4. Click on "Share"<br>
                                        5. Click on "Embed a map"<br>
                                        6. Copy the URL inside the iframe<br>
                                        <video class="mt-3" controls style="width: 100%;">
                                        <source src="../video/document_5886251042785465101.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <label class="mt-3" for="city">Country</label>
                                    <select id="country" name="country" class="form-select" required>
                                        <?php while($rowcountry = mysqli_fetch_assoc($rsltcountry)){ ?>
                                            <option value="<?php echo $rowcountry['name'] ?>"><?php echo $rowcountry['name'] ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-md-6" id="city">
                                <label class="mt-3" for="city">City</label>
                                <?php 
                                $sqlstate = 'select * from states where countries_id = 1';
                                $rsltstate = mysqli_query($conn, $sqlstate);
                                ?>
                                <select name="city" class="form-select">
                                    <?php while($rowstate = mysqli_fetch_assoc($rsltstate)){ ?>
                                        <option value="<?php echo $rowstate['name'] ?>"><?php echo $rowstate['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="mt-3" for="city">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="mt-3" for="city">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="mt-3" for="city">Stars Number</label>
                                <input min="1" max="5" type="number" name="stars" class="form-control" required>
                            </div>
                            <!-- add images -->
                            <div class="col-12">
                                <label class="mt-3" for="city">Images</label>
                                <input multiple type="file" name="file[]" class="form-control mb-0" required>
                                <small class="text-primary m-0">you can add multiple images</small>
                            </div>
                            <div class="col-12">
                                <label class="mt-3" for="city">Google Map Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="mt-3" for="city">Services</label>
                                <?php 
                                while($rowoption = mysqli_fetch_assoc($resultoption)){ ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name='option[]' value='<?php echo $rowoption['name'] ?>' >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php echo $rowoption['name'] ?>
                                        </label>
                                        <br>
                                        <label  class="form-check-label">Price</label>
                                        <input id="q3" placeholder="$" type="text" name='price[]' class="form-control w-25" >
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="addproperty" class="btn btn-primary mt-3 w-100 text-white fw-bold">Add Property</button>
                            </div>
                        </div>
                    </form>

                    <?Php 
                    if(isset($_POST['addproperty'])){
                        $type = $_POST['type'];
                        $name = $_POST['name'];
                        $address = $_POST['address'];
                        $city = $_POST['city'];
                        $country = $_POST['country'];
                        $phone = $_POST['phone'];
                        $stars = $_POST['stars'];
                        $email = $_POST['email'];
                        $options = $_POST['option'];
                        $location = $_POST['location'];
                        $url = $_POST['url'];
                        
                        $sqlstates = 'select * from states where name LIKE "%'.$city.'%"';
                        $rsltstates = mysqli_query($conn, $sqlstates);
                        $rowstate = mysqli_fetch_assoc($rsltstates);
                        $state_id = $rowstate['id_state'];
                        
                        $sqlcountry = 'select * from countries where name LIKE "%'.$country.'%"';
                        $rsltcountry = mysqli_query($conn, $sqlcountry);
                        $rowcountry = mysqli_fetch_assoc($rsltcountry);
                        $country_id = $rowcountry['countries_id'];
                    
                        $sqlhotel = 'insert into hotel (name, adresse, phone, countries_id, id_state, email, nbrstar) values ("'.$name.'", "'.$address.'", "'.$phone.'", "'.$country_id.'", "'.$state_id.'", "'.$email.'", "'.$stars.'")';
                        $rslthotel = mysqli_query($conn, $sqlhotel);
                    
                        $sqlgethotel = 'select * from hotel where name = "'.$name.'"';
                        $rsltgethotel = mysqli_query($conn, $sqlgethotel);
                        $rowgethotel = mysqli_fetch_assoc($rsltgethotel);
                        $hotel_id = $rowgethotel['id'];
                        $sqllocation = 'insert int iframe (hotel_id, url) values ("'.$hotel_id.'", "'.$location.'")';

                        $sqlpartnerhotel = 'insert into partnerhotel (partner_id, hotel_id) values ("'.$rowpartner['id'].'", "'.$hotel_id.'")';
                        $rsltpartnerhotel = mysqli_query($conn, $sqlpartnerhotel);
                    
                        $uploadDirectory = '../images/hotelspic/';
                        $filePaths = array();
                    
                        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
                            $file_name = $_FILES['file']['name'][$key];
                            $file_path = $uploadDirectory . $file_name;
                    
                            // Move uploaded file to the server
                            move_uploaded_file($tmp_name, $file_path);
                            $file_path = $file_name;
                    
                            // Store file path in an array
                            $filePaths[] = $file_path;
                        }
                    
                        // Insert file paths into the database
                        foreach ($filePaths as $filePath) {
                            $sqlimage = 'INSERT INTO hotel_images (hotel_id, url) VALUES ("'.$hotel_id.'", "'.$filePath.'")';
                            mysqli_query($conn, $sqlimage);
                        }
                        $prices = $_POST['price'];
                        $prices = array_filter($prices);
                        $prices = array_values($prices);// This will capture all prices as an array
                    
                        foreach ($options as $key => $option) {
                            $price = $prices[$key];
                            $sqlinsert = 'insert into hotel_option (hotel_id, option_name, price) values ("'.$hotel_id.'", "'.$option.'", "'.$price.'")';
                            $rsltinsert = mysqli_query($conn, $sqlinsert);
                        }
                        $sqliframe = 'insert into iframe (hotel_id, url) values ("'.$hotel_id.'", "'.$url.'")';
                        $rsltiframe = mysqli_query($conn, $sqliframe);
                            // }  
                            echo '<script>alert("Property added successfully")</script>';
                            echo '<script>window.location.href = "property.php"</script>';
                    }
?>
                    <script>
                        
                        document.getElementById('country').addEventListener('change', function() {
                            fetch('getstates.php?country_name=' + this.value)
                                .then(response => response.text())
                                .then(data => document.getElementById('city').innerHTML = data);
                        });




                    </script>