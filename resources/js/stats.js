import axios from 'axios';
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
        createApexChar(element, response.data)
    });

    function createApexChar(element, data) {

        let options = {
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

        let chart = new ApexCharts(element, options);
        chart.render();
    }
})
