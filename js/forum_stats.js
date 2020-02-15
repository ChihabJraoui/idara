$(document).ready(function()
{
    /*
     * 
     * get Statistics
     */
    
    var pChart = new CanvasJS.Chart("postsChart",{
        theme: "theme4",
        animationEnabled: true,
        data: [{
        type: "spline",
            showInLegend: true,
            legendText: "المواضيع",
            color: "#DE5F62",
            dataPoints: result
        },
        {
            type: "spline",
            showInLegend: true,
            legendText: "الردود",
            color: "#1FAEDE",
            dataPoints: result
        }]
    });
    pChart.render();
});