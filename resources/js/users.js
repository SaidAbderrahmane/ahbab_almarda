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
        
        // update form values
        modalInput1.value = response.data.data.key_user;
        modalInput2.value = response.data.data.name;
        modalInput3.value = response.data.data.email;
        modalInput4.value = response.data.data.role;

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