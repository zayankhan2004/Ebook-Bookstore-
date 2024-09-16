<?php

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
    <link rel="stylesheet" href="style-------.css"> <!-- Custom styles -->

<nav id="nav">

<i class="fa-solid fa-bars menu_bar" onclick="menuopen()" id='menu_open_btn'></i>
<i class="fa-solid fa-x menu_bar_close" onclick="menuclose()" id='menu_close_btn'></i>




        <h1>Ebook - Admin</h1>
        

        <ul>
            <li class="list"><a class="anker" href="dashboard.php">Dashboard</a></li>
            <li class="list"><a class="anker" href="admin.php">Insert Books</a></li>
            <!-- <li class="list"><a class="anker" href="insertpodcast.php">Insert Podcasts</a></li> -->
            <!-- <li class="list"><a class="anker" href="freebook_insert.php">Insert Free-Books</a></li> -->
            <!-- <li class="list"><a class="anker" href="ins_genres.php" >Insert Genres</a></li> -->
            <li class="list"><a class="anker" href="users.php" >Users</a></li>
            <li class="list"><a class="anker" href="subs.php" >Subscribers</a></li>
            <li class="list"><a class="anker" href="com.php" >Competitors</a></li>
            <li class="list"><a class="anker" href="orders.php" >Orders</a></li>
            <li class="list"><a class="anker" href="admin_view_contacts.php" >Contacts</a></li>
        <li class="list"><a class="text-danger" href="logout.php" class="">Logout</a></li>
        </ul>
    </nav>