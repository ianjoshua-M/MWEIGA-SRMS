
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="loginbox">
        <h1>Admin Login</h1>
        <form action="admin_login.php" method="post">
            <p>Admin ID</p>
            <input type="text" name="AdminID" placeholder="Enter Admin ID" required>
            <p>Password</p>
            <input type="Password" name="Password" placeholder="Enter Password" required>
            <input type="submit" value="Login"><br>
        </form>
    </div>
</body>

</html>
<?php
include('init.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AdminID = $_POST["AdminID"];
    $password = $_POST["Password"];

    $stmt = $conn->prepare("SELECT AdminID FROM Administrator WHERE AdminID = ? AND Password = ?");
    $stmt->bind_param("ss",$AdminID , $password);

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // admin login successful
        echo '<script type="text/javascript">
                window.location = "admin_dashboard.php"; // Redirect to admin dashboard
              </script>';
    } else {
        // admin login failed
        echo '<script type="text/javascript">
                window.location = "admin_login.php"; // Redirect to login page with an error message
              </script>';
    }
    $stmt->close();
}

?>
