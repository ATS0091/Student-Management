<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Favicon-->
    <title>@yield('title') - Student Management System</title>
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    @yield('meta')
    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">

    @if (Request::segment(1) === 'archdiocese-add-parishioner-or-family' || Request::segment(1) === 'student-managements' || Request::segment(1) === 'archdiocese-add-parishioner-member' || Request::segment(2) === 'summary' || Request::segment(2) === 'send-master-emails' || Request::segment(2) === 'send-master-sms')
        <link rel="stylesheet" href="{{ asset('assets/vendor/multiselect/fSelect.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
    @endif
    @if (Request::segment(2) === 'dashboard' || Request::segment(2) === 'overall-summary')
        <link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/select_material_theme.min.css') }}">
    @endif
    @if (Request::segment(2) === 'requests' || Request::segment(2) === 'summary-master-request' || Request::segment(2) === 'send-master-emails' || Request::segment(2) === 'send-master-sms')
        <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-treeview/bootstrap-treeview.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/jstree/themes/default/style.min.css') }}" />
    @endif
    @if (Request::segment(2) === 'send-master-emails' || Request::segment(2) === 'send-master-sms')
        <link rel="stylesheet" href="{{ asset('assets/css/inbox.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/dist/summernote.css') }}" />
    @endif
    @if (Request::segment(1) === 'student-managements' || Request::segment(1) === 'students' || Request::segment(1) === 'wards' || Request::segment(2) === 'summary' || Request::segment(2) === 'send-master-emails' || Request::segment(2) === 'send-master-sms')
        <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/pnotify/PNotifyBrightTheme.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @stack('after-styles')
    @if (trim($__env->yieldContent('page-styles')))
        @yield('page-styles')
    @endif
    <style>
        .t-status {
            text-transform: capitalize !important;
            font-style: italic
        }

        .check-active {
            cursor: pointer;
            box-shadow: inset 0 2px 0 1px rgba(0, 0, 0, .2), 0 2px 10px 0 rgba(0, 0, 0, .15);
            transition: color 0.15s ease-in-out, background-color 0.15s cubic-bezier(.4, 0, .5, 1.2), border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out
        }

        .select2-selection {
            -webkit-box-shadow: 0;
            box-shadow: 0;
            background-color: #fff;
            border: 0;
            border-radius: 0;
            color: #555;
            font-size: 14px;
            outline: 0;
            min-height: 36px;
            text-align: left
        }

        .select2-selection__rendered,
        .select2-selection__arrow {
            margin: 4px
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #ffa200;
            color: white
        }

        .parish_name {
            text-transform: uppercase;
            color: cadetblue;
        }

    </style>
    @if (Request::segment(2) === 'summary')
        <style>
            .select2-container {
                width: 100% !important;
            }

        </style>
    @endif
</head>
<?php
$setting = !empty($_GET['theme']) ? $_GET['theme'] : '';
$theme = 'theme-cyan';
// if (Request::segment(2) === 'dashboard') {
//     $theme .= ' layout-fullwidth';
// }
$menu = '';
?>

