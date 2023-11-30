<?php
// user.php
session_start();

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccoManager - Booking Page</title>
    <link rel="stylesheet" type="text/css" href="../style.css"/>
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
        <h1 style="margin-left: 30px;">Logged in as <?php echo htmlspecialchars($username); ?></h1>
        <button class="manage-bookings-button">Manage Bookings</button>
        

    </div>
    <div id="bookingsList" class="bookings-list" style="display: none;">
        <!-- Bookings will be listed here -->
    </div>
    <div class="separator"></div>
    <h1 id="discoverText" style="margin-left: 30px;">Discover your upcoming accommodation</h1>
    <h3 id="exploreText" style="margin-left: 30px; color: #3d5a80;">Explore offers on hotels, residences, and various
        other options...</h3>
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
            <button class="button-19" role="search" style="width: fit-content; height: fit-content;"
                    onclick="searchProducts()">Search
            </button>
            <div id="resultsContainer"></div>
        </div>
        <div id="results" class="results" style="display: flex; justify-content: center;"></div>
    </section>
</main>
<footer>
    <p>&copy; 2023 AccoManager. All rights reserved.</p>
</footer>
<script>
    function fetchUserBookings() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "managebookings.php", true); // Changed to GET
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var bookings;
                try {
                    bookings = JSON.parse(xhr.responseText);
                } catch (e) {
                    console.error("Error parsing JSON: ", e);
                    console.error("Response Text: ", xhr.responseText);
                    return;
                }
                displayBookings(bookings);
            } else {
                console.error("AJAX request failed: ", xhr.statusText);
            }
        }
    };
    xhr.send();
}

function displayBookings(bookings) {
    var bookingsList = document.getElementById('bookingsList');
    bookingsList.innerHTML = ''; // Clear previous content
    bookings.forEach(function (booking) {
        console.log('Raw Start Date:', booking.startDate);
    console.log('Raw End Date:', booking.endDate);
    var formattedStartDate = new Date(booking.startDate).toLocaleDateString('en-US', {
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    });
    var formattedEndDate = new Date(booking.endDate).toLocaleDateString('en-US', {
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    });
        var div = document.createElement('div');
        div.className = 'booking-item';
        div.innerHTML = '<h3>Booking ID: ' + booking.bookingID + '</h3>' +
            '<p>Price: ' + booking.price + '</p>' +
            '<p>Start Date: ' + booking.startDate + '</p>' +
            '<p>End Date: ' + booking.startDate + '</p>';
        // bookingsList.appendChild(div);
    // });
   
     // Create the cancel booking button
     var cancelBtn = document.createElement('button');
        cancelBtn.innerText = 'Cancel Booking';
        cancelBtn.className = 'cancel-booking-button';
        cancelBtn.onclick = function() { cancelBooking(booking.bookingID); };
        div.appendChild(cancelBtn);

        bookingsList.appendChild(div);
    });
    bookingsList.style.display = 'block'; // Show the bookings list
}

