<?php
require '../../../db.inc.php';
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_select = "select site_name,north,east,gps_notes from sites natural join sites_gps";

$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo '<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://www.opengis.net/kml/2.2"><Document>';
  while($row = $sql_data->fetch_assoc()) {
    echo '<Placemark><name><![CDATA[ ' . $row['site_name'] . ' ]]></name><description><![CDATA[ ' . $row['gps_notes'] . ' ]]></description><Point><coordinates> ' . $row['east'] . ',' . $row['north'] . '</coordinates></Point></Placemark>';
	}
}
$conn->close();
echo '</Document></kml>';
?>

