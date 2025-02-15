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
        $sql = "SELECT Name, Wall_Penetration FROM weaponstat";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['Name'];
                $data['data'][] = $row['Wall_Penetration'];
                $data['backgroundColor'][] = $colors[$i % count($colors)];
                $i++;
            }
        }

        // Fetch Top 10 Lowest Fire Rates
        $lowestWallQuery = "SELECT Name, Wall_Penetration FROM weaponstat ORDER BY Wall_Penetration ASC LIMIT 10";
        $lowestWallStmt = $conn->prepare($lowestWallQuery);
        $lowestWallStmt->execute();
        $lowestWallResult = $lowestWallStmt->get_result();
        $lowestWall = [];
        if ($lowestWallResult->num_rows > 0) {
            while ($row = $lowestWallResult->fetch_assoc()) {
                $lowestWall[] = $row;
            }
        }

        // Fetch Top 10 Highest Fire Rates
        $highestWallQuery = "SELECT Name, Wall_Penetration FROM weaponstat ORDER BY Wall_Penetration DESC LIMIT 10";
        $highestWallStmt = $conn->prepare($highestWallQuery);
        $highestWallStmt->execute();
        $highestWallResult = $highestWallStmt->get_result();
        $highestWall = [];
        if ($highestWallResult->num_rows > 0) {
            while ($row = $highestWallResult->fetch_assoc()) {
                $highestWall[] = $row;
            }
        }

        // Include lowest and highest fire rates in the response
        $data['lowestWall'] = $lowestWall;
        $data['highestWall'] = $highestWall;

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