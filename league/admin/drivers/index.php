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

$driverAdded = false;

$racerName = $emailAddress = $customerID = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $racerName    = trim($_POST["racerName"]);
    $emailAddress = trim($_POST["emailaddress"]);
    $customerID   = trim($_POST["customerID"]);
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
    <title>Drivers \ Top Karting Racing League</title>
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
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../results/">Results</a>
          </li>
          <li class="nav-item active" style="padding-right: 10px;">
            <a class="nav-link" href="">Drivers</a>
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
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
          $userAdded = addNewDriver($racerName, $emailAddress, $customerID);

          if($userAdded) {
            echo "<div class=\"alert alert-success alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Driver added successfully.</div>";
          } else {
            echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Unable to add driver.</div>";
          }
        } else {
          //Do nothing
        }
          ?>
        <a href="add.php" class="btn btn-outline-primary">Add New Driver</a>

        <h4 style="margin-top: 20px;">Current Drivers</h4>
        <?php getDriversList(); ?>
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
