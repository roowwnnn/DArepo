<?php
session_start();
session_destroy();
session_start();
include("connect.php");



if (isset($_POST['loginButton'])){
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $query = "SELECT * from users JOIN userinfo ON users.userID = userinfo.userID WHERE userName ='$userName' and password ='$password';";
    $result = executeQuery($query);

    if (mysqli_num_rows($result) > 0){
        while ($user = mysqli_fetch_assoc($result)){
            $_SESSION['firstName'] = $user['firstName'];
            $_SESSION['lastName'] = $user['lastName'];
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['userpfp'] = $user['userpfp'];

            header ("Location: index.php");
        }
    }
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
    <!-- Login Page -->
    <div class="row">
        <!-- Logo Container -->
        <div class="container logoContainer">
            <img class="img-fluid logo" src="imgs/yapperlogo.png" alt="yapperlogo">
        </div>
        
    </div>

    <div class="row">
        <div class="container formContainer">
            <form method="post">
                <div class="row">
                    <div class="col-12 p-3">
                        <input class="shadow textInput" type="text" name="userName" placeholder ="Username" required>
                    </div>
                    <div class="col-12 p-3">
                        <input class="shadow textInput" type="password" name="password" placeholder ="Password" required>
                    </div>
                    <div class="col-12 p-3">
                        <button type="submit" class="btn custom-btn btn-lg loginButton" name="loginButton"><b>Login</b></button>
                        <div class="container signUpContainer">
                            <a class="signUp" href="signup.php"><p><b>Sign Up</b></p></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
            
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>