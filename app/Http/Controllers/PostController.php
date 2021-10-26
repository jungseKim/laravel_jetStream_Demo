<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // return Inertia::render('Post/index');
        return Post::all();
    }
    public function create()
    {
        return Inertia::render('Post/Create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required',
                'image' => 'image|max:2000|nullable'
            ]
        );
        $imageurl = 'noimage.jpg';
        if ($request->image) {
            $imageurl = $this->uploadPostImage($request);
        }

        $user = auth()->user();
        Post::create([
            'user_id' => $user->id,
            'content' => $request->content,
            'title' => $request->title,
            'image' => $imageurl
        ]);

        return redirect()->route('dashboard');
        // return $request;
    }
    public function uploadPostImage(Request $request)
    {
        $name = $request->file('image')->getClientOriginalName();

        $extension = $request->file('image')->extension();
        $originalName = Str::of($name)->basename('.' . $extension);

        $fileName = $originalName . '_' . time() . '.' . $extension;
        // dd($fileName);

        $request->file('image')->storeAs('public/image', $fileName);
        return $fileName;
    }

    public function show($id)
    {
        $temp = Post::find($id);
        $post = $temp->load('user');
        return Inertia::render('Post/Show')->with(['post' => $post]);
    }
    public function edit(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required',
                'image' => 'image|max:2000|nullable'
            ]
        );
        $post = Post::find($id);
        if ($request->image) {
            $imagePath = 'public/image/' . $post->img;
            Storage::delete($imagePath);
            $post->image = $this->uploadPostImage($request);
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('post.show', ["id" => $post->id]);
    }
}
