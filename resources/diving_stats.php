<?php
$title = "Diving Stats";
$pagetype = "adminpage"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
</head>
<body>
  <div class="container">

    <?php
    require '../../db.inc.php';
    $conn = new mysqli($host, $username, $password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn,"utf8");
    $sql_select = "select count(dive_id) as diver_dives,sum(time) as total_dive_time from diver_dives natural join dives";
    $sql_data = $conn->query($sql_select);
    if ($sql_data->num_rows > 0) {
      while($row = $sql_data->fetch_assoc()) {
        echo '<p><H2> Totals<H2>';
        echo '<H3><UL>';
        echo '<LI>Diver Dives : ' . $row['diver_dives'] . '</LI>';
        echo '<LI>Dive Time   : ' . $row['total_dive_time'] . '</LI>';
        echo '</UL></H3></p>';
      }
    }

    echo '<BR>';
    $sql_select = "select date, count(date) as dives_per_date, site_name, instructional from dives natural join sites group by site_id,date order by date desc";
    $sql_data = $conn->query($sql_select);
    if ($sql_data->num_rows > 0) {
      echo '<h2><A HREF=/resources/dived_sites.php>Dives Conducted</A></h2>';
      echo '<table><tbody><tr><td width=100><td width=50></td></td><td width=250></td><td></td><TR>';
      echo '<tr><td>Date</td><td>Dives</td><td>Site</td><td>instructional</td><TR>';
      while($row = $sql_data->fetch_assoc()) {
        $instructional = '';
        if ( $row['instructional'] ) {
          $instructional = 'TRUE';
        }
        echo '<tr><td>' . $row['date'] . '</td><td>' .  $row['dives_per_date'] . '</td><td>' .$row['site_name'] . '</td><td>' . $instructional . '</td></tr>';
      }
      echo '</tbody></table>';
    }

    echo '<BR>';
    $sql_select = "select diver_name,count(dive_id) as dives,sum(time) as dive_time from divers natural join diver_dives natural join dives where instructor=1 and instructional=1 group by diver_id order by dives desc, dive_time desc";
    $sql_data = $conn->query($sql_select);
    if ($sql_data->num_rows > 0) {
      echo '<h2>Instructed Dives</h2>';
      echo '<table><tbody><tr><td width=150></td><td width=75></td><td></TD><TR>';
      echo '<tr><td>Instructor</td><td>No. Dives</td><td>In Water Time</TD><TR>';
      while($row = $sql_data->fetch_assoc()) {
        echo '<tr><td>' . $row['diver_name'] . '</td><td>' . $row['dives'] . '</td><td>' .$row['dive_time'] . '</td></tr>';
      }
      echo '</tbody></table>';
    }

    echo '<BR>';
    $sql_select = "select diver_name,count(dive_id) as dives,sum(time) as dive_time from divers natural join diver_dives natural join dives where instructional=0 group by diver_id order by dives desc, dive_time desc limit 15";
    $sql_data = $conn->query($sql_select);
    if ($sql_data->num_rows > 0) {
      echo '<h2>General Dives</h2>';
      echo '<table id="t03"><tbody padding=5><tr><td width=220></td><td width=75></td><td></TD><TR>';
      echo '<tr><td>Diver</td><td>No. Dives</td><td>In Water Time</TD><TR>';
      while($row = $sql_data->fetch_assoc()) {
        echo '<tr><td>' . $row['diver_name'] . '</td><td>' . $row['dives'] . '</td><td>' .$row['dive_time'] . '</td></tr>';
      }
      echo '</tbody></table>';
    }
    $conn->close();
    ?>

  </div>
</body>
</html>
