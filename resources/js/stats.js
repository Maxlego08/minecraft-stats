import axios from 'axios';
import Chart from 'chart.js/auto';

import ApexCharts from 'apexcharts'

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
        // createLineChart('stats', response.data, 'Joueurs en ligne')
        createApexChar(element, response.data)
    });

    function createApexChar(element, data){

        console.log(data)

        var options = {
            series: [{
                name: 'Joueurs en ligne',
                data: data
            }],
            chart: {
                type: 'area',
                stacked: false,
                height: 500,
                zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                },
                toolbar: {
                    autoSelected: 'zoom'
                }
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0,
                    opacityTo: 0,
                },
            },
            yaxis: {
                title: {
                    text: 'Joueurs'
                },
            },
            xaxis: {
                type: 'datetime',
                labels: {
                    show: true,
                    datetimeFormatter: {
                        year: 'yyyy',
                        month: 'MMM \'yy',
                        day: 'dd MMM',
                        hour: 'HH:mm'
                    },
                }
            },
            tooltip: {
                shared: false,
                x: {
                    show: true,
                    format: 'dd MMMM HH:mm',
                },
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

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
                pointRadius: 1,
                pointBackgroundColor: "rgba(11, 98, 117, 1)",
                pointBorderColor: "rgba(11, 98, 117, 1)",
                pointHoverRadius: 2,
                pointHoverBackgroundColor: "rgba(11, 98, 117, 1)",
                pointHoverBorderColor: "rgba(11, 98, 117, 1)",
                pointHitRadius: 2,
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
