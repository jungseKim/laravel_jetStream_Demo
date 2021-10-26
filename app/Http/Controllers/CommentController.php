<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request,$id)
    {
        $request->validate(
            [
                'content' => 'required',
              ]
            );
        Comment::create([
            'content'=>$request->content,
            'post_id'=>$id,
            'user_id'=>auth()->user()->id
        ]);
        return;
    }
    public function index(){
        return Comment::all()->load('user');
    }
}
