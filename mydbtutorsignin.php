<?php
   include('config.php');
   if (!$db){
      $error = "connection error";
      exit;
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myname = $_POST['name'];
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 
      
      $sql = "INSERT INTO mydb.tutor (email,password,name) VALUES ('$myusername', '$mypassword','$myname')";
      $result = mysqli_query($db,$sql);
   

      if($result) {
         header("location: mydbtutorlogin.php");
      } else {
         $error = $error."Sign in failure";
      }
   }
?>
<html>
   
   <head>
      <title>Tutor Signin Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bmydbolor = "#FFFFFF">
   
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Signin</b></div>
            
            <div style = "margin:30px">
               
               <form action = "" method = "post">

                  <label>Email  :</label><input type = "text" name = "name" class = "box" /><br/><br />
                  <label>Name  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               <a href="mydbtutorlogin.php">Log in</a>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               
            </div>
            
         </div>
         
      </div>

   </body>
</html>