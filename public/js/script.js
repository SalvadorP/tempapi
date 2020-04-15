var url = "http://192.168.2.76/api/v1/measures";
var labels = [];
var temps = [];
var humidities = [];
var backgroundChartColors = {
    red: 'rgb(255, 99, 132, 0.2)',
	orange: 'rgb(255, 159, 64, 0.2)',
	yellow: 'rgb(255, 205, 86, 0.2)',
	green: 'rgb(75, 192, 192, 0.2)',
	blue: 'rgb(54, 162, 235, 0.2)',
	purple: 'rgb(153, 102, 255, 0.2)',
	grey: 'rgb(201, 203, 207, 0.2)'
};
var chartColors = {
    red: 'rgb(255, 99, 132',
	orange: 'rgb(255, 159, 64',
	yellow: 'rgb(255, 205, 86',
	green: 'rgb(75, 192, 192',
	blue: 'rgb(54, 162, 235',
	purple: 'rgb(153, 102, 255',
	grey: 'rgb(201, 203, 207'
};

fetch(url)
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    console.log(myJson);
    labels = _.map(myJson, function(measure){
        var hour = moment(measure.created_at);
        return hour.format("DD/MM/YYYY HH:mm:ss");
        // return measure.id;
    });
    temps = _.map(myJson, function(measure){
        return parseFloat(measure.temperature);
    });
    humidities = _.map(myJson, function(measure) {
        return parseFloat(measure.humidity);
    });
    console.log('labels');
    console.log(labels);
    console.log('temps');
    console.log(temps);
    console.log('humidities');
    console.log(humidities);

    var ctx = document.getElementById('myChart');
    data = {
        labels: labels,
        datasets: [
            {
                label: 'Temperatures',
                data: temps,
                backgroundColor: [
                    backgroundChartColors.red
                ],
                borderColor: [
                    chartColors.blue
                ],
                borderWidth: 1
            },
            {
                label: 'Humidities',
                data: humidities,
                backgroundColor: [
                    backgroundChartColors.purple
                ],
                borderColor: [
                    chartColors.green
                ],
                borderWidth: 1
            }
    ]
    };
    options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });
  });
