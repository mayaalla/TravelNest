<?php 

// current day
$today = date("Y-m-d");
// current day + 7
$nextweek = date('Y-m-d', strtotime($today. ' + 7 days'));

?>



<form action="room.php" method="get" class="search">
        <div class="container py-3 px-4 d-flex flex-column check-avblt" style="box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.35) !important; backdrop-filter: blur(6px) !important;">
          <h3>
            Check availability
          </h3>
          <div class="row gap-2">
            <div class="col-lg-2">
              <label style="font-size:14px !important;" class="fw-bold" for="destination">
                Destination
              </label>
              <input required style="background-color: #e2e0ff6e;" name="destination" type="text" class="form-control" placeholder=""
              id="destination">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="checkin">
                Check in
              </label>
              <input required style="background-color: #e2e0ff6e;" name="checkin" type="date" class="form-control" id="checkin" value="<?php echo $today; ?>">
            </div>
            <div class="col-lg-2">
              <label style="font-size:14px !important;" class="fw-bold" for="checkout">
                Check out
              </label>
              <input required style="background-color: #e2e0ff6e;" name="checkout" type="date" class="form-control" id="checkout" value="<?php echo $nextweek; ?>">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="adults">
                Adults
              </label>
              <input required min="1" max="10"  style="background-color: #e2e0ff6e;" name="adults" type="number" class="form-control" id="adults" value="2">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="children">
                Children
              </label>
              <input required min="0" max="10"  style="background-color: #e2e0ff6e;" name="children" type="number" class="form-control" id="children" value="0">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="rooms">
                Rooms
              </label>
              <input required min="1" max="10"  style="background-color: #e2e0ff6e;" name="rooms" type="number" class="form-control" id="rooms" value="1">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="sumbit">
              </label>
              <button style="font-size:14px !important;" class="btn btn-primary w-100 fw-normal" type="submit" name="search">
                Search
              </button>
            </div>
          </div>
        </div>
        </form>
        <script>
document.addEventListener("DOMContentLoaded", function() {
    const destinationInput = document.getElementById("destination");

    destinationInput.addEventListener("input", function() {
        const inputVal = this.value;
        if (inputVal.length > 2) {
            fetch(`fetch_location.php?query=${encodeURIComponent(inputVal)}`)
                .then(response => response.json())
                .then(data => {
                    // Display suggestions based on the data
                    // For now, let's just log it to see what we get
                    console.log(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    });
});
</script>