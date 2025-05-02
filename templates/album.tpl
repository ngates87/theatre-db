<link rel="stylesheet" href="/public/css/jquery.lightbox-0.5.css" type="text/css" media="screen" />
<style>
    .preview {
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 2px;
        /*        border-left:1px solid black;
        border-top:1px solid black;*/
    }

    .thumbnail img {
        background-color: black;
        height: 75px;
        width: 75px;
    }

    .originals {
        text-decoration: none;
        margin-left: 5px;
    }
</style>
<script type="text/javascript" src="/public/javascript/shadows.js"></script>
<script type="text/javascript" src="/public/javascript/jquery.lightbox.js"></script>
{literal}
<script>
    $(document).ready(function () {
        //$(".thumbnail img").dropShadow();
        $(".thumbnail").lightBox({
            fixedNavigation: true
        });
        //        $(".originals").lightBox({fixedNavigation:true});
    });
</script>
{/literal}
{*<h1 class='ui-widget-header' style='margin:0px; margin-bottom:.5em; padding-left:25px;'>{$title}</h1>*}

	{assign var="max" value=4}
    {assign var="sponsorCnt" value=$pictures|@count}
    {for $i=0 to $sponsorCnt}
		{if ($i % $max) == 0}
        <div class="row">
            {/if}
            <div class='col-sm-{12/$max}'>
                <a href='{$pictures[$i]["url_m"]}' title='Meduim Size' rel='lightbox[set]' class='thumbnail' data-original='{$pictures[$i]["url_o"]}'>
                    <img src='{$pictures[$i]["thumbnailImg"]}' />
                </a>
            </div><!---End cell $i == {$i}-->
            {if ((($i % $max) +1) == $max) || $i==$sponsorCnt}
        </div><!---End Row $i == {$i}-->
		{/if}
    {/for}

<div id='fb-root'></div>
<script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script>
<fb:comments href='{$thisUrl}' num_posts='2' width='500'></fb:comments>
