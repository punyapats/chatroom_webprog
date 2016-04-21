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