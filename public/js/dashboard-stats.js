$(function () {

    // Get the CSV and create the chart
    chart_area = new Highcharts.Chart({
        chart: {
            renderTo: 'grafico',
            defaultSeriesType: 'area',
        },
        title: {
            display: false,
            text: 'Indice de Competitividade',
            align: 'left'
        },
        
        exporting: {
            enabled: false
        },
        

        legend: {
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'bottom',
            /*x: 30,*/
            /*y: '10%',*/
            floating: false,
            borderWidth: 0,
            backgroundColor: '#FFFFFF',
            itemStyle: {
                color: '#000000',
                fontWeight: 'normal',
                fontSize: "15px"
            }
        },
        xAxis: {
            categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        },
        yAxis: {
            title: {
                text: ''
            },
            labels: {
                formatter: function() {
                    return 'R$ '+this.value;
                }
            }
        },
        tooltip: {
            formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +':<b> R$ '+ this.y +'</b>';
            }
        },
        plotOptions: {
            area: {
                fillOpacity: 0.5
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Receita',
            data: [31.10, 27.00, 24.15, 24.63, 15.00, 12.00, 23.00, 20.00, 19.00, 21.00, 24.00, 24.00]
        }, {
            name: 'Despesa',
            data: [21.00, 10.00, 13.00, 10.00, 12.00, 2.00, 5.00, 6.00, 3.00, 0.00, 3.00, 10.00]
        }]
    });

});