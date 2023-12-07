

document.addEventListener('DOMContentLoaded', () => {
  const sidebarButton = document.querySelector(".sidebar-btn");
  const sidebar = document.querySelector(".sidebar");
  const mainContainer = document.querySelector(".main-container");
  const logoContainer = document.querySelector(".logo-container");
  const textMenu = document.querySelector(".text-menu");

  console.log(sidebarButton)

  if (sidebarButton) {
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
  }
})


document.addEventListener('DOMContentLoaded', () => {
  const hamburgerMenu_el = document.querySelector('.hamburger-menu');
  const line1_el = document.querySelector('.line-1');
  const line2_el = document.querySelector('.line-2');
  const menu_el = document.querySelector('.menu');

  if (hamburgerMenu_el) {
    if (event.target === hamburgerMenu_el) {
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
    }
  }
})

document.addEventListener('DOMContentLoaded', () => {
  const sortButton = document.querySelector(".btn-sort");
  const sortList = document.querySelector(".sort-list");

  if (sortButton) {
    sortButton.addEventListener('click', () => {
      sortList.classList.toggle('d-none');
    })
  }
})

document.addEventListener('DOMContentLoaded', e => {
  /* This section is used for handle button in history menu user */
  const buttonDetail_el = document.querySelector('.button-detail-history');
  const modalDetail_el = document.querySelector('.modal-detail-container');
  const buttonBack_el = document.querySelector('.button-back-history');
  const buttonRejectLoan_el = document.querySelector('.button-reject-loan');
  const buttonApproveLoan_el = document.querySelector('.button-approve-loan');

  if (buttonDetail_el) {
    buttonDetail_el.addEventListener('click', () => {
      modalDetail_el.classList.remove('d-none');
    })
  }
})

document.addEventListener('DOMContentLoaded', () => {
  const descriptionForm_el = document.querySelector('.admin-retrieval-information');

  if (descriptionForm_el) {
    descriptionForm_el.value = 'Silahkan melakukan pengambilan barang di ruang teknisi lantai 7';
    descriptionForm_el.addEventListener('focus', () => {
      descriptionForm_el.value = '';
    });
  }
})

document.addEventListener('DOMContentLoaded', () => {
  const itemChoose = document.querySelector('.form-choose');
  const formChooseInputLoan = document.querySelectorAll('.form-choose-input-loan');

  if (itemChoose && formChooseInputLoan) {
    itemChoose.reset();
    formChooseInputLoan.forEach(input => {
      input.addEventListener('click', () => {
        if (input.classList.contains('form-choose-input-loan-non-active') && !input.checked) {
          input.classList.remove('form-choose-input-loan-non-active');
          input.classList.add('form-choose-input-loan-active');
          input.checked = true;
        } else {
          input.classList.remove('form-choose-input-loan-active');
          input.classList.add('form-choose-input-loan-non-active');
          input.checked = false;
        }
      })
    })
  }
})

document.addEventListener('DOMContentLoaded', () => {
  const loanButtons = document.querySelectorAll('.loan-button');
  const confirmationModalContainer = document.querySelector('.confirmation-modal-container');
  const confirmationModalClose = document.querySelector('.confirmation-modal-close');
  const dateModalButtons = document.querySelectorAll('.date-modal-button');
  const calendarModalContainer = document.querySelector('.calendar-modal-container');
  const dateModalClose = document.querySelector('.date-modal-close');
  const loanDetailsButtonApproval = document.querySelector('.loan--details-button--approval');
  const modalDetailContainer = document.querySelector('.modal-detail-container');

  if (loanButtons && confirmationModalContainer) {
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
  }
})

// Function to open the modal confirmation when the user clicks on the loan

document.addEventListener('click', event => {

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
    if (loanButton) {
      if (total > 0) {
        loanButton.disabled = false;
        loanButton.textContent = `Pinjam (${total})`;
      } else {
        loanButton.disabled = true;
        loanButton.textContent = `Pinjam (${total})`;
      }
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
})
/* This section is for handle counter */


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

document.addEventListener('click', event => {
  const hamburgerNavbar = document.querySelector(".hamburger-nav");
  const navMenu_el = document.querySelector('.nav-menu');
  const navLink_el = document.querySelectorAll('.nav-link');

  if (event.target === hamburgerNavbar) {
    navMenu_el.classList.toggle('nav-menu-active');
    navLink_el.forEach(link => {
      link.addEventListener('click', () => {
        navMenu_el.classList.remove('nav-menu-active');
      })
    })
  }

  const navbar_el = document.querySelector('.nav');

  let lastScrollTop = 0;
  window.addEventListener('scroll', () => {/*  */
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
      if (navbar_el.classList.contains('nav-scroll-down')) {
        navbar_el.classList.replace('nav-scroll-down', 'nav-scroll-up');
      } else {
        navbar_el.classList.add('nav-scroll-up');
      }
    } else {
      navbar_el.classList.replace('nav-scroll-up', 'nav-scroll-down');
    }
    lastScrollTop = scrollTop;
  })
})