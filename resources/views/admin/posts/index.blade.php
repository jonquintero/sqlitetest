@extends('layouts.admin')
@section('title', 'POSTS' )
@section('breadcrumb')
   <li class="breadcrumb-item"> POSTS</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">

          {{ trans('global.list') }} POSTS

          <a class=" float-right" data-toggle="tooltip" data-placement="right" title="Nuevo Registro" href="{{ route('admin.posts.create') }}" ><i class="btn btn-success fa fa-plus" aria-hidden="true"> {{ trans('global.add') }}</i></a>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                <tr class="text-center">
                    <th> {{ trans('global.name') }}</th>
                    <th> Slug</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th># Comments</th>
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
                        "url":  '{{ route("admin.posts.table") }}',
                        "type": "get"
                        },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'status', name: 'status'},
                    {data: 'comments', name: 'comments', searchable: false },
                    {data: 'action', name: 'action', orderable: false, searchable: false, "width": "10%", "class": "text-center" },
                ]
            }).on('search.dt', function() {
              var input = $('.dataTables_filter input')[0];

            });

    });


</script>
@endsection
