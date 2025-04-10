<?php
session_start();
require_once "includes/db.php";

// If user not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// If no answers submitted, redirect to dashboard
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['answers'])) {
    header("Location: dashboard.php");
    exit;
}

$answers = $_POST['answers'];
$score = 0;
$total = count($answers);

// Fetch all questions and correct answers
$question_ids = array_keys($answers);
$placeholders = implode(',', array_fill(0, count($question_ids), '?'));
$stmt = $conn->prepare("SELECT id, correct_option FROM questions WHERE id IN ($placeholders)");

$types = str_repeat('i', count($question_ids));
$stmt->bind_param($types, ...$question_ids);
$stmt->execute();
$result = $stmt->get_result();

$correct_answers = [];
while ($row = $result->fetch_assoc()) {
    $correct_answers[$row['id']] = $row['correct_option'];
}

// Calculate score
foreach ($answers as $qid => $user_ans) {
    $user_ans = strtolower(trim($user_ans)); // normalize input
    $correct = strtolower(trim($correct_answers[$qid]));

    if ($user_ans === $correct) {
        $score++;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 text-center">
    <div class="card shadow p-4">
        <h2 class="mb-4">🎉 Quiz Completed!</h2>
        <p class="lead">You scored <strong><?= $score ?></strong> out of <strong><?= $total ?></strong>.</p>
        <a href="dashboard.php" class="btn btn-primary mt-3">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
