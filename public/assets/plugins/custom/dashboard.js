"use strict";

$(document).ready(function() {
    yearlyWithdraw();
    yearlyIncome();
})

$('.yearly-income').on('change', function () {
    let year_value = $(this).val();
    yearlyIncome(year_value)
})


function yearlyIncome(year_value = new Date().getFullYear()) {
    var url = $('#get-yearly-income').val();
    $.ajax({
        type: "GET",
        url: url += '?year=' + year_value,
        dataType: "json",
        success: function (res) {
            var year_value = res.year_value;
            var year_income = [];

            for (var i = 0; i <= 11; i++) {
                var monthName = getMonthNameFromIndex(i);

                var yearIncome = year_value.find(item => item.month === monthName);
                year_income[i] = yearIncome ? yearIncome.total_income : 0;
            }
            yearlyIncomeChart(year_income)
        },
    });
}

let incomeOverview = false;

function yearlyIncomeChart(year_income) {
    if (incomeOverview) {
        incomeOverview.destroy();
    }

    var ctx = document.getElementById('income-statistics').getContext('2d');

         incomeOverview = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Total Income:$'+ year_income.reduce((prevVal, currentVal) => prevVal + currentVal, 0),
                    data: year_income,
                    borderColor: '#4876FF',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 0, // Remove the legend box
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(value);
                            }
                        }
                    }
                }
            }
        });
};

// PRINT TOP DATA
getDashboardData();
function getDashboardData() {
    var url = $('#get-dashboard').val();
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function (res) {
            $('#dashboard_app_user').text(res.app_user);
            $('#dashboard_total_client').text(res.total_client);
            $('#dashboard_active_client').text(res.active_client);
            $('#dashboard_total_influencer').text(res.total_influencer);
            $('#dashboard_active_influencer').text(res.active_influencer);
            $('#dashboard_total_service').text(res.total_service);
            $('#dashboard_total_income').text(res.total_income);
            $('#dashboard_total_expense').text(res.total_expense);
        }
    });
}

// Function to convert month index to month name
function getMonthNameFromIndex(index) {
    var months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    return months[index - 1];
}

$('.generates-statistics').on('change', function () {
    let year = $(this).val();
    yearlyWithdraw(year)
})

function yearlyWithdraw(year = new Date().getFullYear()) {
    var url = $('#yearly-generates-url').val();
    $.ajax({
        type: "GET",
        url: url += '?year=' + year,
        dataType: "json",
        success: function (res) {
            var years = res.year;
            var year_withdraw = [];

            for (var i = 0; i <= 11; i++) {
                var monthName = getMonthNameFromIndex(i); // Implement this function to get month name

                var yearData = years.find(item => item.month === monthName);
                year_withdraw[i] = yearData ? yearData.total_withdraw : 0;
            }
            totalGeneratesChart(year_withdraw)
        },
    });
}

let statiSticsValu = false;

function totalGeneratesChart(year_withdraw) {
    if (statiSticsValu) {
        statiSticsValu.destroy();
    }

    var ctx = document.getElementById('monthly-statistics').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 100, 10, 280);
    gradient.addColorStop(0, '#16A34A');


    statiSticsValu = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                    backgroundColor: gradient,
                    label: "Total Withdraw: $" + year_withdraw.reduce((prevVal, currentVal) => prevVal + currentVal, 0),
                    fill: true,
                    borderRadius: 24,
                    barThickness: 10,
                    maxBarThickness: 10,
                    data: year_withdraw,
                }
            ]
        },

        options: {
            responsive: true,
            tension: 0.3,
            tooltips: {
                displayColors: true,
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 0, // Remove the legend box
                    }
                }
            },
            scales: {
                x: {
                    display: true,
                },
                y: {
                    display: true,
                    beginAtZero: true
                }
            },
        },
    });
};
