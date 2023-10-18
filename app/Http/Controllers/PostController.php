<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::orderBy('id','desc')->paginate(5);
        return view('posts.index',[
            'post'  => $post,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'title' => 'required|unique:posts',
            'content' => 'required',
        ];
        $msg = [
            'title.required' => 'Title harus diisi!',
            'content.required' => 'Content harus diisi!'
        ];
        $request->validate($data, $msg);
        dd($request->all());
    }

    public function store2(PostRequest $request)
    {
        // dd($request->all());

        // return $request->file('image')->store('images-posts');

        // $post = new Post();
        // $post->title    = $request->title;
        // $post->content  = $request->content;
        // $post->save();

        Post::create([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'content'   => $request->content,
            'image'     => $request->file('image')->store('images-posts')
        ]);

        return redirect()->route('posts.index')->with('ok',"Berhasil menambahkan data post!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {   $post = Post::where('slug',$slug)->with('comments')->first();
        return view('posts.show',[
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit',[
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            if (!empty($post->image)) {
                Storage::delete($post->image);
            }
            $post->image = $request->file('image')->store('images-posts');
        }
        $post->title    = $request->title;
        $post->slug     = Str::slug($request->title);
        $post->content  = $request->content;
        $post->save();
        return redirect()->route('posts.index')->with('ok',"Berhasil mengubah data post!");


        // $post = Post::findOrFail($id);
        // $post->title    = $request->title;
        // $post->slug     = Str::slug($request->title);
        // $post->content  = $request->content;
        // $post->save();
        // return redirect()->route('posts.index')->with('ok',"Berhasil mengubah data post!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id); 
        if (!empty($post->image)) {
            Storage::delete($post->image);
        }
        $post->delete();               
        return redirect()->back()->with('ok',"Berhasil menghapus data post!");
    }
}
