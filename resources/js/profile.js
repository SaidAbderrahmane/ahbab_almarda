var contacts = [];

// set the modal menu element
const deleteContactModalTarget = document.getElementById('delete-contact-modal');
const editContactModalTarget = document.getElementById('edit-contact-modal');
const addContactModalTarget = document.getElementById('add-contact-modal');

const deleteContactModal = new Modal(deleteContactModalTarget);
const editContactModal = new Modal(editContactModalTarget);
const addContactModal = new Modal(addContactModalTarget);

//handling CRUD requests using axios after forms submissions
const addContactButtons = document.querySelectorAll('.add-contact-button');
const editContactButtons = document.querySelectorAll('.edit-contact-button');
const deleteContactButtons = document.querySelectorAll('.delete-contact-button');

const addContactFrom = document.querySelector('#add-contact-modal form');
const editContactFrom = document.querySelector('#edit-contact-modal form');
const deleteContactFrom = document.querySelector('#delete-contact-modal form');

document.querySelector('#close-edit-contact-modal').setAttribute('data-modal-toggle','edit-contact-modal');

document.querySelectorAll('.close-delete-contact-modal').forEach(button => {
  button.setAttribute('data-modal-toggle','delete-contact-modal');
});

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


    var tiersId = document.querySelector("#profile-info-form input[name=key_tiers]").value;
    console.log(tiersId);
    axios.get('tiers/' + tiersId + '/contacts')
      .then(res => {
        contacts = res.data.contacts;
        console.log(contacts);
        let contact = contacts.filter(element => element.key_tel == rowId)[0];
        tel_email_input.value = contact.tel_email;
        proprietaire_input.value = contact.proprietaire;
        type_tel_input.value = contact.type_tel;
        personnel_autre_input.value = contact.personnel_autre;
      })
      .catch(err => {
        console.error(err);
      });

    //editContactModal.show();
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
  //  deleteContactModal.show();
  }
});


addContactFrom.addEventListener('submit', async function (event) {
  event.preventDefault();
  const formData = new FormData(addContactFrom);
  console.log(formData);
  await axios.post('/contacts/add', formData).then((response) => {
    console.log(response.data);
    addContactModal.hide();
    location.reload()
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
    location.reload()
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
    location.reload()
  }).catch((error) => {
    console.error(error);
  });
})
