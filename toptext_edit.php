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
    $top_text = mysqli_real_escape_string($conn, $_POST['toptext']);
    $user_id = $_SESSION['user_id'];

        // Insert data into the database
        $sql = "UPDATE profile_info  SET user_text1='$top_text' WHERE user_id='$user_id'";
        if (mysqli_query($conn, $sql)) {
                    mysqli_close($conn);
                }
            // Registration successful, redirect to the profile page or login page
            header("Location: card_profile_edit.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        
    

}

// Close connection
mysqli_close($conn);
?>