<?php
include('config.php');
include('session.php');
$sql = "select * from mydb.tutee where email = '$login_session'";
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
      <h1>Welcome <?php echo $login_session; ?></h1> 
      <?php 
      if($count == 1) {
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$name = $row['name'];
	echo "name:".$name."<br>";
	echo "email:".$login_session."<br>";
}else {
    header("location: mydbtutorlogin.php");
}
$sql = "select * from mydb.application where tutee_email = '$login_session'";
$result = mysqli_query($db,$sql);
echo "My applications:<br><table><tr><td>course</td><td>description</td><td>status</td></tr>";
while ($data = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>".$data['message']." </td>";
	echo "<td>".$data['post_course_name']." </td>";
	echo "<td>".$data['post_tutor_name'].".</td>";
	echo " <td>".$data['status']."</td>";
	echo "</tr>";
}
echo "</table>";


?>
      <h2><a href = "logout.php">Sign Out</a></h2><br>
      Search for tutor:<br><?php 
      echo "<select id='course'>";
$sql = "select * from mydb.course";
$result = mysqli_query($db,$sql);
while ($data = mysqli_fetch_array($result)){
   	$cname = $data['name'];
	echo " <option value='$cname'>".$cname."</option>";
}
echo "</select>
      	<input type = 'button' value = 'add post' onclick='addApplication()'>";?>
      <div id = "searchresult"></div>
      
   </body>
   
</html> 