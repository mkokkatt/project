<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="settings.css">
    <link rel="stylesheet" href="navbar.css">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title>Settings</title>
  </head>
  <body>
    <div class="topnav">
      <a class="active navleft" href="home.html">Konami Fitness</a>
      <ul class="navmid">
        <li><a href="startworkoutsearch.php">Fitness</a></li>
        <li><a href="startfoodsearch.php">Nutrition</a></li>
        <li><a href="login.php">Login/Sign Up</a></li>
        <li><a href="bmrbutton.php">Statistics</a></li>
        <li><a href="support.html">About Us</a></li>
      </ul>
      <button class="navright" type="button" name="button" onclick="window.location.href='usersettings.php'">
        <svg viewBox="0 0 100 80" width="40" height="40">
          <rect id="rect1" width="100" height="20" rx="8"></rect>
          <rect id="rect2" y="30" width="100" height="20" rx="8"></rect>
          <rect id="rect3" y="60" width="100" height="20" rx="8"></rect>
        </svg>
      </button>
    </div>
    <h1><?php if(isset($_SESSION['username'])) {
      echo "Logged in as " . $_SESSION['username'];
    } ?></h1>
    <?php

      $db_host = "localhost";
      $db_user = "root";
      $db_pass = "websys7";
      $db_name = "konami";
      $con = new mysqli($db_host, $db_user, $db_pass, $db_name);

      $userid = $_SESSION['userid'];
      if ( ! empty( $_POST ) ) {
        if ( $_POST['username']!='') {
          $username = $_POST['username'];
        }
        if ( $_POST['username']=='') {
          $username = $_SESSION['username'];
        }


        if ( $_POST['password']!='') {
          $password = $_POST['password'];
        }
        if ( $_POST['password']=='') {
          $password = $_SESSION['password'];
        }


        if ( $_POST['fname']!='') {
          $fname = $_POST['fname'];
        }
        if ( $_POST['fname']=='') {
          $fname = $_SESSION['fname'];
        }


        if ($_POST['lname']!='') {
          $lname = $_POST['lname'];
        }
        if ( $_POST['lname']=='') {
          $lname = $_SESSION['lname'];
        }


        if ( $_POST['age']!='') {
          $age = $_POST['age'];
        }
        if ( $_POST['age']=='') {
          $age = $_SESSION['age'];
        }


        if ( $_POST['height']!='') {
          $height = $_POST['height'];
        }
        if ( $_POST['height']=='') {
          $height = $_SESSION['height'];
        }


        if ( $_POST['weight']!='') {
          $weight = $_POST['weight'];
        }
        if ( $_POST['weight']=='') {
          $weight = $_SESSION['weight'];
        }


        if ( isset($_POST['gender'])) {
          $gender = $_POST['gender'];
          if ($gender == 'male') {
            $gendernum = 0;
          }
          if ($gender == 'female') {
            $gendernum = 1;
          }
          if ($gender == 'other') {
            $gendernum = 2;
          }
        }
        if ( !isset($_POST['gender'])) {
          $gendernum = $_SESSION['gendernum'];
        }


        if ( isset($_POST['heightunit'])) {
          $unit_h = $_POST['heightunit'];
          if ($unit_h == 'cm') {
            $heightunit = 0;
          }
          if ($unit_h == 'in') {
            $heightunit = 1;
          }
        }
        if ( !isset($_POST['heightunit'])) {
          $heightunit = $_SESSION['heightunit'];
        }

        if ( isset($_POST['weightunit'])) {
          $unit_w = $_POST['weightunit'];
          if ($unit_w == 'kg') {
            $weightunit = 0;
          }
          if ($unit_w == 'lbs') {
            $weightunit = 1;
          }
        }
        if ( !isset($_POST['weightunit'])) {
          $weightunit = $_SESSION['weightunit'];
        }

        if ( isset($_POST['goal'])) {
          $goalnum = $_POST['goal'];
          if ($goalnum == 'gain') {
            $goalnum = 0;
          }
          if ($goal == 'lose') {
            $goalnum = 1;
          }
          if ($goal == 'maintain') {
            $goalnum = 2;
          }
        }
        if ( !isset($_POST['goal'])) {
          $goalnum = $_SESSION['goalnum'];
        }

        $sql = "UPDATE users SET username = '".$username."', password = '".
        $password."', firstname = '".$fname."',lastname = '".$lname."', sex =
        ".$gendernum.",age = ".$age.",weight = ".$weight.",height = ".$height.
        ", heightbin = ".$heightunit.",weightbin = ".$weightunit."
        ,calorieplan = ".$goalnum." WHERE userid = ".$userid;

        // $result = $con -> query($sql);
        if ($con->query($sql) === TRUE) {
          echo "Settings updated successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }
        $con -> close();
      }
    ?>
    <div class="settingsbox">
      <p>Setting Page</p>
      <form action="usersettings.php" method="post" autocomplete="on">
        <input type="text" name="username" placeholder="Enter username" ></br>
        <input type="password" name="password" placeholder="Enter password" ></br>
        <input type="text" name="fname" placeholder="Enter first name" >
        <input type="text" name="lname" placeholder="Enter last name" ></br>
        <input type="number" name="age" placeholder="Age" ></br>

        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>
        <input type="radio" id="other" name="gender" value="other">
        <label for="other">Other</label></br>

        <input type="text" name="height" placeholder="Enter height">
        <input type="radio" id="cm" name="heightunit" value="cm">
        <label for="cm">cm</label>
        <input type="radio" id="in" name="heightunit" value="in">
        <label for="in">in</label></br>

        <input type="text" name="weight" placeholder="Enter weight">
        <input type="radio" id="kg" name="weightunit" value="kg">
        <label for="cm">kg</label>
        <input type="radio" id="lbs" name="weightunit" value="lbs">
        <label for="in">lbs</label></br>

        <p class="goal">Fitness Goal: </p>
        <input type="radio" id="gain" name="goal" value="gain">
        <label for="gain">Gain weight</label>
        <input type="radio" id="lose" name="goal" value="lose">
        <label for="lose">Lose weight</label>
        <input type="radio" id="maintain" name="goal" value="maintain">
        <label for="maintain">Maintain weight</label></br>

        <input type="submit" value="Submit">
      </form>
    </div>
    <div class="logoutbox">
      <form action="logout.php">
        <input type="submit" value="Logout">
      </form>
    </div>
  </body>
</html>
