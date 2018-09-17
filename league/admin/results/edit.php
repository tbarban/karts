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

$race = getSessionInfo($raceID);

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
        <form action="./view.php?id=<?php echo $raceID;?>&action=edit" method="post">
          <div class="row">
            <div class="col-md-6">
              <h3 style="padding-top: 0px;">Driver Results</h3>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="updateOrder" name="updateOrder">
                <label class="form-check-label" for="updateOrder">Update Driver Order</label>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos1">Position 1</label>
                    <select class="form-control" id="pos1" name="pos1">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos2">Position 2</label>
                    <select class="form-control" id="pos2" name="pos2">
                    <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos3">Position 3</label>
                    <select class="form-control" id="pos3" name="pos3">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos4">Position 4</label>
                    <select class="form-control" id="pos4" name="pos4">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos5">Position 5</label>
                    <select class="form-control" id="pos5" name="pos5">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos6">Position 6</label>
                    <select class="form-control" id="pos6" name="pos6">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos7">Position 7</label>
                    <select class="form-control" id="pos7" name="pos7">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos8">Position 8</label>
                    <select class="form-control" id="pos8" name="pos8">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos9">Position 9</label>
                    <select class="form-control" id="pos9" name="pos9">
                    <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos10">Position 10</label>
                    <select class="form-control" id="pos10" name="pos10">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos11">Position 11</label>
                    <select class="form-control" id="pos11" name="pos11">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos12">Position 12</label>
                    <select class="form-control" id="pos12" name="pos12">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos13">Position 13</label>
                    <select class="form-control" id="pos13" name="pos13">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos14">Position 14</label>
                    <select class="form-control" id="pos14" name="pos14">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos15">Position 15</label>
                    <select class="form-control" id="pos15" name="pos15">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos16">Position 16</label>
                    <select class="form-control" id="pos16" name="pos16">
                    <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos17">Position 17</label>
                    <select class="form-control" id="pos17" name="pos17">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos18">Position 18</label>
                    <select class="form-control" id="pos18" name="pos18">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos19">Position 19</label>
                    <select class="form-control" id="pos19" name="pos19">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pos20">Position 20</label>
                    <select class="form-control" id="pos20" name="pos20">
                      <?php getDriverSelectList(); ?>
                    </select>
                  </div>
                </div>
              </div>

          </div>
          <div class="col-md-6">
            <h3 style="padding-top: 0px;">Race Information</h3>

            <div class="form-group">
              <label for="lapsRun">Laps Run</label>
              <input name="lapsRun" value="<?php echo $race['laps_completed'];?>" type="text" class="form-control" id="lapsRun" placeholder="Laps Run">
            </div>
            <div class="form-group">
              <label for="heatID">Feature Heat ID</label>
              <input name="heatID" value="<?php echo $race['heat_id'];?>" type="text" class="form-control" id="heatID" placeholder="Heat ID">
            </div>
            <div class="form-group">
              <label for="qualID">Qualification Heat ID</label>
              <input name="qualID" value="<?php echo $race['qual_id'];?>" type="text" class="form-control" id="qualID" placeholder="Qualification ID">
            </div>
            <button class="btn btn-primary btn-md" type="submit">Save Race Info</button>
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
