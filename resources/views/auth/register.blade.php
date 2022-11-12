<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="tw-w-20 tw-h-20 tw-fill-current tw-text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="tw-mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900" for="name" :value="__('Name')" />

                <x-input id="name" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full tw-p-2.5 dark:focus:tw-ring-blue-500 dark:focus:tw-border-blue-500" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="tw-mt-4">
                <x-label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900" for="email" :value="__('Email')" />

                <x-input id="email" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full tw-p-2.5 dark:focus:tw-ring-blue-500 dark:focus:tw-border-blue-500" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="tw-grid tw-grid-cols-2 tw-gap tw-gap-4">
 <!-- Password -->
 <div class="tw-mt-4">
    <x-label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900" for="password" :value="__('Password')" />

    <x-input id="password" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full tw-p-2.5 dark:focus:tw-ring-blue-500 dark:focus:tw-border-blue-500"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
</div>

<!-- Confirm Password -->
<div class="tw-mt-4">
    <x-label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900" for="password_confirmation" :value="__('Confirm Password')" />

    <x-input id="password_confirmation" class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full tw-p-2.5 dark:focus:tw-ring-blue-500 dark:focus:tw-border-blue-500"
                    type="password"
                    name="password_confirmation" required />
</div>
            </div>
           

			 <div class="tw-mt-4">
                    <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900">Role user</label>
                    <select class="tw-block tw-mt-1 tw-w-full tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm" name="role_id">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
            </div>


            <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
                <x-button class="tw-ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
