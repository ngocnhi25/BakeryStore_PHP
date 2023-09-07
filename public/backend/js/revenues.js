$(document).ready(function () {
    $.ajax({
        url: 'handles/revenue/months.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            createChartMonth(data);
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error('Error:', errorThrown);
        }
    });
});

function createChartMonth(data) {
    var ctx = document.getElementById("month-chart").getContext("2d");

    var months = [];
    var incomes = [];
    var expenses = [];

    // Tạo một mảng chứa tất cả các tháng trong năm
    var allMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    // Điều chỉnh dữ liệu để điền đầy đủ tất cả các tháng
    for (var i = 0; i < allMonths.length; i++) {
        var found = false;
        for (var j = 0; j < data.length; j++) {
            if (data[j].month === allMonths[i]) {
                months.push(allMonths[i]);
                incomes.push(data[j].income);
                expenses.push(data[j].expense);
                found = true;
                break;
            }
        }
        if (!found) {
            months.push(allMonths[i]);
            incomes.push(0);
            expenses.push(0);
        }
    }

    var myChart = new Chart(ctx, {
        // type: "line",
        data: {
            labels: months,
            datasets: [
                {
                    type: 'bar',
                    label: "Khoản thu",
                    data: incomes,
                    backgroundColor: "rgba(75, 192, 192, 1)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    order: 2
                }, {
                    type: 'bar',
                    label: "Chi phí",
                    data: expenses,
                    backgroundColor: "rgba(255, 99, 132, 1)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    order: 1,
                    fill: false,
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#7d8da1',
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#7d8da1',
                        font: {
                            size: 10
                        }
                    }
                    
                },
                x: {
                    ticks: {
                        color: '#7d8da1',
                        font: {
                            size: 10
                        }
                    }
                }
            },

        }
    });
}