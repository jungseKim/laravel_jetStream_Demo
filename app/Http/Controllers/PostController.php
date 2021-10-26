<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $post=Post::latest()->paginate(3);
        return Inertia::render('Post/Index',['list'=>$post]);
        // return Post::latest()->paginate(3);

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
        $imageurl = null;
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
        // return dd($temp);
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

        $this->authorize('update', $post);

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
    public function distroy($id){
        $post=Post::find($id);

        $this->authorize('delete', $post);

        if($post->image){
            $imagePath='public/image/'.$post->image;
            Storage::delete($imagePath);
        }
        $post->delete();

        return redirect()->route('post.index');

    }
}
