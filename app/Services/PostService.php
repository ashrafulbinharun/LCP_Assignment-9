<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store(array $data, $image = null)
    {
        $data = array_merge([
            'user_id' => auth()->id(),
        ], $data);

        $post = Post::create($data);

        if ($image) {
            $post->image = $this->uploadImage($image);
            $post->save();
        }

        return $post;
    }

    public function update(Post $post, array $data, $image = null)
    {
        // Handle image removal if specified
        if (request()->remove_image && $post->image) {
            $this->deleteImage($post->image);
            $data['image'] = null;
        }

        // Handle new image upload if provided
        if ($image) {
            if ($post->image) {
                $this->deleteImage($post->image);
            }

            $data['image'] = $this->uploadImage($image);
        }

        $post->update($data);

        return $post->fresh();
    }

    public function delete(Post $post)
    {
        if ($post->image) {
            $this->deleteImage($post->image);
        }

        return $post->delete();
    }

    private function uploadImage($image)
    {
        return $image->store('post_images', 'public');
    }

    private function deleteImage($imagePath)
    {
        return Storage::disk('public')->delete($imagePath);
    }
}
