<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isometric Grid with Circle Movement</title>
    <style>
        canvas {
            border: 1px solid black;
            display: block;
            margin: 0 auto;
            background-color: black;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
      
    </style>
</head>
<body>


    <canvas id="gridCanvas" width="1000" height="600"></canvas>
    <script>
        const characterSprite1 = new Image();
        characterSprite1.src = "uploads/boy.png";

        const characterSprite = new Image();
        characterSprite.src = "uploads/girl.png";

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
        let circlePosition = { x: 0, y: 0, name: "blue", source: characterSprite1}; // Circle's grid coordinates
        let circlePositionRed = { x: 2, y: 2, name: "red", source: characterSprite};
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
                    const { x, y } = isoToCanvas(col, row);
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
            const spriteWidth = 120 * (circlePosition.y / 5); // Width of the sprite
            const spriteHeight = 120 * (circlePosition.y / 5); // Height of the sprite

            // Draw the character sprite
            ctx.drawImage(circlePosition.source, x - spriteWidth / 2 , y + tileHeight / 4 - spriteHeight + 10, spriteWidth, spriteHeight);
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
        
        drawGrid();

        for (i = 0; i < circleArray.length; i ++) {
            drawCircle(circleArray[i]);
        }

    </script>
</body>
</html>
