<?php
/*
Template Name: Prayer Times
*/
get_header();
?>

  <style>
    /** loader */
    .loader-wrapper {
      display: none;
    }

    .loader-wrapper.active {
      display: block;
    }

    .loader-page {
      display: flex;
      justify-content: center;
      align-items: center;
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      z-index: 9999;
      background-color: rgba(30, 50, 47, 0.64);
      background-color: #969696d9;
      color: #fff;
    }

    .loader-inline {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px 15px;
    }

    .loader-inline .loader-spinner {
      border-color: #ddd;
      border-top-color: #3498db;
    }

    .loader-inline .loader-inner p {
      margin-top: 5px;
    }

    .loader-inner p {
      padding-left: 5px;
      margin: 0;
      margin-top: 10px;
    }

    .loader-spinner {
      border-color: #f2f2f2;
      border-style: solid;
      border-width: 4px;
      border-radius: 9999px;
      width: 2.5rem;
      height: 2.5rem;
      border-top-color: #3498db;
      -webkit-animation: spinner 1.5s linear infinite;
      animation: spinner 1.5s linear infinite;
      transition-timing-function: linear;
      margin: 0 auto;
    }

    .loader-div {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #202020;
      background: #202020ad;
      z-index: 999;
      opacity: 0;
      visibility: hidden;
    }

    .loader-div.active {
      opacity: 1;
      visibility: visible;
    }

    .lds-spinner {
      display: inline-block;
      position: relative;
      width: 80px;
      height: 80px;
    }

    .lds-spinner div {
      transform-origin: 40px 40px;
      animation: lds-spinner 1.2s linear infinite;
    }

    .lds-spinner div:after {
      content: " ";
      display: block;
      position: absolute;
      top: 3px;
      left: 37px;
      width: 6px;
      height: 18px;
      border-radius: 20%;
      background: #fff;
    }

    .lds-spinner div:nth-child(1) {
      transform: rotate(0deg);
      animation-delay: -1.1s;
    }

    .lds-spinner div:nth-child(2) {
      transform: rotate(30deg);
      animation-delay: -1s;
    }

    .lds-spinner div:nth-child(3) {
      transform: rotate(60deg);
      animation-delay: -0.9s;
    }

    .lds-spinner div:nth-child(4) {
      transform: rotate(90deg);
      animation-delay: -0.8s;
    }

    .lds-spinner div:nth-child(5) {
      transform: rotate(120deg);
      animation-delay: -0.7s;
    }

    .lds-spinner div:nth-child(6) {
      transform: rotate(150deg);
      animation-delay: -0.6s;
    }

    .lds-spinner div:nth-child(7) {
      transform: rotate(180deg);
      animation-delay: -0.5s;
    }

    .lds-spinner div:nth-child(8) {
      transform: rotate(210deg);
      animation-delay: -0.4s;
    }

    .lds-spinner div:nth-child(9) {
      transform: rotate(240deg);
      animation-delay: -0.3s;
    }

    .lds-spinner div:nth-child(10) {
      transform: rotate(270deg);
      animation-delay: -0.2s;
    }

    .lds-spinner div:nth-child(11) {
      transform: rotate(300deg);
      animation-delay: -0.1s;
    }

    .lds-spinner div:nth-child(12) {
      transform: rotate(330deg);
      animation-delay: 0s;
    }

    @keyframes lds-spinner {
      0% {
        opacity: 1;
      }

      100% {
        opacity: 0;
      }
    }

    @-webkit-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
      }

      100% {
        -webkit-transform: rotate(360deg);
      }
    }

    @keyframes spinner {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }


    .form-sub-heading {
      font-size: 25px;
      font-weight: 600;
      color: #00324c;
      margin-bottom: 15px;
    }

    .form-group label {
      color: #202020;
      margin-bottom: 0;
      font-size: 16px;
      font-weight: 500;
    }

    .row {
      margin-bottom: 10px;
    }

    .form-control {
      color: #000000;
      font-size: 16px;
      height: 42px;
    }

    .search-btn {
      padding-right: 0;
      margin-top: 15px;
    }

    .search-btn .btn {
      font-size: 16px;
      font-weight: 500;
      letter-spacing: 1.8px;
      background-color: #00324C;
      border-style: solid;
      border-width: 2px 2px 2px 2px;
      border-color: #00324C;
      border-radius: 15px 15px 15px 15px;
      box-shadow: 3px 6px 10px 0px rgba(23, 16, 16, 0.23);
      margin-left: 15px;

    }

    .search-btn #reset-btn {
      background-color: transparent;
      color: #00324C;
    }

    .search-btn #reset-btn:hover {
      background-color: #ED4548;
      color: #FFFFFF;
    }

    .search-btn .btn:hover {
      color: #FFFFFF;
      background-color: #ED4548;
      border-color: #ED4548;
    }

    .section-design {
      padding: 20px 10px;
      background: #ebebeb;
      border-radius: 10px;
      box-shadow: 0px 4px 8px 0px rgb(0 0 0 / 6%);
      margin-bottom: 30px;
    }

    .box-title {
      color: #00324c;
      font-weight: 600;
      line-height: 1.2;
      font-size: 20px;
      padding-bottom: 10px;
    }

    .pt-date {
      border-top: 1px solid #cfcfcf;
      padding-top: 10px;
      margin-bottom: 15px;
    }

    .pt-date p {
      font-size: 16px;
      color: #000000;
      font-weight: 600;
    }

    .prayer-tiles-row {
      margin-left: -6px;
      margin-right: -6px;
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
      margin-bottom: 10px;
    }

    .prayer-tiles {
      padding: 10px 6px;
      display: flex;
      flex: auto;
      max-width: 200px;
    }

    .prayer-tiles > p {
      background-color: #fff;
      margin: 0;
      display: block;
      width: 100%;
      padding: 10px;
      border: 2px solid #cac6c6;
      border-radius: 0.5rem;
    }

    .prayer-tiles span {
      display: block;
      text-align: center;
    }

    .prayer-tiles .prayer-name {
      font-size: 20px;
      font-weight: 600;
      color: #000000;
    }

    .prayer-tiles .prayer-time {
      font-size: 18px;
      font-weight: 500;
      color: #000000;
    }

    .prayer-box {
      display: flex;
    }

    .prayer-tiles.pt-active {
      background: #00324c;
      padding: 15px;
      margin-left: 15px;
    }

    .pt-active {
      background-color: #000000;
      padding: 20px 30px;
      border-radius: 10px;
      text-align: center;
      background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/prayer-times/upcoming-prayer.jpg);
    }

    .pt-active span {
      display: block;
      text-align: center;
    }

    .pt-active p {
      color: #ffffff;
      margin: 0;
    }

    .pt-active .next-pray {
      font-size: 24px;
      font-weight: 600;
      padding-bottom: 5px;
      border-bottom: 1px solid #8d8d8d;
      display: flex;
      text-align: center;
      justify-content: center;
    }

    .pt-active .pt-timer {
      font-size: 24px;
      font-weight: 600;
    }


    #prayer-table {
      font-family: poppins, sans-serif;
      border-collapse: collapse;
      width: 100%;
      margin-top: 15px;
      border: 1px solid #dddddd;
    }

    .prayer-time-monthly {
      padding-top: 30px;
    }

    .table-responsive {
      overflow: auto;
    }

    #prayer-table td,
    #prayer-table th {
      font-size: 16px;
      text-align: center;
      color: #000000;
      line-height: 1.3;
      white-space: nowrap;
      padding: 5px 6px;
    }

    /* #prayer-table tr:nth-child(even) {
        background-color: #f2f2f2;
    } */

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

    #prayer-table tr:hover {
      background-color: #ddd;
    }

    #prayer-table th {
      padding: 5px 10px;
      font-size: 16px;
      font-weight: 500;
      background-color: #7f7f7f;
      color: #fff;
    }

    .select-month {
      font-size: 18px;
      color: #000000;
      font-weight: 600;
      margin: auto;
    }


    .monthly-print-option .col button {
      height: 40px;
      border-radius: 15px;
      font-weight: 600;
      width: 130px;
      transition: all .3s;
      font-family: "Roboto", Sans-serif;
      font-size: 16px;
    }

    .export-btn-holder {
      display: flex;
      align-items: center;
    }

    .monthly-print-option .btn {
      height: 55px;
      border-radius: 15px;
      font-weight: 600;
      min-width: 144px;
      transition: all .3s;
      font-family: "Roboto", Sans-serif;
      font-size: 16px;
      padding: 14px 42px;
    }

    .monthly-print-option button.btn {
      height: 55px;
    }

    .btn-print {
      background: #00324c;
      border: 2px solid #00324c;
      color: #ffffff;
      margin-left: 10px;
    }

    .btn-download {
      background: #ecf5fb;
      border: 2px solid #00324c;
      color: #00324c;
    }

    .btn-print:hover {
      color: #FFFFFF;
      background-color: #ED4548;
      border-color: #ED4548;
    }

    .btn-download:hover {
      background-color: #ED4548;
      color: #FFFFFF;
      border-color: #ED4548;
    }

    .islamic-event-cta .learn-more-btn a {
      font-family: "Roboto", sans-serif;
      font-size: 18px;
      font-weight: 500;
      color: #ffffff;
      text-transform: uppercase;
      letter-spacing: 1.8px;
      background-color: #ED4548;
      border-radius: 15px 15px 15px 15px;
      box-shadow: 3px 6px 10px 0px rgba(23, 16, 16, 0.23);
      display: inline-block;
    }

    .islamic-event-cta .learn-more-btn a:hover {
      color: #D43838;
      background-color: #FFFFFF;
    }

    .checkbox.switcher .message-info {
      color: #4d4d4d;
      font-style: italic;
      margin-bottom: 0;

    }

    .checkbox.switcher {
      margin-top: 15px;
    }

    .checkbox.switcher label input {
      display: none;
    }

    .checkbox.switcher label * {
      vertical-align: middle;
    }

    .checkbox.switcher label input + span {

      background: #269bff;
      border-color: #269bff;
      position: relative;
      display: inline-block;
      margin-right: 10px;
      width: 40px;
      height: 15px;
      border: 1px solid #eee;
      border-radius: 50px;
      transition: all 0.1s ease-in-out;
      cursor: pointer;
    }

    .checkbox.switcher label input:checked + span {
      background: #000000;
    }

    .checkbox.switcher label input + span strong {
      left: 20px;
      position: absolute;
      display: block;
      width: 20px;
      height: 20px;
      margin-top: -4px;
      background: #fff;
      border-radius: 50%;
      transition: all 0.1s ease-in-out;
      box-shadow: 0 0.0625rem 0.1875rem 0.0625rem rgba(0, 0, 0, 0.4);
    }

    .checkbox.switcher label input:checked + span strong {
      left: 0;
    }

    .row .form-group title {
      width: 100px;
    }

    .prayer-times-generation {
      width: 100%;
      padding: 40px 0 60px 0;
    }

    .section-design.section-head-search {
      background: #fff;
      box-shadow: none;
      text-align: center;
      max-width: 600px;
      margin: 0 auto;
      padding: 0 0 20px;
    }

    .form-control.form-control-search-location {
      outline: 2px solid #00324c;
      border-radius: 30px;
      height: 50px;
      border: 3px solid #e4dede;
      font-size: 18px;
    }

    .btn.btn-generate-prayer {
      position: absolute;
      right: 4px;
      top: 50%;
      transform: translateY(-50%);
      border-radius: 30px;
      padding: 12px 40px;
      background: #00324c;
    }

    .btn.btn-generate-prayer:hover {
      background-color: #ED4548;
    }

    .p-relative {
      position: relative;
    }

    .islamic-event-cta {
      background-color: #00324C;
      padding: 50px 0;
      margin-top: 50px;
    }

    .islamic-event-cta h2 {
      color: #FFFFFF;
      font-family: "Roboto Slab", sans-serif;
      font-weight: 800;
      text-transform: uppercase;
      font-size: 36px;
      line-height: 1.2;
    }

    .islamic-event-cta .learn-more-btn {
      margin-top: 30px;
    }

    .islamic-event-cta .learn-more-btn a {
      padding: 25px 50px 25px 50px;
    }

    .tooltip .tooltiptext {
      visibility: hidden;
      width: auto;
      font-size: 13px;
      background-color: #0b8fb4;
      color: #fff;
      padding: 8px;
      border-radius: 4px;
      position: absolute;
      z-index: 1;
      line-height: 1.4;
    }

    .tooltip:hover .tooltiptext {
      visibility: visible;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px;
    }
    .col-md-8,
    .col-md-4,
    .col-sm-4,
    .col-sm-3{
      position: relative;
      /*width: 100%;*/
      padding-right: 15px;
      padding-left: 15px;
    }

    @media (min-width: 767px) {
      .text-md-right {
        text-align: right;
      }

      .export-btn-holder {
        justify-content: end;
      }

      #prayer-table {
        margin-top: 30px;
      }

      .prayer-times-generation {
        padding: 30px 0 50px 0;
      }

      .section-design {
        padding: 30px;
      }

      .upcoming-prayer-tiles {
        padding-left: 40px;
      }

      .box-title {
        font-size: 28px;
      }

      .prayer-tiles > p {
        padding: 30px 15px;
      }

      #prayer-table th {
        padding-top: 12px;
        padding-bottom: 12px;
        font-size: 18px;
        font-weight: 600;
      }

      #prayer-table td,
      #prayer-table th {
        padding: 12px;
      }

      .monthly-print-option {
        padding-top: 15px;
      }

      .islamic-event-cta {
        padding: 100px 0;
        margin-top: 80px;
      }

      .islamic-event-cta h2 {
        font-size: 55px;
      }

      .islamic-event-cta .learn-more-btn {
        margin-top: 50px;
      }

      .form-control.form-control-search-location {
        outline: 3px solid #00324c;
        height: 55px;
        border: 4px solid #e4dede;
      }

      .monthly-print-option .btn {
        padding: 14px 40px;
      }

      .tooltip .tooltiptext {
        width: 300px;
      }
      .col-md-8 {
        flex: 0 0 66.66666667%;
        max-width: 66.66666667%;
      }
      .col-md-4 {
        flex: 0 0 33.33333333%;
        max-width: 33.33333333%;
      }
    }

    @media (min-width: 576px){
      .col-sm-4 {
        flex: 0 0 33.33333333%;
        max-width: 33.33333333%;
      }
      .col-sm-4 {
        flex: 0 0 33.33333333%;
        max-width: 33.33333333%;
      }
    }
  </style>

  <section class="prayer-times-generation">
    <div class="container" style="display: none">
      <div class="setting-form section-design section-head-search">
        <div>
          <div class="location-section" style="margin-bottom: 20px;">
            <h4 class="form-sub-heading">SELECT YOUR LOCATION</h4>
            <div class="form-group">
              <div class="location-search-group p-relative">
                <input type="text" class="form-control form-control-search-location search-location-js"
                       id="current-location" placeholder="Search by City or zip code">

                <button type="button" style="display:none"
                        class="btn btn-primary btn-generate-prayer btn-generate-prayer-times-js" id="search-btn">
                  SEARCH
                </button>
              </div>

            </div>
          </div>

          <div class="search-btn d-none">
            <button type="button" class="btn bt-default" id="reset-btn">RESET</button>

          </div>

          <!-- HIDDEN FIELDS -->
          <div class="hidden-fields">
            <input type="hidden" class="global-lat-js">
            <input type="hidden" class="global-lon-js">
            <input type="hidden" class="timezone-js">
            <input type="hidden" class="global-offset-js">
            <input type="hidden" class="calculation-method-js">
            <input type="hidden" class="juristic-method-js">
            <input type="hidden" class="next-hour-js">
            <input type="hidden" class="next-mins-js">
            <input type="hidden" class="next-seconds-js">
            <input type="hidden" class="current-date-js">
            <input type="hidden" class="current-time-js">
          </div>

        </div>
      </div>
    </div>

    <div class="prayer-time-section" id="prayer-time-box">
      <div class="container">
        <!-- TODAY'S PRAYER TIMES -->
        <div class="prayer-time-box section-design">
          <div class="row" style="display: flex;justify-content: space-between;">
            <div class="pt-box-header col-md-8">
              <div class="box-title">
                Prayer Times In <span class="city-name-js"></span>
              </div>
              <div class="pt-date">
                <p>
                  <?php echo date('l dS F Y', time()); ?>
                </p>

              </div>


              <p class="m-0" style="display:none"><span class="pt-calculation-method-js"></span> <a
                  href="javascript:void(0)" class="text-link">Change</a></p>


            </div>
            <div class="upcoming-prayer-tiles col-md-4">
              <div class="pt-active">
                <p>
                  Upcoming Prayer
                  <span class="next-pray">
                                    <span class="next-prayer-name-js"></span>
                                    &nbsp;
                                    <span class="next-prayer-time-js"></span>
                                </span>

                  <span class="">
                                    Time Remaining
                                    <span class="pt-timer upcoming-prayer-ticker-js">00:28:35</span>
                                </span>
                </p>
              </div>
            </div>
          </div>

          <div class="prayer-tiles-row">
            <div class="prayer-tiles">
              <p>
                            <span class="prayer-name">
                                Fajr
                            </span>
                <span class="prayer-time prayer-fajr-js prayer-1-js">
                                04:41 AM
                            </span>
              </p>
            </div>
            <div class="prayer-tiles">
              <p>
                            <span class="prayer-name">
                                Sunrise
                            </span>
                <span class="prayer-time prayer-sunrise-js prayer-2-js">
                                06:16 AM
                            </span>
              </p>
            </div>
            <div class="prayer-tiles">
              <p>
                            <span class="prayer-name">
                                Dhuhr
                            </span>
                <span class="prayer-time prayer-dhuhr-js prayer-3-js">
                                01:44 PM
                            </span>
              </p>
            </div>
            <div class="prayer-tiles">
              <p>
                            <span class="prayer-name">
                                Asr
                            </span>
                <span class="prayer-time prayer-asr-js prayer-4-js">
                                05:42 PM
                            </span>
              </p>
            </div>
            <div class="prayer-tiles">
              <p>

                            <span class="prayer-name">
                                Maghrib
                            </span>
                <span class="prayer-time prayer-maghrib-js prayer-6-js">
                                09:11 PM
                            </span>
              </p>
            </div>
            <div class="prayer-tiles">
              <p>
                            <span class="prayer-name">
                                Isha
                            </span>
                <span class="prayer-time prayer-isha-js prayer-7-js">
                                10:46 PM
                            </span>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 text-left">
              <label class="m-0" style="color:#000000; margin-bottom:0; font-size:16px;">Calculation Method</label>
              <span class="tooltip">
                            <i class="fa fa-info-circle" style="color: #363636; font-size:16px;" aria-hidden="true"></i>
                            <span class="tooltiptext">By choosing a different Calculation Method, prayer times for Fajr and Isha will be impacted. Choose the Calculation Method relevant to your location.</span>
                        </span>
              <select class="form-control pt-calculate-method-dropdown-js" style="max-width:400px">
              </select>
            </div>
            <div class="col-sm-3 text-left">
              <label class="m-0" style="color:#000000; margin-bottom:0; font-size:16px;">Juristic Method</label>
              <span class="tooltip">
                            <i class="fa fa-info-circle" style="color: #363636; font-size:16px;" aria-hidden="true"></i>
                            <span class="tooltiptext">Changing the Juristic settings will have an impact on Asr prayer time. Choose the Juristic Method relevant to your location.</span>
                        </span>
              <select class="form-control pt-juristic-method-dropdown-js" style="max-width:350px">
              </select>
            </div>
          </div>

        </div>
      </div>


  </section>

  <!-- LOADER -->
  <div class="loader-div">
    <div class="lds-spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

