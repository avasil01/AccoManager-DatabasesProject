<?php
// user.php
session_start();

$serverName = "mssql.cs.ucy.ac.cy"; 
$connectionOptions = array(
    "Database" => "mpanae01", 
    "Uid" => "mpanae01", 
    "PWD" => "PVTmdk11"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

function getAccommodationCategories($conn) {
    $categories = array();
    $sql = "SELECT * FROM dbo.[ACCOMMODATION CATEGORY]"; 
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $categories[] = $row;
    }

    return $categories;
}

$accommodationCategories = getAccommodationCategories($conn);

function getRoomTypes($conn) {
    $roomTypes = array();
    $sql = "SELECT * FROM dbo.[ACCOMMODATION_TYPE]";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $roomTypes[] = $row;
    }

    return $roomTypes;
}

$roomTypes = getRoomTypes($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AccoManager - System Admin Page</title>
  <link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
  <header>
    <nav>
      <ul>
        <img src="../logo.png" class="img-style">
        <li>
          <label for="language-select">Language:</label>
          <select name="language" id="language-select">
            <option value="en">English</option>
            <option value="gr">Greek</option>
          </select>
        </li>
      </ul>
    </nav>
  </header>

  <main>
    <h1 style="margin-left: 30px;">Logged in as <?php echo htmlspecialchars($username);?></h1>

    <div class="tab" style="display: flex; justify-content: center; gap: 15px;">
      <button class="tablinks" onclick="openTab(event, 'RevenueReport')">Revenue Report</button>
      <button class="tablinks" onclick="openTab(event, 'BookingStatistics')">Booking Statistics Reports</button>
      <button class="tablinks" onclick="openTab(event, 'OccupancyRate')">Occupancy Rate Reports</button>
      <button class="tablinks" onclick="openTab(event, 'RatingEvaluation')">Rating and Evaluation Reports</button>
      <button class="tablinks" onclick="openTab(event, 'RoomAvailability')">Room Availability Reports</button>
      <button class="tablinks" onclick="openTab(event, 'PerformanceReports')">Performance Reports</button>
    </div>

    <div id="RevenueReport" class="tabcontent">
      <div class="filter-container">

        <div class="filter-section">
          <h4>Time Periods</h4>
          <label><input type="radio" style="width:auto;" name="timePeriod" value="Daily"> Daily</label>
          <label><input type="radio" style="width:auto;" name="timePeriod" value="Weekly"> Weekly</label>
          <label><input type="radio" style="width:auto;" name="timePeriod" value="Quarterly"> Quarterly</label>
          <label><input type="radio" style="width:auto;" name="timePeriod" value="Yearly"> Yearly</label>
        </div>

        <div class="filter-section">
    <h4>Accommodation Category</h4>
    <?php foreach ($accommodationCategories as $category): ?>
        <label>
            <input type="radio" style="width:5%;" name="accommodationType" value="<?php echo htmlspecialchars($category['categoryID']); ?>" onchange="loadRoomTypes(this.value)">
            <?php echo htmlspecialchars($category['categoryName']); ?>
        </label>
    <?php endforeach; ?>
</div>


        <div class="filter-section">
          <h4>Room Type</h4>
          <div id="roomTypesSection">

        </div>

        <div class="filter-section">
          <h4>Location</h4>
          <label><input type="radio" style="width:auto;" name="location" value="Nicosia"> Nicosia</label>
          <label><input type="radio" style="width:auto;" name="location" value="Paphos"> Paphos</label>
          <label><input type="radio" style="width:auto;" name="location" value="Larnaca"> Larnaca</label>
          <label><input type="radio" style="width:auto;" name="location" value="Larnaca"> Limassol</label>
          <label><input type="radio" style="width:auto;" name="location" value="Larnaca"> Troodos</label>
          <label><input type="radio" style="width:auto;" name="location" value="Larnaca"> Ayia Napa</label>
         
        </div>
  </div>

  <div class="report-content">
  </div>
        <button onclick="generateRevenueReport('RevenueReport')">GENERATE</button>
</div>

  
  <div class="report-content">
   
  </div>
</div>

    </div>

    <div id="BookingStatistics" class="tabcontent">
      <h3>Booking Statistics Reports</h3>
 
    </div>

    <div id="OccupancyRate" class="tabcontent">
      <h3>Occupancy Rate Reports</h3>
     
    </div>

    <div id="RatingEvaluation" class="tabcontent">
      <h3>Rating and Evaluation Reports</h3>
   
    </div>

    <div id="RoomAvailability" class="tabcontent">
      <h3>Room Availability Reports</h3>
      
    </div>
    <div id="PerformanceReports" class="tabcontent">
      <h3>Performance Reports</h3>
      
    </div>

 
  </main>

  <footer>
    <p>&copy; 2023 AccoManager. All rights reserved.</p>
  </footer>
</body>
</html>

<script>
function loadRoomTypes(categoryID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "load_room_types.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            document.getElementById('roomTypesSection').innerHTML = this.responseText;
        }
    };
    xhr.send("categoryID=" + categoryID);
}



function openTab(evt, tabName) {

    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  

function generateReport(reportType) {
    function generateReport(reportType) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "generate_report.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(this.responseText);
            }
        }
        xhr.send("reportType=" + reportType );
    }
}
</script>
