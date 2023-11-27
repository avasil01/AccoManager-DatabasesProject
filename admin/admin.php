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
    <h1 style="margin-left: 30px;">Logged in as Accommodation Admin</h1>

    <!-- Tab links -->
    <div class="tab" style="display: flex; justify-content: center; gap: 15px;">
      <button class="tablinks" onclick="openTab(event, 'Accommodation')">Accommodation Management</button>
      <button class="tablinks" onclick="openTab(event, 'RoomType')">Room Type Management</button>
      <button class="tablinks" onclick="openTab(event, 'Product')">Product Management</button>
    </div>

    <!-- Tab content -->
    <div id="Accommodation" class="tabcontent">
      <h3>Accommodation Management</h3>
      <button class="blue-button" onclick="createNewAccommodation()">+ Add New Accommodation</button>
    </div>

    <div id="RoomType" class="tabcontent">
      <h3>Room Type Management</h3>
      <button class="blue-button" onclick="createNewRoomType()">+ Add New Room Type</button>
      
    </div>

    <div id="Product" class="tabcontent">
      <h3>Product Management</h3>
      <button class="blue-button" onclick="createNewProduct()">+ Add New Product</button>
      
    </div>
  </main>

  <!-- add a new accommodation pop up form -->
  <div id="newAccommodationModal" class="modal">
    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Add New Accommodation</h2>
      <form id="newAccommodationForm">
        <div>
          <h3>Contact Info:</h3>
          Accommodation ID: <input type="text" name="accommodationId"><br>
          Accommodation Name: <input type="text" name="accommodationName"><br>
          <h3>Person in Contact Info:</h3>
          Full Name: <input type="text" name="contactFullName"><br>
          Email: <input type="text" name="contactEmail"><br>
          Phone Number: <input type="text" name="contactPhoneNumber"><br>
          <h3>Accommodation Details:</h3>
          Accommodation Category: <input type="text" name="accommodationCategory"><br>
          Physical Location (Address): <input type="text" name="accommodationAddress"><br>
          Geographic Coordinates: <input type="text" name="geographicCoordinates"><br>
          <h3>Details of Offered Services:</h3>
          <input type="text" name="offeredServices">
          <button type="button" onclick="addServiceInput()">+</button><br>
        </div>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>

     <!-- add a new room type pop up form -->
  <div id="newRoomTypeModal" class="modal">
    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
      <span class="close" onclick="closeModal('newRoomTypeModal')">&times;</span>
      <h2>Add New Room Type</h2>
      <form id="newRoomTypeForm">
        <div>
          <h3>Room Details:</h3>
          Room Type: <input type="text" name="roomType"><br>
          Maximum Number of Guests: <input type="number" name="maxGuests" min="0" max="100"><br>
          Size: <input type="number" name="size" min="0" max="2000"><br>
          <h3>Features Provided:</h3>
          <input type="text" name="featuresProvided">
          <button type="button" onclick="addFeatureInput()">+</button><br>
          <h3>Price Category:</h3>
          Price: <input type="number" name="priceCategory" min="1" max="1000"><br>
          <h3>Terms:</h3>
          <input type="text" name="terms" class="termsInput">
          Refund (%): <input type="number" name="refundPercentage" class="termsInput" value="0"><br>
          <button type="button" onclick="addTermInput()">+</button><br>
          <h3>Meals:</h3>
          <input type="text" name="meals">
          <button type="button" onclick="addMealInput()">+</button><br>
          <h3>Inventory (Availability):</h3>
          <!-- Additional fields for inventory can be added here -->
        </div>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>

  <!-- add a new product type pop up form -->
  <div id="newProductModal" class="modal">
    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
      <span class="close" onclick="closeModal('newProductModal')">&times;</span>
      <h2>Add New Product</h2>
      <form id="newProductForm">
        <div>
          <h3>Product Details:</h3>
          Room Type: <input type="text" name="productRoomType"><br>
          Room Price: <input type="text" name="productRoomPrice"><br>
          <h3>Terms:</h3>
          <input type="text" name="productTerms" class="productTermsInput">
          <button type="button" onclick="addProductTermInput()">+</button><br>
          <h3>Meals:</h3>
          <input type="text" name="productMeals">
          <button type="button" onclick="addProductMealInput()">+</button><br>
        </div>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
  <footer>
    <p>&copy; 2023 AccoManager. All rights reserved.</p>
  </footer>
