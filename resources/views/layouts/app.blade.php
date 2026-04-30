<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ghassal System - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind from Breeze or your own CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- jQuery & Select2 --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        body { background: #f3f4f6; }
        .sidebar {
            background: #111827;
            color: #e5e7eb;
        }
        .sidebar a {
            display: block;
            padding: 0.75rem 1rem;
            color: #e5e7eb;
            text-decoration: none;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: #1f2937;
        }
        /* Red asterisk for required fields */
        .required-asterisk {
            color: #dc2626; /* red-600 */
        }
    </style>
</head>
<body class="antialiased">
<div class="min-h-screen flex flex-col md:flex-row">
    {{-- Sidebar --}}
    <aside class="sidebar w-full md:w-60 md:min-h-screen">
        <div class="p-4 text-xl font-bold border-b border-gray-700 flex items-center justify-between md:block">
            Ghassal Panel

            {{-- Mobile menu toggle --}}
            <button class="md:hidden text-xs bg-gray-800 px-3 py-1 rounded"
                    onclick="document.getElementById('sidebar-nav').classList.toggle('hidden')">
                Menu
            </button>
        </div>

        {{-- IMPORTANT: hidden md:block --}}
        <nav id="sidebar-nav" class="mt-2 hidden md:block">
            <a href="{{ route('ghassal.index') }}"
               class="{{ request()->routeIs('ghassal.index') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('ghassal.create') }}"
               class="{{ request()->routeIs('ghassal.create') ? 'active' : '' }}">
                New Record
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 hover:bg-gray-800">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- Main content --}}
    <main class="flex-1 p-4 md:p-6 overflow-x-auto">
        @if(session('success'))
            <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>