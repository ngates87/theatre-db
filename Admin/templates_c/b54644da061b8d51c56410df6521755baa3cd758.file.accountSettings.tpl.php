<?php /* Smarty version Smarty-3.1.12, created on 2014-04-24 13:28:48
         compiled from "templates/accountSettings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:715911514535957e06c5317-92614111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b54644da061b8d51c56410df6521755baa3cd758' => 
    array (
      0 => 'templates/accountSettings.tpl',
      1 => 1390785859,
      2 => 'file',
    ),
    '8fdbf9c0d2d3327854d9872843ad9757d53b1d54' => 
    array (
      0 => 'templates/securemaster.tpl',
      1 => 1390785862,
      2 => 'file',
    ),
    '387bf00b45a092e3f146406ae2419ee5cabf8f5f' => 
    array (
      0 => '/home/masc/www/templates/master.tpl',
      1 => 1390786664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '715911514535957e06c5317-92614111',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_535957e19902f9_46850243',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535957e19902f9_46850243')) {function content_535957e19902f9_46850243($_smarty_tpl) {?><?php if (!is_callable('smarty_function_GetCurrentSeason')) include '/home/masc/www/Includes/3rdPartyLibs/smarty/plugins/function.GetCurrentSeason.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/masc/www/Includes/3rdPartyLibs/smarty/plugins/modifier.date_format.php';
?><!doctype html>
<html class="no-js">

<head>
    <meta charset="utf-8" />
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'MASC' : $tmp);?>
</title>

    <!--[if lt IE 9]>
        <script src="/public/javascript/css3-mediaqueries.js"></script>
        <![endif]-->
    <link rel="stylesheet" media="all" href="/public/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->

    <!-- JS -->
    <script src="/public/javascript/jquery/jquery-1.9.1.min.js"></script>
    <script src="/public/javascript/jquery/jquery-migrate-1.1.1_2.js"></script>
    <script src="/public/javascript/jquery/ui/jquery-ui-1.9.2.min.js"></script>

     <script src="js/less-grid-4.js"></script>
    <script src="/public/javascript/custom.js"></script>
    <!-- <script src="/public/javascript/tabs.js"></script> -->

    <!-- Masonry -->
    <script src="/public/javascript/masonry.min.js"></script>
    <script src="/public/javascript/imagesloaded.js"></script>
    <!-- ENDS Masonry -->

    <!-- Tweet -->
    <link rel="stylesheet" href="/public/css/jquery.tweet.css" media="all" />
    <script src="/public/javascript/tweet/jquery.tweet.js"></script>
    <!-- ENDS Tweet -->

    <!-- superfish -->
    <link rel="stylesheet" media="screen" href="/public/css/superfish.css" />
    <script src="/public/javascript/superfish-1.4.8/js/hoverIntent.js"></script>
    <script src="/public/javascript/superfish-1.4.8/js/superfish.js"></script>
    <script src="/public/javascript/superfish-1.4.8/js/supersubs.js"></script>
    <!--  ENDS superfish -->

    <!-- prettyPhoto -->
    <script src="/public/javascript/prettyPhoto/js/jquery.prettyPhoto.js"></script>
    <link rel="stylesheet" href="/public/javascript/prettyPhoto/css/prettyPhoto.css" media="screen" />
    <!-- ENDS prettyPhoto -->

    <!-- poshytip -->
    <link rel="stylesheet" href="/public/javascript/poshytip-1.1/src/tip-twitter/tip-twitter.css" />
    <link rel="stylesheet" href="/public/javascript/poshytip-1.1/src/tip-yellowsimple/tip-yellowsimple.css" />
    <script src="/public/javascript/poshytip-1.1/src/jquery.poshytip.min.js"></script>
    <!--   ENDS poshytip -->

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Allan:700' rel='stylesheet' type='text/css'>

    <!-- Flex Slider -->
    <link rel="stylesheet" href="/public/css/flexslider.css" />
    <script src="/public/javascript/jquery.flexslider-min.js"></script>
    <!-- ENDS Flex Slider -->
    <link rel="stylesheet" media="screen" href="/public/packages/jquery-ui-themes/pepper-grinder/jquery-ui-1.9.2.css" />


    <!--[if IE 6]>
        <link rel="stylesheet" href="/public/css/ie6-hacks.css" media="screen" />
        <script type="text/javascript" src="/public/javascript/DD_belatedPNG.js"></script>
        <script>
            /* EXAMPLE */
            DD_belatedPNG.fix('*');
        </script>
        <![endif]-->

    <!-- Lessgrid -->
    <link rel="stylesheet" media="all" href="/public/css/lessgrid.css" />

    <!-- modernizr -->
    <script src="/public/javascript/modernizr.js"></script>

    
    <link href="/public/css/Admin.css" rel="stylesheet" type="text/css"/>
    <link type="text/css" rel="Stylesheet" href="/public/css/blackbirdjs/blackbird.css"/>



    <script type="text/javascript" src="/public/javascript/blackbirdjs/blackbird.js"></script>
    <script src="/public/javascript/jquery.validate.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="../public/images/apple/MASC.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../public/images/apple/MASC76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../public/images/apple/MASC120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../public/images/apple/MASC152x152.png">
