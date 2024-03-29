let info = {};

// colors

const colors = {
  primary: "#3b3b98",
  secondary: "#9D9DCB",
};

function emi_calculator(P, R, N, B) {
  var P = parseFloat(P);
  var R = parseFloat(R);
  var N = parseFloat(N);
  var B = parseFloat(B);
  var emi = 0;

  // one month interest
  var r = parseFloat((R / 12 / 100).toFixed(6));

  // one month period
  var n = N * 12;

  var balloonAmount = P * (B / 100);
  var total_interest = P * N * (R / 100);
  var total_payment = P + total_interest;

  // =(C1-(C7/((1+C5)^(C3))))*C5/(1-(1+C5)^(-C3))

  emi =
    ((P - balloonAmount / Math.pow(1 + r, n)) * r) /
    (1 - Math.pow(1 + r, -n)).toFixed(6);

  var monthly_payment = emi.toFixed(2);
  var fortnightly_payment = (emi / 2).toFixed(2);
  var weekly_payment = (emi / 4).toFixed(2);

  let yearly_ob_array = monthly_OB(P, n, emi, balloonAmount, r);

  return {
    loan_amount: P,
    monthly_payment: monthly_payment,
    fortnightly_payment: fortnightly_payment,
    weekly_payment: weekly_payment,
    total_interest: total_interest,
    total_payment: total_payment,
    ballon_amount: balloonAmount,
    yearly_ob_array: yearly_ob_array,
  };
}

// monthly outstanding balance
function monthly_OB(
  loan_amount,
  total_month,
  monthly_emi,
  ballon_amount,
  monthly_rate
) {
  let monthly_ob_array = [];
  let monthly_ob = loan_amount;
  let pmt = monthly_emi;

  for (let i = 0; i < total_month; i++) {
    monthly_ob = monthly_ob.toFixed(2);
    monthly_ob_array.push(monthly_ob);

    let interest = monthly_ob * monthly_rate;
    let principle = pmt - interest;

    monthly_ob -= principle;

    if (i === total_month - 1) {
      pmt += ballon_amount;
    }
  }
  // console.log(monthly_ob_array);

  const yearly_ob_array = yearly_OB(monthly_ob_array);

  return monthly_ob_array, yearly_ob_array;
}

// yearly outstanding balance
function yearly_OB(monthly_ob_array) {
  let yearly_ob_array = [];

  for (let i = 0; i <= monthly_ob_array.length - 11; i++) {
    if ((i += 11)) {
      let yearly_ob = monthly_ob_array[i];
      yearly_ob_array.push(yearly_ob);
    }
  }

  // console.log(yearly_ob_array);

  return yearly_ob_array;
}

// chart variable
const pieChart = document.getElementById("pieChart");
var pieShow;
const lineChart = document.getElementById("lineChart");
var lineShow;

$("#calculate_emi").click(function () {
  onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
});

$(document).ready(function () {
  const loanAmountRange = $("#loan_amount_range");
  const loanAmountInput = $("#loan_amount_input");

  const loanTermRage = $("#loan_term_range");
  const loanTermInput = $("#loan_term_input");

  const rateRange = $("#rate_range");
  const rateInput = $("#rate_input");

  const ballonRateInput = $("#ballonRate_input");

  info.loan_amount = 50000;
  info.loan_term = 3;
  info.rate = 5;
  if (typeof info === "object") {
    info.ballonRate = 10;

    if (
      !(typeof title === "undefined") &&
      (title === "Personal Finance Calculator" ||
        title === "Home Loan Calculator")
    ) {
      info.ballonRate = 0;
    }
  }
  setEmiDefaultValues();

  // getting updated loan amount range value
  loanAmountRange.on("change", function () {
    info.loan_amount = $(this).val();
    if (info.loan_amount.toString().length > 0) {
      loanAmountInput.val(
        numberWithCommas(getNumberFromString(info.loan_amount))
      );
    }

    onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
  });
  loanAmountInput.on("change", function () {
    info.loan_amount = getNumberFromString($(this).val());

    loanAmountInput.val(numberWithCommas(info.loan_amount));
    loanAmountRange.val(info.loan_amount);

    onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
  });

  loanTermRage.on("change", function () {
    info.loan_term = getNumberFromString($(this).val());
    loanTermInput.val(info.loan_term);

    onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
  });
  loanTermInput.on("change", function () {
    info.loan_term = getNumberFromString($(this).val());

    loanTermInput.val(info.loan_term);
    loanTermRage.val(info.loan_term);

    onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
  });

  rateRange.on("change", function () {
    info.rate = getNumberFromString($(this).val());
    rateInput.val(info.rate);

    onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
  });
  rateInput.on("change", function () {
    info.rate = getNumberFromString($(this).val());

    rateInput.val(getNumberFromString($(this).val()));
    rateRange.val(info.rate);

    onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
  });

  ballonRateInput.on("change", function () {
    info.ballonRate = getNumberFromString($(this).val());

    ballonRateInput.val(getNumberFromString($(this).val()));

    onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
  });

  onClickTest(info.loan_amount, info.loan_term, info.rate, info.ballonRate);
});

