<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-picture-input />
            <x-input-error class="mt-2" :messages="$errors->get('picture')" />
        </div>

        <div>
            <x-sub-picture-input />
            <x-input-error class="mt-2" :messages="$errors->get('picture')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="hobby" :value="__('Hobby')" />
            <x-text-input id="hobby" name="hobby" type="text" class="mt-1 block w-full" :value="old('hobby', $user->hobby)" required autofocus autocomplete="hobby" />
            <x-input-error class="mt-2" :messages="$errors->get('hobby')" />
        </div>

        <div>
            <x-input-label for="character" :value="__('Character')" />
            <x-text-input id="character" name="character" type="text" class="mt-1 block w-full" :value="old('character', $user->character)" required autofocus autocomplete="character" />
            <x-input-error class="mt-2" :messages="$errors->get('character')" />
        </div>

        @if(isset($user->last_login_at))
            <div>
                <x-input-label for="character" :value="__('last_login_at')" />
                <p>{{ date("Y/m/d-H:i:s", strtotime($user->last_login_at)) }}</p>
            </div>
        @endif

        {{-- <div>
            <x-input-label for="name" :value="__('Generation')" />
            <label for="generation">世代を選択してください:</label>
            <select id="generation" name="generation" required autofocus autocomplete="generation">
                <option value="1" {{ $user->generation == 1 ? 'selected' : '' }}>10代</option>
                <option value="2" {{ $user->generation == 2 ? 'selected' : '' }}>20代</option>
                <option value="3" {{ $user->generation == 3 ? 'selected' : '' }}>30代</option>
                <option value="4" {{ $user->generation == 4 ? 'selected' : '' }}>40代</option>
                <option value="5" {{ $user->generation == 5 ? 'selected' : '' }}>50代</option>
                <option value="6" {{ $user->generation == 6 ? 'selected' : '' }}>60代</option>
                <option value="7" {{ $user->generation == 7 ? 'selected' : '' }}>70代</option>
                <option value="8" {{ $user->generation == 8 ? 'selected' : '' }}>80代</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('generation')" />
        </div> --}}
        @php
            $generations = [
                1 => '10代',
                2 => '20代',
                3 => '30代',
                4 => '40代',
                5 => '50代',
                6 => '60代',
                7 => '70代',
                8 => '80代',
            ];
        @endphp

        <div>
            <x-input-label for="name" :value="__('Generation')" />
            <label for="generation">世代を選択してください:</label>
            <select id="generation" name="generation" required autofocus autocomplete="generation" class="rounded-md border-gray-400 shadow-sm">
                @foreach($generations as $value => $label)
                    <option value="{{ $value }}" {{ $user->generation == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('generation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
