@extends('layouts.master')

@section('content')

  <!-- Sidebar + Main Container -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <x-admin.sidebar />

    <!-- Mobile Nav Icon -->
    <div class="md:hidden fixed top-4 left-4 z-50">
      <button 
          x-show="!mobileNav"
          @click="mobileNav = true"
          class="text-2xl bg-white p-2 rounded shadow"
      >
          ☰
      </button>
    </div>

    <!-- Mobile Nav Links -->
    <x-admin.nav-links />

    <!-- Main Content -->
    <main class="flex-1 p-6">

      <!-- Top Bar -->
      <header class="flex justify-between items-center mb-6 pt-16 md:pt-0">
        <h1 class="text-2xl font-semibold">Product Overview</h1>
        <div class="flex items-center space-x-4">
          <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
          </div>
        </div>
      </header>

      {{-- Add Course Form --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Add New Course</h2>

            {{-- Go Back Button --}}
            <a href="{{ route('admin.products') }}" class="inline-block mb-4 text-blue-600 hover:underline">← Back to Products</a>

            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-300 mb-2">Course Title</label>
                <input type="text" name="title" id="title" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 dark:text-gray-300 mb-2">Small Description</label>
                <textarea name="small_description" id="description" rows="4" class="w-full" required></textarea>
                @error('small_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 dark:text-gray-300 mb-2">Price ({{ $settings->currency }})</label>
                <input type="number" name="price" id="price" step="0.01" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 dark:text-gray-300 mb-2">Course Image</label>
                <input type="file" name="image" id="image" class="w-full">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Course</button>
            </form>

    </main>

  </div>

  @endsection
