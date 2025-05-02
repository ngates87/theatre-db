<?php /* Smarty version Smarty-3.1.12, created on 2014-02-19 01:11:47
         compiled from "templates/album.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1813751292530459339abd41-71363988%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4366429c950b596c3255f908e1753b07496bab9c' => 
    array (
      0 => 'templates/album.tpl',
      1 => 1390786663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1813751292530459339abd41-71363988',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pictures' => 0,
    'picture' => 0,
    'thisUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_53045933a2e4b4_00763176',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53045933a2e4b4_00763176')) {function content_53045933a2e4b4_00763176($_smarty_tpl) {?><link rel="stylesheet" href="/public/css/jquery.lightbox-0.5.css" type="text/css" media="screen" />
<style>
    .preview
    {
        display:inline-block;
        margin-right:5px;
        margin-bottom: 2px;
/*        border-left:1px solid black;
        border-top:1px solid black;*/
    }
    .thumbnail img
    {
        background-color:black;
        height:75px;
        width:75px; 
    }
    .originals
    {
        text-decoration: none;
        margin-left:5px;
    }

</style>
<script  type="text/javascript" src="/public/javascript/shadows.js"></script>
<script  type="text/javascript" src="/public/javascript/jquery.lightbox.js"></script>

<script>
    $(document).ready(function()
    {
        //$(".thumbnail img").dropShadow();
        $(".thumbnail").lightBox({
            fixedNavigation:true
        });
//        $(".originals").lightBox({fixedNavigation:true});
    });
</script>



<?php  $_smarty_tpl->tpl_vars['picture'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['picture']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pictures']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['picture']->key => $_smarty_tpl->tpl_vars['picture']->value){
$_smarty_tpl->tpl_vars['picture']->_loop = true;
?>
    <div class='preview'>
        <a href='<?php echo $_smarty_tpl->tpl_vars['picture']->value["url_m"];?>
' title='Meduim Size' rel='lightbox[set]' class='thumbnail' data-original='<?php echo $_smarty_tpl->tpl_vars['picture']->value["url_o"];?>
'>
            <img src='<?php echo $_smarty_tpl->tpl_vars['picture']->value["thumbnailImg"];?>
' /></a><br/>
        <!--<a class='originals' title='Original Sizes' href='<?php echo $_smarty_tpl->tpl_vars['picture']->value["url_o"];?>
'>Original</a>-->
    </div>
<?php } ?>
<div id='fb-root'></div>
    <script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script>
    <fb:comments href='<?php echo $_smarty_tpl->tpl_vars['thisUrl']->value;?>
' num_posts='2' width='500'></fb:comments>
<?php }} ?>