<?php

namespace App\Http\Controllers\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;

class CommentController extends Controller
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
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post) {
        if((auth()->user()->id != $request->user_id) && (!auth()->user()->is_friends_with($request->user_id))) {
            return back();
        }
        if((auth()->user()->id != $request->user_id) && (auth()->user()->is_friends_with($request->user_id))) {
            auth()->user()->comments()->create([
                'body' => $request->body,
                'post_id' => $post->id,
            ]);
            return back();
        }
        if((auth()->user()->id = $request->user_id)) {
            auth()->user()->comments()->create([
                'body' => $request->body,
                'post_id' => $post->id,
            ]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {    $post = Comment::where('id', $post_id)->first();
        if((auth()->user()->id != $post->user_id) && (!auth()->user()->is_friends_with($post->user_id))) {
            return back()->withErrors(['message' => 'У вас нет разрешения на удаление этого комментария!']);
        }
        if((auth()->user()->id != $post->user_id) && (auth()->user()->id != $post->parent_id)) {
            return back()->withErrors(['message' => 'У вас нет разрешения на удаление этого комментария!']);
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