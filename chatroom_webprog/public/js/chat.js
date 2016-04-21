$(document).ready(function()
{

    $("#add").click(function(){
        var femail = $('#usr').val();
        $.ajax({
            type: "GET",
            url: "add",
            data: {
                femail : femail
            },
            success: function(){
                alert("Add friend Success");
                location.reload();
            }
            ,datatype : 'json'
        });

    })

    $("#createg").click(function(){
        var gname = $('#gname').val();
        $.ajax({
            type: "GET",
            url: "creategroup",
            data: {
                gname : gname
            },
            success: function(){
                alert("Created Group!");
            }
            ,datatype : 'json'
        });

    })
});