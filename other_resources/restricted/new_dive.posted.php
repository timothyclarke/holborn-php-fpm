<?php
  $instructional	= '0';
  $diveDate      	= htmlspecialchars($_POST['divedate']);
  $maxDepth				= htmlspecialchars($_POST['depth']);
  $diveTime				= htmlspecialchars($_POST['time']);
  $diveSiteID			= htmlspecialchars($_POST['dive_site']);
  $diverOneID			= htmlspecialchars($_POST['diver_one']);
  $diverTwoID			= htmlspecialchars($_POST['diver_two']);
  $diverThreeID		= htmlspecialchars($_POST['diver_three']);
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


  if(!empty($_POST['instructional'])):
  require '../../../db.inc.php';
  $conn = new mysqli($hostname, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $insert_dive =  "INSERT INTO dives (site_id, instructional, depth, time, date) VALUES ('". $diveSiteID ."','". $instructional ."','". $maxDepth ."','". $diveTime ."','". $diveDate ."')";
  echo 'Insert details are : ' . $insert_dive;

  endif;

?>
