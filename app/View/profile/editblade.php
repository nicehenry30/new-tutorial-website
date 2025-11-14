@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="border p-2 w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
    </form>
</div>
@endsection
