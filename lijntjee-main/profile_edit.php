
<!DOCTYPE html>
<html>
<head>
  <title> Hii-FiVE - Profile </title>
  <style>
    p,
    label {
        font: 1rem 'Fira Sans', sans-serif;
    }

    input {
        margin: .4rem;
    }

    #rcorners1 {
      border-radius: 4px;  
    }

    h3 {
      color: <?php echo $front; ?>;
      text-shadow: -2px 0 black, 0 2px black, 1px 0 black, 0 -1px black;
      text-decoration: underline overline;
    }

    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }
  </style>
</head>

<body style="background-color: <?php echo $back; ?>; text-align:center">
  <?php echo "<h3> $username </h3> " ; ?>

  <h3> Bio (max 1000 characters) </h3> 
    <form name = "bioform" max="1000" action = "" method = "post" value = "<?php echo $bio; ?> " >
      <textarea  name="bionew"> </textarea>   
      <input type="submit" name="submitbio" value="edit bio">
    </form>

  <h3> select theme: </h3> 
    <form action="" method = "POST" >

    <div>
      <input type="radio"  name="theme" value="1" >
      <label for="pink">Pink</label>
    </div>

    <div>
      <input type="radio"  name="theme" value="2">
      <label for="blue">Blue</label>
    </div>

    <div>
      <input type="radio"  name="theme" value="3">
      <label for="eggplant">Eggplant</label>
    </div>

    <div>
      <input type="radio"  name="theme" value="4">
      <label for="apple">Apple</label>
    </div>

    <div>
      <input type="radio" name="theme" value="5">
      <label for="fire">Fire</label>
      <input type="submit" name="update" value="Change Theme">
    </div>
    </form>

  <h3> Upload your pictures </h3> 

  <form action="upload_one.php" method="post" enctype="multipart/form-data">
    First picture:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
  </form>

  <form name = "cap_1" max="30" action = "" method = "post" value = "" > <input type="text"  name="cap_1"> </input>   
    <input type="submit" name="submit_cap_1" value="edit caption">
  </form> 
    </br>

  <form action="upload_two.php" method="post" enctype="multipart/form-data">
    Second picture:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
  </form> 

  <form name = "cap_2" max="30" action = "" method = "post" value = "" > <input type="text"  name="cap_2"> </input>   
    <input type="submit" name="submit_cap_2" value="edit caption">
  </form>
    </br>

  <form action="upload_three.php" method="post" enctype="multipart/form-data">
    Third picture:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
  </form>

  <form name = "cap_3" max="30" action = "" method = "post" value = "" > <input type="text"  name="cap_3"> </input>    
    <input type="submit" name="submit_cap_3" value="edit caption">
  </form> 
    </br>

  <form action="upload_four.php" method="post" enctype="multipart/form-data">
    Fourth picture:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
  </form>

  <form name = "cap_4" max="30" action = "" method = "post" value = "" > <input type="text"  name="cap_4"> </input>      
    <input type="submit" name="submit_cap_4" value="edit caption">
  </form>
    </br>

  <form action="upload_five.php" method="post" enctype="multipart/form-data">
    Fifth picture:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
  </form> 

  <form name = "cap_5" max="30" action = "" method = "post" value = "" > <input type="text"  name="cap_5"> </input>    
    <input type="submit" name="submit_cap_5" value="edit caption">
  </form>
    </br>

  <h3> Interests </h3> 

  <form action="" method="post">
    <label for="int">#1</label>
      <select id="int_1" name="int_1">
      <option value="" selected disabled hidden> choose #1 hobby </option>
        <option value="1">doin' nothing</option>
        <option value="2">party</option>
        <option value="3">rave</option>
        <option value="4">drinking beer</option>
        <option value="5">smoking rolled cigarettes</option>
        <option value="6">acting artsy</option>
        <option value="7">being artsy</option>
        <option value="8">sniving culture</option>
        <option value="9">doing coke</option>
        <option value="10">dog</option>
        <option value="11">cat</option>
        <option value="12">studyingg</option>
        <option value="13">studio sessionn</option>
        <option value="14">sports</option>
        <option value="15">going crazy</option>
        <option value="16">marlboro red</option>
        <option value="17">marlboro gold</option>
        <option value="18">thrifting</option>
        <option value="19">taking care of your poo</option>
        <option value="20">trying out different hairstyles</option>
      </select>
    <input type="submit" name="int_1_submit" value="submit">
  </form>

  <form action="" method="post">
    <label for="int">#2</label>
    <select id="int_2" name="int_2">
        <option value="" selected disabled hidden> choose #2 hobby </option>
        <option value="1">doin' nothing</option>
        <option value="2">party</option>
        <option value="3">rave</option>
        <option value="4">drinking beer</option>
        <option value="5">smoking rolled cigarettes</option>
        <option value="6">acting artsy</option>
        <option value="7">being artsy</option>
        <option value="8">sniving culture</option>
        <option value="9">doing coke</option>
        <option value="10">dog</option>
        <option value="11">cat</option>
        <option value="12">studyingg</option>
        <option value="13">studio sessionn</option>
        <option value="14">sports</option>
        <option value="15">going crazy</option>
        <option value="16">marlboro red</option>
        <option value="17">marlboro gold</option>
        <option value="18">thrifting</option>
        <option value="19">taking care of your poo</option>
        <option value="20">trying out different hairstyles</option>
      </select>
    <input type="submit" name="int_2_submit" value="submit">
  </form>

  <form action="" method="post">
    <label for="int">#3</label>
    <select id="int_3" name="int_3">
        <option value="" selected disabled hidden> choose #3 hobby </option>
        <option value="1">doin' nothing</option>
        <option value="2">party</option>
        <option value="3">rave</option>
        <option value="4">drinking beer</option>
        <option value="5">smoking rolled cigarettes</option>
        <option value="6">acting artsy</option>
        <option value="7">being artsy</option>
        <option value="8">sniving culture</option>
        <option value="9">doing coke</option>
        <option value="10">dog</option>
        <option value="11">cat</option>
        <option value="12">studyingg</option>
        <option value="13">studio sessionn</option>
        <option value="14">sports</option>
        <option value="15">going crazy</option>
        <option value="16">marlboro red</option>
        <option value="17">marlboro gold</option>
        <option value="18">thrifting</option>
        <option value="19">taking care of your poo</option>
        <option value="20">trying out different hairstyles</option>
      </select>
    <input type="submit" name="int_3_submit" value="submit">
  </form>

  <form action="" method="post">
    <label for="int">#4</label>
    <select id="int_4" name="int_4">
        <option value="" selected disabled hidden> choose #4 hobby </option>
        <option value="1">doin' nothing</option>
        <option value="2">party</option>
        <option value="3">rave</option>
        <option value="4">drinking beer</option>
        <option value="5">smoking rolled cigarettes</option>
        <option value="6">acting artsy</option>
        <option value="7">being artsy</option>
        <option value="8">sniving culture</option>
        <option value="9">doing coke</option>
        <option value="10">dog</option>
        <option value="11">cat</option>
        <option value="12">studyingg</option>
        <option value="13">studio sessionn</option>
        <option value="14">sports</option>
        <option value="15">going crazy</option>
        <option value="16">marlboro red</option>
        <option value="17">marlboro gold</option>
        <option value="18">thrifting</option>
        <option value="19">taking care of your poo</option>
        <option value="20">trying out different hairstyles</option>
      </select>
    <input type="submit" name="int_4_submit" value="submit">
  </form>

  <form action="" method="post">
    <label for="int">#5</label>
      <select id="int_5" name="int_5">
        <option value="" selected disabled hidden> choose #5 hobby </option>
        <option value="1">doin' nothing</option>
        <option value="2">party</option>
        <option value="3">rave</option>
        <option value="4">drinking beer</option>
        <option value="5">smoking rolled cigarettes</option>
        <option value="6">acting artsy</option>
        <option value="7">being artsy</option>
        <option value="8">sniving culture</option>
        <option value="9">doing coke</option>
        <option value="10">dog</option>
        <option value="11">cat</option>
        <option value="12">studyingg</option>
        <option value="13">studio sessionn</option>
        <option value="14">sports</option>
        <option value="15">going crazy</option>
        <option value="16">marlboro red</option>
        <option value="17">marlboro gold</option>
        <option value="18">thrifting</option>
        <option value="19">taking care of your poo</option>
        <option value="20">trying out different hairstyles</option>
      </select>
    <input type="submit" name="int_5_submit" value="submit">
  </form>

  <h3> Security </h3> 
    <p> Your account is currently: <?php echo $privacy_status; ?> </p>
    <form action="" method="post">
      <label> Lock your account for people who you don't follow: </label>
      <select id="private" name="private">
        <option value="1"> Locked account </option>
        <option value="0" selected> Open account </option>
      </select>
      <input type="submit" name="private_submit" value="submit">
    </form> </br> </br>

    <p> Delete your account by typing 'DELETE_ACCOUNT' in the following form and hitting submit </p>
      <form name = "delete" max="30" action = "" method = "post" value = "" > <input type="text"  name="delete"> </input>   
      <input type="submit" name="submit_delete" value="delete your account">
      </form> 
        </br>
          </br> 
            </br> 
              </br>
                  </br> 
</body>
</html>

