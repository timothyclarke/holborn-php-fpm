<?php
  $siteName       = htmlspecialchars($_POST['site_name']);
  $siteNotes      = htmlspecialchars($_POST['site_notes']);
  endif;
?>
<H1>Adding <?php echo $siteName ?> to the list of dive sites</H1>
<TABLE><TBODY>
<TR><TD WIDTH=100>&nbsp;</TD><TD></TD></TR>
<TR><TD>Site Name</TD><TD><?php echo $siteName ?></TD></TR>
<TR><TD>Site Notes</TD><TD><?php echo $siteNotes ?></TD></TR>
</TBODY></TABLE>

<?php
  require '../../db.inc.php';
  $conn = new mysqli($host, $username, $password, $db_name);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  mysqli_set_charset($conn,"utf8");

  $insert_site = "INSERT INTO sites (site_name, site_notes) VALUES ('". $siteName ."','". $siteNotes ."')";
  $result = mysqli_query($conn, $inserti_site) or trigger_error("Query Failed! SQL: $insert_site - Error: ".mysqli_error($conn), E_USER_ERROR);
  echo '<BR>';
  if ($result === TRUE):
    echo $siteName . ' added to the list of dive sites';
  else:
    echo 'There was an error adding ' .$siteName . ' to the list of dive sites';
  endif;

?>
