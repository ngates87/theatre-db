var DeleteRow =
    "<td  class='action'><a href='#' title='Delete Row.' onclick='$(this).parent().parent().remove();return false;'> <span class='ui-icon ui-icon-trash'></span> </a></td>";

var EditRow = "<td class='action'><a href='#' title='Edit row' class='tsEditLink'><span class='ui-icon ui-icon-pencil'></span>" +
    "</a><a href='#' title='Save Row' class='tsSaveLink' style='display:none'><span class='ui-icon ui-icon-disk'></span>" +
    "</a></td>";

function AddRowToTrouperInfo(trouper, id, role, category, categoryID, EditRow, DeleteRow) {
    var row = $("<tr/>");
    row.append($("<td class='ui-icon ui-icon-grip-dotted-vertical' />"));
    row.append($("<td class='person' />").text(trouper).append($("<input type='hidden' name='Troupers[]' />").val(id)));
    row.append($("<td class='role' />").text(role).append($("<input type='hidden' name='Roles[]' />").val(role)));
    row.append($("<td class='type' />").text(category).append($("<input type='hidden' name='Category[]' />").val(categoryID)));
    row.append($(EditRow));
    row.append($(DeleteRow));

    $("#trouperInfo tr:last-child").before(row);
}
function AddEventInfoRow(venueID, venue, when, EventType, EventTypeID) {
    var row = $("<tr/>");
    row.append($("<td class='ui-icon ui-icon-grip-dotted-vertical' />"));
    row.append($("<td class='venue' />").text(venue).append($("<input type='hidden' name='Venues[]' />").val(venueID)));
    row.append($("<td class='when' />").text(when).append($("<input type='hidden' name='EventDates[]' />").val(when)));
    row.append($("<td class='type' />").text(EventType).append($("<input type='hidden' name='EventTypes[]' />").val(EventTypeID)));
    row.append($(EditRow));
    row.append($(DeleteRow));

    $("#eventInfo tr:last-child").before(row);
}
$(document).ready(function()
{
  
 
    $('.dateTime').datetimepicker({
            timeFormat: 'h:mm TT',
            ampm: true
        });

    $("#btnAddEventInfo").click(function()
    {
            var venueID = $("#selectVenues").val();
            var venueName = $("#selectVenues option:selected").text();
            var when = jQuery.trim($("#inEventDateTime").val());
            var EventTypeID = jQuery.trim($("#inEventCategory").val());
            var EventType = jQuery.trim($("#inEventCategory option:selected").text());
            if (when == "")
            {
                alert("Please specify a valid date time.");
                return false;
            }

            AddEventInfoRow(venueID,venueName, when, EventType, EventTypeID);
            $("#tblEventInfo").css('display', 'table');
            return false;
        });

    $("#btnAddTrouperInfo").click(function()
    {
            var id = $("#selectTrouper").val();
            var trouper = $("#selectTrouper option:selected").text();
            var categoryID = $("#selectTrouperCategory").val();
            var category =  $("#selectTrouperCategory option:selected").text();
            var role = jQuery.trim($("#inRole").val());
            if (role == "")
            {
                alert("Please give role a value.");
                return false;            

            }
            AddRowToTrouperInfo(trouper, id, role, category, categoryID, EditRow, DeleteRow);
            $("#tblTroupersInfo").css("display", "table");
            $("#tblTroupersInfo").tableDnD("updateTables");
            return false;
        });
    
    $("#btnAddAdmin").click(function()
    {
            var id = $("#inEventAdmin").val();
            var name = $("#inEventAdmin option:selected").text();
            if(name == "")
            {
                alert("Please Select an Admin");
                return false;
            }
            var row = $("<tr/>");
            row.append($("<td/>").text(name).append($("<input name='Admin[]'/>").val(id)));
            row.append(DeleteRow);
            $(this).parents("tr").before(row);
            return false;
        });
        
    $("#tblTroupersInfo .tsEditLink").live("click",function()
    {
        var row = $(this).parents("tr");

        var id = row.find("td.person input").val();
        row.find("td.person").empty();
        var personDD = $("#selectTrouper").clone().removeAttr("id");
        $(personDD).val(id);
        row.find("td.person").append(personDD);

        var roleInput = row.find("td.role input").clone().removeAttr("type");
        row.find("td.role").empty();
        row.find("td.role").append(roleInput);

        id = row.find("td.type input").val();
        row.find("td.type").empty();

        var typeDD = $("#selectTrouperCategory").clone().removeAttr("id");
        $(typeDD).val(id);
        row.find("td.type").append(typeDD);

        $(this).hide();//.css("display", "none");
        $(this).parent().children("a.tsSaveLink").show();
        return false;
    });

    $("#tblTroupersInfo .tsSaveLink").live("click", function()
    {
        var row = $(this).parents("tr");
        var id = row.find("td.person select").val();
        var trouper = row.find("td.person select option:selected").text();

        //var personIn = "<input type='hidden' name='Troupers[]' value='" + id + "'/>" + trouper;
        var personIn = $("<input type='hidden' name='Troupers[]' />").val(id); // + trouper;
        row.find("td.person").empty().text(trouper).append(personIn);

        row.find("td.role input").prop("type", "hidden").after(row.find("td.role input").val());

        id = row.find("td.type select").val();
        var type = row.find("td.type select option:selected").text();

        //var typeIn = "<input type='hidden' name='Category[]' value='" + id + "'/>" + type;
        var typeIn = $("<input type='hidden' name='Category[]' />").val(id);// + type;
        row.find("td.type").empty().text(type).append(typeIn);

        $(this).hide();//.css("display", "none");
        $(this).parent().children("a.tsEditLink").show();
        return false;
    });

    $("#tblEventInfo .tsEditLink").live("click", function()
    {
        var row = $(this).parents("tr");

        var id = row.find("td.venue input").val();
        row.find("td.venue").empty();
        var venueDD = $("#selectVenues").clone().removeAttr("id");
        $(venueDD).val(id);

        row.find("td.venue").append(venueDD);

        var dt = row.find("td.when input").val();
        var dtIn = $("<input type='text'/>").datetimepicker({
            timeFormat: 'h:mm TT',
            ampm: true
        });
        row.find("td.when").empty();
        row.find("td.when").append(dtIn.val(dt));
        //$("body").append(dtIn);

        id = row.find("td.type input").val();
        var typeDD = $("#inEventCategory").clone().removeAttr("id");
        $(typeDD).val(id);
        row.find("td.type").empty();
        row.find("td.type").append(typeDD);

        $(this).hide();//.css("display", "none");
        $(this).parent().children("a.tsSaveLink").show();
        return false;
    });

    $("#tblEventInfo .tsSaveLink").live("click", function()
    {
        var row = $(this).parents("tr");

        var id = row.find("td.venue select").val();
        var venue = row.find("td.venue select option:selected").text();

        var venueIn = $("<input type='hidden' name='Venues[]' />").val(id); // + venue;
        row.find("td.venue").empty().text(venue).append(venueIn);

        var when = row.find("td.when input").val();
        var dtIn = $("<input type='hidden' name='EventDates[]' />" ).val(when); //+ when;
        row.find("td.when").empty().text(when).append(dtIn);

        id = row.find("td.type select").val();
        var type = row.find("td.type select option:selected").text();

        var typeIn = $("<input type='hidden' name='EventTypes[]' />").val(id); // + type;
        row.find("td.type").empty().text(type).append(typeIn);

        $(this).hide();//.css("display", "none");
        $(this).parent().children("a.tsEditLink").show();
        return false;
    });
        
    // I think these have to be called last
    $("#tblTroupersInfo").tableDnD();
    $("#tblEventInfo").tableDnD();

    $('#inShowNotes').wysiwyg();
});