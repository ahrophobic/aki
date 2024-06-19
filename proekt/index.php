<?php
$host = 'localhost';
$dbname = 'postgres';
$user = 'postgres';
$password = 'A210606a';

$dsn = "pgsql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, name, fide_title, standardrating, country, photourl FROM players ORDER BY id";
    $stmt = $pdo->query($sql);

    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($players) {
        echo "<script>console.log('Data fetched successfully');</script>";
    } else {
        echo "<script>console.log('No data found');</script>";
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ChessRecruit</title>
    <link rel="stylesheet" href="homepage.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet" />
</head>
<body>
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

        main {
            height: 1200px;
        }
        .about-us {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 20px 0px 0px 0px;
        }

        .banner-image {
            width: 55%;
            height: auto; 
        }

        .about-text {
            width: 45%;
            text-align: right;
        }
        p {
            position: relative;
            right: 150px;
            top: -100px;
            font-weight: 300;
            color: #0b132f;
        }
        h2 {
            position: relative;
            font-size: 35px;
            right: 150px;
            top: 10px;
            font-weight: 400;
        }

        h1 {
            position: relative;
            font-size: 95px;
            right: 150px;
            top: -50px;
            color: #800000;
            font-weight: 500;
        }

        .button3 {
            background-color: transparent;
            border: 1px solid #e3e3e3;
            border-radius: 8px;
            color: #0b132f;
            cursor: pointer;
            font-weight: 450;
            top: 140px;
            padding: 7px 20px;
            position: relative;
            left: 150px;
            transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
            text-align: center;
            background-color: #e3e3e3;
        }

        .button3:disabled {
            pointer-events: none;
        }

        .button3:hover {
            color: #fff;
            background-color: #0b132f;
            box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
            transform: translateY(-2px);
        }

        .button3:active {
            box-shadow: none;
            transform: translateY(0);
        }
        .searchInput {
            position: relative;
            top: 140px;
            left: 770px;
            padding: 7px;
            margin-bottom: 20px;
            border-radius: 8px;
            width: 25%;
            border: 1px solid #e3e3e3;
            background-color: #e3e3e3;
        }

        table {
            width: 77%;
            border-collapse: collapse;
            position: relative;
            top: 150px;
            left: 150px;
            background-color: #e3e3e3;
            border-radius: 25px;
        }

        th,
        td {
            border-color: 2px #e3e3e3;
            border-radius: 10px;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e3e3e3;
        }

        tr:nth-child(even) {
            background-color: #e3e3e3;
        }
        .player-link {
    color: inherit; 
    text-decoration: none; 
}

.player-link:hover {
    text-decoration: underline;
}

.player-photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
    
        .footer {
            background: #0b132f;
            padding: 30px 0px;
            font-family: "Play", sans-serif;
            text-align: center;
            position: relative ;
            top: 7100px;
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
            top: 5520px;
        }

        .logofooter {
            position: absolute;
            height: 80px;
            display: flex;
            position: relative;
            top: 7210px;
            left: 665px;
            z-index: 2;
        }

        .circle {
            height: 100px;
            width: 100px;
            background-color: #f5f5f5;
            border-radius: 50%;
            left: 645px;
            top: 7130px;
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
    <header>
        <div class="header-container">
            <img src="logo.jpg" alt="ChessRecruit Logo" class="logo" />
            <div class="logotext">
                <p1>ChessRecruit</p1>
            </div>
            <nav>
            <button onclick="location.href='index.php'" class="button1">Home</button>
            <button onclick="location.href='news.php'" class="button2">News</button>
            </nav>
        </div>
    </header>
    <main>
        <section class="about-us">
            <img src="image9.jpg" alt="About Us Banner" class="banner-image" />
            <div class="about-text">
                <h2>WELCOME TO</h2>
                <h1>ChessRecruit</h1>
                <p>
                    This platform that combines a passion for chess with talent
                    recruitment. Our website offers a unique opportunity for chess
                    talents to stand out and contribute to the global chess community.
                </p>
            </div>
        </section>
        <section>
            <button id="exportButton" class="button3" role="button">Export</button>
            <input type="text" id="searchInput" placeholder="Search for players.." class="searchInput" />
            <table id="rank-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th></th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Rating</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($players as $index => $player): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><a href="profile.php?id=<?= $player['id'] ?>" class="player-link"><img src="<?= htmlspecialchars($player['photourl']) ?>" class="player-photo" alt="<?= htmlspecialchars($player['name']) ?>"></a></td>
            <td><a href="profile.php?id=<?= $player['id'] ?>" class="player-link"><?= htmlspecialchars($player['name']) ?></a></td>
            <td><?= htmlspecialchars($player['fide_title']) ?></td>
            <td><?= htmlspecialchars($player['standardrating']) ?></td>
            <td><?= htmlspecialchars($player['country']) ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
            </table>
        </section>
    </main>

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
                DUST 2 Copyright © 2024 Inferno - All rights reserved || Designed By:
                AKHAN X AIGANYM
            </div>
        </div>
    </footer>
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("rank-table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                // Skip the header row
                tr[i].style.display = "none"; // Hide the row initially
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        });

   
document.getElementById('exportButton').addEventListener('click', function () {
    var table = document.querySelector('table'); 
    var rows = table.querySelectorAll('tr');
    var csvContent = '';

    rows.forEach(function (row) {
        var cells = row.querySelectorAll('th, td');
        var rowContent = [];
        cells.forEach(function (cell) {
            rowContent.push(cell.textContent);
        });
        csvContent += rowContent.join(',') + '\n';
    });

    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    if (link.download !== undefined) {
        var url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', 'chess_players.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
});


    </script>
</body>
</html>
