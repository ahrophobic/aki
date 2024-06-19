<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'postgres';
$user = 'postgres';
$password = 'A210606a';

// Connection string (DSN)
$dsn = "pgsql:host=$host;dbname=$dbname";

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $user, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if category is set in URL
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    // Prepare SQL query based on category
    if ($category) {
        $sql = "SELECT ID, Title, Content, DatePublished, Category FROM news WHERE Category = :category";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
    } else { 
        $sql = "SELECT ID, Title, Content, DatePublished, Category FROM news";
        $stmt = $pdo->query($sql);
    }

    // Fetch news items
    $newsItems = $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ChessRecruit</title>
  <link rel="stylesheet" href="news.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet" />
  <style>
 
 body {
  font-family: Roobert, -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica,
    Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  background-color: #f5f5f5;
  overflow-x: hidden;
  margin: 0%;
}

.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

header {
  height: 85px;
  box-shadow: 0px 1px #7d87ad;
}
.logo {
  height: 50px;
  display: flex;
  position: relative;
  top: 10px;
  left: 200px;
}

.logotext {
  display: flex;
  top: 34px;
  height: 60px;
  font-weight: 600;
  font-size: 29px;
  position: relative;
  left: -270px;
  color: #0b132f;
}

.button1 {
  background-color: transparent;
  border: 1px solid #0b132f;
  border-radius: 25px;
  color: #0b132f;
  cursor: pointer;
  font-weight: 550;
  top: 25px;
  padding: 7px 20px;
  position: relative;
  right: 200px;
  transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
  text-align: center;
}

.button1:disabled {
  pointer-events: none;
}

.button1:hover {
  color: #fff;
  background-color: #0b132f;
  box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
  transform: translateY(-2px);
}

.button1:active {
  box-shadow: none;
  transform: translateY(0);
}

.button2 {
  background-color: transparent;
  border: 1px solid #0b132f;
  border-radius: 25px;
  color: #0b132f;
  cursor: pointer;
  font-weight: 650;
  top: 25px;
  padding: 7px 20px;
  position: relative;
  right: 170px;
  transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
  text-align: center;
}

.button2:disabled {
  pointer-events: none;
}

.button2:hover {
  color: #fff;
  background-color: #0b132f;
  box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
  transform: translateY(-2px);
}

.button2:active {
  box-shadow: none;
  transform: translateY(0);
}


.container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 20px;
    padding: 20px;
    text-align: left;
}

.news-title {
    font-size: 2.9rem;
    color: #ab0101;
    text-align: center;
    position: relative;
    top: -20px;
    width: 400px;
    left: 40px;

}

.button.events {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    position: relative;
    top: 87px;
    background-color: transparent;
    border: 1px solid #0b132f;
    border-radius: 25px;
    color: #0b132f;
    cursor: pointer;
    font-weight: 550;
    padding: 7px 20px;
    margin-left: 10px;
    transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
    right: 700px;
}

.button.events:hover {
    color: #fff;
    background-color: #0b132f;
    box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
    transform: translateY(-2px);
}

.button.achievements {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    position: relative;
    top: 35px;
    background-color: transparent;
    border: 1px solid #0b132f;
    border-radius: 25px;
    color: #0b132f;
    cursor: pointer;
    font-weight: 550;
    padding: 7px 20px;
    margin-left: 10px;
    transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
    right: 600px;
}

.button.achievements:hover {
    color: #fff;
    background-color: #0b132f;
    box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
    transform: translateY(-2px);
}




.news-item1 {
    background-color: #f0f0f0;
    font-size: 24px;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    height: 0%;
}

.news-item1 h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #333;
    position: relative;
    top: -50px;
    left: 170px;
    text-align: left;
    

}

.news-item1 p {
    width: 70%;
    flex: 1;
    font-size: 0.95rem;
    line-height: 1.8;
    color: #555;
    text-align: left;
    margin-right: 20px;
    left: 170px;
    position: relative;
    top: -50px
}

