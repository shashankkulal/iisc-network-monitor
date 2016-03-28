<?php
session_start();
include "config/class_lib.php";
if(!isset($_SESSION['user_uname']))
{
    header("location:login.php");
}
$obj = new functions;
if(isset($_GET['ip']))
{
    $current_IP = $obj->getIPDetails($_GET['ip']);
    $cur_IPD = $obj->getLSDelay($_GET['ip']);
    $belowDelay = $obj->getChildAverage($_GET['ip']);
}
else
{
    $current_IP = $obj->getIPDetails("10.16.25.1");
    $cur_IPD = $obj->getLSDelay("10.16.25.1");
    $belowDelay = $obj->getChildAverage("10.16.25.1");
}
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
        <style type="text/css">
        #navPath li{
            font-size: 16px;
        }
        #navPath li a{
            font-size: 16px;
        }
        </style>
        <?php include "config/css.php"; ?>
        <!-- EOF CSS INCLUDE -->   
        <?php
            $u = time();
        ?>
        <script>
        function executeQuery() {
        $.ajax({
        url: 'config/lastupdate.php?u=<?php echo $u; ?>',
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
        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data1 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['MIN', <?php echo $cur_IPD['mi']; ?>],
          ['AVG', <?php echo $cur_IPD['av']; ?>],
          ['MAX', <?php echo $cur_IPD['mx']; ?>],
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
          ['MIN', <?php echo $belowDelay['min']; ?>],
          ['AVG', <?php echo $belowDelay['avg']; ?>],
          ['MAX', <?php echo $belowDelay['max']; ?>],
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
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <?php include "config/leftbar.php"; ?>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <?php include "config/topbar.php"; ?>
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- START BREADCRUMB -->
                <ol class="breadcrumb" id="navPath">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="link_status.php">Link Status</a></li>
                   <?php
                        getParents($current_IP['pid']);
                        $parents = array_reverse($parents);
                        foreach($parents as $v)
                        {
                    ?>
                   <li><a href="link_status.php?ip=<?php echo $v['ip']; ?>"><?php echo $v['sname']; ?></a></li>
                   <?php } ?>
                   <li class="active"><?php echo $current_IP['sname']; ?></li>
               </ol>
                <!-- END BREADCRUMB -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Link Status</h2>
                </div>                                   
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap" style="min-height: 600px; height: auto;">
                
                    <div class="row">


                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php if(isset($_GET['ip'])) echo $current_IP['fname']; else echo "Supercomputer Education Research Centre"; ?></h3>
                                </div>
                                <div class="panel-body">
                                <p style="float:left;">Delay</p>
                                <form action="graphs.php" method="post">
                                <input type="hidden" name="ip" value="<?php echo $current_IP['ip']; ?>">
                                <button type="submit" class="btn btn-info btn-condensed" style="float:right;"><i class="glyphicon glyphicon-stats"></i></button></form>
                                   <div id="chart_div" align="center"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Delay Below <?php if(isset($_GET['ip'])) echo $current_IP['sname']; else echo "SERC"; ?></h3>
                                </div>
                                <div class="panel-body">
                                   <div id="chart_div1" align="center"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="widget widget-primary widget-item-icon">
                                    <div class="widget-item-left">
                                        <span class="fa fa-thumbs-o-<?php if($cur_IPD['pl'] > 0) echo "down"; else echo "up"; ?>"></span>
                                    </div>
                                    <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $cur_IPD['pl']; ?> %</div>
                                    <div class="widget-title">Packet Loss</div>
                                    <div class="widget-subtitle"><?php echo $current_IP['fname']; ?></div>
                                    </div>                           
                                    </div>
                                    <h5 align="center;">Last Update: <span class="lastupdatediv" style="font-weight: bold; color: brown;"></span> seconds ago.</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-body">
                                   <div class="widget widget-primary widget-item-icon">
                                    <div class="widget-item-left">
                                        <span class="fa fa-thumbs-o-<?php if($belowDelay['ploss'] > 0) echo "down"; else echo "up"; ?>"></span>
                                    </div>
                                    <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $belowDelay['ploss']; ?> %</div>
                                    <div class="widget-title">Packet Loss</div>
                                    <div class="widget-subtitle">Below <?php echo $current_IP['sname']; ?></div>
                                    </div>                           
                                    </div>
                                    <h5 align="center;">Last Update: <span class="lastupdatediv" style="font-weight: bold; color: brown;"></span> seconds ago.</h5>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Show Departments Below <?php echo $current_IP['sname']; ?></h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group border-bottom" id="sortUL">
                                    <li value="9999" class="list-group-item" style="background: #181717; color:white;">Departments<span class="badge badge-success">Average</span></li>
                                    <?php
                                        if(!isset($_GET['ip']))
                                        {
                                            $rs = $mysqli->query("select *from tree where pid='1'");
                                            while($data = $rs->fetch_assoc())
                                            {
                                                $link = $obj->getLSDelay($data['ip']);
                                                ?>
                                                <li value="<?php echo round($link['av']); ?>" class="list-group-item"><a href="link_status.php?ip=<?php echo $data['ip']; ?>"><?php echo $data['sname']; ?></a><span class="badge badge-<?php if($link['pl'] > 0) echo "danger"; else echo "success"; ?>"><?php echo $link['av']; ?></span></li>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            $ip = $_GET['ip'];
                                            $rs = $mysqli->query("select *from tree where pid=(select id from tree where ip='$ip' limit 1)");
                                            while($data = $rs->fetch_assoc())
                                            {
                                                $link = $obj->getLSDelay($data['ip']);
                                                var_dump($link);
                                                ?>
                                                <li value="<?php echo round($link['av']); ?>" class="list-group-item"><a href="link_status.php?ip=<?php echo $data['ip']; ?>"><?php echo $data['sname']; ?></a><span class="badge badge-<?php if($link['pl'] > 0) echo "danger"; else echo "success"; ?>"><?php echo $link['av']; ?></span></li>
                                                <?php
                                            }
                                        }
                                    ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
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
   
<!-- START SORT -->

<script type="text/javascript">
$(document).ready(function () {
        var elems = $('$sortUL').children('li').remove();
        elems.sort(function(a,b){
        return parseInt($(a).text()) > parseInt($(b).text());
    });
    $('#sortUL').append(elems);
});
</script>

   <!-- END SORT -->

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






