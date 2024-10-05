<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class GlobalPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::with('user')->latest()->get();

        return view('home', compact('posts'));
    }
}
