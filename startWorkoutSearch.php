<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "websys7";

// Create connection
try {
  $dbconn = new PDO('mysql:host=localhost;dbname=konami',$username,$password);
  $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}




  $err = Array();


  function search($o1,$dbconn) {
    $sql = 'SELECT * FROM activity WHERE LOWER(description) LIKE LOWER(\'%'. $o1 . '%\') ORDER BY description';
    $result = $dbconn->query($sql);
    echo '<br>';
    foreach($result as $row) {
      echo '<option value =' . $row['code'] .'>';

      echo $row['description'];
        echo '</option value>';


    }

  }

  try {
    if (isset($_POST['workout']) && $_POST['workout'] == 'Search') {
      $o1 = $_POST['op1'];
      $o2 = $_POST['op2'];
      if($o2 == 0) {
        $o2 = 30;
      }


      }

   
  }
  catch (PDOException $e) {
    echo $e->getMessage();
  }
?>

<!doctype html>
<html>
  <head>
    <title>Konami Grade Book</title>
    <link rel=stylesheet href="nutrition.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
  </head>
  <body>
    <h1>Search for activities: </h1>

    <div class="searchbox">
      
      <br>
      <form method="post" action="startWorkoutSearch.php" id="Search_Workout">
                <label for="duration">Duration of Activity (minutes): </label><br>
        <input type="text" name="op2" id="duration" value="<?php echo isset($_POST["op2"]) ? $_POST["op2"] : 30; ?>" /><br><br>
        
        <label for="search">Activity: </label><br>

        <input type="text" name="op1" id="search" value="<?php echo isset($_POST["op1"]) ? $_POST["op1"] : ''; ?>" />

        <input type="submit" name="workout" value="Search"/><br>
        <br/>
      </form>
          <div id= "selection"></div>
    </div>
<script type="text/javascript">  
      // notice the quotes around the ?php tag         
      var x="<?php echo 'Select dropdown arrow below to see search results for \''. $o1 . '\''; ?>";
        document.getElementById('selection').innerHTML = x;
    </script>

      <form action=""> 
  <select name="dropdown" onchange="showCustomer(this.value)">
    <option value="">Select a physical activity:</option>
      <?php

        if(isset($o1)) {

            search($o1,$dbconn);

        }


      ?>
  </select>
</form>

<br>


<div id="txtHint"></div>



<script>
function showCustomer(str) {
  var dur ="<?php echo $o2 ?>";

  var xhttp;  
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };

  xhttp.open("GET", "EndWorkoutSearch.php?q="+str+","+dur, true);
  xhttp.send();
}
</script>
  </body>

</html>



