$(function () {
    $("#dialog").dialog({
        open: function () {
            $("input").removeClass("ui-state-error");
            $("#loading").hide();
            $("#errorMsg").hide();
        },
        buttons: [{
            id: "btnUpdate", text: "Update",
            click: function () {
                $("#loading").show();
                $("#frmSponsors").ajaxSubmit({
                    data: { action: "update" },
                    dataType: "json",
                    success: function (data) {
                        var row =
                            $("a.readSponsor[data-id='" + $("#inSponsorID").val() + "']").parents("tr");
                        $(row).find("a.readSponsor").html(data.Name);
                        $(row).children("td.website").html(data.Website);
                        $(row).children("td.active").html($(data.Active == 1) ? "Yes" : "No");
                        $("#dialog").dialog("close");
                    }
                }).error(function () {
                    $("#loading").hide();
                    $("#errorMsg").show();
                    $("#errorText").text("Unable to communicate with server, please try again later");
                });
            }
        }, {
            id: "btnCreate", text: "Create", click: function () {
                //alert($("#inLogo").val());
                var errors = false;
                if ($("#inSponsorName").val().length == 0) {
                    $("#inSponsorName").addClass("ui-state-error")
                    errors = true;
                }
                if ($("#inLogo").val().length == 0) {
                    $("#inLogo").addClass("ui-state-error")
                    errors = true;
                }

                if (errors == true)
                    return;

                $("#loading").show();
                // alert("made it this far");
                $("#frmSponsors").ajaxSubmit({
                    data: { action: "create" },
                    dataType: "json",
                    error: function () {
                        $("#loading").hide();
                        $("#errorMsg").show();
                        $("#errorText").text("Unable to communicate with server, please try again later");
                    },

                    success: function (data) {
                        if (data.result == true) {
                            $("#dialog").dialog("close");
                            $.post("Ajax/Sponsors.php", { action: "read", id: data.id }, function (msg) {
                                var row = $("<tr/>").append('<td class="name"><a class="readSponsor" data-id="' + data.id + '" href="#">' + msg.Name + '</a>' +
                                    '</td><td class="website" >' + msg.Website + '</td><td class="active">' + ((msg.Active == true) ? "Yes" : "No") + '</td>' +
                                    '<td><a class="delete" title="Delete Sponsor" href="#" data-id="' + data.id + '">' +
                                            '<span class="ui-icon ui-icon-trash"></span></a></td>');

                                $("#tblSponsors").append(row);
                                row.effect("highlight", { color: "#3A9C64" }, 5000);

                            }, "json");
                        }
                        else {
                            $("#loading").hide();
                            $("#errorMsg").show();
                            $("#errorText").text(data.message);
                        }
                    }
                });

            }
        },
            { text: "Close", click: function () { $(this).dialog("close"); } }],
        autoOpen: false,
        modal: true,
        width: 425
    });
    // new
    $("#btnAddSponsor").click(function () {
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

    $(".readSponsor").live("click", function () {
        var sponsorID = $(this).data("id");
        $("#inSponsorID").val(sponsorID);
        $.post("Ajax/Sponsors.php", { action: "read", id: sponsorID }, function (data) {
            $("#inActive").prop("checked", data.Active == 1);
            $("#inSponsorName").val(data.Name);
            $("#inWebsite").val(data.Website);
            $("#preview").attr("src", "/Includes/Objects/ImageHandler.php?ImageID=" + data.Image_ID);

            $("#btnUpdate").show();
            $("#btnCreate").hide();
            $("#preview").show();
            $("#dialog").dialog("open");
        }, "json").error(function () {
            $("#errorMsg").show();
            $("#errorText").text("Unable to communicate with server, please try again later");
        });
        return false;
    });

    $(".delete").live("click", function () {
        var sponsorID = $(this).data("id");
        var oThis = this;
        //alert(sponsorID);
        if (confirm("Are you sure you want to delete this sponsor?") == true) {
            $.post("Ajax/Sponsors.php", { action: "delete", id: sponsorID },
                function (data) {
                    //alert(data);
                    if (data.result == true) {
                        $(oThis).parents("tr").remove();
                    }
                }, "json");
        }
        return false;
    });
});

