$('.manage_modal').click(function() { $('#add_form')[0].reset();
    $('#add_modal').modal('show'); });
$('#add_modal').on('hidden.bs.modal', function(e) { $('#add_form').parsley().reset();
    $('#form_output').html('');
    $('.parsley-errors-list').remove(); });
$(function() {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: $.ajax({ url: "{{ route('city.index') }}", data: { "_token": "{{ csrf_token() }}" }, dataType: 'json' }),
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'city_name', name: 'city_name' },
            { data: 'district', name: 'district' },
            { data: 'state', name: 'state' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        fnDrawCallback: function(oSettings) {
            $(".select2").select2({ allowClear: true, width: '100%', dropdownParent: $("#add_modal") });
            $('.editCityModal').on('click', function(e) {
                var id = $(this).data('id');
                var url = "{{ route('city.edit', ": id ") }}";
                url = url.replace(':id', id);
                if (id)
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: id,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.html) {
                                $('.content').html(response.html);
                                $("#edit_city").on("input", function() {
                                    var str = $(this).val();
                                    var slug = '';
                                    var trimmed = $.trim(str);
                                    slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
                                    slug = slug.toLowerCase();
                                    $('#editslug').val(slug);
                                });
                                $('#edit_modal').modal('toggle');
                                $(function() {
                                    var state_id = $('#hidden_state_id').val();
                                    var $district_id = $('#hidden_state_id').data('district');
                                    var _token = $('input[name="_token"]').val();
                                    var $district = $('#updated_district_id');
                                    if (state_id) {
                                        $.ajax({
                                            url: "{{ route('city.district_fetch') }}",
                                            method: "POST",
                                            data: { value: state_id, _token: _token },
                                            success: function(data) {
                                                $district.empty();
                                                $('#edit_city').empty();
                                                $district.append('<option value="">-- Choose District --</option>');
                                                var s = '';
                                                $.each(data.districts, function(key, value) {
                                                    if ($district_id == key) { s = 'selected'; }
                                                    $district.append('<option value="' + key + '" ' + s + '>' + value + '</option>');
                                                });
                                                $district.change();
                                            }
                                        });
                                    } else {
                                        $('#updated_district_id').empty();
                                    }
                                });
                            } else {
                                alert('Oops..Please try again Later !');
                            }
                        }
                    });
            });
        },
        "createdRow": function(row, data, dataIndex) {
            $('[data-toggle="tooltip"]', row).tooltip();
        }
    });
});
$(document).ready(function() {
    $('.dynamic').on('change', function() {
        var $district = $('#district_id');
        if ($(this).val() != '') {
            var id = $(this).val();
            var _token = $('input[name="_token"]').val();
            if (id) {
                $.ajax({
                    url: "{{ route('city.district_fetch') }}",
                    method: "POST",
                    data: { value: id, _token: _token },
                    success: function(data) {
                        $district.empty();
                        $('#city').empty();
                        $district.append('<option value="">-- Choose District --</option>');
                        $.each(data.districts, function(key, value) {
                            $district.append('<option value="' + key + '">' + value + '</option>');
                        });
                        $district.change();
                    }
                });
            } else {
                $('select[name="district_id"]').empty();
            }
        } else {
            $district.empty();
            $district.append('<option value="">-- Choose District --</option>');
            $district.change();
        }
    });
});

// Add new
$('#add_form').on('submit', function(event) {
    event.preventDefault();
    var form_data = $(this).serialize();
    var instance = $(this).parsley();
    if (instance.isValid()) {
        $.ajax({
            url: "{{ route('city.store') }}",
            method: "POST",
            data: form_data,
            dataType: "json",
            success: function(data) {
                if (data.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) { error_html += data.error[count];
                        error_html += '<br>'; }
                    $('#form_output').html('<div class="alert alert-danger">' + error_html + '</div>');
                }
                if (data.status == 'success') {
                    $('#add_modal').modal('hide');
                    location.reload(); //$('.data-table').DataTable().ajax.reload();
                }
            }
        });
    }
});
$("#city").on("input", function() { var str = $(this).val(); var slug = ''; var trimmed = $.trim(str);
    slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
    slug = slug.toLowerCase();
    $('#slug').val(slug); var matches = str.match(/\b(\w)/g); var acronym = matches.join('');
    $('#code').val(acronym.toUpperCase()); });
$('#edit_form').on('submit', function(e) {
    e.preventDefault();
    var form_data = $(this).serialize();
    var id = $("input[name='id']", this).val();
    var instance = $(this).parsley();
    if (instance.isValid()) {
        var url = "{{ route('city.update',": id ") }}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'PATCH',
            url: url,
            data: form_data,
            dataType: 'json',
            success: function(response) {
                if (response.error.length > 0) {
                    var error_html = '';
                    for (var count = 0; count < response.error.length; count++) { error_html += response.error[count];
                        error_html += '<br>'; }
                    $('#edit_form_output').html('<div class="alert alert-danger">' + error_html + '</div>');
                }
                if (response.status == "success") { location.reload(); }
            }
        });
    }
});