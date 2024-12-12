<?php
session_start();
  if (!isset($_SESSION ['userName'])){
    header('Location:login.php');
  }

  $userpfp = $_SESSION['userpfp'];
  $userfirstName = $_SESSION['firstName'];
  $userlastName = $_SESSION['lastName'];
  $userName = $_SESSION['userName'];
  $userID = $_SESSION['userID'];

  include('connect.php');

  $getdataquery = "SELECT provinces.provinceName,cities.cityName, users.userName, userinfo.firstName, userinfo.lastName, userinfo.birthDay 
  FROM users LEFT JOIN userinfo ON users.userID = userinfo.userID 
  LEFT JOIN addresses ON userinfo.addressID = addresses.addressID 
  LEFT JOIN cities ON addresses.cityID = cities.cityID 
  LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID 
  WHERE users.userID = $userID;";

$result = executeQuery($getdataquery); 

if (isset($_POST['deleteButton'])){
  
  $softDeleteQuery = "UPDATE `users` SET `isDeleted` = 'yes' WHERE `users`.`userID` = $userID;";
  executeQuery($softDeleteQuery);

  header ("Location: login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yapper</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <!-- Navigation Bar -->
<?php
  session_abort();
  include("navbar.php") 
?>


<?php
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
        ?>
<!-- Profile Container -->
<div class="row p-5" style="text-align: center;">
    <div class="container-fluid profileContainer">
      <div class="row p-3" style="border-radius: 30px 30px 0 0;" >
        <div class="col-12 col-sm-5 col-md-2 col-lg-2 col-xl-2">
          <div class="container profilePicContainer"><img src="imgs/<?php echo $userpfp;?>"></div>
        </div>
        <div class="col-12 col-sm-7 col-md-10 col-lg-10 col-xl-10" >  
            <div class="container nameContainer" style="text-align: left;">
              <p class="name"><?php echo $userfirstName; ?> <?php echo $userlastName?></p>
              <p class="userName">@<?php echo $userName?></p>
            </div>
        </div>

      </div>

      <div class="row mt-5" >
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-5">
          <div class="container" style="text-align: center;">
            <p class="firstName"><b>First Name:</b>  &nbsp;<?php echo $userfirstName?></p>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-5" >  
            <div class="container" style="text-align: center;">
              <p class="lastName"><b>Last Name:</b> &nbsp;<?php echo $userlastName?></p>
            </div>
        </div>
      </div>

      <div class="row" >
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-5">
          <div class="container" style="text-align: center;">
            <p class="birthDay"><b>Birthday:</b>  &nbsp;<?php echo $user['birthDay']?></p>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-5" >  
            <div class="container" style="text-align: center;">
              <p class="addRess"><b>Address:</b> &nbsp;  <?php echo $user['cityName']?>,
              <?php echo $user['provinceName']?></p>
            </div>
            <?php
             }
          }
        ?>
        </div>
      </div>
      <form method="post">
      <div class="row my-5" >
        <div class="container deleteBtnContainer">
          <button type="submit" class="btn custom-btn btn-lg deleteButton" name="deleteButton"><b>DELETE ACCOUNT</b></button>
        </div>
      </div>
      </form>


    </div>
  </div>



  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>