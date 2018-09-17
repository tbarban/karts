<?php
include 'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getDriversList() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` ORDER BY id DESC";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  $count = 0;

  echo '<table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th scope="col">Position</th>
        <th scope="col">Name</th>
        <th scope="col">Driver ID</th>
        <th scope="col">Races Completed</th>
        <th scope="col">Points Scored</th>
        <th scope="col">Driver Info</th>
      </tr>
    </thead>
    <tbody>';

    foreach ($result as $driver) {
      $count++;
      echo '<tr>';
      echo '<th scope="row">' . $count . '</th>';
      echo '<td>' . $driver['name'] . '</td>';
      echo '<td>' . $driver['cust_id'] . '</td>';
      echo '<td>' . $driver['races_completed'] . '</td>';
      echo '<td>' . $driver['points_scored'] . '</td>';
      echo '<td><a href="view.php?id='.$driver['id'].'" class="btn btn-outline-success btn-sm">Driver Details</a></td>';

      echo '</tr>';
    }

    echo '</tbody></table>';

    mysqli_close($link);
}

function getDriverDetails($driverID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sqlQuery = "SELECT * FROM drivers WHERE id='$driverID'";
  $result = mysqli_query($link, $sqlQuery);
  $row = mysqli_fetch_assoc($result);

  return $row;
}

function addNewRace($date) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sqlQuery = "INSERT INTO races (date) VALUES ('$date')";

  if(!mysqli_query($link, $sqlQuery)) {
    echo mysqli_error($link);
    return false;
  } else {
    return true;
  }

  mysqli_close($link);
}

function addNewDriver($driverName, $emailAddress, $customerID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sqlQuery = "INSERT INTO drivers (name, email, cust_id) VALUES ('$driverName', '$emailAddress', '$customerID')";

  if(!mysqli_query($link, $sqlQuery)) {
    echo mysqli_error($link);
    return false;
  } else {
    return true;
  }

  mysqli_close($link);
}

function updateDriver($driverID, $driverName, $emailAddress, $customerID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sqlQuery = "UPDATE drivers SET name='$driverName', email='$emailAddress', cust_id='$customerID' WHERE id='$driverID'";

  if(!mysqli_query($link, $sqlQuery)) {
    echo mysqli_error($link);
    return false;
  } else {
    return true;
  }

  mysqli_close($link);
}

function ordinal_suffix($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

function getDriverData($driverID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` WHERE id='$driverID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  $heatURL = 'https://kartlaps.info/v2/tkquebec/racer/'.$row['cust_id'].'.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;

  mysqli_close($link);
}

function getDriverByID($drivID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` WHERE id='$drivID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  return $row['name'];

  mysqli_close($link);
}


function getWinner($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  $winner = $row['pos1'];

  return getDriverByID($winner);

  mysqli_close($link);
}

function getSessionInfo($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id=$raceID";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  mysqli_close($link);
  return $row;
}

function getSchedule() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` ORDER BY date ASC";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  echo '<table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th scope="col">Race #</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Winner</th>
        <th scope="col">Laps Run</th>
      </tr>
    </thead>
    <tbody>';
    $raceCount = 0;
    foreach ($result as $race) {
      $raceCount++;
      echo '<tr>';
      echo '<th scope="row">' . $raceCount . '</th>';
      echo '<td>' . date("M jS, Y", strtotime($race['date'])) . '</td>';
      echo '<td>6:30 PM</td>';
      if($race['race_completed']) {
        echo '<td>' . getWinner($race['id']) . '</td>';
        echo '<td>' . $race['laps_completed'] . '</td>';
      } else {
        echo '<td><em>TBD</em></td>';
        echo '<td><em>TBD</em></td>';
      }
      echo '</tr>';
    }

    echo '</tbody></table>';

    mysqli_close($link);
}

function getResultsList() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` ORDER BY date ASC";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  echo '<table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th scope="col">Race #</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Winner</th>
        <th scope="col">Laps Run</th>
        <th scope="col">Result</th>
      </tr>
    </thead>
    <tbody>';
    $raceCount = 0;
    foreach ($result as $race) {
      $raceCount++;
      echo '<tr>';
      echo '<th scope="row">' . $raceCount . '</th>';
      echo '<td>' . date("M jS, Y", strtotime($race['date'])) . '</td>';
      echo '<td>6:30 PM</td>';
      if($race['race_completed']) {
        echo '<td>' . getWinner($race['id']) . '</td>';
        echo '<td>' . $race['laps_completed'] . '</td>';
      } else {
        echo '<td><em>TBD</em></td>';
        echo '<td><em>TBD</em></td>';
      }
      echo '<td><a href="../results/view.php?id=' . $race['id'] . '" class="btn btn-outline-primary btn-sm '.isRaceViewable($race['id']).'">View</a> <a href="../results/add.php?id=' . $race['id'] . '" class="btn btn-outline-success btn-sm '.isRaceAdded($race['id']).'">Add</a></td>';
      echo '</tr>';
    }

    echo '</tbody></table>';

    mysqli_close($link);
}

