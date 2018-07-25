  <H1>New Dive Form</H1>
  <form name='NewDive' method='post' action=" <?php echo $_SERVER['PHP_SELF'] ?> ">
    <TABLE><TBODY>
      <TR><TD></TD><TD></TD><TD WIDTH=60></TD><TD></TD><TD></TD></TR>
      <TR><TD WIDTH=120>&nbsp;</TD><TD></TD><TD WIDTH=105>&nbsp;</TD><TD></TD><TD></TD></TR>
      <TR><TD>Enter Dive Date</TD><TD ColSpan=4><input type='date' name='divedate' required ></TD></TR>
      <TR><TD>Depth</TD><TD ColSpan=4><input type="number" name="depth" step="0.1" min="0" max="50"></TD></TR>
      <TR><TD>Time</TD><TD ColSpan=4><input type="number" name="time" step="1" min="0" max="90"></TD></TR>
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
        <TD>Select Dive Site</TD>
        <TD ColSpan=4>
          <SELECT NAME='dive_site'>
          <?php
            $sql_select = "select site_id,site_name from sites where port is false order by site_name";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['site_id'] . '">' . $row['site_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
      </TR>
      <TR>
        <TD>Instructional Dive?</TD>
        <TD ColSpan=4>
          <SELECT NAME='instructional'>
          <OPTION VALUE='1'>This dive was Recreational</OPTION>
          <?php
            $sql_select = "select educational_types_id,instructional_name from educational_types where educational_types_id > 1 order by instructional_description";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['educational_types_id'] . '">' . $row['instructional_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>

      </TR>

      <TR><TD ColSpan=5>&nbsp;</TD></TR>
      <TR><TD ColSpan=2><TD>GAS</TD><TD>Instructional Role (if Applicable)</TD><TD></TD></TR>
      <TR>
        <TD>Select Diver 1</TD>
        <TD>
          <SELECT NAME='diver_one'>
          <?php
            $sql_select = "select diver_id,diver_name from divers order by diver_name";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['diver_id'] . '">' . $row['diver_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD>
          <SELECT NAME='diver_one_gas'>
          <?php
            $sql_select = "select gas_id,gas_name from gas order by gas_id";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['gas_id'] . '">' . $row['gas_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD>
          <?php
            $sql_select = "select instructional_roles_id,instructional_role from instructional_roles where instructional_role = 'Instructor'";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<INPUT TYPE="HIDDEN" NAME="diver_one_role" VALUE="'. $row['instructional_roles_id'] . '">Instructor'."\n";
              }
            }
          ?>
        </TD>
        <TD></TD>
      </TR>

      <TR>
        <TD>Select Diver 2</TD>
        <TD>
          <SELECT NAME='diver_two'>
          <?php
            $sql_select = "select diver_id,diver_name from divers order by diver_name";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['diver_id'] . '">' . $row['diver_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD>
          <SELECT NAME='diver_two_gas'>
          <?php
            $sql_select = "select gas_id,gas_name from gas order by gas_id";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['gas_id'] . '">' . $row['gas_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD>
          <SELECT NAME='diver_two_role'>
          <?php
            $sql_select = "select instructional_roles_id,instructional_role from instructional_roles where instructional_role != 'Instructor' order by instructional_roles_id";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['instructional_roles_id'] . '">' . $row['instructional_role'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD></TD>
      </TR>
      <TR>
        <TD>Select Diver 3</TD>
        <TD>
          <SELECT NAME='diver_three'>
          <OPTION VALUE='0'>No Third Diver</OPTION>
          <?php
            $sql_select = "select diver_id,diver_name from divers order by diver_name";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['diver_id'] . '">' . $row['diver_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD>
          <SELECT NAME='diver_three_gas'>
          <?php
            $sql_select = "select gas_id,gas from gas_name order by gas_id";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['gas_id'] . '">' . $row['gas_name'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD>
          <SELECT NAME='diver_three_role'>
          <?php
            $sql_select = "select instructional_roles_id,instructional_role from instructional_roles where instructional_role != 'Instructor' order by instructional_roles_id";
            $sql_data = $conn->query($sql_select);
            if ($sql_data->num_rows > 0) {
              while($row = $sql_data->fetch_assoc()) {
                echo "\t\t" . '<OPTION VALUE="' . $row['instructional_roles_id'] . '">' . $row['instructional_role'] . "</OPTION>\n";
              }
            }
          ?>
          </SELECT>
        </TD>
        <TD></TD>
      </TR>
      </TBODY></TABLE>
      <input type="submit" value="Submit">
    </form>
