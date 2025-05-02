/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $(".enableItem").change(function () {
        var id = $(this).val();
        var enable = $(this).is(":checked");
        var oThis = this;
        $.post("Ajax/SliderItems.php", {
            action: "enable",
            id: id,
            enable: enable
        }, function (msg) {
            //alert(msg);
            log.info(msg);
            if (msg.result != true) {
                //$(oThis).removeAttr("checked");
                //alert($(oThis).prevAll(".previewImage"));
                // $(oThis).parents("div.slideItem").find("img.previewImage").removeClass("disabled");
                alert("Error updating item");
            }

            else {

                if (enable == true) {
                    $(oThis).parents("div.slideItem").find("img.previewImage").removeClass("disabled");
                }

                else {
                    $(oThis).parents("div.slideItem").find("img.previewImage").addClass("disabled");
                }
                

            }

            //previewImage

        }, "json");
    });

    $("#dlgPreview").dialog({
        autoOpen: false,
        modal: true,
        width: 815,
        height: 575,
        open: function () {
            log.info("dlgPreview open");
            $.post("Ajax/SliderItems.php", {
                action: "readAll"
            }, function (data) {

                $.each(data, function (index, value) {
                    var caption = "";
                    if (value.Caption.length > 0) {
                        caption = "<div class='caption'  style='bottom:0'>" +
                            "<p>" + value.Caption + "</p></div>"
                    }

                    var div = $("<div class='slide'><img src='/Includes/Objects/ImageHandler.php?ImageID=" + value.Image_ID +
                        "' width='800' height='450' />" + caption + "</div>");
                    log.info("adding item");
                    $("#previewSlider").append(div);
                });
                $('#slides').slides({
                    preload: true,
                    //preloadImage: 'img/loading.gif',
                    play: 5000,
                    pause: 2500,
                    animationStart: function (current) {
                        $('.caption').animate({
                            bottom: -35
                        }, 100);
                        if (window.console && console.log) {
                            // example return of current slide number
                            //log.info('animationStart on slide: ', current);
                        };
                    },
                    animationComplete: function (current) {
                        $('.caption').animate({
                            bottom: 0
                        }, 200);
                        if (window.console && console.log) {
                            // example return of current slide number
                            //log.info('animationComplete on slide: ', current);
                        };
                    },
                    slidesLoaded: function () {
                        $('.caption').animate({
                            bottom: 0
                        }, 200);
                    }
                });
            }, "json");
        }
    });

    $("#dialog").dialog({
        autoOpen: false,
        modal: true,
        width: 700,
        open: function () {
            $("label.error").remove();
            $(".error").removeClass("error");
            $("input").removeClass("ui-state-error");
            $("#loading").hide();
            $("#errorMsg").hide();
        },
        buttons: [
        {
            id: "btnUpdate",
            text: "Update",
            click: function () {
                var sliderID = $("#inSliderID").val();
                log.info("update event clicked, given and id of " + sliderID);
                $("#frm").valid();
                log.info("form validated");
                $("#loading").show();
                $("#frm").ajaxSubmit({
                    data: {
                        action: "update"
                    },
                    dataType: "json",
                    success: function (data) {
                        log.info(data);
                        log.info("result is " + data.result);
                        if (data.result == true) {
                            var sEnabled = (data.rec.Enabled == true) ? 'Yes' : 'No';
                            log.info("update succesfully with id of " + sliderID + " returned rec had an id of " + data.rec.ID);
                            var row =
                            $("a.viewedit[data-id='" + sliderID + "']").parents("tr");
                            $(row).children("td.enabled").html(sEnabled);
                            $(row).children("td.hyperlink").html(data.rec.Hyperlink);
                            $(row).children("td.preview").attr("src", '/Includes/Objects/ImageHandler.php?ImageID=' + data.rec.Image_ID);

                            $("#dialog").dialog("close");
                            $("#loading").hide();
                        }
                        else {
                            log.error("message is " + data.message);
                            $("#loading").hide();
                            $("#errorMsg").show();
                            $("#errorText").text(data.message);
                        }
                    }
                }).error(function () {
                    $("#loading").hide();
                    $("#errorMsg").show();
                    $("#errorText").text("Unable to communicate with server, please try again later");
                });
            }
        },
        {
            id: "btnCreate",
            text: "Create",
            click: function () {
                log.info("pre validate");
                $("#frm").valid();
                log.info("validated");

                $("#loading").show();
                $("#frm").ajaxSubmit({
                    data: {
                        action: "create"
                    },
                    dataType: "json",
                    success: function (data) {
                        log.info(data);
                        log.info("result is " + data.result);
                        log.info("message is " + data.message);

                        if (data.result === true) {
                            log.info("rec is " + data.rec);
                            var sEnabled = (data.rec.Enabled == true) ? 'Yes' : 'No';
                            var row = $('<tr/>').append('<td class="name"><a class="viewedit" data-id="' + data.rec.ID + '" href="#">' +
                                '<span class="ui-icon ui-icon-pencil"></span></a></td><td class="hyperlink" >' + data.rec.Hyperlink + '</td>' +
                                '<td class="enabled">' + sEnabled + '</td><td>' +
                                '<img src="/Includes/Objects/ImageHandler.php?ImageID=' + data.rec.Image_ID + '"  style="max-height:135px;"/>' +
                                '</td><td><a class="delete" title="Delete Sponsor" href="#" data-id="' + data.rec.ID + '">' +
                                '<span class="ui-icon ui-icon-trash"></span></a></td>');

                            $("#tblSliderItems").append(row);
                            $("#dialog").dialog("close");

                            row.effect("highlight", {
                                color: "#3A9C64"
                            }, 5000);
                        }
                        else {
                            $("#loading").hide();
                            $("#errorMsg").show();
                            $("#errorText").text(result.message);
                            log.error(result.message);
                        }
                    }
                }).error(function () {
                    $("#loading").hide();
                    $("#errorMsg").show();
                    $("#errorText").text("Unable to communicate with server, please try again later");
                });
            }
        },
        {
            text: "Close",
            click: function () {
                $(this).dialog("close");
            }
        }]
    });

    $(".viewedit").live("click", function () {
        var sliderID = $(this).data("id");
        log.info("data sliderID " + sliderID);
        $.post("Ajax/SliderItems.php", {
            action: "read",
            id: sliderID
        }, function (data) {
            log.info(data);
            $("#btnUpdate").show();
            $("#btnCreate").hide();

            $("#inSliderID").val(sliderID);
            $("#inEnabled").prop("checked", data.Enabled == 1);

            $("#inCaption").val($("<div/>").html(data.Caption).text());
            $("#inHyperlink").val(data.Hyperlink);
            $("#preview").attr("src", "/Includes/Objects/ImageHandler.php?ImageID=" + data.Image_ID);
            $("#dialog").dialog("open");
        }, "json");
        return false;
    });

    $("#inWebsite").charCount({
        allowed: 512,
        warning: 20
    });

    $("#inCaption").charCount({
        allowed: 512,
        warning: 20,
        counterText: 'Characters left: '
    });

    $("#btnNew").click(function () {
        //$("input").removeClass("ui-state-error");
        //$("#loading").hide();
        //$("#errorMsg").hide();

        $("#btnUpdate").hide();
        $("#btnCreate").show();
        $("#inActive").prop("checked", false);
        $("#inSponsorName").val("");
        $("#inWebsite").val("");
        $("#inLogo").val();
        $("#preview").hide();
        $("#dialog").dialog("open");
        return false;
    });

    $("#btnPreview").click(function () {
        log.info("btnPreview Click event");
        $("#previewSlider").empty();
        $(".pagination").remove();
        $("#dlgPreview").dialog("open");
        return false;
    });

    $(".delete").live("click", function () {
        var sliderItemID = $(this).data("id");
        var oThis = this;
        //alert(sponsorID);
        if (confirm("Are you sure you want to delete this item?") == true) {
            $.post("Ajax/SliderItems.php", {
                action: "delete",
                id: sliderItemID
            },
            function (data) {
                //alert(data);
                if (data.result == true) {
                    $(oThis).parents("tr").fadeOut();
                    redtuberrr$(oThis).parents("tr").remove();
                }
            }, "json");
        }
        return false;
    });
});

