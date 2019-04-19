<!-- This is all very rough, but is approximately what is needed
  need to have the name and stuff added, as well as how you want to handle the info -->

<?php
      $serverName = "pucc.database.windows.net";
      $connectionOptions = array(
          "Database" => "PUCC DB",
          "Uid" => "mowag",
          "PWD" => "DaMcCoVa&WaGu"
      );
      //Establishes the connection
      $conn = sqlsrv_connect($serverName, $connectionOptions);

      /////////////////
	  // need to first figure out how to get the name from the puck - $name
      $sql= "SELECT fltNxt, fltNxtTwo, mxConfig, formationXships, nightrq FROM pilots
				JOIN pilotFlt ON pilots.pilotID = pilotFlt.pilotID
				JOIN syllabus ON pilotFlt.fltIDCompleted = syllabus.fltID
				WHERE lname = '"+$name+"';";

	  // may not need this
	  if (sqlsrv_query($conn, $usql) == TRUE) {
      } else {
        echo "Error with DB: " . sqlsrv_errors();
      }
      /////////////////

      $getResults= sqlsrv_query($conn, $sql);
      if ($getResults == FALSE)
          echo (sqlsrv_errors());
      while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
       // parse the row of data
	   // should only be one row
      }
      sqlsrv_free_stmt($getResults);
    ?>
