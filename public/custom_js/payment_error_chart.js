var chart_name = [];
var detailChart = [];
var myChart = null;
var show_from_last = $('#show_from_last').val();
var show_to_last = $('#show_to_last').val();
var show_from = $('#show_from').val();
var show_to = $('#show_to').val();

// console.log(show_from);
drawUserSystemEcom();
drawUserSystemFtel();
drawPaymentErrorDetailEcom();
drawPaymentErrorDetailFtel();
$("#filter_condition").click(function() {
    var show_from_last = $('#show_from_last').val();
    var show_to_last = $('#show_to_last').val();
    var show_from = $('#show_from').val();
    var show_to = $('#show_to').val();
    // console.log(show_from);
    if(show_from && show_to && show_from_last && show_to_last) {
        showLoadingIcon();
        drawUserSystemEcom(show_from_last, show_to_last, show_from, show_to);
        drawUserSystemFtel(show_from_last, show_to_last, show_from, show_to);
        drawPaymentErrorDetailEcom(show_from, show_to);
        drawPaymentErrorDetailFtel(show_from, show_to);
    }
    else {
        swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `Xin vui lòng chọn ngày để lọc.`
        });
    }
});

function drawUserSystemEcom(from_last, to_last, from, to) {
    $.ajax({
        url: "/errorpaymentchart/getPaymentErrorUserSystem",
        type: 'POST',
        data: {
            from_last: from_last,
            to_last: to_last,
            from: from,
            to: to,
            type: 'ecom'
        },
        success: function (data) {
            drawChartUserSystem('ecom', data);
        },
        error: function (err) {}
    });
}

function drawUserSystemFtel(from_last, to_last, from, to) {
    $.ajax({
        url: "/errorpaymentchart/getPaymentErrorUserSystem",
        type: 'POST',
        data: {
            from_last: from_last,
            to_last: to_last,
            from: from,
            to: to,
            type: 'ftel'
        },
        success: function (data) {
            drawChartUserSystem('ftel', data);
            $("#spinner").removeClass("show");
        },
        error: function (err) {}
    });
}

function drawChartUserSystem(type, data) {
    // myLineChart.destroy();
    if(chart_name[type]) {
        chart_name[type].destroy();
    }
    
    chart_name[type] = new Chart(document.getElementById('payment-error-user-system-' + type).getContext('2d'), {
        type: 'bar',
        data: data,
        options: {
            title: {
                display: true,
                text: 'Báo cáo lỗi thanh toán do người dùng / lỗi hệ thống ' + type,
                align: 'center',
                position: 'bottom'
            },
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        min: 0
                    },
                    stacked: true
                }],
                xAxes: [{
                    stacked: true,
                    barPercentage: 0.4
                }]
            },
            responsive: true,
        },
    });
}

function drawPaymentErrorDetailEcom(from = null, to = null) {
    $.ajax({
        url: '/errorpaymentchart/getPaymentErrorDetail',
        type:'POST',
        data: {
            from: from,
            to: to,
            type: 'ecom'
        },
        success: function (response){
            drawPaymentErrorDetailChart('ecom', response);
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showError(errorString);
            console.log(data);
        }
    });
}

function drawPaymentErrorDetailFtel(from = null, to = null) {
    $.ajax({
        url: '/errorpaymentchart/getPaymentErrorDetail',
        type:'POST',
        data: {
            from: from,
            to: to,
            type: 'ftel'
        },
        success: function (response){
            drawPaymentErrorDetailChart('ftel', response);
        },
        error: function (xhr) {
            var errorString = '';
            $.each(xhr.responseJSON.errors, function (key, value) {
                errorString = value;
                return false;
            });
            showError(errorString);
            console.log(data);
        }
    });
}

function drawPaymentErrorDetailChart(type, data) {
    if(detailChart[type]) {
        detailChart[type].destroy();
    }
    detailChart[type] = new Chart(document.getElementById("payment-error-detail-" + type), {
        type: 'doughnut',
        options: {
            title: {
                display: true,
                text: 'Báo cáo lỗi thanh toán chi tiết cho ' + type,
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
            tooltip: {
                display: true
            },
            legendCallback: function (chart) {             
                // Return the HTML string here.
                var text = [];
                text.push('<ul style="display: flex; flex-direction: row; margin: 0px; padding: 0px; flex-wrap: wrap;" class="' + chart.id + '-legend">');
                for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                    text.push('<li style="align-items: center; cursor: pointer; display: flex; flex-direction: row; margin-left: 10px; margin-bottom: 10px"><span id="legend-' + i + '-item" style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '; border-width: 3px; display: inline-block; height: 20px; margin-right: 10px; width: 20px;" onclick="updateDataset(event, ' + '\'' + i + '\'' + ')"></span><p style="color: rgb(102, 102, 102); margin: 0px; padding: 0px;">');
                    if (chart.data.labels[i]) {
                        text.push(chart.data.labels[i]);
                        text.push(' (' + chart.data.datasets[0]['data'][i] + ')');
                    }
                    text.push('</p></li>');
                }
                text.push('</ul>');
                $('#legend-container-' + type).html(text.join(""));
            },
        },
        data: data,
    });
    detailChart[type].generateLegend();
}

function showLoadingIcon() {
    $("#spinner").addClass("show");
    setTimeout(function () {
        $("#spinner").removeClass("show");
    }, 50000);
}