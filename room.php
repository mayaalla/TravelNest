<?php
include ("db.php");
if(isset($_POST['search'])){
    $destination = $_POST['destination'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $rooms = $_POST['rooms'];
    $sqlhotel = 'select * from hotel where id_state in (select id_state from states where name like "%'.$destination.'%") OR countries_id in (select countries_id from countries where name like "%'.$destination.'%")';
    // where countries_id like in ( select countries_id from countries where name like "%'.$destination.'%") OR id_state in (select id_state from states where name like "%'.$destination.'%")';
    $result = mysqli_query($conn, $sqlhotel);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <title>Hotely</title>
</head>
<style>
    
 h1, h2, h3, h4, p, .btn, label, input, select, option,a{
     font-family: 'Noto Sans', sans-serif !important;
}
main{
    /* background-color: #2B32B2; */
    padding: 120px 0 45px 0;
}

 a{
     text-decoration: none;
     color: white;
}
 #signup{
     color: #FF731D !important;
}
 #signup:hover{
     color: white !important;
}
 .form-select{
     border: #FF731D 1px solid !important ;
     color: #FF731D;
}
 .check-avblt{
     background-color: white !important;
     border-radius: 10px;
}
 .btn{
     color: white !important;
}
.nav-link{
    font-weight: 600 !important;
    position: relative;
    transition: color 0.3s;
}
.nav-link::before{
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background-color: #FF731D;
    transition: width 0.3s;
}
.nav-link:hover::before{
    width: 100%;
}
.nav-link:hover{
    color: #FF731D !important;
}
.navbar-brand {
  font-family: "Orbitron", sans-serif !important;
  font-optical-sizing: auto;
  font-weight: 600;
  font-style: normal;
  font-size: 1.75rem;
}

</style>
<body id="body" style="background-color: #f5f5f3;"  >
   <header>
      <?php include ('header.php'); ?>
   </header>
   <main class="bg-info">
      <div class="container">
         <?php include ('searchcard.php'); ?>
      </div>
   </main>
   <section class="mb-5" >
      <div class="container">
      <div class="row">
         <div class="col mt-3">
            <h1 class="text-center pb-2 pt-2 mb-4 mt-3" style="border-bottom: #FF731D 1px solid">Rooms</h1>
         </div>
      </div>
      <div class="row gap-2">
      <div class="col rounded border" style="background-color: white;">
        <?php include ('filtre.php'); ?>
      </div>
         <div class="col-lg-9" style="background-color: #f5f5f3;">
            <?php include('trier.php')   ?>
          
<?php
if(isset($_GET['search'])){
    $destination = $_GET['destination'];
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
    $adults = $_GET['adults'];
    $children = $_GET['children'];
    $rooms = $_GET['rooms'];
    echo "<script>
    let destination = document.getElementById('destination');
    destination.value = '".$destination."';
    let checkin = document.getElementById('checkin');
    checkin.value = '".$checkin."';
    let checkout = document.getElementById('checkout');
    checkout.value = '".$checkout."';
    let adults = document.getElementById('adults');
    adults.value = '".$adults."';
    let children = document.getElementById('children');
    children.value = '".$children."';
    let rooms = document.getElementById('rooms');
    rooms.value = '".$rooms."';
    </script>";
    // withouth repeat
    // order by average note
        $sqlhotel = 'select * from hotel where id_state in (select id_state from states where name like "%'.$destination.'%") OR countries_id in (select countries_id from countries where name like "%'.$destination.'%")';
    
    // $sqlhotel = "SELECT hotel.*, hotel_average_notes.average_note FROM hotel JOIN hotel_average_notes ON hotel.id = hotel_average_notes.hotel_id WHERE id_state IN (SELECT id_state FROM states WHERE name LIKE '%".$destination."%') OR countries_id IN (SELECT countries_id FROM countries WHERE name LIKE '%".$destination."%') ORDER BY hotel_average_notes.average_note DESC";
    
?>

<?php
$result = mysqli_query($conn, $sqlhotel);
$sqldroprice = 'DELETE FROM total_price;';
$resultdroprice = mysqli_query($conn, $sqldroprice);
$i =0;
?> 

<div class="row p-0" id="bigcard" style="background-color: #f5f5f3;">
<?php 

while($row = mysqli_fetch_assoc($result)){ 
    $sqlimage = 'select url from hotel_images where hotel_id = '.$row['id'];
    $sqloption ='select option_name from hotel_option where hotel_id = '. $row['id'];
    $resultoption = mysqli_query($conn, $sqloption);
    $pool = false;
    while($rowoption = mysqli_fetch_assoc($resultoption)){
        if($rowoption['option_name'] == 'Pool'){
            $pool = true;
        }
        echo "<script>console.log('".$rowoption['option_name']."')</script>";
    }
    $resultimage = mysqli_query($conn, $sqlimage);
    $imgarray = [];
    while($rowimage = mysqli_fetch_assoc($resultimage)){
        array_push( $imgarray, $rowimage['url'] );
    }
    ?>

<?Php include('hotelscard.php') ?>
<?php }}?>
</div>

        </div>
      </div>
      </div>
   </section>
   <?php include ('footer.php'); ?>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script>
    let devise = document.getElementById('devise');
        console.log(devise);
      let price = document.getElementsByClassName('price');
      console.log(price);
      let priceNight = document.getElementsByClassName('price-night');
     
      devise.addEventListener('change', function(){
        console.log(devise.value);
        let value = parseFloat(devise.value.match(/[\d]*[.]{0,1}[\d]+/)[0]);
        let sign = devise.value.replace(/[^^\D.]/g, "");
        sign = sign.replace(/\./g, "");
        console.log(sign);
        console.log(value);
        for(let i=0; i<price.length; i++){
            price[i].innerHTML = (price[i].getAttribute('data-original-price') * value).toFixed(0) + sign;
            priceNight[i].innerHTML = (priceNight[i].getAttribute('data-original-price') * value).toFixed(0) + sign + '/night';
        }
      });

    let equipment = document.querySelectorAll('.equipment');
    let stars = document.querySelectorAll('.stars');
    let note = document.querySelectorAll('.note');
    let formcheckinput = document.querySelectorAll('.form-check-input');
    

    let eauipmetchecklist = [];
    let starschecklist = [];
    let notechecklist = [];
    let equipmentslist="";
    let starslist = "";
    let notelist = "";
   let max = 10000000000000;
   let min = 0;
   m = document.getElementById('max');
    n = document.getElementById('min');







