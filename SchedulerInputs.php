<html lang="en">
<head>
  <title>Scheduler Inputs</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- standard Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- CSS overrides sheet -->
  <link rel="stylesheet" type="text/css" href="generalStyle.css">

  <!--jQuery imports -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- script references -->
  <script src="generalScripts.js"></script>

</head>

<body>
  <!--Navbar div-->
  <div id="navigation"></div>

  <div class="container">
    <h3>Enter All Inputs Here!</h3>
    <p>This is mainly a testing page for all the inputs so they are consolidated,
      this is also a potential look at how this website would be if instead of
      other people entering inputs, the scheduler input everything.</p>
  </div>

  <div class="container">
    <p>Input instructors</p>
    <p>Input students (including which flight they are on)(csv) (name,course,fl#)</p>
    <p>Input syllabus for each course(csv) (including needed configs)</p>
    <p>Input which airspaces are available</p>

    <form>
      <fieldset>
        <legend>Manual inputs</legend>
        <p>
          <label>Pilots</label>
          <input id="studentList" type="file"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
          <button class ="submit" onclick="submitPilots()">Update</button>

        </p>
        <p>
          <label>Airspace</label>
          <input id="availableAirspace" type="file"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
        </p>
        <p>
          <label>Currencies? Wondering if this should be separate from the pilots</label>
          <input id="currencies" type="file"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
        </p>
        <p>
          <label>Syllabus</label>
          <input id="syllabus" type="file"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
        </p>
      </fieldset>
    </form>
  </div>

  <div class="container">
    <p>3.34</p>

    <!-- Testing -->
    <?php
      $serverName = "pucc.database.windows.net"; // update me
      $connectionOptions = array(
          "Database" => "PUCC DB", // update me
          "Uid" => "mowag", // update me
          "PWD" => "DaMcCoVa&WaGu" // update me
      );
      //Establishes the connection
      $conn = sqlsrv_connect($serverName, $connectionOptions);
      $tsql= "SELECT * FROM pilotShort";
      $getResults= sqlsrv_query($conn, $tsql);
      echo ("Reading data from table" . PHP_EOL);
      echo "<br />";
      if ($getResults == FALSE)
          echo (sqlsrv_errors());
      while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
       echo ($row['pilotID'] . " " . $row['fName'] . " " . $row['lName'] . " " . $row['callSign'] . " " . $row['rank'] . PHP_EOL);
      }
      sqlsrv_free_stmt($getResults);
    ?>




    <!-- this is for testing the databse contection -->
    <!-- display of the suggestions -->
		<table cellpadding="4">




			<!--
        // PHP Data Objects(PDO) Sample Code:
        try {

          $conn = new PDO("sqlsrv:server = tcp:pucc.database.windows.net,1433; Database = PUCC DB", "mowag", "DaMcCoVa&WaGu");
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "try";
        }
        catch (PDOException $e) {
          echo "catch";
          print("Error connecting to SQL Server.");
          die(print_r($e));
        }

  			// run the SQL query to retrieve the lastest changed entity
        $query = "SELECT * FROM pilotShort"; // maybe add dbo.pilotShort
  			$results = $conn->query($query);

        echo ("Reading data from table" . PHP_EOL);
        if ($results == FALSE)
            echo (sqlsrv_errors());

        // print "<tr> <th>Pilot ID</th> <th>First Name</th> <th>Last Name</th> <th> Call Sign</th> <th> Rank</th> </tr>";

        while($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
            echo "ahhhh";
            echo "<tr><td>".$row["pilotID"]."</td><td>".$row["fName"]." ".$row["lName"]."</td></tr>".$row["callSign"]."</td><td>".$row["rank"]."</td></tr>";
        }

        // loop through each row building the table rows and data columns
        //if ($result->num_rows > 0) {
        //    echo "<p> there is something </p>";
        //    // output data of each row
        //    while($row = $result->fetch_assoc()) {
        //        print "<tr><td>".$row["pilotID"]."</td><td>".$row["fName"]." ".$row["lName"]."</td></tr>".$row["callSign"]."</td><td>".$row["rank"]."</td></tr>";
        //    }
        //    echo "</table>";
        //} else {
        //    echo "0 results";
        //}

        sqlsrv_free_stmt($results);

  			// deallocate memory for the results and close the database connection
  			// $results->free();
  			$conn->close();
        echo "end";
			?> -->

		</table>
  </div>

</body>
</html>
