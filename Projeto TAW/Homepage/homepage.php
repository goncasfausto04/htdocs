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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
    <style>
      .slider {
        width: 100%;
      }

      .slider-wrapper {
        height: fit-content;
        width: 60%;
        overflow: hidden;
        border: 2px solid #000000;
        box-shadow: #000000 0px 0px 8px 0px;
        position: relative;
        display: flex;
        margin: auto;
        margin-top: 20px;
      }

      .buttonLeft {
        background-color: transparent;
        border: none;
        position: absolute;
        z-index: 100;
        left: 0;
        height: 100%;
        transform: rotate(180deg);
      }

      .buttonRight {
        background-color: transparent;
        border: none;
        position: absolute;
        z-index: 100;
        right: 0;
        height: 100%;
      }
      .buttonRight:hover {
        svg path {
          stroke: wheat;
        }
      }

      .buttonLeft:hover {
        svg path {
          stroke: wheat;
        }
      }

      .slider img {
        width: 100%;
        display: block;
        height: 300px;
      }

      @media screen and (max-width: 768px) {
        .slider-wrapper {
          width: fit-content;
          height: fit-content;
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
            <li class="current"><a href="homepage.php">Home</a></li>
            <li><a href="sessions.php">Sessions</a></li>
            <li><a href="location.php">Location</a></li>
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

    <div class="container" style="margin: auto">
      <h1>
        Welcome to Control+Alt+Defeat Tech Conference!
        <hr />
      </h1>
      <div class="slider-wrapper">
        <div class="slider">
          <img src="./images/ex1.jpg" alt="Image 1" />
          <img src="./images/ex2.png" alt="Image 2" />
          <img src="./images/ex3.jpg" alt="Image 3" />
        </div>
        <button id="prev" class="buttonLeft">
          <svg
            width="50px"
            height="100%"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M9 6L15 12L9 18"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
        <button id="next" class="buttonRight">
          <svg
            width="50px"
            height="100%"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M9 6L15 12L9 18"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
      </div>
      <div class="text" style="margin-top: 30px">
        <hr />
        <h3>
          Control Alt Defeat: Navigating the Digital and Emotional Frontiers
        </h3>
        <p>
          Welcome to Control Alt Defeat, the premier tech conference where the
          binary meets the human, and innovation intertwines with emotion. This
          unique gathering is designed for those who dare to explore the depths
          of technology while embracing the complexities of the human
          experience.
        </p>
        <hr />
        <br />
        <h3>Tech Talks:</h3>
        <p>
          <strong>• Innovate or Stagnate: </strong>Dive into the latest
          advancements in AI, machine learning, and quantum computing. Discover
          how these technologies are reshaping industries and what it means for
          the future of work.
        </p>
        <p>
          <strong>• Cybersecurity in the Emotional Era:</strong> Learn about the
          emotional impact of cyber threats and the importance of empathy in
          crafting security measures that protect not just data, but people.
        </p>
        <p>
          <strong>• The Emotional Intelligence of Bots:</strong> Explore the
          fascinating world of emotionally aware bots and how they’re
          transforming customer service, mental health, and personal assistance
        </p>
        <br />
        <h3>Emotional Dialogues:</h3>
        <p>
          <strong>• The Burnout Code: </strong>Address the silent epidemic of
          tech burnout. Engage in open discussions about work-life balance,
          mental health, and strategies to thrive in high-pressure environments.
        </p>
        <p>
          <strong>• Empathy in the Age of AI:</strong> Delve into the ethical
          implications of AI and machine learning. Discuss how to design
          technology that respects human rights, diversity, and emotional
          well-being.
        </p>
        <p>
          <strong>• Humanizing Tech:</strong> Explore the intersection of
          technology and humanity. Reflect on the emotional impact of
          innovation, and how to create tech that enhances, rather than
          diminishes, the human experience.
        </p>
      </div>
      <h3 style="display: flex; justify-content: center">And Much More!</h3>
    </div>

    <footer>
      <p>Ctrl+Alt+Defeat Conference © 2024</p>
    </footer>
  </body>

  <script>
    $(document).ready(function () {
      var slider = $(".slider").cycle({
        fx: "scrollHorz",
        speed: 1000,
        timeout: 3000,
      });

      $("#next").click(function () {
        slider.cycle("next");
      });

      $("#prev").click(function () {
        slider.cycle("prev");
      });
    });
  </script>
</html>
