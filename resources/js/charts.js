axios.get('/dashboard/campaign-stats-json')
    .then(response => {
        console.log(response.data);
        const compaign_stats = response.data.compaign_stats;
        const total_compaigns = response.data.total_compaigns;
        document.querySelector('#total_compaigns').innerHTML = total_compaigns + ' compaign in total ';
        //chart
        var options = {

            chart: {
                type: 'area',
                height: 350,
            },
            series: [{
                name: 'Campaigns',
                data: compaign_stats.map(stat => stat.count),
            }],
            tooltip: {
                theme: "dark"
            },
            xaxis: {
                categories: compaign_stats.map(stat => stat.year),
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        //pie chart 

        const donors_per_aghermes = response.data.donors_per_aghermes;
        // Format the data for the pie chart
        const chartData = donors_per_aghermes.map(item => ({
            x: item.agherme,
            y: item.count
        }));
        // Create the ApexCharts configuration
        const options2 = {
            series: chartData.map(item => item.y),
            chart: {
                type: 'pie',
                height: 350
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    color: '#ffffff' // Change the tooltip text color to white
                  }
            },
            labels: chartData.map(item => item.x),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        // Render the pie chart
        const chart2 = new ApexCharts(document.querySelector("#donors_per_cities"), options2);
        chart2.render();

    })
    .catch(error => console.error(error));