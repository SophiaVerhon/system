<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="booking.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Booking</title>
</head>

<body>
<header class="TOURmain-header">
  <div class="TOURheader-logo-text">
    <img src="image/logo.png" alt="Logo" class="TOURlogo-image">
    <span class="TOURheader-text">Higanteng Laagan Travel & Tours</span>
  </div>
  <nav class="TOURheader-navHP">
    <a href="homepage.php" class="TOURnav-linkHP">GO BACK TO HOMEPAGE</a>
    <div class="TOURdropdown">
      <span class="TOURnav-linkHP dropdown-toggle" onclick="toggleDropdown()">MY PROFILE</span>
      <div id="profile-dropdown" class="TOURdropdown-menu">
        <a href="profile.php" class="TOURdropdown-item">My Account</a>
        <a href="bkstatus.php" class="TOURdropdown-item">Booking Status</a>
        <a href="index.php" class="TOURdropdown-item">Log Out</a>
      </div>
    </div>
  </nav>
</header>

<section>
    <div class="logincreateform-box">
        <div class="logincreateform-value">
            <form action="booking.php" method="POST" enctype="multipart/form-data">
                <h2 class="logincreateh2">Booking Form</h2>

                <!-- First Name and Last Name side-by-side -->
                <div class="input-row">
                    <div class="inputbox">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="inputbox">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>
                <!-- Contact Number -->
                <div class="inputbox">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" required maxlength="11" pattern="^\d{11}$">
                </div>
                <!-- Email -->
                <div class="inputbox">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <!-- Tour Selection -->
                <div class="inputbox">
                    <label for="tour_choice">Tour</label>
                    <select id="tour_choice" name="tour_choice" required>
                        <option value="" disabled selected>Select a Tour</option>
                        <option value="Bamboo Peak">Bamboo Peak</option>
                        <option value="Communal Ranch x Dahilayan">Communal Ranch x Dahilayan</option>
                        <option value="Dinagsaan Peak">Dinagsaan Peak</option>
                        <option value="Impasug-ong Tour">Impasug-ong Tour</option>
                        <option value="Kapatagan Tour">Kapatagan Tour</option>
                        <option value="Kipilas Falls">Kipilas Falls</option>
                        <option value="Lake Holon">Lake Holon</option>
                        <option value="Lake Holon (2D1N)">Lake Holon (2D1N)</option>
                        <option value="Marilog Tour">Marilog Tour</option>
                        <option value="Mindamora Falls">Mindamora Falls</option>
                        <option value="Mt. Apo">Mt. Apo</option>
                        <option value="Mt. Apo (2D1N)">Mt. Apo (2D1N)</option>
                        <option value="Mt. Apo (3D2N)">Mt. Apo (3D2N)</option>
                        <option value="Mt. Dinor">Mt. Dinor</option>
                        <option value="Mt. Fortune & Saliducon Cave">Mt. Fortune & Saliducon Cave</option>
                        <option value="Mt. Guiting-Guiting (3D2N)">Mt. Guiting-Guiting (3D2N)</option>
                        <option value="Mt. Kalatungan">Mt. Kalatungan</option>
                        <option value="Mt. Kalatungan (3D2N)">Mt. Kalatungan (3D2N)</option>
                        <option value="Mt. Kalumotan (2D1N)">Mt. Kalumotan (2D1N)</option>
                        <option value="Mt. Kiamo (2D1N)">Mt. Kiamo (2D1N)</option>
                        <option value="Mt. Kitanglad (2D1N)">Mt. Kitanglad (2D1N)</option>
                        <option value="Mt. Kulago">Mt. Kulago</option>
                        <option value="Mt. Kulago (2D1N)">Mt. Kulago (2D1N)</option>
                        <option value="Mt. Loay traverse Mt. Fortune">Mt. Loay traverse Mt. Fortune</option>
                        <option value="Mt. Matutum">Mt. Matutum</option>
                        <option value="Mt. Pulag (2D1N)">Mt. Pulag (2D1N)</option>
                        <option value="Mt. Pulag (3D2N)">Mt. Pulag (3D2N)</option>
                        <option value="Siargao Island (3D2N)">Siargao Island (3D2N)</option>
                        <option value="Tomari Falls">Tomari Falls</option>
                    </select>
                </div>

                <!-- Number of People -->
                <div class="inputbox">
                    <label for="num_people">Number of People</label>
                    <input type="number" id="num_people" name="num_people" min="1" value="1" required>
                </div>

                <!-- Name of Other Adventurers -->
                <div class="inputbox">
                    <label for="other_adventurers">Name of Other Adventurers</label>
                    <ul id="adventurer_list"></ul>
                </div>

                <!-- File Upload Section -->
                <div class="inputbox">
                <label for="id_upload">Upload Your Valid ID <span>(Each adventurer must have one valid ID)</span></label>
                <input type="file" id="id_upload" name="id_upload[]" accept="image/*" multiple required>
                </div>

                <div class="preview-container">
                <div id="photo_preview" class="photo-preview-box"></div>
                </div>



                <!-- Proceed to Payment Button -->
                <button type="button" class="submit-btn" onclick="togglePaymentSection()">Proceed to Payment</button>

                <!-- Collapsible Payment Section -->
                <div id="payment-section" class="collapsible-content" style="display: none;">
                
                <!-- Gcash scan container -->
                <div class="scan-image-container">
                    <img src="image/scan.jpg" alt="Payment Instructions" class="container-image">
                </div>

                <!-- Payment Upload -->
                    <div class="inputbox">
                    <label for="ref_number">GCASH Reference Number for payment verification purposes (Required)</label>
                    <input type="text" id=ref_number name="ref_number" required>
                </div>

                <!-- Payment Upload -->
                <div class="inputbox">
                    <label for="payment_upload">Upload your payment screenshot here (Optional)</label>
                    <input type="file" id="payment_upload" name="payment_upload" accept="image/*" required>
                </div>

                <!-- Upload Preview -->
                <div class="preview-container">
                <div id="payment_preview" class="photo-preview-box"></div>
            </div>

                <!-- BOOK NOW Button -->
                <button type="submit" class="submit-btn">BOOK NOW</button>
                </div>

                <script>
                function togglePaymentSection() {
                    const paymentSection = document.getElementById('payment-section');
                    // Toggle visibility of the section
                    if (paymentSection.style.display === 'none' || paymentSection.style.display === '') {
                    paymentSection.style.display = 'block'; // Show the section
                    } else {
                    paymentSection.style.display = 'none'; // Hide the section
                    }
                }
                </script>

    </form>
    </div>
    </div>
    </section>
    
    <!-- Footer -->
    <footer id="about-us-footer">
        <div class="TOURfooterContainer">
            <div class="TOURsocialIcons">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="TOURfooterNav">
                <ul>
                    <li><a href="hompage.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="TOURfooterBottom">
            <p>Copyright &copy;2024; Designed by <span class="TOURdesigner">CASSanga</span></p>
        </div>
    </footer>
   

