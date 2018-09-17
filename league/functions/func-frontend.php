<?php
include 'config.php';


function getRaceData($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  $heatURL = 'https://kartlaps.info/v2/tkquebec/heat/' . $row['heat_id'] . '.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;

}

function getRaceDataByHeat($raceID) {
  $heatURL = 'https://kartlaps.info/v2/tkquebec/heat/' . $raceID . '.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;

}

function getArticleByID ($articleID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `news` WHERE id='$articleID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  return $row;
}

function getQualifyData($raceID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE id='$raceID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($link);

  $heatURL = 'https://kartlaps.info/v2/tkquebec/heat/' . $row['qual_id'] . '.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;

}

function getDriverData($driverID) {
  //$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  //$sql = "SELECT * FROM `drivers` WHERE cust_id='$driverID'";
  //$result = mysqli_query($link, $sql);
  //$row = mysqli_fetch_assoc($result);

  $heatURL = 'https://kartlaps.info/v2/tkquebec/racer/'.$driverID.'.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;

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

function getDriverByID($drivID) {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` WHERE id='$drivID'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  return $row['name'];

  mysqli_close($link);
}

function getBriefNews() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `news` ORDER BY date ASC LIMIT 3";
  $result = mysqli_query($link, $sql);
  foreach ($result as $article) {
    echo '<div class="news-blurb">';
    echo '<hr><h4>'.$article['title'].'</h4>';
    echo '<h6><i class="far fa-calendar-alt"></i> '.date("F j, Y", strtotime($article['date'])).'</h6>';
    echo '<p>'.substr($article['content'], 0, 250).'...</p>';
    echo '<p><a class="btn btn-secondary btn-sm" href="news/view.php?id='.$article['id'].'">Read More...</a></p>';
    echo '</div>';

  }
}

function getNews() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `news` ORDER BY date ASC LIMIT 20";
  $result = mysqli_query($link, $sql);
  foreach ($result as $article) {
    echo '<div class="news-blurb">';
    echo '<hr><h4>'.$article['title'].'</h4>';
    echo '<h6><i class="far fa-calendar-alt"></i> '.date("F j, Y", strtotime($article['date'])).'</h6>';
    echo '<p>'.substr($article['content'], 0, 250).'...</p>';
    echo '<p><a class="btn btn-secondary btn-sm" href="view.php?id='.$article['id'].'">Read More...</a></p>';
    echo '</div>';

  }
}

function getBriefSchedule() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` WHERE `date` >= CURDATE() ORDER BY date ASC LIMIT 3";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  $count = 0;

  echo '<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Race #</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
      </tr>
    </thead>
    <tbody>';

    foreach ($result as $race) {
      $count++;
      echo '<tr>';
      echo '<th scope="row">' . $count . '</th>';
      echo '<td>' . date("M jS, Y", strtotime($race['date'])) . '</td>';
      echo '<td>6:30 PM</td>';
      echo '</tr>';
    }

    echo '</tbody></table>';

    mysqli_close($link);
}

function getFullSchedule() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `races` ORDER BY date ASC";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  $count = 0;

  echo '<table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th scope="col">Race #</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Winner</th>
        <th scope="col">Laps Run</th>
        <th scope="col">Results</th>
      </tr>
    </thead>
    <tbody>';

    foreach ($result as $race) {
      $count++;
      echo '<tr>';
      echo '<th scope="row">' . $count . '</th>';
      echo '<td>' . date("M jS, Y", strtotime($race['date'])) . '</td>';
      echo '<td>6:30 PM</td>';
      if($race['race_completed']) {
        echo '<td>' . getWinner($race['id']) . '</td>';
        echo '<td>' . $race['laps_completed'] . '</td>';
        echo '<td><a href="../results/?id=' . $race['id'] . '" class="btn btn-outline-success btn-sm">Results</a></td>';
      } else {
        echo '<td><em>TBD</em></td>';
        echo '<td><em>TBD</em></td>';
        echo '<td><a href="" class="btn btn-outline-success btn-sm disabled">Results</a></td>';
      }
      echo '</tr>';
    }

    echo '</tbody></table>';

    mysqli_close($link);
}

