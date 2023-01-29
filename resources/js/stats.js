import axios from 'axios';
import ApexCharts from 'apexcharts'

window.addEventListener('load', function () {

    let isFetching = false
    let chart

    let elementStats = document.getElementById('stats')

    let elementButton2 = document.getElementById('global-2')
    let elementButton7 = document.getElementById('global-7')
    let elementButton14 = document.getElementById('global-14')
    let elementButton30 = document.getElementById('global-30')
    let buttons = [elementButton2, elementButton7, elementButton14, elementButton30,]

    let current
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    function fetchData(element) {

        isFetching = true
        current = element

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
            removeDisable()

            isFetching = false
        });
    }

    function createApexChar(data) {

        if (chart != null) {
            chart.destroy()
        }

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
                },
                defaultLocale: 'fr',
                locales: [{
                    name: 'fr',
                    options: {
                        months: ['Janvier', 'Fevrier', 'Mars', 'Avrim', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
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

        chart = new ApexCharts(elementStats, options);
        return chart.render();
    }

    removeSelected()
    fetchData(elementButton2)

    buttons.forEach(element => {
        element.addEventListener('click', async function () {

            if (current != null && element === current) return
            if (isFetching) return

            removeSelected()
            fetchData(element)
        })
    })

    function removeSelected() {
        buttons.forEach(element => {
            element.classList.add("button-disable")
            element.classList.remove("button-selected")
        })
    }

    function removeDisable() {
        buttons.forEach(element => element.classList.remove("button-disable"))
    }
})
