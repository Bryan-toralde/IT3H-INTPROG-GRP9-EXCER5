<?php
$dbhost = "localhost";  
$dbuser = "dbusername"; 
$dbpass = "dbpassword";  
$dbname = "dbname";     


$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$age = $_GET['age'];
$sex = $_GET['sex'];
$wpm = $_GET['wpm'];

$age = $conn->real_escape_string($age);
$sex = $conn->real_escape_string($sex);
$wpm = $conn->real_escape_string($wpm);


$query = "SELECT * FROM ajax_example WHERE sex = '$sex'";
if (is_numeric($age)) {
    $query .= " AND age <= $age";
}
if (is_numeric($wpm)) {
    $query .= " AND wpm <= $wpm";
}


$result = $conn->query($query);


$display_string = "<table border='1'><tr><th>Name</th><th>Age</th><th>Sex</th><th>WPM</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $display_string .= "<tr><td>" . $row["name"] . "</td><td>" . $row["age"] . "</td><td>" . $row["sex"] . "</td><td>" . $row["wpm"] . "</td></tr>";
    }
} else {
    $display_string .= "<tr><td colspan='4'>No results found</td></tr>";
}

$display_string .= "</table>";
echo $display_string;

$conn->close();
?>