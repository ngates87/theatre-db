<?php /* Smarty version Smarty-3.1.12, created on 2014-02-18 22:09:29
         compiled from "templates/manageevents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49299628753042e79b4cf89-21333437%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd364cbe8672e1f6bde888259c8be999c5d47d678' => 
    array (
      0 => 'templates/manageevents.tpl',
      1 => 1390785863,
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
  'nocache_hash' => '49299628753042e79b4cf89-21333437',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_53042e79d7e971_96864724',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53042e79d7e971_96864724')) {function content_53042e79d7e971_96864724($_smarty_tpl) {?><?php if (!is_callable('smarty_function_GetCurrentSeason')) include '/home/masc/www/Includes/3rdPartyLibs/smarty/plugins/function.GetCurrentSeason.php';
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

    <link href="/public/css/jquery.ui.timepicker.css" rel="stylesheet" type="text/css"/>
    <link href="/public/packages/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css"/>
    <!--<link href="/public/css/Admin.css" rel="stylesheet" type="text/css"/>-->
    <link href="/public/css/smart_wizard.css" rel="stylesheet" type="text/css"/>



    <script type="text/javascript" src="/public/javascript/blackbirdjs/blackbird.js"></script>
    <script src="/public/javascript/jquery.validate.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    
        <!--  <script src="/public/javascript/jquery.validate.js" type="text/javascript"></script>
          <script src="/public/javascript/jquery.ui.widget.js" type="text/javascript"></script>
          <script src="/public/javascript/jquery.ui.core.js" type="text/javascript"></script>-->
        <script src="/public/javascript/jquery.ui.timepicker.js" type="text/javascript"></script>
        <script type="text/javascript" src="/public/javascript/jquery.tabledrag.js"></script>
        <script type="text/javascript" src="/public/javascript/jquery.tableEditor.js"></script>
        <script type="text/javascript" src="/public/javascript/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="/public/packages/jwysiwyg/jquery.wysiwyg.js"></script>
        <!--<script type="text/javascript" src="/public/javascript/admin/addEvent.js"></script>-->
        <script type="text/javascript" src="/public/javascript/date.js"></script>
        <!-- <script type="text/javascript" src="/public/javascript/jquery.form.wizard.js"></script>-->
        <script type="text/javascript" src="/public/javascript/jquery.smartWizard.js"></script>
        <script type="text/javascript" src="/public/javascript/admin/manageEvent.ts"></script>

        <script type="text/javascript">
            $(function() {
                // 
                $('#wizard').smartWizard({
                    enableAllSteps: true,
                    transitionEffect: "slideleft",
               });
// // $("#frmEvent").formwizard(
                //);
            });
        </script>
    

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
            
    <div id = "masthead">
        <span class="head">Manage Events</span>
        <button id="btnCreateEvent" style="float:right; margin:20px;">New Event</button>  
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

            

    <div id="dialog" title="Create Event" style="display:none;">
        <div class="ui-widget" id="errorMsg">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;display:none;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>Error:</strong> <span id="errorText"></span></p>
            </div>
        </div>
        <div id="wizard" class="swMain">
             <ul>
                    <li><a href="#step-1">
                            <label class="stepNumber">1</label>
                            <span class="stepDesc">
                                Event Info<!--<br />
                                <small>Event Info</small>-->
                            </span>
                        </a></li>
                    <li><a href="#step-2">
                            <label class="stepNumber">2</label>
                            <span class="stepDesc">
                                Prices<!--<br />
                                <small>Prices</small>-->
                            </span>
                        </a></li>
                    <li><a href="#step-3">
                            <label class="stepNumber">3</label>
                            <span class="stepDesc">
                                Show Notes<!--<br />
                                <small>Show Notes</small>-->
                            </span>                   
                        </a></li>
                    <li><a href="#step-4">
                            <label class="stepNumber">4</label>
                            <span class="stepDesc">
                                Event Admins<!--<br />
                                <small>Event Admin</small>-->
                            </span>                   
                        </a>
                    </li>
                    <li><a href="#step-5">
                            <label class="stepNumber">5</label>
                            <span class="stepDesc">
                                Venue<!--<br />
                                <small>Location, Location!</small>-->
                            </span>                   
                        </a>
                    </li>    
                    <li><a href="#step-6">
                            <label class="stepNumber">6</label>
                            <span class="stepDesc">
                                Cast & Crew<!--<br />-->
                            </span>                   
                        </a>
                    </li>
                </ul>
            <form id="frmEvent" action="Ajax/Events.php" method="post" style="clear:both;">
               
                <div id="step-1">
                    <input type="hidden" id="inEventID"/>
                    <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inEventTitle">Event
                            Title</label>
                        <br/>
                        <input id="inEventTitle" name="inEventTitle" type="text" required="required" class="input-long" value=""/>
                    </p>

                    <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inEventSlug">Event
                            Slug</label>
                        <br/>
                        <input id="inEventSlug" name="inEventSlug" type="text" required="required" class="input-long" value=""/>
                    </p>
                    <p class="input-section">
                        <input id="inActive" name="inActive" type="checkbox" /><label for="inActive">Active</label>
                    </p>
                    <p class="input-section"><span class='required' title='Required field.'>*</span><label for="inCompany">Company
                            (presenters)</label>
                        <br/>
                        <select id="inCompany" name="inCompany" required="required">
                            <?php  $_smarty_tpl->tpl_vars['company'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['company']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['companies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['company']->key => $_smarty_tpl->tpl_vars['company']->value){
$_smarty_tpl->tpl_vars['company']->_loop = true;
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['company']->value["id"];?>
'><?php echo $_smarty_tpl->tpl_vars['company']->value["name"];?>
</option>
                            <?php } ?>
                        </select>
                    </p>
                    <p class="input-section">
                        <label for="inArtfullyID">Artfully Event ID</label>
                        <br/>
                        <input id="inArtfullyID" name="inArtfullyID" type="text" value=""/>
                    </p>
                </div>
                <div id="step-2">
                    <p class="input-section">
                        <label for="inPreShowPrice">Pre-Event Price</label>
                        <br/>
                        <input id="inPreShowPrice" name="inPreShowPrice" type="text" class="input-long" value=""/>
                    </p>

                    <p class="input-section"><label for="inDoorPrice">Door Price</label>
                        <br/>
                        <input id="inDoorPrice" name="inDoorPrice" type="text" class="input-long" value=''/>
                    </p>
                </div>
                <div id="step-3">
                    <div>
                        <label for="inShowNotes">Event Notes</label>
                        <br/>
                        <textarea name="inShowNotes" id="inShowNotes" rows="10" cols="90" style="width:100%;"></textarea>
                    </div>
                </div>
                <div id="step-4">
                    <strong> Event Admin</strong>
                    <table class="data-table">
                        <thead>
                            <tr class="ui-widget-header">
                                <th>Full Name</th>
                                <th style="width:16px;"></th>
                            </tr>
                        </thead>
                        <tbody id="eventAdmin">
                            <tr>
                                <td>
                                    <select name="inEventAdmin" id="inEventAdmin">
                                        <option value=""></option>
                                        <?php  $_smarty_tpl->tpl_vars['admin'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['admin']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['admins']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['admin']->key => $_smarty_tpl->tpl_vars['admin']->value){
$_smarty_tpl->tpl_vars['admin']->_loop = true;
?>
                                            <option value='<?php echo $_smarty_tpl->tpl_vars['admin']->value["id"];?>
'><?php echo $_smarty_tpl->tpl_vars['admin']->value["name"];?>
</option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <a href='#' title='Add Row' id="btnAddAdmin">
                                        <span class='ui-icon ui-icon-plusthick'></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="step-5">
                    <strong>Setup Event</strong>
                    <table id="tblEventInfo" class="data-table">
                        <thead>
                            <tr class="ui-widget-header">
                                <th></th>
                                <th style="width:50%;">Venue</th>
                                <th style="width:25%;">Date/Time</th>
                                <th style="width:25%;">Type</th>
                                <th colspan="2" class="action"></th>
                            </tr>
                        </thead>
                        <tbody id="eventInfo">
                            <tr>
                                <td/>
                                <!-- place holder -->
                                <td>
                                    <select id="selectVenues">
                                        <?php  $_smarty_tpl->tpl_vars['venue'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['venue']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['venues']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['venue']->key => $_smarty_tpl->tpl_vars['venue']->value){
$_smarty_tpl->tpl_vars['venue']->_loop = true;
?>
                                            <?php if ($_smarty_tpl->tpl_vars['venue']->value["selected"]==true){?>
                                                <option value='<?php echo $_smarty_tpl->tpl_vars['venue']->value["id"];?>
' selected='true'><?php echo $_smarty_tpl->tpl_vars['venue']->value["title"];?>
</option>
                                            <?php }else{ ?>
                                                <option value='<?php echo $_smarty_tpl->tpl_vars['venue']->value["id"];?>
'><?php echo $_smarty_tpl->tpl_vars['venue']->value["title"];?>
</option>
                                            <?php }?>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input id="inEventDateTime" class="dateTime" type="text"/>
                                </td>
                                <td>
                                    <select id="inEventCategory" name="inEventCategory">
                                        <option value=""></option>
                                        <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['itemTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
                                            <option value='<?php echo $_smarty_tpl->tpl_vars['type']->value["id"];?>
'><?php echo $_smarty_tpl->tpl_vars['type']->value["name"];?>
</option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td/>
                                <td>
                                    <a href='#' title='Add Row' id="btnAddEventInfo">
                                        <span class='ui-icon ui-icon-plusthick'></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="step-6">
                    <strong>Choose Troupers (cast & crew)</strong>
                    <table id="tblTroupersInfo" class="data-table">
                        <thead>
                            <tr class="ui-widget-header">
                                <th class="action"></th>
                                <th style="width:50%;">Person</th>
                                <th style="width:50%;">Role</th>
                                <th>Category</th>
                                <th class="action" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody id="trouperInfo">
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <select id="selectTrouper">
                                        <?php  $_smarty_tpl->tpl_vars['trouper'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['trouper']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['troupers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['trouper']->key => $_smarty_tpl->tpl_vars['trouper']->value){
$_smarty_tpl->tpl_vars['trouper']->_loop = true;
?>
                                            <option value='<?php echo $_smarty_tpl->tpl_vars['trouper']->value["id"];?>
'><?php echo $_smarty_tpl->tpl_vars['trouper']->value["name"];?>
</option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input id="inRole" type="text" class="input-long"/>
                                </td>
                                <td>
                                    <select id="selectTrouperCategory">
                                        <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['trouperCategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>
                                            <option value='<?php echo $_smarty_tpl->tpl_vars['cat']->value["id"];?>
'><?php echo $_smarty_tpl->tpl_vars['cat']->value["display"];?>
</option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <a href='#' title='Add Row' id="btnAddTrouperInfo">
                                        <span class='ui-icon ui-icon-plusthick'></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div id="loading" style="display:none;">
            <!-- ui-dialog -->
            <div class="ui-overlay">
                <div class="ui-widget-overlay"></div>
                <div class="ui-widget-shadow ui-corner-all"
                     style="width: 122px; height: 122px; position: absolute; left: 35%; top: 35%;"></div>
            </div>
            <div style="position: absolute; width: 100px; height: 100px;left: 35%; top: 35%; padding: 10px;"
                 class="ui-widget ui-widget-content ui-corner-all">
                <img src="/public/images/ajax-loader.gif" alt="loading"/>
            </div>
        </div>
    </div>

    <div class="content-box">
  
       <!--  <div class="ui-form-header">
           <div class="ui-form-title">
                <span class="ui-icon ui-icon-info ui-form-header-icon" ></span>-->
                <!--<h1 class="content-box-heading">Manage Events
                    <button id="btnCreateEvent" style="float:right;">New Event</button>    
                    <h1>

                        </div>
                        </div>
                        <br/>-->
                        <table class="data-table" style="margin-bottom: 20px;">
                            <thead>
                                <tr >
                                    <th></th>
                                    <th style="width: 33%;">Title</th>
                                    <th style="width:33%;">Company</th>
                                    <th style="width:34%;">Url Slug</th>
                                    <!--<th style="width:16px;"></th>-->
                                    <th style="width:16px;"></th>
                                    <th style="width:16px;"></th>
                                </tr>
                            </thead>
                            <tbody id="tblEvents">
                                <?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['events']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
                                    <tr>
                                        <td>
                                            <?php if ($_smarty_tpl->tpl_vars['event']->value["canUpdate"]==true){?>
                                                <?php if ($_smarty_tpl->tpl_vars['event']->value["active"]==true){?>
                                                    <input title='make part of the current season' type='checkbox' class='activeEvent'
                                                           value='<?php echo $_smarty_tpl->tpl_vars['event']->value["id"];?>
' checked="checked"/>
                                                <?php }else{ ?>
                                                    <input title='make part of the current season' type='checkbox' class='activeEvent'
                                                           value='<?php echo $_smarty_tpl->tpl_vars['event']->value["id"];?>
'/>
                                                <?php }?>
                                            <?php }?>
                                        </td>
                                        <td><a title='Preview Event' href='/Admin/ViewEvent.php?EventID=<?php echo $_smarty_tpl->tpl_vars['event']->value["id"];?>
'><?php echo $_smarty_tpl->tpl_vars['event']->value["title"];?>
</a></td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['event']->value["company"];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['event']->value["slug"];?>
</td>
                                        
                                        <td>
                                            <?php if ($_smarty_tpl->tpl_vars['event']->value["canUpdate"]==true){?>
                                                <a title='Edit Event' href='/Admin/Event.php?EventID=<?php echo $_smarty_tpl->tpl_vars['event']->value["id"];?>
' data-id="<?php echo $_smarty_tpl->tpl_vars['event']->value["id"];?>
"
                                                   class="read">
                                                    <span class='ui-icon ui-icon-pencil'></span>
                                                </a>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if ($_smarty_tpl->tpl_vars['event']->value["canDelete"]==true){?>
                                                <a title='Delete Event' href='#' onclick='RemoveEvent(<?php echo $_smarty_tpl->tpl_vars['event']->value["id"];?>
);'>
                                                    <span class='ui-icon ui-icon-trash'></span>
                                                </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    


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