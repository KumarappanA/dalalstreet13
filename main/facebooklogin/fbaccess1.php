<?php
include("db.php");
  //Application Configurations
$app_id= "483287491731006";
$app_secret= "e3e3a46ab049bc9fdd9e162fb0f798ba";
$site_url= "http://www.pragyan.org/13/dalalstreet13/main/facebooklogin/new1.php";
// $logoutUrl = $facebook->// getLogoutUrl(array('next' => 'http://www.pragyan.org'));
  
try{
  include_once "src/facebook.php";
}catch(Exception $e){
  //error_log($e);
 }
// Create our application instance
$facebook = new Facebook(array(
			       'appId'=> $app_id,
			       'secret'=> $app_secret,
			       ));
 
// Get User ID
$user = $facebook->getUser();
// We may or may not have this data based
// on whether the user is logged in.
// If we have a $user id here, it means we know
// the user is logged into
// Facebook, but we don’t know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.
 
if($user){
  //==================== Single query method ======================================
  try{
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
    //   var_dump($user_profile);
    //  $session = $facebook->getSession();
    $iname=$user_profile["name"];
    $iid=$user_profile["id"];
    $access_token = $facebook->getAccessToken();
    $user_list=$facebook->api('/me/friends');
    $size_of=$user_list["data"];
    $sizew=(int)count($size_of);
    $email=$facebook->api('me?fields=email');
    //  var_dump(count($size_of));
    // if($sizew<50)
   //  $logoutUrl=$facebook->//getLogoutUrl(array('next' => 'http://www.pragyan.org'));
    //   var_dump($access_token);
 //   mysql_query("INSERT INTO `users1`(`facebook_id`,`username`,`facebook_access_token`) VALUES ('{$iid}','{$iname}','{$access_token}')");
  }catch(FacebookApiException $e){
    //error_log($e);
    $user = NULL;
  }
  //==================== Single query method ends =================================
}
 
if($user){
  // Get logout URL
  //  $logoutUrl = $facebook->getLogoutUrl(array('next' => 'http://www.pragyan.org/13/dalalstreet13/view/template/logout.php')); 
  $logoutUrl= "http://www.facebook.com/logout.php?next=http://www.pragyan.org/13/dalalstreet13/main/facebooklogin/new.php&access_token='$access_token'";
 // $logoutUrl = $facebook->getLogoutUrl(array('next' => 'http://www.pragyan.org'));
}
else
  {
  // Get login URL
   $loginUrl = $facebook->getLoginUrl(array('scope'=> 'read_stream, publish_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos,read_friendlists,email','redirect_uri'=> $site_url,));   
}
 
if($user){
  // Proceed knowing you have a logged in user who has a valid session.
 
  //========= Batch requests over the Facebook Graph API using the PHP-SDK ========
 // Save your method calls into an array
  $queries = array(
		   array('method' => 'GET', 'relative_url' => '/'.$user),
		   array('method' => 'GET', 'relative_url' => '/'.$user.'/home?limit=50'),
		   array('method' => 'GET', 'relative_url' => '/'.$user.'/friends'),
		   array('method' => 'GET', 'relative_url' => '/'.$user.'/photos?limit=6'),
		   );

  //  var_dump(array('method' => 'GET', 'relative_url' => '/'.$user.'/friends'));
  //echo $test;
  // POST your queries to the batch endpoint on the graph.
  try{
    $batchResponse = $facebook->api('?batch='.json_encode($queries), 'POST');
  }catch(Exception $o){
    //error_log($o);
  }
 
  //Return values are indexed in order of the original array, content is in ['body'] as a JSON
  //string. Decode for use as a PHP array.
  $user_info= json_decode($batchResponse[0]['body'], TRUE);
  $feed= json_decode($batchResponse[1]['body'], TRUE);
  $friends_list= json_decode($batchResponse[2]['body'], TRUE);
  // var_dum();
  $photos= json_decode($batchResponse[3]['body'], TRUE);
  //========= Batch requests over the Facebook Graph API using the PHP-SDK ends =====
 
  // Update user's status using graph api
  if(isset($_POST['publish'])){
    try{
      $publishStream = $facebook->api("/$user/feed", 'post', array(
								   'message'=> 'Check out 25 labs',
								   'link'=> 'http://25labs.com',
								   'picture'=> 'http://25labs.com/images/25-labs-160-160.jpg',
								   'name'=> '25 labs',
								   'caption'=> '25labs.com',
								   'description'=> 'A Technology Laboratory. Highly Recomented technology blog.',
								   ));
    }catch(FacebookApiException $e){
      //error_log($e);
    }
  }
 
  // Update user's status using graph api
  if(isset($_POST['status'])){
    try{
      $statusUpdate = $facebook->api("/$user/feed", 'post', array('message'=> $_POST['status']));
    }catch(FacebookApiException $e){
      //error_log($e);
    }
  }
}
?>
