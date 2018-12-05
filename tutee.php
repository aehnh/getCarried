<?php
include('config.php');
include('session.php');
$myemail = $_SESSION['login_email'];
$sql = "select * from mydb.tutee where email = '$myemail'";
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);


?>
<html>

   <head>
      <title>Welcome </title>
      <title>Welcome </title>

   </head>

   <body>
      <h1>Welcome <?php echo $myemail; ?></h1>
      <?php
      if($count == 1) {
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$name = $row['name'];
  $tuteeID = $row['TuteeID'];
	echo "name: ".$name."<br>";
	echo "email: ".$myemail."<br>";
}else {
    header("location: mydbtuteelogin.php");
}
$sql = "select * from mydb.application where TuteeID = '$tuteeID'";
$result = mysqli_query($db,$sql);
echo "My applications:<br><table><tr><td>PostID</td><td>Subject</td><td>Message</td></tr>";
while ($data = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	echo "<tr>";
  echo "<td>".$data['PostID'].".</td>";
	echo "<td>".$data['Subject']." </td>";
	echo "<td>".$data['Message']." </td>";
	echo "</tr>";
}

$sql = "select * from mydb.post";
$result = mysqli_query($db,$sql);
while ($data = mysqli_fetch_array($result)){
    $cname = $data['PID'];
  echo " <option value='$cname'>".$cname."</option>";
}

echo "</table>";
$sql = "select * from mydb.post";
$result = mysqli_query($db,$sql);
echo "<table><tr><td>PID</td><td>Course</td><td>Description</td></tr>";
while ($data = mysqli_fetch_array($result)){
  echo "<tr>";
  echo " <td>".$data['PID']."</td>";
  echo " <td>".$data['Subject']."</td>";
  echo "<td>".$data['Description']." </td>";
  echo "</tr>";
}
echo "</table>";

echo "<br>Search for Post:<br>";
echo "<select id='post'>";
$sql = "select * from mydb.post";
$result = mysqli_query($db,$sql);
while ($data = mysqli_fetch_array($result)){
    $cname = $data['PID'];
  echo " <option value='$cname'>".$cname."</option>";
}
echo "</select>";

?>
<h2><a href = "logout.php">Sign Out</a></h2>
      

      	<input type = 'button' value = 'Send Application'>"


      <div id = "searchresult"></div>

   </body>

</html>
