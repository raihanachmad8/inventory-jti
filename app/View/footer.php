</main>
</div>

<script>
  feather.replace();
</script>

<script>
  $(document).ready(function() {
    /* This function is used to update the state of the sidebar */
    $(".sidebar-btn").on("click", () => {
      $(".sidebar-btn").toggleClass("sidebar-btn-rotate");
      if ($(".sidebar-btn").hasClass("sidebar-btn-rotate")) {
        $(".sidebar").css("width", "10vw");
        $(".main-container").css("width", "90vw");
        $(".logo-container").addClass("hidden");
        $(".text-menu").addClass("hidden");
      } else {
        $(".sidebar").css("width", "20vw");
        $(".main-container").css("width", "80vw");
        $(".logo-container").removeClass("hidden");
        $(".text-menu").removeClass("hidden");
      }
    });

    /* This function is used to update the state of the filter */
    $('.btn-filter').on('click', () => {
      if ($('.btn-sort').hasClass('d-none')) {
        $('.filter-list').toggleClass('d-none');
      } else {
        $('.sort-list').addClass('d-none');
        $('.filter-list').toggleClass('d-none');
      }
    });

    /* This function is used to update the state of the sort */
    $('.btn-sort').on('click', () => {
      if ($('.btn-filter').hasClass('d-none')) {
        $('.sort-list').toggleClass('d-none');
      } else {
        $('.filter-list').addClass('d-none');
        $('.sort-list').toggleClass('d-none');
      }
    });

    /* This function is used to update the state of the hamburger menu */
    $('.hamburger-menu').on('click', () => {
      if ($('.line-1').hasClass('line-1-rotate')) {
        $('.menu').css('transform', 'translateY(-100%)');
        $('.line-1').removeClass('line-1-rotate');
        $('.line-1').attr('y', '11')
        $('.line-1').attr('x', '0')
        $('.line-2').removeClass('line-2-rotate');
        $('.line-2').attr('y', '16')
        $('.line-2').attr('x', '0')
      } else {
        $('.menu').css('transform', 'translateY(0)');
        $('.line-1').addClass('line-1-rotate');
        $('.line-1').attr('y', '-1')
        $('.line-1').attr('x', '2')
        $('.line-2').addClass('line-2-rotate');
        $('.line-2').attr('x', '-15')
      }
    });

    /* This function is used to add default value to the input field admin retrieval */
    $('.admin-retrieval-information').val('Silahkan melakukan pengambilan barang di ruang teknisi lantai 7');
    /* This function is used to reset the value of the input field when the admin click on the input */
    $('.admin-retrieval-information').on('focus', () => {
      $('.admin-retrieval-information').val('');
    });
  });
</script>

<script>
  /* This function is used to open the modal */
  $(document).on('click', '.button-detail-history', function() {
    $('.modal-detail-container').removeClass('d-none');
  })

  /* This function is used to close the modal */
  $(document).on('click', '.button-back-history', function() {
    $('.modal-detail-container').addClass('d-none');
  })

  /* This function is used to close the modal */
  $(document).on('click', '.button-reject-loan', function() {
    $('.modal-detail-container').addClass('d-none');
  })

  /* This function is used to close the modal */
  $(document).on('click', '.button-approve-loan', function() {
    $('.modal-detail-container').addClass('d-none');
  })
</script>

<!-- This script is used to update the state of the choose on loan menu -->
<script>
  $(document).ready(function() {
    $('.form-choose').trigger('reset');
    $('.form-choose-input-loan').on('click', function() {
      if ($(this).hasClass('form-choose-input-loan-non-active') && $(this).attr('checked') !== 'checked') {
        $(this).removeClass('form-choose-input-loan-non-active');
        $(this).addClass('form-choose-input-loan-active');
        $(this).attr('checked', 'checked');
      } else {
        $(this).removeClass('form-choose-input-loan-active');
        $(this).addClass('form-choose-input-loan-non-active');
        $(this).removeAttr('checked');
      }
    })
  })

  $(document).ready(function() {

    /* This function is used to open the modal confirmation when the user click on the loan */
    $('.loan-button').on('click', function() {
      if ($('.loan-button').attr('disabled') !== 'disabled') {
        $('.confirmation-modal-container').removeClass('d-none');
      }
    })

    /* This function is used to close the modal */
    $('.confirmation-modal-close').on('click', function() {
      $('.confirmation-modal-container').addClass('d-none');
    })

    /* This function is used to open the calendar modal when the user click on the Tanggal Peminjaman or Tanggal Pengembalian */
    $(document).on('click', '.date-modal-button', function() {
      $('.calendar-modal-container').removeClass('d-none');
    })

    /* This function is used to close the calendar modal */
    $(document).on('click', '.date-modal-close', function() {
      $('.calendar-modal-container').addClass('d-none');
    })

    /* This function is used to open the modal confirmation admin retrieval 
    when the admin click on the detail button in dashboard menu */
    $(document).on('click', '.loan--details-button--approval', function() {
      $('.modal-detail-container').removeClass('d-none');
    })
  })
