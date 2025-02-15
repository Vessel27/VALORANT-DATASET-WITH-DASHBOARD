$(document).ready(function() {
    var ctx = document.getElementById('myRadarChart').getContext('2d');
    var myRadarChart;

    function getDataFromDB() {
        $.ajax({
            type: 'post',
            url: 'includes/dmgdata.php',
            data: { action: 'getData' },
            dataType: 'json',
            success: function(response) {
                // Populate Radar Chart with damage values
                reloadRadarChart(response.weapons);

                populateList("#topMostDamageWeapons", response.lowestDamage);
                populateList("#topLeastDamageWeapons", response.highestDamage);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }

    function reloadRadarChart(data) {
        var labels = [
            "HDMG_0", "BDMG_0", "LDMG_0",
            "HDMG_1", "BDMG_1", "LDMG_1",
            "HDMG_2", "BDMG_2", "LDMG_2"
        ];

        var datasets = data.map(function(weapon, index) {
            return {
                label: weapon.Name,
                data: Object.values(weapon.DamageValues),
                backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`,
                borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                borderWidth: 1
            };
        });

        if (myRadarChart) {
            myRadarChart.destroy();
        }

        myRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        suggestedMin: 0,
                        suggestedMax: 150 // Adjust based on your data
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    }


    function populateList(selector, items) {
        var list = $(selector);
        list.empty(); // Clear the list

        items.forEach(function(item) {
            list.append(`<li class="list-group-item">${item.Name} - Total Damage: ${item.TotalDamage}</li>`);
        });
    }


    // Initialize chart
    getDataFromDB();
});
