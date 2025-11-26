<div x-show="mobileNav" @click.away="mobileNav=false" x-transition class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40">
    <div class="bg-white w-64 p-6 h-full">
    <button @click="mobileNav=false" class="mb-4 px-3 py-2 bg-gray-200 rounded">Close</button>
    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>
        <a href="{{ route('admin.users') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Users</a>
        <a href="{{ route('admin.products') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Products</a>
        <a href="{{ route('admin.subscriptions') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Subscriptions</a>
        <a href="{{ route('admin.tickets') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Tickets</a>
        <a href="{{ route('admin.profile') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Profile</a>
        <a href="{{ route('admin.settings') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Settings</a>
        <a href="{{ route('admin.logout') }}" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Logout</a>
    </nav>
    </div>
</div>