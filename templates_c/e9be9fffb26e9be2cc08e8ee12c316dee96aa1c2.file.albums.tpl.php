<?php /* Smarty version Smarty-3.1.12, created on 2014-02-19 13:49:39
         compiled from "templates/albums.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98291217853050ad3f3ac56-24871312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9be9fffb26e9be2cc08e8ee12c316dee96aa1c2' => 
    array (
      0 => 'templates/albums.tpl',
      1 => 1390786663,
      2 => 'file',
    ),
    'c1853c97e2180af82cfb227e831a70b7b4828896' => 
    array (
      0 => './templates/master.tpl',
      1 => 1390786664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98291217853050ad3f3ac56-24871312',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_53050ad41618f7_08743099',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53050ad41618f7_08743099')) {function content_53050ad41618f7_08743099($_smarty_tpl) {?><?php if (!is_callable('smarty_function_GetCurrentSeason')) include '/home/masc/www/Includes/3rdPartyLibs/smarty/plugins/function.GetCurrentSeason.php';
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

    
<link href="/public/css/jquery.qtip.min.css" rel="stylesheet" type="text/css" />
<style type="text/css" append>
    #albums li{
        list-style:none;
        display:inline-block;
    }

    .album
    {
        /*display: inline-block;*/
        float:left;
        width:175px; 
        height:150px;
        overflow:hidden;
        padding:5px;
        margin-right:10px;
        margin-top:10px;
        text-align:left;
        border-top:1px solid gray;
        border-left:1px solid gray;
        background-color: white;

    }
    .album a
    {
        text-decoration: none;
    }
    .image
    {
        height:75px;
        width:75px;
        background-color:black;
        float:left; 
        margin-right:5px;
    }
</style>



<script src="/public/javascript/jquery.qtip.js" type="text/javascript"></script>
<script src="/public/javascript/shadows.js" type="text/javascript"></script>

    <script>
        $(document).ready(function()
        {
            $(".viewAlbum").click(function(){
                var $link = $(this);
                var $dialog = $('<div></div>')
                    .load($link.attr('href'),{setid:$link.attr("data-setid")})
                    .dialog({
                            autoOpen: false,
                            modal:true,
                            title: $link.attr('title'),
                            width: 800,
                            height:500,
                            zIndex:59,
                            close: function() { 
                                $(this).dialog('destroy'); 
                                $(this).remove();
                            }
                    });
            
                $dialog.dialog('open');
                return false;
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
            
    <div id = "masthead">
        <span class = "head">Photo Albums</span>
    </div>
<div class="content-box">
    <ul id="albums">
        <?php  $_smarty_tpl->tpl_vars['album'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['album']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['albums']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['album']->key => $_smarty_tpl->tpl_vars['album']->value){
$_smarty_tpl->tpl_vars['album']->_loop = true;
?>
            <li>
                <div class='album' title='<?php echo $_smarty_tpl->tpl_vars['album']->value["title"];?>
'>
                    <a class="viewAlbum" href='/ViewAlbum.php' data-setid='<?php echo $_smarty_tpl->tpl_vars['album']->value["setID"];?>
' title='<?php echo $_smarty_tpl->tpl_vars['album']->value["title"];?>
' >
                        <div class='ui-widget-header' style='margin-bottom:10px;'><?php echo $_smarty_tpl->tpl_vars['album']->value["title"];?>
</div>
                        <div class='image'><img src='<?php echo $_smarty_tpl->tpl_vars['album']->value["thumbnailImg"];?>
' alt='' height='75' width='75' /></div><span><?php echo $_smarty_tpl->tpl_vars['album']->value["photoCount"];?>
 - photos</span><hr/>
                        <span><?php echo $_smarty_tpl->tpl_vars['album']->value["description"];?>
</span>
                    </a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<div id='fb-root'></div><script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script><fb:comments href='<?php echo $_smarty_tpl->tpl_vars['thisUrl']->value;?>
' num_posts='2' width='500'></fb:comments>

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