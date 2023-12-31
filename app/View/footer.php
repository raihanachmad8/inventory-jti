<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="success-add-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(215,243,225,1) 65%);">
    <div class="d-flex flex-column align-items-center row-gap-3 ">
      <img src="/public/assets/images/berhasil.svg" alt="">
      <h3 style="color:#5BD794;">
        <strong id="modal-container-title">

        </strong>
      </h3>
    </div>
    <div>
      <p id="modal-container-message"></p>
    </div>
    <div>
      <button class="btn text-white success-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>
<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="modal-container-failed vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="success-add-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
    <div class="d-flex flex-column align-items-center row-gap-3 ">
      <img src="/public/assets/images/batalkan.svg" alt="">
      <h3 style="color:#CC3333;">
        <strong id="modal-container-failed-title">

        </strong>
      </h3>
    </div>
    <div>
      <p id="modal-container-failed-message"></p>
    </div>
    <div>
      <button class="btn btn-danger text-white failed-button-back" style=" padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>

</main>
</div>

<script>
  feather.replace();
</script>

<script>
  $(document).on('click', '.sidebar-btn', () => {
    $('.sidebar').toggleClass('active');
  })
</script>


<script>
  $(document).on('click', '.success-button-back', () => {
    window.location.reload();
  })

  $(document).on('click', '.failed-button-back', () => {
    $('.modal-container-failed').addClass('d-none');
  })
</script>


<script>
  $(document).on('click', '.hamburger-nav', () => {
    $('.nav-menu').toggleClass('nav-menu-active');
    $('.nav-link').on('click', () => {
      $('.nav-menu').removeClass('nav-menu-active');
    })
  })

  let lastScrollTop = 0;
  window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
      if ($('.nav').hasClass('nav-scroll-down')) {
        $('.nav').removeClass('nav-scroll-up');
        $('.nav').addClass('nav-scroll-down');
      } else {
        $('.nav').addClass('nav-scroll-up');
      }
    } else {
      $('.nav').removeClass('nav-scroll-up');
      $('.nav').addClass('nav-scroll-down');
    }
    lastScrollTop = scrollTop;
  })
</script>

<!-- Ini khusus digunakan untuk kalender -->
<script>
  $(document).ready(function() {
    const calendarContainer = $("#calendar");
    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    function generateCalendar() {
      const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
      const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
      const daysInMonth = lastDayOfMonth.getDate();

      const monthHeader = $("<div>").addClass("month-header")
        .text(new Intl.DateTimeFormat("en-US", {
          month: "long",
          year: "numeric"
        }).format(firstDayOfMonth));

      const calendarTable = $("<table>");
      const headerRow = calendarTable[0].createTHead().insertRow();

      // Create day headers (Sun, Mon, ..., Sat)
      for (let i = 0; i < 7; i++) {
        $("<th>").text(new Intl.DateTimeFormat("en-US", {
            weekday: "short"
          }).format(new Date(2022, 0, i + 2)))
          .appendTo(headerRow);
      }

      // Fill in the calendar days
      let currentDay = 1;
      for (let i = 0; i < 6; i++) {
        const row = calendarTable[0].insertRow();

        for (let j = 0; j < 7; j++) {
          const cell = $(row.insertCell());
          if (i === 0 && j < firstDayOfMonth.getDay()) {
            // Empty cells before the first day
            cell.text("");
          } else if (currentDay > daysInMonth) {
            // Empty cells after the last day
            cell.text("");
          } else {
            // Fill in the day
            cell.text(currentDay);
            if (currentDay === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
              // Highlight today's date
              cell.addClass("today");
            }
            currentDay++;
          }
        }
      }

      // Clear previous calendar and append the new one
      calendarContainer.empty().append(monthHeader).append(calendarTable);
    }

    generateCalendar();

    // Event listeners for changing the month
    $("#prev-month").on("click", function() {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      generateCalendar();
    });

    $("#next-month").on("click", function() {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      generateCalendar();
    });
  });
</script>

<script>
  $(document).on('click', '.button-detail-history-loan', () => {
    $('.content').addClass('d-none')
    $('.modal-detail-container').removeClass('d-none');
  })
</script>

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

  $(document).on('click', '.date-modal-button', () => {
    $('.calendar-modal-container').removeClass('d-none');
    console.log($('.calendar-modal-container').hasClass('d-none'))
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

    /* This function is used to close the calendar modal */
    $(document).on('click', '.date-modal-close', function() {
      $('.calendar-modal-container').addClass('d-none');
    })

    $(document).on('click', '.button-submit-loan-application', () => {
      $('.success-loan-application-modal-container').removeClass('d-none');
    })

    $(document).on('click', '.loan-application-success-button', () => {
      $('.confirmation-modal-container').addClass('d-none');
      $('.success-loan-application-modal-container').addClass('d-none');
    })
  })
