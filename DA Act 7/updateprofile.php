<?php
session_start();
$userID = $_SESSION['userID'];

include('connect.php');

$getdataquery = "SELECT provinces.provinceName,cities.cityName, users.userName, users.password, userinfo.firstName, userinfo.lastName, userinfo.birthDay 
FROM users LEFT JOIN userinfo ON users.userID = userinfo.userID 
LEFT JOIN addresses ON userinfo.addressID = addresses.addressID 
LEFT JOIN cities ON addresses.cityID = cities.cityID 
LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID 
WHERE users.userID = $userID;";

$result = executeQuery($getdataquery); 


if (isset($_POST['updateButton'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $birthDay = $_POST['birthDay'];
  
    $updateQuery = "UPDATE users
    JOIN userinfo ON users.userID = userinfo.userID
    SET 
        users.password = '$password',
        users.userName = '$userName',
        userinfo.firstName = '$firstName',
        userinfo.lastName = '$lastName',
        userinfo.birthDay = '$birthDay'
    WHERE users.userID = $userID;
";
    executeQuery($updateQuery);
  
    header ("Location: viewprofile.php");
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
   <!-- Navigation Bar -->
<?php
  session_abort();
  include("navbar.php") 
?>


<?php
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
        ?>


<div class="row py-5">
    <div class="col-12 px-5">
      <p class="signUpText">Edit Profile</p>
    </div>
  </div>

  <!-- Edit Form -->
  <form method='post'>
    <div class="row p-5 m-5" style="background-color: #5E17EB; border-radius: 30px; color:white">
      <div class="col-12 col-sm-12 col-md-6 col-xl-6">
        <div class="row p-3">
          <label for="firstName"><b>FIRST NAME:</b></label>
          <input value="<?php echo $user['firstName']?>" class="shadow signUpInput mt-2" type="text" name="firstName" placeholder="First Name" style="height: 60px;"
           >
        </div>
        <div class="row p-3">
          <label for="lastName"><b>LAST NAME:</b></label>
          <input value="<?php echo $user['lastName'] ?>"class="shadow signUpInput mt-2" type="text" name="lastName" placeholder="Last Name" style="height: 60px;"
           >
        </div>
        <div class="row p-3">
          <label for="userName"><b>USER NAME:</b></label>
          <input value="<?php echo $user['userName'] ?>"class="shadow signUpInput" type="text" name="userName" placeholder="User Name" style="height: 60px;"
           >
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-6 col-xl-6">
        <div class="row p-3">
          <label for="userName"><b>NEW PASSWORD:</b></label>
          <input value="<?php echo $user['password'] ?>"class="shadow signUpInput mt-2" type="text" name="password" placeholder="Password" style="height: 60px;"
           >
        </div>
        <div class="row p-3">
          <label for="userName"><b>BIRTHDAY:</b></label>
          <input value="<?php echo $user['birthDay'] ?>"class="shadow signUpInput mt-2" type="text" name="birthDay" placeholder="Birthday(yyyy-mm-dd)"
            style="height: 60px;">
        </div>

        <?php
             }
          }
        ?>
      </div>

    </div>
    <div class="row">
      <div class="container-fluid" style="text-align: center;">
        <button type="submit" class="btn custom-btn signUpButton" name="updateButton"
          style="background-color: #5E17EB; color: white; height: 90px; width: 280px; border-radius: 20px"><b>UPDATE</b></button>
      </div>
    </div>
  </form>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>