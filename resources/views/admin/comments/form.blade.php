@extends('layouts.admin')
@section('title', trans('global.register'))
@section('breadcrumb')   
   <li class="breadcrumb-item"> <a href="{{ route('admin.comments.index') }}"> Comments </a> </li>
   <li class="breadcrumb-item active" aria-current="page"> {{isset($data->id) ? trans('global.update') : trans('global.register') }} </li>
@endsection
@section('content')

@php
 //dump($data)
 //dump($errors)
@endphp

 <div class="card">
      <div class="card-header">{{isset($data->id) ?  trans('global.update') : trans('global.register')}}  Commentario</div>

                <div class="card-body">

                       <form class="form-horizontal" role="form" method="POST" action="{{ isset($data) ? route('admin.comments.update', $data->id) : route('admin.comments.store') }}"  >
                        @csrf

                        @if(isset($data))

                        @method('PUT')
                        @endif

                          <div class="form-group row">
                            <label for="data" class="col-md-1 col-form-label text-md-right">Post *</label>

                            <div class="col-md-10 @error('post_id') is-invalid @enderror">

                                 <select class="form-control select2" id="post_id" name="post_id" >

                                  @foreach($posts as $id => $name)

                                      @if(old('data_id', isset($data->data_id) && $data->data_id == $id) == $id )
                                       <option value="{{ $id }}" selected>{{ $name }}</option>
                                      @else
                                       <option value="{{ $id }}">{{ $name }}</option>
                                      @endif

                                  @endforeach
                              </select>


                               @error('post_id')
                                   <em class="invalid-feedback">
                                        {{ $message }}
                                    </em>
                               @enderror
                            </div>
                        </div>

                       

                    

                       <label for="name" class="col-md-2 col-form-label">CONTENIDO *</label>

                            <textarea name="body" id="body" class="@error('body') is-invalid @enderror ckeditor"> {{old('body',isset($data->body) ? $data->body : '')}}</textarea>

                             @error('body')
                                   <em class="invalid-feedback">
                                        {{ $message }}
                                    </em>
                               @enderror


                    

                        <button type="submit" id='btnsummit' class="btn btn-primary my-2">{{ trans('global.save') }}</button>
                    </form> 

                    <hr>
                     

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
