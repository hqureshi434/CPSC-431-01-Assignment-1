<?php
  $photoName = (string) $_POST['photoName'];
  $photoDate = (string) $_POST['photoDate'];
  $photographer = (string) $_POST['photographer'];
  $location = preg_replace('/\t|\R/',' ',$_POST['location']);
  $fileToUpload = (string) $_FILES['fileToUpload']['name'];
  $date = date('H:i, jS F Y');
  ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>CPSC 431, Assignment 2</title>
  </head>
  <body>
    <div class="jumbotron text-center" style="padding: 50px; background-color: #778899; color: white;">
      <h1>Simple Photo Gallery</h1>
      <p>Created by Adam Laviguer and Hammad Qureshi</p>
    </div>

    
    <div class="container" style="margin-top: 25px;">
      <h3>View All Photos</h3>
      <div class="d-flex flex-row">
        <div style="padding-right: 10px;">
          <!-- Dropdown Menu for sorting -->
          <form action ="gallery.php" method = "post" >
            <div class="dropdown">
                <select class="form-control" id = "Sort" name = "Sort" onchange = this.form.submit();>
                  <option>Sort By</option>
                  <option value = "Name">Name</option>
                  <option value = "Date Action">Date action</option>
                  <option value = "Photographer">Photographer</option>
                  <option value = "Location">Location</option>
                </select>
            </div>
          </form>
        </div>
      <div style="padding-left: 10px;">
        <form action="./index.html" method="post" enctype="multipart/form-data">
          <button type="submit" class="btn btn-primary">Upload New Photo</button>
        </form>
      </div>
    </div>
  </div>

    <div class="container">
      <?php
        if(isset($_POST['submitBtn'])) {
          UploadPhoto();
          UploadData($photoName, $photoDate, $photographer, $location, $fileToUpload, $date);
          ArrayData();
        }

        function UploadData($photoName, $photoDate, $photographer, $location, $fileToUpload, $date) {
          @$db = new mysqli('mariadb', 'cs431s23', 'Va7Wobi9', 'cs431s23');

          // Check database connection
          if (mysqli_connect_errno()) {
            echo "<p>Error: Could not connect to database.<br/>
                  Please try again later.</p>";
            exit;
          }

          $query = "INSERT INTO Images VALUES (?, ?, ?, ?, ?)";
          $stmt = $db->prepare($query);
          $stmt->bind_param('sssss', $photoName, $photoDate, $photographer, $location, $fileToUpload);
          $stmt->execute();

          if ($stmt->affected_rows > 0) {
              echo  "<p>Image metadata inserted into the database.</p>";
          } else {
              echo "<p>An error has occurred.<br/>
              The image metadata was not added.</p>";
          }
          $db->close();     
        }

<<<<<<< HEAD
        function ArrayData() {
          $db = new mysqli('mariadb', 'cs431s23', 'Va7Wobi9', 'cs431s23');
          if (mysqli_connect_errno()) {
             echo '<p>Error: Could not connect to database.<br/>
             Please try again later.</p>';
             exit;
=======
          $array = [];
          //Print out the data below the corresponding photo
          while(!feof($fp)){
            $textLine = fgets($fp);
            if($textLine === false) { break; }
            $metaData = explode("\t", $textLine);
            $tempArr = [$metaData[1],$metaData[2],$metaData[3],$metaData[4],$metaData[5]];
            array_push($array, $tempArr);
>>>>>>> 28a18c6527ec19c18348d9f29fc26476f450536e
          }
      
          $query = mysqli_query($db, "SELECT * FROM Images");

          $largeArr = array();
          //Look through each row in the table
          while($row = mysqli_fetch_assoc($query)){
            //Adds each row into the array
            $largeArr[] = $row;
          }

          return $array;
        }

        function UploadPhoto() {
          $target_dir = "uploads/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }
          }

          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Sorry, file already exists.<br>";
            $uploadOk = 0;
          }

          // // Check file size
          // if ($_FILES["fileToUpload"]["size"] > 500000) {
          //   echo "Sorry, your file is too large.";
          //   $uploadOk = 0;
          // }

          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
              echo "Sorry, there was an error uploading your file.<br>";
            }
          }
        }
      ?>
    </div>

    <div class="container py-4">
      <div class="row" style="">
        <?php
        $array = ArrayData();
        $sortInput = $_POST["Sort"] ?? ''; //Null coalesce operator

        if($sortInput === 'Name'){
<<<<<<< HEAD
          array_multisort(array_column($array, 'photoName'), SORT_ASC, $array);
        } 
        else if($sortInput === 'Date Action'){
          array_multisort(array_column($array, 'photoDate'), SORT_ASC, SORT_NUMERIC, $array);
        } 
        else if($sortInput === 'Photographer'){
          array_multisort(array_column($array, 'photographer'), SORT_ASC, $array);
        } 
        else if($sortInput === 'Location'){
          array_multisort(array_column($array, 'photoLocation'), SORT_ASC, $array);
=======
          array_multisort( array_column( $array, 0),SORT_ASC,$array);
        } 
        else if($sortInput === 'Date Action'){
          array_multisort( array_column( $array, 1),SORT_ASC, SORT_NUMERIC, $array);
        } 
        else if($sortInput === 'Photographer'){
          array_multisort( array_column( $array, 2),SORT_ASC, $array);
        } 
        else if($sortInput === 'Location'){
          array_multisort( array_column( $array, 3),SORT_ASC, $array);
>>>>>>> 28a18c6527ec19c18348d9f29fc26476f450536e
        }

        $len = count($array);
        for($row = 0; $row < $len; $row++) {
          $pName = $array[$row]['photoName'];
          $pDate = $array[$row]['photoDate'];
          $name = $array[$row]['photographer'];
          $loc = $array[$row]['photoLocation'];
          $file = $array[$row]['fileToUpload'];

          echo '
          <div class="col-md-3" style="">
            <div class="thumbnail border border-1 border-dark px-3">
              <img src="./uploads/'. $file.'" alt="..." style="width:100%">
                <div class="caption">
                  <p><b>Photo Name: </b>'.$pName.'<br><b>Photo Date: </b>'.$pDate.'<br><b>Photographer: </b>'.$name.'<br><b>Location: </b>'.$loc.'</p>
                </div>
            </div>
          </div>';
        }
        ?>
      </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  </body>
</html>