function setEmiDefaultValues() {
  $("#loan_amount_range").val(info.loan_amount);
  $("#loan_amount_input").val(numberWithCommas(info.loan_amount));

  $("#loan_term_range").val(info.loan_term);
  $("#loan_term_input").val(info.loan_term);

  $("#rate_range").val(info.rate);
  $("#rate_input").val(info.rate);

  $("#ballonRate_input").val(info.ballonRate);
}

function getNumberFromString(value) {
  var temp = parseFloat(value.replace(/\$|,|year(s)|%/gi, ""));

  return temp;
}

// number format
function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function onClickTest(loan_amount, loan_term, rate, ballonRate) {
  // var loan_amount = $('#loan_amount').val();
  // var loan_term = $('#loan_term').val();
  // var rate = $('#rate').val();
  // var ballonRate = $('#ballonRate').val();

  var pay_month = $("#pay_month").val();
  var pay_year = $("#pay_year").val();

  var isValidate = validateEmiForm(loan_amount, loan_term, rate, ballonRate);

  if (isValidate) {
    var payoff_date = eval(loan_term) + eval(pay_year);

    var result = emi_calculator(loan_amount, rate, loan_term, ballonRate);
    $("#result_monthly_payment").text(
      "$ " + numberWithCommas(result.monthly_payment)
    );
    $("#result_fortnightly_payment").text(
      "$ " + numberWithCommas(result.fortnightly_payment)
    );
    $("#result_weekly_payment").text(
      "$ " + numberWithCommas(result.weekly_payment)
    );
    $("#result_loan_amount").text(
      "$ " + numberWithCommas(result.loan_amount.toFixed(2))
    );
    console.log(typeof loan_amount);
    $("#result_total_interest").text(
      "$ " + numberWithCommas(result.total_interest.toFixed(2))
    );
    $("#result_total_payment").text(
      "$ " + numberWithCommas(result.total_payment.toFixed(2))
    );
    $("#result_ballon_amount").text(
      "$ " + numberWithCommas(result.ballon_amount.toFixed(2))
    );
    $("#result_payoff_date").text(pay_month + " | " + payoff_date);

    // console.log(result.loan_amount);
    // console.log(result.total_interest.toFixed(2));

    // pieChart
    loan_amount = result.loan_amount;
    total_interest = result.total_interest;

    if (typeof pieShow !== "undefined") {
      pieShow.destroy();
    }

    pieShow = new Chart(pieChart, {
      type: "doughnut",
      data: {
        datasets: [
          {
            data: [loan_amount, total_interest],
            backgroundColor: [colors.primary, colors.secondary],
            hoverOffset: 4,
          },
        ],
      },
      options: {
        borderJoinStyle: "round",
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          tooltip: {
            callbacks: {
              label: (context) => {
                if (context.dataIndex === 0) {
                  context.label = "Loan amount";
                }
                if (context.dataIndex === 1) {
                  context.label = "Total interest";
                }
                return `${context.label}: $ ${numberWithCommas(
                  context.parsed.toFixed(2)
                )}`;
              },
            },
            displayColors: false,
            backgroundColor: colors.primary,
          },
        },
      },
    });

    // line chart
    let yearly_ob_array = result.yearly_ob_array;
    yearly_ob_array.unshift(loan_amount);
    let year_labels = [];
    for (let i = 0; i < yearly_ob_array.length; i++) {
      year_labels.push(i);
    }

    if (typeof lineShow !== "undefined") {
      lineShow.destroy();
    }

    lineShow = new Chart(lineChart, {
      type: "line",
      data: {
        labels: year_labels,
        datasets: [
          {
            data: yearly_ob_array,
            label: "",
            backgroundColor: [colors.primary],
            borderWidth: 3,
            borderColor: colors.primary,
            tension: 0.1,
          },
        ],
      },
      options: {
        scales: {
          x: {
            beginAtZero: true,
            ticks: {
              callback: function (value, index, ticks) {
                return value;
              },
            },
          },
          y: {
            beginAtZero: true,
            // min: 5000,
            // max: result.loan_amount,

            ticks: {
              callback: function (value, index, ticks) {
                return "$" + numberWithCommas(value);
              },
              // stepSize: (result.loan_amount / 36).toFixed(0),
              // stepSize: 5000,
            },
          },
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: (context) => {
                return `Outstanding balance $ ${numberWithCommas(
                  context.parsed.y
                )}`;
              },
              title: (context) => {
                return `${context[0].label} Year`;
              },
            },
            displayColors: false,
            backgroundColor: colors.primary,
          },
          legend: {
            display: false,
            labels: {
              color: colors.primary,
            },
          },
        },
        elements: {
          point: {
            pointStyle: "circle",
          },
          arc: {
            borderDashOffset: 0.5,
          },
        },
      },
    });
  }
}

