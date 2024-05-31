<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../register.html"); // Redirect to login page if not logged in
    exit();
}
require_once '../config.php';

// Get sessions from the database
$sessions = [];
$stmt = $conn->prepare("SELECT id, session, date, room, speaker, article FROM sessions");
$stmt->execute();
$stmt->bind_result($id, $session, $date, $room, $speaker, $article);

while ($stmt->fetch()) {
    $sessions[] = [
        'id' => $id,
        'session' => $session,
        'date' => $date,
        'room' => $room,
        'speaker' => $speaker,
        'article' => $article,
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

    <style>
        .box {
            width: 500px;
            height: 300px;
            margin: 10px;
            border: 1px solid black;
        }

        .caixa-topo {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .caixa-baixo {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .session {
            line-height: normal;
        }

        .register-presence-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .register-presence-link:hover {
            background-color: #0056b3;
        }
    </style>
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
                    <li class="current"><a href="sessions.php">Sessions</a></li>
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
            <h1>Sessions:</h1>
            <hr />
            <?php foreach ($sessions as $session): ?>
                <div class="session">
                    <h5><?php echo htmlspecialchars($session['session']); ?></h5>
                    <h6>By <?php echo htmlspecialchars($session['speaker']); ?></h6>
                    <h6><?php echo date("d/m/Y / H:i", strtotime($session['date'])); ?> / ROOM
                        <?php echo htmlspecialchars($session['room']); ?></h6>
                    <p><?php echo nl2br(htmlspecialchars($session['article'])); ?></p>
                    <a href="article_details.php?id=<?php echo $session['id']; ?>">View Details</a>
                    <hr />
                </div>
            <?php endforeach; ?>
            <a href="presence_form.php" class="register-presence-link">Register Presence</a>

        </div>
    </section>
    <footer>
        <p>Ctrl+Alt+Defeat Conference © 2024</p>
    </footer>
</body>

</html>