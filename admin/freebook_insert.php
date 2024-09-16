<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: freebook_insert.php");
    exit;
}
?>


<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: freebook_insert.php");
    exit;
}
?>

<?php
include('../user/db.php');

// Handle form submission to add a new book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];

    // Check if the image file upload process was successful
    if ($_FILES["coverImage"]["error"] == UPLOAD_ERR_OK) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["coverImage"]["name"]);

        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        if (move_uploaded_file($_FILES["coverImage"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars(basename($_FILES["coverImage"]["name"])) . " has been uploaded.";
            $coverImageUrl = $targetFile;
        } else {
            echo "Sorry, there was an error moving the uploaded file.";
            exit;
        }
    } else {
        echo "Sorry, there was an error uploading your image file.";
        exit;
    }

    // Check if the PDF file upload process was successful
    if ($_FILES["pdfFile"]["error"] == UPLOAD_ERR_OK) {
        $targetPdfFile = $targetDirectory . basename($_FILES["pdfFile"]["name"]);

        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetPdfFile)) {
            echo "The PDF file ". htmlspecialchars(basename($_FILES["pdfFile"]["name"])) . " has been uploaded.";
            $pdfFileUrl = $targetPdfFile;
        } else {
            echo "Sorry, there was an error moving the uploaded PDF file.";
            exit;
        }
    } else {
        echo "Sorry, there was an error uploading your PDF file.";
        exit;
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO free_books (title, author, description, coverImage, pdfFile) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $author, $description, $coverImageUrl, $pdfFileUrl);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
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
    <title>Insert Free Book</title>
</head>
<body>






    <?php include('nav_admin.php') ?>

<aside>
    
<form action="freebook_insert.php" method="post" enctype="multipart/form-data">
<div class="sections mt-4 d-flex justify-content-center">

    <div class="card text-center" style="background: #ffffff37; height: 100%">
       
        <div class="card-body">

          <h2 class="card-text text-white mb-5">Insert Latest Free-Books</h2>


          
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Book Title" 
            name="title" required>
          </div>




          
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Author Name" 
            name="author" required>
          </div>


<!-- ------------------ -->

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

<!-- PDF -->

<div class="input-group mt-4">
       <label class="input-group-text" for="inputGroupFile02">Upload PDF</label>
        <input type="file" class="form-control" id="inputGroupFile02" name="pdfFile" accept="application/pdf" required>
                </div> 


<!-- ----------- -->

 <p class="card-text text-white"></p>
      <div class="input-group mb-3 ">
      </div> 


<input type="submit" class="form-control btn btn-dark text-white" value="Add Book" name="home">

        </div>
      </div>


      <button type="button" class="btn btn-dark btn-sm"><a href="manage_freebooks.php" class = "text-white">See what you've Insert</a></button>

<!-- ----------------------------- -->

<!-- -------------------------------->

<!-- --------------------------------- -->
    </div>
    </div>

    </form>
    
</aside>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="menu.js"></script>
</body>
</html>