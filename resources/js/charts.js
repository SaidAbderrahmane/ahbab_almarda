// var options = {
//     chart: {
//       type: 'line'
//     },
//     series: [{
//       name: 'donations',
//       data: window.age_counts
//     }],
//     xaxis: {
//       categories: window.years
//     }
//   }
  
//   var chart = new ApexCharts(document.querySelector("#chart"), options);
  
//   chart.render();
axios.get('/dashboard/campaign-stats-json')
    .then(response => {
        var campaign_stats = response.data;

        var options = {
            chart: {
                type: 'bar',
                height: 350,
            },
            series: [{
                name: 'Campaigns',
                data: campaign_stats.map(stat => stat.count),
            }],
            xaxis: {
                categories: campaign_stats.map(stat => stat.year),
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    })
    .catch(error => console.error(error));