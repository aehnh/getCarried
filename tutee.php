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
      <script>
function addApplication() 
{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	document.getElementById("searchresult").innerHTML = this.responseText;
            }
        };
        var course = document.getElementById("course");
        xmlhttp.open("GET","searchpost.php?course="+course.options[course.selectedIndex].text,true);
        xmlhttp.send();
}</script>
   </head>
   
   <body>
      <h1>Welcome <?php echo $myemail; ?></h1>
      <?php 
      if($count == 1) {
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$name = $row['name'];
	echo "name: ".$name."<br>";
	echo "email: ".$myemail."<br>";
}else {
    header("location: mydbtuteelogin.php");
}
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$tuteeID = $row['TuteeID'];
$sql = "select * from mydb.application where TuteeID = '$tuteeID'";
$result = mysqli_query($db,$sql);
echo "My applications:<br><table><tr><td>PostID</td><td>Subject</td><td>Message</td><td>App bool</td></tr>";
while ($data = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	echo "<tr>";
  echo "<td>".$data['PostID'].".</td>";
	echo "<td>".$data['Subject']." </td>";
	echo "<td>".$data['Message']." </td>";
	echo " <td>".$data['App bool']."</td>";
	echo "</tr>";
}
echo "</table>";


?>
      <h2><a href = "logout.php">Sign Out</a></h2><br>
      Search for Post:<br> 
      <select id='course'>
	<option value='$cname'>".$cname."</option>
</select>
      	<input type = 'button' value = 'Send Application' onclick='addApplication()'>"
      <div id = "searchresult"></div>
      
   </body>
   
</html> 