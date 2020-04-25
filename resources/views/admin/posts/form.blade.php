@extends('layouts.admin')
@section('title', trans('global.register'))
@section('breadcrumb')
   <li class="breadcrumb-item"> <a href="{{ route('admin.posts.index') }}"> POSTS </a> </li>
   <li class="breadcrumb-item active" aria-current="page"> {{isset($post->id) ? trans('global.update') : trans('global.register') }} </li>
@endsection
@section('content')

@php

@endphp

 <div class="card">
      <div class="card-header">{{isset($post->id) ?  trans('global.update') : trans('global.register')}}  POST</div>

                <div class="card-body">

                       <form class="form-horizontal" role="form" method="POST" action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}"  enctype="multipart/form-data" >
                        @csrf

                        @if(isset($post))

                        @method('PUT')
                        @endif

                        <div class="form-group row">
                            <label for="name" class="col-md-1 col-form-label text-md-right">Titulo *</label>

                            <div class="col-md-8">

                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($post) ? $post->name : '') }}">


                               @error('name')
                                   <em class="invalid-feedback">
                                        {{ $message }}
                                    </em>
                               @enderror
                            </div>

                             <label for="status" class="col-md-1 col-form-label text-md-right">{{ trans('global.status') }}</label>


                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" checked="" value="DRAFT" name="status">DRAFT
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" value="PUBLISHED" name="status" {{ (isset($post) && $post->status == 'PUBLISHED') ? 'checked' : '' }} >PUBLISHED
                                    </label>
                                 </div>


                        </div>




                         <div class="form-group row">

                             <label for="name" class="col-md-2 col-form-label">{{ trans('global.description') }} *</label>


                            <div class="col-md-12">

                              <textarea class="form-control  @error('excerpt') is-invalid @enderror" name="excerpt" rows="2" maxlength="350" placeholder="{{ trans('global.description') }}">{{old('excerpt',isset($post->excerpt) ? $post->excerpt : '')}}</textarea>


                               @error('excerpt')
                                   <em class="invalid-feedback">
                                        {{ $message }}
                                    </em>
                               @enderror
                            </div>


                        </div>

                       <label for="name" class="col-md-2 col-form-label">CONTENIDO *</label>

                            <textarea name="body" id="body" class="@error('body') is-invalid @enderror ckeditor"> {{old('body',isset($post->body) ? $post->body : '')}}</textarea>

                             @error('body')
                                   <em class="invalid-feedback">
                                        {{ $message }}
                                    </em>
                               @enderror









                        <button type="submit" id='btnsummit' class="btn btn-primary my-2">{{ trans('global.save') }}</button>
                    </form>

                </div>

@endsection
@section('scripts')
@parent
<script>
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){

    	@error('body.1','title.1','excerpt.1')
               activeTab= "#english"
        @enderror

        @if ($errors->has('body.0','title.0','excerpt.0'))
               activeTab= "#italian"
        @endif

        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
@endsection
