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
                location.reload();
            }
        });
    },5000);


    $("#createg").click(function(){
        var gname = $('#gname').val();
        var data = { 'checklist' : []};
        $("input:checked").each(function() {
          data['checklist'].push($(this).val());
            // alert($(this).val());
        });
        // alert(data['checklist'][0]);
        $.ajax({
            type: "GET",
            url: "creategroup",
            data: {
                gname : gname,
                checklist : data
            },
            success: function(){
                alert("Created Group!");
            }
            ,datatype : 'json'
        });

    });
});