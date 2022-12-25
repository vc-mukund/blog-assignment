document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
    new Chart(document.getElementById("chartjs-dashboard-bar"), {
        type: "bar",
        data: {
            labels: users,
            datasets: [{
                label: "Total Blog",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.danger,
                hoverBorderColor: window.theme.danger,
                data: blogs,
                barPercentage: .75,
                categoryPercentage: .5
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 50
                    }
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
});