<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="flex h-screen overflow-hidden">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-slate-900/60 backdrop-blur-sm lg:hidden transition-opacity"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-30 w-72 bg-white border-r border-slate-200 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0 shadow-sm">
        
        <div class="flex items-center px-8 py-6 border-b border-slate-100">
            <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <span class="ml-3 text-xl font-bold tracking-tight text-slate-800">MySpace</span>
        </div>

        <nav class="mt-8 px-4 space-y-1">
            <a href="#" class="flex items-center px-4 py-3 bg-indigo-50 text-indigo-700 rounded-xl font-semibold transition-all">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                My Dashboard
            </a>
            
            <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-xl transition-all group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                My Profile
            </a>

            <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-xl transition-all group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Orders / Activity
            </a>

            <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-xl transition-all group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                Notifications
            </a>
        </nav>

        <div class="absolute bottom-0 w-full p-4 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center px-4 py-3 text-sm font-semibold text-red-500 bg-red-50 hover:bg-red-100 rounded-xl transition-all">
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 shadow-sm">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-slate-500 lg:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h2 class="ml-4 lg:ml-0 text-xl font-bold text-slate-800">Overview</h2>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-slate-500 italic">Premium Member</span>
                </div>
                <img class="h-10 w-10 rounded-full border-2 border-indigo-100 object-cover" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6366f1&color=fff" alt="User">
            </div>
            <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">
            
            <div class="bg-indigo-700 rounded-3xl p-8 mb-8 text-white relative overflow-hidden shadow-2xl shadow-indigo-200">
                <div class="relative z-10 max-w-lg">
                    <h1 class="text-3xl font-bold mb-2">Hello, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                    <p class="text-indigo-100 text-lg">Welcome back! You have 3 new notifications and your profile is 85% complete.</p>
                    <button class="mt-6 px-6 py-2.5 bg-white text-indigo-700 font-bold rounded-xl text-sm hover:bg-indigo-50 transition-colors">
                        Complete Profile
                    </button>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 bg-white/10 -skew-x-12 transform translate-x-12"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-500 text-sm font-semibold mb-1">Account Balance</div>
                    <div class="text-2xl font-bold text-slate-800">$2,450.00</div>
                    <div class="mt-2 text-xs text-green-500 font-bold flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"></path></svg>
                        +12.5% this month
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-500 text-sm font-semibold mb-1">Active Projects</div>
                    <div class="text-2xl font-bold text-slate-800">14</div>
                    <div class="mt-2 w-full bg-slate-100 rounded-full h-1.5">
                        <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 65%"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="text-slate-500 text-sm font-semibold mb-1">Time Spent</div>
                    <div class="text-2xl font-bold text-slate-800">42h 15m</div>
                    <div class="mt-2 text-xs text-slate-400 italic font-medium">Weekly productivity</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 text-lg">Your Dashboard Activity</h3>
                    <select class="bg-slate-50 border-none text-sm font-semibold rounded-lg text-slate-500 outline-none p-2">
                        <option>This Week</option>
                        <option>Last Month</option>
                    </select>
                </div>
                <div class="p-8 flex flex-col items-center justify-center text-center">
                    <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h4 class="text-slate-800 font-bold">No new messages</h4>
                    <p class="text-slate-500 text-sm mt-1 max-w-xs">Everything is up to date! Check back later for new updates on your account.</p>
                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>