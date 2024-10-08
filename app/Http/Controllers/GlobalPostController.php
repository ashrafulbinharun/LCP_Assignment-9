<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class GlobalPostController extends Controller
{
    public function __invoke(Request $request)
    {
        $posts = Post::with('user')
            ->when($request->query('search'), function ($query, $word) {
                $query->whereHas('user', function ($query) use ($word) {
                    $query->where('name', 'LIKE', '%'.$word.'%')
                        ->orWhere('username', 'LIKE', '%'.$word.'%')
                        ->orWhere('email', 'LIKE', '%'.$word.'%');
                });
            })
            ->latest()
            ->get();

        return view('home', compact('posts'));
    }
}
