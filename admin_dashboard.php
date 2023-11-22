
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome To Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> 
</head>

<body>
    <header>
        <h1>Welcome To Admin Dashboard<br><i> Please Fill Out The Form Below To Add Student.</i></h1>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x"><b><i>Logout</i></b></span></a>
    </header>
    <div>
    <a href="view_students.php">View Students</a>
   </div>
    <script>
        function validateForm() {
            var name = document.forms["addStudentForm"]["name"].value;
            var regNumber = document.forms["addStudentForm"]["registrationNumber"].value;
            var classValue = document.forms["addStudentForm"]["class"].value;
            var gender = document.forms["addStudentForm"]["gender"].value;

            if (name == "" || regNumber == "" || classValue == "" || gender == "") {
                alert("All fields must be filled out");
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <form action="process_add_student.php" method="post" class="student-form">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Enter Name" required>

            <label for="registrationNumber">Registration Number:</label>
            <input type="text" name="registrationNumber" placeholder="Enter Registration Number" required>

            <label for="class">Class:</label>
            <select name="class" required>
                <option value="Form 1">Form 1</option>
                <option value="Form 2">Form 2</option>
                <option value="Form 3">Form 3</option>
                <option value="Form 4">Form 4</option>
               
            </select>

            <label for="gender">Gender:</label>
            <input type="text" name="gender" placeholder="Enter Gender" required>

            <input type="submit" value="Add Student">
        </form>
    </div>

    <footer>
    <i><b>BUILT BY MURITHI.</i></b> 
    </footer>
</body>

</html>