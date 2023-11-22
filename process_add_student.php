<?php
include('init.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $registrationNumber = $_POST['registrationNumber'];
    $class = $_POST['class'];
    $gender = $_POST['gender'];

    // SQL query to insert data into the Student table
    $query = "INSERT INTO Student (Name, RegistrationNumber, Class, Gender) VALUES (?, ?, ?, ?)";

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $registrationNumber, $class, $gender);

    // Execute the statement
    if ($stmt->execute()) {
        // Student added successfully
        echo "student entered succesfully";
        header("Location: admin_dashboard.php");// Redirects to admin dashboard
        exit();
    } else {
        // Error in adding student
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
}
?>