function validateEmiForm(loan_amount, loan_term, rate, ballonRate) {
  rate = rate / 100;
  ballonRate = ballonRate / 100;

  if (!(loan_amount >= 5000 && loan_amount <= 500000)) {
    alert("Loan amount must be in the range from 5,000 to 500,000");
    return false;
  }

  if (!(loan_term >= 2 && loan_term <= 8)) {
    alert("Loan term must be in the range from 2 to 8 year");
    return false;
  }

  if (!(rate >= 0.01 && rate <= 0.4)) {
    alert("Interest rate must be in the range from 1% to 40%");
    return false;
  }
  if (!(ballonRate >= 0 && ballonRate <= 0.5)) {
    alert("Ballon rate must be in the range from 0% to 50%");
    return false;
  }
  return true;
}

// Range
const loan_range = document.getElementById("loan_amount_range"),
  loan_range_label = document.getElementById("loan_amount_range_label"),
  loan_input = document.getElementById("loan_amount_input"),
  loan_term_range = document.getElementById("loan_term_range"),
  loan_term_range_label = document.getElementById("loan_term_range_label"),
  loan_term_input = document.getElementById("loan_term_input"),
  rate_range = document.getElementById("rate_range"),
  rate_range_label = document.getElementById("rate_range_label");
rate_input = document.getElementById("rate_input");

function rangeLabeChange(range, label, prefix, inputValue) {
  const setValue = () => {
    const newValue = Number(
        ((range.value - range.min) * 100) / (range.max - range.min)
      ),
      newPosition = 10 - newValue * 0.2;

    // ${prefix === '$'? '$': ''}
    // ${prefix === 'year(s)' ? 'year(s)': ''} ${prefix === '%' ? '%': ''}

    // label.innerHTML = `<span class="text-nowrap">
    //     ${prefix === '$'? '$': ''}
    //     ${numberWithCommas(range.value)}
    //     ${prefix === 'year(s)' ? 'year(s)': ''} ${prefix === '%' ? '%': ''}
    //     </span>`;
    // label.style.left = `calc(${newValue}% + (${newPosition}px))`;

    inputValue.value = numberWithCommas(range.value);
  };

  range.addEventListener("input", setValue);
}

rangeLabeChange(loan_range, loan_range_label, "$", loan_input);
rangeLabeChange(
  loan_term_range,
  loan_term_range_label,
  "year(s)",
  loan_term_input
);
rangeLabeChange(rate_range, rate_range_label, "%", rate_input);
