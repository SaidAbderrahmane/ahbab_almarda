var contacts = [];
// set the modal menu element
const deleteContactModalTarget = document.getElementById('delete-contact-modal');
const editContactModalTarget = document.getElementById('edit-contact-modal');
const addContactModalTarget = document.getElementById('add-contact-modal');
const addDonorModalTarget = document.getElementById('add-donor-modal');

const options = {
  backdrop: 'dynamic',
  backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-50',
  closable: true,
  onHide: () => {
      console.log('modal is hidden');
  },
  onShow: () => {
      console.log('modal is shown');
  },
  onToggle: () => {
      console.log('modal has been toggled');
  }
};

const deleteContactModal = new Modal(deleteContactModalTarget);
const editContactModal = new Modal(editContactModalTarget);
const addContactModal = new Modal(addContactModalTarget);
const addDonorModal = new Modal(addDonorModalTarget);

document.querySelector('#close-edit-contact-modal').addEventListener('click', function () {
  editContactModal.hide();
})

document.querySelectorAll('.close-delete-contact-modal').forEach(button => {
  button.addEventListener('click', function () {
    deleteContactModal.hide();
  })
});

async function loadDonor() {
  let rowId = document.querySelector('.add-contact-button').getAttribute("data-id");
  await axios.get(`/donors/${rowId}`)
    .then((response) => {
      console.log(response);
      const modalForm = document.querySelector('#edit-donor-modal form');
      const modalInput1 = modalForm.querySelector(
        'input[name="key_tiers"]');
      const modalInput2 = modalForm.querySelector('input[name="nom_prenom"]');
      const modalInput3 = modalForm.querySelector('input[name="pere"]');
      const modalInput4 = modalForm.querySelector('input[name="grand_pere"]');
      const modalInput5 = modalForm.querySelector('select[name="groupage"]');
      const modalInput6 = modalForm.querySelector('input[name="date_naissance"]');
      const modalInput7 = modalForm.querySelector('select[name="sexe"]');
      const modalInput8 = modalForm.querySelector('input[name="adresse"]');
      const modalInput9 = modalForm.querySelector('select[name="key_agherme"]');
      const modalInput10 = modalForm.querySelector('input[name="code_barres"]');

      // update form values
      modalInput1.value = response.data.data.key_tiers;
      modalInput2.value = response.data.data.nom_prenom;
      modalInput3.value = response.data.data.pere;
      modalInput4.value = response.data.data.grand_pere;
      modalInput5.value = response.data.data.groupage;
      modalInput6.value = new Date(response.data.data.date_naissance).toLocaleDateString("fr-FR");
      modalInput7.value = response.data.data.sexe;
      modalInput8.value = response.data.data.adresse;
      modalInput9.value = response.data.data.key_agherme;
      modalInput10.value = response.data.data.code_barres;

      // update form action
      modalForm.setAttribute('action', `/donors/${rowId}`);

      //contacts table
      const contactsTable = document.querySelector('#edit-donor-modal tbody');
      contacts = response.data.data.contacts;
      // /console.log(contacts);
      contactsTable.innerHTML = "";
      for (const contact of contacts) {
        contactsTable.innerHTML = contactsTable.innerHTML + `
        <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-700 text-black" >
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">`+
          contact.tel_email + `
            </th>
            <td class="px-6 py-4 dark:text-white"">
              `+ contact.type_tel + `
            </td>
            <td class="px-6 py-4 dark:text-white"">
              `+ contact.personnel_autre + `
            </td>
            <td class="px-6 py-4 dark:text-white"">
                `+ contact.proprietaire + `
            </td>
            <td class="px-6 py-4">
            <button type="button" data-modal-target="edit-contact-modal"  data-modal-toggle="edit-contact-modal" data-id="`+ contact.key_tel + `"
            class="edit-contact-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                <path fill-rule="evenodd"
                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                    clip-rule="evenodd"></path>
            </svg>  
            </button> 
            <button type="button" data-modal-target="delete-contact-modal"  data-modal-toggle="delete-contact-modal" data-id="`+ contact.key_tel + `"
                class="delete-contact-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                <svg class="w-4 h-4 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            </td>
        </tr>`;
      };
    })
    .catch((error) => {
      console.error(error);
    });
}

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="edit-donor-modal"]')) {
    let button = event.target.closest('button[data-modal-toggle="edit-donor-modal"]');
    const rowId = button.getAttribute('data-id');
    document.querySelector('.add-contact-button').setAttribute("data-id", rowId);
    loadDonor();
  }
});

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="delete-donor-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="delete-donor-modal"]');
    const rowId = button.getAttribute('data-id');
    console.log(rowId)
    const modalForm = document.querySelector('#delete-donor-modal form');
    // update form action
    modalForm.setAttribute('action', `/donors/${rowId}/delete`);
  }
});


