<?php
require_once('config.php');
$cn = new config();
$conn = $cn->connectDB();

if (isset($_POST['action']) && $_POST['action'] == "getData") {
    try {
        $data = [];
        $highestDamage = [];
        $lowestDamage = [];

        // Fetch weapon stats including all damage values
        $sql = "SELECT Name, Price, HDMG_0, BDMG_0, LDMG_0, HDMG_1, BDMG_1, LDMG_1, HDMG_2, BDMG_2, LDMG_2 FROM weaponstat";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalDamage = $row['HDMG_0'] + $row['BDMG_0'] + $row['LDMG_0'] +
                    $row['HDMG_1'] + $row['BDMG_1'] + $row['LDMG_1'] +
                    $row['HDMG_2'] + $row['BDMG_2'] + $row['LDMG_2'];

                $weapon = [
                    'Name' => $row['Name'],
                    'Price' => $row['Price'],
                    'TotalDamage' => $totalDamage,
                    'DamageValues' => [
                        'HDMG_0' => $row['HDMG_0'],
                        'BDMG_0' => $row['BDMG_0'],
                        'LDMG_0' => $row['LDMG_0'],
                        'HDMG_1' => $row['HDMG_1'],
                        'BDMG_1' => $row['BDMG_1'],
                        'LDMG_1' => $row['LDMG_1'],
                        'HDMG_2' => $row['HDMG_2'],
                        'BDMG_2' => $row['BDMG_2'],
                        'LDMG_2' => $row['LDMG_2']
                    ]
                ];
                $data[] = $weapon;
            }

            // Sort the weapons by TotalDamage in descending order
            usort($data, function ($a, $b) {
                return $b['TotalDamage'] - $a['TotalDamage'];
            });

            // Get top 10 highest and lowest damage weapons
            $highestDamage = array_slice($data, 0, 10); // Top 10 highest damage
            $lowestDamage = array_slice($data, -10, 10); // Bottom 10 damage
        }

        $conn->close();
    } catch (Exception $e) {
        $data = ["success" => false, "message" => "Failed to retrieve data!"];
    } finally {
        $stmt->close();
    }

    // Return JSON
    header("Content-Type: application/json");
    echo json_encode([
        'weapons' => $data,
        'highestDamage' => $highestDamage,
        'lowestDamage' => $lowestDamage
    ]);
}
?>