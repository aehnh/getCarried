<?php
include('config.php');
include('session.php');
$myemail = $_SESSION['login_user'];
$sql = "select * from mydb.tutor where email = '$myemail'";
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);
if($count == 1) {
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$name = $row['name'];
	echo "name:".$name."<br>";
	echo "email:".$login_session."<br>";
}else {
    header("location: mydbtutorlogin.php");
}
$sql = "select * from mydb.post where tutor_email = '$login_session'";
$result = mysqli_query($db,$sql);
echo "<table><tr><td>course</td><td>description</td><td>status</td></tr>";
while ($data = mysqli_fetch_array($result)){
	echo "<tr>";
	echo " <td>".$data['course_name']."</td>";
	echo "<td>".$data['description']." </td>";
	echo " <td>".$data['status']."</td>";
	echo "</tr>";
}
echo "</table>";

echo "<form method='POST' action='addpost.php'> <select name='course'>";
$sql = "select * from mydb.course";
$result = mysqli_query($db,$sql);
while ($data = mysqli_fetch_array($result)){
   	$cname = $data['name'];
	echo " <option value='$cname'>".$cname."</option>";
}
echo "</select>
      	<textarea rows='4' cols='50' name='description'>Description</textarea>
      	<input type = 'submit' value = 'add post'>
      </form>";
$sql = "select * from mydb.application where post_tutor_email = '$login_session'";
$result = mysqli_query($db,$sql);
echo "<table><tr><td>tutee_email</td><td>course</td><td>status</td><td>message</td></tr>";
while ($data = mysqli_fetch_array($result)){
	echo "<tr>";
	echo " <td>".$data['tutee_email']."</td>";
	echo "<td>".$data['post_course_name']." </td>";
	echo " <td>".$data['status']."</td>";
	echo " <td>".$data['message']."</td>";
	echo " <td><form method='post' action = ''><input type='submit' value='accept' name></td>";
	echo "</tr>";
}
echo "</table>";
?>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html> 