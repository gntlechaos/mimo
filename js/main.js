window.addEventListener('DOMContentLoaded', (event) => {


    $.getJSON("https://criar.interposto.com/data/1.json", function (rawData) {

        data = rawData[2].data;

        data_total_views = [];
        data_unique_viewrs = [];
        min_date = data[0].view_dates_unix_timestamp * 1000;

        $.each(data, function (i, row) {

            var date = row.view_dates_unix_timestamp * 1000;
            var total_views = row.total_views;
            var unique_viewers = row.unique_viewers;

            data_total_views.push([date, total_views]);
            data_unique_viewrs.push([date, unique_viewers]);
            //console.log(date, unique_viewers, total_views);
        })

        loadChart(data_total_views, data_unique_viewrs);



    });






});

function loadChart(data_total_views, data_unique_viewrs) {

    var options = {
        series: [{
                name: 'Visualizações',
                data: data_total_views
            },
            {
                name: 'Visitantes Únicos',
                data: data_unique_viewrs
            }],
        chart: {
            type: 'area',
            height: 350,
            stacked: true,
            background: "#000000",
            foreColor: 'var(--font-main)',
        },
        colors: ['#008FFB', '#00E396'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'monotoneCubic',
            width: 2,
        },
        fill: {
            type: 'gradient',
            gradient: {
                opacityFrom: 0.6,
                opacityTo: 0.8,
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        },
        xaxis: {
            type: 'datetime',
            labels: {
              formatter: function(value, timestamp, opts) {
                return (new Date(timestamp).toLocaleString("pt-br",{dataStyle:"full",year:"2-digit",month:"short",day:"numeric"}));
              }
        }
        },
        theme: {
            mode: 'dark',
            palette: 'palette1',
            monochrome: {
                enabled: true,
                color: '#255aee',
                shadeTo: 'light',
                shadeIntensity: 0.65
            },
        },
        annotations: {
            xaxis: [
            {
              x: new Date('4 Oct 2023').getTime(),
              borderColor: 'var(--font-main)',
              label: {
                style: {
                  color: 'var(--background-main)',
                },
                text: 'Publicação'
              }
            },
            {
                x: new Date('10 Apr 2024').getTime(),
                x2: new Date('17 Apr 2024').getTime(),
                fillColor: '#B3F7CA',
                label: {
                style: {
                  color: 'var(--background-main)',
                },
                text: 'Impulsionamento'
              }
            }
        ]
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}
