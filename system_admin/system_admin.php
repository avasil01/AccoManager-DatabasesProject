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
    <h1 style="margin-left: 30px;">Logged in as System Administrator</h1>

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
          <label><input type="checkbox" name="timePeriod" value="Daily"> Daily</label>
          <label><input type="checkbox" name="timePeriod" value="Weekly"> Weekly</label>
          <label><input type="checkbox" name="timePeriod" value="Quarterly"> Quarterly</label>
          <label><input type="checkbox" name="timePeriod" value="Yearly"> Yearly</label>
        </div>

        <!-- Filter for Accommodation Type -->
        <div class="filter-section">
          <h4>Accommodation Type</h4>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_949"> Accommodation_949</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_905"> Accommodation_905</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_505"> Accommodation_505</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_486"> Accommodation_486</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_547"> Accommodation_547</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_47"> Accommodation_47</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_490"> Accommodation_490</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_101"> Accommodation_101</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_820"> Accommodation_820</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_565"> Accommodation_565</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_352"> Accommodation_352</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_986"> Accommodation_986</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_967"> Accommodation_967</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_135"> Accommodation_135</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_141"> Accommodation_141</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_788"> Accommodation_788</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_878"> Accommodation_878</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_236"> Accommodation_236</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_374"> Accommodation_374</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_664"> Accommodation_664</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_689"> Accommodation_689</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_376"> Accommodation_376</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_852"> Accommodation_852</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_813"> Accommodation_813</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_297"> Accommodation_297</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_149"> Accommodation_149</label>
          <label><input type="checkbox" name="accommodationType" value="Accommodation_840"> Accommodation_840</label>
          
        </div>

        <!-- Filter for Room Type -->
        <div class="filter-section">
          <h4>Room Type</h4>
          <label><input type="checkbox" name="roomType" value="Quadruple"> Quadruple</label>
          <label><input type="checkbox" name="roomType" value="Suite"> Suite</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Triple</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Twin</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Double</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Single</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Double</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Studio</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Family</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Twin/Double</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Dormitory room</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Bed in Dormitory</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Bungalow</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Chalet</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Holiday home</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Villa</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Mobile home</label>
          <label><input type="checkbox" name="roomType" value="Triple"> Tent</label>
          

        </div>

        <!-- Filter for Location -->
        <div class="filter-section">
          <h4>Location</h4>
          <label><input type="checkbox" name="location" value="Nicosia"> Nicosia</label>
          <label><input type="checkbox" name="location" value="Paphos"> Paphos</label>
          <label><input type="checkbox" name="location" value="Larnaca"> Larnaca</label>
          <label><input type="checkbox" name="location" value="Larnaca"> Limassol</label>
          <label><input type="checkbox" name="location" value="Larnaca"> Troodos</label>
          <label><input type="checkbox" name="location" value="Larnaca"> Ayia Napa</label>
         
        </div>
  </div>

  <div class="report-content">
    <!-- Content for Revenue Report Here -->
  </div>
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
</script>
