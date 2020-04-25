@extends('layouts.admin')
@section('title', trans('global.show'))
@section('breadcrumb')   
   <li class="breadcrumb-item"> <a href="{{ route('admin.posts.index') }}"> POSTS Cometario </a> </li>
   <li class="breadcrumb-item active" aria-current="page"> {{isset($post->id) ? trans('global.update') : trans('global.register') }} </li>
@endsection

@section('content')

            <div class="card">
                <div class="card-header">
                   POST Cometario
                </div>

                <div class="card-body">
                    <p><strong>Post</strong> {{ $data->post->name }}</p>
                    <p><strong>Slug</strong> {!! $data->body !!}</p>
                    <p><strong>Autor</strong> {{ $data->user->name }}</p>
                </div>
            </div>

@endsection
