<?php 
include('config.php');
include('session.php');
$course = $_GET["course"];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
$sql = "SELECT * from mydb.post INNER JOIN mydb.tutor On post.tutor_email = tutor.email where course_name = '$course'";
$result = mysqli_query($db,$sql);
if (!$result){
	echo "con error".mysql_error($db);
}
echo "Search result:<br><table><tr><td>desc</td><td>course</td><td>tut nam</td><td>tut em</td><td>stats</td></tr>";
while ($data = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>".$data['description']." </td>";
	echo "<td>".$data['course_name']." </td>";
	echo "<td>".$data['name'].".</td>";
	echo "<td>".$data['email'].".</td>";
	echo " <td>".$data['status']."</td>";
	echo "</tr>";
}
echo "</table>";
?>
</body>
</html>