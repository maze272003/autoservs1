<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Zipcode -->
        <div>
            <x-input-label for="zipcode" :value="__('Zipcode')" />
            <x-text-input id="zipcode" name="zipcode" type="text" class="mt-1 block w-full" :value="old('zipcode', $user->zipcode)"
                maxlength="4" />
            <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
        </div>

        <!-- Contact Number -->
        <div>
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full"
                :value="old('contact_number', $user->contact_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
        </div>

        <!-- Barangay -->
        <div>
            <x-input-label for="brgy" :value="__('Barangay')" />
            <x-text-input id="brgy" name="brgy" type="text" class="mt-1 block w-full" :value="old('brgy', $user->brgy)" />
            <x-input-error class="mt-2" :messages="$errors->get('brgy')" />
        </div>

        <!-- Street -->
        <div>
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" name="street" type="text" class="mt-1 block w-full" :value="old('street', $user->street)" />
            <x-input-error class="mt-2" :messages="$errors->get('street')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
