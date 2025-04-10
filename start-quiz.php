<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$questions = [];
$result = $conn->query("SELECT * FROM questions ORDER BY id ASC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Start Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Quiz Time! 👨‍💻</h2>
        <?php if (count($questions) > 0): ?>
            <form method="POST" action="result.php">
                <?php foreach ($questions as $q): ?>
                    <div class="mb-4 p-3 border rounded shadow-sm bg-white">
                        <h5><?= $q['question_text'] ?></h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="a" required>
                            <label class="form-check-label"><?= $q['option_a'] ?></label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="b" required>
                            <label class="form-check-label"><?= $q['option_b'] ?></label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="c" required>
                            <label class="form-check-label"><?= $q['option_c'] ?></label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="d" required>
                            <label class="form-check-label"><?= $q['option_d'] ?></label>
                        </div>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-success w-100">Submit Quiz</button>
            </form>

        <?php else: ?>
            <div class="alert alert-warning">No questions found in the database.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
