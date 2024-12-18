<!-- Add User Modal -->
<div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
    id="add-compaign-details-modal">
    <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                <h3 class="text-xl font-semibold dark:text-white">
                    {{ __('Add new donor') }}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                    data-modal-toggle="add-compaign-details-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="{{ route('compaign-details.store') }}" method="POST" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <input type="hidden" id="key_operation" name="key_operation" value="{{$compaign->key_operation}}">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-12 sm:col-span-6">
                            <label for="key_tiers"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Donor') }}
                            </label>
                            <input type="hidden" id="key_tiers" name="key_tiers">
                            <a id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch"
                                data-dropdown-placement="bottom"
                                class=" w-full text-gray-900 dark:text-white bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                                type="button">{{ __('Donor') }}
                                <svg class="w-4 h-4 ml-2 " aria-hidden="true" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"> </path>
                                </svg>
                            </a>
                            <!-- Dropdown menu -->
                            <div id="dropdownSearch"
                                class="z-10 hidden bg-white rounded-lg shadow w-4/5 dark:bg-gray-700">
                                <div class="p-3">
                                    <label for="input-group-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="text" id="input-group-search" value=""
                                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search user">
                                    </div>
                                </div>
                                <ul id="donors-list" class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDonorsButton">
                                </ul>
                                <div class="flex justify-center">
                                <button type="button" id="loadButton" page="1"
                                    class="my-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    load more </button>
                                </div>
                                <button data-modal-toggle="add-donor-modal" type="button"
                                    class="flex items-center p-3 text-sm font-medium text-blue-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-blue-500 hover:underline">
                                    <svg class="w-5 h-5 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                        </path>
                                    </svg>
                                    {{ __('Add donor') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="key_tiers" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('Information source') }}
                            </label>
                            <div class="flex p-5 bg-blue-50 dark:bg-gray-900 rounded-xl ">
                                <div class="flex items-center mr-4 ">
                                    <input id="par_viber"  name="par_viber" type="checkbox" value="O"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="par_viber"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('viber') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="par_sms"  name="par_sms"type="checkbox" value="O"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="par_sms"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('sms') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="par_annonce"  name="par_annonce" type="checkbox" value="O"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="par_annonce"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('annonce') }}</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="par_facebook"  name="par_facebook" type="checkbox" value="O"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="par_facebook"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('facebook') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <div class="mt-7 ml-10">
                                <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                    <input id="accepte" name="accepte" type="checkbox" value="O" class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                    <span
                                        class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Accepted') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="matricule"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Matricule') }}</label>
                            <input type="text" name="matricule" id="matricule"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <label for="observation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Note') }}</label>
                            <textarea id="observation" name="observation" rows="4" 
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="{{ __('Note') }}..."></textarea>
                        </div>
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit">Add donor</button>
            </div>
            </form>
        </div>
    </div>
</div>
