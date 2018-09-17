<?php

$LOCATION_ID = 'tkquebec';

function getRaceData($heatID) {
  $heatURL = 'http://kartlaps.info/v2/tkquebec/heat/' . $heatID . '.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;
}

function getDriverData($driverID) {
  $heatURL = 'http://kartlaps.info/v2/tkquebec/racer/' . $driverID . '.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;
}

function getRacerName($driverID) {
  $heatURL = 'http://kartlaps.info/v2/tkquebec/racer/' . $driverID . '.json';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result['racer']['racerName'];
}

function searchForResult($searchTerm) {
  $term = rawurlencode($searchTerm);
  $heatURL = 'http://kartlaps.info/v2/tkquebec/search/' . $term . '';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);

  return $result;
}

function getTopTimes($timeRange) {
  $heatURL = 'http://kartlaps.info/v2/tkquebec/laptimeleaderboard/' . $timeRange . '';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);
  $count = 0;

  echo '<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Rank</th>
        <th scope="col">Driver</th>
        <th scope="col">Lap Time</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>';

    foreach($result['laptimeleaderboard']['leaders'] as $leader) {
      $count++;
      echo '<tr><th scope="row">'.$count.'</th>';
      echo '<td>'.$leader['racerName'].'</td>';
      echo '<td>'.$leader['lapTime'].'</td>';
      echo '<td>'.$leader['localDateTime'].'</td>';
    }
    echo '</tbody></table>';
}

function getLeaderboard() {
  $heatURL = 'http://kartlaps.info/v2/tkquebec/pointsleaderboard';
  $heatData = file_get_contents($heatURL);
  $result = json_decode($heatData, true);
  $count = 0;

  echo '<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Rank</th>
        <th scope="col">Driver</th>
        <th scope="col">ProSkill</th>
        <th scope="col">City</th>
        <th scope="col">Details</th>
      </tr>
    </thead>
    <tbody>';

    foreach($result['pointsleaderboard']['leaders'] as $leader) {
      $count++;
      echo '<tr><th scope="row">'.$count.'</th>';
      echo '<td>'.$leader['racerName'].'</td>';
      echo '<td>'.$leader['points'].'</td>';
      echo '<td>'.$leader['city'].'</td>';
      echo '<td><a href="../driver/?id='.$leader['id'].'" class="btn btn-outline-success btn-sm">Details</a></td>';
    }
    echo '</tbody></table>';
}

function showSearchResults($term) {
  $results = searchForResult($term);

  echo '<table class="table table-striped">
    <thead class="thead-light">
      <tr>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Racer Name</th>
        <th scope="col">City</th>
        <th scope="col">Details</th>
      </tr>
    </thead>
    <tbody>';

    foreach ($results['search']['results'] as $racer) {
      echo '<tr>';
      echo '<td>'.$racer['realFirstName'].'</td>';
      echo '<td>'.$racer['realLastName'].'</td>';
      echo '<td>'.$racer['racerName'].'</td>';
      echo '<td>'.$racer['city'].'</td>';
      echo '<td><a href="../driver/?id=' . $racer['id'] . '" class="btn btn-outline-success btn-sm">Details</a></td>';
      echo '</tr>';
    }
    echo '</tbody></table>';
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
  return $leaderLaps - $lapCount . "L";
}

function winByPos($raceData) {
  if($raceData['heat']['winBy'] == "Position") {
    return true;
  } else {
    return false;
  }
}

function getLaps($race) {
  echo '<div class="row">';
  foreach($race['heat']['laps'] as $laps) {
    echo '<div class="col-md-2"><table class="table table-sm table-striped">';
    echo '<thead>';
    echo '<b>'.getRacerName($laps['racerId']).'</b>';
    echo '</thead>';

    echo '<tbody>';

    foreach($laps['racerLaps'] as $lap) {
      echo '<tr>';

      echo '<th scope="row">' . $lap['lapNumber'] . '</th>';
      echo '<td>' . $lap['seconds'] . '</td>';
      echo '<td>[' . $lap['position'] . ']</td>';

      echo '</tr>';
    }
    echo '</tbody></table></div>';
  }
  echo '</div>';
}

function getHeatResults($race) {
  $laps = $race['heat']['laps'];
  $sessionFast = getFastestLapSingle($race);
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
      if(winByPos($race)) {
        echo '<td>'.getGapToLeader($race, $lapCount).'</td>';
      } else {
        echo '<td>'.abs($sessionFast - getFastestLap($race, $driver['id'])).'s</td>';
      }
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

    if(isset($driverData['racer']['heats'])) {
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
        echo '<td><a href="../results/?id=' . $heatData['heat']['id'] . '" class="btn btn-outline-success btn-sm">Results</a></td>';
        echo '</tr>';
      }

      echo '</tbody></table>';
    } else {
      echo '<p>No race data available.</p>';
    }

}

 ?>
