<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller

{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy($id)
    {
        $comments = Comment::find($id);
        $comments->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Comment Deleted Succesfully',
        ]);
        
    }
    
    public function create(Request $request, $id){
        $comment = new Comment([
           'user_id' => auth()->user()->id,
           'post_id' => $id,
           'reply_content' => $request->input('reply_content'),
           'files' => $request->input('file'),
       ]);
       $comment->save();
       return response()->json([
        'data' => $comment,
        'status' => 200,
        'message' => 'Comment added succesfully', ]);
    
    }

    // public function show($id)
    // {
    //     $comments = Comment::all()->where('post_id', '=', $id);
    //     return response()->json([
    //         'status' => 200,
    //         'comments' => $comments,
    //     ]);
    // }

    // public function getComment($id) {
    //     $comments = Comment::query()->where('post_id', $id)->get();
    //     return $comments;
    // }

   


}
