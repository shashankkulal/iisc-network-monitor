<!DOCTYPE HTML>
<html>
<head>
<title>IISc - Network Monitor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"> </script>
<?php
$bg = array('iisc.jpg','img_0567.jpg','tower.jpg');
$rimage=rand(0,2);
?>
<style>
.bg{ 
  background: url(images/iisc_backgrounds/<?php echo $bg[$rimage]; ?>) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
</head>
<body class="bg">
	<div class="login">
		<h1><a href="index.php" style="color:black;">IISc Network Monitor v.2</a></h1>
		<div class="login-bottom">
			<h2>Authorized Personnel Only</h2>
			<form action="php_scripts/auth.php" method="post">
			<div class="col-md-6">
				<div class="login-mail">
					<input type="text" placeholder="Email" required="" name="Username">
					<i class="fa fa-envelope"></i>
				</div>
				<div class="login-mail">
					<input type="password" placeholder="Password" required="" name="Password">
					<i class="fa fa-lock"></i>
				</div>
				<div class="login-mail">
                                        <input type="text" placeholder="Prove you are human.." required="" name="captcha">
                                        <i class="fa fa-lock"></i>
                                </div>
			</div>
			<div class="col-md-6 login-do" style="text-align:center;">
				<img src="php_scripts/captcha.php" /><br><br>
				<label class="hvr-shutter-in-horizontal login-sub">
					<input type="submit" value="login">
					</label>
			</div>
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
            <p style="color:black;"> &copy; 2016 DESE,IISc. All Rights Reserved | Design by <a href="" target="_blank">Shashank (DESE)</a> </p>	    
</div>  
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>

