<x-app-layout>
    <x-slot:scripts>
        @vite(['/resources/js/charts.js'])
    </x-slot:scripts>
    <div class="px-4 pt-6">
        @include('pages.dashboard.partials.blood_stats')
        <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
            @include('pages.dashboard.partials.donations_per_time')
            @include('pages.dashboard.partials.donors_per_age')
        </div>
    </div>
</x-app-layout>
