<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="w-full">
        <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">{{ __('Donors by age') }}</h3>
        @foreach ($age_stats as $item)
            <div class="flex items-center mb-2">
                <div class="w-16 text-sm font-medium dark:text-white">{{ $item->age_range }}</div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div data-tooltip-target="age-stat-{{ $item->age_range }}"
                        class="bg-red-600 h-2.5 rounded-full dark:bg-primary-500" style="width:{{ $item->percentage }}%">
                    </div>
                    <div id="age-stat-{{ $item->age_range }}" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{ $item->count }}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="traffic-channels-chart" class="w-full"></div>
</div>
