<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "integrative1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data["name"]) && !empty($data["name"]) && !empty($data["age"]) && !empty($data["phoneNumber"])) {
    $name = $conn->real_escape_string($data["name"]);
    $email = $conn->real_escape_string($data["email"]);
    $age = $conn->real_escape_string($data["age"]);
    $phoneNumber = $conn->real_escape_string($data["phoneNumber"]);

    $sql = "INSERT INTO clients (name, email, age, phoneNumber) VALUES ('$name', '$email', '$age', '$phoneNumber')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => " data added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
}

$conn->close();

?>