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
        <h1 class="text-2xl font-semibold">Products Overview</h1>
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

     <div x-data="{ tab: 'signals' }" class="w-full">

  <!-- Tabs Row -->
  <div class="flex items-center gap-4 border-b mb-6">
    <button
      @click="tab = 'signals'"
      :class="tab === 'signals' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-600'"
      class="pb-2 font-semibold px-2"
      aria-controls="signals-panel"
      :aria-selected="tab === 'signals'"
      role="tab"
    >
      Signals
    </button>

    <button
      @click="tab = 'courses'"
      :class="tab === 'courses' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-600'"
      class="pb-2 font-semibold px-2"
      aria-controls="courses-panel"
      :aria-selected="tab === 'courses'"
      role="tab"
    >
      Courses
    </button>

    <button
      @click="tab = 'bots'"
      :class="tab === 'bots' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-600'"
      class="pb-2 font-semibold px-2"
      aria-controls="bots-panel"
      :aria-selected="tab === 'bots'"
      role="tab"
    >
      Bots
    </button>
  </div>

  <!-- COURSES PANEL -->
  <div
    id="courses-panel"
    x-show="tab === 'courses'"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
  >
    <div class="bg-white shadow rounded p-6">
      <div class="text-lg font-semibold mb-4 flex justify-between items-center">
        <span>All Courses</span>
        <a href="{{ route('admin.courses.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Course</a>
      </div>
      <table class="w-full text-left">
        <thead>
          <tr class="border-b">
            <th class="py-2">Image</th>
            <th class="py-2">Title</th>
            <th class="py-2">Description</th>
            <th class="py-2">URL</th>
            <th class="py-2">Price</th>
            <th class="py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($courses as $course)
              <tr class="border-b">
                <td class="py-2">
                  @if($course->image_path)
                    <img src="{{asset('images/'.$course->image_path) }}" alt="{{ $course->title }}" class="h-16 w-16 object-cover rounded">
                  @else
                    N/A
                  @endif
                </td>
                <td class="py-2">{{ $course->title }}</td>
                <td class="py-2">{{ $course->description }}</td>
                <td class="py-2"><a href="{{ $course->url }}" class="text-blue-500 underline" target="_blank">Link</a></td>
                <td class="py-2">${{ $course->price }}</td>
                <td class="py-2">
                  <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-indigo-600 hover:underline mr-4">Edit</a>
                  <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this course?');">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-4 text-center text-gray-500">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- SIGNALS PANEL -->
  <div
    id="signals-panel"
    x-show="tab === 'signals'"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="mt-4"
  >
    <div class="bg-white shadow rounded p-6">
      <div class="text-lg font-semibold mb-4 flex justify-between items-center">
        <span>All Signals</span>
        <a href="{{ route('admin.signals.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Signal</a>
      </div>
      <table class="w-full text-left">
        <thead>
          <tr class="border-b">
            <th class="py-2">Title</th>
            <th class="py-2">Description</th>
            <th class="py-2">TP</th>
            <th class="py-2">SL</th>
            <th class="py-2">Monthly Price</th>
            <th class="py-2">Yearly Price</th>
            <th class="py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($signals as $signal)
              <tr>
                <td class="py-2">{{ $signal->title }}</td>
                <td class="py-2">{{ $signal->description }}</td>
                <td class="py-2">{{ $signal->TP }}</td>
                <td class="py-2">{{ $signal->SL }}</td>
                <td class="py-2">{{ $settings->currency.''. $signal->monthly_price }}</td>
                <td class="py-2">{{ $settings->currency.''.$signal->yearly_price }}</td>
                <td class="py-2">
                  <a href="{{ route('admin.signals.edit', $signal->id) }}" class="text-indigo-600 hover:underline mr-4">Edit</a>
                  <form action="{{ route('admin.signals.delete', $signal->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this signal?');">Delete</button>
                  </form>
                </td>
              </tr>
          @empty
                <tr>
                    <td colspan="7" class="py-4 text-center text-gray-500">No signals found.</td>
                </tr>   
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bots PANEL -->
  <div
    id="bots-panel"
    x-show="tab === 'bots'"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="mt-4"
  >
    <div class="bg-white shadow rounded p-6">
      <div class="text-lg font-semibold mb-4 flex justify-between items-center">
        <span>All Bots</span>
        <a href="{{ route('admin.bots.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Bot</a>
      </div>
      <table class="w-full text-left">
        <thead>
          <tr class="border-b">
            <th class="py-2">Title</th>
            <th class="py-2">Description</th>
            <th class="py-2">Monthly Price</th>
            <th class="py-2">Yearly Price</th>
            <th class="py-2">Demo Link</th>
            <th class="py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($bots as $bot)
              <tr class="border-b">
                <td class="py-2">{{ $bot->title }}</td>
                <td class="py-2">{{ $bot->description }}</td>
                <td class="py-2">${{ $bot->monthly_price }}</td>
                <td class="py-2">${{ $bot->yearly_price }}</td>
                <td class="py-2"><a href="{{ $bot->demo_link }}" class="text-blue-500 underline" target="_blank">Demo</a></td>
                <td class="py-2">
                  <a href="{{ route('admin.bots.edit', $bot->id) }}" class="text-indigo-600 hover:underline mr-4">Edit</a>
                  <form action="{{ route('admin.bots.delete', $bot->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this bot?');">Delete</button>
                  </form>
                </td>
              </tr>
          @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">No bots found.</td>
                </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

    </main>

  </div>

@endsection
