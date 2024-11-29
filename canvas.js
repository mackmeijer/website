var canvas = document.querySelector('canvas');
canvas.width = 291;
canvas.height = 441;

var c = canvas.getContext('2d');
var roog = canvas.getContext('2d');
var loog = canvas.getContext('2d');
roog.globalCompositeOperation='destination-over';
loog.globalCompositeOperation='destination-over';

var mouse = {
    x: undefined, 
    y: undefined
}

canvas.addEventListener('mousemove', (event) => {
    const rect = canvas.getBoundingClientRect();
    
    mouse.x = event.clientX - rect.left;
    mouse.y = event.clientY - rect.top;

});

function getDistance(x1, y1, x2, y2){
    let xDistance = x2 - x1;
    let yDistance = y2 - y1;
    return Math.sqrt(Math.pow(xDistance, 2) + Math.pow(yDistance, 2))
}

function Circle(x, y, dx, dy, radius) {
    this.x = x;
    this.y = y;
    this.dx = dx;
    this.dy = dy;
    this.smoothDx = dx;
    this.smoothDy = dy;
    this.radius = radius;
    this.rate = undefined;
    this.draw = function() {
        c.beginPath();
        c.arc(this.x, this.y, this.radius, 0, 2 * Math.PI, false);
        c.strokeStyle = color_id_1;
        c.fillStyle = color_id_1;
        c.fill();
        c.stroke(); 
    }

    this.update = function() {
        if (this.x + this.radius > canvas.width || this.x - this.radius < 0) {
            this.dx = -this.dx; 
        }
    
        if (this.y + this.radius > canvas.height || this.y - this.radius < 0) {
            this.dy = -this.dy; 
        }

    this.foodConsumption = function() {for (var i = foodArray.length - 1; i >= 0; i--) {
            if (getDistance(foodArray[i].x, foodArray[i].y, this.x, this.y) < this.radius / 2) {
                this.radius += 1;
                foodArray.splice(i, 1);      }
        }
    }
    
    this.foodDetection = function() { for (var i = foodArray.length - 1; i >= 0; i--) {
        if (this.radius > 60) {
            this.rate = 183.34 - 6.90*this.radius + 0.1*this.radius**2 - 0.0005*this.radius**3;
        }
        else if (this.radius <= 60) {
            this.rate = -1.2*this.radius  + 100;
        }

        if (getDistance(foodArray[i].x, foodArray[i].y, this.x, this.y) < this.rate) {
            this.dx = (foodArray[i].x - this.x) * 0.05;
            this.dy = (foodArray[i].y - this.y) * 0.05;
            this.x += this.dx;
            this.y += this.dy;
            this.draw();
            return;
    }
    }
}       

        if (getDistance(mouse.x, mouse.y, this.x, this.y) < 50) {

            this.dx = (mouse.x - this.x) * 0.05;
            this.dy = (mouse.y - this.y) * 0.05;    
            this.x += this.dx;
            this.y += this.dy;

        } 

        else {
        this.x += this.dx;
        this.y += this.dy;
        
        this.dx += (Math.random() - 0.5) * 0.2;
        this.dy += (Math.random() - 0.5) * 0.2;
        this.dx *= 0.98; // Gradual reduction of speed
        this.dy *= 0.98;
        } 

        if (Math.abs(this.dx) > 1) {
            this.posx = -this.posx;
            this.dx *= 0.8; // Reduce speed to avoid abrupt changes
        }
        
        if (Math.abs(this.dy) > 1) {
            this.posy = -this.posy;
            this.dy *= 0.8;
        }

        this.foodDetection();
        if (foodArray.length > 0) {
            this.foodDetection(); }
        this.foodConsumption();

        this.smoothDx = this.smoothDx * 0.9 + this.dx * 0.1; // Weighted average for dx
        this.smoothDy = this.smoothDy * 0.9 + this.dy * 0.1; // Weighted average for dy
        
        // Calculate the angle for the "forward" direction
        let angle = Math.atan2(this.smoothDy, this.smoothDx);
        

        // Calculate the position of the right eye
        let rightAngle = angle  + Math.PI / 2 - Math.PI / 5
        this.roogx = this.radius * Math.cos(rightAngle);
        this.roogy = this.radius * Math.sin(rightAngle);
        
        // Draw the right eye
        roog.beginPath();
        roog.arc(this.roogx + this.x, this.roogy + this.y, this.radius/10, 0, 2* Math.PI, false);
        roog.strokeStyle = "black";
        roog.fillStyle = "black";

        roog.fill();
        roog.stroke();
        
        // Calculate the position of the left eye (opposite side)
        let leftAngle = angle - Math.PI / 5;
        this.loogx = this.radius * Math.cos(leftAngle);
        this.loogy = this.radius * Math.sin(leftAngle);
        
        // Draw the left eye
        loog.beginPath();
        loog.arc(this.loogx + this.x, this.loogy + this.y, this.radius/10, 0, 2* Math.PI, false);
        loog.strokeStyle = "black";
        loog.fillStyle = "black";
        loog.fill();
        loog.stroke();
 

        this.draw(); 
    }
}