function cancelBooking(bookingId) {
    if(confirm('Are you sure you want to cancel booking ID ' + bookingId + '?')) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'cancelbookings.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
    if (xhr.status === 200) {
        alert('Booking cancelled successfully');
      // put code here
       
     
    } else {
        // Display more detailed error information
        alert('Error cancelling booking: ' + xhr.responseText);
    }
    };

        xhr.send('bookingId=' + bookingId);
    }
}

    document.querySelector('.manage-bookings-button').addEventListener('click', function () {
        document.querySelector('.header-with-button').style.display = 'none';
        document.querySelector('.separator').style.display = 'none';
        document.getElementById('discoverText').style.display = 'none';
        document.getElementById('exploreText').style.display = 'none';
        document.querySelector('section').style.display = 'none';
        document.getElementById('bookingsList').style.display = 'block';
        fetchUserBookings();

    });
    

    function searchProducts() {
        var location = document.getElementById('city').value;
        var startDate = document.getElementById('start-date').value;
        var endDate = document.getElementById('end-date').value;
        var guests = document.getElementById('visitors').value;
        var data = {
            location: location,
            startDate: startDate,
            endDate: endDate,
            guests: guests
        };
        if (!startDate || !endDate || guests <= 0) {
            alert("Please fill all the fields correctly.");
            return;
        }
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../searchproducts.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
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
                    results.forEach(function (result) {
                        var resultElement = document.createElement('div');
                        resultElement.className = 'result-item';
                        resultElement.innerHTML =
                            '<h3>' + result.name + ' (ID: ' + result.legal_id + ')</h3>' +
                            '<p>Price: ' + result.price + '</p>' +
                            '<p>Address: ' + result.address + '</p>' +
                            '<p>Coordinates: ' + result.coordinates + '</p>' +
                            '<p>Contact Number: ' + result.contact_number + '</p>' +
                            '<button class="availability-button">See Availability</button>' +
                            '<div class="availability-info" style="display: none;"></div>'; // Additional div for availability info
                        resultsContainer.appendChild(resultElement);
                        var availabilityButton = resultElement.querySelector('.availability-button');
                        availabilityButton.addEventListener('click', function () {
                            showAvailability(resultElement, result.legal_id, startDate, endDate, guests, result.name);
                            this.disabled = true;
                            this.style.display = 'none';
                        });
                    });
                } else {
                    document.getElementById('results').innerHTML = '<p>No results found.</p>';
                }
            }
        }
        xhr.send(JSON.stringify(data));
    }

    function showAvailability(resultElement, legal_id, start_Date, end_Date, guests_, accommodationName) {
        var availabilityInfoDiv = resultElement.querySelector('.availability-info');
        var startDate = start_Date;
        var endDate = end_Date;
        var guests = guests_;
        var data = {
            accommodationLegalId: legal_id,
            guests: guests,
            startDate: startDate,
            endDate: endDate
        };
        console.log(data);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "getAccommodationTypeDetails.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var types;
                try {
                    types = JSON.parse(xhr.responseText);
                } catch (e) {
                    console.error("Error parsing JSON: ", e);
                    return;
                }
                if (types.length === 0) {
                    availabilityInfoDiv.innerHTML = '<p>No available accommodation types found.</p>';
                } else {
                    types.forEach(function (type) {
                        var div = document.createElement('div');
                        div.className = 'rooms-list';
                        div.innerHTML = '<h3>' + type.typeName + ' ( Type ID:' + type.AccommodationTypeID + ' )' + '</h3>' +
                            '<p>Max Guests: ' + type.max_guests + '</p>' +
                            '<p>Bedrooms: ' + type.bedrooms + '</p>' +
                            '<p>Available Rooms: ' + type.available_rooms + '</p>' +
                            '<p>Size: ' + type.size + ' sqm</p>' +
                            '<p class="total-price">Total Price: <span class="price-amount">' + type.TotalPrice + ' €</span></p>' +
                            '<button class="book-button">BOOK</button>';
                        availabilityInfoDiv.appendChild(div);

                        div.querySelector('.book-button').addEventListener('click', function () {
                            bookAccommodation(type.typeID, startDate, endDate, guests);
                        });
                    });
                }
                availabilityInfoDiv.style.display = 'block'; // Show the availability info


            }
        };
        xhr.send(JSON.stringify(data));
    }

    var loginBtn = document.getElementById("loginBtn");
    var signupBtn = document.getElementById("signupBtn");
    if (loginBtn) {
        loginBtn.onclick = function () {
            window.location.href = "login.php";
        };
    }
    if (signupBtn) {
        signupBtn.onclick = function () {
            window.location.href = "signup.php";
        };
    }

    function incrementValue() {
        var value = parseInt(document.getElementById('visitors').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('visitors').value = value;
    }

    function bookAccommodation(accommodationTypeId, startDate, endDate, username) {
        var data = {
            accommodationTypeId: accommodationTypeId,
            startDate: startDate,
            endDate: endDate,
            username: <?php echo $username; ?>
        };
        console.log(data);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "bookAccommodation.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response
                alert("Booking successful!"); // Placeholder response handling
            }
        };
        xhr.send(JSON.stringify(data));
    }

    function decrementValue() {
        var value = parseInt(document.getElementById('visitors').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 0 : value--;
        document.getElementById('visitors').value = value;
    }
</script>
</body>
<style>
    .total-price {
        font-weight: bold;
        margin-top: 10px;
        font-size: 1.2em;
    }
    .price-amount {
        color: #4CAF50; /* Example: Green color for the price */
        font-size: 1.4em;
    }
    .book-button {
        background-color: #4CAF50; /* Green background */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .book-button:hover {
        background-color: #45a049; /* Darker shade of green */
    }</style>
</html>
