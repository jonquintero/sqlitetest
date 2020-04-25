<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use App\{Post, Comment};

class CommentController extends Controller
{

    public function index()
    {
        return view('admin.comments.index');
    }


    public function create()
    {
        $posts = Post::select('id', 'name')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.comments.form', compact('data', 'posts'));
    }


    public function store(CommentRequest $request)
    {
        $data = new Comment;
        $data->fill($request->all());
        $data->user_id = auth()->user()->id;
        $data->save();


        $notification = [
            'message' => trans('global.stored_record'),
            'alert_type' => 'success',
        ];

        \Session::flash('notification', $notification);

        return redirect()->route('admin.comments.edit', $data->id);
    }


    public function show($id)
    {
        $data = Comment::find($id);

        return view('admin.comments.show', compact('data'));
    }


    public function edit($id)
    {
        $data = Comment::find($id);
        $posts = Post::select('id', 'name')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.comments.form', compact('data', 'posts'));
    }


    public function update(CommentRequest $request, $id)
    {
        $data = Comment::find($id);

        $data->fill($request->all())->save();


        $notification = [
            'message' => trans('global.stored_record'),
            'alert_type' => 'success',
        ];

        \Session::flash('notification', $notification);

        return redirect()->route('admin.comments.edit', $data->id);
    }


    public function destroy($id)
    {
        $comment = Comment::find($id)->first();

        $this->authorize('delete', $comment);

        Comment::find($id)->delete();

        return response(null, 204);
    }

    public function table(Request $request)
    {
        $query = Comment::with('post')->with('user')->select('comments.*');

        return Datatables::of($query)->addColumn(
            'action',
            function ($dat) {
                return ' <a href="' . route(
                        "admin.comments.show",
                        $dat->id
                    ) . '" class="btn btn-sm btn-primary"><i class="fa fa-eye" data-toggle="tooltip" data-placement="right" title="Show: ' . $dat->name . '"></i></a>

                <a href="' . route(
                        "admin.comments.edit",
                        $dat->id
                    ) . '" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" title="Edit: ' . $dat->name . '"></i></a>
                <button class="btn btn-sm btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete ' . $dat->name . '" data-remote="' . route(
                        "admin.comments.destroy",
                        $dat->id
                    ) . '"><i class="fa fa-trash-o"></i></button> ';
            }
        )
            ->addColumn('checkbox', '<input type="checkbox" name="_checkbox[]" class="_checkbox" value="{{$id}}" />')
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }
}
