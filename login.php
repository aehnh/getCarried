<?php
   include('config.php');
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM mydb.tutor WHERE email = '$myemail' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myemail;
         $_SESSION['login_status'] = 1;
      } else {
         $_SESSION['login_status'] = -1;
      }
   }
?>
<html>
<head>
   <title></title>
</head>
<body>
<p>bitchass</p>
</body>
</html>
