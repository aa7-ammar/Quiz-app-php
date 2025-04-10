<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['score'])) {
    header("Location: login.php");
    exit;
}

$total_questions = count($_SESSION['questions']);
$score = $_SESSION['score'];

// Clear quiz session data
unset($_SESSION['questions']);
unset($_SESSION['question_index']);
unset($_SESSION['score']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">🚀 Quiz App</a>
        <div class="d-flex align-items-center ms-auto">
            <span class="text-white me-3">🎉 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- Result Card -->
<div class="container mt-5">
    <div class="card text-center shadow-lg p-4">
        <div class="card-body">
            <h2 class="mb-3">🎓 Quiz Completed!</h2>
            <p class="fs-5">You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $total_questions; ?></strong></p>

            <?php if ($score == $total_questions): ?>
                <p class="text-success fw-bold">Perfect score! 🏆</p>
            <?php elseif ($score >= ($total_questions / 2)): ?>
                <p class="text-primary">Nice job! You're getting there 👏</p>
            <?php else: ?>
                <p class="text-danger">Keep practicing, you’ll get it! 💪</p>
            <?php endif; ?>

            <div class="mt-4">
                <a href="start-quiz.php" class="btn btn-outline-success me-2">Retake Quiz</a>
                <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

