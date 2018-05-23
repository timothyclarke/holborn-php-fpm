<?php
require '../../../db.inc.php';
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_select = "select site_name,north,east,count(dive_id) as dives from diver_dives natural join dives natural join sites natural join sites_gps group by site_id";

$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo '<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://www.opengis.net/kml/2.2"><Document>';
  while($row = $sql_data->fetch_assoc()) {
    echo '<Placemark><name><![CDATA[ ' . $row['site_name'] . ' ]]></name><description><![CDATA[ ' . $row['dives'] . ' Diver Dives ]]></description><Point><coordinates> ' . $row['east'] . ',' . $row['north'] . '</coordinates></Point></Placemark>';
	}
}
$conn->close();
echo '</Document></kml>';
?>
