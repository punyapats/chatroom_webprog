$(document).ready(function()
{

    $("#add").click(function(){
        var femail = $('usr').val();
        var userid = "{{ Auth::user()->id }}";
        $.ajax({
            type: "POST",
            url: "addfriend",
            data: {
                femail:femail,
                userid:userid
            },
            success: function(){
                alert("Add friend Success");
            }
                ,
            dataType: dataType
        });
    }

});