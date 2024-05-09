
<?php 

// verify if the session is already start
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  ob_start();
}
include("db.php");
$x=0;
$sql = 'select * from devise';
$rslt = mysqli_query($conn, $sql);

if(isset($_SESSION['username']) &&     ($_SESSION['username'] != '' || $_SESSION['username'] != null)){
  $x=1;
  $sql1 = "SELECT image FROM user WHERE username = '$_SESSION[username]'";
  $rslt1 = mysqli_query($conn, $sql1);
  $row = mysqli_fetch_assoc($rslt1);
  if($row['image'] == ''){
    $img = '<i class="bi bi-person-circle text-primary" style="font-size: 1.5rem;"></i>';
    
  }else{
    $img = '<img src="images/profilepic/' . $row['image'] . '" alt="profile" style="width: 48px; height: 48px; border-radius: 50%;">';
  }
  
}

?>


<head>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
</head>
<style>
  .nav-link{
    font-weight: 600 !important;
    position: relative;
    transition: color 0.3s;
    font-size: 14px !important;
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
.drp button{
  background: white !important;
  border: none !important;
}
.drpm[data-bs-popper] {
    top: 100% !important;
    left: -100% !important;
    margin-top: var(--bs-dropdown-spacer) !important;
}
.dropdown-menu[data-bs-popper]{
  top: 100% !important;
  left: -10% !important;
  margin-top: var(--bs-dropdown-spacer) !important;

}
.drpt::after, .dropdown-toggle::after {

  display: none !important;
  margin-left: 0em;
  vertical-align: 0em;
  content: "";
  border-top: 0em #FF731D solid;
  border-right: 0em #FF731D solid transparent;
  border-bottom: 0;
  border-left: 0em #FF731D solid transparent;
  
}


</style>

<nav class="navbar fixed-top shadow-sm navbar-expand-md navbar-light bg-light">
        <div class="container py-1">
          <a class="navbar-brand" id="brand" href="index.php">
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
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="http://localhost/hotel/#room">
                  Rooms
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="http://localhost/hotel/#contact">
                  Contact
                </a>
              </li>
            </ul>
            
            <div class="d-flex gap-2">
              
            <select style="font-size: 14px;"  name="devise" class="form-select" id="devise">
                <?php 
                while ($row = mysqli_fetch_assoc($rslt)) {
                  if($row['name'] == 'USD'){
                    echo '<option style="font-size: 14px;" value="' . $row['value'] . $row['sign'] . '" selected >' . $row['name'].  '</option>' ;
                  }else{
                    echo '<option style="font-size: 14px;" value="' . $row['value'] . $row['sign']. '" >' . $row['name'].  '</option>' ;
                  }
                  // echo '<option>' . $row['name'].  '</option>' ;
                }
                ?>
                
              </select>
              
              <!-- <button class="btn btn-primary w-100 fw-normal login" type="submit">
                <a href="login.php">
                  Login
                </a>
              </button> -->
              <?php 
              if($x == 1){
                echo '
                <form action="index.php" method="post">
                <div class="dropdown drp">
                <button class="btn btn-secondary drpt dropdown-toggle" style="border-radius: 50%; padding:0 !important; margin:0 !important; border:none !important; background: none !important; " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                '.  $img .'
                </button>
                <ul class="dropdown-menu drpm text-center">
                  <li><a class="dropdown-item drpi" href="client/profile.php"><i class="fa-solid fa-user text-primary"></i> Profile</a></li>
                  <li><button class="dropdown-item" type="submit" name="logout"><i class="fa-solid fa-right-from-bracket text-primary"></i> Logout</button></li>
                </ul>
              </div>
              </form>
              ';
              }else{
              echo' 
              <form class="d-flex" action="login.php" method="post">
              <div class="dropdown" id="seconecter">
                <button style="font-size: 14px;" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> Se connecter
                </button>
              <ul class="dropdown-menu rounded border border-primary">
                <li class=" d-flex justify-content-center align-item-center" style="border-bottom: 1px solid #ff741d"><a class="dropdown-item fw-semibold text-primary" href="login.php">Login</a></li>
                <li class=" d-flex justify-content-center align-item-center"><a class="dropdown-item fw-semibold text-primary" href="signup.php">Sign Up</a></li>
              </ul>
            </div>
              
              </form>';
              }
              ?>
            </div>
           
          </div>
        </div>
      </nav>
