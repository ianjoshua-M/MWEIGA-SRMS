<?php
include('init.php');

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regNumber = $_POST["deleteRegNumber"];
    $class = $_POST["class"];

    // Delete results for the specified student
    $deleteQuery = "DELETE FROM Result WHERE StudentID = (SELECT StudentID FROM Student WHERE RegistrationNumber = ? AND Class = ?)";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ss", $regNumber, $class);
    $stmt->execute();
    $deleteQuery = "DELETE FROM Grade WHERE StudentID = (SELECT StudentID FROM Student WHERE RegistrationNumber = ? AND Class = ?)";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ss", $regNumber, $class);
    $stmt->execute();


    echo "Results and Grades deleted successfully!";
    header("Location: teacher_dashboard.php");
} else {
    echo "Invalid request!";
}

// Close the connection
$conn->close();
?>
