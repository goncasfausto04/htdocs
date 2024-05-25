<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../register.html"); // Redirect to login page if not logged in
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
      iframe {
        border: 2px solid black;
        border-radius: 10px;
      }

      .caixas {
        display: flex;
      }

      .right {
        width: 40%;
      }
      .left {
        width: 60%;
      }

      @media screen and (max-width: 768px) {
        .caixas {
          display: block;
        }

        .right {
          width: 100%;
        }
        .left {
          width: 100%;
        }
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
            <li class="current"><a href="location.php">Location</a></li>
            <li><a href="otherinfo.php">Other Informations</a></li>
            <li>
              <a href="profile.php"
                ><li style="margin-top: -7px">
                  <img
                    src="./images/profile.png"
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
        <h1>Location</h1>
        <hr />
        <div class="caixas">
          <aside class="left">
            <iframe
              width="80%"
              height="400"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3112.370292174403!2d-9.162994288007681!3d38.73226415631236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd19336ccc6ba6f3:0x9503fe5e3320089f!2sInstituto%20Superior%20de%20Estatística%20e%20Gestão%20de%20Informação%20da%20Universidade%20Nova%20de%20Lisboa!5e0!3m2!1spt-PT!2spt!4v1715709222823!5m2!1spt-PT!2spt"
            ></iframe>
          </aside>
          <aside class="right">
            <p><strong>Conference Details:</strong> To define</p>
            <p><strong>Date:</strong> To define</p>
            <p>
              <strong>Location:</strong> Colégio Almada Negreiros, Campus de
              Campolide, Lisbon, and Online (via Zoom)
            </p>
            <p>
              <strong>Transportation:</strong> Metro stations S. Sebastião (Blue
              and Red Line) and Praça de Espanha (Blue Line), as well as Carris
              701, 713, 716, 726, 742, 746, 756, 758, and 770
            </p>
          </aside>
        </div>
      </div>
    </section>

    <footer>
      <p>Ctrl+Alt+Defeat Conference © 2024</p>
    </footer>
  </body>
</html>
