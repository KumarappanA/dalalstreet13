<?php
  //  header('Location:./fbaccess1.php');                                                                                                  
include("fbaccess1.php");
if($sizew<50)
  {
  
      session_destroy();
  
      header('Location: http://www.pragyan.org/13/dalalstreet13/main/facebooklogin/new.php');      //Redirect to $url


}
else
{
 $newuserid=0;
 //error_log("go here");
 $wiiw=mysql_query("SELECT * FROM `users1` WHERE `facebook_id`='{$iid}'");
 // session_start();
 // $_SESSION["KICKME"]=$access_token;
 if(!mysql_num_rows($wiiw)){
 $user2q=mysql_query("SELECT MAX(`userid`) FROM `users`");
 $get2=mysql_fetch_array($user2q);
 $lastuserid3=$get2[0];
 $newuserid=$lastuserid3+1;
 $password="htgjgjfghjgkg565646!!@";
 $users1q=mysql_query("INSERT INTO `users`(`userid`,`username`,`email`,`password`,`verified`,`disabled`,`cash`,`sessionid`) VALUES ('{$newuserid}','{$iname}','{$email}','{$password}',1,0,10000,'{$iid}')");
 			 }
 $users1q=mysql_query("INSERT INTO `users1`(`facebook_id`,`username`,`facebook_access_token`,`userid`) VALUES ('{$iid}','{$iname}','{$access_token}','{$newuserid}')");
 
  header('Location: http://www.pragyan.org/13/dalalstreet13/view/template/home.php');
}

?>

