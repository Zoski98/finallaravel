<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::with('user')->where('section', '=', '2')->get();
        return response()->json(['status' => 200, 'posts' => $posts,]);
    }
    public function post(Request $request)
    {
        $post = new Post([
            'user_id' => auth()->user()->id,
            'post_title' => $request->input('post_title'),
            'post_content' => $request->input('post_content'),
            'image' => $request->input('file'),
            'section' => 2,
        ]);
        $post->save();

        return response()->json([
            'data' => $post,
            'username' => $post->user_id,
            'status' => 200,
            'message' => 'Post added succesfully',
        ]);
    }
}
