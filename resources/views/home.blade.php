@extends('layouts.admin')
@section('content')
<div class="content">
	@can('post_access')
		<h1> Posts Published </h1>
	    <div class="row">

	        @if(count($posts) > 0)

	           @foreach($posts as $post)
		          <div class="col-md-3">
		             <div class="card" style="width: 18rem; height: 15rem">
					  <div class="card-body">
					    <h5 class="card-title">{{$post->name}}</h5>
					    <p class="card-text">{{$post->excerpt}} </p>
					    <a href="{{ route('admin.posts.show', $post->id) }}" class="card-link">Read more</a>

					  </div>
					</div>
				   </div>

				@endforeach
			{{ $posts->render() }}
	       @endif

	    </div>
	 @endcan

	</div>
@endsection
@section('scripts')
@parent

@endsection
