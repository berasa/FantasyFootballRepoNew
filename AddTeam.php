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
h1 {letter-spacing: 6px; }
h2 { text-align: center;}

.w3-row-padding img {margin-bottom: 12px}

</style>

<style>
table {
  border-spacing: 10;
  width: 50%;
  border: 1px solid #ddd;
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


<!-- Header -->
<header class="w3-panel w3-center w3-opacity" style="padding:128px 16px">
  <h1 class="w3-xlarge">Fantasy Football Project</h1>
  <h1>Cloud Computing Course</h1>
  
  <div class="w3-padding-32">
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


if(isset($_POST['submit'])) {
  $participant_id=$_SESSION["User_ID"];
  $Select_team_Err=0;

if (empty($_POST['Players']) || count($_POST['Players'])<6 || count($_POST['Players'])>6){
$Select_team_Err=1;
echo "<p> Your team shoulde have 6 players</p>";
}

else{
$PL_id = implode(",",$_POST['Players']);

$selquery1="SELECT COUNT(*) FROM player_details WHERE Rk IN ($PL_id) AND FantPosition='RB'";
$result1=$connect->query($selquery1);
$selquery2="SELECT COUNT(*) FROM player_details WHERE Rk IN ($PL_id) AND FantPosition='WR'";
$result2=$connect->query($selquery2);
$selquery3="SELECT COUNT(*) FROM player_details WHERE Rk IN ($PL_id) AND FantPosition='QB'";
$result3=$connect->query($selquery3);
$selquery4="SELECT COUNT(*) FROM player_details WHERE Rk IN ($PL_id) AND FantPosition='TE'";
$result4=$connect->query($selquery4);

 if ($result1->fetchColumn() <2) {
     $Select_team_Err=1;
      echo "<p></p> Your team should have 2 RB</p>";
    }
 if ($result2->fetchColumn() <2) {
      $Select_team_Err=1;
      echo "<p></p> Your team should have 2 RW</p>";
    }
 if ($result3->fetchColumn() <1) {
     $Select_team_Err=1;
      echo "<p></p> Your team should have 1 QB</p>";
    }
 if ($result4->fetchColumn() <1) {
      $Select_team_Err=1;
      echo "<p></p> Your team should have 1 TE</p>";
    }

}

if ($Select_team_Err==0){
echo"<h2>Your Team</h2>";
$selPlayer="SELECT Player,FantPosition,TeamName FROM player_details WHERE Rk IN ($PL_id)";

echo "<table><tr><th>Player Name</th><th>Team</th> <th>Position</th></tr>";
foreach ($connect->query($selPlayer) as $namerow ){
     echo "<tr>";
       echo "<td> ".$namerow[ "Player" ]." </td><td>".$namerow[ "TeamName" ]." </td><td>".$namerow[ "FantPosition" ]."</td>";
     echo "</tr>";
 }
echo "</table>";
$sql="{CALL AddTeam(?,?)}";
$sqlQuery=$connect->prepare($sql);
foreach($_POST['Players'] AS $p_id){ 
  $sqlQuery->bindParam(1, $p_id, PDO::PARAM_INT);
  $sqlQuery->bindParam(2, $participant_id, PDO::PARAM_INT);
  $sqlQuery->execute();
}


    $sqlQuery->free();
    $connect->close();
}
}
?>

<body>



<br><br>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-large"> 

  <p>Powered by Group2</a></p>
</footer>

</body>
</html>
