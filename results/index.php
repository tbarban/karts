<?php

include '../functions.php';
$raceID = $_GET['id'];

$race = getRaceData($raceID);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/karting.css" rel="stylesheet">
    <title>Results \ Top Karting</title>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="../"><img src="../assets/img/tklogo.png" height="50"/></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../search/">Search</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../leaderboard/">Leaderboard</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../top-times/">Top Times</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Session Results</h1>
        </div>
      </div>

      <div class="container">
        <h3><?php echo getRaceTitle($race); ?></h3>
        <h6><?php echo getRaceTime($race); ?></h6>
        <h6><b>Win by: </b><?php echo getRaceWinMethod($race); ?></h6>
        <hr>

        <h4>Race Results</h4>
        <?php getHeatResults($race); ?>
        <hr>
        <h4>Driver Laps</h4>
        <?php getLaps($race); ?>
        <hr>
      </div>
    </main>


    <footer class="container">
      <p>&copy; Top Karting 2018. Designed and built by tylerbarban.com</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>
