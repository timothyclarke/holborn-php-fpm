<?php
  $title = "Diving Stats";
  $userrole = "DO"; // Allow only logged in users
  include "login/misc/authhead.php";
  require '../../db.inc.php';
  $conn = new mysqli($host, $username, $password, $db_name);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  mysqli_set_charset($conn,"utf8");
  $sql_select = "select sites.site_name as site_name, dives.date as dive_date, divers.diver_name as diver_name, dives.depth as depth, dives.time as dive_time, gas.gas_name as gas FROM diver_dives NATURAL JOIN dives NATURAL JOIN divers NATURAL JOIN sites NATURAL JOIN gas NATURAL JOIN instructional_roles where  instructional_roles.instructional_role ='Recreational'   group by dive_id,diver_id order by dive_date, dive_id";

  $sql_data = $conn->query($sql_select);
  if (!$sql_data) die('Couldn\'t fetch records');
  $num_fields = $sql_data->field_count;
  $fields = mysqli_fetch_fields($sql_data);
  $headers = array();
  foreach($fields as $fi => $f){
    $headers[] = $f->name;
  }
  $fp = fopen('php://output', 'w');
  if ($fp && $sql_data) {
     header('Content-Type: text/csv');
     header('Content-Disposition: attachment; filename="RecreationalDives.csv"');
     header('Pragma: no-cache');
     header('Expires: 0');
     fputcsv($fp, array_values($headers));
     while($row = $sql_data->fetch_row()) {
        $thisRow = array();
        foreach($row as $ro => $r){
          $thisRow[] =  utf8_decode($r);
        }
        fputcsv($fp, array_values($thisRow));
     }
  die;
  }
?>
