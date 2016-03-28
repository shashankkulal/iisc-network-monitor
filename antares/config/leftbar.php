<?php $currnet_file  = basename($_SERVER['PHP_SELF']); ?>
<!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <!--<li class="xn-logo">
                        <a href="home.php">Antares IISc</a>
                    </li>-->                                                                      
                    <li class="xn-title" style="font-size:20px; text-align: center; color: white;">Indian Institute of Science</li>
                    <li class="xn-profile">
                        <a href="layout-tabbed.html#" class="profile-mini">
                            <img src="" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="assets/images/users/<?php echo $_SESSION['user_pic']; ?>" alt="<?php echo $_SESSION['user_fname']; ?>" onerror="this.src='img/userpic.png'" />
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $_SESSION['user_fname']; ?></div>
                                <div class="profile-data-title"><?php echo $_SESSION['user_des']; ?></div>
                            </div>
                            <div class="profile-controls">
                                <a href="editProfile.php" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>
                        </div>                                                                        
                    </li>
                    <li<?php if($currnet_file == 'home.php') echo " class='active'"?>>
                        <a href="home.php"><span class="fa fa-home"></span> <span class="xn-text">Home</span></a>
                    </li> 
                    <li<?php if($currnet_file == 'link_status.php') echo " class='active'"?>>
                        <a href="link_status.php"><span class="fa fa-code-fork"></span> <span class="xn-text">Link Status</span></a>
                    </li> 
                    <li<?php if($currnet_file == 'mystatus.php') echo " class='active'"?>>
                        <a href="../../linfo/"><span class="fa fa-desktop"></span> <span class="xn-text">My Status</span></a>
                    </li> 
                    <li<?php if($currnet_file == 'settings.php') echo " class='active'"?>>
                        <a href="settings.php"><span class="fa fa-cogs"></span> <span class="xn-text">Settings</span></a>
                    </li> 
                    <li<?php if($currnet_file == 'logs.php') echo " class='active'"?>>
                        <a href="logs.php"><span class="fa fa-frown-o"></span> <span class="xn-text">Logs</span></a>
                    </li>                                       
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->