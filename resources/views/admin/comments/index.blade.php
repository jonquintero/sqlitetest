@extends('layouts.admin')
@section('title', 'Comments' )
@section('breadcrumb')   
   <li class="breadcrumb-item"> Comments</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
       
          {{ trans('global.list') }} Comments

          <a class=" float-right" data-toggle="tooltip" data-placement="right" title="Nuevo Registro" href="{{ route('admin.comments.create') }}" ><i class="btn btn-success fa fa-plus" aria-hidden="true"> {{ trans('global.add') }}</i></a>  

    </div>
            
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                <tr class="text-center">
                    <th> Post {{ trans('global.name') }}</th>
                    <th>Usuario</th>
                    <th>{{ trans('global.created_at') }}</th>
                    <th>{{ trans('global.action') }}</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

   
@endsection

@section('scripts')
@parent
<script>

    $(document).ready(function() {

        $('#table').DataTable({
                language: {
                    url: '{{asset("js/vendor/lang.json")}}'
                },
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                        "url":  '{{ route("admin.comments.table") }}',
                        "type": "get"
                        },
                columns: [
                    {data: 'post.name', name: 'post.name'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, "width": "10%", "class": "text-center" },
                ]
            }).on('search.dt', function() {
              var input = $('.dataTables_filter input')[0];
                // $('#tx').val(input.value);
              //console.log(input.value)
            });

    });  


</script>
@endsection
