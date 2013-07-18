<?php
   include("fbaccess1.php");
?>
 
<html lang="en">
  <head>
 
    <!--styles -->
    <link href="style.css" rel="stylesheet">
    <link href="bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap-responsive.css" rel="stylesheet">
<style type="text/css">
#login_but{
width:400px;
height:45px;
position:absolute;
background:url('login_button.png') no-repeat;
left:620px;
top:-120px;
cursor:pointer;
}
</style>
  </head>

  <body>
   
  
  <div class="bubble" id="canvasBubbles"></div> 
  
    <div class="container" id="wrapper"> 
	<div id='login_but' onclick="window.location='<?php echo $loginUrl; ?>';"></div>
	 <img src="cvr.jpg" />
	 
    </div>

    <script src="jquery-1.7.2.min.js"></script>
    <script src="bootstrap.min.js"></script>
   <script src="script.js"></script>
    <script src="bubblesoon.js"></script>
  </body>
</html>
