

<head>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
</head>
<style>
  .nav-link{
    font-weight: 600 !important;
    position: relative;
    transition: color 0.3s;
    font-size: 14px;
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
.dropdown-toggle::after {
display: none !important;
margin-left: 0em;
vertical-align: 0em;
content: "";
border-top: 0em #FF731D solid;
border-right: 0em #FF731D solid transparent;
border-bottom: 0;
border-left: 0em #FF731D solid transparent;
}
.dropdown-menu[data-bs-popper] {
    top: 100% !important;
    left: -100% !important;
    margin-top: var(--bs-dropdown-spacer) !important;
}
</style>

<nav class="navbar fixed-top shadow-sm navbar-expand-md navbar-light bg-light">
  <div class="container py-1">
    <a class="navbar-brand" href="../index.php">
    Travel<span class="text-primary">Nest</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
    </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="http://localhost/hotel/#home">
          Rooms
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/hotel/#room">
          Support
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/hotel/#contact">
          Contact
          </a>
        </li>
      </ul>
      <a href="../property/index.php" class='p-2 m-2 text-white bg-primary rounded fw-bold' style="text-decoration: none; font-size:14px; cursor: pointer; " >List Your Property</a>
      <div>
      
        <!-- <button  style="border-radius: 50%; padding:0 !important; margin:0 !important;" class="profilepic btn fw-normal">
          <?php 
              $sql = "select image from user where username = '$_SESSION[username]'";
              $res = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($res);
              $img = $row['image'];
              // check if the image != null
              if ($img != '') {
                  
                  echo "<img src='../images/profilepic/".$img."' class='rounded-circle' style='width: 48px; height: 48px;'>";
              }
              else{
                  echo "<i  class='fa-solid fa-user text-dark'></i>";
              }
              ?>
             
          </button> -->
      <form action="../index.php" method="post" class="m-0 p-0">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" style="border-radius: 50%; padding:0 !important; margin:0 !important; border:none !important; background: none !important; " type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php 
              $sql = "select image from user where username = '$_SESSION[username]'";
              $res = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($res);
              $img = $row['image'];
              // check if the image != null
              if ($img != '') {
                  echo "<img src='../images/profilepic/".$img."' class='rounded-circle' style='width: 48px; height: 48px;'>";
              }
              else{
                  echo "
                  
                  <i  class='fa-solid fa-circle-user text-primary' style='font-size: 2.25rem !important;'></i>
                  ";
              }
              ?>
          </button>
          
          <button type="submit" name="logout" class="dropdown-menu text-center border"  style="border: none; outline:none; font-weight:600" ><i class="fa-solid fa-arrow-right-from-bracket text-primary"></i> Logout</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</nav>