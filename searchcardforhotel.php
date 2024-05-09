<form action="hotel.php" method="get" class="search">
    <input type="hidden" name="hotel_id" value="<?php echo $hotel_id ?>">
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
              <input required style="background-color: #e2e0ff6e;" name="checkin" type="date" class="form-control" id="checkin">
            </div>
            <div class="col-lg-2">
              <label style="font-size:14px !important;" class="fw-bold" for="checkout">
                Check out
              </label>
              <input required style="background-color: #e2e0ff6e;" name="checkout" type="date" class="form-control" id="checkout">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="adults">
                Adults
              </label>
              <input required  style="background-color: #e2e0ff6e;" name="adults" type="number" class="form-control" id="adults">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="children">
                Children
              </label>
              <input required style="background-color: #e2e0ff6e;" name="children" type="number" class="form-control" id="children">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="rooms">
                Rooms
              </label>
              <input required style="background-color: #e2e0ff6e;" name="rooms" type="number" class="form-control" id="rooms">
            </div>
            <div class="col">
              <label style="font-size:14px !important;" class="fw-bold" for="sumbit">
              </label>
              <button style="font-size:14px;" class="btn btn-primary w-100 fw-normal" type="submit" name="search">
                Search
              </button>
            </div>
          </div>
        </div>
        </form>