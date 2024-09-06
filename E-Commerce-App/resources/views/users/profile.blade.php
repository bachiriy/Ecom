@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            @if(session('success'))
                <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold mb-4">Update Profile</h2>
            <form method="POST" action="{{ route('account.update') }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                           class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                           class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="flex items-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
        <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4">Account Deletion</h2>

            <p class="text-gray-700 mb-4">
                Are you sure you want to delete your account? This action is irreversible, and all your data will be permanently removed.
            </p>

            <form action="{{ route('account.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action is irreversible, and all your data will be permanently removed.')">
                @csrf
                @method('DELETE')

                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:border-red-700">
                    Delete My Account
                </button>
            </form>
        </div>

    </div>
@endsection
