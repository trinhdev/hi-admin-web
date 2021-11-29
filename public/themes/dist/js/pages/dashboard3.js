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

function drawchart1(reponse) {
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
        if(reponse[date] != undefined){
            let value = reponse[date];
            xeoto.data.push(value['XEOTO']);
            xemay.data.push(value['XEMAY']);
            console.log(value);
            total+=value['TOTAL'];
        }else{
            xeoto.data.push(0);
            xemay.data.push(0);
        }
        dates.push(date);
    }
    total_oto_xemay.innerHTML = total;
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
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 10,
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
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
// lgtm [js/unused-local-variable]
