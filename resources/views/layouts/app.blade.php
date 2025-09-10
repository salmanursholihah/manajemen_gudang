<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>manajemen gudang</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Wrapper Sidebar + Content -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 w-64 bg-emerald-600 text-white p-4 h-full transform transition-transform duration-300 z-50
           md:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            @php
            use App\Models\Setting;

            $logoSetting = Setting::where('key','app_logo')->first();
            $appLogo = $logoSetting ? asset('storage/'.$logoSetting->value) : asset('default-logo.png');
            @endphp

            <!-- Logo -->
            <div class="flex items-center space-x-2 mb-6">
                <img src="{{ asset('storage/' . setting('app_logo', 'default-logo.png')) }}" alt="Logo"
                    class="h-20 w-20 rounded-full">
                <h2 class="text-xl font-bold">{{ setting('app_name', 'Manajemen Gudang') }}</h2>
            </div>



            <ul class="space-y-2">
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
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'backend.admin.reports.index'],
                ['icon'=>'fa-user-cog', 'name'=>'User Management', 'route'=>'backend.admin.users.index'],
                ['icon'=>'fa-cog', 'name'=>'Setting', 'route'=>'backend.admin.settings.index'],
                ['icon'=>'fa-cog', 'name'=>'landing', 'route'=>'backend.admin.landings.index'],
                ['icon'=>'fa-address-card', 'name'=>'profile', 'route'=>'profile.edit'],
                ],

                'manager' => [
                ['icon'=>'fa-box', 'name'=>'Products', 'route'=>'backend.manager.products.index'],
                ['icon'=>'fa-exchange-alt', 'name'=>'Transactions', 'route'=>'backend.manager.transactions.index'],
                ['icon'=>'fa-truck', 'name'=>'Suppliers', 'route'=>'backend.manager.suppliers.index'],
                ['icon'=>'fa-users', 'name'=>'Customers', 'route'=>'backend.manager.customers.index'],
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'backend.manager.reports.index'],
                ['icon'=>'fa-address-card', 'name'=>'profile', 'route'=>'profile.edit'],

                ],
                'supplier' => [
                ['icon'=>'fa-box', 'name'=>'Products', 'route'=>'backend.supplier.products.index'],
                ['icon'=>'fa-exchange-alt', 'name'=>'Transactions', 'route'=>'backend.supplier.transactions.index'],
                ['icon'=>'fa-address-card', 'name'=>'profile', 'route'=>'profile.edit'],
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'backend.supplier.reports.index'],

                ],

                'operator' => [
                ['icon'=>'fa-box', 'name'=>'Products', 'route'=>'backend.operator.products.index'],
                ['icon'=>'fa-exchange-alt', 'name'=>'Transactions', 'route'=>'backend.operator.transactions.index'],
                ['icon'=>'fa-address-card', 'name'=>'profile', 'route'=>'profile.edit'],
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'backend.operator.reports.index'],
                ],

                'viewer' => [
                ['icon'=>'fa-chart-bar', 'name'=>'Reports', 'route'=>'backend.viewer.reports.index'],
                ['icon'=>'fa-address-card', 'name'=>'profile', 'route'=>'profile.edit'],
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


        <!-- Main Content (beri margin kiri biar tidak ketutup sidebar) -->
        <main class="flex-1 p-6 ml-64">
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