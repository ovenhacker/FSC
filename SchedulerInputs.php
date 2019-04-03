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
    <p>Consolidated input page for testing</p>
  </div>

  <div class="container">

    <form>
      <fieldset>
        <legend>Manual inputs</legend>
        <p>
          <label>Pilots</label>
          <form action="php/submitPilot.php" method="post">
            <label for="file">Choose a file:</label>
            <input type="file" name="pilotList"
              accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
            <input type="submit" value ="Update" action="php/submitPilot.php" />


          <!--<input id="studentList" type="file"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
          <button class ="submit" onclick="updatePilots(studentList)" >Update</button>-->
          </form>


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
    <table cellpadding="4">

    <?php
      $serverName = "pucc.database.windows.net";
      $connectionOptions = array(
          "Database" => "PUCC DB",
          "Uid" => "mowag",
          "PWD" => "DaMcCoVa&WaGu"
      );
      //Establishes the connection
      $conn = sqlsrv_connect($serverName, $connectionOptions);

      $tsql= "SELECT * FROM pilot";
      $getResults= sqlsrv_query($conn, $tsql);
      echo ("Reading data from table" . PHP_EOL);
      echo "<br />";
      echo "<tr><th> Pilot ID </th><th> Last Name </th><th> First Name </th><th> Call Sign </th><th> Rank </th></tr>";
      if ($getResults == FALSE)
          echo (sqlsrv_errors());
      while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
       //echo ($row['pilotID'] . " " . $row['fName'] . " " . $row['lName'] . " " . $row['callSign'] . " " . $row['rank'] . PHP_EOL);
       echo ("<tr><td>".$row["pilotID"]."</td><td>".$row["lName"]."</td><td>".$row["fName"]."</td><td>".$row["rank"]."</td><td>".$row["callSign"]."</td></tr>");
      }
      sqlsrv_free_stmt($getResults);
    ?>
    </table>

  </div>

</body>
</html>
