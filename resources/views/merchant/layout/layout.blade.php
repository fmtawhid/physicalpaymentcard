<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayGate Pro - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fdf2f2',
                            100: '#fde8e8',
                            200: '#fbd5d5',
                            300: '#f8b4b4',
                            400: '#f98080',
                            500: '#f05252',
                            600: '#e02424',
                            700: '#87191a', // Your primary color
                            800: '#771515',
                            900: '#611111',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: "Roboto", sans-serif;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100vh;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Mobile menu button -->
        <div class="md:hidden fixed top-4 left-4 z-50">
            <button id="menuToggle" class="p-2 rounded-md bg-primary-700 text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Overlay for mobile -->
        <div id="overlay" class="overlay"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-white w-64 flex flex-col border-r border-gray-200">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold flex items-center text-primary-700">
                    <i class="fas fa-credit-card mr-2"></i>
                    Task Club
                </h1>
                <p class="text-xs text-gray-500 mt-1">Merchant Dashboard</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('merchant.index') }}"
                            class="flex items-center p-3 rounded-lg {{ request()->routeIs('merchant.index') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('merchant.projects.index') }}"
                            class="flex items-center p-3 rounded-lg {{ request()->routeIs('merchant.projects.index') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            <i class="fas fa-list mr-3"></i>
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('merchant.projects.my') }}"
                            class="flex items-center p-3 rounded-lg {{ request()->routeIs('merchant.projects.my') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            <i class="fas fa-check-circle mr-3"></i>
                            My Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('merchant.settings.edit') }}"
                            class="flex items-center p-3 rounded-lg {{ request()->routeIs('merchant.setting.edit') ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Setting
                        </a>
                    </li>
                    
                    </li>
                </ul>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-700">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->role == 'admin' ? 'Administrator' : ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-0">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Dashboard Overview</h2>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notification with Dropdown -->
                        <div class="relative hidden md:block">
                            <button id="notificationBtn" class="relative focus:outline-none">
                                <i class="fas fa-bell text-gray-500"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-primary-700 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">3</span>
                            </button>
                            <!-- Notification Dropdown -->
                            <div id="notificationDropdown"
                                class="hidden absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                                <ul>
                                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Notification 1</li>
                                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Notification 2</li>
                                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Notification 3</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Search..."
                                class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                        </div>

                        <!-- Admin Dropdown -->
                        <div class="relative">
                            <button id="adminBtn" class="flex items-center space-x-2 focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-700">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="text-sm font-medium hidden md:inline">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-500 text-sm hidden md:inline"></i>
                            </button>
                            <!-- Admin Dropdown Menu -->
                            <div id="adminDropdown"
                                class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                                <ul>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Hidden logout form for Laravel -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>

                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            @yield('content')
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').classList.toggle('active');
        });

        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        });

        // Close sidebar when clicking on a menu item on mobile
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    document.getElementById('sidebar').classList.remove('active');
                    document.getElementById('overlay').classList.remove('active');
                }
            });
        });
    </script>
    <script>
        const adminBtn = document.getElementById('adminBtn');
        const adminDropdown = document.getElementById('adminDropdown');
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');

        adminBtn.addEventListener('click', () => {
            adminDropdown.classList.toggle('hidden');
            notificationDropdown.classList.add('hidden'); // close notification
        });

        notificationBtn.addEventListener('click', () => {
            notificationDropdown.classList.toggle('hidden');
            adminDropdown.classList.add('hidden'); // close admin
        });

        // Close dropdowns when clicking outside
        window.addEventListener('click', (e) => {
            if (!adminBtn.contains(e.target) && !adminDropdown.contains(e.target)) {
                adminDropdown.classList.add('hidden');
            }
            if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>