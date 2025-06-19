<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Two Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Add additional security to your account using two factor authentication.') }}
        </p>
    </header>

    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post"
        action="{{ auth()->user()->two_factor_secret ? route('two-factor.disable') : route('two-factor.enable') }}"
        class="mt-6 space-y-6">
        @csrf



        <div class=" gap-4">
            @if (auth()->user()->two_factor_secret)
                @method('delete')
               
               
                <x-danger-button>{{ __('Disable') }}</x-danger-button>
            @else
                <x-primary-button>{{ __('Enable') }}</x-primary-button>
            @endif


               <div class=" gap-4  mt-4">
                 @if (auth()->user()->two_factor_secret)
               
                {{-- QR code --}}
                 <div class="mb-6">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
                <div class="mb-6">
                    <p class="text-sm text-gray-600 my-2">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                    @foreach ((array) auth()->user()->recoveryCodes() as $recoveryCode)
                        <p class="mt-1  text-sm text-gray-600">
                            {{ $recoveryCode }}
                        </p>
                    @endforeach
                </div>
                <form action="{{ url('user/two-factor-recovery-codes') }}">
                    @csrf
                    <x-primary-button>{{ __('Generate New Recovery Codes') }}</x-primary-button>
                </form>
                @endif
            @php
                $sessionStatus =
                    session('status') === 'two-factor-authentication-enabled'
                        ? 'Two Factor Authentication Enabled'
                        : 'Two Factor Authentication Disabled';
            @endphp

            @if ($sessionStatus)
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="text-sm text-gray-600">{{ __($sessionStatus) }}</p>
            @endif
               </div>
        </div>
    </form>
</section>
