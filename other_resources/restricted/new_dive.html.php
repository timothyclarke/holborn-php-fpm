  <H1>New Dive Form</H1>
  <form name='NewDive' method='post' action=" <?php echo $_SERVER['PHP_SELF'] ?> ">
  Enter Dive Date : <input type='datetime-local' name='divedate' required >
  <BR>
  <BR>
  Was this an instructional dive<input type="checkbox" name="instructional" value="instructional"><BR>
  Depth <input type="number" name="depth" step="0.1" min="0" max="50"><BR>
  Time  <input type="number" name="time" step="1" min="0" max="90"><BR>
<?php
require '../../../db.inc.php';
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql_select = "select site_id,site_name from sites";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo "\tSelect Dive Site\n";
  echo "\t<select name='dive_site'>\n";
  while($row = $sql_data->fetch_assoc()) {
    echo "\t\t" . '<option value="' . $row['site_id'] . '">' . $row['site_name'] . "</option>\n";
  }
  echo "\t</select>\n";
  echo '<BR>';
}
  echo '<BR>';
$sql_select = "select diver_id,diver_name from divers order by diver_name";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo "\tSelect Diver 1&nbsp;\n";
  echo "\t<select name='diver_one'>\n";
  while($row = $sql_data->fetch_assoc()) {
    echo "\t\t" . '<option value="' . $row['diver_id'] . '">' . $row['diver_name'] . "</option>\n";
  }
  echo "\t</select>\n";
  echo '<BR>';
}
$sql_select = "select diver_id,diver_name from divers order by diver_name";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo "\tSelect Diver 2&nbsp;\n";
  echo "\t<select name='diver_two'>\n";
  while($row = $sql_data->fetch_assoc()) {
    echo "\t\t" . '<option value="' . $row['diver_id'] . '">' . $row['diver_name'] . "</option>\n";
  }
  echo "\t</select>\n";
  echo '<BR>';
}

$sql_select = "select diver_id,diver_name from divers order by diver_name";
$sql_data = $conn->query($sql_select);
if ($sql_data->num_rows > 0) {
  echo "\tSelect Diver 3&nbsp;\n";
  echo "\t<select name='diver_three'>\n";
  echo "\t\t<option value='0'>No Third Diver</option>\n";
  while($row = $sql_data->fetch_assoc()) {
    echo "\t\t" . '<option value="' . $row['diver_id'] . '">' . $row['diver_name'] . "</option>\n";
  }
  echo "\t</select>\n";
  echo '<BR>';
}

$conn->close();
?>
      <BR>
      <input type="submit" value="Submit">
    </form>
