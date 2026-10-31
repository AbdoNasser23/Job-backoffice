<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password - Job Board</title>

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
                    Create a new password
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6">

                    <h2 class="text-xl font-semibold text-slate-900">
                        Reset your password
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Choose a new password for your account.
                    </p>

                </div>


                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">

                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">


                    <div>

                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                            Email address
                        </label>

                        <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}"
                            required autocomplete="username" placeholder="you@example.com"
                            class="w-full rounded-lg border
                            {{ $errors->has('email') ? 'border-red-400 ring-2 ring-red-100' : 'border-slate-300' }}
                            bg-white px-3.5 py-2.5 text-sm outline-none
                            transition placeholder:text-slate-400
                            focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                            New password
                        </label>

                        <div class="relative">

                            <input id="password" name="password" type="password" required autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full rounded-lg border
                                {{ $errors->has('password') ? 'border-red-400 ring-2 ring-red-100' : 'border-slate-300' }}
                                bg-white px-3.5 py-2.5 pr-11 text-sm outline-none
                                transition placeholder:text-slate-400
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-3 flex items-center text-slate-400 transition hover:text-slate-600"
                                aria-label="Show password">

                                <svg class="eye-open h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                <svg class="eye-closed hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m3 3 18 18M10.58 10.59a2 2 0 0 0 2.83 2.83" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.88 5.09A10.7 10.7 0 0 1 12 4.88c6 0 9.75 7.12 9.75 7.12a17.7 17.7 0 0 1-3.1 3.9M6.23 6.23C3.7 7.86 2.25 12 2.25 12s3.75 7.12 9.75 7.12c1.3 0 2.5-.4 3.55-1.02" />
                                </svg>

                            </button>

                        </div>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">
                            Confirm new password
                        </label>

                        <div class="relative">

                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                autocomplete="new-password" placeholder="••••••••"
                                class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 pr-11 text-sm outline-none
                                transition placeholder:text-slate-400
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <button type="button" onclick="togglePassword('password_confirmation', this)"
                                class="absolute inset-y-0 right-3 flex items-center text-slate-400 transition hover:text-slate-600"
                                aria-label="Show password">

                                <svg class="eye-open h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                <svg class="eye-closed hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m3 3 18 18M10.58 10.59a2 2 0 0 0 2.83 2.83" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.88 5.09A10.7 10.7 0 0 1 12 4.88c6 0 9.75 7.12 9.75 7.12a17.7 17.7 0 0 1-3.1 3.9M6.23 6.23C3.7 7.86 2.25 12 2.25 12s3.75 7.12 9.75 7.12c1.3 0 2.5-.4 3.55-1.02" />
                                </svg>

                            </button>

                        </div>

                    </div>


                    <button type="submit"
                        class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white
                        shadow-sm transition hover:bg-blue-700
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">

                        Reset password

                    </button>

                </form>


                <div class="mt-6 text-center">

                    <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                        ← Back to login
                    </a>

                </div>

            </div>

        </div>

    </div>


    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);

            const eyeOpen = button.querySelector('.eye-open');
            const eyeClosed = button.querySelector('.eye-closed');

            if (input.type === 'password') {
                input.type = 'text';

                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');

                button.setAttribute('aria-label', 'Hide password');
            } else {
                input.type = 'password';

                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');

                button.setAttribute('aria-label', 'Show password');
            }
        }
    </script>

</body>

</html>