function isRaceViewable($raceID) {
  if(isRaceCompleted($raceID)) {
    return "";
  } else {
    return "disabled";
  }
}

function isRaceAdded($raceID) {
  if(isRaceCompleted($raceID)) {
    return "disabled";
  } else {
    return "";
  }
}

function getRaceData($raceID) {
  $heatURL = 'https://kartlaps.info/v2/tkquebec/heat/' . $raceID . '.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;

}

function getLapCount($raceData, $driverID) {
  $laps = $raceData['heat']['laps'];

  $lapCount = 0;

  foreach ($laps as $participant) {
    if($participant['racerId'] == $driverID) {
      $lapCount = sizeOf($participant['racerLaps']);
    }
  }

  return $lapCount;
}

function getGapToLeader($raceData, $lapCount) {
  $leaderLaps = 0;

  for ($i=0; $i < sizeOf($raceData['heat']['laps']); $i++) {
    if($leaderLaps < sizeOf($raceData['heat']['laps'][$i]['racerLaps'])) {
      $leaderLaps = sizeOf($raceData['heat']['laps'][$i]['racerLaps']);
    }
  }
  return $leaderLaps - $lapCount;
}

function isFasted($data, $lap) {
  $fastestLap = 10000;

for ($i=0; $i < sizeOf($data['heat']['laps']); $i++) {
  foreach ($data['heat']['laps'][$i]['racerLaps'] as $lapData) {
      if ($fastestLap > $lapData['seconds']) {
        $fastestLap = $lapData['seconds'];
    }
  }
}

  if($fastestLap == $lap) {
    return true;
  } else {
    return false;
  }

}

function getFastestLap($raceData, $driverID) {
  $fastestLap = 10000;

  foreach ($raceData['heat']['laps'] as $lapsRun) {
    if($driverID == $lapsRun['racerId']) {
      foreach ($lapsRun['racerLaps'] as $lapData) {
        if ($fastestLap > $lapData['seconds']) {
          $fastestLap = $lapData['seconds'];
        }
      }
    }
  }
  return $fastestLap;
}

function getFastestLapSingle($data) {
  $fastestLap = 10000;

for ($i=0; $i < sizeOf($data['heat']['laps']); $i++) {
  foreach ($data['heat']['laps'][$i]['racerLaps'] as $lap) {
      if ($fastestLap > $lap['seconds']) {
        $fastestLap = $lap['seconds'];
    }
  }
}

  return $fastestLap;
}

function getHeatResults($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  $race = getRaceData($row['heat_id']);

  echo '<table class="table table-striped table-sm">
    <thead class="thead-light">
      <tr>
        <th scope="col">Position</th>
        <th scope="col">Driver</th>
        <th scope="col">Gap</th>
        <th scope="col">Laps Run</th>
        <th scope="col">Fastest Lap</th>
      </tr>
    </thead><tbody>';

    $count = 0;
    $pointTotal = 10;

    foreach($race['heat']['participants'] as $driver) {
      $count++;

      $lapCount = getLapCount($race, $driver['id']);
      echo '<tr>';
      echo '<th scope="row">'.$count.'</th>';
      echo '<td><!--<a href="../../driver/?id='.$driver['id'].'">-->' . $driver['racerName'] . '<!--</a>--></td>';
      echo '<td>'.getGapToLeader($race, $lapCount).'L</td>';
      echo '<td>'.$lapCount.'</td>';
      echo '<td>';
      if(isFasted($race, getFastestLap($race, $driver['id']))) {
        echo '<b>';
      }
      echo getFastestLap($race, $driver['id']);
      if(isFasted($race, getFastestLap($race, $driver['id']))) {
        echo '</b>';
      }
      echo '</td>';
      echo '</tr>';
      if($pointTotal > 0) {
        $pointTotal--;
      }
    }

    echo '</tbody></table>';
}

function getHeatID($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  return $row['heat_id'];
}

function getQualID($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  return $row['qual_id'];
}

function getLapsCompleted($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  return $row['laps_completed'];
}

function getDriversInRace($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  $drivers = array();

  for ($i=1; $i < 21; $i++) {
    $return = 'pos' . $i;
    if($row[$return] != 0) {
      $drivers[] = $row[$return];
    }
  }

  return $drivers;
}

function isRaceCompleted($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  if($row['race_completed']) {
    return true;
  } else {
    return false;
  }
}

