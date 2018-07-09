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
                echo "\t<select name='Cox2IC'>\n";
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
            <input type="number" name="RunningHours" step="0.1" min="0" max="500" required>
          </TD>
        </TR>
        <TR>
          <TD>Approximate Fuel Usage</TD><TD></TD>
          <TD ColSpan=2>
            <input type="number" name="FuelUsage" step="1" min="0" max="500" required>
          </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Number of Flares Used
            <span class="tooltiptext">
             Used is bad <BR>
            </span>
           </div>
          </TD><TD></TD>
          <TD ColSpan=2> <input type="number" name="FlaresUsed" step="1" min="0" max="50" required></TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Spare Fuel Used
            <span class="tooltiptext">
              If any fuel from the Red spare fuel contrainer was used please state howmuch and fill in more details below
            </span>
           </div>
          </TD><TD></TD>
          <TD ColSpan=2>
            <input type="number" name="FuelUsage" step="1" min="0" max="500" required>
          </TD>
        </TR>
        <TR><TD ColSpan=4>&nbsp;</TD></TR>
        <TR><TD ColSpan=2></TD><TD><font color="green">Good</font></TD> <TD><font color="red">Bad</font></TD> </TR>
        <TR>
          <TD>
           <div class="tooltip">Engine Rinsed for 5 mins
            <span class="tooltiptext">
              Remove plug from side of Engine<BR>
              Screw in hose attachment plug and attach hose<BR>
              Run fresh water from hose through engine for 5 mins<BR>
              Replace origional plug back into engine
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='Rinsed5Mins' value='good' /> </TD>
          <TD> <input type='radio' name='Rinsed5Mins' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>Engine Anodes have wear</TD><TD></TD>
          <TD><input type='radio' name='EngineAnodesWorn' value='good' /> </TD>
          <TD> <input type='radio' name='EngineAnodesWorn' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Engine Oil Level
            <span class="tooltiptext">
              Ensure engine has been lowered for atleast 10 mins so all the oil has settled in the sump<BR>
              Remove Engine Cover<BR>
              Remove dipstick on right hand side of the engine to check oil level<BR>
              Ensure Oil level should be between the notches cut out of the dipstick<BR>
              Replace Dipstick then replace Engine Cover.
            </span>
           </div>
          </TD><TD></TD>
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
          <TD>
           <div class="tooltip">Main Isolator Off
            <span class="tooltiptext">
              Main Isolator is located in the console.<BR>
              Switch to Off position
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='IsolatorOff' value='good' /> </TD>
          <TD> <input type='radio' name='IsolatorOff' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Console Hatch Open and Duck Oiled
            <span class="tooltiptext">
              Open Hatch in left side of Console<BR>
              Lightly spray electrical connections with Duck Oil<BR>
              Leave hatch open so no condensation will form
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='ConsoleHatch' value='good' /> </TD>
          <TD> <input type='radio' name='ConsoleHatch' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Electronics Wiped Down
            <span class="tooltiptext">
              GPS and Radio: Wipe with a cloth damped with fresh water<BR>
              Dry off with a towel<BR>
              DO NOT HOSE DOWN
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='ElectronicsDried' value='good' /> </TD>
          <TD> <input type='radio' name='ElectronicsDried' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">O2 Set Used
            <span class="tooltiptext">
              Ensure O2 set is full. Ensure Diving Officer has been made aware if the O2 set has been used or is otherwise not full
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='O2Used' value='good' /> </TD>
          <TD> <input type='radio' name='O2Used' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">GPS Plotter Used and Working Correctly
            <span class="tooltiptext">
              Was the GPS used and was it working as expected
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='GPSUsed' value='good' /> </TD>
          <TD> <input type='radio' name='GPSUsed' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Hand Held GPS
            <span class="tooltiptext">
              Was the Hand Held GPS switched on and checked to see that it works as expected
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='HHGPSChecked' value='good' /> </TD>
          <TD> <input type='radio' name='HHGPSChecked' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Boat Radio
            <span class="tooltiptext">
              Was the Boat Radio used and was it working as expected. The one permenantly attached to the boat.
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='BoatRadio' value='good' /> </TD>
          <TD> <input type='radio' name='BoatRadio' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Hand Held Marine Radio
            <span class="tooltiptext">
              Was the hand held Radio switched on and was it working as expected.
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='HHRadio' value='good' /> </TD>
          <TD> <input type='radio' name='HHRadio' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Boat Cover On and Secured
            <span class="tooltiptext">
              Was the Boat Cover attached and secured
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='BoatCovered' value='good' /> </TD>
          <TD> <input type='radio' name='BoatCovered' value='bad' checked="checked"/> </TD>
        </TR>
        <TR>
          <TD>
           <div class="tooltip">Lines, Bouys, Shot, Fenders
            <span class="tooltiptext">
              Bad: <BR>Any Lines, Buoys, Shot or weight were Lost / Damaged / Destroyed<BR>
              Good:<BR>
               - 1x Show weight, 1x White plastic drum float, 1x float for 'tail'<BR>
               - Shot lines : 2x 20, 1 x 10m, 1x 30m<BR>
               - Boat Lines : 1 x Bow Line, 2x Stern Lines, 2x White Fenders, 2x Blue Fenders<BR>
            </span>
           </div>
          </TD><TD></TD>
          <TD> <input type='radio' name='BoatLines' value='good' /> </TD>
          <TD> <input type='radio' name='BoatLines' value='bad' checked="checked"/> </TD>
        </TR>


        <TR ><TD BGCOLOR="#3399ff" ColSpan=4>&nbsp;</TD></TR>

        <TR><TD Colspan=4>Other Comments</TD></TR>
        <TR><TD Colspan=4> <TEXTAREA name="OtherComments" rows="10" cols="80">The Boat Sank</TEXTAREA></TD> </TD>
        </TR>

      </TBODY>
    </TABLE>
    <INPUT type="submit" value="Submit">
  </FORM>

