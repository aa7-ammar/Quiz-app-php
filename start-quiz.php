<?php
session_start();
require_once 'includes/db.php';

// Initialize quiz session
if (!isset($_SESSION['question_index'])) {
    $_SESSION['question_index'] = 0;
    $_SESSION['score'] = 0;

    // Fetch all questions from database
    $result = $conn->query("SELECT * FROM questions ORDER BY id");
    $_SESSION['questions'] = $result->fetch_all(MYSQLI_ASSOC);
}

// Check if form was submitted (user answered a question)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_SESSION['question_index'];
    $selected = $_POST['option'];

    $current_question = $_SESSION['questions'][$index];
    $correct_option = $current_question['correct_option'];

    if ($selected === $correct_option) {
        $_SESSION['score']++;
    }

    $_SESSION['question_index']++;

    // If all questions are done, redirect to result page
    if ($_SESSION['question_index'] >= count($_SESSION['questions'])) {
        header("Location: result.php");
        exit;
    }
}

// Load next question
$index = $_SESSION['question_index'];
$current_question = $_SESSION['questions'][$index];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Start Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">🚀 Quiz App</a>
        <div class="d-flex align-items-center ms-auto">
            <span class="text-white me-3">👋 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- Quiz Card -->
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title">Question <?php echo $index + 1; ?> of <?php echo count($_SESSION['questions']); ?></h4>
            <p class="lead mt-3"><?php echo htmlspecialchars($current_question['question']); ?></p>

            <form method="post" action="">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" value="a" required>
                    <label class="form-check-label"><?php echo $current_question['option_a']; ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" value="b">
                    <label class="form-check-label"><?php echo $current_question['option_b']; ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" value="c">
                    <label class="form-check-label"><?php echo $current_question['option_c']; ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" value="d">
                    <label class="form-check-label"><?php echo $current_question['option_d']; ?></label>
                </div>

                <button type="submit" class="btn btn-primary mt-4 w-100">Next</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
