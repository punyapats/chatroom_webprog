$(document).ready(function()
{
    $("#add").click(function(){
        var femail = $('usr').val();
        $.post("addfriend.php",{femail:})
    }
});