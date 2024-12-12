<?php
include('connect.php');

$getdataquery = "SELECT 
CASE WHEN friends.requesterID = 1 THEN userinfo2.firstName ELSE userinfo1.firstName END AS friendFirstName, 
CASE WHEN friends.requesterID = 1 THEN userinfo2.lastName ELSE userinfo1.lastName END AS friendLastName, 
CASE WHEN friends.requesterID = 1 THEN user2.userName ELSE user1.userName END AS userName,
CASE WHEN friends.requesterID = 1 THEN user2.userpfp ELSE user1.userpfp END AS userPfp
FROM friends 
JOIN userinfo userinfo1 ON friends.requesterID = userinfo1.userID 
JOIN userinfo userinfo2 ON friends.requesteeID = userinfo2.userID 
JOIN users user1 ON friends.requesterID = user1.userID 
JOIN users user2 ON friends.requesteeID = user2.userID 

WHERE (friends.requesterID = 1 OR friends.requesteeID = 1) AND friends.status = 'pending';";
$result = executeQuery($getdataquery);


$getfriendCountQuery ="SELECT COUNT(*) AS friendCount
FROM (
    SELECT CASE 
        WHEN friends.requesterID = 1 THEN user2.userID 
        ELSE user1.userID 
    END AS userID
    FROM friends 
    JOIN users user1 ON friends.requesterID = user1.userID 
    JOIN users user2 ON friends.requesteeID = user2.userID 
    WHERE (friends.requesterID = 1 OR friends.requesteeID = 1) 
      AND friends.status = 'pending'
) AS subquery;";
$result2 = executeQuery($getfriendCountQuery);
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

    <!-- Profile Container -->
    <div class="row">
        <div class="col-6 logohomecontainer">
            <img class="img-fluid py-4 px-3 logohome" src="imgs/yapperlogohome.png" alt="yapperlogo">
        </div>
        <div class="col-6 pfpcontainer">
            <a href="index.php"><img class="img-fluid py-5 px-3 pfp" src="imgs/zhonglipfp.png" alt="userpfp"></a>
        </div>
    </div>

    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
        while ($count = mysqli_fetch_assoc($result2)) {
        ?>
        <div class="col-12 textFriendList px-5">
            <h2 class="friendList">Pending Friend List (<?php echo $count['friendCount']?>)</h2>
        </div>
        <?php
            }
        }
        ?>

    </div>

    <!-- Friend List Container -->

    <div class="container-fluid mainContainer mt-3">
        <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
        while ($friend = mysqli_fetch_assoc($result)) {
            ?>
        <div class="col-12">
                <div class="shadow container my-3 friendListContainer">
                    <div class="row">
                        <div class="col-4 col-sm-4 col-xl-2 pfpListContainer p-4" >
                            <img class="img-fluid " src="imgs/<?php echo $friend['userPfp']?>">
                        </div>
                        <div class="col-8 col-sm-8 col-xl-10 textListContainer p-2" >
                            <h4><?php echo $friend['friendFirstName']?> <?php echo $friend['friendLastName']?></h4>
                            <p><?php echo $friend['userName']?></p>
                        </div>

                    </div>
                </div>
        </div>
        
        
        <?php
            }
        }
        ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>