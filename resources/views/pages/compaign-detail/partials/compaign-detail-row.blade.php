<tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
    <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-1" aria-describedby="checkbox-1" type="checkbox"
                class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-1" class="sr-only">checkbox</label>
        </div>
    </td>
    <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
        <img class="w-10 h-10 rounded-full bg-blue-200"
            src="{{ $compaign->genre == 'H' ? asset('imgs/profile.png') : asset('imgs/profile-woman.png')}}"
            alt="avatar">
        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
            <div class="text-base font-semibold text-gray-900 dark:text-white">
                {{ $compaign_line->donneur->nom_prenom }}
            </div>
            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $compaign_line->donneur->groupage }}</div>
        </div>
    </td>
    <td
        class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
        {{$compaign_line->donneur->pere }}</td>
    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{$compaign_line->donneur->grand_pere }}</td>
    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $compaign_line->accepte }}</td>
    <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white">
        {{ $compaign_line->matricule}}
    </td>
    <td class="p-4 space-x-2 whitespace-nowrap">
        <button type="button" data-modal-toggle="edit-compaign-details-modal" data-id={{ $compaign_line->key_detail_operation }}
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                <path fill-rule="evenodd"
                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                    clip-rule="evenodd"></path>
            </svg>
           
        </button>
        <button type="button" data-modal-toggle="delete-compaign-details-modal" data-id={{ $compaign_line->key_detail_operation }} 
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
            <svg class="w-4 h-4 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </td>
</tr>
