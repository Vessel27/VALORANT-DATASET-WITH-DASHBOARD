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
            '#008080',
            '#4B0082',
            '#00FA9A',
            '#A52A2A',
            '#D2691E',
            '#FF4500',
            '#2E8B57',
            '#191970',
            '#DC143C',
            '#00CED1',
            '#4682B4',
            '#8B4513',
            '#20B2AA',
            '#FF1493',
            '#E9967A',
            '#FFDAB9',
            '#B0C4DE',
            '#556B2F',
            '#7B68EE',
            '#ADFF2F',
            '#F5DEB3',
            '#696969'
        ];

        // Fetch all weapon stats
        $sql = "SELECT Name, Price FROM weaponstat";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['Name'];
                $data['data'][] = $row['Price'];
                $data['backgroundColor'][] = $colors[$i % count($colors)];
                $i++;
            }
        }

        // Fetch Top 5 Lowest Prices
        $lowestPricesQuery = "SELECT Name, Price FROM weaponstat ORDER BY Price ASC LIMIT 10";
        $lowestPricesStmt = $conn->prepare($lowestPricesQuery);
        $lowestPricesStmt->execute();
        $lowestPricesResult = $lowestPricesStmt->get_result();
        $lowestPrices = [];
        if ($lowestPricesResult->num_rows > 0) {
            while ($row = $lowestPricesResult->fetch_assoc()) {
                $lowestPrices[] = $row;
            }
        }

        // Fetch Top 5 Highest Prices
        $highestPricesQuery = "SELECT Name, Price FROM weaponstat ORDER BY Price DESC LIMIT 10";
        $highestPricesStmt = $conn->prepare($highestPricesQuery);
        $highestPricesStmt->execute();
        $highestPricesResult = $highestPricesStmt->get_result();
        $highestPrices = [];
        if ($highestPricesResult->num_rows > 0) {
            while ($row = $highestPricesResult->fetch_assoc()) {
                $highestPrices[] = $row;
            }
        }

        // Include lowest and highest prices in the response
        $data['lowestPrices'] = $lowestPrices;
        $data['highestPrices'] = $highestPrices;

        $conn->close();
    } catch (Exception $e) {
        $response = ["success" => false, "message" => "Failed to retrieve data!"];
    } finally {
        $stmt->close();
    }

    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($data);
}
?>