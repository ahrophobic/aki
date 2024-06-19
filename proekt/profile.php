<?php
if (isset($_GET['id'])) {
    $player_id = $_GET['id'];

    $conn = pg_connect("host=localhost dbname=postgres user=postgres password=A210606a");

    if (!$conn) {
        echo "An error occurred with the database connection.\n";
        exit;
    }

    $query = "SELECT * FROM players WHERE id = $1";
    $result = pg_query_params($conn, $query, array($player_id));
    if (!$result) {
        echo "An error occurred with the player query.\n";
        exit;
    }
    $player = pg_fetch_assoc($result);

  
    $awards_query = "SELECT * FROM awards WHERE playerid = $1";
    $awards_result = pg_query_params($conn, $awards_query, array($player_id));
    if (!$awards_result) {
        echo "An error occurred with the awards query.\n";
        exit;
    }

    pg_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChessRecruit Profile</title>
    <link rel="stylesheet" href="profile1.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
  left: -101px;
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
  right: -130px;
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


.profile-info {
  display: flex;
  justify-content: space-between;
}

.profile-info img {
  width: 300px;
  height: 300px;
  top: 90px;
  border-radius: 10px;
  margin-right: 20px;
  position: relative;
  left: 200px;
}

.profile-info .info {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-left: 20px;
  position: relative;
  right: 630px;
  top: 75px;
}

.profile-info .info h2 {
  margin: 0;
  font-size: 44px;
  font-weight: 600;
  color: #800000;
}

.profile-info .info p1 {
  margin: 0;
  font-size: 18px;
  color: #2f2445;
  position: relative;
  font-weight: 500;
  bottom: -5px;
  left: 6px;
}

.profile-info .info p2 {
  margin: 0;
  font-size: 18px;
  color: #473a64ab;
  position: relative;
  font-weight: 500;
  bottom: 57px;
  left: 350px;
}

.profile-info .info p3 span {
  display: block;
  font-weight: 500;
  padding-top: 20px;
  position: relative;
  bottom: 2px;
  left: 10px;
  font-size: 20px;
}

.profile-info .info p4 span {
  font-weight: 400;
  padding-top: 25px;
  position: relative;
  bottom: 145px;
  left: 60px;
  display: block;
  color: #2f2445b9;
}

.button-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  margin: 0;
  position: absolute;
  bottom: -145px;
  left: 550px;
}

.custom-button {
  color: rgba(128, 0, 0, 0.5);
  font-size: 16px;
  text-decoration: none;
  border: none;
  background: none;
  cursor: pointer;
  transition: color 0.3s ease, border-color 0.3s ease;
  display: flex;
  align-items: center;
  margin: 0 30px;
  border-bottom: 2px solid rgba(128, 0, 0, 0.5);
  font-weight: 600;
}

.custom-button:hover,
.custom-button:focus {
  color: rgba(128, 0, 0, 1);
  border-color: rgba(128, 0, 0, 1);
  outline: none;
}

.custom-button .icon {
  display: flex;
  align-items: center;
  margin-right: 4px;
}
.custom-button.selected {
            color: rgba(128, 0, 0, 1); /* Selected color */
        }

hr.line {
  border-top: 3px solid #800000;
  position: absolute;
  bottom: 150px;
  width: 750px;
  left: 560px;
}

.bioinfo h2 {
  position: relative;
  font-size: 34px;
  font-weight: 400;
  bottom: -130px;
  left: 195px;
}

.bioinfo p {
  position: absolute;
  font-size: 20px;
  font-weight: 400;
  bottom: -200px;
  left: 195px;
  width: 1000px;
}

.button3 {
  background-color: transparent;
  border: 1px solid #e3e3e3;
  border-radius: 8px;
  color: #0b132f;
  cursor: pointer;
  font-weight: 450;
  bottom: -450px;
  padding: 7px 20px;
  position: relative;
  left: 199px;
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
  top: 450px;
  left: 770px;
  padding: 7px;
  margin-bottom: 20px;
  border-radius: 8px;
  width: 25%;
  border: 1px solid #e3e3e3;
  background-color: #e3e3e3;
}

