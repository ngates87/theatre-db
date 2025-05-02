{extends file="master.html"}
{block name=css append}
<link href="/public/css/jquery.qtip.min.css" rel="stylesheet" type="text/css" />
<style type="text/css" append>
    #albums li {
        list-style: none;
        display: inline-block;
    }

    .album {
        /*display: inline-block;*/
        float: left;
        width: 175px;
        height: 150px;
        overflow: hidden;
        padding: 5px;
        margin-right: 10px;
        margin-top: 10px;
        text-align: left;
        border-top: 1px solid gray;
        border-left: 1px solid gray;
        background-color: white;
    }

        .album a {
            text-decoration: none;
        }

    .image {
        height: 75px;
        width: 75px;
        background-color: black;
        float: left;
        margin-right: 5px;
    }
</style>
{/block}
{block name=scripts append}
<script src="/public/javascript/jquery.qtip.js" type="text/javascript"></script>
<script src="/public/javascript/shadows.js" type="text/javascript"></script>
{literal}
<script>
    $(document).ready(function () {
        $(".viewAlbum").click(function () {
            var $link = $(this);
            var $dialog = $('<div></div>')
                .load($link.attr('href'), { setid: $link.attr("data-setid") })
                .dialog({
                    autoOpen: false,
                    modal: true,
                    title: $link.attr('title'),
                    width: 800,
                    height: 500,
                    zIndex: 59,
                    close: function () {
                        $(this).dialog('destroy');
                        $(this).remove();
                    }
                });

            $dialog.dialog('open');
            return false;
        });

    });
</script>
{/literal}
{/block}
{block name=body}
<div id="row">
    <div class="col-lg-12">
        <h2 class="head">Photo Albums</h2>
    </div>
</div>
	{assign var="max" value=5}
    {assign var="sponsorCnt" value=$albums|@count}
    {for $i=0 to $sponsorCnt}
		{if ($i % $max) == 0}
<div class="row">
    {/if}
    <div class='col-md-{12/$max}'>
        <div class='album' title='{$albums[$i]["title"]}'>
            <a class="viewAlbum" href='/ViewAlbum.php' data-setid='{$albums[$i]["setID"]}' title='{$albums[$i]["title"]}'>
                <h4  style='margin-bottom:10px;'>{$albums[$i]["title"]}</h4>
                <div class='image'>
                    <img src='{$albums[$i]["thumbnailImg"]}' alt='' class="img-responsive" />
                </div><span>{$albums[$i]["photoCount"]} - photos</span><hr />
                <span>{$albums[$i]["description"]}</span>
            </a>
        </div>
    </div><!---End cell $i == {$i}-->
    {if ((($i % $max) +1) == $max) || $i==$sponsorCnt}
</div><!---End Row $i == {$i}-->
		{/if}
    {/for}

<div id='fb-root'></div>
<script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script><fb:comments href='{$thisUrl}' num_posts='2' width='500'></fb:comments>
{/block}