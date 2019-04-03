<!-- submitPilots.php -->
<!-- this is where the submitted file gets uploaded to the database -->

<?php
  start_session(); // creates a secure space to load and access things like user and password...
  $serverName = "pucc.database.windows.net";
  $connectionOptions = array(
      "Database" => "PUCC DB",
      "Uid" => "mowag",
      "PWD" => "DaMcCoVa&WaGu"
  );
  //Establishes the connection
  $conn = sqlsrv_connect($serverName, $connectionOptions);


  $tsql= "INSERT INTO pilot VALUES (5, 'TRYING', 'DID THIS WORK?', 'HELP', 'Cpt','y','f','B','I','N/A');";
  $getResults = sqlsrv_query($conn, $tsql);

  if ($getResults == FALSE)
      echo (sqlsrv_errors());
  while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
   //echo ($row['pilotID'] . " " . $row['fName'] . " " . $row['lName'] . " " . $row['callSign'] . " " . $row['rank'] . PHP_EOL);
  }

  echo $getResults;

  sqlsrv_free_stmt($getResults);

 ?>
