<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="text-2xl font-bold text-indigo-600">{{ $settings->title }}</div>
        {{-- <div class="hidden md:flex items-center text-sm text-gray-600">Signals · Courses · Dashboard</div> --}}
      </div>

      <nav class="hidden md:flex space-x-4 items-center">
        <a href="#hero" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Home</a>
        <a href="#signals" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Signals</a>
        <a href="#courses" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Courses</a>
        <a href="#bots" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Bots</a>
        <a href="#dashboard" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Dashboard</a>
      </nav>

      <div class="flex items-center gap-3">
        <button @click="openSignin()" class="hidden md:inline-block px-4 py-2 bg-white-600 text-black rounded-lg">Log in</button>
        <button @click="openSignup()" class="hidden md:inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg">Register</button>
        <button class="md:hidden text-2xl" @click="mobileNav = !mobileNav">☰</button>
      </div>
    </div>
 
    <!-- Mobile nav -->
    <div x-show="mobileNav" @click.away="mobileNav=false" x-transition class="md:hidden bg-white border-t">
      <div class="px-4 py-3 flex flex-col">
        <a href="#hero" @click="mobileNav=false; navAnimate($event)" class="py-2">Home</a>
        <a href="#signals" @click="mobileNav=false; navAnimate($event)" class="py-2">Signals</a>
        <a href="#courses" @click="mobileNav=false; navAnimate($event)" class="py-2">Courses</a>
        <a href="#bots" @click="mobileNav=false; navAnimate($event)" class="py-2">Bots</a>
        <a href="#dashboard" @click="mobileNav=false; navAnimate($event)" class="py-2">Dashboard</a>
        <button @click="mobileNav=false; openSignin()" class="mt-2 px-4 py-2 bg-white-600 text-black rounded">Log in</button>
        <button @click="mobileNav=false; openSignup()" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded">Get started</button>
      </div>
    </div>
  </header>