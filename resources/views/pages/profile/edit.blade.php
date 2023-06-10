<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <x-slot name="scripts">
        @vite(['resources/js/profile.js'])
    </x-slot>
    <div class="py-12">
        @include('components.alerts')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-screen-md">
                    @include('pages.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('pages.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('pages.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    @include('pages.donors.partials.add-contact')
    @include('pages.donors.partials.edit-contact')
    @include('pages.donors.partials.delete-contact')
</x-app-layout>
