<?php
function parseQuestions($filename) {
    $questions = [];
    $current_question = [];
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos($line, "Câu") === 0) {
            if (!empty($current_question)) {
                $questions[] = $current_question;
                $current_question = [];
            }
            $current_question[] = $line;
        } elseif (strpos($line, "Đáp án") === 0 || 
                  preg_match('/^[A-D]\. /', $line)) {
            $current_question[] = $line;
        }
    }

    if (!empty($current_question)) {
        $questions[] = $current_question;
    }

    return $questions;
}

function getRandomQuestions($questions, $count = 5) {
    shuffle($questions); // Xáo trộn
    return array_slice($questions, 0, $count);
}

function calculateScore($questions, $userAnswers) {
    $score = 0;
    foreach ($questions as $index => $question) {
        $correctAnswer = '';
        foreach ($question as $line) {
            if (strpos($line, "Đáp án:") !== false) {
                $correctAnswer = trim(substr($line, strpos($line, ":") + 1));
                break;
            }
        }

        $userAnswer = $userAnswers["question" . ($index + 1)] ?? '';
        if ($userAnswer === $correctAnswer) {
            $score++;
        }
    }
    return $score;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Thi Trắc Nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Bài Thi Trắc Nghiệm</h1>

    <?php
    $filename = "questions.txt";
    if (!file_exists($filename)) {
        echo "<div class='alert alert-danger'>Không tìm thấy file câu hỏi!</div>";
        exit;
    }

    if (!isset($_POST['submit'])) {
        $allQuestions = parseQuestions($filename);
        $randomQuestions = getRandomQuestions($allQuestions);
        
        session_start();
        $_SESSION['questions'] = $randomQuestions;
    ?>
        <form method="POST">
            <?php 
            foreach ($randomQuestions as $index => $question) {
                $questionText = $question[0];
                $number = $index + 1;
            ?>
            <div class="card mb-4">
                <div class="card-header">
                    <strong><?php echo htmlspecialchars($questionText); ?></strong>
                </div>
                <div class="card-body">
                    <?php 
                    for ($i = 1; $i <= 4; $i++) {
                        $answer = $question[$i];
                        $answerLetter = substr($answer, 0, 1);
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" 
                               name="question<?php echo $number; ?>" 
                               value="<?php echo $answerLetter; ?>" 
                               id="question<?php echo $number . $answerLetter; ?>">
                        <label class="form-check-label" 
                               for="question<?php echo $number . $answerLetter; ?>">
                            <?php echo htmlspecialchars($answer); ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Nộp bài</button>
            </div>
        </form>
    <?php 
    } else {
        session_start();
        $questions = $_SESSION['questions'];
        $score = calculateScore($questions, $_POST);
        $totalQuestions = count($questions);
    ?>
        <div class="alert alert-success text-center">
            <h2>Kết Quả Bài Thi</h2>
            <p>Bạn trả lời đúng <strong><?php echo $score; ?></strong>/<?php echo $totalQuestions; ?> câu.</p>
        </div>

        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Làm lại</a>
        </div>

        <div class="mt-4">
            <h3>Chi Tiết Từng Câu</h3>
            <?php 
            foreach ($questions as $index => $question) {
                $correctAnswer = '';
                foreach ($question as $line) {
                    if (strpos($line, "Đáp án:") !== false) {
                        $correctAnswer = trim(substr($line, strpos($line, ":") + 1));
                        break;
                    }
                }

                $userAnswer = $_POST["question" . ($index + 1)] ?? 'Chưa chọn';
                $isCorrect = ($userAnswer === $correctAnswer);
            ?>
            <div class="card mb-3 <?php echo $isCorrect ? 'border-success' : 'border-danger'; ?>">
                <div class="card-header">
                    <?php echo htmlspecialchars($question[0]); ?>
                </div>
                <div class="card-body">
                    <p>Đáp án của bạn: <strong><?php echo $userAnswer; ?></strong></p>
                    <p>Đáp án đúng: <strong><?php echo $correctAnswer; ?></strong></p>
                    <p class="<?php echo $isCorrect ? 'text-success' : 'text-danger'; ?>">
                        <?php echo $isCorrect ? 'Đúng ✓' : 'Sai ✗'; ?>
                    </p>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

</body>
</html>
