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

$driver = getDriverDetails($_GET['id']);

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
            <a class="nav-link" href="./">Drivers</a>
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
        <form action="view.php?id=<?php echo $_GET['id'];?>" method="post">
          <div class="row">
            <div class="col-md-4">
              <h3 style="padding-top: 0px;">Driver Information</h3>
              <div class="form-group">
                <label for="racerName">Driver Name</label>
                <input name="racerName" type="text" class="form-control" id="racerName" placeholder="<?php echo $driver['name']; ?>" value="<?php echo $driver['name']; ?>">
              </div>
              <div class="form-group">
                <label for="emailaddress">Email address</label>
                <input name="emailaddress" type="email" class="form-control" id="emailaddress" placeholder="<?php echo $driver['email']; ?>" value="<?php echo $driver['email']; ?>">
              </div>
              <div class="form-group">
                <label for="customerID">Customer ID</label>
                <input name="customerID" type="text" class="form-control" id="customerID" placeholder="<?php echo $driver['cust_id']; ?>" value="<?php echo $driver['cust_id']; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
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
