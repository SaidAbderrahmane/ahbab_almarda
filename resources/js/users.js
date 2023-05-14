// set the dropdown menu element
const $targetEl = document.getElementById('dropdownSearch');
const $targetE2 = document.getElementById('dropdownSearchEdit');

// set the element that trigger the dropdown menu on click
const $triggerEl = document.getElementById('dropdownSearchButton');
const $triggerE2 = document.getElementById('dropdownSearchButtonEdit');

const dropdown = new Dropdown($targetEl, $triggerEl);
const dropdownEdit = new Dropdown($targetE2, $triggerE2);

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="edit-user-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="edit-user-modal"]');
    const rowId = button.getAttribute('data-id');
    await axios.get(`/users/${rowId}`)
      .then((response) => {

        console.log(response);
        const modalForm = document.querySelector('#edit-user-modal form');
        const modalInput1 = modalForm.querySelector(
          'input[name="key_user"]');
        const modalInput2 = modalForm.querySelector('input[name="name"]');
        const modalInput3 = modalForm.querySelector('input[name="email"]');
        const modalInput4 = modalForm.querySelector('select[name="role"]');
        const modalInput5 = modalForm.querySelector('input[name="key_tiers"]');

        
        // update form values
        modalInput1.value = response.data.data.key_user;
        modalInput2.value = response.data.data.name;
        modalInput3.value = response.data.data.email;
        modalInput4.value = response.data.data.role;
        modalInput5.value = response.data.data.key_tiers;
        document.querySelector("#dropdownSearchButtonEdit").innerHTML = `<img class="w-6 h-6 mr-2 rounded-full" src="/imgs/profile.png" alt="user">
        `+ response.data.data.nom_prenom + `/` + response.data.data.pere + ``;

        // update form action
        modalForm.setAttribute('action', `/users/${rowId}`);

      })
      .catch((error) => {
        console.error(error);
      });
  }
});

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="delete-user-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="delete-user-modal"]');
    const rowId = button.getAttribute('data-id');
    console.log(rowId)
    const modalForm = document.querySelector('#delete-user-modal form');
    // update form action
    modalForm.setAttribute('action', `/users/${rowId}/delete`);
    
  }
});

//////////////// tiers modal--

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
    await axios.get('/api/donors', { params: { q: searchTerm } }).then((response) => {
        console.log(response);
        const modalForm = document.querySelector('#add-user-modal form');
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

async function searchEdit() {
    let searchTerm = donorsSearchInputEdit.value;
    await axios.get('/api/donors', { params: { q: searchTerm } }).then((response) => {
        console.log(response);
        const modalForm = document.querySelector('#edit-user-modal form');
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
    if (event.target.closest('button[data-modal-toggle="add-user-modal"]')) {
        // use closest() method to check if the clicked element or any of its ancestors is the button
        const button = event.target.closest('button[data-modal-toggle="add-user-modal"]');
        let page = 1;
        donorsSearchInput.value = "";
        await axios.get('/api/donors?', { params: { page: page } }).then((response) => {
            console.log(response);
            const modalForm = document.querySelector('#add-user-modal form');
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
            const modalForm = document.querySelector('#add-user-modal form');
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
    if (event.target.closest('button[data-modal-toggle="edit-user-modal"]')) {
        // use closest() method to check if the clicked element or any of its ancestors is the button
        const button = event.target.closest('button[data-modal-toggle="edit-user-modal"]');
        let page = 1;
        donorsSearchInput.value = "";
        await axios.get('/api/donors?', { params: { page: page } }).then((response) => {
            console.log(response);
            const modalForm = document.querySelector('#edit-user-modal form');
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
            const modalForm = document.querySelector('#edit-user-modal form');
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