table {
  width: 65%;
  border-collapse: collapse;
  position: absolute;
  top: 1090px;
  left: 270px;
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
.footer {
  background: #0b132f;
  padding: 30px 0px;
  font-family: "Play", sans-serif;
  text-align: center;
  position: relative ;
  top: 900px;
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
    top: 1010px;
    left: 665px;
    z-index: 2;
}

.circle {
    height: 100px;
    width: 100px;
    background-color: #f5f5f5;
    border-radius: 50%;
    left: 645px;
    top: 930px;
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
    <header>
    <div class="header-container"><img src="logo.jpg" alt="ChessRecruit Logo" class="logo" />
      <div class="logotext">
        <p1>ChessRecruit</p1>
      </div>
      <button onclick="location.href='index.php'" class="button1">Home</button>
      <button onclick="location.href='news.php'" class="button2">News</button>
    </div>
  </header>
</header>
    <div class="container">
        <div class="profile-info">
            <img src="<?php echo $player['photourl']; ?>" alt="<?php echo $player['name']; ?>">
            <div class="info">
                <h2><?php echo $player['name']; ?></h2>
                <p1><?php echo $player['fide_title']; ?></p1>
                <p2> sex: <?php echo $player['sex']; ?> </p2>
                <p3><span><?php echo $player['standardrating']; ?></span><span><?php echo $player['rapidrating']; ?></span><span><?php echo $player['blitzrating']; ?></span></p3>
                <p4><span>Standard </span><span>Rapid </span><span>Blitz </span></p4>
            </div>
        </div>
        <div class="button-container">
        <button id="gamesButton" class="custom-button" onclick="changeColorAndRedirect('gamesButton', 'profile2.php?id=<?php echo $player_id; ?>')">
            <span class="icon"><i class="fas fa-eye"></i></span><span>Games</span>
        </button>
        <button id="bioButton" class="custom-button" onclick="changeColorAndRedirect('bioButton', 'profile.php?id=<?php echo $player_id; ?>')">
            <span class="icon"><i class="fas fa-user"></i></span><span>Biography</span>
        </button>
    </div>
    <hr class="line" />
        <div class="bioinfo">
            <h2><?php echo $player['name']; ?></h2>
            <p><?php echo $player['biography']; ?></p>
        </div>
        <button id="exportButton" class="button3" role="button">Export</button>
            <input type="text" id="searchInput" placeholder="Search for awards.." class="searchInput" />
        <table id="rank-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Awards</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($awards_result && pg_num_rows($awards_result) > 0) {
                    $index = 1;
                    while ($award = pg_fetch_assoc($awards_result)) {
                        echo '<tr>';
                        echo '<td>' . $index++ . '</td>';
                        echo '<td>' . htmlspecialchars($award['awardname']) . '</td>';
                        echo '<td>' . htmlspecialchars($award['datereceived']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr>';
                    echo '<td colspan="3">No awards found</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
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
          DUST 2 Copyright © 2024 Inferno - All rights reserved || Designed By:
          AKHAN X AIGANYM
        </div>
      </div>
    </footer>    
    <script>
    document
      .getElementById("searchInput")
      .addEventListener("keyup", function () {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("rank-table");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
          
          tr[i].style.display = "none"; 
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

      function changeColorAndRedirect(buttonId, url) {
            localStorage.removeItem('selectedButton');
            
            localStorage.setItem('selectedButton', buttonId);

            window.location.href = url;
        }

        function applySelectedButton() {
            var selectedButtonId = localStorage.getItem('selectedButton');
            if (selectedButtonId) {
                var button = document.getElementById(selectedButtonId);
                if (button) {
                    button.classList.add('selected');
                }
            }
        }

        window.onload = applySelectedButton;

        
document.getElementById('exportButton').addEventListener('click', function () {
    var table = document.querySelector('table'); // Select your table
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
        link.setAttribute('download', 'chess_awards.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
});


  </script>
</body>
</html>
