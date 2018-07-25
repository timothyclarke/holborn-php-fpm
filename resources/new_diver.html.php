  <H1>New Diver Form</H1>
  <form name='NewDiver' method='post' action=" <?php echo $_SERVER['PHP_SELF'] ?> ">
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
        <TD>Diver Name</TD>
        <TD ColSpan=4>
          <INPUT TYPE="text" NAME="diver_name" SIZE="45" MAXLENGTH="125">
        </TD>
      </TR>
      <TR><TD ColSpan=5>&nbsp;</TD></TR>
      <TR><TD></TD><TD>NO</TD><TD>YES</TD><TD COLSPAN=2></TD></TR>
      <TR>
        <TD>Dive Manager</TD>
        <TD><INPUT TYPE="radio" NAME="manager" VALUE="FALSE" checked></TD>
        <TD><INPUT TYPE="radio" NAME="manager" VALUE="TRUE"></TD>
        <TD COLSPAN=2></TD>
      </TR>
      <TR>
        <TD>Coxwain</TD>
        <TD><INPUT TYPE="radio" NAME="coxwain" VALUE="FALSE" checked></TD>
        <TD><INPUT TYPE="radio" NAME="coxwain" VALUE="TRUE"></TD>
        <TD COLSPAN=2></TD>
      </TR>
      <TR>
        <TD>Instructor</TD>
        <TD><INPUT TYPE="radio" NAME="instructor" VALUE="FALSE" checked></TD>
        <TD><INPUT TYPE="radio" NAME="instructor" VALUE="TRUE"></TD>
        <TD COLSPAN=2></TD>
      </TR>

      </TBODY></TABLE>
      <input type="submit" value="Submit">
    </form>
