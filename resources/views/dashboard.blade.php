<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, darkMode: false, activeTab: 'overview' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
        }
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        body {
            transition: background-color 0.3s ease;
        }
        
        body.dark-mode {
            background-color: var(--dark-bg);
            color: #e2e8f0;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }
        
        .dark-mode .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        }
        
        .sidebar-transition {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .progress-ring {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }
        
        .dark-mode .stat-card::before {
            background: linear-gradient(90deg, var(--primary-light), #8b5cf6);
        }
        
        .tab-active {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .dark-mode .tab-active {
            background-color: rgba(99, 102, 241, 0.2);
        }
        
        .notification-dot {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }
        
        .mobile-menu {
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body :class="darkMode ? 'dark-mode' : ''" class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen">

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-black/50 lg:hidden transition-opacity duration-300"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="sidebar-transition fixed inset-y-0 left-0 z-50 w-80 bg-white dark:bg-slate-900 border-r border-gray-100 dark:border-slate-800 lg:translate-x-0 lg:static lg:inset-0 mobile-menu">
        
        <!-- Logo & User Info -->
        <div class="p-6 border-b border-gray-100 dark:border-slate-800">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="h-12 w-12 gradient-bg rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-cog text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">User</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Dashboard</p>
                    </div>
                </div>
                <button @click="darkMode = !darkMode" class="p-2 rounded-lg bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
                    <i x-show="!darkMode" class="fas fa-moon"></i>
                    <i x-show="darkMode" class="fas fa-sun"></i>
                </button>
            </div>
            
            
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="#" @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-chart-pie w-5 text-center"></i>
                <span>Overview</span>
            </a>
            
            <a href="#" @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-user-edit w-5 text-center"></i>
                <span>My Profile</span>
                <span class="ml-auto px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400 text-xs font-semibold rounded-full">85%</span>
            </a>
            
            <a href="#" @click="activeTab = 'projects'" :class="activeTab === 'projects' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-tasks w-5 text-center"></i>
                <span>Projects</span>
                <span class="ml-auto px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 text-xs font-semibold rounded-full">14</span>
            </a>
            
            <a href="#" @click="activeTab = 'analytics'" :class="activeTab === 'analytics' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span>Analytics</span>
            </a>
            
            <a href="#" @click="activeTab = 'notifications'" :class="activeTab === 'notifications' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-bell w-5 text-center"></i>
                <span>Notifications</span>
                <span class="ml-auto notification-dot h-2 w-2 bg-red-500 rounded-full"></span>
            </a>
            
            <a href="#" @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-cog w-5 text-center"></i>
                <span>Settings</span>
            </a>
            <a href="#" @click="activeTab = 'Help & Support'" :class="activeTab === 'Help & Support' ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-800'"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl font-medium transition-all duration-200">
                <i class="fas fa-question-circle"></i>
                <span>Help & Support</span>
            </a>
            
            
        </nav>

        <!-- Progress Section -->
        

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
            @php
                $user = Auth::user();
            @endphp
            @if($user->profile_photo_path)
                <img class="w-9 h-9 rounded-full object-cover border-2 border-white dark:border-gray-800 shadow-sm" 
                     src="{{ Storage::url($user->profile_photo_path) }}" 
                     alt="{{ $user->name }}">
            @elseif($user->avatar_url)
                <img class="w-9 h-9 rounded-full object-cover border-2 border-white dark:border-gray-800 shadow-sm" 
                     src="{{ $user->avatar_url }}" 
                     alt="{{ $user->name }}">
            @else
                @php
                    $name = $user->name;
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
                @php
                    $user = Auth::user();
                @endphp
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $user->name }}</p>
                @if($user->email)
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[150px]">{{ $user->email }}</p>
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
                    @php
                        $user = Auth::user();
                        $isAdmin = false;
                        
                        // Check if user is admin (multiple ways)
                        if (isset($user->role) && ($user->role === 'admin' || $user->role === 'administrator')) {
                            $isAdmin = true;
                        } elseif (isset($user->is_admin) && $user->is_admin) {
                            $isAdmin = true;
                        } elseif (isset($user->type) && $user->type === 'admin') {
                            $isAdmin = true;
                        }
                    @endphp
                    
                    @if($user->profile_photo_path || $user->avatar_url)
                        <img class="w-10 h-10 rounded-full object-cover" 
                             src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : $user->avatar_url }}" 
                             alt="{{ $user->name }}">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                @endauth
            </div>
        </div>
        
        <div class="py-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <i class="fas fa-tachometer-alt mr-3 text-gray-500 w-5 text-center"></i>
                Dashboard
            </a>
            
            <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <i class="fas fa-user-circle mr-3 text-gray-500 w-5 text-center"></i>
                My Profile
            </a>
            
            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <i class="fas fa-cog mr-3 text-gray-500 w-5 text-center"></i>
                Settings
            </a>
            
            <!-- Admin Panel Link (Only for Admins) -->
            @auth
                @php
                    $user = Auth::user();
                    $showAdminLink = false;
                    
                    // Check admin status
                    if (isset($user->role) && ($user->role === 'admin' || $user->role === 'administrator')) {
                        $showAdminLink = true;
                    } elseif (isset($user->is_admin) && $user->is_admin) {
                        $showAdminLink = true;
                    } elseif (isset($user->type) && $user->type === 'admin') {
                        $showAdminLink = true;
                    }
                @endphp
                
                @if($showAdminLink)
                    <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20">
                        <i class="fas fa-shield-alt mr-3 w-5 text-center"></i>
                        Admin Panel
                    </a>
                @endif
            @endauth
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
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 lg:p-8">
            
            

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card bg-white dark:bg-slate-800 p-6 rounded-2xl card-shadow fade-in">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                            <i class="fas fa-wallet text-blue-600 dark:text-blue-400 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 rounded-full">
                            <i class="fas fa-arrow-up mr-1"></i> 12.5%
                        </span>
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold mb-1">Account Balance</div>
                    <div class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">$2,450.00</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Updated just now</div>
                </div>

                <div class="stat-card bg-white dark:bg-slate-800 p-6 rounded-2xl card-shadow fade-in">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
                            <i class="fas fa-tasks text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">Active</span>
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold mb-1">Active Projects</div>
                    <div class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">14</div>
                    <div class="w-full bg-gray-100 dark:bg-slate-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>

                <div class="stat-card bg-white dark:bg-slate-800 p-6 rounded-2xl card-shadow fade-in">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-xl">
                            <i class="fas fa-clock text-amber-600 dark:text-amber-400 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">This Week</span>
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold mb-1">Time Spent</div>
                    <div class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">42h 15m</div>
                    <div class="text-xs text-amber-600 dark:text-amber-400 font-medium">
                        <i class="fas fa-trend-up mr-1"></i> 18% increase
                    </div>
                </div>

                <div class="stat-card bg-white dark:bg-slate-800 p-6 rounded-2xl card-shadow fade-in">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl">
                            <i class="fas fa-users text-emerald-600 dark:text-emerald-400 text-xl"></i>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 rounded-full">
                            <i class="fas fa-user-plus mr-1"></i> 3 new
                        </span>
                    </div>
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-semibold mb-1">Team Members</div>
                    <div class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">24</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Across 4 projects</div>
                </div>
            </div>

            
            
            <!-- Bottom Stats -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Team Productivity</p>
                            <p class="text-2xl font-bold mt-1">87%</p>
                        </div>
                        <i class="fas fa-chart-line text-3xl opacity-80"></i>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Goals Completed</p>
                            <p class="text-2xl font-bold mt-1">12/15</p>
                        </div>
                        <i class="fas fa-flag-checkered text-3xl opacity-80"></i>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Satisfaction Rate</p>
                            <p class="text-2xl font-bold mt-1">94%</p>
                        </div>
                        <i class="fas fa-smile-beam text-3xl opacity-80"></i>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Initialize dashboard functionality
    document.addEventListener('alpine:init', () => {
        // Any additional Alpine.js functionality can be added here
    });
    
    // Auto-hide mobile sidebar on larger screens
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebarOpen = false;
        }
    });
</script>

</body>
</html>