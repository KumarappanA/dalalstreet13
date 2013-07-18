<?php
  //  header('Location:./fbaccess1.php');
include("fbaccess1.php");
if($user)
//  echo "Click <a href='$site_url'>here</a>to login."; 
  {
    //  print_r($_SESSIONS);
    //  print_r($facebook->api('/me'));
     header('Location: http://www.pragyan.org/13/dalalstreet13/view/template/home.php'); 
}
else
header('Location: http://www.pragyan.org/13/dalalstreet13/main/facebooklogin/new.php');

?>
