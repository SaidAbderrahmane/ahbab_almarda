axios.get('/dashboard/campaign-stats-json')
    .then(response => {
        console.log(response.data);
        //compaigns per year
        const campaigns_per_year = response.data.campaigns_per_year;
        const total_compaigns = response.data.total_compaigns;
        document.querySelector('#total_compaigns').innerHTML = 'Total compaigns : '+total_compaigns;
        //chart
        var options = {
            chart: {
                type: 'bar',
                height: 350,
            },
            series: [{
                name: 'Campaigns',
                data: campaigns_per_year.map(stat => stat.count),
            }],
            xaxis: {
                categories: campaigns_per_year.map(stat => stat.year),
            },
        };
        var chart = new ApexCharts(document.querySelector("#campaigns_per_year"), options);
        chart.render();


        // donations per year
        const donations_per_year = response.data.donations_per_year;
        document.querySelector('#total_compaigns').innerHTML = 'Total compaigns : '+total_compaigns;
        //chart
        var options = {

            chart: {
                type: 'area',
                height: 350,
            },
            series: [{
                name: 'Campaigns',
                data: donations_per_year.map(stat => stat.count),
            }],
            tooltip: {
                theme: "dark"
            },
            xaxis: {
                categories: donations_per_year.map(stat => stat.year),
            },
        };

        var chart = new ApexCharts(document.querySelector("#donations_per_year"), options);
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
        const chart2 = new ApexCharts(document.querySelector("#donations_per_cities"), options2);
        chart2.render();

    })
    .catch(error => console.error(error));