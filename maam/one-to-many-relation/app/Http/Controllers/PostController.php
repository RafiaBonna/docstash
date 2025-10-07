<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    public function index (){
        $post = Post::with('comments')->get();
        // return $post;
        //     dd($post);
        return view('post', compact('post'));
    }
}
