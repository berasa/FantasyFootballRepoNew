<?php
// Start the session
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


if(isset($_POST['Login'])) {
  
  $password=$_POST['pass'];
  $user_name=$_POST['user'];

$sel = "SELECT * FROM login
WHERE (username = '$user_name' AND password ='$password')";

$return_user=$connect->query($sel);
 
if (!$return_user) {
        exit( "Data query error:".$connect->error );
    }

    if ($return_user->fetchColumn() > 0) {
foreach ($connect->query($sel) as $namerow ){
        echo "<p> Hello ".$namerow[ "first_name" ]." ".$namerow[ "last_name" ]." </p> Your Email= ".$namerow[ "email" ]."</p>";
       $_SESSION["User_ID"] = $namerow[ "id" ];
       $_SESSION["User_Name"] = $namerow[ "username" ];

            }

    } else {
        die('An error occurred.  Username or Password error.');      
    }

}


    $query->free();
    $connect->close();
?>

<br><br>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-large"> 

  <p>Powered by Group2</a></p>
</footer>

</body>
</html>

