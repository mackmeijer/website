<?php 
session_start();

$conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); }

    if (isset($_POST['bg'])) {
        $selected_option = $_POST['bg']; 
    
        if ($selected_option == 'green') {
            if (isset($_POST['values_green'])) {
                $selected_values = $_POST['values_green']; 

            }
        }
         if ($selected_option == 'cow') {
            if (isset($_POST['values_cow'])) {
                $selected_values = $_POST['values_cow']; 

            }
        }
            if ($selected_option == 'heart') {
                if (isset($_POST['values_heart'])) {
                    $selected_values = $_POST['values_heart']; 

                }

        } 

        if ($selected_option == 'skull') {
            if (isset($_POST['values_skull'])) {
                $selected_values = $_POST['values_skull']; 

            }

    } 
    }



    $user_name = htmlspecialchars($_SESSION['user_name']);
    $user_id = $_SESSION['user_id'];
    foreach ($selected_values as $value) {
        $sql = "SELECT * FROM item_info WHERE item_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $value); // Use "i" for integer
        $stmt->execute();
        $result = $stmt->get_result();  
        $row = $result->fetch_assoc();
        $item_group = $row['item_group'];

        $sql_delete = "DELETE FROM user_wearing WHERE user_id = ? AND item_group = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("is", $user_id, $item_group); // i for integer, s for string
        $stmt_delete->execute();

        $sql = "INSERT INTO user_wearing (user_id, item_id, item_group) VALUES ('$user_id', '$value', '$item_group')";
        mysqli_query($conn, $sql);
    }


    // Close the statement and connection
        $conn->close();  
              header("Location: closet.php"); ?>