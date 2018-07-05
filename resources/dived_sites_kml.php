<?php
require '../../db.inc.php';
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");

$get_diver_dives = "select site_id,site_name,count(dive_id) as dives from diver_dives natural join dives natural join sites group by site_id";

$dive_data = $conn->query($get_diver_dives);
if ($dive_data->num_rows > 0) {
  echo '<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://www.opengis.net/kml/2.2"><Document>';
  while($dive_row = $dive_data->fetch_assoc()) {
    $gps_location = "select north,east from sites_gps where site_id = " . $dive_row['site_id'] ." order by gps_id limit 1";
    $gps_data = $conn->query($gps_location);
    if ($gps_data->num_rows > 0) {
      while($gps_row = $gps_data->fetch_assoc()) {
        echo '<Placemark><name><![CDATA[ ' . $dive_row['site_name'] . ' ]]></name><description><![CDATA[ ' . $dive_row['dives'] . ' Diver Dives ]]></description><Point><coordinates> ' . $gps_row['east'] . ',' . $gps_row['north'] . '</coordinates></Point></Placemark>';
	    }
	  }
	}
}
$conn->close();
echo '</Document></kml>';
?>