</script>
<script>



document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('sortByNote').addEventListener('click', function(e) {
        e.preventDefault();
        
        fetchSortedHotels();
    });
    document.getElementById('sortByStarslh').addEventListener('click', function(e){
        e.preventDefault();
      
        fetchSortedHotelsStarslh();
    })
    document.getElementById('sortByStarshl').addEventListener('click', function(e){
        e.preventDefault();
        
        fetchSortedHotelsStarshl();
    })
    document.getElementById('sortByPricelh').addEventListener('click', function(e){
        e.preventDefault();
        
        fetchSortedHotelsPricelh();
    })
    document.getElementById('sortByPricehl').addEventListener('click', function(e){
        e.preventDefault();
        
        fetchSortedHotelsPricehl();
    })
    formcheckinput.forEach(function(input){
        input.addEventListener('change', function(e){
           //check if is a stars or eauipment or note make each elemt in his array and string and if is uncheked remove it from the array and the string
            if(e.target.classList.contains('equipment')){
                if(e.target.checked){
                    value = e.target.value;
                    value = "'"+value+"'";
                    eauipmetchecklist.push(value);
                    equipmentslist = eauipmetchecklist.join(',');
                    console.log(equipmentslist);
                }else{
                    eauipmetchecklist = eauipmetchecklist.filter(function(item){
                        value = e.target.value;
                        value = "'"+value+"'";
                        return item !== value;
                    });
                    equipmentslist = eauipmetchecklist.join(',');
                    console.log(equipmentslist);
                }
            }
            if(e.target.classList.contains('stars')){
                if(e.target.checked){
                    value = e.target.value;
                    
                    starschecklist.push(value);
                    starslist = starschecklist.join(',');
                    console.log(starslist);
                }else{
                    starschecklist = starschecklist.filter(function(item){
                        return item !== e.target.value;
                    });
                    starslist = starschecklist.join(',');
                    console.log(starslist);
                }
            }
            if(e.target.classList.contains('note')){
                if(e.target.checked){
                    value = e.target.value;
                    
                    notechecklist.push(value);
                    notelist = notechecklist.join(',');
                    console.log(notelist);
                }else{
                    notechecklist = notechecklist.filter(function(item){
                        return item !== e.target.value;
                    });
                    notelist = notechecklist.join(',');
                    console.log(notelist);
                }
            }
            filtre(equipmentslist, starslist, notelist, max, min)
            

            
        });
    });
    m.addEventListener('keyup', function(e){
        max = m.value;
        filtre(equipmentslist, starslist, notelist, max, min)
    });
    n.addEventListener('keyup', function(e){
        min = n.value;
        filtre(equipmentslist, starslist, notelist, max, min)
    });
    



});

function fetchSortedHotels() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchSortedHotels.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsStarslh() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchstarslh.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsStarshl() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchstarshl.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsPricelh() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchpricelh.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
function fetchSortedHotelsPricehl() {
    // Example: Extract values from form inputs or define them here
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchpricehl.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

function filtre(equipmentslist, starslist, notelist, max, min){
    let destination = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;
    let adults = document.getElementById('adults').value;
    let children = document.getElementById('children').value;
    let rooms = document.getElementById('rooms').value;
    let url = `fetchfiltre.php?destination=${encodeURIComponent(destination)}&checkin=${encodeURIComponent(checkin)}&checkout=${encodeURIComponent(checkout)}&adults=${encodeURIComponent(adults)}&children=${encodeURIComponent(children)}&rooms=${encodeURIComponent(rooms)}&equipmentlist=${encodeURIComponent(equipmentslist)}&starslist=${encodeURIComponent(starslist)}&notelist=${encodeURIComponent(notelist)}&max=${encodeURIComponent(max)}&min=${encodeURIComponent(min)}`
    fetch(url)
    .then(response => response.text())
    .then(data => {
        document.querySelector('#bigcard').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

</script>
</body>
</html>