<body class="<?= $theme ?>">
    <div id='loading'>
        <div>
            {{-- <img src="http://demo_aob.test/assets/img/logo.png" width="48" height="48" style="margin-right: 25px;" alt="Diocese Management"> --}}
            <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>
            <span>Message</span>
        </div>
    </div>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            {{-- <div class="m-t-30"><img src="{{ url('/') }}/assets/img/logo.png" width="auto" height="auto"
                    alt="Digital Catholic"></div>
            <p>Please wait...</p> --}}
        </div>
    </div>
    <div id="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <!--6-->
                            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                        class="fa fa-arrow-left"></i></a> @yield('title') @if (Session::get('summary_parish_name') && Request::segment(2) === 'dashboard') - <span class="parish_name">{!! Session::get('summary_parish_name') !!}</span> @endif </h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                            class="icon-home"></i></a></li>
                                @if (trim($__env->yieldContent('parentPageTitle')))
                                    <li class="breadcrumb-item">@yield('parentPageTitle')</li>
                                @endif
                                @if (trim($__env->yieldContent('middle')))
                                    <li class="breadcrumb-item">@yield('middle')</li>
                                @endif
                                @if (trim($__env->yieldContent('subtitle')))
                                    <li class="breadcrumb-item">@yield('subtitle')</li>
                                @endif
                                @if (trim($__env->yieldContent('title')))
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                @endif
                            </ul>
                        </div>
                        @if (Request::segment(2) === 'dashboard' ? 'active' : null)
                            <div class="col-md-1 text-right" style="margin-top: 10px;"> <label>View : </label></div>
                            <!--margin-top: 7px;-->
                            <div class="col-lg-3 col-md-3 col-sm-12 ">
                                <select name="parish_id" class="form-control select2" id="overview_parish">
                                    <option value="0">All </option>
                                    {{-- @foreach ($data['parishioners'] as $id => $name)
                                        <option @if ($request->session()->get('summary_parish') == $id) selected @endif value="{{ $id }}">
                                            {{ ucfirst($name) }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
                <!---error--->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        @if (Session::has('message'))
                            <!--success messages-->
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                <i class="fa fa-check-circle"></i> {{ Session::get('message') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <!--success messages-->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                <i class="fa fa-times-circle"></i> {{ Session::get('error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <!--error messages-->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                @foreach ($errors->all() as $error)
                                    <i>{{ $error }}</i><br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <!---error--->
                @yield('content')
            </div>
        </div>
    </div>
    @yield('page-modals')
</body>
<!-- Scripts -->
@stack('before-scripts')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/morrisscripts.bundle.js') }}"></script>
<!-- Morris Plugin Js -->
<script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script>
<!-- JVectorMap Plugin Js -->
<script src="{{ asset('assets/bundles/knob.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
@if (Request::segment(2) === 'send-master-emails' || Request::segment(2) === 'send-master-sms')
    <script src="{{ asset('assets/vendor/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
@endif
@if (Request::segment(2) === 'dashboard')
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/pages/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/chartjs-plugin-datalabels.min.js') }}"></script>
@endif
@if (Request::segment(1) === 'students' || Request::segment(1) === 'student-managements' || Request::segment(1) === 'wards' || Request::segment(2) === 'summary' || Request::segment(2) === 'requests' || Request::segment(2) === 'summary-master-request' || Request::segment(2) === 'send-master-emails' || Request::segment(2) === 'send-master-sms')
    <script src="{{ asset('assets/vendor/multiselect/fSelect.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
@endif
@if (Request::segment(1) === 'student-managements' || Request::segment(1) === 'students' || Request::segment(1) === 'wards' || Request::segment(2) === 'summary' || Request::segment(2) === 'send-master-emails' || Request::segment(2) === 'send-master-sms')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/pnotify/pnotify.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/pnotify/PNotifyButtons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/pnotify/PNotifyAnimate.min.js') }}"></script>
    @if (Request::segment(1) != 'student-managements' && Request::segment(1) != 'students' && Request::segment(1) != 'wards')
        <script src="{{ asset('assets/vendor/jquery-datatable/dataTables.rowsGroup.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
    @endif
    {{-- <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
        <script> $(function(){ $(".select2").select2({allowClear:!0,width:"100%"}); })</script> --}}
@endif
@if (Request::segment(2) === 'requests')
    <script src="{{ asset('assets/vendor/bootstrap-treeview/bootstrap-treeview.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jstree/jstree.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/treeview/jstree.js') }}"></script>
    <script src="{{ asset('assets/js/pages/treeview/bootstrap-treeview.js') }}"></script>
@endif
{{-- <script src="{{ asset('assets/js/select2_3.5/select2.full.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
{{-- <script> $(function(){ $(".select2").select2({allowClear:!0,width:"100%"}); })</script> --}}
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>


{{-- <script>
    $(function() {
        // $(".js-example-basic-single").select2();
        $('input[data-provide="datepicker"]').datepicker({
            format: "dd-mm-yyyy",
            endDate: "+1d",
            datesDisabled: "+1d"
        })
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $('#overview_parish').on("change", function() {
            var $data_val = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{!! route('archdioece.dashboard') !!}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "data_val": $data_val
                },
                dataType: 'json',
                success: function(response) {
                    //console.log(response.result);
                    if (response.result = 'success') {
                        location.reload();
                        console.log('after page load value-'+$('.knob').val());
                    }
                }
            });
        })
    });
</script> --}}
@stack('after-scripts')
@if (trim($__env->yieldContent('page-script')))
    @yield('page-script')
@endif

</html>
