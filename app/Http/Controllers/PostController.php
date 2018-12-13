<?php

namespace CRUDTEST\Http\Controllers;

use Illuminate\Http\Request;
use CRUDTEST\Post;
use CRUDTEST\User;
use Auth;
use CRUDTEST\Http\Requests\StorePost;

class PostController extends Controller
{
    /**
     * 各アクションの前に実行されるミドルウェア
     */
    public function __construct()
    {
        //$this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->except('index', 'show');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', [
            'posts' => $posts
        ]);
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
     * @param  \Illuminate\Requests\StorePost  $request
     * @param  \CRUDTEST\Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request, Post $post)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $post->create([
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => $user->id,
            ]);
            return redirect('posts/'.$post->id);
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \CRUDTEST\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CRUDTEST\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Requests\StorePost  $request
     * @param  \CRUDTEST\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('edit', $post);
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect('posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CRUDTEST\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('edit', $post);
        $post->delete();
        return redirect('posts');
    }
}
