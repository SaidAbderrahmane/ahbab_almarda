 <!-- Main widget -->
 <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="flex items-center justify-between mb-4">
      <div class="flex-shrink-0">
        <span id="total_compaigns" class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">total donations</span>
        <h3 class="text-base font-light text-gray-500 dark:text-gray-400">{{__('donations by cities')}}</h3>
      </div>

    </div>
    <div id="donors_per_cities"></div>
    <!-- Card Footer -->
    <div class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
      <div>
        <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" type="button" data-dropdown-toggle="weekly-donations-dropdown">Last 7 days <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
        <!-- Dropdown menu -->
        
      </div>
      <div class="flex-shrink-0">
        <a href="#" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
          donations Report
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
      </div>
    </div>
  </div>