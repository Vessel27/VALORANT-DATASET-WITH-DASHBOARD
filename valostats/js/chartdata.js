$(document).ready(function() {
    var ctx = document.getElementById('myDonutChart').getContext('2d');
    var myDonutChart;

    function getDataFromDB(ctype) {
        $.ajax({
            type: 'post',
            url: 'includes/fetch_data.php',
            data: { action: 'getData' },
            dataType: 'json',
            success: function(response) {
                // Populate chart
                reloadChart(ctype, response.labels, response.data, response.backgroundColor);
                
                // Populate Top 5 Lowest Prices
                populateList("#lowestPrices", response.lowestPrices);
                
                // Populate Top 5 Highest Prices
                populateList("#highestPrices", response.highestPrices);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }

    function reloadChart(chartType, labels, datasets, backColor) {    
        if (myDonutChart) {
            myDonutChart.destroy();
        }
        myDonutChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    data: datasets,
                    backgroundColor: backColor,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            generateLabels: function(chart) {
                                return chart.data.labels.map(function(label, index) {
                                    return {
                                        text: label,
                                        fillStyle: chart.data.datasets[0].backgroundColor[index]
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });
    }

    function populateList(selector, items) {
        const listElement = $(selector);
        listElement.empty(); // Clear any existing items

        items.forEach(item => {
            listElement.append(`<li class="list-group-item">${item.Name}: $${item.Price}</li>`);
        });
    }

    getDataFromDB('doughnut');
});
