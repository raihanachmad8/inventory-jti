document.addEventListener('DOMContentLoaded', () => {


  /* This section is used to handle sidebar */
  const sidebarButton = document.querySelector(".sidebar-btn");
  const sidebar = document.querySelector(".sidebar");
  const mainContainer = document.querySelector(".main-container");
  const logoContainer = document.querySelector(".logo-container");
  const textMenu = document.querySelector(".text-menu");

  sidebarButton.addEventListener('click', () => {
    sidebarButton.classList.toggle('sidebar-btn-rotate');
    if (sidebarButton.classList.contains('sidebar-btn-rotate')) {
      sidebar.style.width = '10vw';
      mainContainer.style.width = '90vw';
      logoContainer.classList.add('hidden');
      textMenu.classList.add('hidden');
    } else {
      sidebar.style.width = '20vw';
      mainContainer.style.width = '80vw';
      logoContainer.classList.remove('hidden');
      textMenu.classList.remove('hidden');
    }
  })


  /* This section is used to handle hamburger menu on mobile display */
  const hamburgerMenu_el = document.querySelector('.hamburger-menu');
  const line1_el = document.querySelector('.line-1');
  const line2_el = document.querySelector('.line-2');
  const menu_el = document.querySelector('.menu');

  hamburgerMenu_el.addEventListener('click', () => {
    if (line1_el.classList.contains('line-1-rotate')) {
      line1_el.classList.remove('line-1-rotate');
      line1_el.setAttribute('y', '11')
      line1_el.setAttribute('x', '0')
      line2_el.classList.remove('line-2-rotate');
      line2_el.setAttribute('y', '16')
      line2_el.setAttribute('x', '0')
    } else {
      line1_el.classList.add('line-1-rotate');
      line1_el.setAttribute('y', '-1')
      line1_el.setAttribute('x', '2')
      line2_el.classList.add('line-2-rotate');
      line2_el.setAttribute('x', '-15')
    }
  })


  /* This section is used for handle filter and sort */
  const filterButton = document.querySelector(".btn-filter");
  const filterList = document.querySelector(".filter-list");
  const sortButton = document.querySelector(".btn-sort");
  const sortList = document.querySelector(".sort-list");

  filterButton.addEventListener('click', () => {
    if (sortButton.classList.contains('d-none')) {
      filterList.classList.toggle('d-none');
    } else {
      sortList.classList.add('d-none');
      filterList.classList.toggle('d-none');
    }
  })

  sortButton.addEventListener('click', () => {
    if (filterButton.classList.contains('d-none')) {
      sortList.classList.toggle('d-none');
    } else {
      filterList.classList.add('d-none');
      sortList.classList.toggle('d-none');
    }
  });


  /* This section is used for handle button in history menu user */
  const buttonDetail_el = document.querySelector('.button-detail-history');
  const modalDetail_el = document.querySelector('.modal-detail-container');
  const buttonBack_el = document.querySelector('.button-back-history');
  const buttonRejectLoan_el = document.querySelector('.button-reject-loan');
  const buttonApproveLoan_el = document.querySelector('.button-approve-loan');

  buttonDetail_el.addEventListener('click', () => {
    modalDetail_el.classList.remove('d-none');
  })

  buttonBack_el.addEventListener('click', () => {
    modalDetail_el.classList.add('d-none');
  })

  buttonRejectLoan_el.addEventListener('click', () => {
    modalDetail_el.classList.add('d-none');
  })

  buttonApproveLoan_el.addEventListener('click', () => {
    modalDetail_el.classList.add('d-none');
  })

  /* this section is for approve admin retrieval */
  const descriptionForm_el = document.querySelector('.admin-retrieval-information');

  descriptionForm_el.value = 'Silahkan melakukan pengambilan barang di ruang teknisi lantai 7';
  descriptionForm_el.addEventListener('focus', () => {
    descriptionForm_el.value = '';
  });


  /* This section is for handle choose */
  const itemChoose = document.querySelector('.form-choose').reset();
  const formChooseInputLoan = document.querySelectorAll('.form-choose-input-loan');

  formChooseInputLoan.forEach(function (input) {
    input.addEventListener('click', function () {
      if (!input.classList.contains('form-choose-input-loan-non-active') && !input.checked) {
        input.classList.remove('form-choose-input-loan-non-active');
        input.classList.add('form-choose-input-loan-active');
        input.checked = true;
      } else {
        input.classList.remove('form-choose-input-loan-active');
        input.classList.add('form-choose-input-loan-non-active');
        input.checked = false;
      }
    });
  });


  /* This section is for handle modal */
  // Variables for classes
  const loanButtons = document.querySelectorAll('.loan-button');
  const confirmationModalContainer = document.querySelector('.confirmation-modal-container');
  const confirmationModalClose = document.querySelector('.confirmation-modal-close');
  const dateModalButtons = document.querySelectorAll('.date-modal-button');
  const calendarModalContainer = document.querySelector('.calendar-modal-container');
  const dateModalClose = document.querySelector('.date-modal-close');
  const loanDetailsButtonApproval = document.querySelector('.loan--details-button--approval');
  const modalDetailContainer = document.querySelector('.modal-detail-container');

  // Function to open the modal confirmation when the user clicks on the loan
  loanButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      if (!button.disabled) {
        confirmationModalContainer.classList.remove('d-none');
      }
    });
  });

  // Function to close the modal
  confirmationModalClose.addEventListener('click', function () {
    confirmationModalContainer.classList.add('d-none');
  });

  // Function to open the calendar modal when the user clicks on the date buttons
  document.addEventListener('click', function (event) {
    if (dateModalButtons.includes(event.target)) {
      calendarModalContainer.classList.remove('d-none');
    }
  });

  // Function to close the calendar modal
  document.addEventListener('click', function (event) {
    if (event.target === dateModalClose) {
      calendarModalContainer.classList.add('d-none');
    }
  });

  // Function to open the modal confirmation admin retrieval when the admin clicks on the detail button in dashboard menu
  loanDetailsButtonApproval.addEventListener('click', function () {
    modalDetailContainer.classList.remove('d-none');
  });


  /* This section is for handle counter */
  let total = 0;

  // Function to create a counter container
  function createCounterContainer() {
    return document.createElement('div');
  }

  // Function to create a counter label
  function createCounterLabel(text, className) {
    const label = document.createElement('label');
    label.setAttribute('for', 'pinjam');
    label.classList.add('btn-counter', className, 'btn', 'btn-primary');
    label.textContent = text;
    return label;
  }

  // Function to create a counter input
  function createCounterInput(value) {
    const input = document.createElement('input');
    input.setAttribute('id', 'pinjam');
    input.setAttribute('type', 'text');
    input.value = value;
    input.classList.add('counter-input', 'w-50', 'rounded', 'bg-dark-subtle');
    return input;
  }

  // Function to replace the pinjam button with a counter container
  function replaceWithCounterContainer(element, counter) {
    const counterContainer = createCounterContainer();
    counterContainer.classList.add('counter-container', 'w-100', 'd-flex', 'justify-content-between');

    const minusBtn = createCounterLabel('-', 'btn-counter-min');
    const counterInput = createCounterInput(counter);
    const plusBtn = createCounterLabel('+', 'btn-counter-plus');

    counterContainer.appendChild(minusBtn);
    counterContainer.appendChild(counterInput);
    counterContainer.appendChild(plusBtn);

    element.parentNode.replaceChild(counterContainer, element);
  }

  // Function to update the state of the loan button
  function updateLoanButtonState() {
    const loanButton = document.querySelector('.loan-button');
    if (total > 0) {
      loanButton.disabled = false;
      loanButton.textContent = `Pinjam (${total})`;
    } else {
      loanButton.disabled = true;
      loanButton.textContent = `Pinjam (${total})`;
    }
  }

  // Event listener for pinjam button click
  document.addEventListener('click', function (event) {
    if (event.target.classList.contains('inventory-item-button')) {
      let counter = 1;
      total++;

      replaceWithCounterContainer(event.target, counter);

      updateLoanButtonState();
    }

    // Event listener for btn-counter-plus click
    if (event.target.classList.contains('btn-counter-plus')) {
      let counter = parseInt(event.target.previousElementSibling.value) + 1;
      total++;

      event.target.previousElementSibling.value = counter;

      updateLoanButtonState();
    }

    // Event listener for btn-counter-min click
    if (event.target.classList.contains('btn-counter-min')) {
      let counter = parseInt(event.target.nextElementSibling.value) - 1;
      total--;

      if (counter > 0) {
        event.target.nextElementSibling.value = counter;
      } else {
        const counterContainer = event.target.closest('.counter-container');
        counterContainer.parentNode.replaceChild(createPinjamButton(), counterContainer);
      }

      updateLoanButtonState();
    }
  });

  // Function to create a pinjam button
  function createPinjamButton() {
    const button = document.createElement('button');
    button.classList.add('inventory-item-button', 'btn', 'btn-primary', 'w-100');
    button.setAttribute('type', 'button');
    button.textContent = 'Pinjam';
    return button;
  }

  // Initial state
  updateLoanButtonState();


  /* This is for modal */
  // Variables for elements
  const detailItemButton = document.querySelector('.button-detail-item');
  const detailItemModalContainer = document.querySelector('.detail-item-modal-container');
  const cancelButtonDetailItem = document.querySelector('.cancel-button-detail-item');
  const deleteButtonDetailItem = document.querySelector('.delete-button-detail-item');
  const deleteItemModalContainer = document.querySelector('.delete-item-modal-container');

  // Function to toggle modal visibility
  function toggleModal(modal) {
    if (modal) {
      modal.classList.toggle('d-none');
    }
  }

  // Event listener for detailItemButton click
  document.addEventListener('click', function (event) {
    if (event.target === detailItemButton) {
      toggleModal(detailItemModalContainer);
    }

    // Event listener for cancelButtonDetailItem click
    if (event.target === cancelButtonDetailItem) {
      toggleModal(detailItemModalContainer);
    }

    // Event listener for deleteButtonDetailItem click
    if (event.target === deleteButtonDetailItem) {
      toggleModal(deleteItemModalContainer);
    }
  });

})