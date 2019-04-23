<!--

<div id="palette">
  <div class="source" style="background-color: yellow">
    <div class = "puck-name">JOHNSON</div>
    <div class = "puck-syllabus">LASDT-2</div>
  </div>
-->

<?php
    $serverName = "pucc.database.windows.net";
    $connectionOptions = array(
      "Database" => "PUCC DB",
      "Uid" => "mowag",
      "PWD" => "DaMcCoVa&WaGu"
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    ////////////////
	  // need to first figure out how to get the name from the puck - $name
    $sql= "EXEC prioritize_pilots_with_colors";

	  // may not need this
	  if (sqlsrv_query($conn, $usql) == TRUE) {
    } else {
      echo "Error with DB: " . sqlsrv_errors();
    }
    /////////////////

    $getResults= sqlsrv_query($conn, $sql);
    if ($getResults == FALSE)
      echo (sqlsrv_errors());

    echo("<div id="palette">");
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
      echo("<div class= \"source\" style=\"background-color: ".$row["background"]"; color: ".$row["font"]"\">" );
      echo("<div class= \"puck-name\" >".$row:["lname"]"</div>" );
      echo("<div class= \"puck-syllabus\" >".$row:["fltCompleted"]"</div>" );
      echo("</div>");

        //echo ("<tr><td>".$row["pilotID"]."</td><td>".$row["lName"]."</td><td>".$row["fName"]."</td><td>".$row["rank"]."</td><td>".$row["callSign"]."</td></tr>");
    }
    echo("</div>")
    sqlsrv_free_stmt($getResults);
?>
