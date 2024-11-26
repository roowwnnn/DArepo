<?php 
session_start();

$userpfp = $_SESSION['userpfp'];
?>
  <!-- Navigation Bar -->

  <nav class="shadow navbar navbar-light navbar-expand-lg navBar" id="navBar">
    <div class="container-fluid p-3">
      <div class="navbar-brand"><img src="imgs/yapperlogo_navbar.png"></div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-item nav-link" href="#home"><b>HOME</b></a>
          <a class="nav-item nav-link" href="#about"><b>MESAGES</b></a>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown"
              aria-expanded="false">
              <b>FRIENDS</b>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="friends.php">FRIENDS</a></li>
              <li><a class="dropdown-item" href="pendingfriends.php">PENDING</a></li>
              <li><a class="dropdown-item" href="friendsuggestion.php">ADD FRIENDS</a></li>
            </ul>
          </li>

          <a class="nav-item" href="viewprofile.php"><button class="btn custom-btn viewProfileBtn"><img class="img-fluid" src="imgs/<?php echo $userpfp?>"
                style=" height: 40px; width: 60px;"></button></a>
          <a class="nav-item" href="login.php"><button class="btn custom-btn logoutBtn" style="color: white"><b>Log Out</b></button></a>

        </div>
      </div>
    </div>
  </nav>
