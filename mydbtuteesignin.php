<?php
   include('config.php');
   if (!$db){
      $error = "connection error";
      exit;
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myemail = $_POST['email'];
      $myname = $_POST['name'];
      $mypassword = $_POST['password']; 
      
      $sql = "CREATE TRIGGER MysqlTrigger1 BEFORE INSERT ON mydb.tutee FOR EACH ROW SET NEW.name=UPPER(NEW.name)";
      mysqli_query($db,$sql);
      $sql = "INSERT INTO mydb.tutee (email,password,name) VALUES ('$myemail', '$mypassword','$myname')";
      $result = mysqli_query($db,$sql);
   

      if($result) {
         
         header("location: mydbtuteelogin.php");
      }else {
         $error = $error."Sign in failure";
      }
   }
?>
<html>
   
   <head>
      <title>Tutee Signup Page</title>
      
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

                  <label>Email  :</label><input type = "text" name = "email" class = "box" /><br/><br />
                  <label>Name  :</label><input type = "text" name = "name" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               <a href="mydbtuteelogin.php">Log in</a>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               
            </div>
            
         </div>
         
      </div>

   </body>
</html>