function getDrivers() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` ORDER BY ranking ASC";
  $result = mysqli_query($link, $sql);
  mysqli_close($link);

  return $result;
}

function getDriverSelectList() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` ORDER BY id ASC";
  $result = mysqli_query($link, $sql);
  mysqli_close($link);

  echo '<option selected="selected" value="0">Choose Driver</option>';

  foreach ($result as $driver) {
    echo '<option value="'.$driver['id'].'">'.$driver['name'].'</option>';
  }
}

function getDriverName($id) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` WHERE id='$id'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  return $row['name'];
}

function getDriverPoints($id) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` WHERE id='$id'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  return $row['points_scored'];
}

function getPointsBreakdown($raceID) {
  $pointSpread = array(18, 15, 12, 8, 6, 4, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  $driversList = getDrivers();
  $driversRun = array();

  for ($i=1; $i < 21; $i++) {
    $temp = 'pos' . $i;
    if($row[$temp] != 0) {
      $driversRun[] = $row[$temp];
    }
  }

  echo '<table class="table table-striped">
    <thead class="thead-light">
      <tr>
        <th scope="col">Position</th>
        <th scope="col">Driver</th>
        <th scope="col">Points Scored</th>
        <th scope="col">Points Total</th>
      </tr>
    </thead>
    <tbody>';
    $count = 0;
    foreach($driversRun as $racer) {
      $count++;
      echo '<tr>';
      echo '<th scope="row">'. $count .'</th>';
      echo '<td>'. getDriverName($racer) .'</td>';
      echo '<td>'. $pointSpread[$count-1] .'</td>';
      echo '<td>'. getDriverPoints($racer) .'</td>';
      echo '</tr>';
    }

    echo '</tbody></table>';
}

function addResultsNoOrder($raceID, $lapsRun, $heatID, $qualID) {
  if($lapsRun == 0) {
    return false;
  }
  if($heatID == 0) {
    return false;
  }
  if($qualID == 0) {
    return false;
  }

  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "UPDATE races SET race_completed=1, heat_id=$heatID, qual_id=$qualID, laps_completed=$lapsRun WHERE id=$raceID";
  $result = mysqli_query($link, $sql);

  if(!mysqli_query($link, $sql)) {
    echo mysqli_error($link);
    return false;
  } else {
    return true;
  }
}

function addResults($raceID, $lapsRun, $heatID, $qualID, $driverOrder) {
  if($lapsRun == 0) {
    return false;
  }
  if($heatID == 0) {
    return false;
  }
  if($qualID == 0) {
    return false;
  }
  if(sizeOf($driverOrder) == 0) {
    return false;
  }

  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "UPDATE races SET race_completed=1, heat_id=$heatID, qual_id=$qualID, laps_completed=$lapsRun";

  if(sizeOf($driverOrder) != 0) {
    for ($i=1; $i < 21; $i++) {
      $temp = $i-1;
      if(isset($driverOrder[$temp])) {
        $sql = $sql . ", pos" . $i . "=$driverOrder[$temp]";
      }
    }
  } else {

  }

  $sql = $sql . " WHERE id=$raceID";
  $result = mysqli_query($link, $sql);

  if(!mysqli_query($link, $sql)) {
    echo mysqli_error($link);
    return false;
  } else {
    updatePointTotal($driverOrder);
    return true;
  }
}

function updateResults($raceID, $lapsRun, $heatID, $qualID, $driverOrder) {
  if($lapsRun == 0) {
    return false;
  }
  if($heatID == 0) {
    return false;
  }
  if($qualID == 0) {
    return false;
  }
  if(sizeOf($driverOrder) == 0) {
    return false;
  }

  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "UPDATE races SET race_completed=1, heat_id=$heatID, qual_id=$qualID, laps_completed=$lapsRun";

  if(sizeOf($driverOrder) != 0) {
    for ($i=1; $i < 21; $i++) {
      $temp = $i-1;
      if(isset($driverOrder[$temp])) {
        $sql = $sql . ", pos" . $i . "=$driverOrder[$temp]";
      }
    }
  } else {

  }

  $sql = $sql . " WHERE id=$raceID";
  $result = mysqli_query($link, $sql);

  if(!mysqli_query($link, $sql)) {
    echo mysqli_error($link);
    return false;
  } else {
    updatePointTotal($driverOrder);
    return true;
  }
}

function updatePointTotal($driverList) {
  $pointSpread = array(18, 15, 12, 8, 6, 4, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  $count = 0;
  foreach($driverList as $racer) {
    $sql = "SELECT * FROM drivers WHERE id=$racer";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $racesCompleted = $row['races_completed']+1;
    $pointsScored = $row['points_scored']+$pointSpread[$count];

    $sql = "UPDATE drivers SET races_completed ='$racesCompleted', points_scored='$pointsScored' WHERE id='$racer'";
    $result = mysqli_query($link, $sql);

    $count++;
  }
  mysqli_close($link);
}


?>
