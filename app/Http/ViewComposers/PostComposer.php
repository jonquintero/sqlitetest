<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Post;

class PostComposer {

	public function compose(View $view)
	{

        $posts= Post::select('id', 'name')
                          ->orderBy('name', 'ASC')
                          ->pluck('name','id');

                          dd($posts);

        $view->with('posts',  $posts);

	}
}
