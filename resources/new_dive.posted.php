<?php
  $instructional  = htmlspecialchars($_POST['instructional']);
  $diveDate       = htmlspecialchars($_POST['divedate']);
  $maxDepth       = htmlspecialchars($_POST['depth']);
  $diveTime       = htmlspecialchars($_POST['time']);
  $diveSiteID     = htmlspecialchars($_POST['dive_site']);
  $diverOneID     = htmlspecialchars($_POST['diver_one']);
  $diverOneGas    = htmlspecialchars($_POST['diver_one_gas']);
  $diverOneRole   = htmlspecialchars($_POST['diver_one_role']);
  $diverTwoID     = htmlspecialchars($_POST['diver_two']);
  $diverTwoGas    = htmlspecialchars($_POST['diver_two_gas']);
  $diverTwoRole   = htmlspecialchars($_POST['diver_two_role']);
  $diverThreeID   = htmlspecialchars($_POST['diver_three']);
  $diverThreeGas  = htmlspecialchars($_POST['diver_three_gas']);
  $diverThreeRole = htmlspecialchars($_POST['diver_three_role']);

  echo "<H1>Adding a dive with the following details</H1>\n";
  echo '<BR><BR>' . "\n";
  echo 'Dive Date & time ' . $diveDate ."<BR>\n";
  echo 'Max Depth ' . $maxDepth ."<BR>\n";
  echo 'Dive Time ' . $diveTime ."<BR>\n";
  echo 'Dive site id ' .    $diveSiteID ."<BR>\n";
  echo 'Diver one id ' .    $diverOneID ."<BR>\n";
  echo 'Diver one gas ' .   $diverOneGas ."<BR>\n";
  echo 'Diver one role ' .  $diverOneRole ."<BR>\n";
  echo 'Diver two id ' .    $diverTwoID ."<BR>\n";
  echo 'Diver two gas ' .   $diverTwoGas ."<BR>\n";
  echo 'Diver two role ' .  $diverTwoRole ."<BR>\n";
  if ( $diverThreeID != '0' ):
    echo 'Diver three id ' .    $diverThreeID  ."<BR>\n";
    echo 'Diver three gas ' .   $diverThreeGas  ."<BR>\n";
    echo 'Diver three role ' .  $diverThreeRole  ."<BR>\n";
  else:
    echo 'No third diver' . "<BR>\n";
  endif;
  if($instructional == '1'):
    echo 'Dive was recreational' . "<BR>\n";
    $diverOneRole   = '0';
    $diverTwoRole   = '0';
    $diverThreeRole = '0';
  else:
    echo 'Dive was educational' . $instructional . "<BR>\n";
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

  $insert_dive =  "INSERT INTO dives (site_id, educational_types_id, depth, time, date) VALUES ('". $diveSiteID ."','". $instructional ."','". $maxDepth ."','". $diveTime ."','". $diveDate ."')";

  if ($conn->query($insert_dive) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New Dive created successfully. Dive ID is: " . $last_id ."<BR>\n";
    $insert_diverOne_dive = "INSERT INTO diver_dives ( dive_id, diver_id, gas_id, instructional_role_id ) VALUES ('". $last_id ."','". $diverOneID ."','". $diverOneGas  ."','". $diverOneRole ."')";
    $insert_diverTwo_dive = "INSERT INTO diver_dives ( dive_id, diver_id, gas_id, instructional_role_id ) VALUES ('". $last_id ."','". $diverTwoID ."','". $diverTwoGas  ."','". $diverTwoRole."')";
    $insert_diverThree_dive = "INSERT INTO diver_dives ( dive_id, diver_id, gas_id, instructional_role_id ) VALUES ('". $last_id ."','". $diverThreeID ."','". $diverThreeGas  ."','". $diverThreeRole ."')";

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
