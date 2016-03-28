 <?php
$secret = "6LenpBkTAAAAALOLQgXqpTQFTEbKbu9ksR0HGdqN";
$response = $_POST['g-recaptcha-response'];
$res = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=10.114.5.72");
var_dump($res);
?>
