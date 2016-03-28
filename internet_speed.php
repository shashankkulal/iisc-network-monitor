<?php
    header("Refresh:60");
    session_start();
    if(!isset($_SESSION['uname'])) header("location:index.php");
    include "php_scripts/functions.php";
    #echo shell_exec("python python_engine/speedtest_cli.py > python_engine/speedtest.txt");
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
<script>
function getServer(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "php_scripts/getServer.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
   <style>
        table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;    
}

.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
}

.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}    
    
.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
    text-align: left;    
}

.bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}



/*----------------------*/

.zebra td, .zebra th {
    padding: 10px;
    border-bottom: 1px solid #f2f2f2;    
}
.zebra td
{
	font-size:12px;
}
.zebra tbody tr:nth-child(even) {
    background: #f5f5f5;
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
}

.zebra th {
    text-align: left;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
    border-bottom: 1px solid #ccc;
    background-color: #eee;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
    background-image: -webkit-linear-gradient(top, #f5f5f5, #eee);
    background-image:    -moz-linear-gradient(top, #f5f5f5, #eee);
    background-image:     -ms-linear-gradient(top, #f5f5f5, #eee);
    background-image:      -o-linear-gradient(top, #f5f5f5, #eee); 
    background-image:         linear-gradient(top, #f5f5f5, #eee);
}

.zebra th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;  
}

.zebra th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.zebra th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.zebra tfoot td {
    border-bottom: 0;
    border-top: 1px solid #fff;
    background-color: #f1f1f1;  
}

.zebra tfoot td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.zebra tfoot td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}

.zebra tfoot td:only-child{
    -moz-border-radius: 0 0 6px 6px;
    -webkit-border-radius: 0 0 6px 6px
    border-radius: 0 0 6px 6px
}
  
</style>
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
                <h3>Selected Locations</h3></br>
                <table class="zebra">
                    <tr>
                        <th>Location</th>
                        <th>Download</th>
                        <th>Upload</th>
                        <th>Update Time</th>
                        <th>ACT</th>
                    </tr>
                    <?php
                        $rs = $db->query("select *from speedtest where status='1'");
                        while($row=$rs->fetch_array())
                        {
                    ?>
                    <tr>
                        <td><?php echo $row['sname']; ?></td>
                <td><?php if($row['down']) echo "<span style='color:#BA55D3; font-size: 18px;'>".$row['up']."</span> Mbit/s"; else echo "N/A"; ?></td>
                <td><?php if($row['up']) echo "<span style='color:#BA55D3; font-size: 18px;'>".$row['down']."</span> Mbit/s"; else echo  "N/A"; ?></td>
                <td><?php if($row['ut']!="0000-00-00 00:00:00") echo timeInAgo(strtotime($row['ut']))." ago."; else "N/A"; ?></td>
                <td><a href="#" data-target="#<?php echo $row['sid']; ?>" data-toggle="modal"><img width="20px" height="20px" src="images/graph-512.png" /></a> <a style="color:red; font-size:16px;" href="speedtest/delFromMonitor.php?action=<?php echo $row['sid']; ?>"><img width="20" height="20" src="images/delete-xxl.png"></a>
				<div class="modal fade" id="<?php echo $row['sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog" style="max-width:90%; width:auto;">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h2 class="modal-title">Graphs for last 24 hours.</h2>
						</div>
						<div class="modal-body" align="center">
						<p style="color:#460B0B; font-size:16px;"><?php echo $row['sname']; ?></p><br>
						<img src="python_engine/speedtest/images/<?php echo $row['sid']; ?>_1d.png" />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
				</div></div>
		</td>
                    </tr>
                    <?php } ?>
             </table>
             </div><br>

			 <div class="blank-page">
                <h3>Choose Location</h3></br>
                <table class="zebra">
                    <tr>
                        <th>Server List</th>
                        <th>Added to Monitor</th>
                    </tr>
                    <tr>
                        <td style="text-align:left;">
		Locate Server: <input type="text" class="btn btn-sm btn-default" placeholder="eg: New York, USA" onkeyup="getServer(this.value)" /><br><br><br>
                <div id="txtHint"></div>
                    </td>
                    <td>
                    <div class="list-group list-group-alternate"> 
                         <?php
                            $rs = $db->query("select sid,sname from speedtest where status='1'");
                            while($row = $rs->fetch_array())
                            {
                                ?>
				<a href="#" class="list-group-item"><span class="badge"></span> <i class="ti ti-email"></i> <?php echo $row['sname']; ?> </a>
                            <?php
                            }
                        ?>
			</div>
                
                    </td></tr>
        </table>
             </div><br>
 
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

