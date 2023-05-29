import axios from 'axios';
import ApexCharts from 'apexcharts'

window.addEventListener('load', function () {

    let elementStats = document.getElementById('stats')

    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    function fetchData(element) {

        let url = element.getAttribute('data-url');
        axios({
            method: 'post',
            url: url,
            data: {
                _token: csrf,
            }
        }).then(function (response) {
            let elementLoader = document.getElementById('stats-loader')
            if (elementLoader != null) {
                elementLoader.remove()
            }
            createApexChar(response.data)
            element.classList.add('button-selected')
        });
    }

    function createApexChar(data) {

        let options = {
            series: data,
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
                },
                defaultLocale: 'fr',
                locales: [{
                    name: 'fr',
                    options: {
                        months: ['Janvier', 'Fevrier', 'Mars', 'avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
                        shortMonths: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
                        days: ['Dimanche', 'Lundi', 'Mardi', 'Mecredi', 'Jeudi', 'Vendredi', 'Samedi'],
                        shortDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                        toolbar: {
                            download: 'Télécharger le SVG',
                            selection: 'Selection',
                            selectionZoom: 'Selection Zoom',
                            zoomIn: 'Zoom Avant',
                            zoomOut: 'Zoom Arrière',
                            pan: 'Panning',
                            reset: 'Rénitiliser le Zoom',
                        }
                    }
                }]
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
                    datetimeUTC: false,
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
            },
        };

        let chart = new ApexCharts(elementStats, options);
        chart.render();
    }

    fetchData(elementStats)
})
