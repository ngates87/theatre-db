<?php /* Smarty version Smarty-3.1.12, created on 2014-03-10 22:29:44
         compiled from "/home/masc/www/templates/viewevent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:994846221531e83288620d9-71976560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c510aa38f544400e53119a3a88afaef1145b570' => 
    array (
      0 => '/home/masc/www/templates/viewevent.tpl',
      1 => 1390786665,
      2 => 'file',
    ),
    '387bf00b45a092e3f146406ae2419ee5cabf8f5f' => 
    array (
      0 => '/home/masc/www/templates/master.tpl',
      1 => 1390786664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '994846221531e83288620d9-71976560',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_531e8329166732_87786395',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531e8329166732_87786395')) {function content_531e8329166732_87786395($_smarty_tpl) {?><?php if (!is_callable('smarty_function_GetCurrentSeason')) include '/home/masc/www/Includes/3rdPartyLibs/smarty/plugins/function.GetCurrentSeason.php';
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

    
    <link href="/public/css/pages/ViewEvent.css" rel="stylesheet" />
<!--<link href="../public/css/jquery.qtip.min.css" rel="stylesheet"/>
    <link href="http://media1.juggledesign.com/qtip2/css/demos.css" />-->
<style>
    .TrouperTip {
        width: 500px;
    }
</style>



    <!--<script src="../public/javascript/Qtip/jquery.qtip.js"></script>-->
<script>
    
    $(function () {

        try {
            $("#buyTickets").button();
            $("#tabs").tabs();
        }
        catch (exception) {
            alert(exception);
        }

        $("#dialog").dialog(
                {
                    autoOpen: false,
                    width: 500,
                    buttons: {
                        "continue": function () {
                            window.open($("#buyTickets").attr("href"));
                            $("#dialog").dialog("close");
                        }
                    }
                });
        $("#buyTickets").click(function (e) {
            e.preventDefault();
            $("#dialog").dialog("open");
        });


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
            
    <div id="masthead">
        <span class="head"><?php echo $_smarty_tpl->tpl_vars['company']->value;?>
 proudly presents... </span>
    </div>
<!-- <h2 id = "companyHeader"><?php echo $_smarty_tpl->tpl_vars['company']->value;?>
 presents... </h2><hr/> -->
<h1 class='center' id='showTitle'><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 </h1>
<?php if (isset($_smarty_tpl->tpl_vars['artfullyID']->value)&&$_smarty_tpl->tpl_vars['artfullyID']->value>0){?>

        <a id="buyTickets" href='https://www.artfullyhq.com/store/events/<?php echo $_smarty_tpl->tpl_vars['artfullyID']->value;?>
' class="button center" style="width: 100%;">BUY TICKETS ONLINE! </a>

<div id="dialog" title="Confirm Before Continuing">
    <p>
        You are about to open a new tab / window to <strong>Artufllyhq.com (referred to as Artfully) </strong>,
                Artfully is a third party website / web service, utilized by <strong>Marshall Area Stage Company (referred to as MASC) </strong>for online ticket sales,
                MASC is in no way associated with Artfully or vice versa.
    </p>
    <p>
        By continuing to Artfully, you acknowledge that MASC provides no warranty nor assumes any liability implied or otherwise
                during the use of Artfully.
    </p>
    <p>
        You will also most likely be charged a approx <strong>$2.00 </strong>service charge by Artfully, 
                in addition to the normal ticket price.
    </p>
</div>
<?php }?>
    <div id='pNotes' class="infoBox-content"><?php echo $_smarty_tpl->tpl_vars['notes']->value;?>
 </div>

<?php if (isset($_smarty_tpl->tpl_vars['earlyTicketPrice']->value)||isset($_smarty_tpl->tpl_vars['doorTicketprice']->value)){?>
        <div class=" infoBox">
            <h3>Admission </h3>
            <div class="infoBox-content">
                Pre - Show Price: <strong><?php echo $_smarty_tpl->tpl_vars['earlyTicketPrice']->value;?>
 </strong>
                <br />
                Door Price: <strong><?php echo $_smarty_tpl->tpl_vars['doorTicketPrice']->value;?>
 </strong>
            </div>
        </div>
<?php }?>
  
    <?php if (isset($_smarty_tpl->tpl_vars['eventInfo']->value)){?>
        <?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['eventInfo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
 $_smarty_tpl->tpl_vars['type']->value = $_smarty_tpl->tpl_vars['info']->key;
?>
            <div class="infoBox">
            <h3><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
 </h3>
            <div class="infoBox-content">
                <table class="data-table responsive">
                    <tbody>
                        <?php  $_smarty_tpl->tpl_vars['itemInfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemInfo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemInfo']->key => $_smarty_tpl->tpl_vars['itemInfo']->value){
$_smarty_tpl->tpl_vars['itemInfo']->_loop = true;
?>
                            <tr>
                                <td title='Click for venue information'>
                                    <a href='ViewVenue.php?VenueID=<?php echo $_smarty_tpl->tpl_vars['itemInfo']->value["venueID"];?>
'>
                                        <span class='ui-icon ui-icon-link' style='float: left'></span><?php echo $_smarty_tpl->tpl_vars['itemInfo']->value["venueName"];?>

                                    </a>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['itemInfo']->value["when"];?>
 </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['itemInfo']->value["type"];?>
 </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
<?php }?>

    <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['troupers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
 $_smarty_tpl->tpl_vars['type']->value = $_smarty_tpl->tpl_vars['category']->key;
?>
        <div class="infoBox">
            <h3 class=""><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
 </h3>
            <div class="infoBox-content">
                <table class='data-table responsive'>
                    <tbody>
                        <?php  $_smarty_tpl->tpl_vars['person'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['person']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['person']->key => $_smarty_tpl->tpl_vars['person']->value){
$_smarty_tpl->tpl_vars['person']->_loop = true;
?>
                            <tr>
                                <td title='Click to get trouper information'>
                                    <a class="trouper" href='http://marshallareastagecompany.org/ViewTrouper.php?TrouperID=<?php echo $_smarty_tpl->tpl_vars['person']->value["trouperID"];?>
' rel='http://marshallareastagecompany.org/ajaxViewTrouper.php?TrouperID=<?php echo $_smarty_tpl->tpl_vars['person']->value["trouperID"];?>
'>
                                        <span class='ui-icon ui-icon-link' style='float: left'></span><?php echo $_smarty_tpl->tpl_vars['person']->value['fullName'];?>
</a>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['person']->value["role"];?>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php } ?>
    <div id='fb-root'>
    </div>
<!-- <script src = 'http://connect.facebook.net/en_US/all.js#xfbml=1'></script>
<fb:comments href='<?php echo $_smarty_tpl->tpl_vars['currentUrl']->value;?>
' num_posts='2' width='500'></fb:comments>-->

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