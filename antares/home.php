<?php
session_start();
include "config/class_lib.php";
if(!isset($_SESSION['user_uname']))
{
    header("location:login.php");
}
$obj = new extra;
$greeting = $obj->greeting();
$obj = new functions;
$local_internet_speed = $obj->getInternetBandwidth();
$global_speed = $obj->getGlobalInternetSpeed();
header("Refresh: 60")
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Antares IISc</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" href="css/ion/ion.rangeSlider.css"/>
        <link rel="stylesheet" type="text/css" href="css/ion/ion.rangeSlider.skinFlat.css"/>
        <!-- EOF CSS INCLUDE --> 
        <?php include "config/css.php"; ?> 
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data1 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['S1', <?php echo $obj->getPacketLoss('10.16.40.111', '1'); ?>],
          ['S2', <?php echo $obj->getPacketLoss('10.16.40.112', '1'); ?>],
          ['S3', <?php echo $obj->getPacketLoss('10.16.40.113', '1'); ?>]
        ]);

        var options1 = {
          width: 600, height: 180,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
          
        var data2 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['S1', <?php echo $obj->getAverageDelay('10.16.40.111','1'); ?>],
          ['S2', <?php echo $obj->getAverageDelay('10.16.40.112','1'); ?>],
          ['S3', <?php echo $obj->getAverageDelay('10.16.40.113','1'); ?>]
        ]);

        var options2 = {
          width: 600, height: 180,
          redFrom: 40, redTo: 80,
          yellowFrom:20, yellowTo: 40,
          minorTicks: 2,
            min:0,
            max:80
        };
          
        var data3 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['DNS1', <?php echo $obj->getPacketLoss('10.16.25.13', '1'); ?>],
          ['DNS2', <?php echo $obj->getPacketLoss('10.16.25.15', '1'); ?>]
        ]);

        var options3 = {
          width: 600, height: 180,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
          
        var data4 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['DNS1', <?php echo $obj->getAverageDelay('10.16.25.13','1'); ?>],
          ['DNS2', <?php echo $obj->getAverageDelay('10.16.25.15','1'); ?>]
        ]);

        var options4 = {
          width: 600, height: 180,
          redFrom: 40, redTo: 80,
          yellowFrom:20, yellowTo: 40,
          minorTicks: 2,
            min:0,
            max:80
        };

        var chart1 = new google.visualization.Gauge(document.getElementById('chart_div'));
        var chart2 = new google.visualization.Gauge(document.getElementById('delay_div'));
        var chart3 = new google.visualization.Gauge(document.getElementById('dns_loss'));
        var chart4 = new google.visualization.Gauge(document.getElementById('dns_delay'));

        chart1.draw(data1, options1);
        chart2.draw(data2, options2);
        chart3.draw(data3, options3);
        chart4.draw(data4, options4);
      }
    
    </script>

    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
        <?php include "config/leftbar.php"; ?>
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <?php include "config/topbar.php"; ?>                     
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">                   
                    <li class="active" style="font-size: 16px; color: #111;"><?php echo $greeting." ".$_SESSION['user_fname']." !"; ?></li>
                </ul>
                <!-- END BREADCRUMB -->                
                <!-- PAGE CONTENT TABBED -->
                <div class="page-tabs">
                    <a href="#internet" class="active">Internet</a>
                    <a href="#proxy">Proxy</a>
                    <a href="#dns">DNS</a>
                </div>
                
                <div class="page-content-wrap page-tabs-item active" id="internet">
                
                    <div class="row">

                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body" style="background: white;">
                                    <h3>Internet Speed</h3>
                                    <a href="ui-widgets.html#" class="tile tile-warning tile-valign"><?php if($local_internet_speed) echo $local_internet_speed; else echo "Error"; ?>
                                <div class="informer informer-default dir-bl"><span class="fa fa-globe"></span> Internode</div>
                            </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3>Global Download Speed (Average)</h3>
                                    <div class="widget widget-primary widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-cloud-download"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $global_speed['download']; ?></div>
                                    <div class="widget-title">Download Speed</div>
                                    <div class="widget-subtitle">Selected Locations</div>
                                </div>                           
                            </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-body">
                                <h3>Global Upload Speed (Average)</h3>
                                    <div class="widget widget-success widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-cloud-upload"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $global_speed['upload']; ?></div>
                                    <div class="widget-title">Upload Speed</div>
                                    <div class="widget-subtitle">Selected Locations</div>
                                </div>                           
                            </div>
                                 </div>
                            </div>

                        </div>  
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Internet Speed Around the World</h3>
                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">id</th>
                                                    <th>Server Location</th>
                                                    <th width="100">Download<br>Mbit/s</th>
                                                    <th width="100">Upload<br>Mbit/s</th>
                                                    <th width="100">Last Update</th>
                                                    <th width="120">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $rs = $mysqli->query("select *from speedtest where status='1'");
                                            $i = 1;
                                            while($row=$rs->fetch_array())
                                            {
                                            ?>                                           
                                                <tr id="trow_<?php echo $i; ?>">
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td><?php echo $row['sname']; ?></td>
                                                    <td><strong><?php echo $row['down']; ?></strong></td>
                                                    <td><strong><?php echo $row['up']; ?></strong></td>
                                                    <td><?php echo date("h:m:sa", strtotime($row['ut'])); ?></td>
                                                    <td>
                                                        <button id="graph<?php echo $row['sid']; ?>" class="btn btn-default btn-rounded btn-condensed btn-sm"><span class="fa fa-bar-chart-o" data-toggle="modal" data-target="#<?php echo $row['sid']; ?>"></span></button>
                                                        <button id="del<?php echo $row['sid']; ?>" class="btn btn-danger btn-rounded btn-condensed btn-sm"><span class="fa fa-times" data-toggle="modal" data-target="#del<?php echo $row['sid']; ?>"></span></button>
                                                    </td>
                                                </tr> 
                                            <?php $i+=1; } ?>                                              
                                            </tbody>
                                        </table>
                                    </div>                                

                                </div>
                            </div>                                                

                        </div>
                    </div>
                </div>
                <div class="page-content-wrap page-tabs-item" id="proxy">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3 align="left">Proxy Services</h3>
                                    <a href="proxyHistory.php"><button class="btn btn-default" style="float:right;"><i class="glyphicon glyphicon-warning-sign"></i>View History</button></a>
				    <h4 align="center">Packet Loss</h4>
                                    
				    <div class="row">
                                        <div class="col-md-12">
                                          <div id="chart_div" style="width: 600px; height: 180px; margin-left:auto; margin-right:auto;"></div><br>
	                                </div>
                                    </div>
                                    <hr style="border-top: 3px double #8c8b8b;">
				    <h4 align="center">Delay</h4>
			  	    <div id="delay_div" style="width: 600px; height: 180px; margin-left: auto; margin-right:auto;"></div><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content-wrap page-tabs-item" id="dns">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body" style="text-align:center;"">
                                    <h3 align="left">DNS Services</h3>
                                    <a href="dnsHistory.php"><button class="btn btn-default" style="float:right;"><i class="glyphicon glyphicon-warning-sign"></i>View History</button></a>
				    <h4>Packet Loss</h4>
                                    <div id="dns_loss" style="margin-left: auto; margin-right:auto;"></div>
				    <hr style="border-top: 3px double #8c8b8b;">
				    <h4>Delay</h4>
				    <div id="dns_delay" style="margin-left: auto; margin-right:auto;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PAGE CONTENT TABBED -->                                 
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!--Modals Start Here-->
        <?php 
            $rs = $mysqli->query("select *from speedtest where status='1'");
            while($row=$rs->fetch_array())
            {
        ?>
        <div class="modal fade" id="<?php echo $row['sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" style="max-width: 90%; width:auto;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="largeModalHead"><?php echo $row['sname']; ?> (1 Day)</h4>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <img src="http://10.114.5.65/python_engine/speedtest/images/<?php echo $row['sid']; ?>_1d.png" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete BOX-->
        <div class="modal" id="delete<?php echo $row['sid']; ?>" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
                <div class="modal-content">                    
                    <div class="modal-body">
                        <h3>Are you sure?</h3>
                        <p>Remove <?php echo $row['sname']; ?> from monitor list.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="pages/removeFromMonitorList.php?sid=<?php echo $row['sid']; ?>" class="btn btn-default">Yes</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
<!--Firefox Script Start Here-->
        <script>
    $(function(){
    $('#graph<?php echo $row['sid']; ?>').click(function(){
      $('#<?php echo $row['sid']; ?>').modal('show');
      return false;
        })

    });
    $(function(){
    $('#del<?php echo $row['sid']; ?>').click(function(){
      $('#delete<?php echo $row['sid']; ?>').modal('show');
      return false;
        })

    });
</script>
<!--Firefox Script End Here-->

        <!-- END delete BOX-->
        <?php } ?>
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages/logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                 
        
    <!-- START SCRIPTS -->

        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->

        <!-- END PAGE PLUGINS -->         

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-36783416-1', 'auto');
        ga('send', 'pageview');
    </script>    
<!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter25836617 = new Ya.Metrika({
                        id:25836617,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/25836617" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->    
    </body>
</html>
