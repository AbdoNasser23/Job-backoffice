<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Job Board Backoffice')</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    @php
        $click = 'bg-blue-50 px-3 py-2.5 text-sm font-medium text-blue-700';
        $notClick = 'px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900';
    @endphp

    <div class="min-h-screen">

        <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-slate-200 bg-white lg:block">

            <div class="flex h-16 items-center border-b border-slate-200 px-6">
                <span class="text-xl font-bold tracking-tight text-slate-900">
                    Job<span class="text-blue-600">Board</span>
                </span>
            </div>

            <div class="p-4">

                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Main
                </p>

                <nav class="space-y-1">

                    <a href="{{ route('dashboard.index') }}"
                        class="flex items-center gap-3 rounded-lg {{ request()->routeIs('dashboard.index') ? $click : $notClick }}">
                        Dashboard
                    </a>

                    <a href="{{ route('companies.index') }}"
                        class="flex items-center gap-3 rounded-lg {{ request()->routeIs('companies.index') ? $click : $notClick }}">
                        Companies
                    </a>

                    <a href="{{ route('vacancies.index') }}"
                        class="flex items-center gap-3 rounded-lg {{ request()->routeIs('vacancies.index') ? $click : $notClick }}">
                        Job Vacancies
                    </a>

                    <a href="{{ route('applications.index') }}"
                        class="flex items-center gap-3 rounded-lg {{ request()->routeIs('applications.index') ? $click : $notClick }}">
                        Job Applications
                    </a>
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('users.index') }}"
                        class="flex items-center gap-3 rounded-lg {{ request()->routeIs('users.index') ? $click : $notClick }}">
                        Users
                    </a>
                    @endif

                </nav>

                <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Management
                </p>

                <nav class="space-y-1">

                    <a href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 rounded-lg {{ request()->routeIs('categories.index') ? $click : $notClick }}">
                        Job Categories
                    </a>

                    

                </nav>

            </div>

        </aside>


        <div class="lg:pl-64">

            <header
                class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 sm:px-6">

                <h1 class="text-lg font-semibold text-slate-900">
                    @yield('page-title', 'Dashboard')
                </h1>

                <div class="flex items-center gap-4">

                    <div class="hidden h-7 w-px bg-slate-200 sm:block"></div>

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-sm font-semibold text-blue-700">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>

                        <div class="hidden sm:block">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ auth()->user()->role ?? 'Administrator' }}
                            </p>
                        </div>

                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600">
                            Logout
                        </button>
                    </form>

                </div>

            </header>


            <main class="p-4 sm:p-6 lg:p-8">

                @if (session('success'))
                    <div id="success-message"
                        class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>

                    <script>
                        setTimeout(() => {
                            const message = document.getElementById('success-message');

                            if (message) {
                                message.remove();
                            }
                        }, 2000);
                    </script>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>
