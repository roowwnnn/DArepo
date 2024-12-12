<?php
include ("connect.php");

if (isset($_POST['signUpbutton'])){
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $userName = $_POST['userName'];
  $password = $_POST['password'];
  $birthDay = $_POST['birthDay'];

  $insertUserQuery = "INSERT INTO `users`(`userName`, `userpfp`, `password`) VALUES ('$userName','nopfp.png','$password');";
  executeQuery($insertUserQuery);
  $incrementuserIDQuery ="SELECT IFNULL(MAX(userID), 0) + 1 AS newuserID FROM userInfo;";
  $result = executeQuery($incrementuserIDQuery);
  
  $newuserID = '';
  if (mysqli_num_rows($result) > 0){
    while($userid = mysqli_fetch_assoc($result)){
      $newuserID = $userid['newuserID'];
    }
  }
  
  $insertUserInfoQuery ="INSERT INTO `userInfo`(`userID`, `addressID`, `firstName`, `lastName`, `birthDay`) VALUES ('$newuserID',null,'$firstName','$lastName',' $birthDay');";
  executeQuery($insertUserInfoQuery);
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yapper</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="imgs/yapperlogo.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
  <!-- NavBar -->
  <nav class="navbar navbar-light navbar-expand-lg navBarContainer">
    <div class="container-fluid p-3">
      <img class="img-fluid navBarLogo p-3" src="imgs/yapperlogohome.png">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <div class="container">
            <a href="login.php"><button class="btn custom-btn backButton"
                style="background-color: #5E17EB; color:white; width: 130px; height: 55px;"><b>Back</b></button>
          </div></a>
        </div>
      </div>

    </div>
  </nav>

  <div class="row py-5">
    <div class="col-12 px-5">
      <p class="signUpText">Sign Up</p>
    </div>
  </div>
  <!-- Sign Up Form -->
  <form method='post'>
    <div class="row">
      <div class="col-12 col-sm-12 col-md-4 col-xl-4">
        <div class="row p-3">
          <input class="shadow signUpInput" type="text" name="firstName" placeholder="First Name" style="height: 60px;"
            required>
        </div>
        <div class="row p-3">
          <input class="shadow signUpInput" type="text" name="lastName" placeholder="Last Name" style="height: 60px;"
            required>
        </div>
        <div class="row p-3">
          <input class="shadow signUpInput" type="text" name="userName" placeholder="User Name" style="height: 60px;"
            required>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-4 col-xl-4">
        <div class="row p-3">
          <input class="shadow signUpInput" type="text" name="password" placeholder="Password" style="height: 60px;"
            required>
        </div>
        <div class="row p-3">
          <input class="shadow signUpInput" type="text" name="birthDay" placeholder="Birthday(yyyy-mm-dd)"
            style="height: 60px;" required>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-4 col-xl-4">
        <div class="row p-3">
          <input class="shadow signUpInput" type="text" name="province" placeholder="Province" style="height: 60px;"
           >
        </div>
        <div class="row p-3">
          <input class="shadow signUpInput" type="text" name="city" placeholder="City" style="height: 60px;">
        </div>

      </div>
    </div>
    <div class="row">
      <div class="container-fluid" style="text-align: center;">
        <button type="submit" class="btn custom-btn signUpButton" name="signUpbutton"
          style="background-color: #5E17EB; color: white; height: 90px; width: 280px; border-radius: 20px"><b>Sign
            Up</b></button>
      </div>
    </div>
  </form>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>