</script>

<!-- This script is used to update the state of the loan button -->
<script>
  $(document).ready(function() {
    let total = 0;

    /* When the user click on the pinjam button, increment the counter and replace the pinjam button with a counter */
    $(document).on('click', '.inventory-item-button', function() {
      let counter = 1;
      total++;

      $(this).replaceWith(`
      <div class="counter-container w-100 d-flex justify-content-between">
        <label for="pinjam" class="btn-counter btn-counter-min btn btn-primary">-</label>
        <input id="pinjam" type="text" value="${counter}" class="counter-input w-50 rounded bg-dark-subtle">
        <label for="pinjam" class="btn-counter btn-counter-plus btn btn-primary">+</label>
      </div>
    `);

      updateLoanButtonState();
    });

    /* When the user clicks on the button, increment the counter */
    $(document).on('click', '.btn-counter-plus', function() {
      let counter = parseInt($(this).prev().val()) + 1;
      total++;

      $(this).prev().val(counter);

      updateLoanButtonState();
    });

    /* when the user clicks on the button, decrement the counter */
    $(document).on('click', '.btn-counter-min', function() {
      let counter = parseInt($(this).next().val()) - 1;
      total--;

      if (counter > 0) {
        $(this).next().val(counter);
      } else {
        $(this).closest('.counter-container').replaceWith(`
        <button class="inventory-item-button btn btn-primary w-100" type="button">
          Pinjam
        </button>
      `);
      }

      updateLoanButtonState();
    });

    /* This function is used to update the state of the loan button */
    function updateLoanButtonState() {
      if (total > 0) {
        $('.loan-button').attr('disabled', false);
        $('.loan-button').text(`Pinjam (${total})`);
      } else {
        $('.loan-button').attr('disabled', true);
        $('.loan-button').text(`Pinjam (${total})`);
      }
    }

    updateLoanButtonState();
  })
</script>

<!-- This script is used to update the calendar -->
<script>
  $(document).ready(function() {
    (() => {
      const date = new Date();

      const months = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
      ];

      $(".calendar-month").text(`${months[date.getMonth()]} ${date.getFullYear()}`);

      const firstDay = getFirstDay(date.getFullYear(), date.getMonth());
      const lastDay = getLastDay(date.getFullYear(), date.getMonth());

      function getFirstDay(year, month) {
        return new Date(year, month, 1);
      }

      function getLastDay(year, month) {
        return new Date(year, month + 1, 0);
      }
    })();
  })
</script>

<!-- This script is used to inventarisir admin menu -->
<script>
  $(document).ready(() => {
    $(document).on('click', '.button-detail-item', function() {
      $('.detail-item-modal-container').toggleClass('d-none');
    });

    $(document).on('click', '.cancel-button-detail-item', () => {
      $('.detail-item-modal-container').toggleClass('d-none');
    })

    $(document).on('click', '.delete-button-detail-item', () => {
      $('.delete-item-modal-container').toggleClass('d-none');
    })
  })
</script>


</body>

</html>
</main>
</div>

<script>
  feather.replace();
</script>