function Food(x, y){
    this.x = x;
    this.y = y;

    this.draw = function() {
        var circle = new Circle(200, 200)
        c.beginPath();
        c.arc(this.x, this.y, 5, 0,  Math.PI * 2 , false);
        c.strokeStyle = color_id_1;
        c.lineWidth = 4;
        c.fillStyle = "rgba(255, 0, 0, 0)";
        c.fill();
        c.stroke(); 
    }   
}

function Tail(x, y, dx, dy, radius, i) {
    this.x = x;
    this.y = y;
    this.dx = dx;
    this.dy = dy;
    this.radius = radius;

    this.draw = function() {
        var circle = new Circle(200, 200)
        c.beginPath();
        c.arc(this.x, this.y, this.radius, 0, 2 * Math.PI, false);
        c.strokeStyle = color_id_1;
        c.fillStyle = color_id_1;
        c.fill();
        c.stroke(); 
    }

    this.update = function() {
        this.radius = circleArray[i].radius / 2;
        if (getDistance(circleArray[i].x, circleArray[i].y, this.x, this.y) >= 1.5 * circleArray[i].radius) {
            this.dx = (circleArray[i].x - this.x) * 0.05;
            this.dy = (circleArray[i].y - this.y) * 0.05;
            this.x += this.dx;
            this.y += this.dy;
            this.draw();
            return;
        } 
        this.x += 0.01;
        this.y += 0.01;
        this.draw();
    }
}

function Tail2(x, y, dx, dy, radius, i) {
    this.x = x;
    this.y = y;
    this.dx = dx;
    this.dy = dy;
    this.radius = radius;

    this.draw = function() {
        var circle = new Circle(200, 200)
        c.beginPath();
        c.arc(this.x, this.y, this.radius, 0, 2 * Math.PI, false);
        c.strokeStyle = color_id_1;
        c.fillStyle = color_id_1;
        c.fill();
        c.stroke(); 
    }

    this.update = function() {
        this.radius = tailArray[i].radius / 2;
        if (getDistance(tailArray[i].x, tailArray[i].y, this.x, this.y) >= 1.5 * tailArray[i].radius) {
            this.dx = (tailArray[i].x - this.x) * 0.05;
            this.dy = (tailArray[i].y - this.y) * 0.05;
            this.x += this.dx;
            this.y += this.dy;
            this.draw();
            return;
        } 
        this.x += 0.01;
        this.y += 0.01;
        this.draw();
    }
}

var circleArray = [];
var tailArray = [];
var tail2Array = [];
var foodArray = [];

for (var i = 0; i < 1  ; i++) {
    var radius = 5;
    var x = Math.random() * (canvas.width - 2 * radius) + radius;
    var y = Math.random() * (canvas.height - 2 *  radius) + radius;
    var dx = (Math.random() - 0.5) * 1;
    var dy = (Math.random() - 0.5) * 1;
    circleArray.push(new Circle(x, y, dx, dy, radius)   ); 
}

for (var i = 0; i < circleArray.length; i++) {
    var radius = circleArray[i].radius / 2;
    var x = circleArray[i].x - circleArray[i].radius;
    var y = circleArray[i].y - circleArray[i].radius;
    var dx = circleArray[i].dx;
    var dy = circleArray[i].dx;
    tailArray.push(new Tail(x, y, dx, dy, radius, i)); 
}

for (var i = 0; i < circleArray.length; i++) {
    var radius = tailArray[i].radius / 2;
    var x = tailArray[i].x - tailArray[i].radius;
    var y = tailArray[i].y - tailArray[i].radius;
    var dx = tailArray[i].dx;
    var dy = tailArray[i].dx;
    tail2Array.push(new Tail2(x, y, dx, dy, radius, i)); 
}

function addFood() {
    if (foodArray.length < 10) {
    var x = Math.random() * (canvas.width - 2 * 10) + 10;
    var y = Math.random() * (canvas.height - 2 *  10) + 10;
    foodArray.push(new Food(x, y));
    }
}

function animate() {
    requestAnimationFrame(animate);
    
    // Clear the canvas before drawing the next frame
    c.clearRect(0, 0, canvas.width, canvas.height);

    for (var i = 0; i < circleArray.length; i++) {
        // console.log(circleArray[i].radius);
        circleArray[i].update();
        tailArray[i].update();
        tail2Array[i].update();
    }
    
    for (var i = 0; i < foodArray.length; i++){
        foodArray[i].draw();
    }

}

animate();