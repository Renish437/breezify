<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __(!$recovery ?'Please confirm access to your account by entering the authentication code provided by your authenticator application.':'Please confirm access to your account by entering one of your emergency recovery codes.') }}
    </div>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

       @if(!$recovery)
        <!-- Auth  Code -->
        <div>
            <x-input-label for="code" :value="__('Code')" />

            <x-text-input id="code" class="block mt-1 w-full"
                            type="text"
                            name="code"
                          autocomplete="one-time-code" />

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>
        @else
        <!-- Recovery  Code -->
        <div>
            <x-input-label for="recovery_code" :value="__('Recovery Code')" />

            <x-text-input id="code" class="block mt-1 w-full"
                            type="text"
                            name="recovery_code"
                            autofocus
                          autocomplete="one-time-code" />

            <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
        </div>

        
       @endif
        <div class="flex items-center justify-start mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ $recovery ? route('two-factor.login') : route('two-factor.login',['recovery'=>true]) }}">
                {{ __(!$recovery ?'Use a recovery code':'Use Authentication code') }}
            </a>
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
