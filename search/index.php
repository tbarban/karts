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
    <title>Search \ Top Karting</title>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="../"><img src="../assets/img/tklogo.png" height="50"/></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active" style="padding-right: 10px;">
            <a class="nav-link" href="">Search</a>
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
          <h1 class="display-4">Search For Driver</h1>
        </div>
      </div>

      <div class="container">
        <h4>Search</h4>
        <form method="POST">
          <div class="row">
            <div class="col-md-4">
              <input class="form-control form-control-lg" type="text" id="searchContent" name="searchContent" placeholder="Name">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search for Driver</button>
          </div>
        </form>
        <?php

        if($_SERVER["REQUEST_METHOD"] == "POST") {
          echo '<hr><h4>Search Results:</h4>';
          if(trim($_POST["searchContent"]) != "") {
            showSearchResults(trim($_POST["searchContent"]));
          } else {
            echo "<p>No match found.</p>";
          }
        } ?>
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
