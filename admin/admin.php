<?php

session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../login.php');
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
    <h1 style="margin-left: 30px;">Logged in as <?php echo $username; ?></h1>

    <div class="tab" style="display: flex; justify-content: center; gap: 15px;">
      <button class="tablinks" onclick="openTab(event, 'Accommodation')">Accommodation Management</button>
      <button class="tablinks" onclick="openTab(event, 'RoomType')">Room Type Management</button>
      <button class="tablinks" onclick="openTab(event, 'Product')">Product Management</button>
    </div>

    <div id="Accommodation" class="tabcontent">
      <h3>Accommodation Management</h3>
      <button class="blue-button" onclick="createNewAccommodation()">+ Add New Accommodation</button>
      <button class="blue-button" onclick="modifyAccommodation()"> Modify an Accommodation</button>
    </div>

    <div id="RoomType" class="tabcontent">
      <h3>Room Type Management</h3>
      <button class="blue-button" onclick="createNewRoomType()">+ Add New Room Type</button>
      <button class="blue-button" onclick="modifyRoomType()"> Modify a Room Type</button>
      
    </div>

    <div id="Product" class="tabcontent">
      <h3>Product Management</h3>
      <button class="blue-button" onclick="createNewProduct()">+ Add New Product</button>
      
    </div>
  </main>

  <div id="modifyAccommodationModal" class="modal">
   <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
      <span class="close" onclick="closeModal_modify_Acc()">&times;</span>
      <h2>Modify Accommodation (Provide the Accommodation ID to update)</h2>
      <form id="ModifyAccommodationForm">
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
          Town: <input type="text" name="town"><br> 
          <input type="text" name="username" readonly  value="<?php echo $username; ?>">
          <h3>Details of Offered Services:</h3>
          <div id="serviceInputsContainer">
          <input type="text" name="offeredServices[]" class="service-input" placeholder="Service Name">
          <button type="button" onclick="addServiceInput()">+</button>
          </div>
        </div>
        
      </form>
      <button class="button-modify-accommodation" type="submit">Submit</button>
    </div>
  </div>


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
          Town: <input type="text" name="town"><br> 
          <input type="text" name="username" readonly  value="<?php echo $username; ?>">
          <h3>Details of Offered Services:</h3>
          <div id="serviceInputsContainer">
          <input type="text" name="offeredServices[]" class="service-input" placeholder="Service Name">
          <button type="button" onclick="addServiceInput()">+</button>
          </div>
        </div>
        
      </form>
      <button class="button-submit-accommodation" type="submit">Submit</button>
    </div>
  </div>

  <div id="modifyRoomTypeModal" class="modal">
    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
      <span class="close" onclick="closeModal_modify_roomtype()">&times;</span>
      <h2>Modify Room Type: (Provide the Room Type and update)</h2>
      <form id="ModifyRoomTypeForm">
        <div>
          <h3>Room Details:</h3>
          Room Type: <input type="text" name="roomTypeModify"><br>
          Room Name: <input type="text" name="roomNameModify"><br>
          Maximum Number of Guests: <input type="number" name="maxGuestsModify" min="0" max="100"><br>
          Size: <input type="number" name="sizeModify" min="0" max="2000"><br>
          Bedrooms: <input type="number" name="bedroomsModify" min="0" max="100"><br>
          AccommodationID: <input type="number" name="accommodationIdModify"><br>
          Available Rooms: <input type="number" name="availableroomsModify"><br>
        </div>
        <button class = "button-modify-roomtype">SUBMIT</button>
      </form>
    </div>
  </div>



  <div id="newRoomTypeModal" class="modal">
    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
      <span class="close" onclick="closeModal_roomtype()">&times;</span>
      <h2>Add New Room Type</h2>
      <form id="newRoomTypeForm">
        <div>
          <h3>Room Details:</h3>
          Room Type: <input type="text" name="roomType"><br>
          Maximum Number of Guests: <input type="number" name="maxGuests" min="0" max="100"><br>
          Size: <input type="number" name="size" min="0" max="2000"><br>
          Bedrooms: <input type="number" name="bedrooms" min="0" max="100"><br>
          AccommodationID: <input type="number" name="accommodationId"><br>
          Available Rooms: <input type="number" name="availablerooms"><br>
        </div>
        <button class = "button-submit-roomtype">SUBMIT</button>
      </form>
    </div>
  </div>

  <div id="newProductModal" class="modal">
    <div class="modal-content" style="border-radius: 10px; box-shadow: 0px 0px 10px #888888;">
      <span class="close" onclick="closeModal_product()">&times;</span>
      <h2>Add New Product</h2>
      <form id="newProductForm">
        <div>
          <h3>Product Details:</h3>
          Date: <input type="date" name="productDate"><br>
          Room Price: <input type="text" name="productRoomPrice"><br>
          Meals: <input type="text" name="productMeals"><br>
          Policy: <input type="text" name="productPolicy"><br>
          Refund Percentage: <input type="number" name="productRefundPercentage"><br>
          Penalty Percentage: <input type="number" name="productPenaltyPercentage"><br>
          Discount Percentage: <input type="number" name="productDiscountPercentage"><br>
          Accommodation Type ID:
          <select class="dropdownTypes" name="productAccommodationTypeId" id="accommodationTypeDropdown">
          <option value="">Select Accommodation Type</option>
    
            </select><br>
        </div>
        <button class="submit-new-product">Submit</button>
      </form>
    </div>
  </div>
  <footer>
    <p>&copy; 2023 AccoManager. All rights reserved.</p>
  </footer>
