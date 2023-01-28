import axios from 'axios';
import Chart from 'chart.js/auto';

window.addEventListener('load', function () {

    let element = document.getElementById('stats')
    let url = element.getAttribute('data-url');
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    axios({
        method: 'post',
        url: url,
        data: {
            _token: csrf,
        }
    }).then(function (response) {
        console.log(response.data)
        createLineChart('stats', response.data, 'Joueurs en ligne')
    });

})

window.chars = []
window.createLineChart = function (elementId, data, labelName) {

    let ctx = document.getElementById(elementId)
    window.chars[elementId] = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Object.keys(data),
            datasets: [{
                label: labelName,
                lineTension: 0.1,
                backgroundColor: "rgba(11, 98, 117,0.3)",
                borderColor: "rgba(11, 98, 117, 1)",
                pointRadius: 2,
                pointBackgroundColor: "rgba(11, 98, 117, 1)",
                pointBorderColor: "rgba(11, 98, 117, 1)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(11, 98, 117, 1)",
                pointHoverBorderColor: "rgba(11, 98, 117, 1)",
                pointHitRadius: 5,
                pointBorderWidth: 1,
                data: Object.values(data),
            }],
        },
        options: {
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                },
            },
            tooltips: {
                backgroundColor: "rgb(245,241,241)",
                bodyFontColor: "#1e1e21",
                titleMarginBottom: 10,
                titleFontColor: '#100f0f',
                titleFontSize: 14,
                borderColor: '#d6e3c8',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'point',
                caretPadding: 10,
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
        }
    });
}
