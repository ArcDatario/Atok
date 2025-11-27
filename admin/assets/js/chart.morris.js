$(document).ready(function(){
    // Only initialize charts if their containers exist
    if ($('#line-chart').length) {
        lineChart();
    }
    if ($('#donut-chart').length) {
        donutChart();
    }
    // Remove pieChart() call since you don't have pie-chart element
    
    $(window).resize(function(){
        if (window.lineChart) {
            window.lineChart.redraw();
        }
        if (window.donutChart) {
            window.donutChart.redraw();
        }
        // Remove pieChart redraw
    });
});

function lineChart(){
    window.lineChart = Morris.Line({
        element: 'line-chart',
        data: [
            { y: '2006', a: 100, b: 90 },
            { y: '2007', a: 75, b: 65 },
            { y: '2008', a: 50, b: 40 },
            { y: '2009', a: 75, b: 65 },
            { y: '2010', a: 50, b: 40 },
            { y: '2011', a: 75, b: 65 },
            { y: '2012', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        lineColors: ['#009688', '#cdc6c6'],
        lineWidth: '3px',
        resize: true,
        redraw: true
    });
}

function donutChart(){
    window.donutChart = Morris.Donut({
        element: 'donut-chart',
        data: [
            { label: "Normal Room", value: 50 },
            { label: "Ac Room", value: 25 },
            { label: "Special Room", value: 5 },
            { label: "DoubleBed room", value: 10 },
            { label: "Video Room", value: 10 }
        ],
        backgroundColor: '#f2f5fa',
        labelColor: '#009688',
        colors: ['#0BA462', '#39B580', '#67C69D', '#95D7BB'],
        resize: true,
        redraw: true
    });
}