<script>
// Validate form before submission
function validateForm() {
    var contactNumber = document.getElementById("contact_number").value;

    // Check if contact number is exactly 11 digits
    if (contactNumber.length !== 11 || !/^\d+$/.test(contactNumber)) {
        alert("Contact number must be exactly 11 digits.");
        return false; // Prevent form submission
    }
    return true;
}
</script>

<script>
// Dropdown Menu Functionality
  function toggleDropdown() {
    const dropdownMenu = document.getElementById('profile-dropdown');
    dropdownMenu.classList.toggle('show');
  }

  // Close the dropdown menu if clicked outside
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle')) {
      const dropdowns = document.getElementsByClassName('TOURdropdown-menu');
      for (let i = 0; i < dropdowns.length; i++) {
        const openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  };

// Adjust adventurer fields dynamically
document.getElementById('num_people').addEventListener('input', function () {
    const numPeople = parseInt(this.value, 10) || 0;
    const adventurerList = document.getElementById('adventurer_list');

    // Adjust the adventurer inputs based on number of people
    while (adventurerList.children.length < numPeople - 1) {
        const li = document.createElement('li');
        li.innerHTML = `<input type="text" name="adventurer_names[]" placeholder="Enter a name" required>`;
        adventurerList.appendChild(li);
    }
    while (adventurerList.children.length > numPeople - 1) {
        adventurerList.removeChild(adventurerList.lastChild);
    }
});

