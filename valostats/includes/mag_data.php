<?php
require_once('config.php');
$cn = new config();
$conn = $cn->connectDB();

if (isset($_POST['action']) && $_POST['action'] == "getData") {
    try {
        $data = [
            "labels" => [],
            "data" => [],
            "backgroundColor" => [],
            "lowestMag" => [],
            "highestMag" => []
        ];

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
        $sql = "SELECT Name, Magazine_Capacity FROM weaponstat";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['labels'][] = $row['Name'];
                $data['data'][] = $row['Magazine_Capacity'];
                $data['backgroundColor'][] = $colors[$i % count($colors)];
                $i++;
            }
        }
        $stmt->close(); // Close the statement

        // Fetch Top 10 Lowest Magazine Capacities
        $lowestMagQuery = "SELECT Name, Magazine_Capacity FROM weaponstat ORDER BY Magazine_Capacity ASC LIMIT 10";
        $lowestMagStmt = $conn->prepare($lowestMagQuery);
        $lowestMagStmt->execute();
        $lowestMagResult = $lowestMagStmt->get_result();
        while ($row = $lowestMagResult->fetch_assoc()) {
            $data['lowestMag'][] = $row;
        }
        $lowestMagStmt->close();

        // Fetch Top 10 Highest Magazine Capacities
        $highestMagQuery = "SELECT Name, Magazine_Capacity FROM weaponstat ORDER BY Magazine_Capacity DESC LIMIT 10";
        $highestMagStmt = $conn->prepare($highestMagQuery);
        $highestMagStmt->execute();
        $highestMagResult = $highestMagStmt->get_result();
        while ($row = $highestMagResult->fetch_assoc()) {
            $data['highestMag'][] = $row;
        }
        $highestMagStmt->close();

        $conn->close();
    } catch (Exception $e) {
        $data = ["success" => false, "message" => "Failed to retrieve data: " . $e->getMessage()];
    }

    // Return JSON
    header("Content-Type: application/json");
    echo json_encode($data);
}
?>