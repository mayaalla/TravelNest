

<?php
$sqlhotel = 'select * from hotel where id in (select hotel_id from partnerhotel where partner_id = "'.$rowpartner['id'].'")';
                    $rslthotel = mysqli_query($conn, $sqlhotel);
                    $rowhotel = mysqli_fetch_assoc($rslthotel);

                    $sqlcontry = 'select * from countries where countries_id = "'.$rowhotel['countries_id'].'"';
                    $rsltcontry = mysqli_query($conn, $sqlcontry);
                    $rowcontry = mysqli_fetch_assoc($rsltcontry);

                    $sqlstate = 'select * from states where id_state = "'.$rowhotel['id_state'].'"';
                    $rsltstate = mysqli_query($conn, $sqlstate);
                    $rowstate = mysqli_fetch_assoc($rsltstate);

                    $sqlimage = 'select * from hotel_images where hotel_id = "'.$rowhotel['id'].'"';
                    $rsltimage = mysqli_query($conn, $sqlimage);

                    $sqloption = 'select * from hotel_option where hotel_id = "'.$rowhotel['id'].'"';
                    $rsltoption = mysqli_query($conn, $sqloption);

                    $sqloptionadd = 'select * from option where type in("H", "HR") and name not in (select option_name from hotel_option where hotel_id = "'.$rowhotel['id'].'")';
                    $rsltoptionadd = mysqli_query($conn, $sqloptionadd);
                ?>
                <h3>Modify Your Property Information</h3>
                <form action="property.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="mt-3" for="type">Hotel Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $rowhotel['name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3" for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $rowhotel['adresse']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3" for="city">Country</label>
                            <input type="text" name="country" class="form-control" value="<?php echo $rowcontry['name']; ?>" required disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3" for="city">City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo $rowstate['name']; ?>" required disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3" for="city">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $rowhotel['phone']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3" for="city">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $rowhotel['email']; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="mt-3" for="city">Stars Number</label>
                            <input min="1" max="5" type="number" name="stars" class="form-control" value="<?php echo $rowhotel['nbrstar']; ?>" required>
                        </div>
                        <div class="col-12 d-flex flex-row gap-2">
                            <button type="submit" name="modifyproperty" class="btn btn-primary my-3 text-white fw-bold">Modify Property</button>
                            <button type="submit" name="deleteproperty" class="btn btn-danger my-3 text-white fw-bold">Delete Property</button>
                        </div>
                    </div>
                </form>
                <h3 class="mt-4">Modify Your Property Images</h3>
                <form action="property.php" method="post" enctype="multipart/form-data">
                        <div class="pb-3">
                            <label class="mt-3 fw-bold" for="city">Add Images</label>
                            <div class="input-group m-0">
                            <input multiple type="file" name="file[]" class="form-control m-0" required>
                            <button type="submit" name="addimageproperty" class="btn btn-primary fw-bold text-white">Add Images</button>
                            </div>
                            <small style="font-size: 0.75rem" class="text-primary mb-3">you can add multiple images</small>
                        </div>
                </form>
                <label class="mt-2 fw-bold mb-1">Delete Images</label>
                <form  class="d-flex justify-content-center align-item-center mb-4 pb-2" action="property.php" method="post">
                
                <div style="width:50%; height:400px" class="mb-4">
                <?php include('deleteimage.php');
                ?>
                </div>
                </form>

                <h3 class="mt-4">Modify Your Property Services</h3>
                <form action="property.php" method="post">
                <p class="text-primary p-0 m-0" style="font-size: 0.75rem">Click on the price to modify it</p>
                <table class="w-100 table table-bordered" style="background-color: #58538e !important; border-spacing:8px !important;">
  <thead class="bg-primary">
    <tr>
      <th scope="col">Option Name</th>
      <th  scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead> 
    <tbody>
    <?php while($rowoption = mysqli_fetch_assoc($rsltoption)){ ?>
    <tr>
    <Form action="property.php" method="post">
        <td><?php echo $rowoption['option_name']; ?></td>
        <td><input class="text-center text-white" style=" background-color: transparent; border: none; outline: none; " type="text" name="price" value="<?php echo $rowoption['price']; ?>"></td>
        <td>
            
            <!-- <a href="deleteoption.php?id=<?php echo $rowoption['option_name']; ?>" class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i></a>
            <a href="editoption.php?id=<?php echo $rowoption['option_name']; ?>" class="btn btn-info text-white"><i class="fa-solid fa-edit"></i></a> -->
            <input type="hidden" name="option" value="<?php echo $rowoption['option_name']; ?>">
            <button type="submit" name="modifyoptionprice" class="btn btn-info text-white"><i class="fa-solid fa-edit"></i></button>
            <button type="submit" name="deleteoption" class="btn btn-danger text-white"><i class="fa-solid fa-trash"></i></button>
        </td>
    </Form>
    </tr>
    
    <?php } ?>
    </tbody>
    </table>
            <h5>Add Options</h5>
            <div class="row m-0 justify-content-between">
                
                    <label class="mt-2" for="city">Services</label>
                    <?php 
                    while($rowoptionadd = mysqli_fetch_assoc($rsltoptionadd)){ ?>
                        <div class="form-check col-6 p-0">
                            <input class="form-check-input p-0 mx-1 border border-primary"  type="checkbox" name='option[]' value='<?php echo $rowoptionadd['name'] ?>' >
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $rowoptionadd['name'] ?>
                            </label>
                            <br>
                            <label  class="form-check-label">Price</label>
                            <input id="q3" placeholder="$" style="width:95%" type="text" name='price[]' class="form-control mb-3" >
                        </div>
                    <?php } ?>
                    <button type="submit" name="addoption" class="btn btn-primary mt-3 mx-2 text-white fw-bold">Add Option</button>
            </div>
            
                </form>


                <?php
                if(isset($_POST['deleteproperty'])){
                    $sqldelete = 'delete from hotel where id = "'.$rowhotel['id'].'"';
                    $rsltdelete = mysqli_query($conn, $sqldelete);
                    if($rsltdelete){
                        echo '<script>alert("Property Deleted Successfully")</script>';
                        echo '<script>window.location.href = "property.php"</script>';
                    }
                }
                
