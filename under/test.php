<!DOCTYPE html>
<html>
<head>
	<title>Tesing</title>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var d = new date();
			alert(d);
	</script>
</head>
<body>
	<div id="content-1">Meep</div>
	<div id="content-2">Moop</div>
	<div id="content-3">Beep</div>
	<div id="content-4">Peep</div>
	<div id="content-5">Poop</div>
	<div id="content-6">Loop</div>
	<div id="content-7">Neep</div>
<?php
	$date = new DateTime('now'); // can be anyting else too
$date->modify('+1 week');

// PHP 5.3
$future = $date->getTimeStamp();
echo $future;
?>
</body>
</html>