</script>

<!-- Ini khusus digunakan untuk sidebar -->
<script>
  $(document).on('click', '.sidebar-btn', () => {
    $(".sidebar-btn").toggleClass("sidebar-btn-rotate");
    const timeout = setTimeout(() => {
      $('.sidebar-decoration').toggleClass('d-none');
    }, 200);
    if ($(".sidebar-btn").hasClass("sidebar-btn-rotate")) {
      $(".sidebar").css("width", "8vw");
      $(".main-container").css("width", "92vw");
      $(".logo-container").addClass("hidden");
      $(".text-menu").addClass("d-none");
      $('.nav-menu-icon').removeClass('gap-3');
      $('.nav-menu-container').addClass('justify-content-center')
      $('.nav-menu-container').removeClass('w-100')
    } else {
      $('.nav-menu-icon').addClass('gap-3');
      $(".sidebar").css("width", "20vw");
      $(".main-container").css("width", "80vw");
      $(".logo-container").removeClass("hidden");
      $(".text-menu").removeClass("d-none");
      $('.nav-menu-container').removeClass('justify-content-center')
      $('.nav-menu-container').addClass('w-100')
    }

    return () => {
      clearTimeout(timeout);
    };
  });
</script>

<!-- Ini khusus digunakan oleh sidebar mobile -->
<script>
  $('.hamburger-menu').on('click', () => {
    if ($('.line-1').hasClass('line-1-rotate')) {
      $('.menu').css('transform', 'translateX(-100%)');
      $('.line-1').removeClass('line-1-rotate');
      $('.line-1').attr('y', '11')
      $('.line-1').attr('x', '0')
      $('.line-2').removeClass('line-2-rotate');
      $('.line-2').attr('y', '16')
      $('.line-2').attr('x', '0')
    } else {
      $('.menu').css('transform', 'translateX(0)');
      $('.line-1').addClass('line-1-rotate');
      $('.line-1').attr('y', '-1')
      $('.line-1').attr('x', '2')
      $('.line-2').addClass('line-2-rotate');
      $('.line-2').attr('x', '-15')
    }
  });
</script>

<!-- Ini khusus digunakan oleh pesan dan profile -->
<script>
  $(document).on('click', '.button-mail', () => {
    if ($('.message-notification').hasClass('d-none')) {
      $('.message-notification').removeClass('d-none')
      const timeout = setTimeout(() => {
        $('.message-notification').animate({
          opacity: 1
        }, 200)
      }, 100)

      return () => {
        clearTimeout(timeout);
      };
    } else {
      $('.message-notification').animate({
        opacity: 0
      }, 200)
      const timeout = setTimeout(() => {
        $('.message-notification').addClass('d-none')
      }, 300)

      return () => {
        clearTimeout(timeout);
      };
    }
  })

  $(document).on('click', '.button-profile', () => {
    if ($('.profile-menu').hasClass('d-none')) {
      $('.profile-menu').removeClass('d-none')
      const timeout = setTimeout(() => {
        $('.profile-menu').animate({
          opacity: 1
        }, 200)
      }, 100)

      return () => {
        clearTimeout(timeout);
      };
    } else {
      $('.profile-menu').animate({
        opacity: 0
      }, 200)
      const timeout = setTimeout(() => {
        $('.profile-menu').addClass('d-none')
      }, 300)

      return () => {
        clearTimeout(timeout);
      };
    }
  })
</script>

<!-- Ini digunakan oleh history admin -->
<script>
  $(document).on('click', '.button-detail-history', () => {
    $('.modal-detail-history-container').toggleClass('d-none');
  })

  $(document).on('click', '.button-back-loan-history', () => {
    $('.modal-detail-history-container').toggleClass('d-none');
  })
</script>

<!-- Ini khusus digunakan oleh button batalkan -->
<script>
  $(document).on('click', '.button-cancel-loan', () => {
    $('.cancel-loan-modal-container').toggleClass('d-none');
  })

  $(document).on('click', '.cancel-loan-button', () => {
    $('.success-cancel-loan-modal-container').toggleClass('d-none');
  })

  $(document).on('click', '.cancel-loan-button-back', () => {
    $('.success-cancel-loan-modal-container').toggleClass('d-none');
    $('.cancel-loan-modal-container').toggleClass('d-none');
    $('.modal-detail-container').toggleClass('d-none');
    $('.content').toggleClass('d-none');
  })
</script>

