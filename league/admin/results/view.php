<?php
require_once '../../functions/func-admin.php';
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$raceID = $_GET['id'];

$driverOrder = array();
$lapsRun = $heatID = $qualID = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $lapsRun = trim($_POST["lapsRun"]);
  $heatID = trim($_POST["heatID"]);
  $qualID = trim($_POST["qualID"]);


  for ($pos=1; $pos < 21; $pos++) {
    $temp = "pos".$pos;
    if(trim($_POST[$temp]) != 0) {
      $driverOrder[] = trim($_POST[$temp]);
    }
  }
  $resultAdded = false;
  if($_GET['action'] == "add") {
    $resultAdded = addResults($raceID, $lapsRun, $heatID, $qualID, $driverOrder);
  } elseif($_GET['action'] == "edit") {
    if(isset($_POST["updateOrder"])) {
      $resultAdded = updateResults($raceID, $lapsRun, $heatID, $qualID, $driverOrder);
    } else {
      $resultAdded = addResultsNoOrder($raceID, $lapsRun, $heatID, $qualID);
    }
  }
}

?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../../assets/css/karting.css" rel="stylesheet">
    <title>Results \ Top Karting Racing League</title>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#"><img src="../../assets/img/tklogo.png" height="50"/></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../">Dashboard</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../schedule/">Schedule</a>
          </li>
          <li class="nav-item active" style="padding-right: 10px;">
            <a class="nav-link" href="./">Results</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../drivers/">Drivers</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              My Account
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" style="padding-top: 40px;">
      <div class="container">
        <a href="edit.php?id=<?php echo $raceID; ?>" class="btn btn-outline-primary">Edit Results</a>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")  {
          if($_GET['action'] == "add") {
            if($resultAdded) {
              echo '<div class="alert alert-success alert-dismissible" style="margin-top: 10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Result added successfully.</div>';
            } else {
              echo '<div class="alert alert-danger alert-dismissible" style="margin-top: 10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Unable to add result.</div>';
            }
          }
        }

        ?>
        <div class="row" style="margin-top: 20px;">
          <div class="col-md-7">
            <h4>Driver Results</h4>
            <hr>
            <div class="row" style="padding-bottom: 10px;">
              <div class="col-md-3">
                <h6><b>Laps Run:</b> <?php echo getLapsCompleted($raceID); ?></h6>
              </div>
              <div class="col-md-3">
                <h6><b>Drivers:</b> <?php echo sizeOf(getDriversInRace($raceID)); ?></h6>
              </div>
              <div class="col-md-3">
                <h6><b>Heat ID:</b> <?php echo getHeatID($raceID); ?></h6>
              </div>
              <div class="col-md-3">
                <h6><b>Qual ID:</b> <?php echo getQualID($raceID); ?></h6>
              </div>
            </div>

            <?php getPointsBreakdown($raceID); ?>
          </div>
          <div class="col-md-5">
            <h4>Heat Results</h4>
            <hr>
            <?php getHeatResults($raceID); ?>
          </div>
        </div>
        <hr>
      </div> <!-- /container -->
    </main>


    <footer class="container">
      <p>&copy; Top Karting 2018. Designed and built by tylerbarban.com</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
  </body>
</html>
