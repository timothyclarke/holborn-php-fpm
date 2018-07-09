<?php
  $instructional  = '0';
  $diveDate       = htmlspecialchars($_POST['divedate']);
  $maxDepth       = htmlspecialchars($_POST['depth']);
  $diveTime       = htmlspecialchars($_POST['time']);
  $diveSiteID     = htmlspecialchars($_POST['dive_site']);
  $diverOneID     = htmlspecialchars($_POST['diver_one']);
  $diverTwoID     = htmlspecialchars($_POST['diver_two']);
  $diverThreeID   = htmlspecialchars($_POST['diver_three']);
  echo "<H1>Adding a dive with the following details</H1>\n";
  echo '<BR><BR>' . "\n";
  echo 'Dive Date & time ' . $diveDate ."<BR>\n";
  echo 'Max Depth ' . $maxDepth ."<BR>\n";
  echo 'Dive Time ' . $diveTime ."<BR>\n";
  echo 'Dive site id ' . $diveSiteID ."<BR>\n";
  echo 'Diver one id ' . $diverOneID ."<BR>\n";
  echo 'Diver two id ' . $diverTwoID ."<BR>\n";
  if ( $diverThreeID != '0' ):
    echo 'Diver three id ' . $diverThreeID  ."<BR>\n";
  else:
    echo 'No third diver' . "<BR>\n";
  endif;
  if(!empty($_POST['instructional'])):
    echo 'Dive was instructional' . "<BR>\n";
    $instructional = '1';
  else:
    echo 'Dive was recreational' . "<BR>\n";
  endif;

  echo "<H2>Adding details to Database</H2>\n";


//  if(!empty($_POST['instructional'])):
  require '../../db.inc.php';
  $conn = new mysqli($host, $username, $password, $db_name);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  mysqli_set_charset($conn,"utf8");

  $insert_dive =  "INSERT INTO dives (site_id, instructional, depth, time, date) VALUES ('". $diveSiteID ."','". $instructional ."','". $maxDepth ."','". $diveTime ."','". $diveDate ."')";

  if ($conn->query($insert_dive) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New Dive created successfully. Dive ID is: " . $last_id ."<BR>\n";
    $insert_diverOne_dive = "INSERT INTO diver_dives ( dive_id, diver_id ) VALUES ('". $last_id ."','". $diverOneID ."')";
    $insert_diverTwo_dive = "INSERT INTO diver_dives ( dive_id, diver_id ) VALUES ('". $last_id ."','". $diverTwoID ."')";
    $insert_diverThree_dive = "INSERT INTO diver_dives ( dive_id, diver_id ) VALUES ('". $last_id ."','". $diverThreeID ."')";

    if ($conn->query($insert_diverOne_dive) === TRUE) {
      echo "Diver One Added to Dive<BR>\n";
    } else {
      echo "Error Adding First Diver to Dive: " . $sql . "<br>" . $conn->error;
    }
    if ($conn->query($insert_diverTwo_dive) === TRUE) {
      echo "Diver Two Added to Dive<BR>\n";
    } else {
      echo "Error Adding Second Diver to Dive: " . $sql . "<br>" . $conn->error;
    }

    if ( $diverThreeID != '0' ) {
      if ($conn->query($insert_diverThree_dive) === TRUE) {
        echo "Diver Three Added to Dive<BR>\n";
      } else {
        echo "Error Adding Third Diver to Dive: " . $sql . "<br>" . $conn->error;
      }
    }
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
//  endif;

?>
