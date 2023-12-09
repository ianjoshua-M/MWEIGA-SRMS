<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Report</title>
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
    </style>
</head>

<body>

    <div class="container">
        <h2>General Analytics Report</h2>

        <?php
        include('init.php');

        // Fetches data for the analytics report
        $analyticsQuery = "SELECT Class, Gender, AVG(TOTALMARK) AS AvgTotalMark, AVG(s1) AS AvgS1, AVG(s2) AS AvgS2, AVG(s3) AS AvgS3, AVG(s4) AS AvgS4, AVG(s5) AS AvgS5, AVG(s6) AS AvgS6, AVG(s7) AS AvgS7, AVG(s8) AS AvgS8
                      FROM Result
                      JOIN Student ON Result.StudentID = Student.StudentID
                      GROUP BY Class, Gender";

        $analyticsResult = $conn->query($analyticsQuery);

        if ($analyticsResult->num_rows > 0) {
        ?>
            <div class="analytics-report">
                <table>
                    <tr>
                        <th>Class</th>
                        <th>Gender</th>
                        <th>Avg Total Mark</th>
                        <th>Avg S1</th>
                        <th>Avg S2</th>
                        <th>Avg S3</th>
                        <th>Avg S4</th>
                        <th>Avg S5</th>
                        <th>Avg S6</th>
                        <th>Avg S7</th>
                        <th>Avg S8</th>
                    </tr>

                    <?php
                    while ($row = $analyticsResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Class'] . "</td>";
                        echo "<td>" . $row['Gender'] . "</td>";
                        echo "<td>" . round($row['AvgTotalMark'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS1'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS2'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS3'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS4'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS5'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS6'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS7'], 2) . "</td>";
                        echo "<td>" . round($row['AvgS8'], 2) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        <?php
        } else {
            echo "<p>No data available for analytics report.</p>";
        }

        $conn->close();
        ?>
    </div>

    <div class="container">
    <?php
        include('init.php');

        function calculateGrade($raw_mark)
{
    if ($raw_mark >= 94) {
        return 'A';
    } elseif ($raw_mark >= 85) {
        return 'A-';
    } elseif ($raw_mark >= 75) {
        return 'B+';
    } elseif ($raw_mark >= 70) {
        return 'B';
    } elseif ($raw_mark >= 65) {
        return 'B-';
    } elseif ($raw_mark >= 60) {
        return 'C+';
    } elseif ($raw_mark >= 55) {
        return 'C';
    } elseif ($raw_mark >= 50) {
        return 'C-';
    } elseif ($raw_mark >= 45) {
        return 'D+';
    } elseif ($raw_mark >= 40) {
        return 'D';
    } elseif ($raw_mark >= 30) {
        return 'D-';
    } else {
        return 'E';
    }
}

        // Query to get gender-wise results
        $genderQuery = "SELECT Gender, AVG(TOTALMARK) AS AvgMarks, AVG(TOTALMARKGrade) AS AvgGrade FROM Student 
                        INNER JOIN Result ON Student.StudentID = Result.StudentID 
                        INNER JOIN Grade ON Result.ResultID = Grade.ResultID 
                        GROUP BY Gender";

        $genderResult = $conn->query($genderQuery);

        // Query to get class-wise results
        $classQuery = "SELECT Class, AVG(TOTALMARK) AS AvgMarks, AVG(TOTALMARKGrade) AS AvgGrade FROM Student 
                       INNER JOIN Result ON Student.StudentID = Result.StudentID 
                       INNER JOIN Grade ON Result.ResultID = Grade.ResultID 
                       GROUP BY Class";

        $classResult = $conn->query($classQuery);
        ?>

        <!-- Displays Gender-wise Results -->
        <h3>Gender-wise Analysis</h3>
        <table>
            <tr>
                <th>Gender</th>
                <th>Average Marks</th>
                <th>Average Grade</th>
            </tr>
            <?php
            while ($row = $genderResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Gender']}</td>
                        <td>{$row['AvgMarks']}</td>
                        <td>" . calculateGrade($row['AvgMarks']) . "</td>
                    </tr>";
            }
            ?>
        </table>

        <!-- Displays Class-wise Results -->
        <h3>Class-wise Analysis</h3>
        <table>
            <tr>
                <th>Class</th>
                <th>Average Marks</th>
                <th>Average Grade</th>
            </tr>
            <?php
            while ($row = $classResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Class']}</td>
                        <td>{$row['AvgMarks']}</td>
                        <td>" . calculateGrade($row['AvgMarks']) . "</td>
                    </tr>";
            }
            ?>
        </table>
    </div>
    <div class="print-btn">
                    <button onclick="window.print()">Print Analytics Report</button>
                </div>

</body>

</html>
