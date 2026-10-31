<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify Email - Job Board</title>
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
                    Verify your email address
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6">

                    <h2 class="text-xl font-semibold text-slate-900">
                        Verify your email
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Thanks for creating your account. Before you can access the backoffice,
                        please verify your email address by clicking the link we sent to your email.
                    </p>

                </div>


                @if (session('status') === 'verification-link-sent')
                    <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        A new verification link has been sent to your email address.
                    </div>
                @endif


                <div class="space-y-4">

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <button
                            type="submit"
                            class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white
                            shadow-sm transition hover:bg-blue-700
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">

                            Resend verification email

                        </button>
                    </form>


                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5
                            text-sm font-semibold text-slate-700 transition hover:bg-slate-50
                            focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">

                            Log out

                        </button>
                    </form>

                </div>

            </div>


            <p class="mt-6 text-center text-xs text-slate-400">
                Job Board Backoffice
            </p>

        </div>

    </div>

</body>

</html>
