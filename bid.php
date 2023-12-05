<?php
// Database connection details
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "VRS2023";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the selected location
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedLocation = $_POST["location"];

    // Fetch doctors in the selected location from the database
    $sql = "SELECT * FROM doctors WHERE location = '$selectedLocation'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display a table with doctor information
        echo "<h2>Doctors in $selectedLocation</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Doctor Name</th>
                    <th>Specialty</th>
                    <th>Experience</th>
                    <th>Offer Job</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['specialty']}</td>
                    <td>{$row['experience']}</td>
                    <td><a href='make_offer.php?doctor_id={$row['id']}'>Make Offer</a></td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No doctors found in $selectedLocation.";
    }
}

$conn->close();
?>
