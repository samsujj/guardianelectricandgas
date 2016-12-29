$(function(){
    if($('.homecontactform').find('form').length){
        if($('.homecontactform').find('form').hasClass('sent')){
            $('#formsentmsg').modal('show');

            setTimeout(function(){
                $('#formsentmsg').modal('hide');
            },3000);

        }
    }

    if($('.contactformmm').find('form').length){
        if($('.contactformmm').find('form').hasClass('sent')){
            $('#formsentmsg').modal('show');

            setTimeout(function(){
                $('#formsentmsg').modal('hide');
            },3000);

        }
    }

    $('.contactformmm').find("#frmreset").click(function() {
        $(this).closest('form').find("input[type=text],input[type=tel],input[type=email], textarea").val("");
    });

})