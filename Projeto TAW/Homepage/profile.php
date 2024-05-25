<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../register.html");
    exit();
}

require_once '../config.php';

$user_id = $_SESSION['user_id'];
$current_name = $current_email = $current_role = "";
$update_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_name']) && isset($_POST['new_email'])) {
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];

    $stmt = $conn->prepare("UPDATE accounts SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_name, $new_email, $user_id);
    
    if ($stmt->execute()) {
        $update_status = "Information updated successfully.";
        $_SESSION['email'] = $new_email;
    } else {
        $update_status = "Error updating information: " . $stmt->error;
    }

    $stmt->close();
}

$stmt = $conn->prepare("SELECT name, email, role FROM accounts WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($current_name, $current_email, $current_role);
$stmt->fetch();
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ctrl Alt Defeat Tech Conference</title>
    <link rel="stylesheet" href="homepage.css" />
  </head>
  <style>
    .pfp-box {
      width: fit-content;
      display: flex;
      position: relative;
      margin: 20px;
    }
    #pfp {
      border: 1px solid black;
      box-shadow: 2px 2px 5px 2px #888888;
      width: 200px;
    }
    .content {
      margin: 20px;
      line-height: 1.5;
    }
    #change-picture-button {
      border: none;
      position: absolute;
      right: 0;
      width: fit-content;
      height: 30px;
      background-color: #4caf50;
      color: white;
      text-align: center;
      display: inline-block;
      cursor: pointer;
      border-radius: 10px;
      transition-duration: 0.4s;
      margin: 3px;
    }

    #change-picture-button:hover {
      background-color: white;
      color: black;
      border: 2px solid #4caf50;
    }

    #edit-info-button {
      background-color: #4caf50; /* Green */
      border: none;
      color: white;
      padding: 10px 24px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 12px;
      transition-duration: 0.4s;
    }

    #edit-info-button:hover {
      background-color: white;
      color: black;
      border: 2px solid #4caf50;
    }
  </style>
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
              <a href="profile.php"
                ><li style="margin-top: -7px">
                  <img
                    src="./images/profile1.png"
                    alt="profile"
                    width="30px"
                  /></li
              ></a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <section id="showcase">
      <div class="container">
        <h1>Profile</h1>
        <hr />
        <div class="content">
            <h2>ID: <?php echo $user_id; ?></h2>
            <h2>Name: <?php echo $current_name; ?></h2>
            <h2>Email: <?php echo $current_email; ?></h2>
            <button id="edit-info-button">Edit Info</button>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="edit-info-form" style="display: none;">
                <label for="new_name">New Name:</label>
                <input type="text" id="new_name" name="new_name" value="<?php echo $current_name; ?>" required>
                <label for="new_email">New Email:</label>
                <input type="email" id="new_email" name="new_email" value="<?php echo $current_email; ?>" required>
                <button type="submit">Save Changes</button>
            </form>
            <p><?php echo $update_status; ?></p> <!-- Display update status message -->
            <form method="post" action="../logout.php"> <!-- Assuming logout.php handles logout functionality -->
                <button type="submit" id="edit-info-button">Log Out</button>
            </form>
            <p><?php echo $update_status; ?></p>
        <?php if ($current_role === 'admin'): ?>
            <a href="admin.php">Go to Admin Page</a>
        <?php endif; ?>
        </div> 
      </div>
    </section>
    <footer>
      <p>Ctrl+Alt+Defeat Conference © 2024</p>
    </footer>
    <script>
        document.getElementById("edit-info-button").addEventListener("click", function() {
            var form = document.getElementById("edit-info-form");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        });
    </script>

  </body>
</html>
