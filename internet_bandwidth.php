<?php
    header("Refresh:60");
    session_start();
    if(!isset($_SESSION['uname'])) header("location:index.php");
    include "php_scripts/functions.php";
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
                <h3>Internet Bandwidth Details</h3></br>
                                <div class="row show-grid">
                  <div class="col-md-6" style="text-align:center;">
                      <img src="images/fine2.gif" />
                      <h1 style="color:#1E90FF;"><?php echo getInternetBandwidth(); ?> MB/s</h1>
                      
                        <?php
                            $u = time();
                      ?>
                            <script>
                                function executeQuery() {
                                  $.ajax({
                                    url: 'php_scripts/lastupdate.php?u=<?php echo $u; ?>',
                                    success: function(data) {
                                      // do something with the return value here if you like
                                      $("#lastupdatediv").html(data);
                                    }
                                  });
                                  setTimeout(executeQuery, 5000);
                                }
                                $(document).ready(function() {
                                 setTimeout(executeQuery, 5000);
                                });
                                 </script>
                      <h5>Last Update: <span id="lastupdatediv" style="font-weight: bold; color: brown;"></span> seconds ago.</h5>
                    </div>
                  <div class="col-md-6" style="text-align:center;"><img src="python_engine/images/proxy_ib.png" width="497px" height="173px" /></div>
                </div>
                <div class="blank-page">
                    <h4>Last 1 Hour</h4><br>
                    <img src="python_engine/images/proxy_ib1hr.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Day</h4><br>
                    <img src="python_engine/images/proxy_ib.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Week</h4><br>
                    <img src="python_engine/images/proxy_ib1week.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Month</h4><br>
                    <img src="python_engine/images/proxy_ib4week.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 6 Months</h4><br>
                    <img src="python_engine/images/proxy_ib24week.png" />
                </div>
                <div class="blank-page">
                    <h4>Last 1 Year</h4><br>
                    <img src="python_engine/images/proxy_ib1year.png" />
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

