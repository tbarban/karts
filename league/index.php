<?php include 'functions/func-frontend.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<<<<<<< HEAD
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/karting.css" rel="stylesheet">
=======
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/karting.css" rel="stylesheet">
>>>>>>> 72e25647a35dbd563d1557b12ac2a96c593ad9ad
    <title>Home \ Top Karting Racing League</title>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
<<<<<<< HEAD
      <a class="navbar-brand" href="#"><img src="assets/img/tklogo.png" height="50"/></a>
=======
      <a class="navbar-brand" href="#"><img src="../assets/img/tklogo.png" height="50"/></a>
>>>>>>> 72e25647a35dbd563d1557b12ac2a96c593ad9ad
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active" style="padding-right: 10px;">
            <a class="nav-link" href="">Home</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="about/">About</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="schedule/">Schedule</a>
          </li>
          <!--<li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="results/">Results</a>
          </li>-->
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="standings/">Standings</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="news/">News</a>
          </li>
        </ul>
        <span class="navbar-text">
          <b>Next Race:</b> Tuesday, June 5th
        </span>
      </div>
    </nav>

    <main role="main">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4" style="text-align: center;">Top Karting Racing League <br><span>Summer 2018</span></br></h1>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="news-home">
              <h2>League News</h2>
              <hr>
              <?php getBriefNews(); ?>
            </div>
          </div>
          <div class="col-md-6">
            <h2>League Standings</h2>
            <hr>
            <?php getBriefStandings(); ?>
            <p><a class="btn btn-secondary" href="standings/" role="button">Full Standings &raquo;</a></p>

            <h2>Upcoming Races</h2>
            <hr>
            <?php getBriefSchedule(); ?>
            <p><a class="btn btn-secondary" href="schedule/" role="button">Full Schedule &raquo;</a></p>
          </div>

        </div>

        <hr>

      </div> <!-- /container -->

    </main>

    <footer class="container">
      <p>&copy; Top Karting 2018. Designed and built by tylerbarban.com</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<<<<<<< HEAD
    <script src="assets/js/bootstrap.min.js"></script>
=======
    <script src="../assets/js/bootstrap.min.js"></script>
>>>>>>> 72e25647a35dbd563d1557b12ac2a96c593ad9ad
  </body>
</html>
