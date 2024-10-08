<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('post_images', 'public');
        }

        Post::create(array_merge(
            ['user_id' => auth()->user()->id], $data
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

        $data = $request->validated();

        // if the user wants to remove the existing image
        if ($request->remove_image && $post->image) {
            Storage::disk('public')->delete($post->image);
            $data['image'] = null;
        }

        // handle new image upload
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $request->file('image')->store('post_images', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);

        return redirect()->intended()->with(['success' => 'Post updated successfully']);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('manage', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->intended()->with(['success' => 'Post deleted successfully']);
    }
}
