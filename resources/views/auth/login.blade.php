<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Job Board</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <div class="flex min-h-screen items-center justify-center px-4 py-12">

        <div class="w-full max-w-md">

            <div class="mb-8 text-center">

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Job<span class="text-blue-600">Board</span>
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Sign in to your backoffice account
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6">

                    <h2 class="text-xl font-semibold text-slate-900">
                        Welcome back
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Enter your credentials to continue.
                    </p>

                </div>

                @if (session('status'))
                    <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">

                    @csrf

                    <div>

                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                            Email address
                        </label>

                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" placeholder="you@example.com"
                            class="w-full rounded-lg border
                            {{ $errors->has('email') ? 'border-red-400 ring-2 ring-red-100' : 'border-slate-300' }}
                            bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none
                            transition placeholder:text-slate-400
                            focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <label for="password" class="block text-sm font-medium text-slate-700">
                                Password
                            </label>

                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-blue-600 hover:text-blue-700">
                                Forgot password?
                            </a>

                        </div>

                        <div class="relative">

                            <input id="password" name="password" type="password" required
                                autocomplete="current-password" placeholder="••••••••"
                                class="w-full rounded-lg border
                                {{ $errors->has('password') ? 'border-red-400 ring-2 ring-red-100' : 'border-slate-300' }}
                                bg-white px-3.5 py-2.5 pr-10 text-sm text-slate-900 outline-none
                                transition placeholder:text-slate-400
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <button type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-slate-600"
                                aria-label="Show password">

                                <svg id="eye-open" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                    stroke="currentColor" class="h-5 w-5">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.644
                                        C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51
                                        9.964 6.678a1.012 1.012 0 010 .644
                                        C20.577 16.49 16.64 19 12 19
                                        c-4.64 0-8.577-2.51-9.964-6.678z" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                </svg>

                                <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                    stroke="currentColor" class="hidden h-5 w-5">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 002.036 12.322
                                        a1.012 1.012 0 000 .644C3.423 17.49 7.36 20
                                        12 20c1.55 0 3.033-.35 4.35-.977" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.228 6.228A10.45 10.45 0 0112 4
                                        c4.64 0 8.577 2.51 9.964 6.678
                                        a1.012 1.012 0 010 .644
                                        10.45 10.45 0 01-4.35 5.1" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.228 6.228L3 3m3.228 3.228l11.544 11.544
                                        M12 9a3 3 0 014.243 4.243M9.879 9.879
                                        A3 3 0 0012 15" />

                                </svg>

                            </button>

                        </div>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="flex items-center">

                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                        <label for="remember" class="ml-2 text-sm text-slate-600">
                            Remember me
                        </label>

                    </div>

                    <button type="submit"
                        class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white
                        shadow-sm transition hover:bg-blue-700
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">

                        Sign in

                    </button>

                </form>

            </div>

            <p class="mt-6 text-center text-xs text-slate-400">
                Job Board Backoffice
            </p>

        </div>

    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (password.type === 'password') {
                password.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                password.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>

</body>

</html>
