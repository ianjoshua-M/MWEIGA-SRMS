<?php
include('init.php');

// Checks if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gets the values from the form
    $class = $_POST['class'];
    $registrationNumber = $_POST['registrationNumber'];
    $S1 = $_POST['subject1'];
    $S2 = $_POST['subject2'];
    $S3 = $_POST['subject3'];
    $S4 = $_POST['subject4'];
    $S5 = $_POST['subject5'];
    $S6 = $_POST['subject6'];
    $S7 = $_POST['subject7'];
    $S8 = $_POST['subject8'];

    // Calculate total mark
    $totalMark = ($S1 + $S2 + $S3 + $S4 + $S5 + $S6 + $S7 + $S8) / 8;

    // Grade logic function
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

    // Calculate subject grades
    $s1Grade = calculateGrade($S1);
    $s2Grade = calculateGrade($S2);
    $s3Grade = calculateGrade($S3);
    $s4Grade = calculateGrade($S4);
    $s5Grade = calculateGrade($S5);
    $s6Grade = calculateGrade($S6);
    $s7Grade = calculateGrade($S7);
    $s8Grade = calculateGrade($S8);
    $totalMARKGrade = calculateGrade( $totalMark);

    // Inserts the data into the Result and Grade tables
    $sqlResult = "INSERT INTO Result (StudentID, s1, s2, s3, s4, s5, s6, s7, s8, TOTALMARK) 
                  VALUES (
                      (SELECT StudentID FROM Student WHERE registrationNumber = ? AND Class = ?),
                      ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtResult = $conn->prepare($sqlResult);

    if ($stmtResult) {
        // Check if the prepare statement was successful
        $stmtResult->bind_param(
            "isiiiiiiiii", 
            $registrationNumber,
            $class,
            $S1,
            $S2,
            $S3,
            $S4,
            $S5,
            $S6,
            $S7,
            $S8,
            $totalMark
        );

        if ($stmtResult->execute()) {
            // Get the last inserted ResultID
            $lastResultID = $stmtResult->insert_id;

            // Insert data into the Grade table
            $sqlGrade = "INSERT INTO Grade (StudentID, ResultID,  s1Grade, s2Grade, s3Grade, s4Grade, s5Grade, s6Grade, s7Grade, s8Grade, TOTALMARKGrade) 
                         VALUES (
                             (SELECT StudentID FROM Student WHERE registrationNumber = ? AND Class = ?),
                             ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtGrade = $conn->prepare($sqlGrade);

            if ($stmtGrade) {
                $stmtGrade->bind_param(
                    "isisssssssss", // Adjusted to match the placeholders
                    $registrationNumber,
                    $class,
                    $lastResultID,
                    $s1Grade,
                    $s2Grade,
                    $s3Grade,
                    $s4Grade,
                    $s5Grade,
                    $s6Grade,
                    $s7Grade,
                    $s8Grade,
                    $totalMARKGrade
                );

                if ($stmtGrade->execute()) {
                    echo "Results and Grades added successfully.";
                    header("Location: teacher_dashboard.php");
                } else {
                    echo "Error adding grades: " . $stmtGrade->error;
                }

                $stmtGrade->close();
            } else {
                echo "Grade statement preparation failed: " . $conn->error;
            }
        } else {
            echo "Error adding results: " . $stmtResult->error;
        }

        $stmtResult->close();
    } else {
        echo "Result statement preparation failed: " . $conn->error;
    }

    $conn->close();
}
?>
