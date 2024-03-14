// set the dropdown menu element
const $targetEl = document.getElementById('dropdownSearch');
const $targetE2 = document.getElementById('dropdownSearchEdit');

// set the element that trigger the dropdown menu on click
const $triggerEl = document.getElementById('dropdownSearchButton');
const $triggerE2 = document.getElementById('dropdownSearchButtonEdit');

const dropdown = new Dropdown($targetEl, $triggerEl);
const dropdownEdit = new Dropdown($targetE2, $triggerE2);


const donorsSearchInput = document.querySelector('#input-group-search');
const donorsSearchInputEdit = document.querySelector('#input-group-search-edit');

donorsSearchInput.addEventListener('input', async (event) => {
    await search();
});
donorsSearchInputEdit.addEventListener('input', async (event) => {
    await searchEdit();
});

function updateKeyTiers(obj) {
    document.querySelector("#key_tiers").value = obj.value;
    document.querySelector("#dropdownSearchButton").innerHTML = obj.innerHTML;
    dropdown.hide();
}

async function search() {
    let searchTerm = donorsSearchInput.value;
    document.getElementById('loader').classList.remove('hidden');
    await axios.get('/api/donors', { params: { q: searchTerm } }).then((response) => {
        console.log(response);
        const modalForm = document.querySelector('#add-compaign-details-modal form');
        const modalInput1 = modalForm.querySelector(
            '#donors-list');
        const donors = response.data.data;
        modalInput1.innerHTML = "";
        for (const iterator of donors) {
            modalInput1.innerHTML = modalInput1.innerHTML +
                `<li>
            <button type="button" value="`+ iterator.key_tiers + `" class="selectDonor flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
              <img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
              `+ iterator.nom_prenom + `/` + iterator.pere + `
            </button>
        </li>`;
        }
        const buttons = document.querySelectorAll(".selectDonor");
        buttons.forEach(button => {
            button.addEventListener('click', (event) => {
                updateKeyTiers(event.target);
            });
        });
        document.getElementById('loader').classList.add('hidden');
    }).catch((error) => {
        console.error(error);
    });

}

async function searchEdit() {
    let searchTerm = donorsSearchInputEdit.value;
    await axios.get('/api/donors', { params: { q: searchTerm } }).then((response) => {
        console.log(response);
        const modalForm = document.querySelector('#edit-compaign-details-modal form');
        const modalInput1 = modalForm.querySelector(
            '#donors-list-edit');
        const donors = response.data.data;
        modalInput1.innerHTML = "";
        for (const iterator of donors) {
            modalInput1.innerHTML = modalInput1.innerHTML +
                `<li>
            <button type="button" value="`+ iterator.key_tiers + `" class="selectDonor flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
              <img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
              `+ iterator.nom_prenom + `/` + iterator.pere + `
            </button>
        </li>`;
        }
        const buttons = document.querySelectorAll(".selectDonor");
        buttons.forEach(button => {
            button.addEventListener('click', (event) => {
                updateKeyTiers(event.target);
            });
        });

    }).catch((error) => {
        console.error(error);
    });

}

function updateKeyTiersEdit(obj) {
    document.querySelector("#key_tiers_edit").value = obj.value;
    document.querySelector("#dropdownSearchButtonEdit").innerHTML = obj.innerHTML;
    dropdownEdit.hide();
}

//  add modal actions

