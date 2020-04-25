@extends('layouts.admin')
@section('title', trans('global.show'))
@section('breadcrumb')   
   <li class="breadcrumb-item"> <a href="{{ route('admin.posts.index') }}"> POSTS </a> </li>
   <li class="breadcrumb-item active" aria-current="page"> {{isset($post->id) ? trans('global.update') : trans('global.register') }} </li>
@endsection

@section('content')

            <div class="card">
                <div class="card-header">
                   POST
                </div>

                <div class="card-body">
                    <p><strong>{{ trans('global.name') }}</strong> {{ $post->name }}</p>
                    <p><strong>Slug</strong> {{ $post->slug }}</p>
                    <p><strong>{{ trans('global.excerpt') }}</strong> {{ $post->excerpt }}</p>
                    <p><strong>Autor</strong> {{ $post->user->name }}</p>

         
       

                    @if(count($post->comments) > 0)
                    <hr>

                    <i class="nav-icon fa fa-comments"> <b>Comentarios</b></i>

                      @foreach($post->comments as $comment)
                      <hr>
                        <b>{{ $comment->user->name}} </b> 
                        <p class="text-justify">{{ $comment->body}}</p>
                        
                      @endforeach
                    @endif

                    


                </div>
            </div>

@endsection
