<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>





<?php
include('../user/db.php');

// Initialize variables
$id = $title = $author = $description = "";

// Handle form submission to update a book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    
    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["coverImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["coverImage"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["coverImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["coverImage"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["coverImage"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update the book in the database
    $sql = "UPDATE books SET title = '$title', author = '$author', description = '$description', coverImageUrl = '$target_file' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Book updated successfully!";
        // Redirect back to the homepage or any other desired page
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['id']) && !empty($_GET['id'])) {
    // Fetch book details from the database
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $author = $row['author'];
        $description = $row['description'];
    } else {
        echo "Invalid book ID";
    }
} else {
    echo "Book ID not specified";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Book</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php echo $author; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="coverImage" class="form-label">Cover Image</label>
                <input class="form-control" type="file" id="coverImage" name="coverImage" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</body>
</html>