</body>
</html>

<script>
function modifyRoomTypeData() {

    var form = document.getElementById('ModifyRoomTypeForm');
    var roomType = form.elements['roomTypeModify'].value;
    var roomName = form.elements['roomNameModify'].value;
    var maxGuests = form.elements['maxGuestsModify'].value;
    var size = form.elements['sizeModify'].value;
    var bedrooms = form.elements['bedroomsModify'].value;
    var accommodationId = form.elements['accommodationIdModify'].value;
    var availableRooms = form.elements['availableroomsModify'].value;

    var data = {
        roomTypeModify: roomType,
        roomNameModify: roomName,
        maxGuestsModify: maxGuests,
        sizeModify: size,
        bedroomsModify: bedrooms,
        accommodationIdModify: accommodationId,
        availableroomsModify: availableRooms
    };

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ModifyRoomType.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            if (response.success) {
                alert('Room Type Modified Successfully');
            } else {
                alert('Error: ' + response.error);
            }
        }
    };

    xhr.send(JSON.stringify(data));
}

document.querySelector('.button-modify-roomtype').addEventListener('click', function(event) {
    event.preventDefault();
    modifyRoomTypeData();
});



function modifyRoomType() {
    document.getElementById('modifyRoomTypeModal').style.display = 'block';
}
function fetchRoomTypeData() {
    var roomTypeInput = document.querySelector('input[name="roomTypeModify"]');
    var username = '<?php echo $username; ?>';

    roomTypeInput.addEventListener('input', function() {
        var roomType = roomTypeInput.value;
        if (roomType) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'GetRoomType.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    console.log('Room type data:', data);
                    populateRoomTypeForm(data);
                } else {
                    console.error('Error fetching room type data:', xhr.status);
                }
            };

            var data = 'roomType=' + encodeURIComponent(roomType) + '&username=' + encodeURIComponent(username);
            xhr.send(data);
        }
    });
}



function populateRoomTypeForm(data) {
    document.querySelector('input[name="maxGuestsModify"]').value = data.max_guests || '';
    document.querySelector('input[name="sizeModify"]').value = data.size || '';
    document.querySelector('input[name="bedroomsModify"]').value = data.bedrooms || '';
    document.querySelector('input[name="accommodationIdModify"]').value = data.accommodation || '';
    document.querySelector('input[name="availableroomsModify"]').value = data.available_rooms || '';
    document.querySelector('input[name="roomNameModify"]').value = data.name || '';
}

document.addEventListener('DOMContentLoaded', function() {

    fetchRoomTypeData();
});



function submitModifyAccommodationForm() {
    var form = document.getElementById('ModifyAccommodationForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'modifyAccommodation.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Modify Successful');
            } else {
                alert('Error: ' + response.error);
            }
        }
    };

    xhr.send(formData);
}

document.querySelector('.button-modify-accommodation').addEventListener('click', function(event) {
    event.preventDefault();
    submitModifyAccommodationForm();
});




