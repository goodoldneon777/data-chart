var m_chart = {};





m_chart.createChart = function(data_heat, data_round, x_datatype) {
    'use strict';
console.log(data_round.y_count);
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
            tooltip: {
                snap: 1,
                headerFormat: '<b>{series.name}</b><br>',
                formatter: function() {
                    var text = '';

                    if (x_datatype === 'datetime') {
                        text = 'y: ' + this.point.y;
                    } else if (x_datatype === 'linear') {
                        text = 'y: ' + this.point.y + '<br>';
                        if (this.series.name === 'Heats') {
                            text += 'x: ' + this.point.x;
                        } else if (this.series.name.substring(0, 5) === 'Round') {
                            text += 'Heat Count: ' + this.point.y_count;
                        }
                    }
                    // if (mMaster.x.type === 'datetime') {
                    //     var text = 'y: ' + Highcharts.numberFormat(this.point.y, mMaster.y.decimals, '.', ',') + ' ' + mMaster.y.unit + '<br>';
                    //     if (this.series.name === 'Heats') {
                    //         text += 'x: ' + Highcharts.dateFormat('%m/%d/%Y %I:%M', this.point.x) + '<br>';
                    //         text += 'Heat ID: ' + this.point.info;
                    //     } else if (this.series.name.substring(0, 7) === 'Average') {
                    //         text += 'x: ' + Highcharts.dateFormat(mMaster.x.format, this.point.x) + ' (nearest ' + mMaster.x.round + ') <br>';
                    //         text += 'Heat Count: ' + this.point.info1 + ' <br>';
                    //         text += 'Std Dev: ' + Highcharts.numberFormat(this.point.info2, mMaster.y.decimals + 1);
                    //     }
                    // } else {
                    //     var text = 'y: ' + Highcharts.numberFormat(this.point.y, mMaster.y.decimals) + ' ' + mMaster.y.unit + '<br>';
                    //     if (this.series.name === 'Heats') {
                    //         text += 'x: ' + Highcharts.numberFormat(this.point.x, mMaster.x.decimals) + ' ' + mMaster.x.unit + '<br>';
                    //         text += 'Heat ID: ' + this.point.info;
                    //     } else if (this.series.name.substring(0, 7) === 'Average') {
                    //         text += 'x: ' + Highcharts.numberFormat(this.point.x, mMaster.x.decimals) + ' ' + mMaster.x.unit + ' (nearest ' + mMaster.x.round + ') <br>';
                    //         text += 'Heat Count: ' + this.point.info1 + ' <br>';
                    //         text += 'Std Dev: ' + Highcharts.numberFormat(this.point.info2, mMaster.y.decimals + 1);
                    //     }
                    // }


                    return text;
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