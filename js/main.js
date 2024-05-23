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

        loadChart(data_total_views, data_unique_viewrs,"#chart");



    });

    $.getJSON("https://criar.interposto.com/data/all.json", function (rawData) {

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

        loadChart(data_total_views, data_unique_viewrs,"#general-stats");



    });
    
    $.getJSON("https://criar.interposto.com/data/all_specific.json", function (rawData) {

        data = rawData[2].data;

        loadChartAll(data,"#specific-stats");



    });




});

function loadChart(data_total_views, data_unique_viewrs,id) {

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
           
        },
        yaxis: {
            max: 600
          }
    };

    var chart = new ApexCharts(document.querySelector(id), options);
    chart.render();
}

function loadChartAll(data,id) {

        data_total_views_1 = [];
        data_total_views_2 = [];
        data_total_views_3 = [];
        data_total_views_4 = [];
        data_total_views_5 = [];
        
        data_total_views = [data_total_views_1,data_total_views_2,data_total_views_3,data_total_views_4,data_total_views_5];
        
        min_date = 1696377600 * 1000;

        $.each(data, function (i, row) {

            var date = row.view_dates_unix_timestamp * 1000;
            var total_views = row.total_views;
            var pub_id = row.pub_id;
        
            data_total_views[pub_id-1].push([date, total_views]);
        })

    var options = {
        series: [{
                name: 'Artigo 1',
                data: data_total_views[0]
            },{
                name: 'Artigo 2',
                data: data_total_views[1]
            },{
                name: 'Artigo 3',
                data: data_total_views[2]
            },{
                name: 'Artigo 4',
                data: data_total_views[3]
            },{
                name: 'Artigo 5',
                data: data_total_views[4]
            }],
        chart: {
            type: 'area',
            height: 350,
            stacked: true,
            background: "#000000",
            foreColor: 'var(--font-main)',
        },colors: ['#179B9B', '#006EDB','#894CEB','#CE2C85','#EB670F'],
        dataLabels: {
            enabled: false
        },
        stroke: {
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
        },
        annotations: {
           
        }
    };

    var chart = new ApexCharts(document.querySelector(id), options);
    chart.render();
}
