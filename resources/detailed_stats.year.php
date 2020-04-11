<?php
$title = "Diving Stats";
$userrole = "DO"; // Allow only logged in users
include "login/misc/pagehead.php";
?>
</head>
<body>
  <?php require 'login/misc/pullnav.php'; ?>
  <div class="container">

    <?php
      require '../../db.inc.php';
      $conn = new mysqli($host, $username, $password, $db_name);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      mysqli_set_charset($conn,"utf8");
    ?>
    <H2>Detailed Dive Stats</H2>
    <H4>Download Dives :<A HREF='/resources/download.detailed_educational_dives.php'>Instructional</A> <A HREF='/resources/download.detailed_recreational_dives.php'>Recreational</A></H4>
    <TABLE ID="T03"><TBODY PADDING=5>
      <TR><TD WIDTH=150></TD><TD WIDTH=85></TD><TD Width=220></TD><TD WIDTH=45><TD WIDTH=45><TD WIDTH=85><TD WIDTH=85><TD WIDTH=55><TR>
      <TR><TD>Site Name</TD><TD>Date</TD><TD>Diver</TD><TD>Depth</TD><TD>Time</TD><TD>Gas</TD><TD>Role</TD><TD>Exercise</TD><TR>
      <?php
        $sql_select = "select sites.site_name as site_name, dives.date as dive_date, divers.diver_name as diver_name, dives.depth as depth, dives.time as dive_time, gas.gas_name as gas, instructional_roles.instructional_role as role, instructional_roles.instructional_role_id as role_id, educational_types.educational_name as exercise FROM diver_dives NATURAL JOIN dives NATURAL JOIN divers NATURAL JOIN sites NATURAL JOIN gas NATURAL JOIN educational_types NATURAL JOIN instructional_roles WHERE date > NOW() - INTERVAL 1 YEAR group by dive_id,diver_id order by dive_date desc, dive_id";
        $sql_data = $conn->query($sql_select);
        if ($sql_data->num_rows > 0) {
          while($row = $sql_data->fetch_assoc()) {
            if ($row['role_id'] != '0'):
              echo '<TR><TD>' . $row['site_name'] . '</TD><TD>' .  $row['dive_date'] . '</TD><TD>' .  $row['diver_name'] . '</TD><TD>' .  $row['depth'] . '</TD><TD>' .  $row['dive_time'] . '</TD><TD>' .  $row['gas'] . '</TD><TD>' .  $row['role'] . '</TD><TD>' .  $row['exercise'] . '</TD></TR>';
            else:
              echo '<TR><TD>' . $row['site_name'] . '</TD><TD>' .  $row['dive_date'] . '</TD><TD>' .  $row['diver_name'] . '</TD><TD>' .  $row['depth'] . '</TD><TD>' .  $row['dive_time'] . '</TD><TD>' .  $row['gas'] . '</TD><TD ColSpan=2>' . '</TD></TR>';
            endif;
          }
        }
      ?>
    </TBODY></TABLE>

    <?php
      $conn->close();
    ?>


  </div>
</body>
</html>
