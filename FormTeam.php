<?php
session_start();
?>


<!DOCTYPE html>
<html>
<title>Home Work 1</title>
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
      <a href='\login.html' target='_self' class="w3-bar-item w3-button w3-light-grey">Login</a>
      <a href='\registration.html' target='_self' class="w3-bar-item w3-button">Register</a>
    </div>
</header>

<body>

<?php
try {
$connect = new PDO("sqlsrv:server = tcp:ahmaddbserver.database.windows.net,1433; Database = CCours", "Ahmad", "Ayham123456789");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}



$sel = "SELECT * FROM Players";

$return_user=$connect->query($sel);
 
if (!$return_user) {
        exit( "Data query error:".$connect->error );
    }

    if ($return_user->fetchColumn() > 0) {
echo "<html><body>";
echo " <form action='AddTeam.php' method='POST'> ";
echo "Welcome " . $_SESSION["User_Name"]." ".$_SESSION["User_ID"]. ".<br>";
echo "<table><tr><th></th><th>Player Name</th><th>Team</th> <th>Position</th></tr>";
foreach ($connect->query($sel) as $namerow ){
     echo "<tr>";
       echo "<td> <input type='checkbox' name='Players[]' value='".$namerow[ "id" ]."'></td>";
       echo "<td> ".$namerow[ "player_name" ]." </td><td>".$namerow[ "player_team" ]." </td><td>".$namerow[ "player_position" ]."</td>";
     echo "</tr>";
 }
echo "<tr> <td> <input type='submit' value='Add My Team' name='submit'</td> </tr> <tr><br></tr>";
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

