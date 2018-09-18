<?php

include '../functions.php';
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
    <title>Top Times \ Top Karting</title>
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
          <li class="nav-item active" style="padding-right: 10px;">
            <a class="nav-link" href="../top-times/">Top Times</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Top Lap Times</h1>
        </div>
      </div>

      <div class="container">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Daily</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Weekly</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Monthly</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <h4 style="padding-top: 20px;">Top Times of the Day</h4>

            <?php getTopTimes('1'); ?>

          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <h4 style="padding-top: 20px;">Top Times of the Week</h4>

            <?php getTopTimes('7'); ?>
          </div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <h4 style="padding-top: 20px;">Top Times of the Month</h4>

            <?php getTopTimes('30'); ?>
          </div>
        </div>

        <hr>
      </div>
    </main>
    <footer class="container">
      <p>&copy; Top Karting 2018.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>
