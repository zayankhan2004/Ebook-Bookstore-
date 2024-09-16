<?php
require '../user/db.php';

// Fetch the top 5 submissions based on the best time (score)
$top_submissions = [];
$result = $conn->query("SELECT * FROM submissions ORDER BY score ASC LIMIT 5");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $top_submissions[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ee032ea639.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php include('main_head.php') ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Free Books - Ebook</title>
</head>
<body>
    <?php 
    include('bg_video.php');
    include('header.php');
    ?>

    <div class="sec1_books">
        <div class="container">
            <div class="news ">
                <div class="container">
                    <h1 class="news-heading text">Essay Competition</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="sec2_books" id='book_section2'>
        <div class="container">
            <h1 class="text-white"><p>Time Elapsed: <span id="clock">0:00</span></p></h1>
            <button id="startButton" onclick="startCompetition()">Start Competition</button>
            
            <form name="essayForm" action="submit.php" method="POST" onsubmit="return validateForm()">
                <input type="text" id="name" name="name" placeholder="Your Name" disabled><br>
                <input type="email" id="email" name="email" placeholder="Your Email" disabled><br>
                <textarea id="essay" name="essay" rows="10" cols="50" placeholder="Write your essay here..." disabled></textarea><br>
                <button id="submitButton" type="submit" disabled>Submit</button>
            </form>
            <div class="highscore mt-5">
    <h2>Top 5 Scores</h2>
    <?php if (!empty($top_submissions)): ?>
        <ul>
            <?php foreach ($top_submissions as $submission): ?>
                <li>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($submission['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($submission['email']); ?></p>
                    <p><strong>Start Time:</strong> <?php echo $submission['start_time']; ?></p>
                    <p><strong>End Time:</strong> <?php echo $submission['end_time']; ?></p>
                    <p><strong>Score (Time in seconds):</strong> <?php echo $submission['score']; ?></p>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No submissions yet.</p>
    <?php endif; ?>
</div>

        </div>
    </div>

    <?php include('subs.php') ?>
    <?php include('footer.php') ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    let timerInterval;
    let secondsElapsed = 0;

    function startCompetition() {
    // Make an AJAX call to start.php to set the session start time
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "start.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Enable the form fields and start the timer
            document.getElementById("name").disabled = false;
            document.getElementById("email").disabled = false;
            document.getElementById("essay").disabled = false;
            document.getElementById("submitButton").disabled = false;
            document.getElementById("startButton").disabled = true;
            timerInterval = setInterval(updateClock, 1000);
        } else {
            alert("Failed to start the competition. Please try again.");
        }
    };
    xhr.send();
}

    function updateClock() {
        secondsElapsed++;
        let minutes = Math.floor(secondsElapsed / 60);
        let seconds = secondsElapsed % 60;
        document.getElementById("clock").textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    function validateForm() {
        // Stop the timer when the form is submitted
        clearInterval(timerInterval);

        // Optionally, you can store the elapsed time in a hidden field if needed
        // for backend processing
        return true; // Allow the form submission
    }
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("searchField").addEventListener("keyup", function() {
                var searchQuery = this.value.trim().toLowerCase();
                var cards = document.querySelectorAll(".col");
                var foundBooks = false;

                cards.forEach(function(card) {
                    var title = card.querySelector(".card-title").innerText.trim().toLowerCase();
                    var author = card.querySelector(".card-text").innerText.trim().toLowerCase();

                    if (title.includes(searchQuery) || author.includes(searchQuery)) {
                        card.style.display = "block";
                        foundBooks = true;
                    } else {
                        card.style.display = "none";
                    }
                });

                var noBooksMessage = document.getElementById("noBooksMessage");
                if (!foundBooks) {
                    noBooksMessage.style.display = "block";
                } else {
                    noBooksMessage.style.display = "none";
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function hideLoginSignupAlert() {
                const loginSignupAlert = document.getElementById('loginSignupAlert');
                if(loginSignupAlert) {
                    loginSignupAlert.style.display = 'none';
                }
            }

            const urlParams = new URLSearchParams(window.location.search);
            const loginSuccess = urlParams.get('login_success');
            if (loginSuccess === 'true') {
                hideLoginSignupAlert();
            }

            const addToCartButtons = document.querySelectorAll('.card_btn[name="add_to_cart"]');
            const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                addToCartButtons.forEach(function(button) {
                    button.disabled = true;
                });
            }

            const floatingButton = document.querySelector('.floating-button');
            floatingButton.addEventListener('click', function(event) {
                event.preventDefault();

                const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
                if (!isLoggedIn) {
                    const loginSignupAlert = document.getElementById('loginSignupAlert');
                    if (loginSignupAlert) {
                        loginSignupAlert.style.display = 'block';
                    }
                    setTimeout(hideLoginSignupAlert, 3000);
                } else {
                    window.location.href = 'mycart.php';
                }
            });
        });
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
