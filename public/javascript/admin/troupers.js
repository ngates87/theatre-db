$(document).ready(function()
{
    $("#inBirthday").datepicker();
    $("#dialog" ).dialog({
        width:700,
        //height:605,
        modal:true,
        autoOpen: false,
        open:function()
        {
            $("label.error").remove();
            $(".error").removeClass("error");
            $("input").removeClass("ui-state-error");
            $("#loading").hide();
            $("#errorMsg").hide();
        },
        buttons:[
        {
            id:"btnUpdate", 
            text:"Update", 
            click:function(){
                var trouperID = $("#inTrouperID").val();
                $("#frmTrouper").valid();
                $("#loading").show();
                $("#frmTrouper").ajaxSubmit({
                    data:{
                        action:"update"
                    },
                    dataType:"json",
                    success: function(data){
                        log.info(data);
                        log.info("result is " + data.result);
                        if(data.result == true)
                        {
                            var row =
                            $("a.read[data-id='" + trouperID + "']").parents("tr");
                            $(row).children("td.gender").html(data.trouper.Gender);
                            $(row).find("a.read").html(data.trouper.FirstName + " " + data.trouper.LastName);
                            $(row).children("td.age").html(data.trouper.Age);
                            $(row).children("td.hairColor").html(data.trouper.HairColor);
                            $(row).children("td.eyeColor").html(data.trouper.EyeColor);
                            $(row).children("td.email").html(data.trouper.Email);
                            $("#dialog").dialog("close");
                            $("#loading").hide();
                        }
                        else
                        {
                            log.error("message is " + data.message);
                            $("#loading").hide();
                            $("#errorMsg").show();
                            $("#errorText").text(data.message);
                        }
                    }
                }).error(function(){ 
                    $("#loading").hide();
                    $("#errorMsg").show();
                    $("#errorText").text("Unable to communicate with server, please try again later");
                });
            }
        },

        {
            id:"btnCreate",
            text:"Create", 
            click:function(){
                log.info("pre validate");
                $("#frmTrouper").valid();
                log.info("validated");
                //$("#inFirstName").val();
                //$("#inLastName").val();
                $.post("Ajax/Troupers.php", {
                    action:"dupcheck", 
                    firstName:$("#inFirstName").val(), 
                    lastName:$("#inLastName").val()
                },
                function(data){
                    log.info(data.result); 
                    if(data.result == true){
                        if(confirm("You are potentially adding a dupilcate trouper, add anyways?") == false){
                            return;
                        }
                    }
                    $("#loading").show();
                    $("#frmTrouper").ajaxSubmit({
                        data:{
                            action:"create"
                        },
                        dataType:"json",
                        success: function(result){
                            log.info(result);
                            log.info("result is " + result.result);
                            log.info("id is " + result.id);
                            log.info("message is " + result.message);

                            if(result.result == true){
                                var row = $("<tr/>").append('<td class="gender">' + result.trouper.Gender + '</td>'+
                                    '<td class="name"><a class="read" href="#" data-id='+result.trouper.ID +
                                    ' class="edit">' + result.trouper.FirstName + " " + result.trouper.LastName + '</a></td>'+
                                    '<td class="age">' + result.trouper.Birthday + '</td><td class="hairColor">'+ result.trouper.HairColor + '</td>' + 
                                    '<td class="eyeColor">' + result.trouper.EyeColor + '</td><td class="email">'+ result.trouper.Email + '</td>' + 
                                    '<td class="phone">'+ result.trouper.Phone + '</td> <td><a class="delete" title="Delete trouper" href="#" data-id="' 
                                    + result.trouper.ID + '" ><span class="ui-icon ui-icon-trash"></span></a></td>');

                                $("#tblTroupers").append(row);
                                row.effect("highlight", {color:"#3A9C64"}, 5000);
                                $("#dialog").dialog("close"); 
                            }
                            else{
                                $("#loading").hide();
                                $("#errorMsg").show();
                                $("#errorText").text(result.message);
                                log.error(result.message);
                            }
                        }
                    }).error(function(){ 
                        $("#loading").hide();
                        $("#errorMsg").show();
                        $("#errorText").text("Unable to communicate with server, please try again later");
                    });
                },'json');
            }
        },
        {
            text:"Close",
            click:function(){
                $(this).dialog("close");
            }
        }]
    });

    $(".read").live("click",function(){
        var trouperID = $(this).data("id");
        log.info("data trouperIDis " + trouperID);
        $.post("Ajax/Troupers.php",{
            action:"read", 
            id:trouperID
        },function(data){
            log.info(data);
            $("#inTrouperID").val(trouperID);
            $("#btnUpdate").show();
            $("#btnCreate").hide();
            $("#inFirstName").val($("<div/>").html(data.FirstName).text());
            $("#inLastName").val(data.LastName);
            $("#inBirthday").val(data.Birthday);
            $("#inPhone").val(data.Phone);
            $("#inEmail").val(data.Email);
            $("#inGender").val(data.Gender);
            $("#inEyeColor").val(data.EyeColor);
            $("#inHairColor").val(data.HairColor);
            $("#inHeight").val(data.Height);
            $("#inWeight").val(data.Weight);
            $("#inBio").val(data.Bio);
            $("#dialog").dialog("open");

        },"json");
        return false;
    });

    $(".delete").live("click",function(){
        var trouperID = $(this).data("id");
        var oThis = this;
        //alert(sponsorID);
        if(confirm("Are you sure you want to delete this person?") == true)
        {
            $.post("Ajax/Troupers.php", {
                action:"delete", 
                id:trouperID
            },
            function(data){
                //alert(data);
                if(data.result == true){
                    $(oThis).parents("tr").remove();
                }
            },"json");
        }
        return false;
    });    
    
    $("#btnAddTrouper").click(function(){
        log.info("Click Event happeningz now");
        $("#btnUpdate").hide();
        $("#btnCreate").show();
        $("#frmTrouper").resetForm();
        log.info("Trying to open dialog..");
        $("#dialog" ).dialog("open");
    });          
});