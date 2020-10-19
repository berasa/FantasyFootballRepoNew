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
table {
  border-spacing: 10;
  width: 50%;
  border: 1px solid #ddd;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 100px;  

}

body,h1 {font-family: "Raleway", Arial, sans-serif}
h1 {letter-spacing: 6px}
.w3-row-padding img {margin-bottom: 12px}
</style>

<!-- Header -->
<header class="w3-panel w3-center w3-opacity" style="padding:128px 16px">
  <h1 class="w3-xlarge">Fantasy Football Project</h1>
  <h1>Cloud Computing Course</h1>
  
  <div class="w3-padding-32">
    <div class="w3-bar w3-border">
      <a href='\main.php' target='_self' class="w3-bar-item w3-button">Home</a>
      <a href='\login.html' target='_self' class="w3-bar-item w3-button w3-light-grey">Login</a>
      

    </div>
  </div>
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
  $first_name=$_POST['name1'];
  $last_name=$_POST['name2'];
  $email=$_POST['email'];
  $password=$_POST['pass'];
  $user_name=$_POST['user'];

  $query = "insert into login (first_name,last_name,username,password,email) values
('$first_name','$last_name','$user_name','$password', '$email')";
$result=$connect->query($query);


echo"<table>";
    if (!$result) {
        die('An error occurred. Your registration has not been submitted.');
    } else {

echo "<span style=\"color:Blue;text-align:center;\"<p><center>Thanks for your registration please go to login page</center></p>";

echo"</span>";
;

      echo "<tr><td> </td></tr><tr> <td>Your First Name is:  ".$first_name." </td> <td>Your Last Name is:  ".$last_name." </td><td> Your Email is: ".$email."</td></tr>";

    }

echo"</table>";
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
