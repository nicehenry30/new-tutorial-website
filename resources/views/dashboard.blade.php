@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">User Dashboard</h1>

        @if (session('error'))
            <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @elseif (session('success'))
            <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($tutorials as $tutorial)
                <div class="border p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">{{ $tutorial->title }}</h2>
                    <p class="text-gray-600">{{ $tutorial->description }}</p>

                    @if ($tutorial->video_path)
                        <a href="{{ route('tutorial.show', $tutorial->id) }}" class="text-blue-600 mt-2 inline-block">Watch
                            Video</a>
                    @endif

                    @if ($tutorial->file_path)
                        <a href="{{ asset('storage/' . $tutorial->file_path) }}" class="text-green-600 mt-2 inline-block"
                            download>Download File</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
