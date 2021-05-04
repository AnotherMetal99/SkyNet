<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\SomeonePosted;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->only(['body', 'user_id', 'parent_id']);
        
        if((auth()->user()->id != $data['user_id']) && (!auth()->user()->is_friends_with($request->user_id))) {
            return back()->withErrors(['message' => 'You must be friends first!']);
        }
        if((auth()->user()->id != $data['user_id']) && (auth()->user()->is_friends_with($data['user_id']))) {
            Post::create([
                'body' => $data['body'],
                'parent_id' => $data['user_id'],
                'user_id' => auth()->user()->id
            ]);
            $user = User::where('id', $data['user_id'])->first();
            $user->notify(new SomeonePosted($user, auth()->user()));
            return back();
        }
        if((auth()->user()->id = $data['user_id'])) {
            auth()->user()->posts()->create([
                'body' => $data['body'],
            ]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if((auth()->user()->id != $post->user_id) && (!auth()->user()->is_friends_with($post->user_id))) {
            return back()->withErrors(['message' => 'You do not have permission to delete this post!']);
        }
        if((auth()->user()->id != $post->user_id) && (auth()->user()->id != $post->parent_id)) {
            return back()->withErrors(['message' => 'You do not have permission to delete this post!']);
        }
        if((auth()->user()->id != $post->user_id) && (auth()->user()->id = $post->parent_id)) {
            $post->delete();
            return back();
        }
        if((auth()->user()->id = $post->user_id)) {
            $post->delete();
            return back();
        }
    }
}
