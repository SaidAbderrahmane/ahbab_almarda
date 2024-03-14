document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="edit-compaign-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="edit-compaign-modal"]');
    const rowId = button.getAttribute('data-id');
    console.log(rowId);
    document.getElementById('loader').classList.remove('hidden');
    await axios.get(`/compaigns/${rowId}/get`)
      .then((response) => {

        console.log(rowId);
        console.log(response);
        const modalForm = document.querySelector('#edit-compaign-modal form');
        const modalInput1 = modalForm.querySelector(
          'input[name="key_operation"]');
        const modalInput2 = modalForm.querySelector('input[name="nom_operation"]');
        const modalInput3 = modalForm.querySelector('input[name="num_operation"]');
        const modalInput4 = modalForm.querySelector('input[name="date_operation"]');
        const modalInput5 = modalForm.querySelector('select[name="genre"]');
        const modalInput6 = modalForm.querySelector('select[name="key_lieu"]');
        const modalInput7 = modalForm.querySelector('input[name="hopital"]');
        
        // update form values
        modalInput2.value = response.data.data.nom_operation;
        modalInput3.value = response.data.data.num_operation;
        modalInput4.value = new Date(response.data.data.date_operation).toLocaleDateString("fr-FR");
        modalInput5.value = response.data.data.genre;
        modalInput6.value = response.data.data.key_lieu;
        modalInput7.value = response.data.data.hopital;

        // update form action
        modalForm.setAttribute('action', `/compaigns/${rowId}`);
        document.getElementById('loader').classList.add('hidden');
      })
      .catch((error) => {
        console.error(error);
      });
  }
});

document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="delete-compaign-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="delete-compaign-modal"]');
    const rowId = button.getAttribute('data-id');
    console.log(rowId)
    const modalForm = document.querySelector('#delete-compaign-modal form');
    // update form action
    modalForm.setAttribute('action', `/compaigns/${rowId}/delete`);
    
  }
});