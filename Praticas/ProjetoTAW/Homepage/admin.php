<?php
session_start();

// Check if the user is logged in as admin or trackadmin
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'trackadmin')) {
    header("Location: ../register.html");
    exit();
}

require_once '../config.php';

$update_status = "";
$delete_status = "";
$add_status = "";
$delete_presence_status = "";

// Function to handle session updates
function handleUpdateSession($conn)
{
    global $update_status;
    $stmt = $conn->prepare("UPDATE sessions SET session = ?, date = ?, room = ?, speaker = ?, article = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $_POST['session_name'], $_POST['session_date'], $_POST['session_room'], $_POST['session_speaker'], $_POST['session_article'], $_POST['session_id']);
    if ($stmt->execute()) {
        $update_status = "Session information updated successfully!";
    } else {
        $update_status = "Error updating session information: " . $stmt->error;
    }
    $stmt->close();
}

// Function to handle session deletions
function handleDeleteSession($conn)
{
    global $delete_status;
    $stmt = $conn->prepare("DELETE FROM sessions WHERE id = ?");
    $stmt->bind_param("i", $_POST['session_id']);
    if ($stmt->execute()) {
        $delete_status = "Session deleted successfully!";
    } else {
        $delete_status = "Error deleting session: " . $stmt->error;
    }
    $stmt->close();
}

// Function to handle adding new sessions
function handleAddSession($conn)
{
    global $add_status;
    $stmt = $conn->prepare("INSERT INTO sessions (session, date, room, speaker, article) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST['session_name'], $_POST['session_date'], $_POST['session_room'], $_POST['session_speaker'], $_POST['session_article']);
    if ($stmt->execute()) {
        $add_status = "New session added successfully!";
    } else {
        $add_status = "Error adding new session: " . $stmt->error;
    }
    $stmt->close();
}

// Function to handle deleting presences
function handleDeletePresence($conn)
{
    global $delete_presence_status;
    $stmt = $conn->prepare("DELETE FROM user_presence WHERE id = ?");
    $stmt->bind_param("i", $_POST['presence_id']);
    if ($stmt->execute()) {
        $delete_presence_status = "Presence deleted successfully!";
    } else {
        $delete_presence_status = "Error deleting presence: " . $stmt->error;
    }
    $stmt->close();
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_session'])) {
        handleUpdateSession($conn);
    } elseif (isset($_POST['delete_session'])) {
        handleDeleteSession($conn);
    } elseif (isset($_POST['add_session'])) {
        handleAddSession($conn);
    } elseif (isset($_POST['delete_presence'])) {
        handleDeletePresence($conn);
    }
}

// Get all sessions and presences from the database
$sessions_result = $conn->query("SELECT * FROM sessions");
$presences_result = $conn->query("SELECT * FROM user_presence");

$conn->close();
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
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
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

        .add {
            font-size: 15px;
            line-height: 2;
            display: flex;
            flex-direction: column;
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
                    <li><a href="sessions.php">Sessions</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="otherinfo.php">Other Informations</a></li>
                    <li>
                        <a href="profile.php">
                    <li style="margin-top: -7px">
                        <img src="./images/profile1.png" alt="profile" width="30px" />
                    </li></a>
                    </li>
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
            <p><?php echo $delete_presence_status; ?></p>

            <!-- Sessions Table -->
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
                    <?php while ($row = $sessions_result->fetch_assoc()): ?>
                        <tr>
                            <form method="post" action="">
                                <td><input type="text" name="session_name"
                                        value="<?php echo htmlspecialchars($row['session']); ?>" required></td>
                                <td><input type="datetime-local" name="session_date"
                                        value="<?php echo date('Y-m-d\TH:i', strtotime($row['date'])); ?>" required></td>
                                <td><input type="text" name="session_room"
                                        value="<?php echo htmlspecialchars($row['room']); ?>" required></td>
                                <td><input type="text" name="session_speaker"
                                        value="<?php echo htmlspecialchars($row['speaker']); ?>" required></td>
                                <td><input type="text" name="session_article"
                                        value="<?php echo htmlspecialchars($row['article']); ?>" required></td>
                                <td>
                                    <input type="hidden" name="session_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="update_session">Update</button>
                                    <button type="submit" name="delete_session"
                                        onclick="return confirm('Are you sure you want to delete this session?');">Delete</button>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Add New Session Form -->
            <h2>Add New Session</h2>
            <div class="add">
                <form method="post" action="">
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

            <?php if ($_SESSION['role'] === 'admin'): ?>
                <!-- Manage Presences -->
                <section id="presence">
                    <h2>Manage Presences</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Arrival Time</th>
                                <th>Attend</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $presences_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['company']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                                    <td><?php echo htmlspecialchars($row['arrival_time']); ?></td>
                                    <td><?php echo htmlspecialchars($row['attend']); ?></td>
                                    <td>
                                        <form method="post" action="">
                                            <input type="hidden" name="presence_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_presence"
                                                onclick="return confirm('Are you sure you want to delete this presence?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </section>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <p>Ctrl+Alt+Defeat Conference © 2024</p>
    </footer>
</body>

</html>