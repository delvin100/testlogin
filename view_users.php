<?php
$servername = "localhost";
$username = "root";
$password = ""; // Keep it empty if no password
$database = "userdb";
$port = 3307; // Use your MySQL port

// Connect to database
$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the table
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

// Display data
if ($result->num_rows > 0) {
    echo "<h2>Registered Users</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["username"]."</td>
                <td>".$row["email"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}

$conn->close();
?>
