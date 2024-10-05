<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(StorePostRequest $request)
    {
        Post::create(array_merge(
            ['user_id' => auth()->user()->id],
            $request->validated()
        ));

        return redirect()->intended()->with(['success' => 'Post created successfully']);
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        Gate::authorize('manage', $post);

        return view('post.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize('manage', $post);

        $post->update($request->validated());

        return redirect()->intended()->with(['success' => 'Post updated successfully']);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('manage', $post);

        $post->delete();

        return redirect()->intended()->with(['success' => 'Post deleted successfully']);
    }
}
