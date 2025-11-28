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
        <h1 class="text-2xl font-semibold">Settings Overview</h1>
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

        <!-- Settings Content -->
        <div>
            <p>Manage your application settings here.</p>
            
            
            <form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 space-y-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                    <input type="text" name="title" id="site_name" value="{{ old('title', $settings->title) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
    
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" name="logo" id="logo" value="{{ old('admin_email', $settings->admin_email) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    
                    <label for="old_logo" class="block text-sm font-medium text-gray-700">Old Logo</label>
                    <img src="{{ asset('settings/' . $settings->logo) }}" alt="Current Logo" class="h-16 w-auto mt-1">                    
                </div>

                <div>
                    <label for="favicon" class="block text-sm font-medium text-gray-700">Favicon</label>
                    <input type="file" name="favicon" id="favicon" value="{{ old('admin_email', $settings->admin_email) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    
                    <label for="old_favicon" class="block text-sm font-medium text-gray-700 mt-4">Old Favicon</label>
                    <img src="{{ asset('settings/' . $settings->favicon) }}" alt="Current Favicon" class="h-16 w-auto mt-1">
                </div>

                <div>
                    <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                    <select name="currency" id="currency" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="">--select--</option>
                        <option value="USD" {{ $settings->currency == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="NGN" {{ $settings->currency == 'NGN' ? 'selected' : '' }}>NGN</option>
                        <option value="EUR" {{ $settings->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                        <option value="GBP" {{ $settings->currency == 'GBP' ? 'selected' : '' }}>GBP</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Settings</button>
                </div>

        </div>


    </main>

  </div>

  @endsection
