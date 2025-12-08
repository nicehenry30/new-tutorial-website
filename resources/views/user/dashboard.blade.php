<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Dashboard</title>

  <!-- Alertify CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 min-h-screen"
      x-data="{ sidebarOpen: false, page: 'home', editProfileOpen: false }">

      @if (session('success'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      alertify.set('notifier','position', 'top-right');
      alertify.success('{{ session('success') }}');
    });
    </script>

    @elseif (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        alertify.set('notifier','position', 'top-right');
        alertify.error('{{ session('error') }}');
        });
    </script>

    @endif

  <!-- Mobile Navbar -->
  <header class="md:hidden bg-white shadow px-4 py-3 flex items-center justify-between">
    <h1 class="text-xl font-bold">Dashboard <a class="text-sm text-blue-700 font-light" href="{{ route('user.index') }}">Back to front</a></h1>

    <button @click="sidebarOpen = true" class="text-gray-700 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </header>

  <!-- Sidebar -->
  <aside
    class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg p-6 transform transition-transform duration-300 z-50
           md:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    x-transition>

    <h2 class="text-2xl font-bold mb-8 text-gray-700 hidden md:block">Dashboard</h2>

    <nav class="space-y-4">
      <button @click="page='home'; sidebarOpen=false"
        class="w-full text-left px-4 py-2 rounded-lg"
        :class="page==='home' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200'">Home</button>

      <button @click="page='products'; sidebarOpen=false"
        class="w-full text-left px-4 py-2 rounded-lg"
        :class="page==='products' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200'">Subscriptions</button>

      <button @click="page='orders'; sidebarOpen=false"
        class="w-full text-left px-4 py-2 rounded-lg"
        :class="page==='orders' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200'">Orders</button>

      <button @click="page='profile'; sidebarOpen=false"
        class="w-full text-left px-4 py-2 rounded-lg"
        :class="page==='profile' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200'">Profile</button>

      <hr class="my-4">

      <form onsubmit="return confirm('Are you sure to logout?')" method="POST" action="{{ route('logout') }}">
      @csrf

      <button class="w-full text-left px-4 py-2 rounded-lg bg-red-500 text-white" type="submit" id="logoutBtn">Logout</button>
      </form>
    </nav>
  </aside>

  <!-- Overlay -->
  <div x-show="sidebarOpen"
       @click="sidebarOpen=false"
       x-transition.opacity
       class="fixed inset-0 bg-black bg-opacity-40 md:hidden z-40">
  </div>

  <!-- Main Content -->
  <main class="md:ml-64 p-8">

    <!-- HOME -->
    <section x-show="page==='home'" x-transition>
      <h1 class="text-3xl font-bold text-gray-700 mb-4">Welcome Back!</h1>
      <p class="text-gray-600 mb-4">This is your dashboard home page.</p>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-6">
        <div class="bg-white p-6 rounded-xl shadow">
          <h3 class="text-xl font-semibold text-gray-700">Today's Visits</h3>
          <p class="text-4xl font-bold mt-3">112 <span class="text-xl">times</span></p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
          <h3 class="text-xl font-semibold text-gray-700">Orders</h3>
          <p class="text-4xl font-bold mt-3">27 <span class="text-xl">Successful</span></p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
          <h3 class="text-xl font-semibold text-gray-700"> Subscriptions</h3>
          <p class="text-4xl font-bold mt-3">5 <span class="text-xl">Active</span></p>
        </div>
      </div>
    </section>

    <!-- PRODUCTS -->
    <section x-show="page==='products'" x-transition>
      <h1 class="text-3xl font-bold text-gray-700 mb-6">Available Subscriptions</h1>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <template x-for="i in 3">
          <div class="bg-white p-5 rounded-xl shadow">
            <img src="https://via.placeholder.com/300x200" class="rounded-lg mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Product Name</h3>
            <p class="text-gray-600 text-sm my-2">Short product description goes here.</p>
            <p class="text-lg font-bold mb-3">$45</p>
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Buy</button>
          </div>
        </template>
      </div>
    </section>

    <!-- ORDERS -->
    <section x-show="page==='orders'" x-transition>
      <h1 class="text-3xl font-bold text-gray-700 mb-6">Your Orders</h1>

      <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-3 text-left text-gray-600">Order ID</th>
              <th class="p-3 text-left text-gray-600">Product</th>
              <th class="p-3 text-left text-gray-600">Amount</th>
              <th class="p-3 text-left text-gray-600">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b">
              <td class="p-3">#1001</td>
              <td class="p-3">Wireless Headphones</td>
              <td class="p-3">$45</td>
              <td class="p-3"><span class="px-3 py-1 bg-green-100 text-green-600 rounded">Completed</span></td>
            </tr>
            <tr class="border-b">
              <td class="p-3">#1002</td>
              <td class="p-3">Smart Watch</td>
              <td class="p-3">$80</td>
              <td class="p-3"><span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded">Pending</span></td>
            </tr>
            <tr>
              <td class="p-3">#1003</td>
              <td class="p-3">Bluetooth Speaker</td>
              <td class="p-3">$32</td>
              <td class="p-3"><span class="px-3 py-1 bg-red-100 text-red-600 rounded">Cancelled</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- PROFILE -->
    <section x-show="page==='profile'" x-transition>
      <h1 class="text-3xl font-bold text-gray-700 mb-4">Your Profile</h1>

      <div class="bg-white p-8 rounded-xl shadow max-w-lg">
        <div class="flex items-center gap-4 mb-6">
          <div>
            <h3 class="text-xl font-semibold text-gray-700">{{ auth()->user()->name }}</h3>
            <p class="text-gray-500 text-sm">Premium User</p>
          </div>
        </div>

        <p class="text-gray-600 mb-2"><strong>Email:</strong> {{ auth()->user()->email }} </p>
        <p class="text-gray-600 mb-2"><strong>Phone:</strong> {{ auth()->user()->phone ?? 'N/A' }}</p>
        <p class="text-gray-600 mb-2"><strong>Member Since:</strong> {{ auth()->user()->created_at->format('Y-m-d') }} </p>

        <button @click="editProfileOpen = true"
                class="mt-6 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
          Edit Profile
        </button>
      </div>
    </section>

  </main>

  <!-- EDIT PROFILE MODAL -->
  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div x-show="editProfileOpen"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center px-4"
        style="display: none;">

        <div class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg"
            x-transition.scale>

        <h2 class="text-2xl font-bold text-gray-700 mb-4">Edit Profile</h2>

        <div class="space-y-4">
            <div>
            <label class="text-gray-600">Full Name</label>
            <input type="text" name="name" class="w-full mt-1 px-3 py-2 border rounded-lg" value="{{ auth()->user()->name }}" placeholder="John Doe">
            </div>

            <div>
            <label class="text-gray-600">Email</label>
            <input type="email" name="email" class="w-full mt-1 px-3 py-2 border rounded-lg" value="{{ auth()->user()->email }}"  placeholder="johndoe@example.com">
            </div>

            <div>
            <label class="text-gray-600">Phone</label>
            <input type="text" name="phone" class="w-full mt-1 px-3 py-2 border rounded-lg" value="{{ auth()->user()->phone }}"  placeholder="+234 800 000 0000">
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <button @click="editProfileOpen = false"
                    class="px-4 py-2 rounded-lg border">
            Cancel
            </button>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Save
            </button>
        </div>

        </div>
    </div>
</form>

<!-- Alertify JavaScript -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

</body>
</html>
