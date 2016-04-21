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
            }
            ,datatype : 'json'
        });
    })
});