$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var csrf = $('meta[name="csrf-token"]').attr('content');
/*Defaulits*/

$('.can').on('click', function() {
    $(location).attr('href', '{!! url("parish.parishioners") !!}');
});


$(function() {
    $("#pincode").on("input", function() {
        var str = $(this).val();
        $('.psearch').addClass('text-danger glyphicon glyphicon-repeat');
        $('.glyphicon-repeat').addClass("loading");
        var $url = $(this).data('href');
        if (str.length == 6) {
            var pincode = str;
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'POST',
                url: $url,
                data: { "_token": csrf, "pincode": pincode },
                dataType: 'json',
                success: function(response) {
                    $('.glyphicon-repeat').removeClass("loading");
                    $('.glyphicon-repeat').removeClass("text-danger glyphicon glyphicon-repeat");
                    if (response.status == 'error') {
                        $('.glyphicon-repeat').removeClass("text-danger glyphicon glyphicon-repeat");
                        swal({ title: "PIN CODE NOT FOUND", confirmButtonColor: '#4CAF50', text: "Please recheck your PIN Code or contact the administrator for addition of PIN Code.", type: "error", showConfirmButton: true, }, function() { $('#pincode').val(''); });
                        $('#ward').val("");
                    } else if (response.status == 'success') {
                        $('.psearch').addClass('text-success glyphicon glyphicon-ok');
                        $('.psearch').css({ 'display': 'block' });
                        $('#ward').val(response.ward);
                    }
                }
            });
        } else {
            $('#ward').val("");
        }
    });
    $("#pincode").keyup(function() {
        if (!this.value) {
            $('.glyphicon-repeat').removeClass("loading");
            $('.glyphicon-repeat').removeClass("text-danger glyphicon glyphicon-repeat");
            $('.psearch').removeClass('text-success glyphicon glyphicon-ok');
        }
    });
    $("#pincode").focusout(function() {
        if (this.value.length != 6) {
            $('.glyphicon-repeat').removeClass("loading");
            $('.glyphicon-repeat').removeClass("text-danger glyphicon glyphicon-repeat");
            $('.psearch').removeClass('text-success glyphicon glyphicon-ok');
            $('#pincode').val('');
        }
    });
    $("#pincode").focusin(function() {
        //
    });

});