<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../register.html");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ctrl Alt Defeat Tech Conference</title>
  <link rel="stylesheet" href="homepage.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    #dino {
      display: flex;
      margin: auto;
      width: 200px;
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
          <li class="current">
            <a href="otherinfo.php">Other Informations</a>
          </li>
          <li>
            <a href="profile.php">
          <li style="margin-top: -7px">
            <img src="./images/profile.png" alt="profile" width="30px" />
          </li></a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <section id="showcase">
    <div class="container">
      <h1>Useful Informations</h1>
      <hr />
      <h3>Ctrl+Alt+Defeat: The Origin Story</h3>
      <p>
        In Lisbon, where cobblestone streets meet digital dreams,
        Ctrl+Alt+Defeat emerged. Techies tired of mundane conferences craved
        more. They envisioned a blend of code and compassion, where 1s and 0s
        mingled with neuroscience and laughter. The name held meaning:
      </p>
      <p><strong>Ctrl:</strong> Mastery over tech.</p>
      <p><strong>Alt:</strong> Innovation beyond norms.</p>
      <p><strong>Defeat:</strong> Courage to face challenges.</p>
      <hr />
      <h3>Location: Lisbon, Portugal:</h3>
      <p>
        Nestled between historic cobblestone streets and cutting-edge
        startups, Lisbon provides the perfect backdrop for Ctrl+Alt+Defeat.
        Attendees can explore the city’s vibrant culture, indulge in pastéis
        de nata, and discuss computing all in one day. All the conferences
        will be held at NOVA IMS campus in Campolide and also online via zoom
        and livestreamed on Youtube and Twitch.
      </p>
      <hr />
    </div>
  </section>
  <img src="./images/logo.png" alt="logo" id="dino" />
  <footer>
    <p>Ctrl+Alt+Defeat Conference © 2024</p>
  </footer>
</body>

</html>