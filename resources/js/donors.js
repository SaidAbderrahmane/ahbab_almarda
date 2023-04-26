document.addEventListener('click', async (event) => {
  if (event.target.closest('button[data-modal-toggle="edit-donor-modal"]')) {
    // use closest() method to check if the clicked element or any of its ancestors is the button
    const button = event.target.closest('button[data-modal-toggle="edit-donor-modal"]');
    const rowId = button.getAttribute('data-id');
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

      })
      .catch((error) => {
        console.error(error);
      });
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