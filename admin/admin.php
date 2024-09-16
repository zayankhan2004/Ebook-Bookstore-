<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="style-.css"> -->
    <title>Admin Panel</title>
</head>
<body>
<?php include('nav_admin.php') ?>

<aside>




<form action="admin.php" method="post" enctype="multipart/form-data">
<div class="sections mt-4 d-flex justify-content-center">

    <div class="card text-center" style="background: #ffffff37; height: 100%">
       
        <div class="card-body">

          <h2 class="card-text text-white mb-5">Insert Latest Books</h2>


          
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Book Title" 
            name="title" required>
          </div>




          
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Author Name" 
            name="author" required>
          </div>


             <!-- <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Category Name" 
            name="category" required>
          </div> -->
      





          <!-- <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Options</label>
            <select class="form-select" id="inputGroupSelect01" name="category" required>
    <option selected disabled>Choose...</option>
    <option value="Horror">Horror</option>
    <option value="Science Fictions">Science Fictions</option>
    <option value="Non Fictions">Non Fictions</option>
    <option value="Romantic">Romantic</option>
    <option value="History">History</option>
</select>
        </div> -->

        <div class="input-group mb-3">
    <label class="input-group-text" for="inputGroupSelect01">Category</label>
    <select class="form-select" id="inputGroupSelect01" name="category" required>
        <option selected disabled>Choose...</option>
        <option value="Horror">Horror</option>
        <option value="Science Fictions">Science Fictions</option>
        <option value="Non Fictions">Non Fictions</option>
        <option value="Romantic">Romantic</option>
        <option value="History">History</option>
        <option value="Biography">Biography</option>
        <option value="Crime Stories">Crime Stories</option>
        <option value="Poem And Folks">Poem And Folks</option>
    </select>
</div>
<!-- ------------------ -->
    <div class="input-group mb-3">
            <input type="Number" class="form-control" placeholder="Price" 
            name="price" required>
          </div>





 <div class="input-group">
  <span class="input-group-text">Book Description
  </span>
  <textarea class="form-control" aria-label="With textarea" name="description" rows="4" cols="50"></textarea>
</div>




<!-- -------------- -->

 <div class="sections mt-4">
<div class="input-group">
       <label class="input-group-text" for="inputGroupFile01">Upload-img</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="coverImage" required>
                </div>

<!-- audio -->

<!-- <div class="input-group mt-4">
       <label class="input-group-text" for="inputGroupFile01">Upload-audio</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="podcast_audio" accept="audio/mp3" required>
                </div>  -->


<!-- ----------- -->

 <p class="card-text text-white"></p>
      <div class="input-group mb-3 ">
        <!-- <div class="input-group">
            <input type="date" class="date" name="podcast_date" required>
          </div> -->
      </div> 


<input type="submit" class="form-control btn btn-dark text-white" value="Add Book" name="home">

        </div>
      </div>


      <button type="button" class="btn btn-dark btn-sm"><a href="manage_books.php" class = "text-white">See what you've Insert</a></button>

<!-- ----------------------------- -->

<!-- -------------------------------->

<!-- --------------------------------- -->
    </div>

    </form>
    
</aside>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="menu.js"></script>
</body>
</html>




<?php

// Check if the user is not logged in as admin, redirect to the login page
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include('../user/db.php');
// Handle form submission to add a new book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Specify the target directory
    $targetDirectory = "uploads/";

    // Specify the target file name (you can use a unique name to avoid conflicts)
    $targetFile = $targetDirectory . basename($_FILES["coverImage"]["name"]);

    // Check if the directory exists, if not, create it
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true); // Adjust permissions as needed
    }

    // Check if the file has been uploaded successfully
    if (move_uploaded_file($_FILES["coverImage"]["tmp_name"], $targetFile)) {
        // File uploaded successfully
        // echo "The file ". htmlspecialchars(basename($_FILES["coverImage"]["name"])) . " has been uploaded.";

        // Now you can proceed with inserting the file path into the database
        $coverImageUrl = $targetFile;

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO books (title, author, categories, price, description, coverImageUrl) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdss", $title, $author, $category, $price, $description, $coverImageUrl); // Use $category instead of $categories

        // Execute the statement
        if ($stmt->execute()) {
            echo "Book added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        // Error uploading file
        echo "Sorry, there was an error uploading your file.";
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
