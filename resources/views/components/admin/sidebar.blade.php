<aside class="w-64 bg-white border-r shadow-sm hidden md:block">
    <div class="p-6 text-xl font-bold">Admin Panel</div>
    <nav class="px-4 space-y-2">
        <a class="block px-4 py-2 rounded hover:bg-gray-200" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="block px-4 py-2 rounded hover:bg-gray-200" href="{{ route('admin.users') }}">Users</a>
        <a class="block px-4 py-2 rounded hover:bg-gray-200" href="{{ route('admin.products') }}">Products</a>
        <a class="block px-4 py-2 rounded hover:bg-gray-200" href="{{ route('admin.subscriptions') }}">Subscriptions</a>
        <a class="block px-4 py-2 rounded hover:bg-gray-200" href="{{ route('admin.tickets') }}">Tickets</a>
        <a class="block px-4 py-2 rounded hover:bg-gray-200" href="{{ route('admin.settings')  }}">Settings</a>
        <a class="block px-4 py-2 rounded hover:bg-gray-200" href="{{ route('admin.tickets') }}">Logout</a>
    </nav>
</aside>