document.addEventListener('click', async (event) => {
    if (event.target.closest('button[data-modal-toggle="add-compaign-details-modal"]')) {
        // use closest() method to check if the clicked element or any of its ancestors is the button
        const button = event.target.closest('button[data-modal-toggle="add-compaign-details-modal"]');
        let page = 1;
        donorsSearchInput.value = "";
        await axios.get('/api/donors?', { params: { page: page } }).then((response) => {
            console.log(response);
            const modalForm = document.querySelector('#add-compaign-details-modal form');
            const modalInput1 = modalForm.querySelector(
                '#donors-list');
            const donors = response.data.data;
            modalInput1.innerHTML = "";
            for (const iterator of donors) {
                modalInput1.innerHTML = modalInput1.innerHTML +
                    `<li>
                    <button type="button" value="`+ iterator.key_tiers + `" class="selectDonor flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
                    `+ iterator.nom_prenom + `/` + iterator.pere + `
                    </button>
                </li>`;
            }
            const buttons = document.querySelectorAll(".selectDonor");
            buttons.forEach(button => {
                button.addEventListener('click', (event) => {
                    updateKeyTiers(event.target);
                });
            });

        }).catch((error) => {
            console.error(error);
        });
    }
    if (event.target.closest('#loadButton')) {
        let page = document.querySelector('#loadButton').getAttribute('page');
        page++;
        document.querySelector('#loadButton').setAttribute('page', page);
        let searchTerm = donorsSearchInput.value;
        await axios.get('/api/donors', { params: { q: searchTerm, page: page } }).then((response) => {
            console.log(response);
            const modalForm = document.querySelector('#add-compaign-details-modal form');
            const modalInput1 = modalForm.querySelector(
                '#donors-list');
            const donors = response.data.data;
            for (const iterator of donors) {
                modalInput1.innerHTML = modalInput1.innerHTML +
                    `<li>
                        <button type="button"  value="`+ iterator.key_tiers + `" class="selectDonor flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                          <img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
                          `+ iterator.nom_prenom + `/` + iterator.pere + `
                        </button>
                    </li>`;
            }
            const buttons = document.querySelectorAll(".selectDonor");
            buttons.forEach(button => {
                button.addEventListener('click', (event) => {
                    updateKeyTiers(event.target);
                });
            });
        }).catch((error) => {
            console.error(error);
        });
    }
});



//edit modal actions

document.addEventListener('click', async (event) => {
    if (event.target.closest('button[data-modal-toggle="edit-compaign-details-modal"]')) {
        // use closest() method to check if the clicked element or any of its ancestors is the button
        const button = event.target.closest('button[data-modal-toggle="edit-compaign-details-modal"]');
        let page = 1;
        donorsSearchInput.value = "";
        await axios.get('/api/donors?', { params: { page: page } }).then((response) => {
            console.log(response);
            const modalForm = document.querySelector('#edit-compaign-details-modal form');
            const modalInput1 = modalForm.querySelector(
                '#donors-list-edit');
            const donors = response.data.data;
            modalInput1.innerHTML = "";
            for (const iterator of donors) {
                modalInput1.innerHTML = modalInput1.innerHTML +
                    `<li>
                    <button type="button" value="`+ iterator.key_tiers + `" class="selectDonor flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
                    `+ iterator.nom_prenom + `/` + iterator.pere + `
                    </button>
                </li>`;
            }
            const buttons = document.querySelectorAll(".selectDonor");
            buttons.forEach(button => {
                button.addEventListener('click', (event) => {
                    updateKeyTiersEdit(event.target);
                });
            });

        }).catch((error) => {
            console.error(error);
        });
    }
    if (event.target.closest('#loadButtonEdit')) {
        let page = document.querySelector('#loadButtonEdit').getAttribute('page');
        page++;
        document.querySelector('#loadButtonEdit').setAttribute('page', page);
        let searchTerm = donorsSearchInput.value;
        await axios.get('/api/donors', { params: { q: searchTerm, page: page } }).then((response) => {
            console.log(response);
            const modalForm = document.querySelector('#edit-compaign-details-modal form');
            const modalInput1 = modalForm.querySelector(
                '#donors-list-edit');
            const donors = response.data.data;
            for (const iterator of donors) {
                modalInput1.innerHTML = modalInput1.innerHTML +
                    `<li>
                        <button type="button"  value="`+ iterator.key_tiers + `" class="selectDonor flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                          <img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
                          `+ iterator.nom_prenom + `/` + iterator.pere + `
                        </button>
                    </li>`;
            }
            const buttons = document.querySelectorAll(".selectDonor");
            buttons.forEach(button => {
                button.addEventListener('click', (event) => {
                    updateKeyTiersEdit(event.target);
                });
            });
        }).catch((error) => {
            console.error(error);
        });
    }
});


