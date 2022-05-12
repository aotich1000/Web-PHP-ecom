console.log(type);
new Chart("doanhthu", {

    type: type,
    data: {
        labels: labelsanpham,
        datasets: [{
            label: "Tổng tiền",
            data: datadoanhthu,
            backgroundColor: "green",
        }]
    },
    options: {
        legend: {
            display: true,
            position: 'bottom',
        },
        labels: {
            fontColor: '#71748d',
            fontFamily: 'Circular Std Book',
            fontSize: 14,
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function (tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel +': '+ number_format(tooltipItem.yLabel)+'đ';
                }
            }
        }
    }
});