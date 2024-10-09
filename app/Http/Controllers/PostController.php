<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(StorePostRequest $request, PostService $postService)
    {
        $postService->store(
            $request->validated(),
            $request->hasFile('image') ? $request->file('image') : null
        );

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

    public function update(UpdatePostRequest $request, Post $post, PostService $postService)
    {
        Gate::authorize('manage', $post);

        $postService->update(
            $post,
            $request->validated(),
            $request->hasFile('image') ? $request->file('image') : null
        );

        return redirect()->intended()->with(['success' => 'Post updated successfully']);
    }

    public function destroy(Post $post, PostService $postService)
    {
        Gate::authorize('manage', $post);

        $postService->delete($post);

        return redirect()->intended()->with(['success' => 'Post deleted successfully']);
    }
}