</script>

<script>
document.getElementById('contact_number').addEventListener('input', function (event) {
    let input = event.target;
    let value = input.value;

    // Remove non-digit characters
    value = value.replace(/\D/g, '');
    
    // Limit to 11 digits
    if (value.length > 11) {
        value = value.slice(0, 11);
    }
    
    input.value = value; // Set the updated value
});

</script>


<script>

    // Adjust the adventurer inputs based on number of people
    while (adventurerList.children.length < numPeople - 1) {
        const li = document.createElement('li');
        li.innerHTML = `<input type="text" name="adventurer_names[]" placeholder="Enter a name" required>`;
        adventurerList.appendChild(li);
    }
    while (adventurerList.children.length > numPeople - 1) {
        adventurerList.removeChild(adventurerList.lastChild);
    }

</script>



<script>
const fileLists = {}; // Object to store selected files for each input

// General function for managing file uploads and previews
function handleFileUpload(inputElement, previewContainerId) {
    const previewContainer = document.getElementById(previewContainerId);
    const inputId = inputElement.id; // Unique ID of the input field
    const newFiles = Array.from(inputElement.files);
    const newDataTransfer = new DataTransfer();

    // Initialize file list for the input if not already
    if (!fileLists[inputId]) {
        fileLists[inputId] = [];
    }

    // Add new files to the respective file list
    fileLists[inputId] = [...fileLists[inputId], ...newFiles];

    // Remove duplicates by checking filenames
    fileLists[inputId] = fileLists[inputId].reduce((acc, file) => {
        if (!acc.some(f => f.name === file.name)) acc.push(file);
        return acc;
    }, []);

    // Clear preview and render all selected files
    previewContainer.innerHTML = '';
    fileLists[inputId].forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            // Create image preview
            const imgWrapper = document.createElement('div');
            imgWrapper.style.position = 'relative';
            imgWrapper.style.display = 'inline-block';
            imgWrapper.style.marginRight = '10px';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.objectFit = 'cover';
            img.style.border = '1px solid #ccc';
            img.style.borderRadius = '5px';

            // Create delete button
            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'X';
            deleteBtn.style.position = 'absolute';
            deleteBtn.style.top = '5px';
            deleteBtn.style.right = '5px';
            deleteBtn.style.backgroundColor = 'red';
            deleteBtn.style.color = 'white';
            deleteBtn.style.border = 'none';
            deleteBtn.style.borderRadius = '50%';
            deleteBtn.style.cursor = 'pointer';

            deleteBtn.addEventListener('click', () => {
                // Remove file preview and update file input
                fileLists[inputId].splice(index, 1);
                updateFileInput(inputElement, fileLists[inputId]);
                imgWrapper.remove();
            });

            imgWrapper.appendChild(img);
            imgWrapper.appendChild(deleteBtn);
            previewContainer.appendChild(imgWrapper);
        };
        reader.readAsDataURL(file);

        // Add file to DataTransfer object for input field
        newDataTransfer.items.add(file);
    });

    // Update the file input with all selected files
    inputElement.files = newDataTransfer.files;
}

// Update the file input field
function updateFileInput(inputElement, files) {
    const dataTransfer = new DataTransfer();
    files.forEach(file => dataTransfer.items.add(file));
    inputElement.files = dataTransfer.files;
}

// Attach event listeners for both file inputs
document.getElementById('id_upload').addEventListener('change', function () {
    handleFileUpload(this, 'photo_preview');
});
document.getElementById('payment_upload').addEventListener('change', function () {
    handleFileUpload(this, 'payment_preview');
});
</script>


<script>
        window.onload = function () {
            if (window.location.hash) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
            window.scrollTo(0, 0);
        };
    </script>
</body>
</html>