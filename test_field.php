<!DOCTYPE html>
<?php 
// for time being
$space_id = 1;

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

// log into space
    $sql = "INSERT INTO user_space (user_id, space_id) VALUES ('$user_id', '$space_id')";
    mysqli_query($conn, $sql);

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

// get active members

$sql = "SELECT * FROM user_space WHERE space_id=?";
$stmt = $conn->prepare($sql);   
$stmt->bind_param("i", $space_id); // Use "i" for integer
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($result) {
    $active_users = $row['user_id'];
}

$wear = get_user_wearing($user_id);
$items_id = $wear[0];
$items_layer = $wear[1];
$items_name = $wear[2];

//get wearing
function get_user_wearing($user_id) {
$conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!', 'website_data');

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
            $items_layer = [];
            $items_name = [];

            while( $row = $result->fetch_assoc()) {
                $item_0 = 0;
                $item_id = $row['item_id'];
                $sql1 = "SELECT * FROM item_info WHERE item_id=? AND item_layer!=?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("ii", $item_id, $item_0);   
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                $row = $result1->fetch_assoc();
                if ($result) {
                    if ($result1->num_rows > 0){
                        $items_id[] = $row['item_id'];
                        $items_layer[] = $row['item_layer'];
                        $items_name[] = $row['item_name'];                    } 
                    $stmt1->close();
                }

            }
            
        }
    }
    return[$items_id, $items_layer, $items_name];

    // Close the statement and connection
$stmt->close();
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
    // check if you're here
    setInterval(() => {
    fetch("/update-last-seen", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ userId: $user_id }), // Replace USER_ID with the current user's ID
    });
}, 5000);

