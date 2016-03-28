<?php
session_start();
include "config/class_lib.php";
if(!isset($_SESSION['user_uname']))
{
    header("location:login.php");
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
        <!-- EOF CSS INCLUDE -->
         <?php include "config/css.php"; ?>                      
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
                    <li><a href="home.php">Home</a></li>
                    <li class="active">Proxy History</li>
                </ul>
                <!-- END BREADCRUMB -->                                                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START TIMELINE FILTER -->                            
                            <div class="panel panel-default">                                
                                <div class="panel-body">
                                    <h3>History for Proxy Services</h3>
                                        <div class="col-md-8">
                                            <div class="btn-group btn-group-justified">  
                                                <a href="#1hour" class="btn btn-primary active">1 Hour</a>
                                                <a href="#1day" class="btn btn-primary">1 Day</a>
                                                <a href="#1week" class="btn btn-primary">1 Week</a>
                                                <a href="#1month" class="btn btn-primary">1 Month</a>
                                                <a href="#6months" class="btn btn-primary">6 Months</a>
                                                <a href="#1year" class="btn btn-primary">1 Year</a>
                                            </div>                                         
                                        </div>
                                </div>
                            </div>
                            <!-- END TIMELINE FILTER -->
                            
                        </div>
                    </div>
                    <!--Actual Timeline Start-->  
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START TIMELINE -->
                            <div class="timeline timeline-right" style="height: auto;">
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date">History</div>
                                </div>
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info" id="1hour">Last 1 Hour</div>
                                    <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-body">
                                        <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#s11h" data-toggle="tab" aria-expanded="true">10.16.40.111 (S1)</a></li>
                                    <li class=""><a href="#s21h" data-toggle="tab" aria-expanded="false">10.16.40.112 (S2)</a></li>
                                    <li class=""><a href="#s31h" data-toggle="tab" aria-expanded="false">10.16.40.113 (S3)</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="s11h">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_hour_10.16.40.111.png">
                                    </div>
                                    <div class="tab-pane" id="s21h">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_hour_10.16.40.112.png">
                                    </div>
                                    <div class="tab-pane" id="s31h">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_hour_10.16.40.113.png">
                                    </div>                        
                                </div>
                            </div>                                          
                                        </div>                                       
                                    </div>
                                </div>       
                                <!-- END TIMELINE ITEM -->

                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info" id="1day">Last 1 Day</div>
                                    <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-body">
                                        <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#s11d" data-toggle="tab" aria-expanded="true">10.16.40.111 (S1)</a></li>
                                    <li class=""><a href="#s11d" data-toggle="tab" aria-expanded="false">10.16.40.112 (S2)</a></li>
                                    <li class=""><a href="#s31d" data-toggle="tab" aria-expanded="false">10.16.40.113 (S3)</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="s11d">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_24hour_10.16.40.111.png">
                                    </div>
                                    <div class="tab-pane" id="s21d">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_24hour_10.16.40.112.png">
                                    </div>
                                    <div class="tab-pane" id="s31d">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_24hour_10.16.40.113.png">
                                    </div>                        
                                </div>
                            </div>                                          
                                        </div>                                       
                                    </div>
                                </div>       
                                <!-- END TIMELINE ITEM -->

                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info" id="1week">Last 1 Week</div>
                                    <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-body">
                                        <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#s11w" data-toggle="tab" aria-expanded="true">10.16.40.111 (S1)</a></li>
                                    <li class=""><a href="#s11w" data-toggle="tab" aria-expanded="false">10.16.40.112 (S2)</a></li>
                                    <li class=""><a href="#s31w" data-toggle="tab" aria-expanded="false">10.16.40.113 (S3)</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="s11w">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_week_10.16.40.111.png">
                                    </div>
                                    <div class="tab-pane" id="s21w">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_week_10.16.40.112.png">
                                    </div>
                                    <div class="tab-pane" id="s31w">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_week_10.16.40.113.png">
                                    </div>                        
                                </div>
                            </div>                                          
                                        </div>                                       
                                    </div>
                                </div>       
                                <!-- END TIMELINE ITEM -->

                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info" id="1month">Last 1 Month</div>
                                    <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-body">
                                        <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#s11m" data-toggle="tab" aria-expanded="true">10.16.40.111 (S1)</a></li>
                                    <li class=""><a href="#s11m" data-toggle="tab" aria-expanded="false">10.16.40.112 (S2)</a></li>
                                    <li class=""><a href="#s31m" data-toggle="tab" aria-expanded="false">10.16.40.113 (S3)</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="s11m">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_4week_10.16.40.111.png">
                                    </div>
                                    <div class="tab-pane" id="s21m">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_4week_10.16.40.112.png">
                                    </div>
                                    <div class="tab-pane" id="s31m">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_4week_10.16.40.113.png">
                                    </div>                        
                                </div>
                            </div>                                          
                                        </div>                                       
                                    </div>
                                </div>       
                                <!-- END TIMELINE ITEM -->

                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info" id="6months">Last 6 Months</div>
                                    <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-body">
                                        <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#s16m" data-toggle="tab" aria-expanded="true">10.16.40.111 (S1)</a></li>
                                    <li class=""><a href="#s16m" data-toggle="tab" aria-expanded="false">10.16.40.112 (S2)</a></li>
                                    <li class=""><a href="#s36m" data-toggle="tab" aria-expanded="false">10.16.40.113 (S3)</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="s16m">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_6months_10.16.40.111.png">
                                    </div>
                                    <div class="tab-pane" id="s26m">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_6months_10.16.40.112.png">
                                    </div>
                                    <div class="tab-pane" id="s36m">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_6months_10.16.40.113.png">
                                    </div>                        
                                </div>
                            </div>                                          
                                        </div>                                       
                                    </div>
                                </div>       
                                <!-- END TIMELINE ITEM -->

                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info" id="1year">Last 1 Year</div>
                                    <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                                    <div class="timeline-item-content">
                                        <div class="timeline-body">
                                        <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#s11y" data-toggle="tab" aria-expanded="true">10.16.40.111 (S1)</a></li>
                                    <li class=""><a href="#s11y" data-toggle="tab" aria-expanded="false">10.16.40.112 (S2)</a></li>
                                    <li class=""><a href="#s31y" data-toggle="tab" aria-expanded="false">10.16.40.113 (S3)</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="s11y">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_year_10.16.40.111.png">
                                    </div>
                                    <div class="tab-pane" id="s21y">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_year_10.16.40.112.png">
                                    </div>
                                    <div class="tab-pane" id="s31y">
                                        <img style="max-width: 100%;" src="http://10.114.5.65/python_engine/images/last_year_10.16.40.113.png">
                                    </div>                        
                                </div>
                            </div>                                          
                                        </div>                                       
                                    </div>
                                </div>       
                                <!-- END TIMELINE ITEM -->
                                  
                                  
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date"><a href="pages-timeline-simple.html#"><span class="fa fa-ellipsis-h"></span></a></div>
                                </div>                                
                                <!-- END TIMELINE ITEM -->  
                            </div>
                            <!-- END TIMELINE -->
                            
                        </div>
                    </div>
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                       
                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- BLUEIMP GALLERY -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>      
        <!-- END BLUEIMP GALLERY -->        
        
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
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>        
        <script type="text/javascript" src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>        
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        <script type="text/javascript" src="js/demo_maps.js"></script>
        <!-- END TEMPLATE -->
        
        <script>            
            document.getElementById('links').onclick = function (event) {
                event = event || window.event;
                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event,onclosed: function(){
                        setTimeout(function(){
                            $("body").css("overflow","");
                        },10);                        
                    }},
                    links = this.getElementsByTagName('a');
                blueimp.Gallery(links, options);
            };
        </script> 
<!--SCROLL SCRIPT START-->
        <script type="text/javascript">
            $(document).ready(function(){
    $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();

        var target = this.hash;
        var $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });
});
        </script>
<!--SCROLL SCRIPT END-->
    <!-- END SCRIPTS -->         
    <script>

$(function() {
$('.jcarousel').jcarousel({
    transitions: true
});

$('.jcarousel').jcarousel({
    transitions: Modernizr.csstransitions ? {
        transforms:   Modernizr.csstransforms,
        transforms3d: Modernizr.csstransforms3d,
        easing:       'ease'
    } : false
});
    });
</script>
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