</head>

<body lang="en">
    <!-- mobile-nav -->
    <div id="mobile-nav-holder">
        <div class="wrapper">
            <ul id="mobile-nav">
                <li id="menuHome"><a href="/">home</a>
                    <ul>
                        <li><a href="/Rentals.php">Equipment Rental</a></li>
                        <li><a href="/Discover.php">Get Involved</a></li>
                        <li><a href="/public/files/CurrentArtsCalendar.pdf" target='_blank'>Arts Calendar</a></li>
                        <li><a href="/Links.php">Links</a></li>
                    </ul>
                </li>
                <li id="menuShows">
                    <a href="#">shows</a>
                    <ul>
                        <?php echo smarty_function_GetCurrentSeason(array(),$_smarty_tpl);?>

                    </ul>
                </li>
                <li id="menuAlbums"><a href="/PhotoAlbums.php">photos</a></li>
                <li id="menuAbout"><a href="#">about</a>
                    <ul>
                        <li><a href="/About.php">About Us</a></li>
                        <li><a href="/Troupers.php">Our Troupers</a></li>
                        <li><a href="/Shows.php">Our Shows</a></li>
                        <li><a href="/Venues.php">Our Venues</a></li>
                    </ul>
                </li>
            </ul>
            <div id="nav-open"><a href="#">Menu</a></div>
        </div>
    </div>
    <!-- ENDS mobile-nav -->
    <header>
        <div class="wrapper">
            <a href="/" id="logo">
                <h1 style="color: #00d000;">Marshall Area Stage Company</h1>
            </a>

            <nav>
                <ul id="nav" class="sf-menu">
                    <li class="current-menu-item"><a href="/">home<span class="subheader">welcome</span></a>
                        <ul>
                            <li><a href="/Rentals.php">Equipment Rental</a></li>
                            <li><a href="/Discover.php">Get Involved</a></li>
                            <li><a href="/public/files/CurrentArtsCalendar.pdf" target='_blank'>Arts Calendar</a></li>
                            <li><a href="/Links.php">Links</a></li>
                        </ul>
                    </li>
                    <li><a href="#">shows<span class="subheader"><?php echo smarty_modifier_date_format(time(),"%Y");?>
 Season</span></a>
                        <ul>
                            <?php echo smarty_function_GetCurrentSeason(array(),$_smarty_tpl);?>

                        </ul>
                    </li>
                    <li>
                        <a href="/PhotoAlbums.php">photos<span class="subheader">memories</span></a>
                    </li>
                    <li><a href="#">about<span class="subheader">misc</span></a>
                        <ul>
                            <li><a href="/About.php">About Us</a></li>
                            <li><a href="/Troupers.php">Our Troupers</a></li>
                            <li><a href="/Shows.php">Our Shows</a></li>
                            <li><a href="/Venues.php">Our Venues</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </div>
    </header>
    <!-- MAIN -->
    <div id="main">

        <!-- social -->
        <div id="social-bar">
            <ul>
                <li>
                    <a href="https://www.facebook.com/MASC99" title="Become a fan" target="_blank">
                        <img src="/public/images/img/social/facebook_32.png" alt="Facebook" /></a>
                </li>
                <li>
                    <a href="https://twitter.com/MASC_mn" title="Follow our tweets" target="_blank">
                        <img src="/public/images/img/social/twitter_32.png" alt="Twitter" /></a>
                </li>
                <li>
                    <a href="http://www.razoo.com/story/Marshall-Area-Stage-Company" title="Donate to Masc" target="_blank">
                        <img src="/public/images/donate.png" alt="donate" style="max-width: 32px; max-height: 32px" />
                    </a>
                </li>
                <!-- <li><a href="http://www.google.com"  title="Add to the circle"><img src="/public/images/img/social/google_plus_32.png" alt="Facebook" /></a></li>-->
            </ul>
        </div>
        <!-- ENDS social -->
        <!-- Content -->
        <div id="content">
            
	<div id="masthead">
        <span class="head">Account Settings</span>
	      <!--  <button id="btnCreateEvent" style="float:right; margin:20px;">New Event</button>  -->
    </div>

    <div  id="admin-links" >
        <strong >Control Panel</strong>
    <ul >

        <?php if ((isset($_smarty_tpl->tpl_vars['groupLevel']->value)&&$_smarty_tpl->tpl_vars['groupLevel']->value==7)){?>
            <li>
                <span class='ui-icon ui-icon-key' style='float: left; margin-right: .3em;'></span>
                <a href='Admins.php'>Admins</a>

            </li>
        <?php }?>

        <?php if (($_smarty_tpl->tpl_vars['groupLevel']->value==7||$_smarty_tpl->tpl_vars['groupLevel']->value==6)){?>
                <li>
                    <span class='ui-icon ui-icon-note' style='float: left; margin-right: .3em;'></span>
                    <a href='SliderItems.php'>Front Page - SliderItems</a>
                </li>
        <?php }?>
            <li>
                <span class='ui-icon ui-icon-contact' style="float: left; margin-right: .3em;"></span><a href="Companies.php">Companies</a>
            </li>
            <li>
                <span class='ui-icon ui-icon-calendar' style="float: left; margin-right: .3em;"></span>
                <a href="ManageEvents.php">Manage Events</a>
            </li>
            <!--<li><span class='ui-icon ui-icon-calendar' style="float: left; margin-right: .3em;"></span>
                <a href="Event.php">Create Event</a>
            </li>-->
            <li>
                <span class='ui-icon ui-icon-person' style="float: left; margin-right: .3em;"></span>
                <a href="Troupers.php">Troupers</a>
            </li>
            <li>
                <span class='ui-icon ui-icon-home' style="float: left; margin-right: .3em;"></span>
                <a href="Venues.php">Venues</a>
            </li>
            <li>
                <span class='ui-icon ui-icon-image' style="float: left; margin-right: .3em;"></span>
                <a href="Sponsors.php">Sponsors</a>
            </li>
            <li>
                <span class="ui-icon ui-icon-key" style="float: left; margin-right: .3em;"></span>
                <a href="AccountSettings.php">Account Settings</a>
            </li>
            <?php if ((isset($_smarty_tpl->tpl_vars['groupLevel']->value)&&$_smarty_tpl->tpl_vars['groupLevel']->value==7)){?>
                <li>
                    <span class='ui-icon ui-icon-key' style='float: left; margin-right: .3em;'></span>
                    <a href='<?php echo $_smarty_tpl->tpl_vars['mysqlAdminLink']->value;?>
' target="_blank">MySql Admin</a>
                </li>
            <?php }?>
            <?php if ((isset($_smarty_tpl->tpl_vars['groupLevel']->value)&&$_smarty_tpl->tpl_vars['groupLevel']->value==7)){?>
                <li><span class="ui-icon ui-icon-key" style="float: left; margin-right: .3em;"></span><a href="info.php" target="_blank">Info</a>
                </li>
            <?php }?>
            <li>
                <span class='ui-icon ui-icon-clock' style="float: left; margin-right: .3em;"></span>
                <a href="Logout.php">Logout</a>
            </li>
        </ul>
    </div>

            

	<form id="FrmAcctSettings" method="post">
	    
	    <!--<div class="ui-widget-header ui-form-header">
	        <div class="ui-form-title" >
	            <span class='ui-icon ui-icon-person ui-form-header-icon'></span>
	            <span class='ui-icon ui-icon-key ui-form-header-icon' ></span>
	            <strong>Account Settings</strong>
	        </div>
	        <button type="submit" class="ui-form-submit">Update</button>
	    </div>   -->
	    <div class="ui-form-content">
	        <p class="input-section">
	            <span class='required' title='Required field.'>*</span><label for="firstname"><strong>First Name: </strong></label><br />
	            <input id="firstname" name="inFirstName" type="text" class="input-long" value="<?php echo $_smarty_tpl->tpl_vars['firstName']->value;?>
