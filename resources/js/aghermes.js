document.addEventListener('click', async (event) => {

  if (event.target.closest('button[data-modal-toggle="edit-agherme-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="edit-agherme-modal"]');
    const rowId = button.getAttribute('data-id');
    
    document.getElementById('loader').classList.remove('hidden');
    await axios.get(`/aghermes/${rowId}`)
      .then((response) => {

        console.log(response);
        const modalForm = document.querySelector('#edit-agherme-modal form');
        const modalInput1 = modalForm.querySelector(
          'input[name="key_agherme"]');
        const modalInput2 = modalForm.querySelector('input[name="agherme"]');
        // update form values
        modalInput1.value = response.data.data.key_agherme;
        modalInput2.value = response.data.data.agherme;
        // update form action
        modalForm.setAttribute('action', `/aghermes/${rowId}`);
        document.getElementById('loader').classList.add('hidden');

      })
      .catch((error) => {
        console.error(error);
      });
  }
});

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="delete-agherme-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="delete-agherme-modal"]');
    const rowId = button.getAttribute('data-id');

    const modalForm = document.querySelector('#delete-agherme-modal form');
    // update form action
    modalForm.setAttribute('action', `/aghermes/${rowId}/delete`);

  }
});