<?php
   include('settings.php');
   
   session_start();
   // Check session storage if user is still logged in
   $user_check = $_SESSION['username'];
   $ses_sql = @mysqli_query($db,"SELECT username FROM supervisors WHERE username = '$user_check'");
   $row = @mysqli_fetch_assoc($ses_sql);
   
   if(!isset($_SESSION['username'])){
      header("location:login.php");
      die();
   }
?>