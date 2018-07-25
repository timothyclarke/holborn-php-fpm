<?php
$title = "Diving Stats";
$pagetype = "userpage"; // Allow only logged in users
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
    ?>
    <P>
      <H2> Totals<H2>
      <H3>
        <UL>
          <?php
            $sql_select = "select count(dive_id) as diver_dives,sum(time) as total_dive_time from diver_dives natural join dives";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo '<LI>Diver Dives             : ' . $row['diver_dives'] . '</LI>';
                echo '<LI>Consolidated Dive Time  : ' . $row['total_dive_time'] . '</LI>';
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
    <TR><TD>Date</TD><TD>Dives</TD><TD>Site</TD><TD></TD><TR>
      <?php
        $sql_select = "select date, count(date) as dives_per_date, site_name, educational_types_id from dives natural join sites group by site_id,date order by date desc";
        $sql_data = $conn->query($sql_select);
        if ($sql_data->num_rows > 0) {
          while($row = $sql_data->fetch_assoc()) {
            $instructional = '';
            if ( $row['educational_types_id'] >1 ) {
              $instructional = 'Training';
            }
            echo '<tr><td>' . $row['date'] . '</td><td>' .  $row['dives_per_date'] . '</td><td>' .$row['site_name'] . '</td><td>' . $instructional . '</td></tr>';
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