function fetchAccommodationData() {
    var accommodationIdInput = document.querySelector('input[name="accommodationId"]');
    accommodationIdInput.addEventListener('change', function() {
        var accommodationId = accommodationIdInput.value;
        if (accommodationId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'GetAccommodation.php?accommodationId=' + accommodationId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    populateAccommodationForm(response);
                } else {
                    console.error('Error fetching accommodation data:', xhr.status);
                }
            };
            xhr.send();
        }
    });
}

function populateAccommodationForm(data) {
    document.querySelector('input[name="accommodationId"]').value = data.legal_id || '';
    document.querySelector('input[name="accommodationName"]').value = data.name || '';
    document.querySelector('input[name="accommodationAddress"]').value = data.address || '';
    document.querySelector('input[name="geographicCoordinates"]').value = data.coordinates || '';
    document.querySelector('input[name="accommodationCategory"]').value = data.categoryName || ''; 
    document.querySelector('input[name="contactPhoneNumber"]').value = data.phone_number || '';
    document.querySelector('input[name="contactFullName"]').value = data.name || '';
    document.querySelector('input[name="contactEmail"]').value = data.email || '';
    document.querySelector('input[name="town"]').value = data.town || '';


}


document.addEventListener('DOMContentLoaded', function() {
    fetchAccommodationData();
});



function addNewProduct() {
    var form = document.getElementById('newProductForm');
    var data = {
        productDate: form.elements['productDate'].value,
        productRoomPrice: form.elements['productRoomPrice'].value,
        productMeals: form.elements['productMeals'].value,
        productPolicy: form.elements['productPolicy'].value,
        productRefundPercentage: form.elements['productRefundPercentage'].value,
        productPenaltyPercentage: form.elements['productPenaltyPercentage'].value,
        productDiscountPercentage: form.elements['productDiscountPercentage'].value,
        productAccommodationTypeId: form.elements['productAccommodationTypeId'].value
    };

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'AddProduct.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Product added successfully');
            } else {
                alert('Error adding product:', response.error);
            }
        }
    };
    xhr.send(JSON.stringify(data));
}

document.addEventListener('DOMContentLoaded', function() {
    var submitButton = document.querySelector('.submit-new-product'); 
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();
        addNewProduct();
    });
});




function fetchAccommodationTypes() {
    var data = {
        username: <?php echo json_encode($username); ?>
    };
    console.log("Request Data:", data); 

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'getUsersTypes.php', true);
    xhr.onload = function() {
        console.log("Response Received:", this.responseText); 
        if (this.status == 200) {
            var types = JSON.parse(this.responseText);
            console.log("Parsed Types:", types); 
            var dropdown = document.getElementById('accommodationTypeDropdown');
            types.forEach(function(type) {
                var option = document.createElement('option');
                option.value = type.AccommodationTypeID;
                option.textContent = type.Name;
                dropdown.appendChild(option);
            });
        } else {
            console.error("Error fetching data:", this.status); 
        }
    };
    xhr.send(JSON.stringify(data));
}



function submitServices(accommodationId) {
  var serviceInputs = document.querySelectorAll('input[name="offeredServices[]"]');
    console.log("Service Inputs:", serviceInputs); 
    serviceInputs.forEach(function(serviceInput) {
        
        var serviceName = serviceInput.value;
        if (serviceName) {
            var data = {
                accommodationId: accommodationId,
                serviceName: serviceName
            };

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'addservice.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json'); 

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Added a Room Type successfully');
                    }
                } else {
                    alert('An error occurred while sending the request for service addition.');
                }
            };

            xhr.send(JSON.stringify(data));
        }
    });
}


function addServiceInput() {
    var container = document.getElementById('serviceInputsContainer');
    var newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.name = 'offeredServices[]'; 
    newInput.className = 'service-input';
    newInput.placeholder = 'Service Name';
    container.appendChild(newInput);

    console.log("New service input added.");
}



function submitRoomType() {
    var form = document.getElementById('newRoomTypeForm');

    var data = {
        roomType: form.elements['roomType'].value,
        maxGuests: form.elements['maxGuests'].value,
        bedrooms: form.elements['bedrooms'].value,
        availablerooms: form.elements['availablerooms'].value,
        size: form.elements['size'].value,
        accommodationId: form.elements['accommodationId'].value
    };

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'addroomtype.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json'); 

    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Room type added successfully');
                location.reload();
            } else {
                alert('Error adding room type: ' + response.error);
            }
        } else {
            alert('An error occurred while sending the request.');
        }
    };

    xhr.send(JSON.stringify(data)); 
}


