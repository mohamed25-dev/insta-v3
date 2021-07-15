<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified'])->except('show');   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'post_caption' => ['required'],
            'image_path' => ['required', 'image']
        ]);

        $imagePath = request('image_path')->store('uploads', 'public');
        $postCaption = $data['post_caption'];

        // $data['image_path'] = $imagePath;
        // $data['user_id'] = auth()->id();

        return view('applyFilter', compact('imagePath', 'postCaption'));
        // Post::create($data);

        // return redirect()->route('user_profile', ['username' => auth()->user()->username]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post == null) {
            abort(404);
        }

        if (auth()->user() != null || $post->user->status == 'private') {
            $this->authorize('view', $post);
        }
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post == null) {
            abort(404);
        }

        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = request()->validate([
            'post_caption' => ['required'],
            'image_path' => ['nullable', 'image']
        ]);

        if (request()->hasFile('image_path')) {
            $imagePath = request('image_path')->store('uploads', 'public');
            $data['image_path']= $imagePath;
        }

        $post->update($data);

        return redirect('/posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post == null) {
            abort(404);
        }

        $this->authorize('delete', $post);

        $post->delete();
        Storage::delete("public/" . $post->image_path);

        return redirect()->route('user_profile', ['username' => auth()->user()->username]);
    }
}
