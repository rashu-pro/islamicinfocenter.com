<?php
/*
Template Name: Print Prayer Times
*/
get_header('blank');

$custom_logo_id = get_theme_mod('custom_logo');
$logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">


<style>
  html,
  body {
    margin: 0;
  }

  body {
    font-family: 'Poppins', sans-serif;
  }

  #prayer-table {
    font-family: poppins, sans-serif;
    border-collapse: collapse;
    width: 100%;
    margin-top: 0;
    border: 1px solid #dddddd;
  }

  .table-responsive {
    overflow: auto;
  }

  #prayer-table td,
  #prayer-table th {
    text-align: center;
    color: #000000;
    line-height: 1;
    white-space: nowrap;
    padding: 6px 8px;
    font-size: .9rem;
  }

  #prayer-table tr {
    border-bottom: 1px solid #ebebeb;
    background-color: #ffffff;
  }

  #prayer-table td:first-child {
    background-color: #f2f2f2;
  }

  #prayer-table tr.date-active td {
    background: #00324c;
    color: #ffffff;
  }

  #prayer-table th {
    padding: 5px 10px;
    font-size: 16px;
    font-weight: 500;
    background-color: #f2f2f2;
    color: #000000;
  }

  .print-pt-header {
    text-align: center;
    padding: 5px 10px;
  }

  .text-center {
    text-align: center;
  }

  .info-label {
    font-size: .75rem;
    opacity: 0.75;
  }

  .info-title {
    margin: 0;
    font-size: .9rem;
    line-height: 1;
  }

  .row {
    display: flex;
    margin: 0;
    margin-left: -15px;
    margin-right: -15px;
  }

  .info-row {
    align-items: center;
    padding: 5px 0 8px;
  }

  .row .col {
    padding-left: 15px;
    padding-right: 15px;
  }

  .info-row .col:not(:last-child) {
    border-right: 1px solid;
  }

  .container {
    max-width: 1180px;
    margin: 0 auto;
  }

  .title-md {
    margin: 10px 0 10px 0;
    font-size: 1.2rem;
    font-weight: 600;
  }

  hr {
    margin: 0;
    border-color: #ddd;
  }

  .text-right {
    text-align: right;
  }

  .btn-print-again {
    border: 1px solid;
    border-radius: 5px;
    padding: 8px 22px;
    margin: 0 0 10px 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    cursor: pointer;
  }

  .btn-print-again img {
    max-height: 18px;
    margin-right: 7px;
    position: relative;
    top: -1px
  }

  @media (min-width: 767px) {
    .print-pt-header {
      padding: 8px 15px;
    }

    #prayer-table th {
      font-weight: 600;
    }

    .btn-print-again {
      position: absolute;
      top: -5px;
      right: 0;
    }
  }
</style>

<div class="">
  <!-- HEADER -->
  <div class="print-pt-header">
    <div class="container">
      <div class="row" style="justify-content: space-between;align-items: center">
        <div class="col">
          <a href="<?php echo home_url() ?>">
            <img src="<?php echo $logo_url ?>" alt="masjid solutions" style="height:35px">
          </a>
        </div>

        <div class="col text-right">
          <p style="margin:0;line-height:1;font-size:.8rem;">+13178540207</p>
          <span style="margin:0;line-height:1;font-size:.8rem;">support@masjidSolutions.net</span>
        </div>
      </div>
    </div>
  </div>
  <hr />

  <!-- HEADING -->
  <div>
    <div class="container" style="position:relative">
      <div class="text-center">
        <h2 class="title-md text-center" style="padding-bottom:4px">Prayer Times of <span class="month-string-js"></span> in <span class="city-name-js">Karachi</span> </h2>
        <button class="btn-print-again btn-print-again-js"> <img src="<?php echo get_template_directory_uri() ?>/images/printer.png"> Print</button>
      </div>
    </div>
  </div>

  <!-- PRAYER TIMES FOR SELECTED MONTH -->
  <div class="container">
    <div class="table-responsive" style="margin:0">
      <table cellspacing="0" summary="monthly-prayer" class="prayer-table table prayer-table-monthly-js" id="prayer-table">
        <thead>
          <tr>
            <th class="month-name-js"></th>
            <th>Fajr</th>
            <th>Sunrise</th>
            <th>Dhuhar</th>
            <th>Asr</th>
            <th>Magrib</th>
            <th>Isha</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>

    </div>
  </div>

  <!-- FOOTER -->
  <div class="container">
    <div class="row info-row">
      <div class="col text-left">
        <span class="info-label">CALCULATION METHOD</span>
        <p class="info-title calculation-method-js"></p>
      </div>

      <div class="col text-left">
        <span class="info-label">JURISTIC METHOD</span>
        <p class="info-title juristic-method-js">Hanafi</p>
      </div>
    </div>
  </div>

