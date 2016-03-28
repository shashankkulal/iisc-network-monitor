<?php
    header("Refresh:60");
    session_start();
    if(!isset($_SESSION['uname'])) header("location:index.php");
    include "php_scripts/functions.php";
    if(!isset($_GET['ip']))
    {
        $ip = '10.16.25.1';
    }
    else
    {
        $checkip = $_GET['ip'];
        if(filter_var($checkip, FILTER_VALIDATE_IP)) 
        {
            $ip = $_GET['ip'];
        }
        else 
        {
            $ip = '10.16.25.1';
    
        }
    }
    $rs = $db->query("select *from clink_status where ip='$ip'");
    while($row = $rs->fetch_array())
    {
        $mi = $row['mi'];
        $mx = $row['mx'];
        $av = $row['av'];
        $pl = $row['pl'];
        $ut = $row['ut'];
    }
    $ipdetails = getIpDetailsByIp($ip);
    $mma = getChildAverage($ip);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>IISc Network Monitor V.2</title>
<!--Internet Bandwidth Start-->
    
<!--Internet Bandwidth End-->
<link type="image/gif" rel="icon" href="<?php if($_SESSION['status'] == '0') echo 'images/green.gif'; else 'images/red.gif'; ?>">
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data1 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['MIN', <?php echo $mi; ?>],
          ['AVG', <?php echo $av; ?>],
          ['MAX', <?php echo $mx; ?>],
        ]);

        var options1 = {
          width: 400, height: 120,
          redFrom: 40, redTo: 80,
          yellowFrom:10, yellowTo: 40,
          minorTicks: 5,
            min:0,
            max:80
        };
          
        var data2 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['MIN', <?php echo $mma['min']; ?>],
          ['AVG', <?php echo $mma['avg']; ?>],
          ['MAX', <?php echo $mma['max']; ?>],
        ]);

        var options2 = {
          width: 400, height: 120,
          redFrom: 40, redTo: 80,
          yellowFrom:10, yellowTo: 40,
          minorTicks: 5,
            min:0,
            max:80
        }; 


        var chart1 = new google.visualization.Gauge(document.getElementById('chart_div'));
        var chart2 = new google.visualization.Gauge(document.getElementById('chart_div1'));

        chart1.draw(data1, options1);
        chart2.draw(data2, options2);
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
				<a href="hoststatus.php">Status</a>
				<i class="fa fa-angle-right"></i>
                    <span>
                        <?php if($_SESSION['status'] == '0') { ?>
                        <img src="images/green.gif" />
                        <img src="images/redoff.gif" />
                        <span style="color:green; font-size: 20px;">All Ok..!!</span></span>
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
    <h1>Link Status</h1>
    <div class="but_list">
	           <ol class="breadcrumb">
                   <?php
                        getParents($ipdetails['pid']);
                        $parents = array_reverse($parents);
                        foreach($parents as $v)
                        {
                    ?>
	               <li><a href="link_status.php?ip=<?php echo $v['ip']; ?>"><?php echo $v['sname']; ?></a></li>
                   <?php } ?>
                   <li class="active"><?php echo $ipdetails['sname']; ?></li>
	           </ol>
	       </div>
    
    <div class="row show-grid">
                  <div class="col-md-6" style="text-align:center;">
                <a class="btn btn-lg btn-success warning_1" target="_blank" href="<?php echo $ipdetails['agent']; ?>"><?php if(!isset($ipdetails['fname'])) echo $ipdetails['sname']; else echo $ipdetails['fname']; ?></a></br></br>
                <span class="btn btn-xs btn-primary">Delay</span><br><br>
		<div id="chart_div" align="center"></div>
		<hr style="background:#333; height:5px; border:0; background-image:linear-gradient(to right, #ccc, #333, #ccc);" />
             <span class="btn btn-xs btn-primary">Packet Loss</span><br><br>
		<span style="font-size: 30px;"><?php echo $pl; ?> %</span>
<br><br>
                        <?php
                            $u = time();
                      ?>
                            <script>
                                function executeQuery() {
                                  $.ajax({
                                    url: 'php_scripts/lastupdate.php?u=<?php echo $u; ?>',
                                    success: function(data) {
                                      // do something with the return value here if you like
                                      $(".lastupdatediv").html(data);
                                    }
                                  });
                                  setTimeout(executeQuery, 1000);
                                }
                                $(document).ready(function() {
                                 setTimeout(executeQuery, 1000);
                                });
                                 </script>
                      <h5>Last Update: <span class="lastupdatediv" style="font-weight: bold; color: brown;"></span> seconds ago.</h5>
    </div>
    <div class="col-md-6" style="text-align:center;">
        <span class="btn btn-lg btn-info">Delay below <?php echo $ipdetails['sname']; ?></span></br></br>
                <span class="btn btn-xs btn-primary">Delay</span><br><br>
		<div id="chart_div1" align="center"></div>
		<hr style="background:#333; height:5px; border:0; background-image:linear-gradient(to right, #ccc, #333, #ccc);" />
		<span class="btn btn-xs btn-primary">Packet Loss</span><br><br>
		<span style="font-size: 30px;"><?php echo $mma['ploss']; ?> %</span><br><br>
                        <?php
                            $u = time();
                      ?>
                            <script>
                                function executeQuery() {
                                  $.ajax({
                                    url: 'php_scripts/lastupdate.php?u=<?php echo $u; ?>',
                                    success: function(data) {
                                      // do something with the return value here if you like
                                      $(".lastupdatediv").html(data);
                                    }
                                  });
                                  setTimeout(executeQuery, 1000);
                                }
                                $(document).ready(function() {
                                 setTimeout(executeQuery, 1000);
                                });
                                 </script>
                      <h5>Last Update: <span class="lastupdatediv" style="font-weight: bold; color: brown;"></span> seconds ago.</h5>
    </div>
                
</div>
    </div><br>
    <div class="blank-page">
        <h3 align="center" style="color:#DA4ED3;">Department below <?php echo $ipdetails['sname']; ?></h3><br>
        <div class="list-group list-group-alternate">
            <a href="link_status.php" class="list-group-item" style="background:grey;"><span class="badge">Average</span> <i class="ti ti-email" style="color:white;">Departments</i></a>
            <?php
                $rs = $GLOBALS['db']->query("select *from tree where pid=".$ipdetails['id']."");
                while($row = $rs->fetch_array())
                {
                    $cmma = getSinglePingStatus($row['ip']);
                ?>
				<a href="link_status.php?ip=<?php echo $row['ip']; ?>" class="list-group-item"><span class="badge"><?php echo $cmma['av']; ?></span> <i class="ti ti-email"></i> <?php if($row['fname']=="") echo $row['sname']; else echo $row['fname']; ?> </a>  
		          <?php } ?>	
        </div>
    </div><br>
    

                <div class="blank-page">
                    <h4>Last 4 Hour (<?php echo $ipdetails['sname']; ?>)</h4><br>
                    <img src="python_engine/tree/images/ps<?php echo $ipdetails['ip']; ?>4h.png" />
                </div><br>
                <div class="blank-page">
                    <h4>Last 1 Day (<?php echo $ipdetails['sname']; ?>)</h4><br>
                    <img src="python_engine/tree/images/ping_statistics_<?php echo $ipdetails['ip']; ?>.png" />
                </div><br>
                <div class="blank-page">
                    <h4>Last 1 Week (<?php echo $ipdetails['sname']; ?>)</h4><br>
                    <img src="python_engine/tree/images/ps<?php echo $ipdetails['ip']; ?>1w.png" />
                </div><br>
                <div class="blank-page">
                    <h4>Last 1 Month (<?php echo $ipdetails['sname']; ?>)</h4><br>
                    <img src="python_engine/tree/images/ps<?php echo $ipdetails['ip']; ?>4w.png" />
                </div><br>
                <div class="blank-page">
                    <h4>Last 6 Months (<?php echo $ipdetails['sname']; ?>)</h4><br>
                    <img src="python_engine/tree/images/ps<?php echo $ipdetails['ip']; ?>24w.png" />
                </div><br>
                <div class="blank-page">
                    <h4>Last 1 Year (<?php echo $ipdetails['sname']; ?>)</h4><br>
                    <img src="python_engine/tree/images/ps<?php echo $ipdetails['ip']; ?>1y.png" />
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