//handling CRUD requests using axios after forms submissions
const addContactButtons = document.querySelectorAll('.add-contact-button');
const editContactButtons = document.querySelectorAll('.edit-contact-button');
const deleteContactButtons = document.querySelectorAll('.delete-contact-button');

addContactButtons.forEach(button => {
  button.addEventListener('click', async function (event) {
    addContactFrom.querySelector("input[name=key_tiers]").value = button.getAttribute("data-id");
  })
})

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="edit-contact-modal"]')) {
    const button = event.target.closest('button[data-modal-toggle="edit-contact-modal"]');
    const rowId = button.getAttribute('data-id');
    const modalForm = document.querySelector('#edit-contact-modal form');   // update form action
    modalForm.setAttribute('action', `/contacts/${rowId}/update`);

    const tel_email_input = modalForm.querySelector('input[name="tel_email"]');
    const proprietaire_input = modalForm.querySelector('input[name="proprietaire"]');
    const type_tel_input = modalForm.querySelector('select[name="type_tel"]');
    const personnel_autre_input = modalForm.querySelector('select[name="personnel_autre"]');

    let contact = contacts.filter(element => element.key_tel == rowId)[0];
    tel_email_input.value = contact.tel_email;
    proprietaire_input.value = contact.proprietaire;
    type_tel_input.value = contact.type_tel;
    personnel_autre_input.value = contact.personnel_autre;

    editContactModal.show();
  }
});

/* deleteContactButtons. */
document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="delete-contact-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="delete-contact-modal"]');
    const rowId = button.getAttribute('data-id');
    const modalForm = document.querySelector('#delete-contact-modal form');
    // update form action
    modalForm.setAttribute('action', `/contacts/${rowId}/delete`);
    deleteContactModal.show();
  }
});



//handling CRUD requests using axios after forms submissions
const addDonorFrom = document.querySelector('#add-donor-modal form');
const addContactFrom = document.querySelector('#add-contact-modal form');
const editContactFrom = document.querySelector('#edit-contact-modal form');
const deleteContactFrom = document.querySelector('#delete-contact-modal form');

addDonorFrom.addEventListener('submit', async function (event) {
  event.preventDefault();
  const formData = new FormData(addDonorFrom);
  console.log(formData);
  await axios.post('/donors/add', formData).then((response) => {
    addDonorModal.hide();
    addContactFrom.querySelector("input[name=key_tiers]").value = response.data.donor.key_tiers;
    addContactModal.show();
  }).catch((error) => {
    console.log(error);
  });
});


addContactFrom.addEventListener('submit', async function (event) {
  event.preventDefault();
  const formData = new FormData(addContactFrom);
  console.log(formData);
  await axios.post('/contacts/add', formData).then((response) => {
    console.log(response.data);
    addContactModal.hide();
    loadDonor();
  }).catch((error) => {
    console.error(error);
  });
});

editContactFrom.addEventListener('submit', async function (event) {
  event.preventDefault();
  const formData = new FormData(editContactFrom);
  console.log(formData);
  await axios.post(editContactFrom.action, formData).then((response) => {
    console.log(response.data);
    editContactModal.hide();
    loadDonor();
  }).catch((error) => {
    console.error(error);
  });
})

deleteContactFrom.addEventListener('submit', async function (event) {
  event.preventDefault();
  const formData = new FormData(deleteContactFrom);
  await axios.delete(deleteContactFrom.action, formData).then((response) => {
    console.log(response.data);
    deleteContactModal.hide();
    loadDonor();
  }).catch((error) => {
    console.error(error);
  });
})
