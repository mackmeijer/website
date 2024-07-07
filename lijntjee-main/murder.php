<!DOCTYPE html>
<html>
    <head>
        <style>

            .text{
               position: right; 
            }

            .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: auto;
       
        
            }

            .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 250px;
            width: 250px;
            opacity: 0;
            transition: .5s ease;
            background-color: black ;
            border-radius: 4px;
        }

        .container:hover .overlay {
        opacity: 1;
      }

            .container {
            display: grid; 
            grid-auto-columns: 1fr; 
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr; 
            grid-template-rows: 1fr 1fr 1fr 1fr 1fr; 
            gap: 0px 100px; 
            grid-template-areas: 
                ". . area . ."
                ". pic11 pic12 pic13 ."
                ". pic21 pic22 pic23 ."
                'footer footer footer footer footer'; 
            }
            .pic11 { grid-area: pic11; }
            .pic12 { grid-area: pic12; }
            .pic13 { grid-area: pic13; }

            .pic21 { grid-area: pic21; }
            .pic22 { grid-area: pic22; }
            .pic23 { grid-area: pic23; }

            .area {
            display: grid; 
            grid-template-columns: 1fr 1fr 1fr; 
            grid-template-rows: 1fr 1fr 1fr; 
            gap: 0px 0px; 
            grid-template-areas: 
                ". pic3 ."
                ". . ."
                ". . pic4"; 
            grid-area: area; 
            }
            .pic3 { grid-area: pic3; }
            .pic4 { grid-area: pic4; }
            body{

                background-color: black;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }

            #rcorners1 {
            border-radius: 6px;  
            }

            h1 {
            text-align: top;
            font-size: 12px;
            font-family: serif;
            transform: scale(1, 1.5);
            color: white;

            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="pic11"> <img src='uploads/wtm2.png' width="250" height="250" id="rcorners1"> 
            <div class="overlay"> 
                <div class="text"> <h1 >  </h1>
                </div> 
            </div>
        </div>

    <div class="pic12"> <img src='uploads/wtm4.png' width="250" height="250" id="rcorners1"> </div>
    <div class="pic13"> <img src='uploads/wtm8.png'  width="250" height="250" id="rcorners1"> </div>

    <div class="pic21"> <img src='uploads/bloem2.png' width="250" height="250" id="rcorners1">  </div>
    <div class="pic22"> <img src='uploads/bloem4.png' width="250" height="250" id="rcorners1"> </div>
    <div class="pic23"> <img src='uploads/bloem8.png'  width="250" height="250" id="rcorners1"> </div>

    <div class="area">
        <div class="pic3"> <img src='uploads/header.png' width="100" height="150" id="rcorners1"> </div>
        <div class="pic4"> </div>
    </div>
   
    </div>
    

    </body>
       
    <div class='footer'>
        <h1> I just used some image <br> recognition techniques </br> Mostly gaussian </br> derivative kernel filters </br> People familiar  </br> with such techniques </br> might be surprised as </br> this doesnt like gaussian  </br> derivative filtering at all </br> its because i made </br> a mistake in my code </br> resulting in the following filters </br> which look way better </br> but are far </br> worse for image recognition </br> but aesthetika over function  </br> </br> </br> ee</h1>

    </div>
</html>