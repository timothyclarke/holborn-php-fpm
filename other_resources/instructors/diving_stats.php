<!DOCTYPE html>
<html>
  <head>
    <title>Diving Stats</title>
    <style>
      td {
        padding: 6px;
      }
    </style>
  </head>
  <body>
<?php
require '../../db.inc.php';
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql_select = "select count(dive_id) as diver_dives from diver_dives";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  while($row = $sql_data->fetch_assoc()) {
    echo '<p><h2>Total number of Diver Dives : ' . $row['diver_dives'] . '</H2></p>';
	}
}

echo '<BR>';
$sql_select = "select date,site_name,instructional from dives natural join sites group by date order by date desc";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo '<h2><A HREF=/other_resources/public/dived_sites.php>Dives Conducted</A></h2>';
  echo '<table><tbody><tr><td>Date</td><td>Site</td><td>instructional</td><TR>';
  while($row = $sql_data->fetch_assoc()) {
    $instructional = '';
    if ( $row['instructional'] ) {
      $instructional = 'TRUE';
    }
    echo '<tr><td>' . $row['date'] . '</td><td>' . $row['site_name'] . '</td><td>' . $instructional . '</td></tr>';
	}
  echo '</tbody></table>';
}

echo '<BR>';
$sql_select = "select diver_name,count(dive_id) as dives,sum(time) as dive_time from divers natural join diver_dives natural join dives where instructor=1 and instructional=1 group by diver_id order by dives desc";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo '<h2>Instructed Dives</h2>';
  echo '<table><tbody><tr><td>Instructor</td><td>No. Dives</td><td>In Water Time</TD><TR>';
  while($row = $sql_data->fetch_assoc()) {
    echo '<tr><td>' . $row['diver_name'] . '</td><td>' . $row['dives'] . '</td><td>' .$row['dive_time'] . '</td></tr>';
	}
  echo '</tbody></table>';
}

echo '<BR>';
$sql_select = "select diver_name,count(dive_id) as dives,sum(time) as dive_time from divers natural join diver_dives natural join dives group by diver_id order by dives desc limit 15";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo '<h2>General Dives</h2>';
  echo '<table id="t03"><tbody padding=5><tr><td>Diver                          </td><td>No. Dives</td><td>In Water Time</TD><TR>';
  while($row = $sql_data->fetch_assoc()) {
    echo '<tr><td>' . $row['diver_name'] . '</td><td>' . $row['dives'] . '</td><td>' .$row['dive_time'] . '</td></tr>';
	}
  echo '</tbody></table>';
}




$conn->close();
?>
  </body>
</html>
