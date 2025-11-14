@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">{{ $tutorial->title }}</h1>
        <p class="mb-4">{{ $tutorial->description }}</p>

        @if ($tutorial->video_path)
            <video controls class="w-full mb-4">
                <source src="{{ asset('storage/' . $tutorial->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endif

        @if ($tutorial->file_path)
            <a href="{{ asset('storage/' . $tutorial->file_path) }}" class="bg-green-600 text-white px-4 py-2 rounded"
                download>Download File</a>
        @endif
    </div>
@endsection
