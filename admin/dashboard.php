<?php
session_start();

// Session verification for access control
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include('../user/db.php');

// Function to get the count of paid books
function getPaidBooksCount($conn) {
    $sql = "SELECT COUNT(*) AS paid_books_count FROM books"; // Replace 'books' with the actual table name if different
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['paid_books_count'];
    }
    return 0;
}

// Function to get the count of free books
function getFreeBooksCount($conn) {
    $sql = "SELECT COUNT(*) AS free_books_count FROM free_books"; // Replace 'free_books' with the actual table name if different
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['free_books_count'];
    }
    return 0;
}

// Function to get the count of Users
function getUsers($conn) {
    $sql = "SELECT COUNT(*) AS users_count FROM users"; // Replace 'users' with the actual table name if different
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['users_count'];
    }
    return 0;
}

// Function to get the count of Subscribers
function getSubscribersCount($conn) {
    $sql = "SELECT COUNT(*) AS subscribers_count FROM subscribers"; // Replace 'subscribers' with the actual table name
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['subscribers_count'];
    }
    return 0;
}

// Function to get the count of Competitors
function getCompetitorsCount($conn) {
    $sql = "SELECT COUNT(*) AS competitors_count FROM submissions"; // Replace 'competitors' with the actual table name
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['competitors_count'];
    }
    return 0;
}


// Function to get the count of ORders
function getOrdersCount($conn) {
    $sql = "SELECT COUNT(*) AS orders_count FROM orders"; // Replace 'competitors' with the actual table name
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['orders_count'];
    }
    return 0;
}

// Get the total count of all books
$sql = "SELECT 
            (SELECT COUNT(*) FROM books) AS total_books_count,
            (SELECT COUNT(*) FROM free_books) AS another_table_books_count";
$result = $conn->query($sql);
$total_books_count = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['total_books_count'] : 0;

// Get the count of paid books
$paid_books_count = getPaidBooksCount($conn);

// Get the count of free books
$free_books_count = getFreeBooksCount($conn);

// Get the count of Users
$users_count = getUsers($conn);

// Get the count of Subscribers
$subscribers_count = getSubscribersCount($conn);

// Get the count of Competitors
$competitors_count = getCompetitorsCount($conn);

// Get the count of Competitors
$orders_count = getOrdersCount($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="style----.css"> -->
    <title>Admin Panel</title>
</head>
<body>
<?php include('nav_admin.php') ?>

<aside class="dash_aside">
    <div class="container">
        <div class="container">
            <h2 class="aside_h1_dash">Web Statistics</h2>
            <ul class="dash text-center">
                <li><h3>Total Books: <?php echo $total_books_count; ?></h3> </li>
               
                <li><h3>Total Users: <?php echo $users_count; ?></h3> </li>
                <li><h3>Total Subscribers: <?php echo $subscribers_count; ?></h3> </li>
                <li><h3>Total Participants: <?php echo $competitors_count; ?></h3> </li>
                <li><h3>Total Orders: <?php echo $orders_count; ?></h3> </li>
            </ul>
        </div>
    </div>

    <div class="container aside_cont2">
        <div class="container">
            <h2 class="aside_h1_dash">Users Reviews</h2>
            <div class="container">
                <?php
                // Reopen the database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch comments from database
                $sql = "SELECT * FROM comments ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card mb-3 comment-card card_sec2">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo $row['comment']; ?></p>
                                <p class="card-text"><small class="text-grey"><?php echo $row['created_at']; ?></small></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No comments found.";
                }
                ?>
            </div>
        </div>
    </div>
</aside>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="menu.js"></script>
</body>
</html>