.news-item1 img {
    width: 25%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 10px;
    position: relative;
    left: 450px;
    top: -170px;
}
.date1 {
    margin-top: 10px;
    font-size: 15px;
    color: #777;
    position: relative;
    top: -90px;
    left: 1070px;
}


hr.new4 {
    border: 1px solid #15266571;
    background-color: #15266571;
    position: relative;
    width: 82%;
    left: 135px;
    top: -100px;
    margin-top: 40 px;
}



hr {
    border: none;
    height: 1px;
    background-color: #ddd;
    margin: 30px 0;
}


.footer {
    background: #0b132f;
    padding: 30px 0px;
    font-family: "Play", sans-serif;
    text-align: center;
}

.footer .row {
    width: 100%;
    margin: 1% 0%;
    padding: 0.6% 0%;
    color: gray;
    font-size: 0.8em;
}

.footer .row a {
    text-decoration: none;
    color: gray;
    transition: 0.5s;
}

.footer .row a:hover {
    color: #fff;
}

.footer .row ul {
    width: 100%;
}

.footer .row ul li {
    display: inline-block;
    margin: 0px 30px;
}

.footer .row a i {
    font-size: 2em;
    margin: 0% 1%;
}

.logobottom {
    position: absolute;
    top: 920px;
}

.logofooter {
    position: absolute;
    height: 80px;
    display: flex;
    position: relative;
    top: 110px;
    left: 665px;
    z-index: 2;
}

.circle {
    height: 100px;
    width: 100px;
    background-color: #f5f5f5;
    border-radius: 50%;
    left: 645px;
    top: 30px;
    position: relative;
    z-index: 1;
}

@media (max-width: 720px) {
    .footer {
        text-align: left;
        padding: 5%;
    }

    .footer .row ul li {
        display: block;
        margin: 10px 0px;
        text-align: left;
    }

    .footer .row a i {
        margin: 0% 3%;
    }
}
  </style>
</head>
<body>
<header>
    <div class="header-container">
      <img src="logo.jpg" alt="ChessRecruit Logo" class="logo" />
      <div class="logotext">
        <span>ChessRecruit</span>
      </div>
      <nav>
      <button onclick="location.href='index.php'" class="button1">Home</button>
      <button onclick="location.href='news.php'" class="button2">News</button>
      </nav>
    </div>
  </header>
  <div class="container">
        <h2 class="news-title">News Today</h2>
        <div class="button-container">
            <button class="button events" onclick="filterNews('Events')">Events</button>
            <button class="button achievements" onclick="filterNews('Achievements')">Achievements</button>
        </div>
    </div>
  <div id="news-container">
    <?php foreach ($newsItems as $news): ?>
      <?php
          $title = isset($news['Title']) ? htmlspecialchars($news['Title']) : 'No title';
          $content = isset($news['Content']) ? htmlspecialchars($news['Content']) : 'No content';
          $datePublished = isset($news['DatePublished']) ? htmlspecialchars(date("d.m.Y", strtotime($news['DatePublished']))) : 'No date';
      ?>
      <div class="news-item1">
          <h2><?= htmlspecialchars($news['title']) ?></h2>
          <p><?= htmlspecialchars($news['content']) ?></p>
          <div class="date1"><?= htmlspecialchars($news['datepublished']) ?></div>
          <hr class="new4">
        </div>
    <?php endforeach; ?>
  </div>
  <footer>
    <img src="logo.jpg" alt="ChessRecruit Logo" class="logofooter" />
    <div class="circle" alt="circle"></div>
    <div class="footer">
      <div class="row">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-youtube"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
      </div>
      <div class="row">
        <ul>
          <li><a href="#">About us</a></li>
          <li><a href="#">News</a></li>
          <li><a href="#">Home</a></li>
        </ul>
      </div>
      <div class="row">
        DUST 2 Copyright © 2024 Inferno - All rights reserved || Designed By: AKHAN X AIGANYM
      </div>
    </div>
  </footer>

  <script>
    function filterNews(category) {
      location.href = 'news.php?category=' + category;
    }
  </script>
</body>
</html>
