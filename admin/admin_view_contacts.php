<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

// Include database configuration file
include('../user/db.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT id, name, email, message, created_at FROM contacts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <title>Admin - View Contacts</title>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff !important;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 10rem;
            background: #fff !important;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <?php include('nav_admin.php'); ?>
    <aside>
      <div class="container">
      <div class="container" style="padding:5rem;">
       <h1>Contact Form Submissions</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["message"] . "</td>
                            <td>" . $row["created_at"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No submissions found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
       </div>
      </div>
    </aside>
</body>
</html>
