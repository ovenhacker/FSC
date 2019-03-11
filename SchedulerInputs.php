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
    <!-- this is for testing the databse contection -->
    <!-- display of the suggestions -->
		<table cellpadding="4">
			<tr> <th>Pilot ID</th> <th>First Name</th> <th>Last Name</th> <th> Call Sign</th> <th> Rank</th> </tr>
			<?php

			  // open connection to the database on azure with
        $serverName = "pucc.database.windows.net";
        $connectionOptions = array(
        "Database" => "pucc",
        "Uid" => "mowag",
        "PWD" => "DaMcCoVa&WaGu" );

        //Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

  			// Check if there were error and if so, report and exit
  			if (mysqli_connect_errno()){
  				echo 'ERROR: Could not connect to database.  Error is '.mysqli_connect_error();
  				exit;
  			}


  			// run the SQL query to retrieve the lastest changed entity
  			$results = $conn->query('SELECT * FROM pilotShort order by pilotID');

  			// determine how many rows were returned allows for changing of size if desired later. also not running without the for loop.
  			$num_results = $results->num_rows;

  			// loop through each row building the table rows and data columns
        print $results->fetch_assoc();

  			//for ($i=0; $i < $num_results; $i++){
  			//	$r= $results->fetch_assoc();
  			//	print '<tr><td>'.$r['pilotID'].'</td><td>'.$r['fName'].'</td><td>'.$r['lName'].'</td><td>'.$r['callSign'].'</td><td>'.$r['rank'].'</td></tr>';
  			//}

  			// deallocate memory for the results and close the database connection
  			$results->free();
  			$conn->close();
			?>
		</table>
  </div>

</body>
</html>
