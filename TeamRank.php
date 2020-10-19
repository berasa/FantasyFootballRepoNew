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
  padding: 6px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}

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

</header>

<?php

try {
$connect = new PDO("sqlsrv:server = tcp:falcondbserver.database.windows.net,1433; Database = CCourse", "ahmad", "Ayham123456789");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

try {
$sql1 = "{CALL TeamScore()}";
$stmt = $connect->query($sql1);
echo "<table><tr><th>Participant Name</th><th>Week 1</th><th>Week 2</th><th>Week 3</th><th>Week 4</th><th>Week 5</th><th>Week 6</th>";
echo "<th>Week 7</th><th>Week 8</th><th>Week 9</th><th>Week 10</th><th>Week 11</th><th>Week 12</th>";
echo "<th>Week 13</th><th>Week 14</th><th>Week 15</th><th>Week 16</th><th>Week 17</th><th>Total</th></tr>";

  while ($namerow = $stmt->fetch()) {
     echo "<tr>";
       echo "<td> ".$namerow[ "first_name" ]." </td><td>".$namerow[ "Week1" ]." </td><td>".$namerow[ "Week2" ]."</td>";
       echo "<td> ".$namerow[ "Week3" ]." </td><td>".$namerow[ "Week4" ]." </td><td>".$namerow[ "Week5" ]."</td>";
       echo "<td> ".$namerow[ "Week6" ]." </td><td>".$namerow[ "Week7" ]." </td><td>".$namerow[ "Week8" ]."</td>";
       echo "<td> ".$namerow[ "Week9" ]." </td><td>".$namerow[ "Week10" ]." </td><td>".$namerow[ "Week11" ]."</td>";
       echo "<td> ".$namerow[ "Week12" ]." </td><td>".$namerow[ "Week13" ]." </td><td>".$namerow[ "Week14" ]."</td>";
       echo "<td> ".$namerow[ "Week15" ]." </td><td>".$namerow[ "Week16" ]." </td><td>".$namerow[ "Week17" ]."</td><td>".$namerow[ "Total" ]."</td>";
       
     echo "</tr>";
  }

echo "</table>";



//do {
 //  $rows = $stmt->fetchAll(PDO::FETCH_NUM);
//   if ($rows) {
//       print_r($rows);
//   }
//} while ($stmt->nextRowset());


} catch (PDOException $e) {
   echo "Exception Occurred :" . $e->getMessage();
}


    $sqlQuery->free();
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