</div>

<?php

get_footer();
?>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<!-- MOMENT JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js"></script>

<!-- PRAY TIMES -->
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/prayerTimesCalculator.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/utils-prayer-times.js"></script>

<script>
  jQuery(function($) {
    //=== ON DOCUMENT READY
    const months = utils.monthData();
    const calculationMethods = {
      "MWL": "Muslim World League",
      "ISNA": "Islamic Society of North America",
      "Egypt": "Egyptian General Authority of Survey",
      "Makkah": "Umm al-Qura University, Makkah",
      "Karachi": "University of Islamic Sciences, Karachi",
      "Tehran": "Institute of Geophysics, University of Tehran",
      "Jafari": "Shia Ithna Ashari (Ja`fari)"
    }

    //=== GET THE VALUES FROM $_GET GLOBAL VARIABLE
    const selectedMonth = <?php echo $_GET['month'] ?>;
    const selectedLatitude = <?php echo $_GET['latitude'] ?>;
    const selectedLongitude = <?php echo $_GET['longitude'] ?>;
    const selectedGmtOffset = <?php echo $_GET['gmtoffset'] ?>;
    const selectedCity = '<?php echo $_GET['location'] ?>';
    const selectedCalculationMethod = '<?php echo $_GET['calculation_method'] ?>';
    const selectedJuristicMethod = '<?php echo $_GET['juristic_method'] ?>';

    //=== CALCULATION METHOD AND JURISTIC METHOD
    let calculationMethod = selectedCalculationMethod;
    for (let key in calculationMethods) {
      if (key === selectedCalculationMethod) {
        calculationMethod = calculationMethods[key];
      }
    }
    $('.calculation-method-js').text(calculationMethod);
    $('.juristic-method-js').text(selectedJuristicMethod);

    //=== GENERATES MONTHLY PRAYER TIMES
    prayerTimesMonthly(selectedMonth, [selectedLatitude, selectedLongitude], selectedGmtOffset);

    openPrintWindow();

    //=== PRINT THE PAGE
    function openPrintWindow() {
      $('.btn-print-again-js').css('display', 'none');
      //=== PRINT THE PAGE
      window.print();
      setTimeout(function() {
        $('.btn-print-again-js').css('display', 'inline-flex');
      }, 1000)
    }

    //=== PRINT BUTTON CLICK EVENT
    $(document).on('click', '.btn-print-again-js', function(e) {
      e.preventDefault();
      openPrintWindow();
    })

    /**
     * =====================
     * Generate full months prayer times
     * @param month
     * @param coordinates
     * @param gmtOffset
     */
    function prayerTimesMonthly(month, coordinates, gmtOffset) {
      const year = new Date().getFullYear();
      const date = new Date(year, month, 1);
      const endDate = new Date(year, month + 1, 1);
      const generatedTimes = [];

      $('.prayer-table-monthly-js tbody').html('');
      $('.month-name-js').text(getMonthObjectValue(selectedMonth).monthname);
      $('.month-string-js').text(getMonthObjectValue(selectedMonth).label);
      $('.city-name-js').text(selectedCity);

      //=== SET CALCULATION & JURISTIC METHOD
      prayTimes.setMethod(selectedCalculationMethod);
      prayTimes.adjust({
        asr: selectedJuristicMethod
      });

      while (date < endDate) {
        const times = prayTimes.getTimes(date, coordinates, gmtOffset, 'auto', '12h');

        const options = {
          day: "numeric",
          weekday: "short"
        };
        const formattedDate = date.toLocaleDateString("en-US", options).replace(' ', ', ');

        const today = new Date();
        times.isToday =
          date.getMonth() === today.getMonth() &&
          date.getDate() === today.getDate();

        times.salahDate = date.toDateString();
        times.dayName = formattedDate;

        generatedTimes.push(times);

        // next day
        date.setDate(date.getDate() + 1);
      }

      generatedTimes.forEach((key, index) => {
        let prayerTimesRow = `
            <tr>
                <td>${key.dayName}</td>
                <td>${key.fajr}</td>
                <td>${key.sunrise}</td>
                <td>${key.dhuhr}</td>
                <td>${key.asr}</td>
                <td>${key.maghrib}</td>
                <td>${key.isha}</td>
            </tr>`;
        $('.prayer-table-monthly-js tbody').append(prayerTimesRow);
      })
    }

    /**
     * =====================
     * Get the month name by the number representation of the months
     * @param value
     * @returns {string|null}
     */
    function getMonthObjectValue(value) {
      const foundMonth = months.find(month => month.value === parseInt(value));
      return foundMonth ? foundMonth : null;
    }

  });
</script>
<?php
