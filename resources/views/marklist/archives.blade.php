@extends('layouts.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Archived List')
@section('content')
@section('page-styles')
<style>
#first td:nth-child(1),#first th:nth-child(1),#first td:nth-last-child(1),#first th:nth-last-child(1)
{
    width: 5% !important;
	text-align:center;
}
.card .header .header-dropdown {
	right: 20px;
}
</style>
@stop

<div class="row clearfix">
<div class="col-lg-12">
   <div class="card">
      <div class="header">
         <h2>{{ (isset($data['arc_name'])?$data['arc_name']:'')}}</h2>
         <ul class="header-dropdown">
            <li>
			<a class="btn btn-outline-info float-md-right" style="margin-top: 5px;" href="{{ route((isset($data['url'])?$data['url']:'')) }}">
				{{ (isset($data['name'])?$data['name']:'')}}
			</a>
			</li>
         </ul>
      </div>
      <div class="body">
         <!---table-->
         <div class="table-responsive">
            <table id="first" class="table table-hover table-bordered dataTable table-custom data-table display" data-url="{{ route((isset($data['publish_url'])?$data['publish_url']:'')) }}" style="width:100%;">
			   <thead class="bg-danger text-white">
				  <tr>
					 <th>Sl.no</th>
					 <th>Name</th>
					 <th>Created on</th>
					 <th>Action</th>
				  </tr>
			   </thead>
			</table>
         </div>
         <!---table-->
      </div>
   </div>
</div>
<!----->
@stop
@section('page-script')
<script>
	$.fn.dataTable.ext.errMode = 'throw';
	$.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) {
		toastr.options = { "timeOut": "5000",'positionClass':'toast-bottom-right'};
		toastr['error']('Please reload the page!','');
	};
    $(function()
    {
        
        $('.modal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
            var $t = $(this),target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
            $(this).find('form').parsley().reset();
        });
        var table = '';
        $('.display').each(function()
        {
            var lang_id = $(this).attr('id');
            var url = $(this).data('url');
            table = $("#" + lang_id).DataTable({
                processing: true,
                serverSide: true,
                "pageLength":10,
                // dom: 'Bfrtip',
                ajax:{url: url,data: function(d) {d.LanguageID = lang_id,d._token =  "{{ csrf_token() }}" }},
                columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'name', name: 'name'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                fnDrawCallback: function( oSettings )
                {
                     //
                     $('.modal_accept').on('click', function(event)
                    {
                        event.preventDefault();
                        var user_id = $(this).data('id');
                        swal({
                            title: "Are you sure?",
                            text: "Activate this row? ",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#28a745",
                            cancelButtonColor: '#dc3545',
                            confirmButtonText: "Yes, Activate!",
                            cancelButtonText: "No, cancel!",
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            closeOnCancel: true,
                            showLoaderOnConfirm: true,
                            //imageUrl: '<i class="fa fa-info">'
                        },
                        function(inputValue)
                        {
                            if(inputValue)
                            {
                                $.ajax({
                                    type: 'POST',
                                    url: '{!! route('all.archive') !!}',
                                    data: {
                                        "_id" : user_id,
                                        'type':'publish',
										'item':'{{ $data['item'] }}',
                                        "_token": "{{ csrf_token() }}",
                                    },
                                    dataType: 'json',
                                    success: function(data)
                                    {
                                        if(data.error){
                                            if(data.error.length > 0){
                                                for(var count = 0; count < data.error.length; count++){
                                                    toastr.options = { "timeOut": "5000",'positionClass':'toast-bottom-right'};
                                                    toastr['error'](data.error[count],'');
                                                    $('.data-table').DataTable().ajax.reload();
                                                }
                                            }
                                        }
                                        if(data.status=='success')
                                        {
                                            swal({
                                                title: "Success!",
                                                type: "success",
                                                text: "Activated Successfully",
                                                confirmButtonColor: "#00af07",
                                            },
                                            function(isConfirm){
                                                if (isConfirm){
                                                    $('.status_section').html("");
                                                    $('.status_section').append('<a href="javascript:;" class="btn btn-outline-success align-right n-btn"><i class="fa fa-check"></i>&nbsp;VERIFIED</a>');
                                                    $('.data-table').DataTable().ajax.reload();
                                                }
                                            });
                                        }

                                    }
                                });
                            }
                        });
                    });
                    //
                },
                "createdRow": function(row, data, dataIndex){  $('[data-toggle="tooltip"]', row).tooltip();  }
            });

        });

    });
</script>
@stop
