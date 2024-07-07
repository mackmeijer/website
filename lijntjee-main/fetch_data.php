<!-- fetch_data.php -->

<?php
  // include header, connect to database
  require 'init.php';

  // check if user is logged in, if not rederict to index.php
  $_SESSION['user_id'] = "11";


  // fetch user data 
  $query1=mysqli_query($db_connection,'SELECT username, user_background, user_bio, int_1, int_2, int_3, int_4, int_5, is_admin FROM users WHERE id = "11"' );
  // $stmt = $db_connection->prepare('SELECT username, user_background, user_bio, int_1, int_2, int_3, int_4, int_5, is_admin FROM users WHERE id = "11"');
  // $stmt->execute();
  while($row=mysqli_fetch_array($query1)) {
  // $loginrow = mysql_fetch_assoc($row);
  // echo $loginrow('username');
  // while($row=$stmt->fetch()){ //for each result, do the following

    $username=$row['username'];
    $kleurid=$row['user_background'];
    $bio=$row['user_bio'];
    $int_1=$row['int_1'];
    $int_2=$row['int_2'];
    $int_3=$row['int_3'];
    $int_4=$row['int_4'];
    $int_5=$row['int_5'];
    $_SESSION["is_admin"]=$row['is_admin'];
    echo $username;
  }
  // store in session for when visiting profiles
  $_SESSION["username"] = $username;

  // give preset value in case of having no photo/text in database to show
  $int_img_1 = "images/standard.jpg"; $int_txt_1 = "interest not found :(";
  $int_img_2 = "images/standard.jpg"; $int_txt_2 = "interest not found :(";
  $int_img_3 = "images/standard.jpg"; $int_txt_3 = "interest not found :(";
  $int_img_4 = "images/standard.jpg"; $int_txt_4 = "interest not found :(";
  $int_img_5 = "images/standard.jpg"; $int_txt_5 = "interest not found :(";
  $img_1 = "images/standard.jpg"; $img_caption_1 = "";
  $img_2 = "images/standard.jpg"; $img_caption_2 = "";
  $img_3 = "images/standard.jpg"; $img_caption_3 = "";
  $img_4 = "images/standard.jpg"; $img_caption_4 = "";
  $img_5 = "images/standard.jpg"; $img_caption_5 = "";



  // // fetch background data
  // $stmt = $db_connection->prepare('SELECT frontcolor, backcolor FROM background WHERE colorid = :colorid');
  // $stmt->execute(['colorid' => $kleurid]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $front=$row['frontcolor'];
  //   $back=$row['backcolor'];
  
  // }

  // // fetch interests data
  // // 1
  // $stmt = $db_connection->prepare('SELECT int_img, int_txt FROM interests WHERE int_id = :int_id');
  // $stmt->execute(['int_id' => $int_1]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $int_img_1=$row['int_img'];
  //   $int_txt_1=$row['int_txt']; }

  // // 2
  // $stmt = $db_connection->prepare('SELECT int_img, int_txt FROM interests WHERE int_id = :int_id');
  // $stmt->execute(['int_id' => $int_2]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $int_img_2=$row['int_img'];
  //   $int_txt_2=$row['int_txt']; }

  // // 3
  // $stmt = $db_connection->prepare('SELECT int_img, int_txt FROM interests WHERE int_id = :int_id');
  // $stmt->execute(['int_id' => $int_3]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $int_img_3=$row['int_img'];
  //   $int_txt_3=$row['int_txt']; }

  // // 4
  // $stmt = $db_connection->prepare('SELECT int_img, int_txt FROM interests WHERE int_id = :int_id');
  // $stmt->execute(['int_id' => $int_4]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $int_img_4=$row['int_img'];
  //   $int_txt_4=$row['int_txt']; }

  // // 5
  // $stmt = $db_connection->prepare('SELECT int_img, int_txt FROM interests WHERE int_id = :int_id');
  // $stmt->execute(['int_id' => $int_5]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $int_img_5=$row['int_img'];
  //   $int_txt_5=$row['int_txt']; }

  // // fetch krabbels
  // $query=$db_connection->prepare('SELECT * FROM krabbel WHERE krabbel_receiver_id = :krabbel_receiver_id ORDER BY krabbel_date ASC');
  // $query->execute(['krabbel_receiver_id' => $_SESSION['user_id']]);
  // $rs=$query->fetchAll(PDO::FETCH_OBJ);

  // // create krabbel log
  // $chat='';
  // foreach ($rs as $krabbel_msg){
  // $chat .= '<div class="single-msg"> <ms>
  // <strong>'.$krabbel_msg->krabbel_poster.': </strong> </ms>'.$krabbel_msg->krabbel_msg.' 
  // <span>'.date('d-m-Y h:i a', strtotime($krabbel_msg->krabbel_date)).'</span>
  // </div>';
  // }

  // // fetch friends
  // $query=$db_connection->prepare('SELECT user_two FROM friends WHERE user_one = :user_one');
  // $query->execute(['user_one' => $_SESSION['user_id']]);
  // $rss=$query->fetchAll(PDO::FETCH_OBJ);

  // foreach($rss as $row){
  //   $id_inq = $row->user_two;
  //   $query=$db_connection->prepare('SELECT username FROM users WHERE id = :id');
  //   $query->execute(['id' => $id_inq]);
  //   while($rss=$query->fetch()){
  //     $name=$rss['username'];
  //   }
  // }

  // // fetch photo's
  // // 1
  // $stmt = $db_connection->prepare('SELECT file_name, caption FROM photo_1 WHERE id = :id');
  // $stmt->execute(['id' => $_SESSION['user_id']]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $img_1=$row['file_name'];
  //   $img_caption_1=$row['caption']; }

  // // 2
  // $stmt = $db_connection->prepare('SELECT file_name, caption FROM photo_2 WHERE id = :id');
  // $stmt->execute(['id' => $_SESSION['user_id']]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $img_2=$row['file_name']; 
  //   $img_caption_2=$row['caption'];}

  // // 3
  // $stmt = $db_connection->prepare('SELECT file_name, caption FROM photo_3 WHERE id = :id');
  // $stmt->execute(['id' => $_SESSION['user_id']]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $img_3=$row['file_name'];
  //   $img_caption_3=$row['caption']; }

  // // 4
  // $stmt = $db_connection->prepare('SELECT file_name, caption FROM photo_4 WHERE id = :id');
  // $stmt->execute(['id' => $_SESSION['user_id']]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $img_4=$row['file_name'];
  //   $img_caption_4=$row['caption']; }

  // // 5
  // $stmt = $db_connection->prepare('SELECT file_name, caption FROM photo_5 WHERE id = :id');
  // $stmt->execute(['id' => $_SESSION['user_id']]);
  // while($row=$stmt->fetch()){ //for each result, do the following
  //   $img_5=$row['file_name'];
  //   $img_caption_5=$row['caption']; }
?>