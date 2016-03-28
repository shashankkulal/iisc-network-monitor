<?php
    header("Refresh:60");
    session_start();
    if(!isset($_SESSION['uname'])) header("location:index.php");
    include "php_scripts/functions.php";
    $host_details = getHostDetails(null);
    $dns1 = getpacketloss('10.16.25.13', '1');
    $dns2 = getpacketloss('10.16.25.15', '1');
    $status_array = array();
    array_push($status_array, $dns1, $dns2);
    foreach($status_array as $value)
    {
        if($value > 0) $status = '1'; else $status = '0';
    }
    $_SESSION['status'] = $status;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>IISc Network Monitor V.2</title>
<!--Internet Bandwidth Start-->
    
<!--Internet Bandwidth End-->
<link type="image/gif" rel="icon" href="<?php if($status == '0') echo 'images/green.gif'; else 'images/red.gif'; ?>">
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
    
  
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		</script>
    <!--Speedometer for Packet Loss-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
          
        var data3 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['DNS1', <?php echo $dns1; ?>],
          ['DNS2', <?php echo $dns2; ?>]
        ]);

        var options3 = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
          
        var data4 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['DNS1', <?php echo getaveragedelay('10.16.25.13','1'); ?>],
          ['DNS2', <?php echo getaveragedelay('10.16.25.15','1'); ?>]
        ]);

        var options4 = {
          width: 400, height: 120,
          redFrom: 4, redTo: 5,
          yellowFrom:2, yellowTo: 4,
          minorTicks: 2,
            min:-5,
            max:5
        };

        var chart3 = new google.visualization.Gauge(document.getElementById('dns_loss'));
        var chart4 = new google.visualization.Gauge(document.getElementById('dns_delay'));

        chart3.draw(data3, options3);
        chart4.draw(data4, options4);
      }
    
    </script>
</head>
<body>
<div id="wrapper">
       <!----->
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.html">IISc</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section>
			<form class=" navbar-left-right">
              <input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
              <input type="submit" value="" class="fa fa-search">
            </form>
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="drop-men" >
		        <ul class=" nav_1">
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo $_SESSION['uname']; ?><i class="caret"></i></span><img src="images/IISc_logo_transparent.png" width="60px" height="60px"></a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="profile.php"><i class="fa fa-user"></i>Edit Profile</a></li>
		                <li><a href="inbox.php"><i class="fa fa-envelope"></i>Inbox</a></li>
		                <li><a href="calendar.php"><i class="fa fa-calendar"></i>Calender</a></li>
		                <li><a href="php_scripts/logout.php"><i class="fa fa-clipboard"></i>Logout</a></li>
		              </ul>
		            </li>
		           
		        </ul>
		     </div><!-- /.navbar-collapse -->
			<div class="clearfix">
       
     </div>
	  
		    <?php include "php_scripts/left_menu.php"; ?>
        </nav>
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
 	<!--banner-->	
		     <div class="banner">
		    	<h2>
				<a href="status.php">Status</a>
				<i class="fa fa-angle-right"></i>
                    <span>
                        <?php if($status == '0') { ?>
                        <img src="images/green.gif" />
                        <img src="images/redoff.gif" />
                        <span style="color:green; font-size: 20px;">Every thing working fine.</span></span>
                        <?php
                        }
                        else
                        {
                        ?>
                        <img src="images/greenoff.gif" />
                        <img src="images/red.gif" />
                        <span style="color:red; font-size: 20px;">Something Went Wrong.</span></span>
                        <?php } ?>
				</h2>
		    </div>
		<!--//banner-->
 	 <!--faq-->
 	<div class="blank">
	

			<div class="blank-page">                
                <h3>DNS Services</h3>
                <div class="row show-grid">
                  <div class="col-md-6" style="text-align:center;">
                      <div id="dns_loss" style="width: 400px; height: 120px; margin-left: auto; margin-right:auto;"></div>
                 <h5>Packet Loss</h5>
                    </div>
                  <div class="col-md-6" style="text-align:center;">
                 <div id="dns_delay" style="width: 400px; height: 120px; margin-left: auto; margin-right:auto;"></div>
                 <h5>Average Delay in ms</h5>    
                </div>
                </div>
                <div class="blank-page">
                    <h4>Last 1 Hour (10.16.25.13 - DNS 1)</h4><br>
                    <img src="python_engine/images/last_hour_10.16.25.13.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Hour (10.16.25.15 - DNS 2)</h4><br>
                    <img src="python_engine/images/last_hour_10.16.25.15.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Day (10.16.25.13 - DNS 1)</h4><br>
                    <img src="python_engine/images/last_24hour_10.16.25.13.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Day (10.16.25.15 - DNS 2)</h4><br>
                    <img src="python_engine/images/last_24hour_10.16.25.15.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Week (10.16.25.13 - DNS 1)</h4><br>
                    <img src="python_engine/images/last_week_10.16.25.13.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Week (10.16.25.15 - DNS 2)</h4><br>
                    <img src="python_engine/images/last_week_10.16.25.15.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Month (10.16.25.13 - DNS 1)</h4><br>
                    <img src="python_engine/images/last_4week_10.16.25.13.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Month (10.16.25.15 - DNS 2)</h4><br>
                    <img src="python_engine/images/last_4week_10.16.25.15.png" />
                </div>
	        </div>
	       </div>
	
	<!--//faq-->
		<!---->
<div class="copy">
            <p> &copy; 2016 IISc Network Monitor V.2. All Rights Reserved | Design by <a href="" target="_blank">Shashank Suresh Kulal</a> </p>	    </div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>

