@extends('layouts.barta')

@section('title', 'Edit Profile')

@section('content')
    <main class="container max-w-xl min-h-screen px-2 mx-auto mt-8 space-y-8 md:px-0">
        {{-- Profile Edit Form  --}}
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-12">
                <div class="pb-12 border-b border-gray-900/10">
                    <h2 class="text-xl font-semibold leading-7 text-gray-900">
                        Edit Profile
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        This information will be displayed publicly so be careful what you
                        share.
                    </p>

                    <div class="pb-12 mt-10 border-b border-gray-900/10">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            {{-- name --}}
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full
                                    Name</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}" @class([
                                            'block w-full rounded-md border p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6',
                                            'border-red-600 dark:border-red-800' => $errors->has('name'),
                                        ]) />
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- username --}}
                            <div class="sm:col-span-3">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                <div class="mt-2">
                                    <input type="text" name="username" id="username"
                                        value="{{ old('username', $user->username) }}" @class([
                                            'block w-full rounded-md border p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6',
                                            'border-red-600 dark:border-red-800' => $errors->has('username'),
                                        ]) />
                                </div>
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- email --}}
                            <div class="col-span-full">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                    address</label>
                                <div class="mt-2">
                                    <input disabled readonly value="{{ old('email', $user->email) }}"
                                        class="block w-full rounded-md border-0 p-2 py-1.5 cursor-not-allowed text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>

                            {{-- password --}}
                            <div class="col-span-full">
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                <div class="mt-2">
                                    <input type="password" name="password" id="password" @class([
                                        'block w-full rounded-md border p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6',
                                        'border-red-600 dark:border-red-800' => $errors->has('password'),
                                    ]) />
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- confirm password --}}
                            <div class="col-span-full">
                                <label for="confirm_password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                                <div class="mt-2">
                                    <input type="password" name="password_confirmation" id="confirm_password"
                                        @class([
                                            'block w-full rounded-md border p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6',
                                            'border-red-600 dark:border-red-800' => $errors->has(
                                                'password_confirmation'),
                                        ]) />
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- bio --}}
                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
                            <div class="mt-2">
                                <textarea id="bio" name="bio" rows="3" @class([
                                    'block w-full rounded-md border p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6',
                                    'border-red-600 dark:border-red-800' => $errors->has('bio'),
                                ])>{{ $user->bio }}</textarea>
                            </div>
                            @error('bio')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-3 text-sm leading-6 text-gray-600">
                                Write a few sentences about yourself.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-6 gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">
                    Cancel
                </button>
                <button type="submit"
                    class="px-3 py-2 text-sm font-semibold text-white bg-gray-600 rounded-md shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                    Save
                </button>
            </div>
        </form>

        @include('profile.partials.delete-user-form')
    </main>
@endsection
