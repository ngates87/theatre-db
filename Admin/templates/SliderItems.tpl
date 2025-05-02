{extends file="templates/securemaster.tpl"}

{block name=scripts append}
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="/public/javascript/jquery.validate.js"></script>
<script src="/public/javascript/charCount/charCount.js"></script>
<script src="/public/javascript/slides/slides.jquery.js"></script>
<script type="text/javascript" src="/public/javascript/admin/sliderItems.js"></script>
{/block}
{block name=css append}
<link rel="stylesheet" type="text/css" href="/public/css/slides/slides.css" />
<style>
    form .counter {
        /*position:absolute;*/
        right: 0;
        top: 0;
        font-size: 18px;
        color: #ccc;
    }

    form .warning {
        color: #600;
    }

    form .exceeded {
        color: #e00;
    }

    .slides_container {
        max-width: 800px;
        height: 450px;
    }

        .slides_container div.slide {
            max-width: 800px;
            height: 450px;
            display: block;
        }
        
    .previewImage{
    	max-height: 205px;
    }

    .slideItem {
        margin: 10px;
        display:inline-block; 
        box-shadow: 10px 10px 5px #888888;
    }
    .disabled{
    	opacity: .4;
    }
    
    .controlsBox {
        position: absolute;
        display: inline-block;
        top: 0px;
        left: 0px;
        background: gray;
        opacity: 0;
        padding:.25em;
        color:black;
       
    }

        .controlsBox span {
            cursor:pointer;
        }


        .slideItem:hover .controlsBox {
            opacity: 1;
        }
</style>
{/block}
{block name=body prepend}

<div id="masthead">
    <span class="head">Slider Items</span>
    <button id="btnNew" class="ui-form-submit" style="float: right;">Create</button>
    <button id="btnPreview" class="ui-form-submit" style="float: right;">Preview</button>
</div>
{/block}
{block name=content}

<div id="dlgPreview">
    <div id="slides">
        <div class="slides_container" id="previewSlider">
        </div>
        <!--<a href="#" class="prev"><img src="/public/css/slides/img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
        <a href="#" class="next"><img src="/public/css/slides/img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>-->
    </div>
</div>
<div id="dialog">
    <div class="ui-widget" id="errorMsg">
        <div class="ui-state-error ui-corner-all" style="padding: 0 .7em; display: none;">
            <p>
                <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                <strong>Error:</strong> <span id="errorText"></span>
            </p>
        </div>
    </div>
    <form id="frm" action="Ajax/SliderItems.php" enctype="multipart/form-data" method="post">
        <input type="hidden" id="inSliderID" name="id" />
        <!--<img id="preview" src='/Includes/Objects/ImageHandler.php?ImageID={$imageID}' alt='currently uploaded image'/>-->
        <div>
            <label for="inEnabled"><strong>Enabled</strong></label>
            <input id="inEnabled" name="enabled" type="checkbox" />
        </div>
        <p>
            <label for="website"><strong>Website</strong></label><br />

            <input id="inHyperlink" name="hyperlink" type="url" class="input-url" maxlength="512" />
        </p>
        <p>
            <label><strong>Caption</strong></label><br />
            <textarea id="inCaption" name="caption" rows="7" maxlength="512" style="width: 99%;"></textarea>
        </p>
        <p>
            <span class='required' title='Required field.'>*</span>
            <label for="inImage">
                <strong>Image</strong>
            </label>
            <br />
            <input id="inLogo" name="image" type="file" /><br />
        </p>
        <img id="preview" alt='currently uploaded image' style='max-height: 250px;' />
    </form>
    <div id="loading" style="display: none;">
        <!-- ui-dialog -->
        <div class="ui-overlay">
            <div class="ui-widget-overlay"></div>
            <div class="ui-widget-shadow ui-corner-all" style="width: 122px; height: 122px; position: absolute; left: 34%; top: 30px;"></div>
        </div>
        <div style="position: absolute; width: 100px; height: 100px; left: 34%; top: 30px; padding: 10px;" class="ui-widget ui-widget-content ui-corner-all">
            <img src="/public/images/ajax-loader.gif" alt="loading" />
        </div>
    </div>
</div>

<div class="ui-form-content">
    {foreach from=$sliderItems item=sliderItem}
                <div style="position: relative;" class="slideItem">
                    {if $sliderItem['enabled']}
                         <img class="previewImage" src='/Includes/Objects/ImageHandler.php?ImageID={$sliderItem["imageID"]}'>
                    {else}
                        <img class="previewImage disabled" src='/Includes/Objects/ImageHandler.php?ImageID={$sliderItem["imageID"]}'>
                    {/if}
                   
                    <div class="controlsBox ui-corner-all">
                        <a class="viewedit" data-id="{$sliderItem['id']}" href='#'>
                         <span class='ui-icon ui-icon-pencil' style="display: inline-block;"></span>

                        </a>
                        <a class="delete" title='Delete Sponsor' href='#' data-id="{$sliderItem['id']}">
                            <span class='ui-icon ui-icon-trash' style="display: inline-block;"></span>
                        </a>
                        <div style="display:inline-block;">
                            {if $sliderItem['enabled']}
                                <input class="enableItem" type="checkbox"  value="{$sliderItem['id']}" checked />
                            {else}
                                <input class="enableItem"type="checkbox" value="{$sliderItem['id']}" />
                            {/if}
                            <strong>Enabled</strong> 
                        </div>
                        <em>{$sliderItem['hyperlink']}</em>
                    </div>
                    <!--
                    <td class="enabled">{$sliderItem['enabled']}</td>
                    <td class="hyperlink">{$sliderItem['hyperlink']}</td>
                    <td></td>
                    <td>{$sliderItem["caption"]}
                    </td>
                    -->
                </div>
    {/foreach}

</div>

{/block}