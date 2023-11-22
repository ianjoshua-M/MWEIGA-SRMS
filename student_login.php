<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="loginbox">
        <h1>Student Login</h1>
        <form action="student_login.php" method="post">
            <p>Registration Number</p>
            <input type="text" name="reg_number" placeholder="Enter Registration Number" required>
            <p>Class</p>
            <select name="class">
                <option value="Form 1">Form 1</option>
                <option value="Form 2">Form 2</option>
                <option value="Form 3">Form 3</option>
                <option value="Form 4">Form 4</option>
            </select>
            <input type="submit" name="get_result" value="Get Result"><br>
        </form>
    </div>
</body>

</html>

<?php
include('init.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['get_result'])) {
    $registrationNumber = $_POST['reg_number'];
    $class = $_POST['class'];

    // Fetch student information
    $studentQuery = "SELECT * FROM Student WHERE RegistrationNumber = '$registrationNumber' AND Class = '$class'";
    $studentResult = $conn->query($studentQuery);
    $student = $studentResult->fetch_assoc();

    // Fetch result information
    $resultQuery = "SELECT * FROM Result WHERE StudentID = {$student['StudentID']}";
    $resultResult = $conn->query($resultQuery);
    $result = $resultResult->fetch_assoc();

    // Check if both student and result data exist
    if ($student && $result) {
        // Redirect to student_dashboard.php with parameters
        header("Location: student_dashboard.php?studentID={$student['StudentID']}&regNumber={$student['RegistrationNumber']}&class={$student['Class']}");
        exit();
    } else {
        // Display a message if no data is found
        echo "<div class='resultbox'>";
        echo "<p>No data found for the provided registration number and class.</p>";
        echo "</div>";
    }
}
?>
