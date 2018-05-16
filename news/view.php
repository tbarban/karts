<?php
  include '../functions/func-frontend.php';
  $articleID = $_GET['id'];

  $article = getArticleByID($articleID);
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
    <title>News \ Top Karting Racing League</title>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#"><img src="../assets/img/tklogo.png" height="50"/></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../">Home</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../about/">About</a>
          </li>
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../schedule/">Schedule</a>
          </li>
          <!--<li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../results/">Results</a>
          </li>-->
          <li class="nav-item" style="padding-right: 10px;">
            <a class="nav-link" href="../standings/">Standings</a>
          </li>
          <li class="nav-item active" style="padding-right: 10px;">
            <a class="nav-link" href="./">News</a>
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
          <h1 class="display-4">League News</h1>
        </div>
      </div>

      <div class="container">
        <h3><?php echo $article['title']; ?></h3>
        <h6><i class="far fa-calendar-alt"></i> <?php echo date("F j, Y", strtotime($article['date'])); ?></h6>
        <p style="padding-top: 20px;"><?php echo $article['content']; ?></p>
        <a href="./" class="btn btn-primary btn-sm">< Back</a>


        <hr>
      </div> <!-- /container -->
    </main>


    <footer class="container">
      <p>&copy; Top Karting 2018. Designed and built by tylerbarban.com</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>
