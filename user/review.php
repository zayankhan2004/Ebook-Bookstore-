<div class="sec3_book_details">
<div class="container mt-5">
    <h2 class="text-white">Add Your Review</h2>
    <form action="comment.php" method="post" class="form_comm">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control letter_input" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control letter_input" id="comment" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="card_btn2">Submit</button>
    </form>
</div>

<div class="container mt-5">
    <h1 class="text-white">Other's Reviews</h1>
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