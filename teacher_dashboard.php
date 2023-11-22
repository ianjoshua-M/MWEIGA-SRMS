<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to Teacher Dashboard</title>
    <link rel="stylesheet" type="text/css" href="tdcss.css">
</head>



<body>
<header>
        <h1>Welcome To Teacher Dashboard<br> <i>Fill Out Left Form To Add Results or Right Form To Delete Student Grades And Results.</i></h1>
        <a href="logout.php" style="color: white"><span class="fa fa-sign-out fa-2x">Logout</span></a>
    </header>

        <script>
        function validateForm() {
            var classSelect = document.forms["marks-form"]["class"].value;
            var regNumber = document.forms["marks-form"]["registrationNumber"].value;

            if (classSelect === "" || regNumber === "") {
                alert("Class and Registration Number must be filled out");
                return false;
            }

            // Validate marks for each subject
            var subjectCount = 8;
            for (var i = 1; i <= subjectCount; i++) {
                var subjectInput = document.forms["marks-form"]["subject" + i].value;
                if (isNaN(subjectInput) || subjectInput < 0 || subjectInput > 100) {
                    alert("Invalid marks for Subject " + i);
                    return false;
                }
            }

            return true;
        }
    </script>
<div class="teacher-dashboard-container">
        <!-- Form for entering raw marks -->
        <form action="process_add_results.php" method="post" onsubmit="return validateForm()">
        <label for="class">Class:</label>
            <select name="class" required>
                <option value="Form 1">Form 1</option>
                <option value="Form 2">Form 2</option>
                <option value="Form 3">Form 3</option>
                <option value="Form 4">Form 4</option>
               
            </select>
            <label for="registrationNumber">Registration Number:</label>
            <input type="text" name="registrationNumber" placeholder="Enter Registration Number" required>

            <!-- Add inputs for each subject -->
        
            <label for="subject1">Subject 1:</label>
            <input type="number" name="subject1" placeholder="Enter Marks" required>
            <label for="subject2">Subject 2:</label>
            <input type="number" name="subject2" placeholder="Enter Marks" required>
            <label for="subject3">Subject 3:</label>
            <input type="number" name="subject3" placeholder="Enter Marks" required>
            <label for="subject4">Subject 4:</label>
            <input type="number" name="subject4" placeholder="Enter Marks" required>
            <label for="subject5">Subject 5:</label>
            <input type="number" name="subject5" placeholder="Enter Marks" required>
            <label for="subject6">Subject 6:</label>
            <input type="number" name="subject6" placeholder="Enter Marks" required>
            <label for="subject7">Subject 7:</label>
            <input type="number" name="subject7" placeholder="Enter Marks" required>
            <label for="subject8">Subject 8:</label>
            <input type="number" name="subject8" placeholder="Enter Marks" required>


            <input type="submit" value="Enter Marks">

<script>
    function clearForm() {
        document.getElementById('form').reset();
    }
</script>

        </form>

        <!-- Form for deleting results -->
        <form action="process_delete_results.php" method="post">
            <label for="deleteRegNumber">Registration Number:</label>
            <input type="text" name="deleteRegNumber" placeholder="Enter Registration Number" required>

            <label for="class">Class:</label>
            <select name="class" required>
                <option value="Form 1">Form 1</option>
                <option value="Form 2">Form 2</option>
                <option value="Form 3">Form 3</option>
                <option value="Form 4">Form 4</option>
               
            </select>
            <input type="submit" value="Delete Results">
        </form>
    </div>
    <footer>
       <i><b>BUILT BY MURITHI.</i></b> 
    </footer>
</body>

</html>
