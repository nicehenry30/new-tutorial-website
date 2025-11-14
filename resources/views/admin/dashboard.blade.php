@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard - Upload Tutorial</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.tutorial.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block font-semibold">Title</label>
                <input type="text" name="title" id="title" class="border p-2 w-full" required>
            </div>

            <div>
                <label for="description" class="block font-semibold">Description</label>
                <textarea name="description" id="description" class="border p-2 w-full"></textarea>
            </div>

            <div>
                <label for="video" class="block font-semibold">Video (mp4/avi/mov)</label>
                <input type="file" name="video" id="video" accept="video/*" class="border p-2 w-full">
            </div>

            <div>
                <label for="file" class="block font-semibold">File (pdf/zip/docx)</label>
                <input type="file" name="file" id="file" accept=".pdf,.zip,.docx" class="border p-2 w-full">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload Tutorial</button>
        </form>
    </div>
@endsection
