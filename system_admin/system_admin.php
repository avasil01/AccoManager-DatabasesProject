<?php
// user.php
session_start();

// Your database connection details
$serverName = "mssql.cs.ucy.ac.cy"; // Update with your server name
$connectionOptions = array(
    "Database" => "mpanae01", // Update with your database name
    "Uid" => "mpanae01", // Update with your database username
    "PWD" => "PVTmdk11" // Update with your database password
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}


// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];


// Function to fetch accommodation categories
function getAccommodationCategories($conn) {
    $categories = array();
    $sql = "SELECT * FROM dbo.[ACCOMMODATION CATEGORY]"; // Adjust SQL as per your table structure
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $categories[] = $row; // Assuming $row contains category data
    }

    return $categories;
}

$accommodationCategories = getAccommodationCategories($conn);

function getRoomTypes($conn) {
    $roomTypes = array();
    $sql = "SELECT * FROM dbo.[ACCOMMODATION_TYPE]"; // Adjust SQL as per your table structure
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $roomTypes[] = $row; // Assuming $row contains room type data
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

    <!-- Tab links -->
    <div class="tab" style="display: flex; justify-content: center; gap: 15px;">
      <button class="tablinks" onclick="openTab(event, 'RevenueReport')">Revenue Report</button>
      <button class="tablinks" onclick="openTab(event, 'BookingStatistics')">Booking Statistics Reports</button>
      <button class="tablinks" onclick="openTab(event, 'OccupancyRate')">Occupancy Rate Reports</button>
      <button class="tablinks" onclick="openTab(event, 'RatingEvaluation')">Rating and Evaluation Reports</button>
      <button class="tablinks" onclick="openTab(event, 'RoomAvailability')">Room Availability Reports</button>
      <button class="tablinks" onclick="openTab(event, 'PerformanceReports')">Performance Reports</button>
    </div>

    <!-- Tab content -->
    <div id="RevenueReport" class="tabcontent">
      <div class="filter-container">
        <!-- Filter for Time Periods -->
        <div class="filter-section">
          <h4>Time Periods</h4>
          <label><input type="radio" name="timePeriod" value="Daily"> Daily</label>
          <label><input type="radio" name="timePeriod" value="Weekly"> Weekly</label>
          <label><input type="radio" name="timePeriod" value="Quarterly"> Quarterly</label>
          <label><input type="radio" name="timePeriod" value="Yearly"> Yearly</label>
        </div>

        <!-- Filter for Accommodation Type -->
        <div class="filter-section">
          <h4>Accommodation Category</h4>
            <?php foreach ($accommodationCategories as $category): ?>
                <label>
                    <input type="radio" name="accommodationType" value="<?php echo htmlspecialchars($category['categoryName']); ?>"
                           onchange="fetchRoomTypesForCategory(<?php echo htmlspecialchars($category['id']); ?>)">
                    <?php echo htmlspecialchars($category['categoryName']); ?>
                </label>
            <?php endforeach; ?>

        </div>

        <!-- Filter for Room Type -->
        <div class="filter-section">
          <h4>Room Type</h4>

        </div>

        <!-- Filter for Location -->
        <div class="filter-section">
          <h4>Location</h4>
          <label><input type="radio" name="location" value="Nicosia"> Nicosia</label>
          <label><input type="radio" name="location" value="Paphos"> Paphos</label>
          <label><input type="radio" name="location" value="Larnaca"> Larnaca</label>
          <label><input type="radio" name="location" value="Larnaca"> Limassol</label>
          <label><input type="radio" name="location" value="Larnaca"> Troodos</label>
          <label><input type="radio" name="location" value="Larnaca"> Ayia Napa</label>
         
        </div>
  </div>

  <div class="report-content">
    <!-- Content for Revenue Report Here -->
  </div>
        <button onclick="generateRevenueReport('RevenueReport')">GENERATE</button>
</div>

  
  <div class="report-content">
    <!-- Content for Revenue Report Here -->
  </div>
</div>

    </div>

    <div id="BookingStatistics" class="tabcontent">
      <h3>Booking Statistics Reports</h3>
      <!-- Content for Booking Statistics Reports -->
    </div>

    <div id="OccupancyRate" class="tabcontent">
      <h3>Occupancy Rate Reports</h3>
      <!-- Content for Occupancy Rate Reports -->
    </div>

    <div id="RatingEvaluation" class="tabcontent">
      <h3>Rating and Evaluation Reports</h3>
      <!-- Content for Rating and Evaluation Reports -->
    </div>

    <div id="RoomAvailability" class="tabcontent">
      <h3>Room Availability Reports</h3>
      <!-- Content for Room Availability Reports -->
    </div>
    <div id="PerformanceReports" class="tabcontent">
      <h3>Performance Reports</h3>
      <!-- Content for Performance Reports -->
    </div>



    
  </main>

  <footer>
    <p>&copy; 2023 AccoManager. All rights reserved.</p>
  </footer>
</body>
</html>

<script>
function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Set the default open tab (optional)
  document.getElementById("defaultOpen").click();

function generateReport(reportType) {
    function generateReport(reportType) {
        // Gather filter parameters
        // Example: let timePeriod = document.querySelector('input[name="timePeriod"]:checked').value;

        // AJAX call to PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "generate_report.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Handle response here
                console.log(this.responseText);
            }
        }
        xhr.send("reportType=" + reportType /* + Other parameters */);
    }
}
</script>
