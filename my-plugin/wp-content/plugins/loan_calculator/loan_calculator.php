<?php
/*
 * Plugin Name:       Loan Calculator
 * Description:       basic loan calculator.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            demanzo team
 * Text Domain:       loan calculator
 */

if (!defined('ABSPATH')) {
    exit;
}


class loan_Calculator
{

    public function __construct()
    {
        // refer the first function
        // add_action('init', array($this, 'load_calculator'));

        // add assets 
        add_action('wp_enqueue_scripts', array($this, 'loan_calculator_assets'));


        // add shortcode
        add_shortcode('loancalculator', array($this, 'loan_calculator_shortcode'));
    }





    public function loan_calculator_assets()
    {

        // bootstrap css
        wp_enqueue_style(
            'bootstrap',
            plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css',
            array(),
            '5.3.3',
            'all'
        );

        // plugin main css
        wp_enqueue_style(
            'loan_calculator_css',
            plugin_dir_url(__FILE__) . 'assets/css/main.css',
            array('bootstrap'),
            '1.0',
            'all'
        );

        // jquery
        wp_enqueue_script(
            'jquery_plugin',
            plugin_dir_url(__FILE__) . 'assets/js/jquery.min.js',
            array(),
            '3.7.1',
            true
        );

        // bootstrap js
        wp_enqueue_script(
            'js_boostrap',
            plugin_dir_url(__FILE__) . 'assets/js/bootstrap.min.js',
            array(),
            '3.7.1',
            true
        );

        // chart.js
        wp_enqueue_script(
            'chart',
            plugin_dir_url(__FILE__) . 'assets/js/chart.js',
            array(),
            '4.4.2',
            true
        );


        // plugin main js
        wp_enqueue_script(
            'loan_calculator_js',
            plugin_dir_url(__FILE__) . 'assets/js/main.js',
            array('jquery_plugin'),
            '1.0',
            true
        );
    }



