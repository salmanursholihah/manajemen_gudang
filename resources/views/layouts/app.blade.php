<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>Manajemen Gudang</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
    @media (max-width: 640px) {

        /* Mobile Table Responsive */
        table thead {
            display: none;
        }

        table,
        table tbody,
        table tr,
        table td {
            display: block;
            width: 100%;
        }

        table tr {
            margin-bottom: 1rem;
            border: 1px solid #e5e7eb;
            /* gray-200 */
            border-radius: 0.5rem;
            padding: 0.5rem;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
            border: none !important;
            border-bottom: 1px solid #f3f4f6;
        }

        table td:last-child {
            border-bottom: none;
        }

        table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 0.75rem;
            font-weight: 600;
            text-align: left;
            color: #374151;
            /* gray-700 */
        }
    }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col" x-data="{ sidebarOpen: false }">

    <!-- Navbar (Mobile Header) -->
    <header class="bg-emerald-600 text-white flex items-center justify-between px-4 py-3 md:hidden">
        <div class="flex items-center space-x-2">
            @php
            $logo = setting('app_logo'); // ambil dari DB
            @endphp

            <img src="{{ $logo ? asset('storage/' . $logo) : asset('images/default-logo.png') }}" alt="Logo"
                class="h-10 w-10 rounded-full">

            <span class="font-bold">{{ setting('app_name', 'Manajemen Gudang') }}</span>
        </div>

        <button @click="sidebarOpen = !sidebarOpen">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </header>

    <!-- Wrapper Sidebar + Content -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 w-64 bg-emerald-600 text-white p-4 h-full transform transition-transform duration-300 z-50
            md:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <!-- Close button (mobile only) -->
            <div class="flex justify-end md:hidden">
                <button @click="sidebarOpen = false" class="text-white text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Logo -->
            <div class="flex items-center space-x-2 mb-6 mt-2">
                <img src="{{ asset('storage/' . setting('app_logo', 'default-logo.png')) }}" alt="Logo"
                    class="h-20 w-20 rounded-full hidden md:block">
                <h2 class="text-xl font-bold hidden md:block">{{ setting('app_name', 'Manajemen Gudang') }}</h2>
            </div>

            <!-- Menu -->
            <ul class="space-y-2 mt-4">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-500 font-bold text-xl">
                    Dashboard
                </a>

                @php
                $menus = [
                'admin' => [
                ['icon'=>'fa-box', 'name'=>'Products', 'route'=>'backend.admin.products.index'],
                ['icon'=>'fa-exchange-alt', 'name'=>'Transactions', 'route'=>'backend.admin.transactions.index'],
                ['icon'=>'fa-truck', 'name'=>'Suppliers', 'route'=>'backend.admin.suppliers.index'],
                ['icon'=>'fa-users', 'name'=>'Customers', 'route'=>'backend.admin.customers.index'],
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'reports.index'],
                ['icon'=>'fa-user-cog', 'name'=>'User Management', 'route'=>'backend.admin.users.index'],
                ['icon'=>'fa-cog', 'name'=>'Setting', 'route'=>'backend.admin.settings.index'],
                ['icon'=>'fa-cog', 'name'=>'setting Landing', 'route'=>'backend.admin.landings.index'],
                ['icon'=>'fa-address-card', 'name'=>'Profile', 'route'=>'profile.edit'],
                ],
                'manager' => [
                ['icon'=>'fa-box', 'name'=>'Products', 'route'=>'backend.manager.products.index'],
                ['icon'=>'fa-exchange-alt', 'name'=>'Transactions', 'route'=>'backend.manager.transactions.index'],
                ['icon'=>'fa-truck', 'name'=>'Suppliers', 'route'=>'backend.manager.suppliers.index'],
                ['icon'=>'fa-users', 'name'=>'Customers', 'route'=>'backend.manager.customers.index'],
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'reports.index'],
                ['icon'=>'fa-address-card', 'name'=>'Profile', 'route'=>'profile.edit'],
                ],
                'supplier' => [
                ['icon'=>'fa-box', 'name'=>'Products', 'route'=>'backend.supplier.products.index'],
                ['icon'=>'fa-exchange-alt', 'name'=>'Transactions', 'route'=>'backend.supplier.transactions.index'],
                ['icon'=>'fa-address-card', 'name'=>'Profile', 'route'=>'profile.edit'],
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'reports.index'],
                ],
                'operator' => [
                ['icon'=>'fa-box', 'name'=>'Products', 'route'=>'backend.operator.products.index'],
                ['icon'=>'fa-exchange-alt', 'name'=>'Transactions', 'route'=>'backend.operator.transactions.index'],
                ['icon'=>'fa-address-card', 'name'=>'Profile', 'route'=>'profile.edit'],
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'reports.index'],
                ],
                'viewer' => [
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'backend.viewer.reports.index'],
                ['icon'=>'fa-address-card', 'name'=>'Profile', 'route'=>'profile.edit'],
                ],
                ];
                $role = strtolower(Auth::user()->role ?? '');
                @endphp

                @foreach($menus[$role] ?? [] as $menu)
                <li>
                    <a href="{{ route($menu['route']) }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded hover:bg-emerald-700 transition">
                        <i class="fas {{ $menu['icon'] }} w-5"></i>
                        <span>{{ $menu['name'] }}</span>
                    </a>
                </li>
                @endforeach

                <!-- Logout -->
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-3 w-full text-left px-3 py-2 rounded hover:bg-red-700 transition">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Log out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <!-- Tambahkan overflow-x-auto agar tabel responsive tanpa mengubah content -->
        <main class="flex-1 p-6 md:ml-64 overflow-x-auto">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-300 border-t border-gray-300">
        <p class="text-center p-4 text-sm text-black-700">
            &copy; 2025 MaGood ~ by. Ositech
        </p>
    </footer>
</body>

</html>