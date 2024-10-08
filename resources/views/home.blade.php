@extends('layouts.barta')

@section('title', 'Home')

@section('content')
    <main class="container max-w-xl min-h-screen px-2 mx-auto mt-8 space-y-8 md:px-0">

        {{-- Aleart --}}
        @if (session('success'))
            <div class="flex items-center justify-center p-4 mb-4 text-sm font-medium text-green-800 border-2 border-green-300 rounded-lg bg-green-50"
                role="alert">
                <span class="sr-only">Success</span>
                <div class="text-center">{{ session('success') }}</div>
            </div>
        @endif

        {{-- Barta Create Post Card  --}}
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
            class="px-4 py-5 mx-auto space-y-6 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6"
            x-data="postForm()">
            @csrf

            <div class="flex space-x-3">
                {{-- User Avatar --}}
                <div class="flex-shrink-0">
                    @if (auth()->check())
                        <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->get_avatar }}"
                            alt="{{ auth()->user()->name }}" />
                    @else
                        <img class="w-8 h-8 rounded-full" src="https://avatars.githubusercontent.com/u/150423186?v=4"
                            alt="Guest User" />
                    @endif
                </div>

                <div class="flex-1">
                    {{-- Image Preview --}}
                    <div class="relative flex items-center justify-center mb-4" x-show="imagePreview">
                        <img x-bind:src="imagePreview"
                            class="object-cover w-full rounded-lg min-h-auto max-h-64 md:max-h-72" alt="Post Image Preview">

                        {{-- Button to Remove Image --}}
                        <button type="button" @click="removeImage()"
                            class="absolute flex items-center justify-center w-6 h-6 text-white bg-gray-600 rounded-full top-2 right-2 hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Content --}}
                    <div class="w-full font-normal text-gray-700">
                        <textarea
                            class="block w-full pt-2 text-gray-900 bg-gray-200 border-none rounded-lg outline-none focus:ring-0 focus:ring-offset-0"
                            name="content" rows="3" placeholder="Share your thoughts ...">{{ old('content') }}</textarea>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="mt-2 text-sm text-red-600">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- Create Post Card Bottom --}}
            <div class="flex items-center justify-between">
                <div class="flex gap-4 text-gray-600">
                    {{-- Upload Picture Button --}}
                    <div>
                        <input type="file" name="image" id="picture" class="hidden" x-ref="pictureInput"
                            @change="previewImage($event)" />
                        <label for="picture"
                            class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full cursor-pointer hover:text-gray-800">
                            <span class="sr-only">Picture</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                    Post
                </button>
            </div>
        </form>

        {{-- Barta Single Post Card --}}
        @foreach ($posts as $post)
            <article class="px-4 py-5 mx-auto bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            {{-- User Avatar --}}
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="{{ $post->user->get_avatar }}"
                                    alt="{{ $post->user->name }}" />
                            </div>

                            {{-- User Info --}}
                            <div class="flex flex-col flex-1 min-w-0 text-gray-900">
                                <a href="{{ route('profile.index', $post->user->username) }}"
                                    class="font-semibold hover:underline line-clamp-1">
                                    {{ $post->user->name }}
                                </a>

                                <a href="{{ route('profile.index', $post->user->username) }}"
                                    class="text-sm text-gray-500 hover:underline line-clamp-1">
                                    {{ '@' . $post->user->username }}
                                </a>
                            </div>
                        </div>

                        {{-- Card Action Dropdown --}}
                        @can('manage', $post)
                            <div class="flex self-center flex-shrink-0" x-data="{ open: false }">
                                <div class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" type="button"
                                            class="flex items-center p-2 -m-2 text-gray-400 rounded-full hover:text-gray-600"
                                            id="menu-0-button">
                                            <span class="sr-only">Open options</span>
                                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    {{-- Dropdown menu  --}}
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                            tabindex="-1" id="user-menu-item-0">Edit</a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                class="block w-full px-4 py-2 text-sm text-gray-700 text-start hover:bg-gray-100"
                                                role="menuitem" tabindex="-1" id="user-menu-item-1">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </header>

                {{-- Image Preview --}}
                @if ($post->image)
                    <div class="my-4">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                            class="object-cover w-full h-auto rounded-lg max-h-64">
                    </div>
                @endif

                {{-- Content --}}
                <div class="py-4 font-normal text-gray-700">
                    <p class="mb-2">
                        {{ str($post->content)->limit(300) }}
                    </p>
                    <a href="{{ route('posts.show', $post) }}" class="text-xs text-gray-600 hover:underline">View
                        Post</a>
                </div>

                {{-- Post Details --}}
                <div class="flex items-center gap-2 mb-2 text-xs text-gray-500">
                    <span class="">{{ $post->created_at->diffForHumans() }}</span>
                    <span class="">•</span>
                    <span>450 views</span>
                </div>

                {{-- Barta Card Bottom --}}
                <footer class="py-2 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-8 text-gray-600">
                            {{-- Heart Button --}}
                            <button type="button"
                                class="flex items-center gap-2 p-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                                <span class="sr-only">Like</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                {{-- Heart Count --}}
                                <p>36</p>
                            </button>

                            {{-- Comment Button --}}
                            <button type="button"
                                class="flex items-center gap-2 p-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                                <span class="sr-only">Comment</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                </svg>
                                {{-- Comment Count --}}
                                <p>17</p>
                            </button>
                        </div>

                        {{-- Share Button --}}
                        <div>
                            <button type="button"
                                class="flex items-center gap-2 p-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                                <span class="sr-only">Share</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </footer>
            </article>
        @endforeach

        <script>
            function postForm() {
                return {
                    imagePreview: null,

                    previewImage(event) {
                        const file = event.target.files[0];
                        if (file) {
                            this.imagePreview = URL.createObjectURL(file);
                        }
                    },

                    removeImage() {
                        this.imagePreview = null;
                        this.$refs.pictureInput.value = null;
                    }
                }
            }
        </script>
    </main>
@endsection
