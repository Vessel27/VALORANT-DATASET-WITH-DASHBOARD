$(document).ready(function() {
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var myBarChart;

    function getDataFromDB(ctype) {
        $.ajax({
            type: 'post',
            url: 'includes/mag_data.php',
            data: { action: 'getData' },
            dataType: 'json',
            success: function(response) {
                if (response && response.labels && response.data && response.backgroundColor) {
                    // Populate chart
                    reloadChart(ctype, response.labels, response.data, response.backgroundColor);
                    
                    // Populate Top 5 Lowest Prices
                    populateList("#lowestMag", response.lowestMag);
                    
                    // Populate Top 5 Highest Prices
                    populateList("#highestMag", response.highestMag);
                } else {
                    console.error("Invalid response format:", response);
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
                console.log('Response text:', xhr.responseText);
            }
        });
    }

    function reloadChart(chartType, labels, datasets, backColor) {    
        if (myBarChart) {
            myBarChart.destroy();
        }
        myBarChart = new Chart(ctx, {
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

        if (items && Array.isArray(items)) {
            items.forEach(item => {
                listElement.append(`<li class="list-group-item">${item.Name}: ${item.Magazine_Capacity}</li>`);
            });
        } else {
            console.warn('No data available for:', selector);
        }
    }

    getDataFromDB('bar');
});
