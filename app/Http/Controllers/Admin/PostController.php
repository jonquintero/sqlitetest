<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use App\Post;

class PostController extends Controller
{

    public function index()
    {
        return view('admin.posts.index');
    }


    public function create()
    {
        return view('admin.posts.form');
    }


    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->fill($request->all());
        $post->user_id = auth()->user()->id;
        $post->slug = Str::slug($request->input('name'), '-');
        $post->save();

        $this->authorize('pass', $post);


        $notification = [
            'message' => trans('global.stored_record'),
            'alert_type' => 'success',
        ];

        \Session::flash('notification', $notification);

        return redirect()->route('admin.posts.edit', $post->id);
    }


    public function show($id)
    {
        $post = Post::find($id);

        return view('admin.posts.show', compact('post'));
    }


    public function edit($id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);

        return view('admin.posts.form', compact('post'));
    }


    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);

        $post->fill($request->all())->save();


        $notification = [
            'message' => trans('global.stored_record'),
            'alert_type' => 'success',
        ];

        \Session::flash('notification', $notification);

        return redirect()->route('admin.posts.edit', $post->id);
    }


    public function destroy($id)
    {
        $post = Post::find($id)->first();
        $this->authorize('pass', $post);

        Post::find($id)->delete();

        return response(null, 204);
    }

    public function table(Request $request)
    {
        $query = Post::with('user')->select('posts.*');

        return Datatables::of($query)->addColumn(
            'action',
            function ($dat) {
                return ' <a href="' . route(
                        "admin.posts.show",
                        $dat->id
                    ) . '" class="btn btn-sm btn-primary"><i class="fa fa-eye" data-toggle="tooltip" data-placement="right" title="Show: ' . $dat->name . '"></i></a>

                <a href="' . route(
                        "admin.posts.edit",
                        $dat->id
                    ) . '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" title="Edit: ' . $dat->name . '"></i></a>
                <button class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete ' . $dat->name . '" data-remote="' . route(
                        "admin.posts.destroy",
                        $dat->id
                    ) . '"><i class="fa fa-trash-o"></i></button> ';
            }
        )
            ->addColumn('checkbox', '<input type="checkbox" name="_checkbox[]" class="_checkbox" value="{{$id}}" />')
            ->addColumn(
                'comments',
                function ($query) {
                    return $query->comments->count();
                }
            )
            ->rawColumns(['checkbox', 'action', 'comments'])
            ->make(true);
    }
}
