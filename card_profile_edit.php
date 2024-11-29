<!DOCTYPE html>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login_page.php");
    exit();
}

$conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');

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

    // Close the statement and connection
        $stmt->close();
        $conn->close();
?>
<html>
    <head>
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
            grid-template-columns: minmax(10px, 40%) 300px minmax(10px, 40%);
            grid-template-rows: minmax(50px, 20%) 150px 150px 150px minmax(10px, 40%);
            gap: 0px 0px;
            grid-template-areas:
                ". . ."
                ". card ."
                ". card ."
                ". card ."
                "footer footer footer";
            }

            .card {  
            display: grid;
            border: 5px solid <?php echo($color_id_1); ?> ;
            background: linear-gradient( <?php echo($color_id_2); ?> );
            grid-template-columns: 5% 90% 5%;
            grid-template-rows:  5% 30% 25% 25% 9%;
            gap: 5px 0px;
            grid-auto-flow: row;
            grid-template-areas:
                ". toptext ."
                ". image ."
                ". text1 ."
                ". text2 ."
                ". bag .";
            grid-area: card;
            }



            .image { grid-area: image; }

            .text1 { 
                border: 2px solid <?php echo($color_id_1); ?> ;
                width: 90%;
                padding: 10px;
                grid-area: text1; }

            .text2 {
                padding: 10px;
                width: 90%;

                border: 2px solid <?php echo($color_id_1); ?> ;
                grid-area: text2; }

            .text3 {
                padding: 10px;
                width: 90%;
                border: 2px solid <?php echo($color_id_1); ?> ;
                grid-area: bag; }


            .toptext { 
                padding: 3px;
                grid-area: toptext; }



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

            input[type=text] {
            width: 90%;
            padding: 7px 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid <?php echo($color_id_1); ?> ;
            border-radius: 4px;
            background: linear-gradient( <?php echo($color_id_2); ?> );
            }


            input[type=submit] {
            border: 2px solid <?php echo($color_id_1); ?> ;
            background: linear-gradient( <?php echo($color_id_2); ?> );
            border-radius: 4px;
            }
        </style>

    </head>

    <body>



    <div class="container">
        <div class="card" id="rcorners1">
            <div class="toptext">  
                <a href="card_profile.php"> <?php echo($user_name); ?> </a>
            </div>
            <div class="image">  <img src='uploads/char_sky.jpeg'  width="100%" height="100%" padding = "30px" id="rcorners1" > </div>

            <div class="text1" id="rcorners1">
                <form action="toptext_edit.php" method="post">
                    <label for="name">Top Text: </label> <br>
                    <input type="text" id="toptext" name="toptext"  maxlength="100" value='<?php echo($toptext)?>'> <br> 
                    <input type="submit" value="Edit">
                </form>
            </div>

             
            <div class="text2" id="rcorners1"> 
                <form action="bottomtext_edit.php" method="post">
                    <label for="name">Bottom Text: </label> <br>
                    <input type="text" id="bottomtext" name="bottomtext"  maxlength="100" value='<?php echo($bottomtext)?>'> <br>             
                    <input type="submit" value="Edit">
                </form>
            </div>

            <div class="text3" id="rcorners1"> 
            <form action="theme_edit.php" method="post">
                    <label for="theme_id">Theme</label>
                    <select name="theme_id" id="theme_id">
                        <option value="1">Green Apple</option>
                        <option value="2">Red Apple </option>
                    </select>
                    <input type="submit" value="Edit" />
                </form>

            </div>

        </div>

    </div>

    </body>
        
</html>

