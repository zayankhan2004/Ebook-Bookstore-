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

// Fetch all books from the database
$sql = "SELECT * FROM free_books ORDER BY ID DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="../style.css"> <!-- Assuming you have a CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Manage Books</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display each book as a row in the table
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['author'] . '</td>
                    <td>' . $row['description'] . '</td>
                    <td><img src="' . $row['coverImage'] . '" style="height: 40vh;"></td>
                    <td>
                        <a class="text-dark" href="./update_book.php?id=' . $row['id'] . '">Update</a>
                        <a class="text-dark" href="./delete_freebooks.php?id=' . $row['id'] . '">Delete</a>
                    </td>
                </tr>';
            
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
