<?php
$title = "Diving Stats This year";
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
    <P>
      <H2> Totals<H2>
      <H3>
        <UL>
          <?php
            $sql_select = "select count(dive_id) as diver_dives,sum(time) as total_dive_time from diver_dives natural join dives WHERE date > NOW() - INTERVAL 1 YEAR";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo '<LI>Diver Dives : ' . $row['diver_dives'] . '</LI>';
                echo '<LI>Dive Time   : ' . $row['total_dive_time'] . '</LI>';
              }
            }
          ?>
        </UL>
      </H3>
    </P>
    <BR>
    <H2><A HREF=/resources/dived_sites.php>Dives Conducted</A></H2>
    <TABLE><TBODY>
    <TR><TD WIDTH=100><TD WIDTH=50></TD></TD><TD WIDTH=250></TD><TD></TD><TR>
    <TR><TD>Date</TD><TD>Dives</TD><TD>Site</TD><TD>Skill</TD><TR>
      <?php
        $sql_select = "select date, count(date) as dives_per_date, site_name, educational_types_id from dives natural join sites WHERE date > NOW() - INTERVAL 1 YEAR group by site_id,date order by date desc";
        $sql_data = $conn->query($sql_select);
        if ($sql_data->num_rows > 0) {
          while($row = $sql_data->fetch_assoc()) {
            $instructional = '';
            if ( $row['educational_types_id'] >1 ) {
              $find_skill_name = "select educational_name from educational_types where educational_types_id ='" . $row['educational_types_id'] . "'";
              $skill_data = $conn->query($find_skill_name);
              if ($skill_data->num_rows > 0) {
                while( $skill_row = $skill_data->fetch_assoc()) {
                  $instructional = $skill_row['educational_name'];
                }
              }
            }
            echo '<tr><td>' . $row['date'] . '</td><td>' .  $row['dives_per_date'] . '</td><td>' .$row['site_name'] . '</td><td>' . $instructional . '</td></tr>';
          }
        }
      ?>
    </TBODY></TABLE>

    <BR>
    <H2>Instructed Dives</H2>
    <TABLE><TBODY>
      <TR><TD WIDTH=150></TD><TD WIDTH=75></TD><TD></TD><TR>
      <TR><TD>Instructor</TD><TD>No. Dives</TD><TD>In Water Time</TD><TR>
      <?php
        $sql_select = "select diver_name,count(dive_id) as dives,sum(time) as dive_time from divers natural join diver_dives natural join dives where instructor=1 and instructional_role_id=1 and date > NOW() - INTERVAL 1 YEAR group by diver_id order by dives desc, dive_time desc";
        $sql_data = $conn->query($sql_select);
        if ($sql_data->num_rows > 0) {
          while($row = $sql_data->fetch_assoc()) {
            echo '<tr><td>' . $row['diver_name'] . '</td><td>' . $row['dives'] . '</td><td>' .$row['dive_time'] . '</td></tr>';
          }
        }
      ?>
    </TBODY></TABLE>
    <BR>
    <H2>General Dives</H2>
    <TABLE ID="T03"><TBODY PADDING=5>
      <TR><TD WIDTH=220></TD><TD WIDTH=75></TD><TD></TD><TR>
      <TR><TD>Diver</TD><TD>No. Dives</TD><TD>In Water Time</TD><TR>
      <?php
        $sql_select = "select diver_name,count(dive_id) as dives,sum(time) as dive_time from divers natural join diver_dives natural join dives WHERE date > NOW() - INTERVAL 1 YEAR and instructional_role_id=0 group by diver_id order by dives desc, dive_time desc limit 15";
        $sql_data = $conn->query($sql_select);
        if ($sql_data->num_rows > 0) {
          while($row = $sql_data->fetch_assoc()) {
            echo '<tr><td>' . $row['diver_name'] . '</td><td>' . $row['dives'] . '</td><td>' .$row['dive_time'] . '</td></tr>';
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
