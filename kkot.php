<!DOCTYPE html>
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
            grid-auto-columns: 1fr; 
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr; 
            grid-template-rows: 1fr 1fr 1fr 1fr 1fr; 
            gap: 7px 0px; 
            grid-template-areas: 
                ". . . area ."
                ". pic1 . . ."
                ". . . pic2 ."
                ". . . . ."
                'footer footer footer footer footer'; 
            }
            .pic1 { grid-area: pic1; }
            .pic2 { grid-area: pic2; }
            .area {
            display: grid; 
            grid-template-columns: 1fr 1fr 1fr; 
            grid-template-rows: 1fr 1fr 1fr; 
            gap: 0px 0px; 
            grid-template-areas: 
                ". . ."
                "pic3 . ."
                ". . pic4"; 
            grid-area: area; 
            }
            .pic3 { grid-area: pic3; }
            .pic4 { grid-area: pic4; }
            body{
                background-image: url('uploads/bloem18.png');
                background-color: rgba(122, 20, 180, 1);
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }

            #rcorners1 {
            border-radius: 6px;  
            }
        </style>
    </head>
    <body>
    <div class="container">
    <div class="pic1"> <img src='uploads/titties.jpeg' width="250" height="250" id="rcorners1">  </div>
    <div class="pic2"> <img src='uploads/emo.jpg' width="250" height="420" id="rcorners1"> </div>
    <div class="area">
        <div class="pic3"> <img src='uploads/bloem17.png' width="100" height="150" id="rcorners1"> </div>
        <div class="pic4"> </div>
    </div>
   
    </div>
    

    </body>
       
    <div class='footer'>
        <img src='uploads/drawing5.png' width="400" height="500" style="float:left">
        <img src='uploads/giffy.gif' width="250" height="250" style="float:right">

    </div>
</html>