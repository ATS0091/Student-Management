$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var csrf = $('meta[name="csrf-token"]').attr('content');
var base_url = $('meta[name="base_url"]').attr('content');
$('.can').on('click', function() {
    $(location).attr('href', base_url + "/parish-panel/parishioners");
});

$(function() {

    var pincode = $("#pincode").val();
    if (pincode) {
        getWards(pincode, $("#pincode").data('href'));
    }

    $("#pincode").on("input", function() {
        var str = $(this).val();
        var $url = $(this).data('href');
        return getWards(str, $url);
    });

    function getWards(str, url) {
        $('.psearch').addClass('text-danger glyphicon glyphicon-refresh');
        $('.glyphicon-refresh').addClass("loading");
        if (str.length == 6) {
            var pincode = str;
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'POST',
                url: url,
                data: { "_token": csrf, "pincode": pincode },
                dataType: 'json',
                success: function(response) {
                    $('.glyphicon-refresh').removeClass("loading");
                    $('.glyphicon-refresh').removeClass("text-danger glyphicon glyphicon-refresh");
                    if (response.status == 'error') {
                        $('.glyphicon-refresh').removeClass("text-danger glyphicon glyphicon-refresh");
                        $('.psearch').removeClass('text-success glyphicon glyphicon-ok');
                        swal({ title: "PIN CODE NOT FOUND", confirmButtonColor: '#4CAF50', text: "Please recheck your PIN Code or contact the administrator for addition of PIN Code.", type: "error", showConfirmButton: true, }, function() { $('#pincode').val(''); });
                        //$('#ward').val("");
                        $('select#ward').find('option').remove();
                        sub_list = '<option disabled selected value=""></option>';
                    } else if (response.status == 'success') {
                        $('.psearch').addClass('text-success glyphicon glyphicon-ok');
                        $('.psearch').css({ 'display': 'block' });
                        //$('#ward').val(response.ward);
                        sub_list = '<option  selected value=' + response.id + '>' + response.ward + '</option>';
                    }
                    $("select#ward").append(sub_list);
                    $('#ward').trigger('change.select2');
                }
            });
        } else {
            $('select#ward').find('option').remove();
            $('#ward').val("");
        }
    }
    $("#pincode").keyup(function() {
        if (!this.value) {
            $('.glyphicon-refresh').removeClass("loading");
            $('.glyphicon-refresh').removeClass("text-danger glyphicon glyphicon-refresh");
            $('.psearch').removeClass('text-success glyphicon glyphicon-ok');
        }
    });
    $("#pincode").focusout(function() {
        if (this.value.length != 6) {
            $('.glyphicon-refresh').removeClass("loading");
            $('.glyphicon-refresh').removeClass("text-danger glyphicon glyphicon-refresh");
            $('.psearch').removeClass('text-success glyphicon glyphicon-ok');
            $('#pincode').val('');
        }
    });
    $("#pincode").focusin(function() {
        //
    });

    /* */
     $('.dropify').dropify();
    $('.languages-known , .parish_involvement').fSelect({ placeholder: '-- Choose --' }); // multiple select

    /*photo upload*/
    $(".single-group").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    $("#occupation ,#profession ,#main-profession,#mother_tongue ,#state ,#district ,#deanery ,#parish_church ,#church_school_name,#city,#zone_community,#sub_community,#course_name").select2({
        allowClear: true
    });

    $('input[name="marital_status"]').on('change', function() {
        if (($(this).prop('checked') == true) && ($(this).val() == 2)) { // checks only if married
            $('.married_to_div').show(); // show married to div
            $('tr.avoid_or_approve_matrimony ').show(); // show and enable  matrimonial sacrament
            $('tr.avoid_or_approve_matrimony input[type="hidden"][name="sac_type[]"]').val($('tr.avoid_or_approve_matrimony input[type="hidden"][name="sac_type[]"]').data('sid'));
            $('tr.avoid_or_approve_matrimony input[type="hidden"][name="not_received_tick[]"]').val('1');
            $('tr.avoid_or_approve_matrimony input:not(:checkbox)').attr('required', 'required');
            $('tr.avoid_or_approve_matrimony input:not(:checkbox)').prop('readonly', false);
            $('tr.avoid_or_approve_matrimony input:not(:checkbox)').css({ "pointer-events": "all" });
            $('tr.avoid_or_approve_matrimony input').prop('disabled', false);
        } else {
            $('.married_to_div input[name="married_to"]').prop('checked', false);
            $('.married_to_div').hide();
            $('tr.avoid_or_approve_matrimony ').hide(); // hide and disable  matrimonial sacrament
            $('tr.avoid_or_approve_matrimony input').val('');
            $('tr.avoid_or_approve_matrimony input[type="hidden"][name="not_received_tick[]"]').val('0');
            $('tr.avoid_or_approve_matrimony input[name="not_received[]"]').prop('checked', false);
            $('tr.avoid_or_approve_matrimony input').removeAttr('required');
            $('tr.avoid_or_approve_matrimony input:not(:checkbox)').prop('readonly', true);
            $('tr.avoid_or_approve_matrimony input:not(:checkbox)').css({ "pointer-events": "none" });
            $('tr.avoid_or_approve_matrimony input').prop('disabled', true);
        }
        if (($(this).prop('checked') == true) && $(this).val() == 3) { //divorced
            $('tr.a1').show();
            $('tr.a1 input[type="hidden"][name="sac_type[]"]').val($('tr.a1 input[type="hidden"][name="sac_type[]"]').data('sid'));
            $('tr.a1 input[type="hidden"][name="not_received_tick[]"]').val('1');
            $('tr.a1 input:not(:checkbox)').attr('required', 'required');
            $('tr.a1 input:not(:checkbox)').prop('readonly', false);
            $('tr.a1 input:not(:checkbox)').css({ "pointer-events": "all" });
            $('tr.a1 input').prop('disabled', false);
        } else {
            $('tr.a1').hide();
            $('tr.a1 input').val('');
            $('tr.a1 input[type="hidden"][name="not_received_tick[]"]').val('0');
            $('tr.a1 input[name="not_received[]"]').prop('checked', false);
            $('tr.a1 input').removeAttr('required');
            $('tr.a1 input:not(:checkbox)').prop('readonly', true);
            $('tr.a1 input:not(:checkbox)').css({ "pointer-events": "none" });
            $('tr.a1 input').prop('disabled', true);
        }
        if (($(this).prop('checked') == true) && $(this).val() == 4) { //4 widow
            $('tr.a3').show();
            $('tr.a3 input[type="hidden"][name="sac_type[]"]').val($('tr.a3 input[type="hidden"][name="sac_type[]"]').data('sid'));
            $('tr.a3 input:not(:checkbox)').attr('required', 'required');
            $('tr.a3 input:not(:checkbox)').prop('readonly', false);
            $('tr.a3 input:not(:checkbox)').css({ "pointer-events": "all" });
            $('tr.a3 input').prop('disabled', false);
        } else {
            $('tr.a3').hide();
            $('tr.a3 input').val('');
            $('tr.a3 input').removeAttr('required');
            $('tr.a3 input:not(:checkbox)').prop('readonly', true);
            $('tr.a3 input:not(:checkbox)').css({ "pointer-events": "none" });
            $('tr.a3 input').prop('disabled', true);
        }
        if (($(this).prop('checked') == true) && $(this).val() == 5) { // Annulled
            $('tr.a2').show();
            $('tr.a2 input[type="hidden"][name="sac_type[]"]').val($('tr.a2 input[type="hidden"][name="sac_type[]"]').data('sid'));
            $('tr.a2 input:not(:checkbox)').attr('required', 'required');
            $('tr.a2 input:not(:checkbox)').prop('readonly', false);
            $('tr.a2 input:not(:checkbox)').css({ "pointer-events": "all" });
            $('tr.a2 input').prop('disabled', false);
        } else {
            $('tr.a2').hide();
            $('tr.a2 input').val('');
            $('tr.a2 input').removeAttr('required');
            $('tr.a2 input:not(:checkbox)').prop('readonly', true);
            $('tr.a2 input:not(:checkbox)').css({ "pointer-events": "none" });
            $('tr.a2 input').prop('disabled', true);
        }
    });

    $('.sacrament_received input[type="checkbox"][name="not_received[]"]').on('change', function() {
        if (($(this).prop('checked') == true)) {
            var the_row = $(this).closest("tr");
            var hidden_field = $(the_row).find('input[type="hidden"]');
            // $(hidden_field).val(''); // value set to empty for hidden field
            $(the_row).find('.form-control').prop('readonly', true);
            $(the_row).find('.form-control').css({ "pointer-events": "none" });
            $(the_row).find('.form-control').css('background-color', '#DEDEDE');
            $(the_row).find('.form-control').removeAttr('required');
            $(the_row).find('.form-control').val('');
            $(the_row).find('.checkbox-tick-status').val('0');
        } else {
            var the_row = $(this).closest("tr");
            var hidden_field = $(the_row).find('input[type="hidden"]');
            // $(hidden_field).val($(hidden_field).data('sid')); // value is set to  hidden field
            $(the_row).find('.form-control').prop('readonly', false);
            $(the_row).find('.form-control').css({ "pointer-events": "all" });
            $(the_row).find('.form-control').css('background-color', '#FFF');
            $(the_row).find('.form-control').attr('required', 'required');
            $(the_row).find('.checkbox-tick-status').val('1');
        }
    });

    $('input[name="church_school_student"]').on('change', function() { // display if studied in any church schools
        if ($(this).val() == 1) {
            $("#church_school_name").val("").attr("required", true);
            $('.select2-container').attr('style', 'width: -webkit-fill-available;');
            $('div.church_school_show').show();
        } else {
            $("#church_school_name").val("").removeAttr("required");
            $('select[name="church_school_name"]').val('');
            $('div.church_school_show').hide();
        }
    });
    /* */
});
