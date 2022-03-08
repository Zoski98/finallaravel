<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\World;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $posts = Post::with('comment.user')->where('id', '=', $id)->firstOrFail();
        return response()->json([
            'status' => 200,
            'posts' => $posts,
        ]);
    }

    public function destroy($id)
    {
        $posts = Post::find($id);
        $posts->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Post Deleted Succesfully',
        ]);
    }

    public function approve($id)
    {

        $post = Post::find($id);
        $post->isApproved = true;
        $post->update();

        return response()->json([
            'status' => 200,
            'message' => 'Post updated succesfully',
        ]);
    }
}
