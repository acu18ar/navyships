var labelsDistancias=[];
var ctx = document.getElementById('myChart').getContext('2d');
var data=[];
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
            responsive: true,
            title: {
                display: true,
                text: 'GRAFICA DEL TERRENO',
                fontColor: 'white'
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Distancia',
                        fontColor: 'white'
                    },
                    ticks: {
                        fontColor: 'white',
                    },
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Altura (m.s.n.m)',
                        fontColor: 'white'
                    },
                    ticks: {
                        fontColor: 'white',
                    },
                }]
            },
            legend: {
                display: false,
            },
        }
});

function graphicDates(data) {
    var dates={};
    dates['labels']=labelsDistancias;
    var alturas=[];
    data['data'].forEach(function(item){
        alturas.push(item);
    });
    dates['datasets']=[{
        data: alturas,
        label: "TERRENO",
        borderColor: "#D2691E",
        fill: true,
        backgroundColor: "#DEB887"
    }];
    myLineChart.data=dates;
    myLineChart.update();
}