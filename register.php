<?php
// Start the session (if you want to maintain sessions, though it's not mandatory for registration)
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE user_email='$email'";
    $result_email = mysqli_query($conn, $check_email);

    // Check if username already exists
    $check_name = "SELECT * FROM users WHERE user_name='$name'";
    $result_name = mysqli_query($conn, $check_name);

    if (mysqli_num_rows($result_email) != 0) {
        echo "This email is already registered. Please try another one.";
    } elseif (mysqli_num_rows($result_name) != 0) {
        echo "This username is already registered. Please try another one.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO users (user_name, user_password, user_email) VALUES ('$name', '$hashed_password', '$email')";
        if (mysqli_query($conn, $sql)) {

            $sql = "SELECT * FROM users WHERE user_name=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $user_id = $row['user_id'];
                    $sql = "INSERT INTO profile_info (user_id) VALUES ('$user_id')";
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);
                }

            
            // Registration successful, redirect to the profile page or login page
            header("Location: login_page.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
}

// Close connection
mysqli_close($conn);
?>