"/>
	        </p>
	        <p class="input-section">
	            <span class='required' title='Required field.'>*</span><label for="lastname"><strong>Last Name: </strong></label><br />
	            <input id="lastname" name="inLastName" type="text" class="input-long" value="<?php echo $_smarty_tpl->tpl_vars['lastName']->value;?>
" />
	        </p>
	        <p class="input-section">
	            <span class='required' title='Required field.'>*</span><label for="email"><strong>Email: </strong></label><br />
	            <input id="email" name="inEmail" type="text" class="input-long" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
"/>
	        </p>
	        <p>
	            <span class='required' title='Required field.'>*</span><label for="password"><strong>Current Password: </strong></label><br />
	            <input id="password" name="inCurrentPassword" type="password"  class="input-long"/>
	        </p>
	        <p>
	            <span class='required' title='Required field.'>*</span><label for="password"><strong>New Password: </strong></label><br />
	            <input id="password" name="inNewPassword" type="password"  class="input-long"/>
	        </p>
	        <p>
	            <span class='required' title='Required field.'>*</span><label for="confirm_password"><strong>Confirm New Password: </strong></label><br />
	            <input id="confirm_password" name="inConfirmNewPassword" type="password"  class="input-long"/>
	        </p>
	    </div>
	</form>




        </div>
        <!-- ENDS content -->
        <div class="clearfix"></div>
        <div class="shadow-main"></div>
    </div>
    <!-- ENDS MAIN -->

    <footer>
        <div class="wrapper">

            <ul id="footer-cols">

                <li class="first-col">

                    <div class="widget-block">
                        <h3><?php echo smarty_modifier_date_format(time(),"%Y");?>
 Season</h3>
                        <ul style="display: inline-block; margin-top: 0px; padding-top: 0px;">
                            <?php echo smarty_function_GetCurrentSeason(array(),$_smarty_tpl);?>

                        </ul>
                    </div>
                </li>

                <li class="second-col">
                    <div class="widget-block">
                        <h3>Our Theatre Friends</h3>
                        <ul style="display: inline-block; margin-top: 0px; padding-top: 0px;">
                            <li>
                                <a href="http://www.smsu.edu/academics/programs/theatrearts/" target="_blank">SMSU Theatre</a>
                            </li>
                            <li>
                                <a href="http://www.lakebentonoperahouse.org/" target="_blank">Lake Benton Opera House</a>
                            </li>
                            <li>
                                <a href="http://www.thebarntheatre.com" target="_blank">The Barn Theater</a></li>
                            <li>
                                <a href="http://www.pipestoneminnesota.com/artscenter/index.htm" target="_blank">Calumet Players</a></li>
                            <li>
                                <a href="http://www.redwoodareatheatre.org" target="_blank">Redwood Area Theatre (RAT)</a></li>
                        </ul>
                    </div>
                </li>

                <li class="third-col">
                    <div class="widget-block">
                        <div id="tweets" class="footer-col tweet">
                            <h4>MASC on twitter</h4>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="clearfix"></div>
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FMASC99&amp;colorscheme=light&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;send=true" 
                scrolling="no" frameborder="0" style="margin-left:24px; border: none; overflow: hidden; width: 60%; " allowtransparency="true"></iframe>
        </div>
        <div id="to-top"></div>
    </footer>
</body>
</html>
<?php }} ?>