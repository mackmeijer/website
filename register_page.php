<!DOCTYPE html>
<?php 
$conn = mysqli_connect('localhost', 'mack', 'Nakkiepep123!','website_data');
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// if ($result->num_rows > 0)  {
//     while ($row = $result-> fetch_assoc()) {
//     echo($row["user_name"]);  
    
// }
// }
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
            border: 5px solid rgb(204, 78, 137);
            background:linear-gradient(150deg, rgba(200,224,119,1) 0%, rgba(132,220,165,1) 77%, rgba(82,181,119,1) 100%); 
            grid-template-columns: 5% 90% 5%;
            grid-template-rows:  5% 30% 20% 20%  5%;
            gap: 5px 0px;
            grid-auto-flow: row;
            grid-template-areas:
                ". toptext ."
                ". text1 ."
                ". text1 ."
                ". text1 ."
                ". text1 .";
            grid-area: card;
            }

            .image { grid-area: image; }

            .text1 { 
                border: 2px solid rgb(204, 78, 137);

                padding: 10px;
                grid-area: text1; }

            .text2 {
                padding: 10px;
                border: 2px solid rgb(204, 78, 137);
                grid-area: text2; }

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
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid rgb(204, 78, 137);
            border-radius: 4px;
            background: linear-gradient(230deg, rgba(200,224,119,1) 0%, rgba(132,220,165,1) 87%, rgba(82,181,119,1) 100%);
            }

            input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid rgb(204, 78, 137);
            border-radius: 4px;
            background: linear-gradient(230deg, rgba(200,224,119,1) 0%, rgba(132,220,165,1) 87%, rgba(82,181,119,1) 100%);
            }

            input[type=submit] {
            border: 2px solid rgb(204, 78, 137);
            background: linear-gradient(230deg, rgba(200,224,119,1) 0%, rgba(132,220,165,1) 87%, rgba(82,181,119,1) 100%);   
            border-radius: 4px;
            }
        </style>

    </head>

    <body>



    <div class="container">
        <div class="card" id="rcorners1">
            <div class="toptext"> Registreren aub bb </div>
            <div class="text1" id="rcorners1">
            <form action="register.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" maxlength="20" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" maxlength="20" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" maxlength="50" required><br><br>
        <input type="submit" value="Register">

    </form>
            </div>
  

        <!-- <div>
            <div class="lower_image"> <img src='uploads/drawing5.png' width="400" height="500"> </div>
        </div> -->
    </div>

    </body>
        
    <div class='footer'>
        <!-- <img src='uploads/drawing5b.png' width="30%" height="10%" style="float:left"> -->
    </div>
</html>

