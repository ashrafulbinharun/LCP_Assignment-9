@extends('layouts.barta')

@section('title', 'Edit Post')

@section('content')
    <main class="container max-w-xl min-h-screen px-2 mx-auto mt-8 space-y-8 md:px-0">
        {{-- Barta Edit Post Card  --}}
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data"
            class="px-4 py-5 mx-auto space-y-3 bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
            @method('PUT')
            @csrf
            <div>
                <div class="flex items-start space-x-3">
                    {{-- User Avatar  --}}
                    <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="https://avatars.githubusercontent.com/u/150423186?v=4"
                            alt="Ashraful Karim" />
                    </div>

                    {{-- Content  --}}
                    <div class="w-full font-normal text-gray-700">
                        <textarea class="block w-full pt-2 text-gray-900 border-none rounded-lg outline-none focus:ring-0 focus:ring-offset-0"
                            name="content" rows="10" placeholder="What's going on, {{ auth()->user()->name }}?">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Create Post Card Bottom  --}}
            <div>
                <div class="flex items-center justify-between">
                    <div class="flex gap-4 text-gray-600">
                        {{-- Upload Picture Button --}}
                        <div>
                            <input type="file" name="picture" id="picture" class="hidden" />
                            <label for="picture"
                                class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full cursor-pointer hover:text-gray-800">
                                <span class="sr-only">Picture</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </label>
                        </div>

                        {{-- GIF Button  --}}
                        <button type="button"
                            class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                            <span class="sr-only">GIF</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12.75 8.25v7.5m6-7.5h-3V12m0 0v3.75m0-3.75H18M9.75 9.348c-1.03-1.464-2.698-1.464-3.728 0-1.03 1.465-1.03 3.84 0 5.304 1.03 1.464 2.699 1.464 3.728 0V12h-1.5M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                        </button>

                        {{-- Emoji Button  --}}
                        <button type="button"
                            class="flex items-center gap-2 p-2 -m-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                            <span class="sr-only">Emoji</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 -m-2 text-xs font-semibold text-white bg-gray-800 rounded-full hover:bg-black">
                        Post
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection
