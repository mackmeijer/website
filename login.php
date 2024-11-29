
<?php
// Database connection
session_start();
$conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = $_POST['password'];

    // Prepare and execute the query
    $sql = "SELECT * FROM users WHERE user_name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['user_password'])) {
                // Login successful, redirect to the profile page
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];

                header("Location: card_profile.php");
                exit();
            } else {
                echo "Invalid username or password. Please try again.";
            }
        } else {
            echo "Invalid username or password. Please try again.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>