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
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $receiver = mysqli_real_escape_string($conn, $_POST['receiver']);
    $user_id = $_SESSION['user_id'];
    
    $sql = "SELECT * FROM users WHERE user_name=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $receiver); // Use "i" for integer
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $receiver_id = htmlspecialchars($row['user_id']);
                        }   else {
                                        die("Receiver not found.");
                                    }
                }
   
    $stmt->close();
    
    
    echo($user_id);
    echo($receiver_id);
    echo($message);
    

        // Insert data into the database
        $sql = "INSERT INTO messages (user_id, receiver_id, message_content) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);


        $stmt->bind_param("iis", $user_id, $receiver_id, $message);
        $stmt->execute();
       
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
        }
    // Registration successful, redirect to the profile page or login page
    header("Location: card_profile.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);



}

// Close connection
mysqli_close($conn);
?>