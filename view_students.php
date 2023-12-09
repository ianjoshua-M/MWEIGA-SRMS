<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .class-list {
            margin-bottom: 20px;
            text-align: center;
        }

        .class-list button {
            margin: 5px;
            padding: 8px 12px;
            font-size: 16px;
            cursor: pointer;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .student-table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Student List</h2>

        <!-- Class List -->
        <div class="class-list">
            <?php
            include('init.php'); 

            // Fetch distinct classes from the database
            $classListQuery = "SELECT DISTINCT Class FROM Student";
            $classListResult = $conn->query($classListQuery);

            if ($classListResult->num_rows > 0) {
                while ($classItem = $classListResult->fetch_assoc()) {
                    echo "<button onclick=\"showStudents('" . $classItem['Class'] . "')\">" . $classItem['Class'] . "</button>";
                }
            } else {
                echo "No classes found.";
            }
            ?>
            <button onclick="showAllStudents()">Show All</button>
        </div>

        <!-- Student Table -->
        <table id="student-table" class="student-table" style="display: none;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Registration Number</th>
                    <th>Class</th>
                    <th>Gender</th>
                    
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        function showStudents(selectedClass) {
            hideAllStudents();
            document.getElementById('student-table').style.display = 'table';
            var tableBody = document.querySelector('#student-table tbody');
            tableBody.innerHTML = '';

            <?php
            $getStudentsByClassQuery = $conn->prepare("SELECT * FROM Student WHERE Class = ?");
            $getStudentsByClassQuery->bind_param("s", $class);

            $classListResult = $conn->query("SELECT DISTINCT Class FROM Student");

            while ($classItem = $classListResult->fetch_assoc()) {
                $class = $classItem['Class'];
                $getStudentsByClassQuery->execute();
                $students = $getStudentsByClassQuery->get_result()->fetch_all(MYSQLI_ASSOC);
            ?>
                if ('<?php echo $class; ?>' === selectedClass) {
                    <?php foreach ($students as $student) : ?>
                        var row = tableBody.insertRow();
                        row.insertCell(0).innerText = '<?php echo $student['Name']; ?>';
                        row.insertCell(1).innerText = '<?php echo $student['RegistrationNumber']; ?>';
                        row.insertCell(2).innerText = '<?php echo $student['Class']; ?>';
                        row.insertCell(3).innerText = '<?php echo $student['Gender']; ?>';
                       
                    <?php endforeach; ?>
                }
            <?php } ?>
        }

        function showAllStudents() {
            hideAllStudents();
            document.getElementById('student-table').style.display = 'table';
            var tableBody = document.querySelector('#student-table tbody');
            tableBody.innerHTML = '';

            <?php
            $getAllStudentsQuery = $conn->query("SELECT * FROM Student");
            $allStudents = $getAllStudentsQuery->fetch_all(MYSQLI_ASSOC);

            foreach ($allStudents as $student) :
            ?>
                var row = tableBody.insertRow();
                row.insertCell(0).innerText = '<?php echo $student['Name']; ?>';
                row.insertCell(1).innerText = '<?php echo $student['RegistrationNumber']; ?>';
                row.insertCell(2).innerText = '<?php echo $student['Class']; ?>';
                row.insertCell(3).innerText = '<?php echo $student['Gender']; ?>';
                // Add more cells as needed
            <?php endforeach; ?>
        }

        function hideAllStudents() {
            document.getElementById('student-table').style.display = 'none';
        }
    </script>

</body>

</html>

