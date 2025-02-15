$(document).ready(function() {
    var ctx = document.getElementById('myBubbleChart').getContext('2d');
    var myBubbleChart;

    function getDataFromDB(ctype) {
        $.ajax({
            type: 'post',
            url: 'includes/wall_data.php',
            data: { action: 'getData' },
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response); // Debugging log to verify response structure

                // Populate chart
                reloadChart(ctype, response.labels, response.data, response.backgroundColor);

                // Populate Top 5 Lowest Wall Penetrations
                populateList("#lowestWall", response.lowestWall); // Use lowestWall key

                // Populate Top 5 Highest Wall Penetrations
                populateList("#highestWall", response.highestWall); // Use highestWall key
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }

    function reloadChart(chartType, labels, datasets, backColor) {
        if (myBubbleChart) {
            myBubbleChart.destroy(); // Destroy previous chart
        }

        // Bubble chart expects data as { x, y, r, label }
        const bubbleData = labels.map((label, index) => ({
            x: index + 1,          // Arbitrary X-axis value (could be weapon rank or ID)
            y: datasets[index],    // Wall Penetration on Y-axis
            r: 5,                 // Fixed bubble size (adjust as needed)
            label: label           // Store weapon name for tooltip
        }));

        myBubbleChart = new Chart(ctx, {
            type: chartType,
            data: {
                datasets: [{
                    label: 'Weapon Wall Penetration ( 3 - High, 2 - Medium, 1 - Low )',
                    data: bubbleData,
                    backgroundColor: backColor
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var data = tooltipItem.raw; // Access the hovered data
                                return `Name: ${data.label}, Wall Penetration: ${data.y}`;
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
                listElement.append(`<li class="list-group-item">${item.Name}: ${item.Wall_Penetration}</li>`);
            });
        } else {
            console.warn('No data available for:', selector);
        }
    }

    getDataFromDB('bubble'); // Initial call to fetch data
});
