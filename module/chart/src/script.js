var m_chart = {};





m_chart.createChart = function(data_heat, data_round) {
    'use strict';

    $(function () { 
        $('.m-chart .chart-area').highcharts({
            chart: {
                type: 'scatter',
                animation: false,
                zoomType: 'xy'
            },
            credits: {
                enabled: false
            },
            title: {
                text: '[TOL P %] vs. [BOP Vessel FeO %]'
            },
            legend: {
                verticalAlign: 'top',
                x: 0,
                y: 20
            },
            xAxis: {
                title: {
                    text: 'BOP Vessel FeO %'
                },
                type: 'linear',
            },
            yAxis: {
                title: {
                    text: 'TOL P %'
                }
            },
            series: [{
                name: 'Heats',
                color: 'rgba(79,129,189,0.4)',
                data: data_heat,
                stickyTracking: false
            },
            {
                name: 'Round',
                color: 'rgba(192,80,77,1.0)',
                data: data_round,
                marker: {
                    radius: 6,
                    symbol: 'diamond'
                },
                stickyTracking: false
            }]
        });
    });
};