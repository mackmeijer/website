<!-- profile.php -->

<?php
include 'fetch_data.php';
  // fetch data, include php for handeling submits
$front = "rgba(80, 121, 167, 0.8)";
$back = "rgba(80, 121, 167, 0.8)";
$username = "WestXY";
$bio  = "Ben n XY uit West";
$img_caption_1 = "a";
$img_caption_2 = "dd";
$img_caption_3 = "ddd";
$img_caption_4 = "ddd";
$img_caption_5 = "ddd";
$img_1 = "img.JPG";
$img_2 = "img.JPG";
$img_3 = "img.JPG";
$img_4 = "img.JPG";
$img_5 = "img.JPG";

?>

<!DOCTYPE html>
<html>
<!-- <link rel="stylesheet" href="https://pyscript.net/latest/pyscript.css" />
<script defer src="https://pyscript.net/latest/pyscript.js"></script> -->

  <head>
    <title> Hii-FiVE - Profile </title>
    <style>

      .container2 {
        position: relative;
      }

      .container3 {
        position: relative;
      }

      .image {
        display: block;
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
        background-color: <?php echo $front; ?> ;
        border-radius: 4px;
      }

      .overlay_int {
        font-size: 80%;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 170px;
        width: 170px;
        opacity: 0;
        transition: .5s ease;
        background-color: <?php echo $back; ?> ;
        border-radius: 4px;
      }

      .container3:hover .overlay_int {
        opacity: 1;
      }

      .container2:hover .overlay {
        opacity: 1;
      }

      .text {
        color: white;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
      }

      .container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr ;
        grid-template-rows: 1fr 0.2fr 1fr 0.2fr 1fr 1fr 0.2fr 1fr;
        gap: 5px 5px;
        
        grid-template-areas:
          "pic pic pic pic pic"
          "name name name name name"
          "bio bio bio bio bio"
          "interests_title interests_title interests_title chat_title chat_title"
          "interests interests interests chat chat"
          "interests interests interests chat chat"
          "friend_title friend_title friend_title friend_title friend_title"
          "friend friend friend friend friend"  
      }

      .bio { grid-area: bio;
      background-color: <?php echo $front; ?> ;
      text-align: center;
      font-size: 20px;
      }

      .name { grid-area: name;
      background-color: <?php echo $front; ?> ;
      text-align: center;
      font-size: 20px;
      }

      .friend_title { grid-area: friend_title;
        background-color: <?php echo $front; ?> ;
      height: 60px;
      }

      .friend{ grid-area: friend;
      padding: 30px;
      background-color: <?php echo $front; ?> ;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      justify-content:space-evenly;
      }

      .pic { grid-area: pic;
      background-color: <?php echo $back; ?>;
      display: grid;
      padding: 30px;  
      align-items: right;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      }

      .chat { grid-area: chat;
      background-color: <?php echo $front; ?> ;
      }

      .chat_title{ grid-area: chat_title;
      background-color: <?php echo $front; ?> ;
      height: 60px;
      }

      .interests { grid-area: interests;
      background-color: <?php echo $front; ?> ;
      padding: 20px;
      display: grid;
      }

      .interests_title{ grid-area: interests_title;
      background-color: <?php echo $front; ?> ;
      height:60px;
      }

      #rcorners1 {
        border-radius: 4px;  
      }

      h1 {
        color: <?php echo $back; ?> ;
        text-shadow: -2px 0 black, 0 2px black, 1px 0 black, 0 -1px black;
        text-decoration: underline overline;
      }

      h2 {
        color: <?php echo $back; ?> ;
        text-shadow: -2px 0 black, 0 2px black, 1px 0 black, 0 -1px black;
        text-decoration: underline overline;
      }

      h3 {
        color: <?php echo $back; ?> ;
        text-shadow: -2px 0 black, 0 2px black, 1px 0 black, 0 -1px black;
        text-decoration: underline overline;
      }
      h4 {
        font-size: 140%;
        color: <?php echo $back; ?> ;
        text-shadow: -2px 0 black, 0 2px black, 1px 0 black, 0 -1px black;
      }

      body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
      }

      .textarea{
          background-color: <?php echo $front; ?>;
          width: 96%;
          height: 430px;
          border-bottom: 5px solid <?php echo $back; ?>;
          padding: 10px;
          border-top-left-radius: 4px;
          border-top-right-radius: 4px;
          overflow: scroll; 
      }

      .friend_area{
          background-color: <?php echo $front; ?>;
          width: 96%;
          height: 370px;
          border-style: dotted ;
          border-color: <?php echo $back; ?>;
          border-width: 5px;
          padding: 10px;
          border-radius: 4px;
          overflow: scroll;
      }

      .textarea::-webkit-scrollbar-track {
          background: <?php echo $front; ?>; 
          border-radius: 4px;
      }

      .single-msg{
          padding: 5px 0px 5px 0px;
          border-bottom: 1px solid <?php echo $back; ?>;
      }

      .single-msg span{
          float: right;
          font-size: 70%;
      }

      .single-msg ms{
          text-align: left;
      }

    </style>
  </head>

  <body style="background-color: <?php echo $back; ?> ;text-align:center">

    <div class="container">

      <div class="name" id="rcorners1"> 
        <?php echo "<h3> $username </h3> " ; ?> 
        <a href="profile_edit.php"> edit </a>   
      </div>

      <div class="bio" id="rcorners1">
        <h3> bio </h3> 
        <?php echo  $bio  ; ?> 
      </div>

      <div class="pic" id="rcorners1">

        <div class="container2">
          <img src=uploads/<?php echo $img_1 ?> width="250" height="250" class="image" id="rcorners1" alt="upload a pic here!"> 
          <div class="overlay"> 
            <div class="text">
              <?php echo $img_caption_1 ?>
            </div> 
          </div> 
        </div>

        <div class="container2">
          <img src=uploads/<?php echo $img_2 ?> width="250" height="250" class="image" id="rcorners1" alt="upload a pic here!"> 
          <div class="overlay"> 
            <div class="text">
              <?php echo $img_caption_2 ?>
            </div> 
          </div> 
        </div>

        <div class="container2">
          <img src=uploads/<?php echo $img_3 ?> width="250" height="250" class="image" id="rcorners1" alt="upload a pic here!"> 
          <div class="overlay"> 
            <div class="text">
              <?php echo $img_caption_3 ?>
            </div> 
          </div> 
        </div>

        <div class="container2">
          <img src=uploads/<?php echo $img_4 ?> width="250" height="250" class="image" id="rcorners1" alt="upload a pic here!"> 
          <div class="overlay"> 
            <div class="text">
              <?php echo $img_caption_4 ?>
            </div> 
          </div> 
        </div>
    
        <div class="container2">
          <img src=uploads/<?php echo $img_5 ?> width="250" height="250" class="image" id="rcorners1" alt="upload a pic here!"> 
          <div class="overlay"> 
            <div class="text">
              <?php echo $img_caption_5 ?>
            </div> 
          </div>  
        </div>

    </div>

    <div class="chat_title" id="rcorners1">
      <h1> Krabbel function</h1>
    </div>
    
    <!-- Box to leave messages for yourself -->
    <div class="chat" id="rcorners1">

      <div class="textarea">
        <?php echo $chat;?>
      </div>

      <p> leave a nice message for yourself :) </p>

      <form name = "krabbel_msg" action = "" method = "post" value = "" > 
        <input type="text" maxlength="50" size="80" name="krabbel_msg" style="border-radius: 4px"> </input> 
        <input type="submit" name="submit_krabbel" value="post">
      </form>

    </div>

    <div class="interests_title" id="rcorners1"> 
      <h1> friends </h1> 
    </div>

    <div class="interests" id="rcorners1"> 
      <p> Look for people here! search for their the exact username and click on the given link: </p>  
        <form name = "search_friend" action = "" method = "post" value = ""> 
          <input type="text" maxlength="20" size="20" name="search_friend" style="border-radius: 4px"> </input>   
          <input type="submit" name="search_friend_submit" value="search">
        </form>
          <?php
            // search for profile
            if(isset($_POST['search_friend_submit'])){
            $search_friend = $_POST['search_friend'];
            $search_friend = str_replace("<", "&lt;", $search_friend);
            $search_friend = str_replace(">", "&gt;", $search_friend);
            $stmt = $db_connection->prepare('SELECT id, username FROM users WHERE username=:username');
            $stmt->execute(['username' => $search_friend]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

              if( ! $row) {
                echo 'user does not exist';
                }

              //creates link to profile
              else {
              $visiting_username = $row['username'];
              $visiting_id = $row['id'];
              $_SESSION["visiting_id"] = $visiting_id;
              echo '<a href="profile_visit.php"> visit: '.$visiting_username.   '</a>'; 
                }
              }
          ?>

      <div class="friend_area">
        <h4> currently following: </h4>
          <?php
          //fetches every username user follows
          $query=$db_connection->prepare('SELECT user_two FROM friends WHERE user_one = :user_one');
          $query->execute(['user_one' => $_SESSION['user_id']]);
          $rss=$query->fetchAll(PDO::FETCH_OBJ);

          //prints usernames
          foreach($rss as $row){
            $id_inq = $row->user_two;
            $query=$db_connection->prepare('SELECT username FROM users WHERE id = :id');
            $query->execute(['id' => $id_inq]);
            while($rss=$query->fetch()){
              $name=$rss['username'];
              print '<div class="single-msg">' .$name. '</br> </div>';
            }
          }
          ?>
      </div>
    </div>

    <div class="friend_title" id="1rcorners1">
      <h2> interests </h2>
    </div>

    <div class="friend" id="1rcorners1"> 

    <div class="container3">
      <img src=<?php echo $int_img_1?> width="170" height="170" class="image" id="rcorners1" alt="pick an interest!"> 
        <div class="overlay_int"> 
          <div class="text" > 
            <?php echo $int_txt_1?>
          </div> 
       </div> 
    </div>

    <div class="container3">
      <img src=<?php echo $int_img_2?> width="170" height="170" class="image" id="rcorners1" alt="pick an interest!"> 
        <div class="overlay_int"> 
          <div class="text" > 
            <?php echo $int_txt_2?>
          </div> 
       </div> 
    </div>

    <div class="container3">
      <img src=<?php echo $int_img_3?> width="170" height="170" class="image" id="rcorners1" alt="pick an interest!"> 
        <div class="overlay_int"> 
          <div class="text" > 
            <?php echo $int_txt_3?>
          </div> 
       </div> 
    </div>

    <div class="container3">
      <img src=<?php echo $int_img_4?> width="170" height="170" class="image" id="rcorners1" alt="pick an interest!"> 
        <div class="overlay_int"> 
          <div class="text" > 
            <?php echo $int_txt_4?>
          </div> 
       </div> 
    </div>
   
    <div class="container3">
      <img src=<?php echo $int_img_5?> width="170" height="170" class="image" id="rcorners1" alt="pick an interest!"> 
        <div class="overlay_int"> 
          <div class="text" > 
            <?php echo $int_txt_5?>
          </div> 
       </div> 
    </div>

    </div>

 </div>

</body>
</html>
