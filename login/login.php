<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "apmsetup";
$dbname = "shopmall";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve image paths from the database
$imagePaths = array();
$sql = "SELECT path FROM images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $imagePaths[] = $row["path"];
    }
} else {
    echo "No images found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vintage Street Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <!-- Left side with image slideshow -->
        <div class="image-section">
            <img src="" alt="Vintage Street Style" class="background-image" id="slideshow" />
        </div>

        <!-- Right side with login form -->
        <div class="login-section">
            <h1 class="login-title">KIMGOON</h1>
            <form class="login-form">
                <label for="email" class="label">Email</label>
                <input type="email" id="email" class="input" required />

                <label for="password" class="label">Password</label>
                <input type="password" id="password" class="input" required />
                <br>
                <a href="#" class="sign-up-link">Sign Up</a>
                <br><br>

                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>

    <script>
        // Pass PHP array to JavaScript
        const images = <?php echo json_encode($imagePaths); ?>;

        let currentIndex = 0;

        function changeImage() {
            const slideshow = document.getElementById("slideshow");
            slideshow.src = images[currentIndex];
            currentIndex = (currentIndex + 1) % images.length;
        }

        // Change image every 5 seconds
        setInterval(changeImage, 5000);

        // Set initial image on page load
        window.onload = function () {
            if (images.length > 0) {
                changeImage();
            } else {
                console.log("No images found in the images array.");
            }
        };
    </script>
</body>
</html>