    // plugin functionality
    public function loan_calculator_shortcode()
    { ?>
        <div class="calculator_main_wrapper">
            <div class="calculator-loan">
                <div class="row g-0">
                    <!-- form area -->
                    <div class="col-12 col-lg-6 px-0 calce-ui pe-md-2 pe-lg-5">
                        <form class="mt-0">
                            <div class="row row-cols-2 mb-3 align-items-center">
                                <div class="col">
                                    <label for="inputPassword6" class="col-form-label">Loan amount ($)</label>
                                    <div class="ui-slide">
                                        <div class="range-value" id="loan_amount_range_label">
                                            <!-- <span class="text-nowrap ms-4">$ 50,000</span> -->
                                        </div>
                                        <input type="range" class="form-range" id="loan_amount_range" min="5000" max="500000" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group loan_amount mb-2">
                                        <!-- <span class="input-group-text" id="basic-addon1"><img src="https://oxcel.com.au//assets/images/edit2.png" alt="" /></span> -->
                                        <!-- <span class="input-group-text">$</span> -->
                                        <input type="text" class="form-control" placeholder="50,000" min="5000" max="500000"
                                            aria-label="Username" aria-describedby="basic-addon1" id="loan_amount_input" />
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-2 mb-3 align-items-center">
                                <div class="col">
                                    <label for="inputPassword6" class="col-form-label">Loan term (year)</label>
                                    <div class="ui-slide">
                                        <div class="range-value" id="loan_term_range_label">
                                            <!-- <span class="text-nowrap ms-5">3 year(s)</span> -->
                                        </div>
                                        <input type="range" class="form-range" id="loan_term_range" min="2" max="8" />
                                        <!-- <span class="amount-one">1 Year</span>
                                    <span class="amount-two">100 Year</span> -->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" id="loan_term_input" class="form-control" placeholder="3" />
                                        <!-- <span class="input-group-text">year(s)</span> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-2 mb-3 align-items-center">
                                <div class="col">
                                    <label for="inputPassword6" class="col-form-label">Interest rate (%)</label>
                                    <div class="ui-slide">
                                        <div class="range-value" id="rate_range_label">
                                            <!-- <span class="text-nowrap ms-4">5%</span> -->
                                        </div>
                                        <input type="range" class="form-range" id="rate_range" min="1" max="40" value="5" />
                                        <!-- <span class="amount-one">1%</span>
                                <span class="amount-two">100%</span> -->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <!-- <span class="input-group-text" id="basic-addon1"><img src="https://oxcel.com.au//assets/images/edit2.png" alt="" /></span> -->
                                        <input type="number" class="form-control" placeholder="5" aria-label="Username"
                                            aria-describedby="basic-addon1" id="rate_input" />
                                        <!-- <span class="input-group-text">%</span> -->
                                    </div>
                                </div>
                            </div>

                            <!-- hide condition -->
                            <div class="row row-cols-1 mb-3 align-items-center">
                                <div class="col">
                                    <label for="ballonPayment" class="col-form-label d-flex align-items-center">
                                        <span class="text-nowrap">Balloon payment (%)</span>
                                        <button type="button" class="btn tool_trip" data-bs-placement="top">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.66667 0.253174C2.98667 0.253174 0 3.23984 0 6.91984C0 10.5998 2.98667 13.5865 6.66667 13.5865C10.3467 13.5865 13.3333 10.5998 13.3333 6.91984C13.3333 3.23984 10.3467 0.253174 6.66667 0.253174ZM6.66667 12.2532C3.72667 12.2532 1.33333 9.85984 1.33333 6.91984C1.33333 3.97984 3.72667 1.58651 6.66667 1.58651C9.60667 1.58651 12 3.97984 12 6.91984C12 9.85984 9.60667 12.2532 6.66667 12.2532ZM6 9.58651H7.33333V10.9198H6V9.58651ZM7.07333 2.94651C5.7 2.74651 4.48667 3.59317 4.12 4.80651C4 5.19317 4.29333 5.58651 4.7 5.58651H4.83333C5.10667 5.58651 5.32667 5.39317 5.42 5.13984C5.63333 4.54651 6.26667 4.13984 6.95333 4.28651C7.58667 4.41984 8.05333 5.03984 8 5.68651C7.93333 6.57984 6.92 6.77317 6.36667 7.60651C6.36667 7.61317 6.36 7.61317 6.36 7.61984C6.35333 7.63317 6.34667 7.63984 6.34 7.65317C6.28 7.75317 6.22 7.86651 6.17333 7.98651C6.16667 8.00651 6.15333 8.01984 6.14667 8.03984C6.14 8.05317 6.14 8.06651 6.13333 8.08651C6.05333 8.31317 6 8.58651 6 8.91984H7.33333C7.33333 8.63984 7.40667 8.40651 7.52 8.20651C7.53333 8.18651 7.54 8.16651 7.55333 8.14651C7.60667 8.05317 7.67333 7.96651 7.74 7.88651C7.74667 7.87984 7.75333 7.86651 7.76 7.85984C7.82667 7.77984 7.9 7.70651 7.98 7.63317C8.62 7.02651 9.48667 6.53317 9.30667 5.25984C9.14667 4.09984 8.23333 3.11984 7.07333 2.94651Z"
                                                    fill="#001732"></path>
                                            </svg>
                                        </button>
                                        <div class="info_label">
                                            A balloon payment is a lump sum paid at the end of a
                                            loan's term
                                        </div>
                                    </label>
                                    <div class="input-group mt-0">
                                        <!-- <span class="input-group-text" id="basic-addon1"><img src="https://oxcel.com.au//assets/images/edit2.png" alt="" /></span> -->
                                        <input type="number" class="form-control" placeholder="0" aria-label="ballonPayment"
                                            aria-describedby="ballonPayment" id="ballonRate_input" />
                                        <!-- <span class="input-group-text">%</span> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-1 mb-3 am-sel-year">
                                <div class="col">
                                    <label for="inputPassword6" style="min-width: unset" class="col-form-label">First payment
                                        date</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <select class="rounded value-put" id="pay_month">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March" selected="">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                        <select class="rounded value-put" id="pay_year">
                                            <!-- <option value="2022" >2022</option> -->
                                            <option value="2023">2023</option>
                                            <option value="2024" selected="">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="calculat-center row row-cols-2">
                                <div class="col">
                                    <a href="javascript:;" class="btn btn-primary" id="calculate_emi">Calculate</a>
                                </div>
                                <div class="col">
                                    <a href="/get-quote" class="btn btn_outline get-quote">Get Quote</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- payment details -->
                    <div class="col-12 col-lg-6 px-2 ps-md-3 ps-lg-4">
                        <!-- <h2>Repayment Details</h2> -->
                        <div class="loan_data_view">
                            <!-- chart basis -->
                            <div class="d-flex flex-column  align-items-start gap-3">
                                <div class="nav align-self-center align-self-xl-start  nav-pills me-3" id="v-pills-tab"
                                    role="tablist" aria-orientation="vertical">
                                    <button class="nav-link nav_graph text-nowrap active" id="v-pills-graph-tab"
                                        data-bs-toggle="pill" data-bs-target="#v-pills-graph" type="button" role="tab"
                                        aria-controls="v-pills-graph" aria-selected="true">
                                        Graph view
                                    </button>
                                    <button class="nav-link nav_chart text-nowrap" id="v-pills-chart-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-chart" type="button" role="tab" aria-controls="v-pills-chart"
                                        aria-selected="false">
                                        Chart view
                                    </button>
                                </div>
                                <div class="align-self-center">
                                    <div class="tab-content w-100 d-flex justify-content-center" id="v-pills-tabContent">
                                        <!-- Graph -->
                                        <div class="tab-pane fade active show" id="v-pills-graph" role="tabpanel"
                                            aria-labelledby="v-pills-graph-tab">
                                            <div class="chart_view px-sm-3" style="height: 234px; width: 290px">
                                                <canvas id="lineChart" style="
                            height: 234px;
                            width: 258px;
                            display: block;
                            box-sizing: border-box;
                          " width="322" height="241"></canvas>
                                            </div>
                                        </div>
                                        <!-- Chart -->
                                        <div class="tab-pane fade" id="v-pills-chart" role="tabpanel"
                                            aria-labelledby="v-pills-chart-tab">
                                            <div class="chart_view px-sm-3" style="height: 234px; width: 290px">
                                                <canvas id="pieChart" style="
                            height: 0px;
                            width: 0px;
                            display: block;
                            box-sizing: border-box;
                          " width="0" height="0"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- time basis -->
                                    <div class="time_basis">
                                        <h5>Your estimated payments are</h5>
                                        <div class="d-flex flex-column align-items-start gap-3">
                                            <div class="tab-content w-100" id="v-pills-tabContent">
                                                <div class="tab-pane fade" id="v-pills-weekly" role="tabpanel"
                                                    aria-labelledby="v-pills-weekly-tab">
                                                    <h3 class="text-center fw-bold" id="result_weekly_payment">
                                                        $ 342.38
                                                    </h3>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-fortnightly" role="tabpanel"
                                                    aria-labelledby="v-pills-fortnightly-tab">
                                                    <h3 class="text-center fw-bold" id="result_fortnightly_payment">
                                                        $ 684.77
                                                    </h3>
                                                </div>
                                                <div class="tab-pane fade show active" id="v-pills-monthly" role="tabpanel"
                                                    aria-labelledby="v-pills-monthly-tab">
                                                    <h3 class="text-center fw-bold" id="result_monthly_payment">
                                                        $ 1,369.53
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="nav align-self-center nav-pills flex-nowrap" id="v-pills-tab"
                                                role="tablist">
                                                <button class="nav-link nav_weekly" id="v-pills-weekly-tab"
                                                    data-bs-toggle="pill" data-bs-target="#v-pills-weekly" type="button"
                                                    role="tab" aria-controls="v-pills-weekly" aria-selected="true">
                                                    Weekly
                                                </button>
                                                <button class="nav-link" id="v-pills-fortnightly-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-fortnightly" type="button" role="tab"
                                                    aria-controls="v-pills-fortnightly" aria-selected="false">
                                                    Fortnightly
                                                </button>
                                                <button class="nav-link active nav_monthly" id="v-pills-monthly-tab"
                                                    data-bs-toggle="pill" data-bs-target="#v-pills-monthly" type="button"
                                                    role="tab" aria-controls="v-pills-monthly" aria-selected="false">
                                                    Monthly
                                                </button>
                                            </div>
                                        </div>

                                        <!-- table view data -->
                                        <div class="table_view_data mt-4 px-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-2">
                                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.5" y="0.032959" width="17" height="18" rx="4"
                                                            fill="var(--primary)">
                                                        </rect>
                                                        <defs>
                                                            <linearGradient id="paint0_linear_8542_2865" x1="17.5" y1="9.03302"
                                                                x2="0.499951" y2="9.03302" gradientUnits="userSpaceOnUse">
                                                                <stop offset="0.01" stop-color="#5B6797" stop-opacity="0.97">
                                                                </stop>
                                                                <stop offset="1" stop-color="#323647"></stop>
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>
                                                    <span>Loan amount</span>
                                                </div>
                                                <div>
                                                    <span id="result_loan_amount">$ 50,000.00</span>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-2">
                                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.5" y="0.032959" style="opacity: 0.5;" width="17" height="18"
                                                            rx="4" fill="var(--primary)">
                                                        </rect>
                                                    </svg>
                                                    <span>Total interest</span>
                                                </div>
                                                <div>
                                                    <span id="result_total_interest">$ 7,500.00</span>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex align-items-center justify-content-between border-top border-bottom py-2">
                                                <div>
                                                    <span class="fw-bold">Total amount</span>
                                                </div>
                                                <div>
                                                    <span class="fw-bold" id="result_total_payment">$ 57,500.00</span>
                                                </div>
                                            </div>

                                            <!-- hide condition -->
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <span>Balloon</span>
                                                </div>
                                                <div>
                                                    <span id="result_ballon_amount">$ 5,000.00</span>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <span>Pay off date</span>
                                                </div>
                                                <div>
                                                    <span id="result_payoff_date">March | 2027</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="repay-cal px-2 pt-4 pt-md-5">
                            Lorem ipsum dolor sit amet consectetur adipiscing elit sodales erat velit pulvinar rhoncus
                            pellentesque, mauris ante condimentum imperdiet duis quis fusce fames tristique ligula hendrerit
                            auctor, dignissim porta bibendum primis pharetra vehicula tellus nisl commodo consequat vivamus per.
                            Est praesent vehicula bibendum
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php }

}

new loan_Calculator;