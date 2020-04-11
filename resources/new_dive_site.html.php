  <H1>New Dive Site Form</H1>
  <form name='NewSite' method='post' action=" <?php echo $_SERVER['PHP_SELF'] ?> ">
    <TABLE><TBODY>
      <TR><TD></TD><TD></TD><TD WIDTH=60></TD><TD></TD><TD></TD></TR>
      <TR><TD WIDTH=120>&nbsp;</TD><TD></TD><TD WIDTH=105>&nbsp;</TD><TD></TD><TD></TD></TR>
      <TR><TD ColSpan=5>&nbsp;</TD></TR>

      <?php
        require '../../db.inc.php';
        $conn = new mysqli($host, $username, $password, $db_name);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        mysqli_set_charset($conn,"utf8");
      ?>

      <TR>
        <TD>Site Name</TD>
        <TD ColSpan=4>
          <INPUT TYPE="text" NAME="site_name" SIZE="45" MAXLENGTH="125">
        </TD>
      </TR>
      <TR>
        <TD>Site Notes</TD>
        <TD ColSpan=4>
          <TEXTAREA NAME="site_notes" rows="5" cols="70"></TEXTAREA>
        </TD>
      </TR>

      </TBODY></TABLE>
      <input type="submit" value="Submit">
    </form>
