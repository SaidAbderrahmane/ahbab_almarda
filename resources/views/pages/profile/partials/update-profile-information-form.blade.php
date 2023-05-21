<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-white">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="space-y-6 w-full mt-6">
        <form id="profile-info-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <input type="hidden" name="key_tiers" id="key_tiers" value="{{ $user->key_tiers }}">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="nom_prenom"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Full Name') }}
                    </label>
                    <input type="text" name="nom_prenom" id="nom_prenom"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $user->tiers?->nom_prenom ?? '' }}" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="pere"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Father') }}</label>
                    <input type="text" name="pere" id="pere" value="{{ $user->tiers?->pere ?? '' }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="grand_pere"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Grand Father') }}</label>
                    <input type="text" name="grand_pere" id="grand_pere"
                        value="{{ $user->tiers?->grand_pere ?? '' }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="groupage"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Blood type') }}</label>
                    <select name="groupage" id="groupage" value="{{ $user->tiers?->groupage ?? '' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">{{ __('Blood type') }}</option>
                        @foreach (Config::get('constants.blood_types') as $item)
                            <option {{ $user->tiers?->groupage == $item ? 'selected' : '' }}
                                value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="date_naissance"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Birthdate') }}</label>
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide type="text" name="date_naissance"
                            value="{{ $user->tiers?->date_naissance ?? '' }}" id="date_naissance"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date" required>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="sexe"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Sexe') }}</label>
                    <select name="sexe" id="sexe"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">{{ __('Sexe') }}</option>
                        <option {{ $user->tiers?->sexe == 'H' ? 'selected' : '' }} value="H">{{ __('Male') }}
                        </option>
                        <option {{ $user->tiers?->sexe == 'F' ? 'selected' : '' }}value="F">{{ __('Femelle') }}
                        </option>
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="adresse"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Address') }}</label>
                    <input type="text" name="adresse" id="adresse" value="{{ $user->tiers?->adresse ?? '' }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="e.g. Bab ezzouar" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="key_agherme"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Agherme') }}</label>
                    <select name="key_agherme" id="key_agherme" value="{{ $user->tiers?->key_agherme ?? '' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">{{ __('Agherme') }}</option>
                        @foreach (App\Models\Agherme::all() as $item)
                            <option {{ $user->tiers?->key_agherme == $item->key_agherme ? 'selected' : '' }}
                                value="{{ $item->key_agherme }}">{{ $item->agherme }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="code_barres"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Barcode') }}</label>
                    <input type="number" name="code_barres" id="code_barres"
                        value="{{ $user->tiers?->code_barres ?? '' }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>

            <div class="flex items-center gap-4 pt-10">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit">SAVE</button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
        {{-- <!-- Modal footer -->
         <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">

         </div> --}}
        <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
            <h3 class="text-xl font-semibold dark:text-white">
                {{ __('Contacts') }}
            </h3>
            <button type="button" data-modal-toggle="add-contact-modal" data-id="{{ $user->key_tiers }}"
                class="add-contact-button inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                add contact
            </button>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Contact') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Type') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Category') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Owner') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Action') }}
                        </th>
                    </tr>
                </thead>
                <tbody id="contacts-table'">
                    @foreach ($contacts as $contact)
                        <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-700 text-black">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $contact->tel_email }}
                            </th>
                            <td class="px-6 py-4 dark:text-white">
                                {{ $contact->type_tel }}
                            </td>
                            <td class="px-6 py-4 dark:text-white">
                                {{ $contact->personnel_autre }}
                            </td>
                            <td class="px-6 py-4 dark:text-white">
                                {{ $contact->proprietaire }}
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" data-modal-target="edit-contact-modal"
                                    data-modal-toggle="edit-contact-modal" data-id="{{ $contact->key_tel }}"
                                    class="edit-contact-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <button type="button" data-modal-target="delete-contact-modal"
                                    data-modal-toggle="delete-contact-modal" data-id="{{ $contact->key_tel }}"
                                    class="delete-contact-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    <svg class="w-4 h-4 " fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</section>