<script>
  document.addEventListener

  $(document).ready(function() {
    /* This function is used to update the state of the sidebar */
    $(".sidebar-btn").on("click", () => {
      $(".sidebar-btn").toggleClass("sidebar-btn-rotate");
      if ($(".sidebar-btn").hasClass("sidebar-btn-rotate")) {
        $(".sidebar").css("width", "10vw");
        $(".main-container").css("width", "90vw");
        $(".logo-container").addClass("hidden");
        $(".text-menu").addClass("hidden");
      } else {
        $(".sidebar").css("width", "20vw");
        $(".main-container").css("width", "80vw");
        $(".logo-container").removeClass("hidden");
        $(".text-menu").removeClass("hidden");
      }
    });

    /* This function is used to update the state of the filter */
    $('.btn-filter').on('click', () => {
      if ($('.btn-sort').hasClass('d-none')) {
        $('.filter-list').toggleClass('d-none');
      } else {
        $('.sort-list').addClass('d-none');
        $('.filter-list').toggleClass('d-none');
      }
    });

    /* This function is used to update the state of the sort */
    $('.btn-sort').on('click', () => {
      if ($('.btn-filter').hasClass('d-none')) {
        $('.sort-list').toggleClass('d-none');
      } else {
        $('.filter-list').addClass('d-none');
        $('.sort-list').toggleClass('d-none');
      }
    });

    /* This function is used to update the state of the hamburger menu */
    $('.hamburger-menu').on('click', () => {
      if ($('.line-1').hasClass('line-1-rotate')) {
        $('.menu').css('transform', 'translateY(-100%)');
        $('.line-1').removeClass('line-1-rotate');
        $('.line-1').attr('y', '11')
        $('.line-1').attr('x', '0')
        $('.line-2').removeClass('line-2-rotate');
        $('.line-2').attr('y', '16')
        $('.line-2').attr('x', '0')
      } else {
        $('.menu').css('transform', 'translateY(0)');
        $('.line-1').addClass('line-1-rotate');
        $('.line-1').attr('y', '-1')
        $('.line-1').attr('x', '2')
        $('.line-2').addClass('line-2-rotate');
        $('.line-2').attr('x', '-15')
      }
    });

    /* This function is used to add default value to the input field admin retrieval */
    $('.admin-retrieval-information').val('Silahkan melakukan pengambilan barang di ruang teknisi lantai 7');
    /* This function is used to reset the value of the input field when the admin click on the input */
    $('.admin-retrieval-information').on('focus', () => {
      $('.admin-retrieval-information').val('');
    });
  });
</script>

<script>
  /* This function is used to open the modal */
  $(document).on('click', '.button-detail-history', function() {
    $('.modal-detail-container').removeClass('d-none');
  })

  /* This function is used to close the modal */
  $(document).on('click', '.button-back-history', function() {
    $('.modal-detail-container').addClass('d-none');
  })

  /* This function is used to close the modal */
  $(document).on('click', '.button-reject-loan', function() {
    $('.modal-detail-container').addClass('d-none');
  })

  /* This function is used to close the modal */
  $(document).on('click', '.button-approve-loan', function() {
    $('.modal-detail-container').addClass('d-none');
  })
</script>

<!-- This script is used to update the state of the choose on loan menu -->
<script>
  $(document).ready(function() {
    $('.form-choose').trigger('reset');
    $('.form-choose-input-loan').on('click', function() {
      if ($(this).hasClass('form-choose-input-loan-non-active') && $(this).attr('checked') !== 'checked') {
        $(this).removeClass('form-choose-input-loan-non-active');
        $(this).addClass('form-choose-input-loan-active');
        $(this).attr('checked', 'checked');
      } else {
        $(this).removeClass('form-choose-input-loan-active');
        $(this).addClass('form-choose-input-loan-non-active');
        $(this).removeAttr('checked');
      }
    })
  })

  $(document).ready(function() {

    /* This function is used to open the modal confirmation when the user click on the loan */
    $('.loan-button').on('click', function() {
      if ($('.loan-button').attr('disabled') !== 'disabled') {
        $('.confirmation-modal-container').removeClass('d-none');
      }
    })

    /* This function is used to close the modal */
    $('.confirmation-modal-close').on('click', function() {
      $('.confirmation-modal-container').addClass('d-none');
    })

    /* This function is used to open the calendar modal when the user click on the Tanggal Peminjaman or Tanggal Pengembalian */
    $(document).on('click', '.date-modal-button', function() {
      $('.calendar-modal-container').removeClass('d-none');
    })

    /* This function is used to close the calendar modal */
    $(document).on('click', '.date-modal-close', function() {
      $('.calendar-modal-container').addClass('d-none');
    })

    /* This function is used to open the modal confirmation admin retrieval 
    when the admin click on the detail button in dashboard menu */
    $(document).on('click', '.loan--details-button--approval', function() {
      $('.modal-detail-container').removeClass('d-none');
    })
  })
</script>

