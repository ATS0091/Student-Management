$(function() {
    $('#parishioner_form').on('submit', function(e) {
        e.preventDefault();
        selform = $(this);
        show_previewURL = selform.data('prehref');
        if (selform.parsley().isValid()) {
            //console.log($('.form-group .form-control').serializeArray());
            pre_except_data = $('#parishioner_form select[multiple="multiple"]').serializeArray();
            pre_inputdata = $('#parishioner_form input').serializeArray();
            pre_select_data = new Array();
            pre_inputchoose_data = new Array();
            pre_imgdata = new Array();

            //  user_img=$('input[name="user_image"]');
            //  if(user_img.get(0).files && user_img.get(0).files[0]){
            //      var reader = new FileReader();
            //      pre_imgdata.push({name : user_img.attr('name') , value: user_img.get(0).files[0] });
            //      }
            //      console.log(pre_imgdata);
            //pre_imgdata=$('input[name="user_image"]').get(0).files;
            $('#parishioner_form select:not([multiple="multiple"])').each(function(i, v) {
                if ($(this).val() != '')
                    pre_select_data.push({ name: v.name, value: $('option:selected', this).text() });
            });

            $('#parishioner_form input[type="radio"]:checked').each(function(i, v) {
                if ($(this).val() != '')
                    pre_inputchoose_data.push({ name: v.name, value: $(this).next('span').text() });
            });

            $('#parishioner_form input[type="checkbox"]:checked').each(function(i, v) {
                if ($(this).val() != '')
                    pre_inputchoose_data.push({ name: v.name, value: $(this).next('span').text() });
            });
            pre_data = $.merge($.merge(pre_inputdata, pre_select_data), pre_inputchoose_data);
            pre_data = $.merge(pre_data, pre_except_data);
            console.log(pre_data);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: show_previewURL,
                data: pre_data,
                dataType: 'json',
                success: function(response) {
                    $('#preBody').html(response.pre_body)
                    $("#preAddModal").modal("toggle");
                }
            });
        }
    });
    $('#modal_button_confirmation').on('click', function() {
        $('#parishioner_form').off('submit').submit();
    });
});