document.addEventListener('DOMContentLoaded', function () {
    var submitButton = document.querySelector('.button-submit-roomtype'); 
    submitButton.addEventListener('click', function (event) {
        event.preventDefault();
        submitRoomType();
    });
});
function closeModal_modify_roomtype() {
  var modal = document.getElementById('modifyRoomTypeModal');
    modal.style.display = 'none';
}
function closeModal_modify_Acc() {
  var modal = document.getElementById('modifyAccommodationModal');
    modal.style.display = 'none';
}

function closeModal_roomtype() {
    var modal = document.getElementById('newRoomTypeModal');
    modal.style.display = 'none';
}

function closeModal_product() {
    var modal = document.getElementById('newProductModal');
    modal.style.display = 'none';
}

function closeModal() {
    var modal = document.getElementById('newAccommodationModal');
    modal.style.display = 'none';
}

function submitAccommodation() {
  var form = document.getElementById('newAccommodationForm');


var data = {
    accommodationId: form.elements['accommodationId'].value,
    accommodationName: form.elements['accommodationName'].value,
    contactFullName: form.elements['contactFullName'].value,
    contactEmail: form.elements['contactEmail'].value,
    contactPhoneNumber: form.elements['contactPhoneNumber'].value,
    accommodationCategory: form.elements['accommodationCategory'].value,
    accommodationAddress: form.elements['accommodationAddress'].value,
    geographicCoordinates: form.elements['geographicCoordinates'].value,
    town: form.elements['town'].value,
    username: form.elements['username'].value
};

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'addaccommodation.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json'); 

    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              console.log(response);
                alert('Accommodation added successfully');
                submitServices(form.elements['accommodationId'].value);
                location.reload(); 
            } else {
                alert('Error adding accommodation: ' + response.error);
            }
        } else {
            alert('An error occurred while sending the request.');
        }
    };

    xhr.send(JSON.stringify(data)); 
}

document.addEventListener('DOMContentLoaded', function () {
    var submitButton = document.querySelector('.button-submit-accommodation');
    submitButton.addEventListener('click', function (event) {
        event.preventDefault();
        submitAccommodation();
    });
});


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

function createNewAccommodation() {
    document.getElementById('newAccommodationModal').style.display = 'block';
  }
function modifyAccommodation(){
    document.getElementById('modifyAccommodationModal').style.display = 'block';
}

  function closeModal() {
    document.getElementById('newAccommodationModal').style.display = 'none';
  }

function createNewRoomType() {
    document.getElementById('newRoomTypeModal').style.display = 'block';
  }



function addTermInput() {
    var form = document.getElementById('newRoomTypeForm');
    var lastTermInput = form.querySelectorAll('.termsInput').length > 0 ?
                        form.querySelectorAll('.termsInput') :
                        [form.querySelector('input[name="priceCategory"]')]; 
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
                        [form.querySelector('input[name="terms"]')];
    var newMealInput = document.createElement('input');
    newMealInput.type = 'text';
    newMealInput.name = 'meals';
    newMealInput.style.marginTop = "10px";

    var referenceNode = lastMealInput[lastMealInput.length - 1];
    referenceNode.parentNode.insertBefore(newMealInput, referenceNode.nextSibling);
}

function createNewProduct() {
    document.getElementById('newProductModal').style.display = 'block';
    fetchAccommodationTypes();
  }

  function addProductTermInput() {
    var form = document.getElementById('newProductForm');
    var lastTermInput = form.querySelectorAll('.productTermsInput').length > 0 ?
                        form.querySelectorAll('.productTermsInput') :
                        [form.querySelector('input[name="productRoomPrice"]')]; 
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
                        [form.querySelector('input[name="productTerms"]')]; 
    var newMealInput = document.createElement('input');
    newMealInput.type = 'text';
    newMealInput.name = 'productMeals';
    newMealInput.style.marginTop = "10px";

    var referenceNode = lastMealInput[lastMealInput.length - 1];
    referenceNode.parentNode.insertBefore(newMealInput, referenceNode.nextSibling);
  }

  

 
</script>
