google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChartTop);
    function drawChart() {    
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Login", 1620021, "#b87333"],
        ["FPT Play", 143002, "silver"],
        ["Demo", 19, "gold"],
        ["Demo 1", 21, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Biểu đồ thể hiện số lượng log trong vòng một tháng",
        width: 600,
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  function drawChartTop() {
    var data = google.visualization.arrayToDataTable([
      ["Element", "Density", { role: "style" } ],
      ["Login", 100300, "rgb(67, 116, 224)"],
      ["FPT Play", 11000, "rgb(67, 116, 224)"],
      ["Demo", 19, "rgb(67, 116, 224)"],
      ["Demo 1", 21, "rgb(67, 116, 224)"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "Biểu đồ thể hiện lưu lượng log hôm nay",
      width: 600,
      height: 300,
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_top"));
    chart.draw(view, options);
}