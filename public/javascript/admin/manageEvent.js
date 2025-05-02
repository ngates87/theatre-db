///// <reference path="manageeventtableitem.ts" />
////import $ = require("jquery");
//interface JQuery {
//    tableDnD(v?: any);
//    wysiwyg(v?: string);
//}
//class ManageEvents {
//    DeleteRow =
//    "<td  class='action'><a href='#' title='Delete Row.' onclick='$(this).parent().parent().remove();return false;'> <span class='ui-icon ui-icon-trash'></span> </a></td>";
//    EditRow = "<td class='action'><a href='#' title='Edit row' class='tsEditLink'><span class='ui-icon ui-icon-pencil'></span>" +
//    "</a><a href='#' title='Save Row' class='tsSaveLink' style='display:none'><span class='ui-icon ui-icon-disk'></span>" +
//    "</a></td>";
//    eventListing = ko.observableArray<TCMS.EventItem>([]);
//    constructor() {
//        $(() => {
//            $.post("Ajax/Events.php", {
//                action: "manageeventsview"
//            }).then((data: TCMS.EventItem[]) => {
//                console.log("manageEvents data:", data);
//                this.eventListing(data);
//            });
//            (<any>$('#wizard')).smartWizard({
//                enableAllSteps: true,
//                transitionEffect: "slideleft",
//            });
//            var availableTags: string[] = [
//                "ActionScript",
//                "AppleScript",
//                "Asp",
//                "BASIC",
//                "C",
//                "C++",
//                "Clojure",
//                "COBOL",
//                "ColdFusion",
//                "Erlang",
//                "Fortran",
//                "Groovy",
//                "Haskell",
//                "Java",
//                "JavaScript",
//                "Lisp",
//                "Perl",
//                "PHP",
//                "Python",
//                "Ruby",
//                "Scala",
//                "Scheme"
//            ];
//            $("#inRole").autocomplete({
//                source: availableTags
//            });
//            $('.dateTime').datetimepicker(<any>{
//                timeFormat: 'h:mm TT',
//                ampm: true
//            });
//            $("#inEventSlug").keypress(() => {
//                $("#inEventSlug").val($("#inEventSlug").val().replace(new RegExp(" ", "g"), '_'));
//            });
//            $("#inEventSlug").focus(() => {
//                //alert()
//                //alert("nothing.");
//                if ($("#inEventSlug").val().length == 0) {
//                    $("#inEventSlug").val($("#inEventTitle").val().replace(new RegExp(" ", "g"), '_'));
//                }
//            });
//            $("#btnAddEventInfo").click(() => {
//                var venueID = $("#selectVenues").val();
//                var venueName = $("#selectVenues option:selected").text();
//                var when = jQuery.trim($("#inEventDateTime").val());
//                alert(when);
//                var EventTypeID = jQuery.trim($("#inEventCategory").val());
//                var EventType = jQuery.trim($("#inEventCategory option:selected").text());
//                if (when == "") {
//                    alert("Please specify a valid date time.");
//                    return false;
//                }
//                this.AddEventInfoRow(venueID, venueName, when, EventType, EventTypeID);
//                $("#tblEventInfo").css('display', 'table');
//                return false;
//            });
//            $("#btnAddTrouperInfo").click(() => {
//                var id = $("#selectTrouper").val();
//                var trouper = $("#selectTrouper option:selected").text();
//                var categoryID = $("#selectTrouperCategory").val();
//                var category = $("#selectTrouperCategory option:selected").text();
//                var role = jQuery.trim($("#inRole").val());
//                if (role == "") {
//                    alert("Please give role a value.");
//                    return false;
//                }
//                this.AddRowToTrouperInfo(trouper, id, role, category, categoryID);
//                $("#tblTroupersInfo").css("display", "table").tableDnD("updateTables");
//                return false;
//            });
//            $("#btnAddAdmin").click(() => {
//                var id = $("#inEventAdmin").val();
//                var name = $("#inEventAdmin option:selected").text();
//                if (name == "") {
//                    alert("Please Select an Admin");
//                    return false;
//                }
//                var row = $("<tr/>");
//                row.append($("<td/>").text(name).append($("<input name='Admin[]'/>").val(id)));
//                row.append(this.DeleteRow);
//                $(this).parents("tr").before(row);
//                return false;
//            });
//            $("#tblTroupersInfo .tsEditLink").on("click", () => {
//                var row = $(this).parents("tr");
//                var id = row.find("td.person input").val();
//                row.find("td.person").empty();
//                var personDD = $("#selectTrouper").clone().removeAttr("id");
//                $(personDD).val(id);
//                row.find("td.person").append(personDD);
//                var roleInput = row.find("td.role input").clone().removeAttr("type");
//                row.find("td.role").empty();
//                row.find("td.role").append(roleInput);
//                id = row.find("td.type input").val();
//                row.find("td.type").empty();
//                var typeDD = $("#selectTrouperCategory").clone().removeAttr("id");
//                $(typeDD).val(id);
//                row.find("td.type").append(typeDD);
//                $(this).hide();//.css("display", "none");
//                $(this).parent().children("a.tsSaveLink").show();
//                return false;
//            });
//            $("#tblTroupersInfo .tsSaveLink").on("click", () => {
//                var row = $(this).parents("tr");
//                var id = row.find("td.person select").val();
//                var trouper = row.find("td.person select option:selected").text();
//                //var personIn = "<input type='hidden' name='Troupers[]' value='" + id + "'/>" + trouper;
//                var personIn = $("<input type='hidden' name='Troupers[]' />").val(id); // + trouper;
//                row.find("td.person").empty().text(trouper).append(personIn);
//                row.find("td.role input").prop("type", "hidden").after(row.find("td.role input").val());
//                id = row.find("td.type select").val();
//                var type = row.find("td.type select option:selected").text();
//                //var typeIn = "<input type='hidden' name='Category[]' value='" + id + "'/>" + type;
//                var typeIn = $("<input type='hidden' name='Category[]' />").val(id);// + type;
//                row.find("td.type").empty().text(type).append(typeIn);
//                $(this).hide();//.css("display", "none");
//                $(this).parent().children("a.tsEditLink").show();
//                return false;
//            });
//            $("#tblEventInfo .tsEditLink").on("click", () => {
//                var row = $(this).parents("tr");
//                var id = row.find("td.venue input").val();
//                row.find("td.venue").empty();
//                var venueDD = $("#selectVenues").clone().removeAttr("id");
//                $(venueDD).val(id);
//                row.find("td.venue").append(venueDD);
//                var dt = row.find("td.when input").val();
//                var dtIn = $("<input type='text'/>").datetimepicker(<any>{
//                    timeFormat: 'h:mm TT',
//                    ampm: true
//                });
//                row.find("td.when").empty();
//                row.find("td.when").append(dtIn.val(dt));
//                //$("body").append(dtIn);
//                id = row.find("td.type input").val();
//                var typeDD = $("#inEventCategory").clone().removeAttr("id");
//                $(typeDD).val(id);
//                row.find("td.type").empty();
//                row.find("td.type").append(typeDD);
//                $(this).hide();//.css("display", "none");
//                $(this).parent().children("a.tsSaveLink").show();
//                return false;
//            });
//            $("#tblEventInfo .tsSaveLink").on("click", () => {
//                var row = $(this).parents("tr");
//                var id = row.find("td.venue select").val();
//                var venue = row.find("td.venue select option:selected").text();
//                var venueIn = $("<input type='hidden' name='Venues[]' />").val(id); // + venue;
//                row.find("td.venue").empty().text(venue).append(venueIn);
//                var when = row.find("td.when input").val();
//                var dt = Date.parse(when);
//                var dtIn = $("<input type='hidden' name='EventDates[]' />").val(dt.toString(<any>'yyyy-MM-dd HH:mm')); //+ when;
//                row.find("td.when").empty().text(dt.toString(<any>'MMM-d-yyyy h:mm tt')).append(dtIn);
//                id = row.find("td.type select").val();
//                var type = row.find("td.type select option:selected").text();
//                var typeIn = $("<input type='hidden' name='EventTypes[]' />").val(id); // + type;
//                row.find("td.type").empty().text(type).append(typeIn);
//                $(this).hide();//.css("display", "none");
//                $(this).parent().children("a.tsEditLink").show();
//                return false;
//            });
//            // I think these have to be called last
//            $("#tblTroupersInfo").tableDnD();
//            $("#tblEventInfo").tableDnD();
//            $('#inShowNotes').wysiwyg();
//            $(".activeEvent").change(() => {
//                var id = $(this).val();
//                var active = $(this).is(":checked");
//                var oThis = this;
//                $.post("Ajax/Events.php", {
//                    action: "activate",
//                    id: id,
//                    active: active
//                }, (msg) => {
//                    //alert(msg);
//                    console.info(msg);
//                    if (msg.result != true) {
//                        $(oThis).removeAttr("checked");
//                    }
//                }, "json");
//            });
//            // CREATE BUTTON CLICK
//            $("#btnCreateEvent").click(() => {
//                $("#btnUpdate").hide();
//                $("#btnCreate").show();
//                $("#frmEvent").resetForm();
//                //$("div.wysiwyg").remove();
//                //$("#inShowNotes").val( data.event.Notes);
//                $("#inShowNotes").wysiwyg('clear');
//                this.ClearEventRows();
//                this.ClearTrouperRows();
//                $("#dialog").dialog("open");
//            });
//            $("#dialog").dialog({
//                width: '800',
//                // height:$("body").height() * .9,
//                modal: true,
//                autoOpen: false,
//                open: () => {
//                    $("label.error").remove();
//                    $(".error").removeClass("error");
//                    $("input").removeClass("ui-state-error");
//                    $("#loading").hide();
//                    $("#errorMsg").hide();
//                },
//                buttons: [
//                    {
//                        text: "update",
//                        id: "btnUpdate",
//                        click: () => {
//                            console.info("pre validate");
//                            $("#frmEvent").valid();
//                            console.info("validated");
//                            $("#loading").show();
//                            var iEventID = $("#inEventID").val();
//                            $("#frmEvent").ajaxSubmit({
//                                data: {
//                                    action: "update",
//                                    id: iEventID
//                                },
//                                //dataType:"json",
//                                success: (result) => {
//                                    alert(result);
//                                    //alert("Made it this far.");
//                                    console.info(result);
//                                    console.info("result is " + result.result);
//                                    if (result.result == true) {
//                                        var row = $("a.read[data-id='" + iEventID + "']").parents("tr");
//                                        row.empty();
//                                        row.append($("<td/>").append($("<input title='make part of the current season' type='checkbox' class='activeEvent' value='48' checked='checked' />").val(result.event.id)));
//                                        var a = $("<a title='View Event' href='/Admin/Event.php?EventID='" + iEventID + "' data-id='" + iEventID + "'/>");
//                                        row.append($("<td/>").append(a.text(result.event.title)));
//                                        row.append($("<td/>").text(result.event.company));
//                                        row.append($("<td/>").text(result.event.slug))
//                                        $("#dialog").dialog("close");
//                                        $("#loading").hide();
//                                        row.effect("highlight", { color: "#3A9C64" }, 5000);
//                                    }
//                                    else {
//                                        $("#loading").hide();
//                                        $("#errorMsg").show();
//                                        $("#errorText").text(result.message);
//                                        console.error(result.message);
//                                    }
//                                }
//                            }).error(() => {
//                                $("#loading").hide();
//                                $("#errorMsg").show();
//                                $("#errorText").text("Unable to communicate with server, please try again later");
//                            });
//                        }
//                    },
//                    {
//                        text: "Create",
//                        id: "btnCreate",
//                        click: () => {
//                            console.info("pre validate");
//                            $("#frmEvent").valid();
//                            console.info("validated");
//                            //$("#inFirstName").val();
//                            //$("#inLastName").val();
//                            $("#loading").show();
//                            $("#frmEvent").ajaxSubmit({
//                                data: {
//                                    action: "create"
//                                },
//                                dataType: "json",
//                                success: (result) => {
//                                    //alert("Made it this far.");
//                                    console.info(result);
//                                    console.info("result is " + result.result);
//                                    if (result.result == true) {
//                                        alert(result.event.id);
//                                        alert(result.event.title);
//                                        var row = $("<tr/>");
//                                        row.append($("<td/>").append($("<input title='make part of the current season' type='checkbox' class='activeEvent' value='48' checked='checked' />").val(result.event.id)));
//                                        row.append($("<td/>").text(result.event.title));
//                                        row.append($("<td/>").text(result.event.company));
//                                        $("#tblEvents").append(row);
//                                        row.effect("highlight", { color: "#3A9C64" }, 5000);
//                                        $("#dialog").dialog("close");
//                                    }
//                                    else {
//                                        $("#loading").hide();
//                                        $("#errorMsg").show();
//                                        $("#errorText").text(result.message);
//                                        console.error(result.message);
//                                    }
//                                }
//                            }).error(() => {
//                                $("#loading").hide();
//                                $("#errorMsg").show();
//                                $("#errorText").text("Unable to communicate with server, please try again later");
//                            });
//                        }
//                    },
//                    {
//                        text: "Close",
//                        click: () => {
//                            $("#btnUpdate").hide();
//                            $("#btnCreate").show();
//                            $("#frmEvent").resetForm();
//                            $(this).dialog("close");
//                        }
//                    }
//                ]
//            });
//        });
//        $(".read").on("click", () => {
//            var eventID = $(this).data("id");
//            console.info("data eventID is " + eventID);
//            $.post("Ajax/Events.php", {
//                action: "read",
//                id: eventID
//            }, (data) => {
//                console.info(data);
//                $("#inEventID").val(data.event.ID);
//                $("#inEventTitle").val(data.event.Title);
//                $("#inEventSlug").val(data.event.Slug);
//                //alert(data.event.Slug);
//                $("#inCompany").val(data.event.Company_ID);
//                $("#inArtfullyID").val(data.event.Artfully_ID);
//                $("#inPreShowPrice").val(data.event.EarlyTicketPrice);
//                $("#inDoorPrice").val(data.event.DoorTicketPrice);
//                $("#inActive").prop("checked", data.event.CurrentSeason)
//                $("div.wysiwyg").remove();
//                $("#inShowNotes").val(data.event.Notes);
//                $("#inShowNotes").wysiwyg();
//                this.ClearTrouperRows();
//                $.each(data.trouperInfo, (key, obj) => {
//                    this.AddRowToTrouperInfo(obj.fullName, obj.trouperID, obj.role, obj.catDisplay, obj.catID);
//                });
//                this.ClearEventRows();
//                $.each(data.eventInfo, (key, obj) => {
//                    this.AddEventInfoRow(obj.venueID, obj.venueName, obj.when, obj.type, obj.typeID);
//                });
//                $("#tblTroupersInfo").css("display", "table");
//                $("#tblTroupersInfo").tableDnD("updateTables");
//                $("#tblEventInfo").css("display", "table");
//                $("#tblEventInfo").tableDnD("updateTables");
//                $("#btnUpdate").show();
//                $("#btnCreate").hide();
//                $("#dialog").dialog("open");
//            }, 'json');
//            return false;
//        });
//    }
//    AddRowToTrouperInfo(trouperName: string, id: number, role, category, categoryID) {
//        var row = $("<tr/>");
//        row.append($("<td class='ui-icon ui-icon-grip-dotted-vertical' />"));
//        row.append($("<td class='person' />").text(trouperName).append($("<input type='hidden' name='Troupers[]' />").val(id)));
//        row.append($("<td class='role' />").text(role).append($("<input type='hidden' name='Roles[]' />").val(role)));
//        row.append($("<td class='type' />").text(category).append($("<input type='hidden' name='Category[]' />").val(categoryID)));
//        row.append($(this.EditRow));
//        row.append($(this.DeleteRow));
//        $("#trouperInfo tr:last-child").before(row);
//    }
//    ClearTrouperRows() {
//        $("#trouperInfo tr").not(":last").remove();
//    }
//    AddEventInfoRow(venueID, venue, when, EventType, EventTypeID) {
//        console.info(when);
//        var dt = Date.parse(when);
//        console.info("Just Parsed");
//        console.info("dt is " + dt);
//        var row = $("<tr/>");
//        row.append($("<td class='ui-icon ui-icon-grip-dotted-vertical' />"));
//        row.append($("<td class='venue' />").text(venue).append($("<input type='hidden' name='Venues[]' />").val(venueID)));
//        row.append($("<td class='when' />").text(dt.toString(<any>'MMM-d-yyyy h:mm tt')).append($("<input type='hidden' name='EventDates[]' />").val(dt.toString(<any>'yyyy-MM-dd HH:mm:ss'))));
//        row.append($("<td class='type' />").text(EventType).append($("<input type='hidden' name='EventTypes[]' />").val(EventTypeID)));
//        row.append($(this.EditRow));
//        row.append($(this.DeleteRow));
//        $("#eventInfo tr:last-child").before(row);
//    }
//    ClearEventRows() {
//        $("#eventInfo tr").not(":last").remove();
//        //$("#eventInfo").append(addLine);
//    }
//}
//function RemoveEvent(id) {
//    if (confirm("Are you sure you want to delete this event?")) {
//        $.post("Ajax/Events.php", {
//            action: "delete",
//            id: id
//        }, (msg) => {
//            console.info(msg.result);
//            if (msg.result == true) {
//                $('input[value="' + id + '"]').parents("tr").fadeOut().remove();
//            }
//        }, "json");
//    }
//    return false;
//}
var ManageEventsView = (function () {
    function ManageEventsView() {
        var _this = this;
        this.eventListing = ko.observableArray([]);
        this.dialogEvent = ko.observable(new TCMS.NewEventViewModel());
        this.ajaxUrl = "Ajax/Events.php";
        this.isCreate = false;
        this.editId = null;
        $(function () {
            $.post(_this.ajaxUrl, {
                action: "manageeventsview"
            }, function (data) {
                console.log("manageEvents data:", data);
                _this.eventListing(data);
            }, 'json');
            // init the wysiwyg
            tinymce.init({
                selector: '#inShowNotes',
            });
            //init the date time picker
            $('.dateTime').datetimepicker({
                timeFormat: "hh:mm tt"
            });
            _this.dialogEvent().eventNotes.subscribe(function (newValue) {
                console.log("tinymce", tinymce);
                tinymce.activeEditor.setContent(newValue);
            });
        });
    }
    ManageEventsView.prototype.newEvent = function () {
        //this.dialogEvent(new TCMS.NewEventViewModel());
        this.isCreate = true;
        this.editId = null;
        this.dialogEvent().reset();
        $("#newEventModal").modal();
    };
    ManageEventsView.prototype.delete = function (item) {
        console.log("delete", item);
    };
    ManageEventsView.prototype.edit = function (id) {
        var _this = this;
        console.log("edit id", id);
        this.editId = id;
        this.isCreate = false;
        $.post(this.ajaxUrl, {
            action: "read",
            id: id
        }, function (data) {
            _this.dialogEvent().load(data);
            $("#newEventModal").modal();
        }, 'json');
    };
    ManageEventsView.prototype.saveChanges = function () {
        console.log("saveChanges");
        var submitData = null;
        if (this.isCreate) {
            submitData = submitData = {
                action: "create"
            };
        }
        else {
            submitData = {
                action: "update",
                id: this.editId
            };
        }
        console.log("Submit Data", submitData);
        $("#frmEvent").ajaxSubmit({
            data: submitData,
            //dataType:"json",
            success: function (result) {
                console.log("result", result);
            }
        }).ajaxSuccess(function (data) {
            console.log("ajaxSuccess", data);
        }).ajaxError(function (data) {
            console.log("ajaxError", data);
            //$("#loading").hide();
            //$("#errorMsg").show();
            //$("#errorText").text("Unable to communicate with server, please try again later");
        }).ajaxComplete(function () {
            $("#newEventModal").modal("hide");
        });
    };
    return ManageEventsView;
})();
ko.applyBindings(new ManageEventsView());
//# sourceMappingURL=manageEvent.js.map