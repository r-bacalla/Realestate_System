<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-semibold text-slate-900">Verify Your Email</h2>
        <p class="mt-2 text-sm text-slate-600">Thanks for signing up! Please verify your email address before continuing.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="space-y-4">
        <div class="text-sm text-slate-600">
            {{ __('We have emailed you a verification link. If you did not receive the email, click the button below to resend it.') }}
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf

                <x-primary-button class="w-full sm:w-auto">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf

                <button type="submit" class="w-full inline-flex justify-center px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
