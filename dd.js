this.foodDetection();
if (foodArray.length > 0) {
    this.foodDetection(); }
this.foodConsumption();



let angle = Math.atan2(this.dy, this.dx); 

// Add π/2 to adjust the angle as needed
angle += Math.PI / 2;

// Calculate roogx and roogy using the adjusted angle
this.roogx = this.radius * Math.cos(angle);
this.roogy = this.radius * Math.sin(angle);

roog.beginPath();
roog.fillStyle = "black";
roog.fillRect(this.roogx + this.x ,this.roogy + this.y , 10, 10);

// Add π/2 to adjust the angle as needed
angle -= Math.PI;

// Calculate roogx and roogy using the adjusted angle
this.loogx = this.radius * Math.cos(angle);
this.loogy = this.radius * Math.sin(angle);
loog.beginPath();
loog.fillStyle = "black";
loog.fillRect(this.loogx + this.x ,this.loogy + this.y , 10, 10);

loog.stroke();
roog.stroke();

this.draw();
return;