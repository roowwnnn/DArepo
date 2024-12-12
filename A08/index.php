<?php
include("connect.php");

$getFlightLogsQuery = "SELECT flightNumber, departureAirportCode, arrivalAirportCode, departureDatetime, arrivalDatetime, airlineName, pilotName FROM `flightlogs` ";


$getSortFlightNumberOptionsQuery = "SELECT DISTINCT flightNumber FROM `flightlogs` ORDER BY flightNumber ASC;";
$sortFlightNumberOptionsResult = executeQuery($getSortFlightNumberOptionsQuery);

$getSortPilotNameOptionsQuery = "SELECT DISTINCT  pilotName FROM `flightlogs` ORDER BY pilotName ASC;";
$sortPilotNameOptionsResult = executeQuery($getSortPilotNameOptionsQuery);

$getSortAirlineNameOptionsQuery = "SELECT DISTINCT airlineName from `flightLogs` ORDER BY airlineName ASC";
$getSortAirlineNameOptionsResult = executeQuery($getSortAirlineNameOptionsQuery);


if (isset($_GET["sort"])){
    $flightNumberFilter = $_GET['flightNumber'];
  
    $pilotNameFilter = $_GET["pilotName"];
   
    $airlineNameFilter = $_GET["airlineName"];

    if ($flightNumberFilter != "" || $pilotNameFilter != "" || $airlineNameFilter != "") {
        $getFlightLogsQuery = $getFlightLogsQuery. " WHERE";
        if ($flightNumberFilter != ""){
            $getFlightLogsQuery = $getFlightLogsQuery." flightNumber = $flightNumberFilter";
            
        }
        if ($flightNumberFilter !="" && $pilotNameFilter != "") {
            $getFlightLogsQuery = $getFlightLogsQuery. " AND";
        }
        if ($pilotNameFilter != ""){
            $getFlightLogsQuery = $getFlightLogsQuery. " pilotName ='$pilotNameFilter'";
        }
        if ($flightNumberFilter !="" && $pilotNameFilter != "" && $airlineNameFilter != "") {
            $getFlightLogsQuery = $getFlightLogsQuery. " AND";
        }
        if ($airlineNameFilter != ""){
            $getFlightLogsQuery = $getFlightLogsQuery. " airlineName ='$airlineNameFilter'";
        }


    }

    

}




$flightLogsResult = executeQuery($getFlightLogsQuery);

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PUP Air</title>
    <link rel="icon" href="imgs/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="shadow navbar navbar-light navbar-expand-lg navBar" id="navBar">
        <div class="container-fluid p-3">
            <div class="navbar-brand"><img src="imgs/logo.png"></div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <form method="GET">
                        <div class="container d-flex align-items-center justify-content-center">

                            <input class="form-control searchBar" id="searchBar" placeholder="Search"
                                style="border-radius: 20px 0px 0px 20px;">
                            <button type="submit" class="btn custom-btn"
                                style="background-color: #660708; color:white; border-radius: 0px 20px 20px 0px;">SEARCH</svg></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Title and Sort -->
    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-5" style="text-align: left;">
                    <h1>Flight Logs</h1>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="row">

                        <div class="display-5 py-2">Sort By:</div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-4 col-xl-3">
                            <label for="flightNumber">Flight No.</label>
                            <select name="flightNumber" class="form-select">
                                <option selected value="">Flight Number</option>
                                <?php while ($sortFlightNumberOptionsRow = mysqli_fetch_assoc($sortFlightNumberOptionsResult)) { ?>
                                    <option value="<?php echo $sortFlightNumberOptionsRow["flightNumber"] ?>">
                                        <?php echo $sortFlightNumberOptionsRow["flightNumber"] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-4 col-xl-3">
                        <label for="pilotName">Pilot Name</label>
                            <select name="pilotName" class="form-select">
                                <option selected value="">Pilot Name</option>
                                <?php while ($sortPilotNameOptionsRow = mysqli_fetch_assoc($sortPilotNameOptionsResult)) { ?>
                                    <option value="<?php echo $sortPilotNameOptionsRow["pilotName"] ?>">
                                        <?php echo $sortPilotNameOptionsRow["pilotName"] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-4 col-xl-3">
                            <label for="airlineName">Airline Name</label>
                            <select name="airlineName" class="form-select">
                                <option selected value="">Airline Name</option>
                                <?php while ($sortAirlineNameOptionsRow = mysqli_fetch_assoc($getSortAirlineNameOptionsResult)) { ?>
                                    <option value="<?php echo $sortAirlineNameOptionsRow["airlineName"] ?>">
                                        <?php echo $sortAirlineNameOptionsRow["airlineName"] ?></option>
                                <?php } ?>

                            </select>


                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-4 col-xl-3 pt-3">
                            <button class="btn custom-btn" type="submit" name="sort"
                                style="background-color: #660708; color: white;">SORT</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive-sm">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Flight No.</th>
                                <th scope="col">Departure Code</th>
                                <th scope="col">Arrival Code</th>
                                <th scope="col">Departure D/T</th>
                                <th scope="col">Arrival D/T</th>
                                <th scope="col">Airline Name</th>
                                <th scope="col">Pilot Name</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($flightLogsRows = mysqli_fetch_assoc($flightLogsResult)) { ?>

                                <tr>
                                    <td><?php echo $flightLogsRows["flightNumber"] ?></td>
                                    <td><?php echo $flightLogsRows["departureAirportCode"] ?></td>
                                    <td><?php echo $flightLogsRows["arrivalAirportCode"] ?></td>
                                    <td><?php echo $flightLogsRows["departureDatetime"] ?></td>
                                    <td><?php echo $flightLogsRows["arrivalDatetime"] ?></td>
                                    <td><?php echo $flightLogsRows["airlineName"] ?></td>
                                    <td><?php echo $flightLogsRows["pilotName"] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>