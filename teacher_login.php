<!DOCTYPE html>
<html lang="en">

<head>
    <title>Teacher Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="loginbox">
        <h1>Teacher Login</h1>
        <form action="teacher_dashboard.php" method="post">
            <p>Name</p>
            <input type="id" name="TeacherID" placeholder="Enter Teacher ID" required>
            <p>Password</p>
            <input type="Password" name="Password" placeholder="Enter Password" required>
            <input type="submit" name="" value="Login"><br>
        </form>
    </div>
</body>

</html>
<?php
include('init.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TeacherID = $_POST["TeacherID"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT TeacherID FROM Teacher WHERE TeacherID = ? AND Password = ?");
    $stmt->bind_param("ss", $TeacherID, $password);

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Teacher login successful
        echo '<script type="text/javascript">
                window.location = "teacher_dashboard.php"; // Redirect to teacher dashboard
              </script>';
    } else {
        // Teacher login failed
        echo '<script type="text/javascript">
                window.location = "login.php?error=1"; // Redirect to login page with an error message
              </script>';
    }
    $stmt->close();
}

?>


