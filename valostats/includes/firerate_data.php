<?php
require_once('config.php');
$cn = new config();
$conn = $cn->connectDB();

if (isset($_POST['action']) && $_POST['action'] == "getData") {
    try {
        $data = [];
        $colors = [
            '#FF5733',
            '#33FF57',
            '#5733FF',
            '#FFC300',
            '#C70039',
            '#900C3F',
            '#581845',
            '#DAF7A6',
            '#FF6F61',
            '#6A0572',
            '#0D98BA',
            '#FFB6C1',
            '#FFD700',
            '#008080'
        ];

        // Fetch weapon stats for chart
        $sql = "SELECT Name, Fire_Rate FROM weaponstat";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['Name'];
                $data['data'][] = $row['Fire_Rate'];
                $data['backgroundColor'][] = $colors[$i % count($colors)];
                $i++;
            }
        }

        // Fetch Top 10 Lowest Fire Rates
        $lowestRatesQuery = "SELECT Name, Fire_Rate FROM weaponstat ORDER BY Fire_Rate ASC LIMIT 10";
        $lowestRatesStmt = $conn->prepare($lowestRatesQuery);
        $lowestRatesStmt->execute();
        $lowestRatesResult = $lowestRatesStmt->get_result();
        $lowestRates = [];
        if ($lowestRatesResult->num_rows > 0) {
            while ($row = $lowestRatesResult->fetch_assoc()) {
                $lowestRates[] = $row;
            }
        }

        // Fetch Top 10 Highest Fire Rates
        $highestRatesQuery = "SELECT Name, Fire_Rate FROM weaponstat ORDER BY Fire_Rate DESC LIMIT 10";
        $highestRatesStmt = $conn->prepare($highestRatesQuery);
        $highestRatesStmt->execute();
        $highestRatesResult = $highestRatesStmt->get_result();
        $highestRates = [];
        if ($highestRatesResult->num_rows > 0) {
            while ($row = $highestRatesResult->fetch_assoc()) {
                $highestRates[] = $row;
            }
        }

        // Include lowest and highest fire rates in the response
        $data['lowestRates'] = $lowestRates;
        $data['highestRates'] = $highestRates;

        $conn->close();
    } catch (Exception $e) {
        $data = ["success" => false, "message" => "Failed to retrieve data!"];
    } finally {
        if (isset($stmt))
            $stmt->close();
    }

    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($data);
}
?>