<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Spotify+</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
/* Add your CSS styles here */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background: url('http://localhost/spotifyPlus/naat/1721189713553.jpg') no-repeat center center fixed; 
    background-size: cover;
    color: #333;
}

header {
    background: rgba(59, 59, 59, 0.7);
    color: #fff;
    padding: 1em 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    margin-left: 20px; /* Add some left margin */
}

.logo img {
    width: 50px;
    height: 50px;
    margin-right: 5px; /* Reduced space */
}

.logo h3 {
    margin: 0;
    color: #ffff; /* Same color as the button */
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

nav ul li {
    margin: 0 10px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

.main-content {
    padding: 20px;
}

.contact {
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: 0 auto;
}

.contact h1 {
    color: #107a35;
    text-align: center;
}

.contact-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
}

.contact-info, .contact-form {
    flex: 1;
    min-width: 300px;
    margin: 10px;
}

.contact-info {
    background: #107a35;
    color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
}

.contact-info h2 {
    margin: 0;
}

.contact-form form {
    display: flex;
    flex-direction: column;
}

.contact-form label {
    margin-top: 10px;
    color: #333;
}

.contact-form input, .contact-form textarea {
    margin-top: 5px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.contact-form button {
    margin-top: 20px;
    padding: 10px;
    background-color: #107a35;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.contact-form button:hover {
    background-color: #0b6b2c;
}

footer {
    background: rgba(51, 51, 51, 0.8);
    color: #fff;
    text-align: center;
    padding: 20px 0;
    position: relative;
    width: 100%;
    margin-top: 50px;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
    align-items: center;
}

.footer-left {
    text-align: left;
    display: flex;
    align-items: center;
}

.footer-icon {
    width: 50px;
    height: 50px;
    margin-right: 15px;
}

.footer-right {
    text-align: right;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin: 5px 0;
    display: inline-block;
}

.footer-links li a {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    transition: background-color 0.3s;
}

.footer-links li a:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
}

.social-icons {
    margin-top: 10px;
}

.social-icons a {
    color: white;
    margin: 0 5px;
    font-size: 18px;
    text-decoration: none;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #333;
}

.footer-bottom {
    margin-top: 20px;
}
</style>
<body>
    <header>
        <div class="logo">
            <a href="#">
                <img src="Apple Music Icon34.png" alt="Logo" />
            </a>
            <h3>Spotify+</h3>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li class="divider">|</li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main class="main-content">
        <section class="contact">
            <h1>Contact Us</h1>
            <div class="contact-container">
                <div class="contact-info">
                    <h2>Need Help?</h2>
                    <p>Message us:</p>
                    <p><strong>Phone:</strong> +19 9682638970</p>
                </div>
                <div class="contact-form">
                    <form id="contactForm">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" required>
                        
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                        
                        <button type="submit">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <img src="Apple Music Icon34.png" alt="Spotify+ Icon" class="footer-icon">
                <div>
                    <h3>Spotify+</h3>
                    <p>Your ultimate Naat shareef companion.</p>
                </div>
            </div>
            <div class="footer-right">
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="privacy.php">Privacy Policy</a></li>
                    
                </ul>
                <div class="social-icons">
                    <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Spotify+. All rights reserved.</p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const submitButton = form.querySelector('button');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form from submitting the traditional way

                // Disable the submit button to prevent multiple submissions
                submitButton.disabled = true;
                submitButton.textContent = 'Sending...';

                // Prepare data to send
                const formData = new FormData(form);

                // Send the form data using Fetch API
                fetch('send_contact.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(responseText => {
                    alert(responseText); // Display server response
                    // Reset form
                    form.reset();
                    submitButton.disabled = false;
                    submitButton.textContent = 'Send Message';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    submitButton.disabled = false;
                    submitButton.textContent = 'Send Message';
                });
            });
        });
    </script>
</body>
</html>
