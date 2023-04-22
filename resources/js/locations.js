document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="edit-location-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="edit-location-modal"]');
    const rowId = button.getAttribute('data-id');
    await axios.get(`/locations/${rowId}`)
      .then((response) => {

        console.log(response);
        const modalForm = document.querySelector('#edit-location-modal form');
        const modalInput1 = modalForm.querySelector(
          'input[name="key_lieu"]');
        const modalInput2 = modalForm.querySelector('input[name="nom_lieu"]');
        // update form values
        modalInput1.value = response.data.data.key_lieu;
        modalInput2.value = response.data.data.nom_lieu;
        // update form action
        modalForm.setAttribute('action', `/locations/${rowId}`);

      })
      .catch((error) => {
        console.error(error);
      });
  }
});

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="delete-location-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="delete-location-modal"]');
    const rowId = button.getAttribute('data-id');
    console.log(rowId)
    const modalForm = document.querySelector('#delete-location-modal form');
    // update form action
    modalForm.setAttribute('action', `/locations/${rowId}/delete`);
    
  }
});