function getBriefStandings() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` ORDER BY points_scored DESC LIMIT 5";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  echo '<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Position</th>
        <th scope="col">Driver</th>
        <th scope="col">Points</th>
      </tr>
    </thead>
    <tbody>';

    foreach ($result as $driver) {
      $count++;
      echo '<tr>';
      echo '<th scope="row">' . $count . '</th>';
      echo '<td>' . $driver['name'] . '</td>';
      echo '<td>' . $driver['points_scored'] . '</td>';

      echo '</tr>';
    }

    echo '</tbody></table>';

    mysqli_close($link);
}

function getFullStandings() {
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $sql = "SELECT * FROM `drivers` ORDER BY points_scored DESC";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);

  echo '<table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th scope="col">Position</th>
        <th scope="col">Name</th>
        <th scope="col">Races Completed</th>
        <th scope="col">Points</th>
      </tr>
    </thead>
    <tbody>';

    foreach ($result as $driver) {
      $count++;
      echo '<tr>';
      echo '<th scope="row">' . $count . '</th>';
      echo '<td><a href="../driver/?id='.$driver['cust_id'].'">' . $driver['name'] . '</a></td>';
      echo '<td>' . $driver['races_completed'] . '</td>';
      echo '<td>' . $driver['points_scored'] . '</td>';

      echo '</tr>';
    }

    echo '</tbody></table>';

    mysqli_close($link);
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

function getRaceTitle($raceData) {
  return $raceData['heat']['name'];
}

function getRacetime($raceData) {
  return $raceData['heat']['localDateTime'];
}
function getRaceWinMethod($raceData) {
  return $raceData['heat']['winBy'];
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

function getQualifyingPosition($qualData, $driverID) {
  $position = null;

  for ($pos=0; $pos < sizeOf($qualData['heat']['participants']); $pos++) {
    if($qualData['heat']['participants'][$pos]['id'] == $driverID) {
      $position = $pos+1;
    }
  }

  if($position != null) {
    return $position;
  } else {
    return "N/A";
  }
}

function getRaceResults($race, $qualify) {
  $laps = $race['heat']['laps'];
  echo '<table class="table table-striped">
    <thead class="thead-light">
      <tr>
        <th scope="col">Position</th>
        <th scope="col">Driver</th>
        <th scope="col">Gap</th>
        <th scope="col">Laps Run</th>
        <th scope="col">Fastest Lap</th>
        <th scope="col">Qual Pos</th>
        <th scope="col">Championship</th>
      </tr>
    </thead><tbody>';

    $count = 0;
    $pointTotal = 10;
    foreach($race['heat']['participants'] as $driver) {
      $count++;

      $lapCount = getLapCount($race, $driver['id']);
      echo '<tr>';
      echo '<th scope="row">'.$count.'</th>';
      echo '<td><a href="../driver/?id='.$driver['id'].'">' . $driver['racerName'] . '</a></td>';
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
      echo '<td>'.getQualifyingPosition($qualify, $driver['id']).'</td>';
      echo '<td>'.$pointTotal.'</td>';
      echo '</tr>';
      if($pointTotal > 0) {
        $pointTotal--;
      }
    }

    echo '</tbody></table>';

}

function getHeatResults($race) {
  $laps = $race['heat']['laps'];
  echo '<table class="table table-striped">
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
      echo '<td><a href="../driver/?id='.$driver['id'].'">' . $driver['racerName'] . '</a></td>';
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

function getQualifyResults($race) {
  $laps = $race['heat']['laps'];
  echo '<table class="table table-striped">
  <thead class="thead-light">
    <tr>
      <th scope="col">Position</th>
      <th scope="col">Driver</th>
      <th scope="col">Fastest Lap</th>
      <th scope="col">Gap</th>
    </tr>
  </thead><tbody>';

    $count = 0;
    $pointTotal = 10;
    $sessionFast = getFastestLapSingle($race);

    foreach($race['heat']['participants'] as $driver) {
      $count++;

      $lapCount = getLapCount($race, $driver['id']);
      echo '<tr>';
      echo '<th scope="row">'.$count.'</th>';
      echo '<td><a href="../driver/?id='.$driver['id'].'">' . $driver['racerName'] . '</a></td>';
      echo '<td>'.getFastestLap($race, $driver['id']).'</td>';
      echo '<td>'.-($sessionFast - getFastestLap($race, $driver['id'])).'</td>';
      echo '</tr>';
      if($pointTotal > 0) {
        $pointTotal--;
      }
    }
    echo '</tbody></table>';
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

function proSkillGain($impact) {
  if ($impact > 0) {
    return "success";
  } if ($impact == 0) {
    return "warning";
  } else {
    return "danger";
  }
}

function getDriverHistory($driverData) {
  echo '<table class="table table-striped">
    <thead class="thead-light">
      <tr>
        <th scope="col">Heat</th>
        <th scope="col">Date</th>
        <th scope="col">Finish Position</th>
        <th scope="col">ProSkill</th>
        <th scope="col">Fastest Lap</th>
        <th scope="col">Details</th>
      </tr>
    </thead>
    <tbody>';

    foreach ($driverData['racer']['heats'] as $heatData) {
      echo '<tr>';
      echo '<td>'.$heatData['heat']['name'].' - Kart '.$heatData['kartNumber'].'</td>';
      echo '<td>'.$heatData['heat']['localDateTime'].'</td>';
      echo '<td>'.$heatData['finalPosition'].''.ordinal_suffix($heatData['finalPosition']).'</td>';
      echo '<td>'.$heatData['pointsAtStart'].' <div class="badge badge-'.proSkillGain($heatData['pointsImpact']).'">'.$heatData['pointsImpact'].'</div></td>';
      echo '<td>'.$heatData['bestLapTime'].'</td>';
      echo '<td><a href="../results/view.php?heat=' . $heatData['heat']['id'] . '" class="btn btn-outline-success btn-sm">Results</a></td>';
      echo '</tr>';
    }
    echo '</tbody></table>';
}
?>