<?php

get_footer();
?>
  <!-- MOMENT JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js"></script>

  <!-- PRAY TIMES -->
  <script src="<?php echo get_stylesheet_directory_uri() ?>/js/prayerTimesCalculator.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/js/utils-prayer-times.js"></script>
  <script>
    jQuery(function ($) {
      //=== ON DOCUMENT READY
      const themeDirectory = "<?php echo get_stylesheet_directory_uri() ?>";
      const prayerImageDirectory = themeDirectory + '/images/prayer-times/';
      let intervalId;
      const months = utils.monthData();
      console.log(months);
      const calculationMethods = {
        "MWL": "Muslim World League",
        "ISNA": "Islamic Society of North America",
        "Egypt": "Egyptian General Authority of Survey",
        "Makkah": "Umm al-Qura University, Makkah",
        "Karachi": "University of Islamic Sciences, Karachi",
        "Tehran": "Institute of Geophysics, University of Tehran",
        "Jafari": "Shia Ithna Ashari (Ja`fari)"
      }

      const juristicMethods = {
        "Standard": "Hanbali, Maliki, Shafi",
        "Hanafi": "Hanafi"
      }

      //=== POPULATE CALCULATION METHOD SELECT DROPDOWN OPTION
      for (let key in calculationMethods) {
        $('.pt-calculate-method-dropdown-js').append(`<option value="${key}">${calculationMethods[key]}</option>`)
      }

      //=== POPULATE JURISTIC METHOD SELECT DROPDOWN OPTION
      for (let key in juristicMethods) {
        $('.pt-juristic-method-dropdown-js').append(`<option value="${key}">${juristicMethods[key]}</option>`)
      }

      //=== POPULATE MONTH DROPDOWN VALUE
      months.forEach((key, index) => {
        const option = `<option value="${key.value}">${key.label}</option>`;
        $('.month-selector-js').append(option);
      })

      /**
       * =====================
       * Initially show the prayer times based on visitors location
       * @type {string}
       */
      const getIpDetailsUrl = "https://ipinfo.io/?token=bca72e9d426331";
      fetch(getIpDetailsUrl)
        .then(response => response.json())
        .then(data => {
          const ipLatLon = data.loc;
          const ipLatLonArray = ipLatLon.split(',');
          const ipCoordinates = [ipLatLonArray[0], ipLatLonArray[1]];

          const timezone = data.timezone;
          const zoneInfo = moment.tz(timezone);
          const offset = zoneInfo.utcOffset() / 60;

          $('.timezone-js').val(timezone);
          $('.global-lat-js').val(ipLatLonArray[0]);
          $('.global-lon-js').val(ipLatLonArray[1]);
          $('.global-offset-js').val(offset);
          $('.city-name-js').text(data.city);

          decideCalculationMethod(offset);
          //=== TODAY'S PRAYER TIMES
          prayerTimesToday(new Date(), ipCoordinates, offset);
          //=== MONTHLY PRAYER TIMES
          prayerTimesMonthly(parseInt($('.month-selector-js').val()), ipCoordinates, offset);
        })
        .catch(err => console.log(err))

      /**
       * =====================
       * Generated todays prayer times
       * @param currentTime
       * @param coordinates
       * @param gmtOffset
       */
      function prayerTimesToday(currentTime, coordinates, gmtOffset) {
        $('.prayer-tiles').removeClass('upcoming');
        $('.prayer-tiles').removeClass('prayer-box');
        $('.prayer-tiles').removeClass('not-prayer-box');
        $('.prayer-tiles').removeClass('upcoming-prayer-box');

        $('.current-date-js').val(currentTime);

        //=== SET CURRENT TIME
        const formattedDateOptions = {
          weekday: 'short',
          day: 'numeric',
          month: 'short',
          year: 'numeric'
        };
        const formattedDate = currentTime.toLocaleDateString(undefined, formattedDateOptions);
        $('.current-date-js').html(formattedDate);

        prayTimes.setMethod($('.calculation-method-js').val());
        prayTimes.adjust({
          asr: $('.juristic-method-js').val()
        });

        const todaysPrayerTimes = prayTimes.getTimes(currentTime, coordinates, gmtOffset, 'auto', '12h');
        console.log('today\'s prayer times: ', todaysPrayerTimes);
        const keys = Object.keys(todaysPrayerTimes);

        keys.forEach((key, index) => {
          //=== 24H FORMAT DATE
          let timeArray = todaysPrayerTimes[key].split(':');
          let hours = timeArray[0];
          let mins = parseInt(timeArray[1]);
          let formatIndicator = timeArray[1].split(' ');
          formatIndicator = formatIndicator[1];
          if (formatIndicator === 'pm' && parseInt(hours) !== 12) {
            hours = parseInt(hours) + 12;
          }

          //=== ADDS THE TIME THE ELEMENT
          $('.prayer-' + index + '-js').html(todaysPrayerTimes[key]);

          //=== ADD 24H FORMAT HOURS AND MINUTES AS ATTRIBUTES
          $('.prayer-' + index + '-js').attr('data-hours', hours);
          $('.prayer-' + index + '-js').attr('data-mins', mins);
          $('.prayer-' + index + '-js').attr('data-prayername', key);
          $('.prayer-' + index + '-js').attr('data-prayer-img', prayerImageDirectory + 'img-prayer-' + key + '.jpg');
          // Get the current date
          let currentDate = new Date();
          currentDate.setHours(hours);
          currentDate.setMinutes(mins);
          currentDate.setSeconds(0);
          currentDate.setMilliseconds(0);

          // Get the timestamp in milliseconds
          let timestamp = currentDate.getTime();
          let timestampCurrent = currentTime;

          if ((timestampCurrent - timestamp) < 1) {
            $('.prayer-' + index + '-js').closest('.prayer-tiles').addClass('upcoming');
          }

          //=== ADD A CLASS TO THE PRAYER TILES
          $('.prayer-' + index + '-js').closest('.prayer-tiles').addClass('prayer-box');
          if (index === 2) {
            $('.prayer-' + index + '-js').closest('.prayer-tiles').removeClass('prayer-box');
            $('.prayer-' + index + '-js').closest('.prayer-tiles').addClass('not-prayer-box');
          }
        })

        $('.not-prayer-box').removeClass('upcoming');
        $('.prayer-tiles.upcoming').first().addClass('upcoming-prayer-box');
        if (!$('.prayer-tiles.upcoming-prayer-box').length) {
          $('.prayer-tiles').first().addClass('upcoming-prayer-box');
        }

        //=== HIGHLIGHTED UPCOMING PRAYER TIMES
        $('.next-prayer-name-js').html($('.upcoming-prayer-box .prayer-name').text());
        $('.next-prayer-time-js').html($('.upcoming-prayer-box .prayer-time').text());
        let bgImage = $('.upcoming-prayer-box .prayer-time').attr('data-prayer-img');
        $('.upcoming-prayer-tiles .pt-active').css('background-image', 'url(' + bgImage + ')');
        $('.next-hour-js').val($('.upcoming-prayer-box .prayer-time').attr('data-hours'));
        $('.next-mins-js').val($('.upcoming-prayer-box .prayer-time').attr('data-mins'));

        $('.global-offset-js').val(gmtOffset);

        //=== UPCOMING PRAYER TIMES TICKER
        if (intervalId) clearInterval(intervalId);
        intervalId = setInterval(showPrayerTimeTicker, 1000);
      }

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
        $('.month-name-js').text(getMonthNameByValue($('.month-selector-js').val()));

        createPrintPrayerTimesUrl();

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
                <td class="day-name">${key.dayName}</td>
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
       * Get the time by timezone
       * @param timezone
       * @returns {string}
       */
      function getTimeByTimezone(timezone) {
        let options = {
          timeZone: timezone,
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit',
          hour12: false
        };
        return new Date().toLocaleString('en-US', options);
      }

      /**
       * =====================
       * Upcoming prayer times ticker
       */
      function showPrayerTimeTicker() {
        // console.log('OFFSET: ', $('.global-offset-js').val());
        let currentDate = getTimeByTimezone($('.timezone-js').val());

        let timeArray = currentDate.split(':');
        let currentHours = timeArray[0];
        let currentMins = parseInt(timeArray[1]);
        let currentSeconds = parseInt(timeArray[2]);

        let nextHour = $('.next-hour-js').val();
        let nextMin = $('.next-mins-js').val();

        var year = new Date().getFullYear();
        var month = (new Date().getMonth() + 1).toString().padStart(2, '0');
        var day = new Date().getDate().toString().padStart(2, '0');

        // console.log(`CURRENT TIME: ${currentDate}`);
        let consoleString = `current hour: ${currentHours}|\nCurrent Minutes: ${currentMins}|\nCurrent Seconds: ${currentSeconds}\nNext Hour: ${nextHour}|\nNext Minutes: ${nextMin}`;


        var nextPrayerTime = new Date(`${year}-${month}-${day} ${nextHour}:${nextMin}:00`);
        currentDate = new Date(`${year}-${month}-${day} ${currentHours}:${currentMins}:${currentSeconds}`);

        if ($('.prayer-tiles-row .prayer-tiles').first().hasClass('upcoming-prayer-box')) {
          if (parseInt(currentHours) > 12) {
            let cH = 24 - parseInt(currentHours);
            let cM = 60 - parseInt(currentMins);
            let cS = 60 - currentSeconds;
            if (cM < 60) {
              cH = cH - 1;
            }
            let nH = parseInt(nextHour);
            let nM = parseInt(nextMin);

            let rM = cM + nM;
            let rH = cH + nH;
            if (rM > 59) {
              rM = 0;
              rH = rH + 1;
            }

            nextHour = parseInt(currentHours) - rH;
            nextMin = rM;

            let nextSeconds = 59;

            currentDate = new Date(`${year}-${month}-${day} ${nextHour}:${nextMin}:${currentSeconds}`);
            nextPrayerTime = new Date(`${year}-${month}-${day} ${currentHours}:${currentMins}:00`);
            console.log('current date: ', currentDate);
            console.log('pray date: ', nextPrayerTime);
          }
        }

        var timeRemaining = nextPrayerTime - currentDate;

        // Convert the time remaining to hours, minutes, and seconds
        var hours = Math.floor(timeRemaining / (1000 * 60 * 60));
        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Format the time remaining as a string
        var timeRemainingStr = hours.toString().padStart(2, '0') + ':' +
          minutes.toString().padStart(2, '0') + ':' +
          seconds.toString().padStart(2, '0');

        // Display the ticker
        $('.upcoming-prayer-ticker-js').html(timeRemainingStr);
      }

      /**
       * =====================
       * Decides calculation method based on gmtoffset
       * @param gmt
       */
      function decideCalculationMethod(gmt) {
        if (gmt > 3.8 && gmt < 7.2) {
          $('.calculation-method-js').val('Karachi');
          $('.juristic-method-js').val('Hanafi');
        }

        if (gmt > 7.5 && gmt < 14) {
          $('.calculation-method-js').val('MWL');
          $('.juristic-method-js').val('Standard');
        }

        if (gmt > 0 && gmt < 3.8) {
          $('.calculation-method-js').val('MWL');
          $('.juristic-method-js').val('Standard');
        }

        if (gmt < 0) {
          $('.calculation-method-js').val('ISNA');
          $('.juristic-method-js').val('Standard');
        }

        $('.pt-calculation-method-js').html(calculationMethods[$('.calculation-method-js').val()]);
        $('.pt-calculate-method-dropdown-js').val($('.calculation-method-js').val());
        $('.pt-juristic-method-dropdown-js').val($('.juristic-method-js').val());
      }

      /**
       * =====================
       * Creates print prayer times page url
       */
      function createPrintPrayerTimesUrl() {
        let printPageUrl = $('.btn-print-js').attr('data-url');
        printPageUrl = `${printPageUrl}?month=${$('.month-selector-js').val()}&latitude=${$('.global-lat-js').val()}&longitude=${$('.global-lon-js').val()}&gmtoffset=${$('.global-offset-js').val()}&location=${$('.city-name-js').text()}&calculation_method=${$('.calculation-method-js').val()}&juristic_method=${$('.juristic-method-js').val()}`;
        $('.btn-print-js').attr('href', printPageUrl);
      }

      /**
       * =====================
       * Get the month name by the number representation of the months
       * @param value
       * @returns {string|null}
       */
      function getMonthNameByValue(value) {
        const foundMonth = months.find(month => month.value === parseInt(value));
        return foundMonth ? foundMonth.monthname : null;
      }

      //=== PRAYER TIMES BY MONTH
      $(document).on('change', '.month-selector-js', function () {
        const self = $(this);
        let coordinates = [$('.global-lat-js').val(), $('.global-lon-js').val()];
        prayerTimesMonthly(parseInt(self.val()), coordinates, $('.global-offset-js').val());
      })

      //=== CALCULATION METHOD CHANGE
      $(document).on('change', '.pt-calculate-method-dropdown-js', function (e) {
        e.preventDefault();
        $('.loader-div').addClass('active');
        $('.calculation-method-js').val($(this).val());

        let latitude = $('.global-lat-js').val();
        let longitude = $('.global-lon-js').val();
        let timezoneOffset = $('.global-offset-js').val();
        let currentTime = new Date($('.current-date-js').val());

        //=== TODAY'S PRAYER TIMES
        prayerTimesToday(currentTime, [latitude, longitude], timezoneOffset);
        prayerTimesMonthly(parseInt($('.month-selector-js').val()), [latitude, longitude], timezoneOffset)
        $('.loader-div').removeClass('active');
      })


      //=== JURISTIC METHOD CHANGE
      $(document).on('change', '.pt-juristic-method-dropdown-js', function (e) {
        e.preventDefault();
        $('.loader-div').addClass('active');
        $('.juristic-method-js').val($(this).val());

        let latitude = $('.global-lat-js').val();
        let longitude = $('.global-lon-js').val();
        let timezoneOffset = $('.global-offset-js').val();
        let currentTime = new Date($('.current-date-js').val());

        //=== TODAY'S PRAYER TIMES
        prayerTimesToday(currentTime, [latitude, longitude], timezoneOffset);
        prayerTimesMonthly(parseInt($('.month-selector-js').val()), [latitude, longitude], timezoneOffset)
        $('.loader-div').removeClass('active');
      })

      //=== DOWNLOAD PRAYER TIMES
      $(document).on('click', '.btn-download-pdf-js', function (e) {
        e.preventDefault();
        $('.loader-div').addClass('active');
        let pageHeading = `Prayer Times of ${$('.month-selector-js option:selected').text()} in ${$('.city-name-js').text()}`;

        $('.html-string-js').val($('.html-string-wrapper-js').html());
        $('.page-heading-js').val(pageHeading);
        $('.foot-calculation-method-js').val($('.pt-calculate-method-dropdown-js option:selected').text());
        $('.foot-juristic-method-js').val($('.juristic-method-js').val());
        $('.pdf-generation-form-js').submit();
        setTimeout(function () {
          $('.loader-div').removeClass('active');
        }, 2000)

      })
    });
  </script>
<?php
