  <H1>New Boat Report</H1>
  <?php
    require '../../db.inc.php';
    $conn = new mysqli($host, $username, $password, $db_name);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn,"utf8");
  ?>
  <form name='BoatReport' method='post' action=" <?php echo $_SERVER['PHP_SELF'] ?> ">
    <TABLE>
      <TBODY>
        <TR><TD></TD><TD Width=10></TD><TD></TD></TR>
        <TR><TD Align=middle>Start Date</TD><TD></TD><TD align=middle>End Date</TD></TR>
        <TR>
          <TD><INPUT type='date' name='ReportStartDate' required ></TD>
          <TD></TD>
          <TD><INPUT type='date' name='ReporEndtDate' required ></TD>
        </TR>
      </TBODY>
    </TABLE>
    <BR>
    <BR>

    <TABLE>
      <TBODY>
        <TR><TD></TD><TD Width=10></TD><TD></TD><TD></TD></TR>
        <TR>
          <TD>Dive Manager :</TD><TD></TD>
          <TD ColSpan=2>
            <?php
              $sql_select = "select diver_id,diver_name from divers where manager is true order by diver_name";
              $sql_data = $conn->query($sql_select);
              if ($sql_data->num_rows > 0) {
                echo "\t<select name='DiveManager'>\n";
                while($row = $sql_data->fetch_assoc()) {
                  echo "\t\t" . '<option value="' . $row['diver_id'] . '">' . $row['diver_name'] . "</option>\n";
                }
                echo "\t</select>\n";
              }
            ?>
          </TD>
        </TR>
        <TR>
          <TD>Port :</TD><TD></TD>
          <TD ColSpan=2>
            <?php
              $sql_select = "select site_id,site_name from sites where port is true";
              $sql_data = $conn->query($sql_select);
              if ($sql_data->num_rows > 0) {
                echo "\t<select name='Port'>\n";
                while($row = $sql_data->fetch_assoc()) {
                  echo "\t\t" . '<option value="' . $row['site_id'] . '">' . $row['site_name'] . "</option>\n";
                }
                echo "\t</select>\n";
                echo '<BR>';
              }
            ?>
          </TD>
        </TR>
        <TR>
          <TD>2ic / Cox :</TD><TD></TD>
          <TD ColSpan=2>
            <?php
              $sql_select = "select diver_id,diver_name from divers where cox is true order by diver_name";
              $sql_data = $conn->query($sql_select);
              if ($sql_data->num_rows > 0) {
                echo "\t<select name='DiveManager'>\n";
                while($row = $sql_data->fetch_assoc()) {
                  echo "\t\t" . '<option value="' . $row['diver_id'] . '">' . $row['diver_name'] . "</option>\n";
                }
                echo "\t</select>\n";
              }
            ?>
          </TD>
        </TR>
        <TR>
          <TD>Engine Hours :</TD><TD></TD>
          <TD ColSpan=2>
            <input type="number" name="RunningHours" step="0.1" min="0" max="500">
          </TD>
        </TR>
        <TR>
          <TD>Approximate Fuel Usage</TD><TD></TD>
          <TD ColSpan=2>
            <input type="number" name="FuelUsage" step="1" min="0" max="500">
          </TD>
        </TR>
        <TR> <TD></TD><TD></TD> <TD><font color="green">Good</font></TD> <TD><font color="red">Bad</font></TD> </TR>
        <TR>
          <TD>Engine Rinsed for 5 mins </TD><TD></TD>
          <TD> <input type='radio' name='Rinsed5Mins' value='good' /> </TD>
          <TD> <input type='radio' name='Rinsed5Mins' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>Engine Anodes have wear</TD><TD></TD>
          <TD><input type='radio' name='EngineAnodesWorn' value='good' /> </TD>
          <TD> <input type='radio' name='EngineAnodesWorn' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>Engine Oil Level</TD><TD></TD>
          <TD> <input type='radio' name='EngineOilLevel' value='good' /> </TD>
          <TD> <input type='radio' name='EngineOilLevel' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Engine Duck Oiled
            <span class="tooltiptext">
              Remove engine cover<BR>
              Spray engine liberally with Duck Oil<BR>
              Curse verbosely from hands getting covered in Duck Oil<BR>
              Wash or wipe hands on anything handy<BR>
              Replace Engine Cover<BR>
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='EngineDuckOiled' value='good' /> </TD>
          <TD> <input type='radio' name='EngineDuckOiled' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Boat Washed
            <span class="tooltiptext">
              Wash inside and tubes with fresh water and 'fairy' liquid.<BR>
              Rinse<BR>
              Then drain off using bilge pumps
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='BoatWashed' value='good' /> </TD>
          <TD> <input type='radio' name='BoatWashed' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD> :</TD><TD></TD>
          <TD>
          </TD>
        </TR>
        <TR>
          <TD> :</TD><TD></TD>
          <TD>
          </TD>
        </TR>
        <TR>
          <TD> :</TD><TD></TD>
          <TD>
          </TD>
        </TR>
        <TR>
          <TD> :</TD><TD></TD>
          <TD>
          </TD>
        </TR>

      </TBODY>
    </TABLE>
    <INPUT type="submit" value="Submit">
  </FORM>

