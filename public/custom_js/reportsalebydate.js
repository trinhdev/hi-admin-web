$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
        // theme: "classic",
        closeOnSelect: false
    }); 
});

function drawPaymentErrorDetailChart(service, data, chartId, legendId, type) {
    if(detailChart[service + type]) {
        detailChart[service + type].destroy();
    }
    detailChart[service + type] = new Chart(document.getElementById(chartId), {
        type: 'doughnut',
        options: {
            title: {
                display: true,
                text: 'Báo cáo doanh số sản phẩm ' + service.toUpperCase() + ' theo hãng sản xuất',
                align: 'center',
                position: 'bottom'
            },
            scales: {
                yAxes: {
                    beginAtZero: true
                }
            },
            responsive: true,
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        console.log(data);
                        var label = data.labels[tooltipItem.index].toUpperCase() || '';

                        if (label) {
                            label += ': ';
                        }
                        label += data.datasets[0]['data'][tooltipItem.index].toLocaleString('en-US');
                        return label;
                    }
                }
            },
            legendCallback: function (chart) {             
                // Return the HTML string here.
                var text = [];
                text.push('<ul style="display: flex; flex-direction: row; margin: 0px; padding: 0px; flex-wrap: wrap;" class="' + chart.id + '-legend">');
                for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                    text.push('<li style="align-items: center; cursor: pointer; display: flex; flex-direction: row; margin-left: 10px; margin-bottom: 10px"><span id="legend-' + i + '-item" style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '; border-width: 3px; display: inline-block; height: 20px; margin-right: 10px; width: 20px;" onclick="updateDataset(event, ' + '\'' + i + '\'' + ')"></span><p style="color: rgb(102, 102, 102); margin: 0px; padding: 0px;">');
                    if (chart.data.labels[i]) {
                        text.push(chart.data.labels[i].toUpperCase());
                        text.push(' (' + chart.data.datasets[0]['data'][i].toLocaleString('en-US') + ')');
                    }
                    text.push('</p></li>');
                }
                text.push('</ul>');
                $('#' + legendId).html(text.join(""));
            },
        },
        data: data,
    });
    detailChart[service + type].generateLegend();
}

function dataChartProduct(reportdatabyproduct) {
    $.each( reportdatabyproduct, function( key, value ) {
        var dataChart = {
            'labels'                    : [],
            'datasets'                  : [
                {
                    'data'              : [],
                    'backgroundColor'   : []
                }
            ]
        };

        dataChart['labels'] = arrayColumn(value, 'product_type');
        for(var i = 0; i < value.length; i++) {
            dataChart['datasets'][0]['data'].push(parseInt(value[i]['amount']));
            dataChart['datasets'][0]['backgroundColor'].push('#' + randomColor());
        }
        drawPaymentErrorDetailChart(key, dataChart, 'sale-report-by-product-' + key, 'legend-container-' + key, 'product');
    });
}

function dataChartCategory(reportdatabycategory) {
    $.each( reportdatabycategory, function( key, value ) {
        var dataChart = {
            'labels'                    : [],
            'datasets'                  : [
                {
                    'data'              : [],
                    'backgroundColor'   : []
                }
            ]
        };

        dataChart['labels'] = arrayColumn(value, 'product_category');
        for(var i = 0; i < value.length; i++) {
            dataChart['datasets'][0]['data'].push(parseInt(value[i]['amount']));
            dataChart['datasets'][0]['backgroundColor'].push('#' + randomColor());
        }
        drawPaymentErrorDetailChart(key, dataChart, 'sale-report-by-category-' + key, 'legend-container-category-' + key, 'category');
    });
}

