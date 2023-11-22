<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .result-slip {
            width: 60%;
            margin: 50px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    include('init.php');

    if (isset($_GET['studentID']) && isset($_GET['regNumber']) && isset($_GET['class'])) {
        $studentID = $_GET['studentID'];
        $registrationNumber = $_GET['regNumber'];
        $class = $_GET['class'];

        // Fetch student information
        $studentQuery = "SELECT * FROM Student WHERE StudentID = $studentID AND RegistrationNumber = '$registrationNumber' AND Class = '$class'";
        $studentResult = $conn->query($studentQuery);
        $student = $studentResult->fetch_assoc();

        // Fetch result information
        $resultQuery = "SELECT * FROM Result WHERE StudentID = $studentID";
        $resultResult = $conn->query($resultQuery);
        $result = $resultResult->fetch_assoc();

        // Fetch grade information
        $gradeQuery = "SELECT * FROM Grade WHERE StudentID = $studentID";
        $gradeResult = $conn->query($gradeQuery);
        $grade = $gradeResult->fetch_assoc();

        if ($student && $result && $grade) {
    ?>

            <div class="result-slip">
                <h2>Mweiga High School Student Result Slip</h2>

                <table>
                    <tr>
                        <th>Student ID</th>
                        <td><?php echo $student['StudentID']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $student['Name']; ?></td>
                    </tr>
                    <tr>
                        <th>Registration Number</th>
                        <td><?php echo $student['RegistrationNumber']; ?></td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td><?php echo $student['Class']; ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?php echo $student['Gender']; ?></td>
                    </tr>
                </table>

                <h3>Result Details</h3>

                <table>
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Grade</th>
                    </tr>
                    <tr>
                        <td>Subject 1</td>
                        <td><?php echo $result['s1']; ?></td>
                        <td><?php echo $grade['s1Grade']; ?></td>
                    </tr>
                    <tr>
                        <td>Subject 2</td>
                        <td><?php echo $result['s2']; ?></td>
                        <td><?php echo $grade['s2Grade']; ?></td>
                    </tr>
                    <tr>
                        <td>Subject 3</td>
                        <td><?php echo $result['s3']; ?></td>
                        <td><?php echo $grade['s3Grade']; ?></td>
                    </tr>
                    <tr>
                        <td>Subject 4</td>
                        <td><?php echo $result['s4']; ?></td>
                        <td><?php echo $grade['s4Grade']; ?></td>
                    </tr>
                    <tr>
                        <td>Subject 5</td>
                        <td><?php echo $result['s5']; ?></td>
                        <td><?php echo $grade['s5Grade']; ?></td>
                    </tr>
                    <tr>
                        <td>Subject 6</td>
                        <td><?php echo $result['s6']; ?></td>
                        <td><?php echo $grade['s6Grade']; ?></td>
                    </tr>
                    <tr>
                        <td>Subject 7</td>
                        <td><?php echo $result['s7']; ?></td>
                        <td><?php echo $grade['s7Grade']; ?></td>
                    </tr>
                    <tr>
                        <td>Subject 8</td>
                        <td><?php echo $result['s8']; ?></td>
                        <td><?php echo $grade['s8Grade']; ?></td>
                    </tr>
                   
                    <tr>
                        <td>Total Marks</td>
                        <td><?php echo $result['TOTALMARK']; ?></td>
                        <td><?php echo $grade['TOTALMARKGrade']; ?></td>
                    </tr>
                </table>
                <div class="print-btn">
                    <button onclick="window.print()">Print Result Slip</button>
                </div>
            </div>

    <?php
        } else {
            echo "<p>Error: No data found for the provided student information.</p>";
        }
    } else {
        echo "<p>Error: Incomplete student information provided.</p>";
    }
    ?>

</body>

</html>
