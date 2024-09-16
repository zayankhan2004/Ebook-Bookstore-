<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        /* contact Page */

        .sec_contact {
            height: auto;
            color: #50423A;
            color: #fff;
        }

        .contact_cont {
            display: flex;
            justify-content: space-evenly;
            padding: 4rem;
        }

        .contact_heading {
            margin-top: 3rem;
            margin-bottom: 3rem;
            font-size: 3rem;
        }

        .contact-form {
            font-family: "Montserrat", sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #fff;
            background: #00000005;
            border-radius: 4px;
            box-sizing: border-box;
            color: #fff;
        }

        .form-group input[type="text"],
        .form-group textarea:focus {
            outline: none;
        }

        .form-group textarea::placeholder {
            color: #fff;
        }

        .form-group input[type="text"]::placeholder {
            color: #fff;
        }

        .form-group textarea {
            height: 200px;
        }

        .submit-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-bottom: 1px solid black;
            border-radius: 0;
            font-size: 1.5rem;
            background: #00000000;
            color: #fff;
            transition: .3s !important;
        }

        .submit-btn:hover {
            background: #00000000 !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0) !important;
        }

        .contact_img img {
            mix-blend-mode: multiply;
            margin-top: 5rem;
            position: relative;
            left: 1rem;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <?php include('bg_video.php'); ?>

    <div class="sec_contact">
        <div class="container contact_cont">
            <div class="container" style="background:#d1a75b9c;">
                <h2 class="contact_heading">Contact Us</h2>
                <form class="contact-form" action="process_contact_form.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your name.." required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="Your email.." required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Write something.." required></textarea>
                    </div>

                    <input type="submit" class="submit-btn" value="SUBMIT">
                </form>
            </div>

            <div class="contact_img">
                <img src="contact2.png" alt="">
            </div>

        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
