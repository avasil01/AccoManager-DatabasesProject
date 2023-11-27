<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AccoManager - Booking Page</title>
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
  
    <div class="header-with-button">
        <h1 style="margin-left: 30px;">Logged in User</h1>
        <button class="manage-bookings-button">Manage Bookings</button>
    </div>
    
    <div id="bookingsList" class="bookings-list" style="display: none;">
        <!-- Bookings will be listed here -->
    </div>

    <div class="separator"></div>
    <h1 id="discoverText" style="margin-left: 30px;">Discover your upcoming accommodation</h1>
    <h3 id="exploreText" style="margin-left: 30px; color: #3d5a80;">Explore offers on hotels, residences, and various other options...</h3>

    <section>
        <div class="booking-form">
            <div class="form-control">
                <label for="city">Where are you going?</label>
                <select id="city" name="city">
                    <option value="Nicosia">Nicosia</option>
                    <option value="Limassol">Limassol</option>
                    <option value="Paphos">Paphos</option>
                    <option value="Larnaca">Larnaca</option>
                    <option value="Troodos">Troodos</option>
                    <option value="Ayia Napa">Ayia Napa</option>
                </select>
            </div>
            <div class="form-control">
                <label for="start-date">Start Date</label>
                <input type="date" id="start-date" name="start-date">
            </div>
            <div class="form-control">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end-date">
            </div>
            <div class="form-control">
                <label for="visitors">Number of visitors</label>
                <div class="number-input">
                    <button onclick="decrementValue()" type="button">-</button>
                    <input type="number" id="visitors" name="visitors" value="0" min="0">
                    <button onclick="incrementValue()" type="button">+</button>
                </div>
            </div>
            <button class="button-19" role="search" style="width: fit-content; height: fit-content;" onclick="searchProducts()">Search</button>
        </div>   
        <div id="results" class="results" style="display: flex; justify-content: center;"></div>
   
    </section>
  </main>
  <footer>
    <p>&copy; 2023 AccoManager. All rights reserved.</p>
  </footer>
</body>

<script>
 document.querySelector('.manage-bookings-button').addEventListener('click', function() {
    // Hide elements
    document.querySelector('.header-with-button').style.display = 'none';
    document.querySelector('.separator').style.display = 'none';
    document.getElementById('discoverText').style.display = 'none'; // Hides the "Discover your upcoming accommodation" text
    document.getElementById('exploreText').style.display = 'none'; // Hides the "Explore offers on hotels, residences, and various other options..." text
    document.querySelector('section').style.display = 'none'; // Hides the section containing the form and results

    // Show bookings list
    document.getElementById('bookingsList').style.display = 'block';
});



function searchProducts() {
    // Example data to send - adjust according to your actual input fields
    var location = document.getElementById('city').value;
    var startDate = document.getElementById('start-date').value;
    var endDate = document.getElementById('end-date').value;
    var guests = document.getElementById('visitors').value;
    var data = {
        location: location ,
        startDate: startDate ,
        endDate: endDate ,
        guests: guests
    };
    if (!startDate || !endDate || guests <= 0) {
        alert("Please fill all the fields correctly.");
        return;
    }

    // AJAX request to PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "searchproducts.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
           console.log(xhr.responseText); // Check the actual response
        var results;
        try {
            results = JSON.parse(xhr.responseText);
        } catch (e) {
            console.error("Error parsing JSON: ", e);
            return;
        }
        var resultsContainer = document.getElementById('results');
            resultsContainer.innerHTML = '';

        if (results.length > 0) {
               // Create and inject result elements
               results.forEach(function (result) {
                    var resultElement = document.createElement('div');
                    resultElement.className = 'result-item';

                    // Construct the inner HTML for each result
                    resultElement.innerHTML = 
                        '<h3>' + result.name + ' (ID: ' + result.legal_id + ')</h3>' +
                        '<p>Price: ' + result.price + '</p>' +
                        '<p>Address: ' + result.address + '</p>' +
                        '<p>Coordinates: ' + result.coordinates + '</p>' +
                        '<p>Contact Number: ' + result.contact_number + '</p>' +
                        '<button class="availability-button">See Availability</button>'; // Added button

                    resultsContainer.appendChild(resultElement);
                    
                    var availabilityButton = resultElement.querySelector('.availability-button');

                    // Add click event listener to the button
                    availabilityButton.addEventListener('click', function() {
                        showAvailability(resultElement, result.name);
                    });

                    resultsContainer.appendChild(resultElement);
                }); 
            } else {
                // No results found
                document.getElementById('results').innerHTML = '<p>No results found.</p>';
            }


        }

        
        function showAvailability(resultElement, accommodationName) {
            // Hide the selected accommodation
            resultElement.style.display = 'none';

            // Create a new list for the accommodation rooms (empty for now)
            var roomsList = document.createElement('div');
            roomsList.className = 'rooms-list';
            roomsList.innerHTML = '<h3>' + accommodationName + '</h3>';

            // Append the new list to the results container
            var resultsContainer = document.getElementById('results');
            resultsContainer.appendChild(roomsList);
        }
    };
    xhr.send(JSON.stringify(data));
}
</script>


<!-- 
<div id="signupModal" class="modal">
  
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="signup_process.php" method="post">
     
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" value="Sign Up">
    </form>
  </div>
</div>




<div id="loginModal" class="modal">
 
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="login_process.php" method="post">
      
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" value="Login">
    </form>
  </div>
</div> -->



</html>



<script>
// Get the login button
var loginBtn = document.getElementById("loginBtn");

// When the user clicks on the login button, redirect to login.php
loginBtn.onclick = function() {
  window.location.href = "login.php";
}
var signupBtn = document.getElementById("signupBtn");

// When the user clicks on the login button, redirect to login.php
signupBtn.onclick = function() {
  window.location.href = "signup.php";
}

function incrementValue() {
  var value = parseInt(document.getElementById('visitors').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('visitors').value = value;
}

function decrementValue() {
  var value = parseInt(document.getElementById('visitors').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 0 : value--;
  document.getElementById('visitors').value = value;
}

 
</script>
