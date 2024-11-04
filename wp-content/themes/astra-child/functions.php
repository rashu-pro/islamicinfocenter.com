<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

//prayer times shortcode
function shortcode_prayer_times() {
  ob_start();
  ?>
  <style>
    .pt-active {
      background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/prayer-times/upcoming-prayer.jpg);
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
  return ob_get_clean();
}
add_shortcode('widget_prayer_times', 'shortcode_prayer_times');

function enqueue_shortcode_scripts() {
  // Check if the shortcode is present in the content of the post/page
  global $post;
  if (has_shortcode($post->post_content, 'widget_prayer_times')) {
    // Enqueue styles
     wp_enqueue_style('your-prayer-times-style', get_stylesheet_directory_uri() . '/css/style-prayer-times.css', array(), '1.0.0');
    // Enqueue scripts
    // Moment js
    wp_enqueue_script('moment-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js', array(), '2.29.4', true);
    wp_enqueue_script('moment-timezone-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js', array(), '0.5.43', true);
    // Prayer times utility
    wp_enqueue_script('prayer-times-utils-js', get_stylesheet_directory_uri() . '/js/utils-prayer-times.js', array(), '1.0.0', true);
    // Prayer times calculator library
    wp_enqueue_script('prayer-times-calculator-js', get_stylesheet_directory_uri() . '/js/prayerTimesCalculator.js', array(), '1.0.0', true);
    // Prayer times script
    wp_enqueue_script('prayer-times-script-js', get_stylesheet_directory_uri() . '/js/prayer-times-script.js', array('jquery'), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_shortcode_scripts');

