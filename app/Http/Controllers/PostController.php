<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = 'posts.paginate.'.request('page', 1);

        $posts = Cache::remember($key, 5000, function () {
            return Post::latest()->paginate(10);
        });

        return view( 'post.index', compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(['id','name']);
        return view('post.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
            'user_id'   => 'required|integer',
            'title'     => 'required|string',
            'comment'   => 'nullable|string'
        ]);

        Post::create( $request->all() );

        Cache::flush();

        return redirect()->route('post.index', ['estado' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $users = User::all();
        return view('post.edit', compact('users','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate( $request, [
            'title'     => 'required|string',
            'comment'   => 'nullable|string'
        ]);
        $post->update( $request->all() );

        return redirect()->route('post.edit', [$post->id, 'estado' => 'ok']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Cache::flush();

        return redirect()->route('post.index', ['estado' => 'ok']);
    }
}
