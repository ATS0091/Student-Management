@extends('layouts.master')
@section('title', 'Students')
@section('middle', 'Student Control')
@section('parentPageTitle', 'Dashboard')
@push('before-styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
@endpush
@section('content')
    <style>
        .sl_no_class,
        td:first-child {
            width: 9%;
            text-align: center;
        }

        th {
            text-align: center;
        }

        td:nth-child(1),
        th:nth-child(1),
        td:nth-last-child(1),
        th:nth-last-child(1),
        td:nth-last-child(2),
        th:nth-last-child(2),
        td:nth-last-child(3),
        th:nth-last-child(3) {
            width: 5%;
            text-align: center;
        }

        td:nth-last-child(4) {
            width: 5%;
            text-align: center;
        }

    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>List <span class="badge badge-pill badge-dark" id="list_count">{{ $count }}</span>
                        <small>List out all students added by school.</small>
                    </h2>
                    <ul class="header-dropdown">
                        <li>
                            <a class="btn btn-info btn-sm manage_modal float-md-right text-white"
                                style="margin-top: 5px;margin-left: 5px;">Add new</a>
                            {{-- <a class="btn btn-outline-dark  btn-sm float-md-right " style="margin-top: 5px;"
                                href="{{ route('deanery.archive-list') }}">Archived List</a> --}}
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <!--table-responsive-->
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered dataTable table-custom data-table"
                            style="width:100%">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th class="sl_no_class">Sl.no</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Reporting Teacher</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="sl_no_class">Sl.no</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Reporting Teacher</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!--table-responsive-->
                </div>
            </div>
        </div>
    </div>
    @include('students.modal');
@stop
@push('after-script')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/jquery-datatable/dataTables.rowsGroup.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@endpush
@section('page-script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.manage_modal').click(function() {
            $('#add_student').modal('show');
        });
        $(document).ready(function() {
            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                var $t = $(this),
                    target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
                $(this).find('form').parsley().reset();
            });
        });

        $(document).ready(function() {

            // student table data
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('students.index') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'teacher_id',
                        name: 'teacher_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                fnDrawCallback: function(oSettings) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    //Edit student
                    $('.editModal').on('click', function(e) {
                        var ids = $(this).data('id');
                        var url = "{{ route('students.edit', ':ids') }}";
                        url = url.replace(':id', ids);
                        if (ids) {
                            $.ajax({
                                type: 'GET',
                                url: url,
                                data: ids,
                                dataType: 'json',
                                success: function(response) {
                                    if (response.html) {
                                        $('#test').html(response.html);
                                        $('#add_sample').modal('toggle');
                                    } else {
                                        alert('Oops..Please try again Later !');
                                    }
                                }
                            });
                        }
                    });
                    //Edit student
                    //
                    $('.modal_accept').on('click', function(event) {
                        event.preventDefault();
                        var ids = $(this).data('id');
                        var url = "{{ route('students.destroy', ':ids') }}";
                        url = url.replace(':id', ids);
                        swal({
                                title: "Are you sure?",
                                text: "Delete this Item ? ",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#dc3545",
                                cancelButtonColor: '#d33',
                                confirmButtonText: "Yes, Delete!",
                                cancelButtonText: "No, cancel!",
                                closeOnConfirm: false,
                                animation: "slide-from-top",
                                closeOnCancel: true,
                                showLoaderOnConfirm: true,
                                //imageUrl: '<i class="fa fa-info">'
                            },
                            function(inputValue) {
                                if (inputValue) {
                                    $.ajax({
                                        type: 'DELETE',
                                        url: url,
                                        data: ids,
                                        dataType: 'json',
                                        success: function(data) {
                                            if (data.error) {
                                                if (data.error.length > 0) {
                                                    for (var count = 0; count <
                                                        data.error
                                                        .length; count++) {
                                                        toastr.options = {
                                                            "timeOut": "5000",
                                                            'positionClass': 'toast-bottom-right'
                                                        };
                                                        toastr['error'](data
                                                            .error[count],
                                                            '');
                                                        $('.data-table')
                                                            .DataTable().ajax
                                                            .reload();
                                                    }
                                                }
                                            }
                                            if (data.status == 'success') {
                                                swal({
                                                        title: "Success!",
                                                        type: "success",
                                                        text: data
                                                            .success_message,
                                                        confirmButtonColor: "#00af07",
                                                    },
                                                    function(isConfirm) {
                                                        if (isConfirm) {
                                                            $('.status_section')
                                                                .html("");
                                                            $('.status_section')
                                                                .append(
                                                                    '<a href="javascript:;" class="btn btn-outline-success align-right n-btn"><i class="fa fa-check"></i>&nbsp;OK</a>'
                                                                );
                                                            $('.data-table')
                                                                .DataTable()
                                                                .ajax
                                                                .reload();
                                                        }
                                                    });
                                            }

                                        }
                                    });
                                }
                            });
                    });
                    //
                } //fnDraw
            });
        });

        $('#student_manage_from').on('submit', function(e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            var id = $("input[name='id']", this).val();
            var instance = $(this).parsley();
            if (instance.isValid()) {
                var url = "{{ route('students.update', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'PATCH',
                    url: url,
                    data: form_data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < response.error.length; count++) {
                                error_html += response.error[count];
                                error_html += '<br>';
                            }
                            $('#form_output_edit').html('<div class="alert alert-danger">' +
                                error_html + '</div>');
                        }
                        if (response.status == 'success') {
                            $('#add_sample').modal('hide');
                            $('.data-table').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
        // Add
        $('#student_from').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            var instance = $(this).parsley();
            if (instance.isValid()) {
                $.ajax({
                    url: "{{ route('students.store') }}",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    success: function(data) {
                        if (data.error.length > 0) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += data.error[count];
                                error_html += '<br>';
                            }
                            $('#form_output').html('<div class="alert alert-danger">' + error_html +
                                '</div>');
                        }
                        if (data.status == 'success') {
                            $('#add_deanery').modal('hide');
                            location.reload();
                        }
                    }
                });
            }
        });
    </script>
@stop
