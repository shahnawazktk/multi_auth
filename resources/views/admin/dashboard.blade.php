<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, userMenuOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        .sidebar-icon-active {
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Backdrop for Mobile -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:leave="transition-opacity ease-linear duration-300"
         class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden">
    </div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-gray-300 transition-all duration-300 transform lg:translate-x-0 lg:static lg:inset-0 shadow-xl">
        
        <!-- Logo -->
        <div class="flex items-center justify-between p-6 border-b border-slate-800">
            <div class="text-white text-xl font-bold">
                <span class="text-blue-500">AD</span>MIN
            </div>
        </div>
        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="#" class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg transition-colors hover:bg-blue-700">
                <i class="fas fa-chart-line w-5 mr-3"></i>
                Dashboard
            </a>
            
            <a href="#" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-all group">
                <i class="fas fa-users w-5 mr-3 text-gray-400 group-hover:text-white"></i>
                Users
            </a>
            <a href="#" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-all group">
                <i class="fas fa-chart-bar w-5 mr-3 text-gray-400 group-hover:text-white"></i>
                Analytics
            </a>

            <a href="#" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-all group">
                <i class="fas fa-file-alt w-5 mr-3 text-gray-400 group-hover:text-white"></i>
                Reports
            </a>
        
        <a href="#" @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-cog w-5 text-center"></i>
                <span>Settings</span>
            </a>
        <!-- Bottom Help Section -->
        
            <a href="#" class="flex items-center px-4 py-3 hover:bg-slate-800 hover:text-white rounded-lg transition-all group">
                <i class="fas fa-question-circle w-5 mr-3 text-gray-400 group-hover:text-white"></i>
                Help & Support
            </a>
            </nav>
            <!-- Logout Button -->
        <div class="absolute bottom-0 w-full p-6 border-t border-gray-100 dark:border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center space-x-2 px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
        
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Header -->
        <header class="h-20 bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between px-6 lg:px-8 shadow-sm">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-800 focus:outline-none transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                
            </div>

            <!-- Header Actions -->
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <div class="hidden md:block relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent w-64">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400 text-sm"></i>
                </div>
                
                <!-- Notifications -->
                <button class="relative p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full notification-dot"></span>
                </button>
                
                <!-- User Profile -->
                <!-- User Menu Dropdown -->
                <div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none hover:opacity-80 transition-opacity">
        <!-- Avatar with Profile Picture or Initials -->
        @auth
            @if(Auth::user()->profile_photo_path)
                <img class="w-9 h-9 rounded-full object-cover border-2 border-white dark:border-gray-800 shadow-sm" 
                     src="{{ Storage::url(Auth::user()->profile_photo_path) }}" 
                     alt="{{ Auth::user()->name }}">
            @elseif(Auth::user()->avatar_url)
                <img class="w-9 h-9 rounded-full object-cover border-2 border-white dark:border-gray-800 shadow-sm" 
                     src="{{ Auth::user()->avatar_url }}" 
                     alt="{{ Auth::user()->name }}">
            @else
                @php
                    $name = Auth::user()->name;
                    $bgColor = 'bg-gradient-to-r from-blue-500 to-purple-600';
                    // Different colors based on user ID for variety
                    $userId = Auth::id();
                    $colors = [
                        'from-blue-500 to-cyan-500',
                        'from-purple-500 to-pink-500',
                        'from-green-500 to-emerald-500',
                        'from-orange-500 to-red-500',
                        'from-indigo-500 to-blue-500'
                    ];
                    $bgColor = $colors[$userId % count($colors)] ?? 'from-blue-500 to-purple-600';
                @endphp
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-semibold {{ $bgColor }} shadow-sm">
                    {{ strtoupper(substr($name, 0, 2)) }}
                </div>
            @endif
        @endauth
        
        <div class="hidden md:block text-left">
            @auth
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</p>
                @if(Auth::user()->email)
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[150px]">{{ Auth::user()->email }}</p>
                @endif
            @endauth
        </div>
        <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 py-2 z-50 overflow-hidden">
        
        <!-- User Info in Dropdown -->
        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center space-x-3">
                @auth
                    @if(Auth::user()->profile_photo_path || Auth::user()->avatar_url)
                        <img class="w-10 h-10 rounded-full object-cover" 
                             src="{{ Auth::user()->profile_photo_path ? Storage::url(Auth::user()->profile_photo_path) : Auth::user()->avatar_url }}" 
                             alt="{{ Auth::user()->name }}">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                    @endif
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                @endauth
            </div>
        </div>
        
        <div class="py-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <i class="fas fa-tachometer-alt mr-3 text-gray-500 w-5 text-center"></i>
                Dashboard
            </a>
            
            <a href="3" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <i class="fas fa-user-circle mr-3 text-gray-500 w-5 text-center"></i>
                My Profile
            </a>
            
            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <i class="fas fa-cog mr-3 text-gray-500 w-5 text-center"></i>
                Settings
            </a>
            
            
        </div>
        
        <div class="border-t border-gray-100 dark:border-gray-700 pt-1">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" 
                        class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                    <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
            </div>
        </header>


        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            
            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard Overview</h1>
                    <p class="text-sm text-gray-500 mt-1">Welcome back, Zeeshan! Here's what's happening today.</p>
                </div>
                <div class="flex items-center space-x-3 mt-4 sm:mt-0">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Export
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Add New
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Users</p>
                            <p class="text-2xl font-bold text-gray-800">1,240</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-xs text-green-600 font-medium">
                            <i class="fas fa-arrow-up mr-1"></i> 12% from last month
                        </span>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-user-shield text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Admins</p>
                            <p class="text-2xl font-bold text-gray-800">12</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <i class="fas fa-user-check text-purple-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Active Now</p>
                            <p class="text-2xl font-bold text-gray-800">45</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-orange-100 rounded-lg">
                            <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Growth</p>
                            <p class="text-2xl font-bold text-gray-800">24.5%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800">Recent Users</h3>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase font-medium">
                                <th class="px-6 py-3 text-left">Name</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Role</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-medium mr-3">
                                            AA
                                        </div>
                                        <span class="font-medium text-gray-800">Ahmed Ali</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">ahmed.ali@example.com</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">Editor</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Active</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-medium mr-3">
                                            SK
                                        </div>
                                        <span class="font-medium text-gray-800">Sara Khan</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">sara.khan@example.com</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full font-medium">User</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-medium">Pending</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>