</body>
</html>

<script>
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

function createNewAccommodation() {
  alert("Create new accommodation functionality will be implemented here.");
}

function createNewRoomType() {
  alert("Create new room type functionality will be implemented here.");
}

function createNewProduct() {
  alert("Create new product functionality will be implemented here.");
}

//add new accommodation functions
function createNewAccommodation() {
    document.getElementById('newAccommodationModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('newAccommodationModal').style.display = 'none';
  }

  function addServiceInput() {
    var form = document.getElementById('newAccommodationForm');
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'offeredServices';
    input.style.marginTop = "10px"; // Optional, for spacing between inputs

    // Find the submit button in the form
    var submitButton = form.querySelector('input[type=submit]');

    // Insert the new input field before the submit button
    form.insertBefore(input, submitButton);
}

function createNewRoomType() {
    document.getElementById('newRoomTypeModal').style.display = 'block';
  }

  function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
  }

  function addFeatureInput() {
    var form = document.getElementById('newRoomTypeForm');
    var lastFeatureInput = form.querySelectorAll('input[name="featuresProvided"]').length > 0 ?
                           form.querySelectorAll('input[name="featuresProvided"]') :
                           [form.querySelector('input[name="roomType"]')]; // Fallback to room type input
    var newFeatureInput = document.createElement('input');
    newFeatureInput.type = 'text';
    newFeatureInput.name = 'featuresProvided';
    newFeatureInput.style.marginTop = "10px";

    var referenceNode = lastFeatureInput[lastFeatureInput.length - 1];
    referenceNode.parentNode.insertBefore(newFeatureInput, referenceNode.nextSibling);
}

function addTermInput() {
    var form = document.getElementById('newRoomTypeForm');
    var lastTermInput = form.querySelectorAll('.termsInput').length > 0 ?
                        form.querySelectorAll('.termsInput') :
                        [form.querySelector('input[name="priceCategory"]')]; // Fallback to price category input
    var newTermInput = document.createElement('input');
    newTermInput.type = 'text';
    newTermInput.name = 'terms';
    newTermInput.className = 'termsInput';
    newTermInput.style.marginTop = "10px";

    var referenceNode = lastTermInput[lastTermInput.length - 1];
    referenceNode.parentNode.insertBefore(newTermInput, referenceNode.nextSibling);
}

function addMealInput() {
    var form = document.getElementById('newRoomTypeForm');
    var lastMealInput = form.querySelectorAll('input[name="meals"]').length > 0 ?
                        form.querySelectorAll('input[name="meals"]') :
                        [form.querySelector('input[name="terms"]')]; // Fallback to terms input
    var newMealInput = document.createElement('input');
    newMealInput.type = 'text';
    newMealInput.name = 'meals';
    newMealInput.style.marginTop = "10px";

    var referenceNode = lastMealInput[lastMealInput.length - 1];
    referenceNode.parentNode.insertBefore(newMealInput, referenceNode.nextSibling);
}

function createNewProduct() {
    document.getElementById('newProductModal').style.display = 'block';
  }

  function addProductTermInput() {
    var form = document.getElementById('newProductForm');
    var lastTermInput = form.querySelectorAll('.productTermsInput').length > 0 ?
                        form.querySelectorAll('.productTermsInput') :
                        [form.querySelector('input[name="productRoomPrice"]')]; // Fallback to room price input
    var newTermInput = document.createElement('input');
    newTermInput.type = 'text';
    newTermInput.name = 'productTerms';
    newTermInput.className = 'productTermsInput';
    newTermInput.style.marginTop = "10px";

    var referenceNode = lastTermInput[lastTermInput.length - 1];
    referenceNode.parentNode.insertBefore(newTermInput, referenceNode.nextSibling);
  }

  function addProductMealInput() {
    var form = document.getElementById('newProductForm');
    var lastMealInput = form.querySelectorAll('input[name="productMeals"]').length > 0 ?
                        form.querySelectorAll('input[name="productMeals"]') :
                        [form.querySelector('input[name="productTerms"]')]; // Fallback to terms input
    var newMealInput = document.createElement('input');
    newMealInput.type = 'text';
    newMealInput.name = 'productMeals';
    newMealInput.style.marginTop = "10px";

    var referenceNode = lastMealInput[lastMealInput.length - 1];
    referenceNode.parentNode.insertBefore(newMealInput, referenceNode.nextSibling);
  }

  

 
</script>
