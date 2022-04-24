<?php
  session_start(); 
  unset($_SESSION["useremail"]); 
  unset($_SESSION["usernickname"]); 
  unset($_SESSION["userpassword"]);
  echo(" 
    <script> 
      location.href = 'index.php'; 
    </script> 
  ");
?>