//edit modal
document.addEventListener('click', async (event) => {
    //edit
    if (event.target.closest('button[data-modal-toggle="edit-compaign-details-modal"]')) {
        // use closest() method to check if the clicked element or any of its ancestors is the button
        const button = event.target.closest('button[data-modal-toggle="edit-compaign-details-modal"]');
        const rowId = button.getAttribute('data-id');
        console.log(rowId);

        document.getElementById('loader').classList.remove('hidden');
        await axios.get(`/compaign-details/${rowId}/get`)
            .then((response) => {

                console.log(rowId);
                console.log(response);
                const modalForm = document.querySelector('#edit-compaign-details-modal form');
                const modalInput1 = modalForm.querySelector(
                    'input[name="key_tiers"]');
                const modalInput3 = modalForm.querySelector('input[name="par_viber"]');
                const modalInput4 = modalForm.querySelector('input[name="par_sms"]');
                const modalInput5 = modalForm.querySelector('input[name="par_annonce"]');
                const modalInput6 = modalForm.querySelector('input[name="par_facebook"]');
                const modalInput7 = modalForm.querySelector('input[name="accepte"]');
                const modalInput8 = modalForm.querySelector('textarea[name="observation"]');
                const modalInput9 = modalForm.querySelector('input[name="matricule"]');

                // update form values
                modalInput1.value = response.data.data.key_tiers;
                document.querySelector("#dropdownSearchButtonEdit").innerHTML = `<img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
                `+ response.data.data.nom_prenom + `/` + response.data.data.pere + ``;
                modalInput3.value = response.data.data.par_viber;
                modalInput3.value == 'O' ? modalInput3.checked = true : null;
                modalInput4.value = response.data.data.par_sms;
                modalInput4.value == 'O' ? modalInput4.checked = true : null;
                modalInput5.value = response.data.data.par_annonce;
                modalInput5.value == 'O' ? modalInput5.checked = true : null;
                modalInput6.value = response.data.data.par_facebook;
                modalInput6.value == 'O' ? modalInput6.checked = true : null;
                modalInput7.value = response.data.data.accepte;
                modalInput7.value == 'O' ? modalInput7.checked = true : null;
                modalInput8.value = response.data.data.observation;
                modalInput9.value = response.data.data.matricule;

                // update form action
                modalForm.setAttribute('action', `/compaign-details/${rowId}`);
                document.getElementById('loader').classList.add('hidden');

            })
            .catch((error) => {
                console.error(error);
            });
    }
});

document.addEventListener('click', async (event) => {
    if (event.target.closest('button[data-modal-toggle="delete-compaign-details-modal"]')) {
        // use closest() method to check if the clicked element or any of its ancestors is the button
        const button = event.target.closest('button[data-modal-toggle="delete-compaign-details-modal"]');
        const rowId = button.getAttribute('data-id');
        console.log(rowId)
        const modalForm = document.querySelector('#delete-compaign-details-modal form');
        // update form action
        modalForm.setAttribute('action', `/compaign-details/${rowId}/delete`);

    }
});


const addContactModalTarget = document.getElementById('add-contact-modal');
const addDonorModalTarget = document.getElementById('add-donor-modal');

const addContactModal = new Modal(addContactModalTarget);
const addDonorModal = new Modal(addDonorModalTarget);


const addCompaignDetailFrom = document.querySelector('#add-compaign-details-modal form');
const editCompaignDetailFrom = document.querySelector('#edit-compaign-details-modal form');
const addDonorFrom = document.querySelector('#add-donor-modal form');
const addContactFrom = document.querySelector('#add-contact-modal form');

addDonorFrom.addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(addDonorFrom);
    console.log(formData);
    await axios.post('/donors/add', formData).then((response) => {
        addDonorModal.hide();
        addContactFrom.querySelector("input[name=key_tiers]").value = response.data.donor.key_tiers;
        addCompaignDetailFrom.querySelector("input[name=key_tiers]").value = response.data.donor.key_tiers;
        addCompaignDetailFrom.querySelector("#dropdownSearchButton").innerHTML = `<img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
        `+ response.data.donor.nom_prenom + `/` + response.data.donor.pere + ``;
        editCompaignDetailFrom.querySelector("#dropdownSearchButtonEdit").innerHTML = `<img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
        `+ response.data.donor.nom_prenom + `/` + response.data.donor.pere + ``;
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
    }).catch((error) => {
        console.error(error);
    });
});