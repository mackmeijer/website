<!DOCTYPE html>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login_page.php");
    exit();
}

$conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); }

//get profile info
    $user_name = htmlspecialchars($_SESSION['user_name']);
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM profile_info WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Use "i" for integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $toptext = htmlspecialchars($row['user_text1']);
                $bottomtext = htmlspecialchars($row['user_text2']);
                $user_theme = htmlspecialchars($row['user_theme']);
            }
        }

    $sql = "SELECT * FROM theme_info WHERE theme_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_theme); // Use "i" for integer
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $color_id_1 = htmlspecialchars($row["color_id_1"]);
    $color_id_2 = htmlspecialchars($row["color_id_2"]);
    $color_id_3 = htmlspecialchars($row["color_id_3"]);

//get wearing
$sql = "SELECT * FROM user_wearing WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Use "i" for integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $sql = "INSERT INTO user_wearing (user_id, item_id, item_group) VALUES ('$user_id', 1, 'skin'), ('$user_id', 2, 'eyes')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    $stmt->close();
}

$sql = "SELECT * FROM user_wearing WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Use "i" for integer
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    if ($result->num_rows > 1) {
            $items_id = [];
            $item_layer = [];
            $item_name = [];

            while( $row = $result->fetch_assoc()) {
                
                $item_id = $row['item_id'];
                $sql1 = "SELECT * FROM item_info WHERE item_id=?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("i", $item_id);   
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                $row = $result1->fetch_assoc();
                if ($result) {
                    if ($result1->num_rows > 0){
                        $items_id[] = $row['item_id'];
                        $items_layer[] = $row['item_layer'];
                        $items_name[] = $row['item_name'];
                    }
                    $stmt1->close();

                }

            }
            
        }
    }

    // Close the statement and connection
        $stmt->close();
        $conn->close();

function check_messages($user_id)
{
    $conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');
    $sql = "SELECT * FROM messages WHERE receiver_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Use "i" for integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        echo("you have " . $result->num_rows . " messages <br>");
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); 
                echo( "user '". get_user_name(htmlspecialchars($row['user_id']))  . "' sent you the following message: " . 
                  htmlspecialchars($row['message_content']));
                
                $sql = "SELECT message_id FROM messages WHERE receiver_id=? ORDER BY message_id ASC LIMIT 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $first_id = $row['message_id'];

                $sql_delete = "DELETE FROM messages WHERE message_id = ?";
                $stmt = $conn->prepare($sql_delete);
                $stmt->bind_param("i", $first_id);
                $stmt->execute();
                $stmt->close();
                }
            }

        }

        $conn->close();
}

function get_user_name($user_id)
{
    $conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');

    $sql = "SELECT * FROM users WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Use "i" for integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return htmlspecialchars($row['user_name']);
            }
        }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
     
}


?>

<script>
    // Function to toggle .show-phone class and save state in local storage
function toggleItem() {

    var container = document.querySelector('.container');
    container.classList.toggle('show-phone');
    
    // Save state to local storage
    var isPhoneVisible = container.classList.contains('show-phone');
    localStorage.setItem('phoneVisible', isPhoneVisible);
}

// Check local storage on page load
document.addEventListener('DOMContentLoaded', function() {
    var container = document.querySelector('.container');
    var isPhoneVisible = localStorage.getItem('phoneVisible') === 'true';
    
    // Apply .show-phone class if necessary
    if (isPhoneVisible) {
        container.classList.add('show-phone');
    }
});


 //toggle lashes

    
</script>


