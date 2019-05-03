<html lang="en">
<head>
  <title>Schedule</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- standard Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- CSS overrides sheet -->
  <link rel="stylesheet" type="text/css" href="generalStyle.css">
  <link rel="stylesheet" type="text/css" href="puckStyle.css">

  <!--interact.js import-->
  <script src="https://cdn.jsdelivr.net/npm/interactjs@1.3.4/dist/interact.min.js"></script>

  <!--jQuery imports -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- script references -->
  <script src="puckScripts.js"></script>
  <script src="generalScripts.js"></script>

</head>

<body>
  <!--Navbar div-->
  <div id="navigation"></div>
  <!--left side palette div-->
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
      //creates source pucks in the palette div
      echo("<div id=\"palette\">");
      while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo("<div class= \"source\" style=\"background-color:".$row["background"]."\">" );
          // ;color:".$row["font"]."
        echo("<div class= \"puck-name\" >".strtoupper($row["lname"])."</div>" );
        echo("<div class= \"puck-syllabus\" >".$row["fltIDCompleted"]."</div>" );
        echo("<div class= \"puck-warning\" > </div>");
        echo("</div>");

          //echo ("<tr><td>".$row["pilotID"]."</td><td>".$row["lName"]."</td><td>".$row["fName"]."</td><td>".$row["rank"]."</td><td>".$row["callSign"]."</td></tr>");
      }
      echo("</div>");
      sqlsrv_free_stmt($getResults);
  ?>
  <!--Schedule container start-->
  <div id="schedule" class="container-fluid">
    <!--days of schedule containers-->
    <div class="column">
      <div class="title-box">
        <b>Monday</b>
      </div>
      <div class="slot">
        <div class="slot-line"><b>301</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">LASDT-2<br>8xBDL50</div>
          <div class="slot-ship">4</div>
          <div class="slot-times">T: 1315<br>L: 1500</div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>302</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>303</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>304</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>305</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>306</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>307</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>308</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>309</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>310</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>311</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>312</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>313</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>314</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>315</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>316</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>317</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>318</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="title-box">
        <b>Tuesday</b>
      </div>
      <div class="slot">
        <div class="slot-line"><b>301</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>302</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>303</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>304</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>305</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>306</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>307</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>308</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>309</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>310</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>311</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>312</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>313</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>314</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>315</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>316</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>317</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>318</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="title-box">
        <b>Wednesday</b>
      </div>
      <div class="slot">
        <div class="slot-line"><b>301</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>302</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>303</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>304</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>305</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>306</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>307</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>308</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>309</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>310</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>311</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>312</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>313</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>314</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>315</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>316</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>317</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>318</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="title-box">
        <b>Thursday</b>
      </div>
      <div class="slot">
        <div class="slot-line"><b>301</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>302</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>303</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>304</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>305</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>306</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>307</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>308</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>309</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>310</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>311</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>312</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>313</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>314</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>315</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>316</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>317</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>318</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="title-box">
        <b>Friday</b>
      </div>
      <div class="slot">
        <div class="slot-line"><b>301</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>302</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>303</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>304</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>305</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>306</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>307</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>308</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>309</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>310</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>311</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>312</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>313</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>314</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>315</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>316</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>317</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
      <div class="slot">
        <div class="slot-line"><b>318</b></div>
        <div class="slot-pilots"><div class="slot-pilot"></div><div class="slot-pilot"></div></div>
        <div class="slot-specifics">
          <div class="slot-mission">____</div>
          <div class="slot-ship"></div>
          <div class="slot-times"></div>
        </div>
      </div>
    </div>
    <div class="popbox">
      <div class="input-line">Mission: <input type="text" id="Mission" value=""></div>
      <div class="input-line">Mission Size: <input type="text" id="Mission-Size" value=""></div>
      <div class="input-line">Takeoff: <input type="text" id="Takeoff" value=""></div>
      <div class="input-line">Land: <input type="text" id="Land" value=""></div>
      <div class="input-line">Notes: <input type="text" id="Notes" value=""></div>
      <button type="button" onclick="flushPopbox()"> Done </button>
  </div>
    <!-- popbox changes -->
    <!-- may need to adjust everything to be form types
    Mission:
    <input type="radio" id="mission1" name="mission" value="SAN-1"><label for="mission1" class="btn mission">SAN-1</label></input>
    <input type="radio" id="mission2" name="mission" value="LASDT-2"><label for="mission2" class="btn mission">LASDT-2</label></input>
      <br />
    Config:
      <input type="radio" id="config1" name="config" value="COLD GUN"><label for="config1" class="btn config">COLD GUN</label></input>
      <input type="radio" id="config2" name="config" value="8xBDL50"><label for="config2" class="btn config">8xBDL50</label></input>
      <br />
    Airspace:
      <input type="radio" id="airspace1" name="airspace" value="BURNER HI"><label for="airspace1" class="btn airspace">BURNER HI</label></input>
      <input type="radio" id="airspace2" name="airspace" value="BURNER LOW"><label for="airspace2" class="btn airspace">BURNER LOW</label></input>
      <input type="radio" id="airspace3" name="airspace" value="W-122: 1-7"><label for="airspace3" class="btn airspace">W-122: 1-7</label></input>
      <br /-->
  </div>
</body>
</html>