<script>
  // Function to generate calendar
  const currentDate = new Date();
  const currentYear = currentDate.getFullYear();
  const currentMonth = currentDate.getMonth();
  let peminjaman = [];
  $.ajax({
    url: '/inventory/date',
    method: 'GET',
    success: function(data) {
      $(document).ready(function() {
        peminjaman = data.data;
        generateCalendar(currentYear, currentMonth);
      })
    },
    error: (error) => {
      console.log(error);
    }
  })

  function generateCalendar(year, month) {
    const table = $('.calendar-table');
    table.empty(); // Clear existing content

    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDay = new Date(year, month, 1).getDay();

    const monthText = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    // Update month and year in header
    const monthHeader = $('.calendar-month');
    monthHeader.text(`${monthText[month]} ${year}`);

    // Create table header (days of the week)
    const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const thead = $('<thead></thead>');
    const tr = $('<tr></tr>');
    daysOfWeek.forEach(day => {
      const th = $('<th></th>').text(day);
      tr.append(th);
    });
    thead.append(tr);
    table.append(thead);

    // Create table body (days of the month)
    const tbody = $('<tbody></tbody>');
    let dayCounter = 1;

    for (let i = 0; i < 6; i++) {
      const tr = $('<tr></tr>');

      for (let j = 0; j < 7; j++) {
        const td = $('<td></td>');
        const div = $('<div></div>');
        const p = $('<p></p>');
        p.text("Jangan Lupa Mengembalikan Barang")
        const endLoanModal = $('<div></div>');
        endLoanModal.addClass('end-loan-box bg-danger rounded-3 text-white position-absolute p-3 z-3');
        endLoanModal.css('width', '10rem');
        endLoanModal.css('scale', '0');
        endLoanModal.css('left', '-70%');
        endLoanModal.css('bottom', '110%');
        endLoanModal.css('font-size', '0.8rem');
        endLoanModal.css('cursor', 'pointer');
        endLoanModal.text('Batas Peminjaman');
        endLoanModal.append(p);
        div.css('pointer-events', 'none');

        const endLoanEl = () => {

        }

        if (i === 0 && j < firstDay) {
          // Empty cells before the first day of the month
          td.text('');
        } else if (dayCounter <= daysInMonth) {
          // Fill in days of the month
          div.text(dayCounter);
          td.append(div);
          if (dayCounter === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
            // Highlight today's date
            td.addClass('bg-warning rounded-3');
          }
          if (peminjaman.some(peminjaman => peminjaman.EndDate.split(' ')[0] === `${year}-${month + 1}-${dayCounter}`)) {
            td.append(endLoanModal);
            td.addClass('end-loan bg-danger rounded-3 text-white position-relative');
          }
          dayCounter++;
        }

        tr.append(td);
      }

      tbody.append(tr);
    }

    table.append(tbody);
  }

  // Initial generation of the calendar (December 2023)
  generateCalendar(currentYear, currentMonth);

  // Function to navigate to the previous month
  $('#prevMonth').on('click', function() {
    const currentMonth = $('.calendar-month');
    const currentMonthText = currentMonth.text().split(' ');
    const month = currentMonthText[0].substring(0, 3);
    const year = currentMonthText[1];

    const prevMonth = new Date(`01 ${month} ${year}`);
    prevMonth.setMonth(prevMonth.getMonth() - 1);

    currentMonth.text(`${prevMonth.toLocaleString('default', { month: 'long' })} ${prevMonth.getFullYear()}`);
    generateCalendar(prevMonth.getFullYear(), prevMonth.getMonth());
  });

  // Function to navigate to the next month
  $('#nextMonth').on('click', function() {
    const currentMonth = $('.calendar-month');
    const currentMonthText = currentMonth.text().split(' ');
    const month = currentMonthText[0];
    const year = currentMonthText[1];

    const nextMonth = new Date(`01 ${month} ${year}`);
    nextMonth.setMonth(nextMonth.getMonth() + 1);

    currentMonth.text(`${nextMonth.toLocaleString('default', { month: 'long' })} ${nextMonth.getFullYear()}`);
    generateCalendar(nextMonth.getFullYear(), nextMonth.getMonth());
  });
</script>

<script>
  $(document).ready(() => {
    // Memunculkan box saat website dibuka
    $('.end-loan-box').stop().animate({
      scale: 1
    }, 200);

    // Menjadwalkan perubahan untuk menghilangkan box setelah 2000 milidetik (2 detik)
    setTimeout(() => {
      $('.end-loan-box').stop().animate({
        scale: 0
      }, 200);
    }, 2000);
  });
</script>

<!-- Ini khusus digunakan accordion -->
<script>
  $(".accordion").click(function() {
    $(this).toggleClass("active");
    $(this).parent().toggleClass("active");

    const chevronIcon = $(this).find('svg')

    if (chevronIcon.hasClass('rotate-i')) {
      chevronIcon.removeClass("rotate-i");
      chevronIcon.addClass("rotate-start");
    } else {
      chevronIcon.addClass("rotate-i");
      chevronIcon.removeClass("rotate-start");
    }

    let panel = $(this).next();

    if (panel.is(":visible")) {
      panel.slideUp();
    } else {
      panel.slideDown();
    }
  });
</script>

</body>

</html>