/*
 *  Get WebSite Hits This Week
 */
function getWebsiteHits()
{
    $.ajax({
        type: 'POST',
        url: 'statistics/getWebsiteHits',
        data:{
            ajax: true
        },
        dataType: 'json',
        success: function(result)
        {
            var data = {
                labels: ["الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت", " الأحد"],
                datasets: [{
                    label: "النقرات",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: result.data
                }]
            };

            var ctx = document.getElementById("hits-chart").getContext("2d");
            var hitsChart = new Chart(ctx).Line(data, {
                responsive: true
            });
        }
    });
}

/*
 * Get Unique Visitors This Week
 */
function getUniqueVisitors()
{
    $.ajax({
        type: 'POST',
        url: 'statistics/getUniqueVisitors',
        data:{
            ajax: true
        },
        dataType: 'json',
        error: function(data)
        {
            console.log(data);
        },
        success: function(result)
        {
            var data = {
                labels: ["الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت", " الأحد"],
                datasets: [{
                    label: "الزوار",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: result.data
                }]
            };

            var ctx = document.getElementById("visitors-chart").getContext("2d");
            var visitorsChart = new Chart(ctx).Line(data, {
                responsive: true
            });
        }
    });
}

$(document).ready(function()
{
    getWebsiteHits();
    getUniqueVisitors();

    $("#refresh-hits-chart").click(function()
    {
        getWebsiteHits();
    });

    $("#refresh-visitors-chart").click(function()
    {
        getUniqueVisitors();
    });




    /*
     *    Members Levels
     */

    $.ajax({
        type: 'POST',
        url: 'member/getMembersLevels',
        data:{
            ajax: true
        },
        dataType: 'json',
        error: function(data)
        {
            console.log(data);
        },
        success: function(result)
        {
            var data = [
                {
                    value: result.data[0],
                    color:"#616161",
                    highlight: "#424242",
                    label: result.label[0]
                },
                {
                    value: result.data[1],
                    color: "#EF5350",
                    highlight: "#F44336",
                    label: result.label[1]
                },
                {
                    value: result.data[2],
                    color: "#FFCA28",
                    highlight: "#FFC107",
                    label: result.label[2]
                },
                {
                    value: result.data[3],
                    color: "#42A5F5",
                    highlight: "#2196F3",
                    label: result.label[3]
                }];

            var ctx = document.getElementById("members-pie").getContext("2d");
            new Chart(ctx).Doughnut(data, {
                responsive: true,
                animation: false
            });
        }
    });




    /*
     *    Locked Members
     */

    $.ajax({
        type: 'POST',
        url: 'member/getLockedMembers',
        data:{
            ajax: true
        },
        dataType: 'json',
        error: function(data)
        {
            console.log(data);
        },
        success: function(result)
        {
            var data = [
                {
                    value: result.data[0],
                    color:"#EF5350",
                    highlight: "#F44336",
                    label: result.label[0]
                },
                {
                    value: result.data[1],
                    color: "#4CAF50",
                    highlight: "#66BB6A",
                    label: result.label[1]
                }];

            var ctx = document.getElementById("locked-members-pie").getContext("2d");
            new Chart(ctx).Pie(data, {
                responsive: true,
                animation: false
            });
        }
    });
});
