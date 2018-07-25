<?php
  $diverName      = htmlspecialchars($_POST['diver_name']);
  $isDiveManager  = 0;
  $isCoxwain      = 0;
  $isInstructor   = 0;
  if ( htmlspecialchars($_POST['manager']) =='TRUE' ):
    $isDiveManager  = 1;
  endif;
  if ( htmlspecialchars($_POST['coxwain']) =='TRUE' ):
    $isCoxwain      = 1;
  endif;
  if ( htmlspecialchars($_POST['instructor']) =='TRUE' ):
    $isInstructor   = 1;
  endif;
?>
<H1>Adding a diver with the following details</H1>
<TABLE><TBODY>
<TR><TD WIDTH=100>&nbsp;</TD><TD></TD></TR>
<TR><TD>Diver Name</TD><TD><?php echo $diverName ?></TD></TR>
<TR><TD>Dive Manager</TD><TD><?php echo $isDiveManager ?></TD></TR>
<TR><TD>Coxwain</TD><TD><?php echo $isCoxwain ?></TD></TR>
<TR><TD>Instructor</TD><TD><?php echo $isInstructor ?></TD></TR>
</TBODY></TABLE>

<?php
  require '../../db.inc.php';
  $conn = new mysqli($host, $username, $password, $db_name);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  mysqli_set_charset($conn,"utf8");

  $insert_diver = "INSERT INTO divers (diver_name, manager, instructor, cox) VALUES ('". $diverName ."','". $isDiveManager ."','". $isCoxwain ."','".$isInstructor ."')";
  $result = mysqli_query($conn, $insert_diver) or trigger_error("Query Failed! SQL: $insert_diver - Error: ".mysqli_error($conn), E_USER_ERROR);
  echo '<BR>';
  if ($result === TRUE):
    echo $diverName . ' added to the list of divers';
  else:
    echo 'There was an error adding ' .$diverName . ' to the list of divers';
  endif;

?>
