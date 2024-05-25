<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../register.html");
    exit();
}
require_once '../config.php';

//variables for storing form submission
$update_status = "";
$delete_status = "";
$add_status = "";

// handle form submission for updating sessions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_session'])) {
    // get session data from the form
    $session_id = $_POST['session_id'];
    $session_name = $_POST['session_name'];
    $session_date = $_POST['session_date'];
    $session_room = $_POST['session_room'];
    $session_speaker = $_POST['session_speaker'];
    $session_article = $_POST['session_article'];

    // update session information in the db
    $stmt = $conn->prepare("UPDATE sessions SET session = ?, date = ?, room = ?, speaker = ?, article = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $session_name, $session_date, $session_room, $session_speaker, $session_article, $session_id);

    if ($stmt->execute()) {
        $update_status = "Session information updated successfully!";
    } else {
        $update_status = "Error updating session information: " . $stmt->error;
    }

    $stmt->close();
}

// handle form submission for deleting sessions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_session'])) {
    // Get session ID from the form
    $session_id = $_POST['session_id'];

    // delete session from the db
    $stmt = $conn->prepare("DELETE FROM sessions WHERE id = ?");
    $stmt->bind_param("i", $session_id);

    if ($stmt->execute()) {
        $delete_status = "Session deleted successfully!";
    } else {
        $delete_status = "Error deleting session: " . $stmt->error;
    }

    $stmt->close();
}

// handle form submission for adding new sessions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_session'])) {
    // Get session data from the form
    $session_name = $_POST['session_name'];
    $session_date = $_POST['session_date'];
    $session_room = $_POST['session_room'];
    $session_speaker = $_POST['session_speaker'];
    $session_article = $_POST['session_article'];

    // insert new session into the db
    $stmt = $conn->prepare("INSERT INTO sessions (session, date, room, speaker, article) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $session_name, $session_date, $session_room, $session_speaker, $session_article);

    if ($stmt->execute()) {
        $add_status = "New session added successfully!";
    } else {
        $add_status = "Error adding new session: " . $stmt->error;
    }

    $stmt->close();
}

// get all sessions from the db
$result = $conn->query("SELECT * FROM sessions");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Edit Sessions</title>
    <link rel="stylesheet" href="homepage.css" />
    <style>
        table {
            width: 20%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline-block;
        }
        .add{font-size: 15px;line-height: 2;display:flex}
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
                    <li><a href="sessions.php">Sessions</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="otherinfo.php">Other Informations</a></li>
                    <a href="profile.php"
                ><li style="margin-top: -7px">
                  <img
                    src="./images/profile.png"
                    alt="profile"
                    width="30px"
                  /></li
              ></a>
                </ul>
            </nav>
        </div>
    </header>
    <section id="showcase">
        <div class="container">
            <h1>Admin - Edit Sessions</h1>
            <hr />
            <p><?php echo $update_status; ?></p>
            <p><?php echo $delete_status; ?></p>
            <p><?php echo $add_status; ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>Date</th>
                        <th>Room</th>
                        <th>Speaker</th>
                        <th>Article</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <td><input type="text" name="session_name" value="<?php echo $row['session']; ?>" required></td>
                            <td><input type="datetime-local" name="session_date" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date'])); ?>" required></td>
                            <td><input type="text" name="session_room" value="<?php echo $row['room']; ?>" required></td>
                            <td><input type="text" name="session_speaker" value="<?php echo $row['speaker']; ?>" required></td>
                            <td><input type="text" name="session_article" value="<?php echo $row['article']; ?>" required></td>
                            <td>
                                <input type="hidden" name="session_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="update_session">Update</button>
                                <button type="submit" name="delete_session" onclick="return confirm('Are you sure you want to delete this session?');">Delete</button>
                            </td>
                        </form>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <h2>Add New Session</h2>
            <div class = " add">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="session_name">Session Name:</label>
                <input type="text" id="session_name" name="session_name" required><br>
                <label for="session_date">Date:</label>
                <input type="datetime-local" id="session_date" name="session_date" required><br>
                <label for="session_room">Room:</label>
                <input type="text" id="session_room" name="session_room" required><br>
                <label for="session_speaker">Speaker:</label>
                <input type="text" id="session_speaker" name="session_speaker" required><br>
                <label for="session_article">Article:</label>
                <input type="text" id="session_article" name="session_article" required><br>
                <button type="submit" name="add_session">Add Session</button>
            </form>
            </div>
        </div>
    </section>
    <footer>
        <p>Ctrl+Alt+Defeat Conference © 2024</p>
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
