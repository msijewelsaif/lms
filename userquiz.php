<?php
include('db.php');

$questions = []; // Define an empty array to store the questions

// Retrieve questions from the database
$query = "SELECT * FROM questions";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}

$score = null; // Initialize the score variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0; // Initialize the user's score

    foreach ($questions as $question) {
        $questionId = $question['id'];
        $userAnswer = $_POST['answer_' . $questionId];
        $correctAnswer = $question['correct_answer'];

        // Check if the user's answer matches the correct answer
        if ($userAnswer === $correctAnswer) {
            $score++;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/userquiz.css">
</head>
<body>
    <div class="container">
        <h1>Quiz</h1>
        <form method="post" action="userquiz.php">
            <?php
            $questionNumber = 1; // Initialize question number

            foreach ($questions as $question) {
                // Include question and options in the form
                echo '<div class="question">';
                echo '<span class="question-number">Question ' . $questionNumber . ':</span> ' . $question['question'];
                echo '</div>';
                
                echo '<div class="options">';
                echo '<input type="radio" name="answer_' . $question['id'] . '" value="A"> A. ' . $question['option1'] . '<br>';
                echo '<input type="radio" name="answer_' . $question['id'] . '" value="B"> B. ' . $question['option2'] . '<br>';
                echo '<input type="radio" name="answer_' . $question['id'] . '" value="C"> C. ' . $question['option3'] . '<br>';
                echo '<input type="radio" name="answer_' . $question['id'] . '" value="D"> D. ' . $question['option4'] . '<br>';
                echo '</div>';
                
                $questionNumber++; // Increment question number
            }
            ?>

            <button type="submit">Submit</button>
        </form>

        <?php
        if ($score !== null) {
            echo '<div class="result">';
            echo 'Your score: ' . $score . ' out of ' . count($questions) . ' questions.';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
