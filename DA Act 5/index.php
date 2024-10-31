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

    <!-- Profile Container -->
    <div class="row">
        <div class="col-12 pfpcontainer">
            <img class="img-fluid py-5 px-3 m"src = "imgs/zhonglipfp.png" alt = "userpfp">
        </div>
    </div>
    <!-- Logo Container -->
    <div class="row" >
        <div class="col-12 logocontainer">
            <img class="img-fluid logo" src="imgs/yapperlogo.png" alt="yapperlogo">
        </div>
    </div>
    <!-- Button Container -->

    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-xl-6 my-3 buttoncontainer">
            <a href="friends.php"><button class="btn custom-btn btn-lg friendsButton"  style="background-color: #5E17EB;  color:white;">View Friend List</button></a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-xl-6 my-3 buttoncontainer">
            <a href="pendingfriends.php"><button class="btn custom-btn btn-lg friendsButton" style="background-color: #5E17EB; color:white;">View Pending Friend List</button></a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>