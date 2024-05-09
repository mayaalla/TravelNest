
<?php 

// verify if the session is already start
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  ob_start();
}
include("../db.php");

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

<nav class="navbar shadow-sm navbar-expand-md navbar-light bg-light" id="header">
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
            
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
              <form action="header.php" method="post">
                <button class="btn btn-primary text-white fw-bold" style="font-size: 14px;" name="logout">Logout</button>
                </form>
                </li>
              
            </ul>
            
          </div>
        </div>
      </nav>

      <?php
      if(isset($_POST['logout'])){
        session_destroy();
        header('location: ../index.php');
      }
