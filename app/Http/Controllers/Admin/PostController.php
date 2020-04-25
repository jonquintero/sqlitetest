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
        abort_unless(\Gate::allows('post_access'), 403);
        return view('admin.posts.index');
    }


    public function create()
    {
        abort_unless(\Gate::allows('post_create'), 403);
        return view('admin.posts.form');
    }


    public function store(PostRequest $request)
    {
        abort_unless(\Gate::allows('post_create'), 403);
        $post = new Post;
        $post->fill($request->all());
        $post->user_id = auth()->user()->id;
        $post->slug = Str::slug($request->input('name'), '-');
        $post->save();

        $this->authorize('pass', $post);

        //IMAGE
        if ($request->file('image')) {
            $path = Storage::disk('public')->put('img', $request->file('image'));
            $post->fill(['file' => asset($path)])->save();
        }

        $notification = [
            'message' => trans('global.stored_record'),
            'alert_type' => 'success',
        ];

        \Session::flash('notification', $notification);

        return redirect()->route('admin.posts.edit', $post->id);
    }


    public function show($id)
    {
        abort_unless(\Gate::allows('post_access'), 403);
        $post = Post::find($id);

        return view('admin.posts.show', compact('post'));
    }


    public function edit($id)
    {
        abort_unless(\Gate::allows('comment_edit'), 403);
        $post = Post::find($id);
        $this->authorize('pass', $post);

        return view('admin.posts.form', compact('post'));
    }


    public function update(PostRequest $request, $id)
    {
        abort_unless(\Gate::allows('comment_edit'), 403);
        $post = Post::find($id);
        $this->authorize('pass', $post);

        $post->fill($request->all())->save();

        //IMAGE
        if ($request->file('image')) {
            $path = Storage::disk('public')->put('image', $request->file('image'));
            $post->fill(['file' => asset($path)])->save();
        }

        $notification = [
            'message' => trans('global.stored_record'),
            'alert_type' => 'success',
        ];

        \Session::flash('notification', $notification);

        return redirect()->route('admin.posts.edit', $post->id);
    }


    public function destroy($id)
    {
        abort_unless(\Gate::allows('post_delete'), 403);
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
