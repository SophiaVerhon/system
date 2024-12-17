<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Contact Form</title>
</head>
<body>
    <!-- Header Section -->
    <header class="TOURmain-header">
        <div class="TOURheader-logo-text">
            <img src="image/logo.png" alt="Logo" class="TOURlogo-image">
            <span class="TOURheader-text">Higanteng Laagan Travel & Tours</span>
        </div>
    </header>

    <!-- Contact Form -->
    <div class="contact-container">
        <form action="https://api.web3forms.com/submit" method="POST" class="contact-left">
            <div class="contact-left-title">
                <h2>Get in touch</h2>
            </div>
            <input type="hidden" name="access_key" value="70fc3481-ffc0-42ad-b479-023529812b2d">
            <input type="text" name="name" placeholder="Your Name" class="contact-inputs" required>
            <input type="email" name="email" placeholder="Your Email" class="contact-inputs" required>
            <textarea name="message" placeholder="Your Message" class="contact-inputs" required></textarea>
            <button type="submit" class="contact-submit">Submit</button>
        </form>
        <div class="contact-right">
            <img src="image/contact.jpg" alt="Contact">
        </div>
    </div>

    <!-- Dropdown Script -->
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('show');
        }
        window.addEventListener('click', (e) => {
            if (!e.target.matches('.dropdown-toggle')) {
                const dropdowns = document.querySelectorAll('.TOURdropdown-menu');
                dropdowns.forEach(menu => menu.classList.remove('show'));
            }
        });
    </script>
</body>
</html>