<!DOCTYPE html>
<html lang="en" x-data="dashboard()">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <!-- Alertify CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>

  <style>
    [x-cloak] { display: none !important; }
  </style>
</head>
<body class="bg-gray-100">

  @if (session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        alertify.set('notifier','position', 'top-right');
        alertify.success('{{ session('success') }}');
      });
    </script>
  @endif

    <!-- Page Content -->
        <main>
            @yield('content')
        </main>


    <script>
    function dashboard(){
      return { mobileNav: false };
    }
  </script>

  <!-- Alertify JS -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

</body>
</html>