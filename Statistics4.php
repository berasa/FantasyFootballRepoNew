<?php
session_start();
?>


<!DOCTYPE html>
<html>
<title>Fantasy Football Game</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1 {font-family: "Raleway", Arial, sans-serif}
h1 {letter-spacing: 6px}
.w3-row-padding img {margin-bottom: 12px}
</style>

<!-- Header -->
<header class="w3-panel w3-center w3-opacity" style="padding:128px 16px">
  <h1 class="w3-xlarge">Fantasy Football Project</h1>
  <h1>Cloud Computing Course</h1>
  
    <div class="w3-bar w3-border">
      <a href='\main.php' target='_self' class="w3-bar-item w3-button">Home</a>
      <a href='\FormTeam.php' target='_self' class="w3-bar-item w3-button">Add Team</a>
      <a href='\Statistics.php' target='_self' class="w3-bar-item w3-button">Players Statistics(RB)</a>
      <a href='\Statistics2.php' target='_self' class="w3-bar-item w3-button">Players Statistics(QB)</a>
      <a href='\Statistics3.php' target='_self' class="w3-bar-item w3-button">Players Statistics(TE)</a>
      <a href='\Statistics4.php' target='_self' class="w3-bar-item w3-button">Players Statistics(WR)</a>
     <a href='\TeamRank.php' target='_self' class="w3-bar-item w3-button">Team Scores</a>
      <a href='\MyTeam.php' target='_self' class="w3-bar-item w3-button">MyTeam</a>

    </div>
<br>
<?php

echo "<span style=\"color:Blue;text-align:center;\">Hello: ";
echo $_SESSION["User_name"];
echo"</span>";
?>

<style>
table {
  border-spacing: 10;
  width: 50%;
  border: 1px solid #ddd;
  margin: 15px;
  margin-left: auto;
  margin-right: auto;

}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 12px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
#myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 50%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
  margin-left: 320px;
  margin-right: auto;

}

</style>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function sortTable2(n) {
  var table, rows, switching1, i, x, y, shouldSwitch1;
  table = document.getElementById("myTable2");
  switching1 = true;
  while (switching1) {
    switching1 = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch1 = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];														 
      if (Number(x.innerHTML) > Number(y.innerHTML)) {										   
        shouldSwitch1 = true;
        break;		 
      }
    }
    if (shouldSwitch1) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching1 = true;
    }
  }
}

function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

</script>


</header>

<body>

<?php
try {
$connect = new PDO("sqlsrv:server = tcp:falcondbserver.database.windows.net,1433; Database = CCourse", "ahmad", "Ayham123456789");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}



$sel = "SELECT * FROM player_details WHERE FantPosition='WR'";

$return_user=$connect->query($sel);
 
if (!$return_user) {
        exit( "Data query error:".$connect->error );
    }

    if ($return_user->fetchColumn() > 0) {
echo "<html><body>";
echo " <form action='' method='POST'> ";
echo "<input  type=\"text\" id=\"myInput\" onkeyup=\"myFunction()\" placeholder=\"Search for Player Name..\">";
echo "<table id=\"myTable2\"><tr><th onclick=\"sortTable2(0)\">Rank</th><th onclick=\"sortTable(1)\">Player Name</th><th onclick=\"sortTable(2)\">Team</th> <th>Position</th><th onclick=\"sortTable2(4)\">Receving Yds</th><th onclick=\"sortTable2(5)\">Receving TD</th><th onclick=\"sortTable2(6)\">Rec</th><th onclick=\"sortTable2(7)\">Y/R</th></tr>";
foreach ($connect->query($sel) as $namerow ){
     echo "<tr>";
       echo "<td> ".$namerow[ "PosRank" ]."</td>";
       echo "<td> ".$namerow[ "Player" ]." </td><td>".$namerow[ "TeamName" ]." </td><td>".$namerow[ "FantPosition" ]."</td>";
       echo "<td>".$namerow[ "ReceivingYds" ]." </td><td>".$namerow[ "RecevingTD" ]." </td><td>".$namerow[ "Receptions" ]." </td><td>".$namerow[ "ReceivingYdsperattempt" ]." </td>";


     echo "</tr>";
 }
echo "</table>";
echo"</html></body>";
    } else {
        die('An error occurred.  Username or Password error.');      
    }




    $query->free();
    $connect->close();
?>
<body>
<br><br>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-large"> 

  <p>Powered by Group2</a></p>
</footer>

</body>
</html>

