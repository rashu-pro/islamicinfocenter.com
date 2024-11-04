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
