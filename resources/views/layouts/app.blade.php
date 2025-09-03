<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>manajemen gudang</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-emerald-600 text-black p-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 200 200">
                <!-- Lingkaran -->
                <circle cx="100" cy="100" r="95" fill="#8b98b5ff" stroke="#2c375aff" stroke-width="6" />
                <!-- Teks MG -->
                <text x="50%" y="55%" text-anchor="middle" font-family="Arial, sans-serif" font-size="72" fill="white"
                    font-weight="bold">
                    MG
                </text>
            </svg>

            <h2 class="text-xl font-bold mb-6">manajemen gudang</h2>
       <ul class="space-y-3">
    <!-- Dashboard selalu muncul -->
    <li>
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-500">
            Dashboard
        </a>
    </li>

    @php
    // Daftar menu per role
    $menus = [
        'admin' => [
            ['name'=>'Products', 'route'=>'backend.admin.products.index'],
            ['name'=>'Transactions', 'route'=>'backend.admin.transactions.index'],
            ['name'=>'Suppliers', 'route'=>'backend.admin.suppliers.index'],
            ['name'=>'Customers', 'route'=>'backend.admin.customers.index'],
            ['name'=>'Reports', 'route'=>'backend.admin.reports.index'],
            ['name'=>'User Management', 'route'=>'backend.admin.users.index'],
            ['name'=>'setting','route'=> 'backend.admin.settings.index'],
        ],
        'manager' => [
            ['name'=>'Products', 'route'=>'backend.manager.products.index'],
            ['name'=>'Transactions', 'route'=>'backend.manager.transactions.index'],
            ['name'=>'Suppliers', 'route'=>'backend.manager.suppliers.index'],
            ['name'=>'Customers', 'route'=>'backend.manager.customers.index'],
            ['name'=>'Reports', 'route'=>'backend.manager.reports.index'],
        ],
        'supplier' => [
            ['name'=>'Products', 'route'=>'backend.supplier.products.index'],
            ['name'=>'Transactions', 'route'=>'backend.supplier.transactions.index'],
        ],
        'operator' => [
            ['name'=>'Products', 'route'=>'backend.operator.products.index'],
            ['name'=>'Transactions', 'route'=>'backend.operator.transactions.index'],
        ],
        'viewer' => [
            ['name'=>'Reports', 'route'=>'backend.viewer.reports.index'],
        ],
    ];

    // Ambil role user dan ubah ke lowercase untuk keamanan
    $role = strtolower(Auth::user()->role ?? '');
    @endphp

    <!-- Loop menu sesuai role -->
    @foreach($menus[$role] ?? [] as $menu)
        <li>
            <a href="{{ route($menu['route']) }}" class="block px-3 py-2 rounded hover:bg-gray-500">
                {{ $menu['name'] }}
            </a>
        </li>
    @endforeach

    <!-- Logout selalu muncul -->
    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 rounded hover:bg-slate-700">
                Log out
            </button>
        </form>
    </li>
</ul>


        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>

<footer class="bg-gray-100 border-t border-gray-300">
    <p class="text-center p-4 text-sm text-black-700">
        &copy; 2025 Manajemen Gudang ~ by. Ositech
    </p>
</footer>


</html>