<html>
    <head>
    <link href='https://fonts.googleapis.com/css?family=Courier Prime' rel='stylesheet'>

        <style>

            .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: auto;
            }

            .container {
            display: grid;
            grid-template-columns: 300px 300px 300px;
            grid-template-rows: minmax(50px, 20%) 150px 150px 150px minmax(10px, 40%);
            gap: 0px 10px;
            grid-template-areas:
                ". . ."
                "canvas card phone"
                "canvas card phone"
                "canvas card phone"
                ". . footer";
            }

            .card {  
            display: grid;
            border: 5px solid <?php echo($color_id_1); ?> ;
            background: linear-gradient( <?php echo($color_id_2); ?> );
            grid-template-columns: 5% 90% 5%;
            grid-template-rows:  5% 30% 20% 20%  19%;
            gap: 5px 0px;
            grid-auto-flow: row;
            grid-template-areas:
                ". toptext ."
                ". image ."
                ". text1 ."
                ". text2 ."
                ". bag .";
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.3);
            grid-area: card;

            }

            .phone {  
            font-family: 'Courier Prime';font-size: 22px;
            display: grid;
            border: 5px solid black;
            background: linear-gradient( <?php echo($color_id_3); ?> );                 grid-area: phone;
            grid-template-columns: 5% 90% 5%;
            grid-template-rows:  5% 30% 20% 20%  19%;
            gap: 5px 0px;
            grid-auto-flow: row;
            grid-template-areas:
                ". toptext ."
                ". image ."
                ". check ."
                ". send ."
                ". bag .";
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.3);
            display: none;
            grid-area: phone;
            }
    

            .canvas {  

            font-family: 'Courier Prime';font-size: 22px;
            background: linear-gradient(9deg, rgba(84,217,158,1) 15%, rgba(53,138,176,1) 62%, rgba(158,208,230,1) 100%); 
            border: 5px solid <?php echo($color_id_1); ?> ;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.3);
            grid-area: canvas;
            }
    
            

            .container.show-phone .phone {
            display: block; /* Show item4 */
            }

            .bag {
                display: grid;
                border: 2px solid <?php echo($color_id_1); ?> ;
                padding: 10px;
                background: linear-gradient( <?php echo($color_id_2); ?> );
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
                grid-template-areas: "item1 item2 item3";
                grid-area: bag;

            }

            .item1, .item2, .item3 {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
                padding: 4px;
                width: 80%; /* Make it responsive */
                border: 2px solid <?php echo($color_id_1); ?> ;
            }

            .item1 { grid-area: item1; }
            .item2 { grid-area: item2; }
            .item3 { grid-area: item3; }

            .check, .send {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
                padding: 10px;
                width: 90%; /* Make it responsive */
            }

            .check { grid-area: check; 
                overflow-wrap: break-word; }
            .send { grid-area: send; }

            .image {
                image-rendering: pixelated;
                border: 2px solid <?php echo($color_id_1); ?>;

                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
                 grid-area: image; }

            .text1 { 
                border: 2px solid <?php echo($color_id_1); ?>;
                padding: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
                grid-area: text1; 
                overflow-wrap: break-word;}

            .text2 {
                border: 2px solid <?php echo($color_id_1); ?>;
                padding: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
                grid-area: text2;
                overflow-wrap: break-word; }

            .toptext { 
                padding: 3px;
                grid-area: toptext; }

            .hidden {
                display: none;
            }
        
            body{
                background-image: url('uploads/lillybg.jpg');
                background-color: rgb(230, 243, 255);
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }

            #rcorners1 {
            border-radius: 6px;  
            }

            img {
                border-radius: 6px;  

            }

            input[type=text] {
            width: 90%;
            padding: 12px 20px;
            border: 0;
            margin: 8px 0;
            outline: none;
            background: linear-gradient( <?php echo($color_id_3); ?> );                 grid-area: phone;
            }

            .layer0 {
                position: absolute;
                z-index:1;
            }

            .layer1 {
                position: absolute;
                z-index:2;
            }

            .layer2 {
                position: absolute;
                z-index:3;
            }

            .layer3 {
                position: absolute;
                z-index:4;
            }

            .layer4 {
                position: absolute;
                z-index:5;
            }

            .layer5 {
                position: absolute;
                z-index:6;
            }

            input[type=submit] {
            border: 0;
            background: linear-gradient( <?php echo($color_id_3); ?> );                 grid-area: phone;
            border-radius: 4px;
            }

            button[type=submit] {
            border: 0;
            background: linear-gradient( <?php echo($color_id_3); ?> );                    grid-area: phone;
            border-radius: 4px; 
            }
        </style>

    </head>

    <body>
        <!-- canvas -->

    <div class="container">
        <div class="canvas" id="rcorners1">
        <canvas>  </canvas>

        <script>  var color_id_1 = <?php echo json_encode($color_id_1); ?>; 
        var color_id_2 = <?php echo json_encode($color_id_2); ?>;        </script>

            <script src="canvas.js"> </script>
            <button onclick="addFood()">Add food</button>
            <script src="canvas.js"></script>
            
        </div>
        <!-- Card profile  -->
        <div class="card" id="rcorners1">
            <div class="toptext"> 
                <a href="card_profile_edit.php"> <?php echo($user_name); ?> </a>
                <img src='uploads/glam4.gif' width="25px" height="25px" style="float:right">
            </div>
            <div class="image" id="rcorners1">   
            <?php for ($i = 0; $i < count($items_name); $i++) {
                ?>
            <div class="item">
                <img src="uploads/poppetje/<?php echo $items_name[$i]; ?>.png" alt="<?php echo $image_name; ?>" width="260  px" height="135px" class='layer<?php echo $items_layer[$i];?>'>
            </div>
            <?php };?>  

         </div>
            <div class="text1" id="rcorners1"> <?php echo($toptext); ?> </div>
            <div class="text2" id="rcorners1"> <?php echo($bottomtext); ?> </div>
            <div class="bag" id="rcorners1">
                <div class="item1" id="rcorners1"><img id="tellie" src='uploads/tellie_uit.png' width="45px" height="45px" onclick="toggleItem(), toggleImage(); ">
           </div>
                <div class="item2" id="rcorners1"> 
                    
                <a href="test_field.php"> la plaza    </a>
                </div>

                <div class="item3" id="rcorners1">   <a href="closet.php"> CLOSET    </a>  </div>
            </div>
        </div>

        <div class="phone" id="rcorners1">
            <div class="toptext"> <?php echo($user_name); ?> 's phone </div>
            <div class="image">  </div>
            <div class="check" id="rcorners1">
                <form method="post" action="">
                    <button type="submit" name="check_messages">check messages</button>

                    <!-- check messages script-->
                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['check_messages'])) 
                        check_messages($user_id); ?>

                </form> 
            </div>


            <div class="send" id="rcorners1">   
                <form action="send_message.php" method="post">
                    <label for="name">text message: </label> <br>
                    <input type="text" id="receiver" name="receiver"  maxlength="25" placeholder='to:'> <br> 
                    <input type="text" id="message" name="message"  maxlength="80" placeholder='state message'> <br>             
                    <input type="submit" value="Send">
                </form>
            </div>
         </div>
    </div>


        


    </body>

</html>

