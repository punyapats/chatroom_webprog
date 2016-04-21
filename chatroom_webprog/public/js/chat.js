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
    });

    // var key = '{{ $fchatkey }}';
    var key = $('#fkey').val();
    setInterval(function(){
        $.ajax({
            type: "GET",
            url: "/update",
            data: {
                fchatkey : key
            },
            success:function(res)
            {
                // alert(res[0]['text']);
                $("div.chat").empty();
                $.each(res,function(index,value){
                    $("div.chat").append('<p>'+value['date']+" - "+value['text']+'</p>');
                });
            }
        });
    },5000);

});