<!-- This script is used to update the state of the loan button -->
<script>
  $(document).ready(function() {
    let total = 0;

    /* When the user click on the pinjam button, increment the counter and replace the pinjam button with a counter */
    $(document).on('click', '.inventory-item-button', function() {
      let counter = 1;
      total++;

      $(this).replaceWith(`
      <div class="counter-container w-100 d-flex justify-content-between">
        <label for="pinjam" class="btn-counter btn-counter-min btn btn-primary">-</label>
        <input id="pinjam" type="text" value="${counter}" class="counter-input w-50 rounded bg-dark-subtle">
        <label for="pinjam" class="btn-counter btn-counter-plus btn btn-primary">+</label>
      </div>
    `);

      updateLoanButtonState();
    });

    /* When the user clicks on the button, increment the counter */
    $(document).on('click', '.btn-counter-plus', function() {
      let counter = parseInt($(this).prev().val()) + 1;
      total++;

      $(this).prev().val(counter);

      updateLoanButtonState();
    });

    /* when the user clicks on the button, decrement the counter */
    $(document).on('click', '.btn-counter-min', function() {
      let counter = parseInt($(this).next().val()) - 1;
      total--;

      if (counter > 0) {
        $(this).next().val(counter);
      } else {
        $(this).closest('.counter-container').replaceWith(`
        <button class="inventory-item-button btn btn-primary w-100" type="button">
          Pinjam
        </button>
      `);
      }

      updateLoanButtonState();
    });

    /* This function is used to update the state of the loan button */
    function updateLoanButtonState() {
      if (total > 0) {
        $('.loan-button').attr('disabled', false);
        $('.loan-button').text(`Pinjam (${total})`);
      } else {
        $('.loan-button').attr('disabled', true);
        $('.loan-button').text(`Pinjam (${total})`);
      }
    }

    updateLoanButtonState();
  })
</script>

<!-- This script is used to update the calendar -->
<script>
  $(document).ready(function() {
    (() => {
      const date = new Date();

      const months = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
      ];

      $(".calendar-month").text(`${months[date.getMonth()]} ${date.getFullYear()}`);

      const firstDay = getFirstDay(date.getFullYear(), date.getMonth());
      const lastDay = getLastDay(date.getFullYear(), date.getMonth());

      function getFirstDay(year, month) {
        return new Date(year, month, 1);
      }

      function getLastDay(year, month) {
        return new Date(year, month + 1, 0);
      }
    })();
  })
</script>

<!-- This script is used to inventarisir admin menu -->
<script>
  $(document).ready(() => {
    $(document).on('click', '.button-detail-item', function() {
      $('.detail-item-modal-container').removeClass('d-none');
    });

    $(document).on('click', '.cancel-button-detail-item', () => {
      $('.detail-item-modal-container').addClass('d-none');
    })

    $(document).on('click', '.delete-button-detail-item', () => {
      $('.delete-item-modal-container').removeClass('d-none');
    })

    $(document).on('click', '.delete-item-button-back', () => {
      $('.delete-item-modal-container').addClass('d-none');
    })

    $(document).on('click', '.delete-item-button', () => {
      $('.delete-item-modal-container').addClass('d-none');
      $('.detail-item-modal-container').addClass('d-none');
    })

    $(document).on('click', '.save-button-detail-item', () => {
      $('.success-edit-item-modal-container').removeClass('d-none');
    })

    $(document).on('click', '.edit-item-success-button', () => {
      $('.success-edit-item-modal-container').addClass('d-none');
      $('.detail-item-modal-container').addClass('d-none');
    })

    $(document).on('click', '.add-new-item-button', () => {
      $('.add-item-modal-container').removeClass('d-none');
    })

    $(document).on('click', '.cancel-button-add-item', () => {
      $('.add-item-modal-container').addClass('d-none');
    })

    $(document).on('click', '.confirm-button-add-item', () => {
      $('.confirmation-add-item-modal-container').removeClass('d-none');
    })

    $(document).on('click', '.cancel-button-confirm-add-item', () => {
      $('.confirmation-add-item-modal-container').addClass('d-none');
    })

    $(document).on('click', '.save-button-confirm-add-item', () => {
      $('.success-add-item-modal-container').removeClass('d-none');
    })

    $(document).on('click', '.add-item-success-button-back', () => {
      $('.success-add-item-modal-container').addClass('d-none');
      $('.confirmation-add-item-modal-container').addClass('d-none');
      $('.add-item-modal-container').addClass('d-none');
    })
  })
</script>


</body>

</html>