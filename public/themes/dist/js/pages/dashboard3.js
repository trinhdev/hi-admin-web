/* global Chart:false */
function drawChart() {
    let _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "/home/getDataChart",
        type: 'GET',
        data: {
            _token: _token
        },
        success: function (data) {
            drawchart1(data);
            drawchart2();
        },
        error: function (err) {}
    });
}

function drawchart1(response) {
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }
    var mode = 'index'
    var intersect = true
    var $revenueChart = $('#revenue-chart')

    let dates = [];
    let total = 0;
    let xeoto = {
        type: 'line',
        data: [],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
    };
    let xemay = {
        type: 'line',
        data: [],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
    };
    for(var i = 30;i>=1;i--){
        var d = new Date();
        d.setDate(d.getDate()-i);
        let date = formatDate(d);
        if(response[date] != undefined){
            let value = response[date];
            xeoto.data.push(value['XEOTO']);
            xemay.data.push(value['XEMAY']);
            total+=value['TOTAL'];
        }else{
            xeoto.data.push(0);
            xemay.data.push(0);
        }
        dates.push(date);
    }
    document.getElementById('total_oto_xemay').innerHTML = total;
    // eslint-disable-next-line no-unused-vars
    var revenueChart = new Chart($revenueChart, {
        data: {
            labels: dates,
            datasets: [xemay,xeoto]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'black'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 10,
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: true,
                        zeroLineColor: 'black'
                    },
                    ticks: $.extend({
                        autoSkip:false
                    }, ticksStyle)
                }]
            }
        }
    })
}

function drawchart2() {
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var $salesChart = $('#sales-chart')
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
                },
                {
                    backgroundColor: '#ced4da',
                    borderColor: '#ced4da',
                    data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,

                        // Include a dollar sign in the ticks
                        callback: function (value) {
                            if (value >= 1000) {
                                value /= 1000
                                value += 'k'
                            }

                            return '$' + value
                        }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
}
function formatDate(date) {
    if(date != null && date!= undefined){
        var day = date.getDate(); 
        if (day < 10) { 
            day = "0" + day; 
        } 
        var month = date.getMonth() + 1; 
        if (month < 10) { 
            month = "0" + month; 
        } 
        var year = date.getFullYear();
        return day + "-" + month + "-" + year; 
    }
}

function drawPaymentErrorTable() {
    let _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "/home/getPaymentErrorTableData",
        type: 'GET',
        data: {
            _token: _token
        },
        success: function (data) {
            drawchart1(data);
            drawchart2();
        },
        error: function (err) {}
    });
}

function drawPaymentErrorTable() {
    $('#error-payment-table').DataTable({
        "pageLength": 4,
        "searching": false,
        "lengthChange": false,
        "order": [],
        "processing": true,
        "serverSide": true,
        "select": true,
        "dataSrc": "tableData",
        "bDestroy": true,
        "scrollX": true,
        retrieve: true,
        "ajax": {
            url: "/home/getPaymentErrorTableData"
        },
        "columns": [{
            title: 'No.',
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        {
            data: 'error_name',
            name: "error_name",
            title: "Lỗi"
        },
        {
            data: "count",
            name: "count",
            title: "Số lượng"
        },
        ],
        "language": {
            "emptyTable": "No Record..."
        },
        "initComplete": function (setting, json) {
            $('#error-payment-table').show();
        },
        error: function (xhr, error, code) {
            
        },
        searchDelay: 500
    });
}
// lgtm [js/unused-local-variable]
// drawUserSystemEcom();
// drawUserSystemFtel();
// drawPaymentErrorDetailEcom();
// drawPaymentErrorDetailFtel();

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
    new Chart(document.getElementById('payment-error-user-system-' + type).getContext('2d'), {
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
    new Chart(document.getElementById("payment-error-detail-" + type), {
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
            }
        },
        data: data,
    });
}
