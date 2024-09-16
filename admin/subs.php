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
    <!-- <link rel="stylesheet" href="style-.css"> Custom styles -->
    <title>Admin Panel</title>
    <style>
        /* Custom CSS for table */
        .tablee {
            width: 60vw;
            /* border-collapse: collapse; */
            margin-top: 20px;
            margin-bottom: 20px;
            background: transparent;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            
        }

        td{
            color: #fff;
        }
        th {
            background-color: #f2f2f2;
            
        }
        .t_img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 100rem;
        }
    </style>
</head>
<body>
    <?php include('nav_admin.php') ?>
<aside>
    <div class="">
        <h1 class="text-center user_head">List of Subscribers</h1>
        <div class="table--responsive">
            <table class="tablee tablee-striped">
                <thead>
                    <tr class="table_up">
                        <th>S.no/   </th>
                        <!-- <th>Profile Picture</th> -->
                        <!-- <th>Username</th> -->
                        <th>Emails</th>
                        <!-- <th>Password</th> -->
                       
                    </tr>
                </thead>
                <tbody>    
                    
                     <!-- echo "<td  class='t_c'>" . $row['password'] . "</td>"; -->
                        <!-- echo "<td><img class='t_img' src='" . $row['profile_picture'] . "' alt='Profile Picture'></td>";
                        echo "<td  class='t_c'>" . $row['username'] . "</td>"; -->
                    <?php
                    // Establishing database connection
                    include('../user/db.php');
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Performing the query to fetch all users
                    $result = mysqli_query($conn, "SELECT * FROM subscribers");
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    // Fetching and displaying each user row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                     echo "<td  class='t_c'>" . $row['id'] . "</td>";
                        echo "<td  class='t_c'>" . $row['email'] . "</td>";
                       
                        
                        echo "</tr>";
                    }
                    // Closing database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </aside>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="menu.js"></script>
</body>
</html>
