<div x-show="mobileNav" @click.away="mobileNav=false" x-transition class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40">
    <div class="bg-white w-64 p-6 h-full">
    <button @click="mobileNav=false" class="mb-4 px-3 py-2 bg-gray-200 rounded">Close</button>
    <nav class="space-y-2">
        <a href="#" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>
        <a href="#" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Users</a>
        <a href="#" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Reports</a>
        <a href="#" @click="mobileNav=false" class="block px-4 py-2 rounded hover:bg-gray-200">Settings</a>
    </nav>
    </div>
</div>