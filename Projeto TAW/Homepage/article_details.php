<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../register.html"); // Redirect to login page if not logged in
    exit();
}
require_once '../config.php';

// Get article details
$article_id = $_GET['id'];
$stmt = $conn->prepare("SELECT session, date, room, speaker, article FROM sessions WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$stmt->bind_result($session, $date, $room, $speaker, $article);
$stmt->fetch();
$stmt->close();

// Handle question submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
    $question = $_POST['question'];
    $stmt = $conn->prepare("INSERT INTO questions (article_id, question) VALUES (?, ?)");
    $stmt->bind_param("is", $article_id, $question);
    $stmt->execute();
    $stmt->close();

}

// Handle answer submission by admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answer']) && isset($_POST['question_id'])) {
    $answer = $_POST['answer'];
    $question_id = $_POST['question_id'];
    $stmt = $conn->prepare("INSERT INTO answers (question_id, answer) VALUES (?, ?)");
    $stmt->bind_param("is", $question_id, $answer);
    $stmt->execute();
    $stmt->close();

}

// Handle question deletion by admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_question']) && isset($_POST['question_id'])) {
    $question_id = $_POST['question_id'];
    $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $stmt->close();

}

// Handle answer deletion by admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_answer']) && isset($_POST['answer_id'])) {
    $answer_id = $_POST['answer_id'];
    $stmt = $conn->prepare("DELETE FROM answers WHERE id = ?");
    $stmt->bind_param("i", $answer_id);
    $stmt->execute();
    $stmt->close();

}

// Get all questions and answers for the article
$questions = [];
$stmt = $conn->prepare("
    SELECT q.id, q.question, a.id AS answer_id, a.answer
    FROM questions q
    LEFT JOIN answers a ON q.id = a.question_id
    WHERE q.article_id = ?
");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$stmt->bind_result($question_id, $question_text, $answer_id, $answer_text);

while ($stmt->fetch()) {
    $questions[] = [
        'id' => $question_id,
        'question' => $question_text,
        'answer_id' => $answer_id,
        'answer' => $answer_text,
    ];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ctrl Alt Defeat Tech Conference</title>
    <link rel="stylesheet" href="homepage.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Ctrl</span>+Alt+Defeat</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="sessions.php">Sessions</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="otherinfo.php">Other Informations</a></li>
                    <li>
                        <a href="profile.php">
                    <li style="margin-top: -7px"><img src="./images/profile.png" alt="profile" width="30px"></li></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <section id="showcase">
        <div class="container">
            <h1><?php echo htmlspecialchars($session); ?></h1>
            <h3>By <?php echo htmlspecialchars($speaker); ?></h3>
            <h5><?php echo date("d/m/Y / H:i", strtotime($date)); ?> / ROOM <?php echo htmlspecialchars($room); ?></h5>
            <p><?php echo nl2br(htmlspecialchars($article)); ?></p>
            <form method="post" action="">
                <label for="question">Add a question:</label>
                <input type="text" id="question" name="question" required>
                <button type="submit">Submit Question</button>
            </form>
            <br>
            <hr />
            <?php if (isset($message)): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <h2>Questions and Answers</h2>
            <?php foreach ($questions as $question): ?>
                <div class="question">
                    <p><strong>Question:</strong> <?php echo htmlspecialchars($question['question']); ?></p>
                    <?php if ($question['answer']): ?>
                        <p><strong>Answer:</strong> <?php echo htmlspecialchars($question['answer']); ?></p>
                    <?php elseif (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'trackadmin')): ?>
                        <form method="post" action="">
                            <label for="answer">Your answer:</label>
                            <input type="text" id="answer" name="answer" required>
                            <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                            <button type="submit">Submit Answer</button>
                        </form>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin')): ?>
                        <br>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                            <button type="submit" name="delete_question">Delete Question</button>
                        </form>
                        <?php if ($question['answer_id']): ?>
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="answer_id" value="<?php echo $question['answer_id']; ?>">
                                <button type="submit" name="delete_answer">Delete Answer</button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                    <hr />
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer>
        <p>Ctrl+Alt+Defeat Conference © 2024</p>
    </footer>
</body>

</html>