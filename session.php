<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_email'];
   
   $ses_sql = mysqli_query($db,"select email from admin where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $Tutorid = $row['TutorID'];
   $login_email = $row['email'];
   $login_email =  $_SESSION['email'];
   
   if(!isset($_SESSION['login_email'])){
      header("location:main.html");
   }
?>