function avatar(x, y) {
    const items = <?php echo json_encode($items_name); ?>; // Array of image names
    console.log(items);
    const width = 260;
    const height = 135;
    let combinedImage = undefined;
    const combinedCanvas = document.createElement("canvas");
    const combinedCtx = combinedCanvas.getContext("2d");

    combinedCanvas.width = width;
    combinedCanvas.height = height;

    let loadedImages = 0;

    // Load images and draw them to the combined canvas
    items.forEach((item, index) => {
        const img = new Image();
        
        img.src = `uploads/poppetje/${item}.png`;
        img.onload = () => {
            combinedCtx.drawImage(img, 0, 0, width, height);
            loadedImages++;
            if (loadedImages === items.length) {
                // Once all images are loaded, export the combined image
                combinedImage = new Image();
                combinedImage.src = combinedCanvas.toDataURL();
                // Use the combined image in your draw function
                
                ctx.drawImage(combinedImage, x, y, width, height);
            }
        };
    });
    }
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
            grid-template-columns: 300px 1210px 300px;
            grid-template-rows: minmax(50px, 20%) 150px 400px 150px minmax(10px, 40%);
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
                display: none;
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
    <a href="card_profile.php"> <?php echo($user_name); ?> </a>

    <body>
        <!-- canvas -->

    <div class="container">
        
        <!-- Card profile  -->
        <div class="card" id="rcorners1">
            
    <canvas id="gridCanvas" width="1200" height="700"></canvas>
    <script>
        const characterSprite1 = new Image();
        characterSprite1.src = "uploads/combined_image.png";

        const characterSprite = new Image();
        characterSprite.src = "uploads/tellie_aan.png";

        const canvas = document.getElementById("gridCanvas");
        const ctx = canvas.getContext("2d");
        const ctxr = canvas.getContext("2d");

        // Grid parameters
        const tileWidth = 120;
        const tileHeight = 50;
        const gridRows = 10;
        const gridCols = 10;
        var selected_circle = undefined; 
        const circleArray = [];
        let circlePosition = { x: 3, y: 3, name: "blue", source: characterSprite1}; // Circle's grid coordinates
        let circlePositionRed = { x: 6, y: 6, name: "red", source: characterSprite};
        circleArray.push(circlePosition, circlePositionRed);

        // Convert isometric grid coordinates to canvas coordinates
        function isoToCanvas(ix, iy) {
            const cx = (ix - iy) * (tileWidth / 2) + canvas.width / 2;
            const cy = (ix + iy) * (tileHeight / 2);
            return { x: cx, y: cy };
        }

        // Convert canvas coordinates to isometric grid coordinates
        function canvasToIso(cx, cy) {
            const ix = Math.floor(((cx - canvas.width / 2) / (tileWidth / 2) + cy / (tileHeight / 2)) / 2);
            const iy = Math.floor(((cy / (tileHeight / 2)) - (cx - canvas.width / 2) / (tileWidth / 2)) / 2);
            return { x: ix, y: iy };
        }

        // Draw the isometric grid
        function drawGrid() {
            ctx.clearRect(1, 1, canvas.width, canvas.height);
            ctx.strokeStyle = "#ccc";

            for (let row = 0; row < gridRows; row++) {
                for (let col = 0; col < gridCols; col++) {
                    const { x, y } = isoToCanvas(col + 3, row + 3);
                    drawTile(x, y);
                }
            }
        }

        // Draw a single isometric tile
        function drawTile(x, y) {
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.lineTo(x + tileWidth / 2, y + tileHeight / 2);
            ctx.lineTo(x, y + tileHeight);
            ctx.lineTo(x - tileWidth / 2, y + tileHeight / 2);
            ctx.fillStyle = "purple";
            ctx.fill();
            ctx.closePath();
            ctx.stroke();
        }

        // Draw the circle
        function drawCircle(circlePosition) {
            this.circlePosition = circlePosition;
            const { x, y } = isoToCanvas(circlePosition.x, circlePosition.y);
            // ctx.fillStyle = circlePosition.name;
            // ctx.beginPath();
            // ctx.arc(x, y + tileHeight / 4, 20 , 0, Math.PI * 2); // Circle adjusted slightly for depth effect
            // ctx.fill();
            const spriteWidth = 200; // Width of the sprite
            const spriteHeight = 100; // Height of the sprite

            // Draw the character sprite
            avatar(x - spriteWidth / 2 - 30 , y + tileHeight / 4 - spriteHeight + 10);
        }

        // Handle click event
        canvas.addEventListener("click", (event) => {
        const rect = canvas.getBoundingClientRect();
        const mouseX = event.clientX - rect.left;
        const mouseY = event.clientY - rect.top;
        const gridPos = canvasToIso(mouseX, mouseY);

            if (selected_circle == undefined) {

                if (gridPos.x == circlePosition.x && gridPos.y == circlePosition.y) {
                    console.log("first checkpoint");

                    selected_circle = circlePosition.name;
                }

                if (gridPos.x == circlePositionRed.x && gridPos.y == circlePositionRed.y) {
                    console.log("first checskpoint");

                    selected_circle = circlePositionRed.name;

                }


            }

            else {

                if (selected_circle == circlePosition.name) {
                    // Snap circle to nearest isometric cell
                    circlePosition.x = gridPos.x;
                    circlePosition.y = gridPos.y;

                        // Redraw grid and circle
                        drawGrid();

                        circleArray.sort((a, b) => {
                            if (a.y === b.y) {
                                return a.x - b.x; // Sort by `x` if `y` values are equal
                            }
                            return a.y - b.y; // Sort by `y` otherwise
                        });
                        for (i = 0; i < circleArray.length; i ++) {
                        drawCircle(circleArray[i]);
                        }           
                        selected_circle = undefined;
                        console.log("third ");
                            }

                else if (selected_circle == circlePositionRed.name) {
                    // Snap circle to nearest isometric cell
                    circlePositionRed.x = gridPos.x;
                    circlePositionRed.y = gridPos.y;

                    // Redraw grid and circle
                    drawGrid();
                    circleArray.sort((a, b) => {
                            if (a.y === b.y) {
                                return a.x - b.x; // Sort by `x` if `y` values are equal
                            }
                            return a.y - b.y; // Sort by `y` otherwise
                        });       

                    for (i = 0; i < circleArray.length; i ++) {
                            drawCircle(circleArray[i]);
        }                   
                     selected_circle = undefined;
                    console.log("aaa ");
                        }
            }
        });


        // Initial draw
        combinedImage = avatar();

        drawGrid();
        for (i = 0; i < $active_members.length; i ++) {
            drawCircle(circleArray[i]);
        }

    </script>
            </div>
        </div>

       


          
         </div>
    </div>


        


    </body>

</html>

