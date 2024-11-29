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
    $stmt->close();

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
                display: grid;
            grid-template-columns: 300px 300px 300px;
            grid-template-rows: minmax(50px, 20%) 150px 150px 150px minmax(10px, 40%);
            gap: 0px 10px;
            grid-template-areas:
                ". . ."
                "closet1 card closet2"
                "closet1 card closet2"
                "closet1 card closet2"
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

            .closet1   {  
            display: grid;
            border: 5px solid <?php echo($color_id_1); ?> ;
            background: linear-gradient( <?php echo($color_id_2); ?> );
            grid-template-columns: 5% 90% 5%;
            grid-template-rows:  5% 30% 25% 25% 9%;
            gap: 5px 0px;
            grid-auto-flow: row;
            grid-template-areas:
                ". toptext ."
                ". text ."
                ". text1 ."
                ". text2 ."
                ". bag .";
            grid-area: closet1;
            }

            .closet2   {  
            display: grid;
            border: 5px solid <?php echo($color_id_1); ?> ;
            background: linear-gradient( <?php echo($color_id_2); ?> );
            grid-template-columns: 5% 90% 5%;
            grid-template-rows:  5% 30% 25% 25% 9%;
            gap: 5px 0px;
            grid-auto-flow: row;
            grid-template-areas:
                ". toptext ."
                ". text ."
                ". text1 ."
                ". text2 ."
                ". bag .";
            grid-area: closet2;
            }

            img {
                border-radius: 6px;  

            }

            .image { grid-area: image; 
                border-radius: 4px;

                image-rendering: pixelated;}

            .text { 
                border: 2px solid <?php echo($color_id_1); ?> ;
                width: 90%;
                padding: 10px;
                grid-area: text; }

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
            <div class="image"> 
            <div class="image"> 
            <?php for ($i = 0; $i < count($items_name); $i++) {
                ?>
            <div class="item">
                <img src="uploads/poppetje/<?php echo $items_name[$i]; ?>.png" alt="<?php echo $image_name; ?>" width="260  px" height="135px" class='layer<?php echo $items_layer[$i];?>'>
            </div>
            <?php };?>  
           

         </div>        
        </div>

            <div class="text1" id="rcorners1">
               
            </div>
             
            <div class="text2" id="rcorners1"> 
              
            </div>

            <div class="text3" id="rcorners1"> 

            </div>

        </div>


        <div class="closet1" id="rcorners1">
            <div class="toptext">  
                <a href="card_profile.php"> <?php echo($user_name); ?> </a>
            </div>
            <div class="text" id="rcorners1">  

            <form action="item.php" method="POST">
                
                <label>
                    <input type="radio" name="hair_type" value="black_spikey" required>
                    Black spikey
                </label><br>

                <label>
                    <input type="radio" name="hair_type" value="blonde_spikey">
                    Blonde spikey
                </label><br>
                
                <label>
                    <input type="radio" name="hair_type" value="blonde_long">
                    Blonde long
                </label><br>

                <!-- Hidden inputs for multiple values for each selection -->
                <input type="hidden" name="values_black_spikey[]" value="14">
                <input type="hidden" name="values_black_spikey[]" value="4">
                <input type="hidden" name="values_black_spikey[]" value="6">

                <input type="hidden" name="values_blonde_spikey[]" value="14">
                <input type="hidden" name="values_blonde_spikey[]" value="5">
                <input type="hidden" name="values_blonde_spikey[]" value="7">

                <input type="hidden" name="values_blonde_long[]" value="8">
                <input type="hidden" name="values_blonde_long[]" value="9">
                <input type="hidden" name="values_blonde_long[]" value="5">

                <button type="submit">Submit</button>
            </form>

            </div>

            <div class="text1" id="rcorners1">

                <form action="cap.php" method="POST">
                
                <label>
                    <input type="radio" name="cap_type" value="gray" required>
                    gray
                </label><br>

                <label>
                    <input type="radio" name="cap_type" value="red">
                    red
                </label><br>
                
                <label>
                    <input type="radio" name="cap_type" value="pink">
                    pink
                </label><br>

                <label>
                    <input type="radio" name="cap_type" value="green">
                    green
                </label><br>

                <!-- Hidden inputs for multiple values for each selection -->
                <input type="hidden" name="values_gray_cap[]" value="10">


                <input type="hidden" name="values_red_cap[]" value="13">

                <input type="hidden" name="values_pink_cap[]" value="11">

                <input type="hidden" name="values_green_cap[]" value="12">
                
                <button type="submit">choose cap</button>

            </form>

            </div>
             
            <div class="text2" id="rcorners1"> 
              
            <form action="background.php" method="POST">
                
                <label>
                    <input type="radio" name="bg" value="green" required>
                    green
                </label><br>

                <label>
                    <input type="radio" name="bg" value="cow">
                    cow
                </label><br>
                
                <label>
                    <input type="radio" name="bg" value="heart">
                    heart
                </label><br>

                <label>
                    <input type="radio" name="bg" value="skull">
                    skull
                </label><br>

                <!-- Hidden inputs for multiple values for each selection -->
                <input type="hidden" name="values_green[]" value="15">

                <input type="hidden" name="values_cow[]" value="16">

                <input type="hidden" name="values_heart[]" value="17">

                <input type="hidden" name="values_skull[]" value="18">
                
                <button type="submit">choose background</button>

            </form>

            </div>

            <div class="text3" id="rcorners1"> 

            </div>

        </div>


        <div class="closet2" id="rcorners1">
            <div class="toptext">  
                <a href="card_profile.php"> <?php echo($user_name); ?> </a>
            </div>
            <div class="text" id="rcorners1">  </div>

            <div class="text1" id="rcorners1">
               
            </div>
             
            <div class="text2" id="rcorners1"> 
              
            </div>

            <div class="text3" id="rcorners1"> 

            </div>

        </div>
    </div>

    </body>
        
</html>

