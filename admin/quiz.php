<?php
include('db.php');

if (isset($_POST['reset_quiz'])) {
    // Clear the existing data from the questions table
    $sql = "TRUNCATE TABLE questions";
    if (mysqli_query($conn, $sql)) {
        // Reset the auto-increment value for the ID column
        $sql = "ALTER TABLE questions AUTO_INCREMENT = 1";
        if (mysqli_query($conn, $sql)) {
            echo "Quiz has been reset.";
        } else {
            echo "Error resetting the auto-increment value: " . mysqli_error($conn);
        }
    } else {
        echo "Error clearing data from the table: " . mysqli_error($conn);
    }
}

// Add new question to the database
if (isset($_POST['add_question'])) {
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $option1 = mysqli_real_escape_string($conn, $_POST['option1']);
    $option2 = mysqli_real_escape_string($conn, $_POST['option2']);
    $option3 = mysqli_real_escape_string($conn, $_POST['option3']);
    $option4 = mysqli_real_escape_string($conn, $_POST['option4']);
    $correct_answer = mysqli_real_escape_string($conn, $_POST['correct_answer']);

    $sql = "INSERT INTO questions (question, option1, option2, option3, option4, correct_answer)
            VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correct_answer')";

    if (mysqli_query($conn, $sql)) {
        header('Location: quiz.php?success=1');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/quiz.css">
</head>
<body>
    <div class="container">
        <h1>Admin Panel - Add Question</h1>
        <form method="post" action="quiz.php">
            <label for="question">Question:</label>
            <textarea id="question" name="question" rows="4" required></textarea>

            <label for="option1">Option 1:</label>
            <input type="text" id="option1" name="option1" required>

            <label for="option2">Option 2:</label>
            <input type="text" id="option2" name="option2" required>

            <label for="option3">Option 3:</label>
            <input type="text" id="option3" name="option3" required>

            <label for="option4">Option 4:</label>
            <input type="text" id="option4" name="option4" required>

            <label for="correct_answer">Correct Answer (e.g., A, B, C, D):</label>
            <input type="text" id="correct_answer" name="correct_answer" required>

            <button type="submit" name="add_question">Add Question</button>
        </form>

        <form method="post" action="quiz.php">
            <button type="submit" name="reset_quiz">Reset Quiz</button>
        </form>
    </div>
</body>
</html>
