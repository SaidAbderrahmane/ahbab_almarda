<x-app-layout>
    <div
        class="bg-cover bg-no-repeat bg-[url('https://images.unsplash.com/photo-1615461066159-fea0960485d5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1016&q=80')] min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-600  bg-blend-multiply">
        <div class="w-full flex flex-col items-center justify-center px-6 mt-20 mb-10 mx-auto md:max-h-fit">
            @include('components.alerts')
            <div
                class="w-full overflow-y-auto bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-screen-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-6">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form class="" method="POST" action="{{ route('register.donor') }}">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('Full Name') }}</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Name" required="">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="pere"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Father') }}</label>
                                <input type="text" name="pere" id="pere"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-input-error :messages="$errors->get('pere')" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="grand_pere"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Grand Father') }}</label>
                                <input type="text" name="grand_pere" id="grand_pere"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <x-input-error :messages="$errors->get('grand_pere')" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="groupage"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Blood type') }}</label>
                                <select name="groupage" id="groupage"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>{{ __('Blood type') }}</option>
                                    @foreach (Config::get('constants.blood_types') as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('groupage')" class="mt-2" />

                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="date_naissance"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Birthdate') }}</label>
                                <div class="relative max-w-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input datepicker datepicker-autohide type="text" name="date_naissance"
                                        id="date_naissance"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Select date" required>
                                </div>
                                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="sexe"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Sexe') }}</label>
                                <select name="sexe" id="sexe"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>{{ __('Sexe') }}</option>
                                    <option value="H">{{ __('Male') }}</option>
                                    <option value="F">{{ __('Femelle') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="adresse"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Address') }}</label>
                                <input type="text" name="adresse" id="adresse"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="e.g. Bab ezzouar" required>
                                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="key_agherme"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Agherme') }}</label>
                                <select name="key_agherme" id="key_agherme"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>{{ __('Agherme') }}</option>
                                    @foreach (App\Models\Agherme::all() as $item)
                                        <option value="{{ $item->key_agherme }}">{{ $item->agherme }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('key_agherme')" class="mt-2" />

                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Email" required="">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required="">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                                    password</label>
                                <input type="confirm-password" name="password_confirmation"
                                    id="password_confirmation" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required="">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                        <div class="pt-10 px-16">
                            <button type="submit"
                                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create
                                an account</button>
                            <p class="pt-2 text-sm font-light text-gray-500 dark:text-gray-400">
                                Already have an account? <a href="{{ route('login') }}"
                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
                                    here</a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
