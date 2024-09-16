<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        input {
            background: #202020 !important;
            color: #fff !important;
            display: inline-block !important;
            width: 79% !important;
            padding: 18px 36px !important;
            margin: 8px 0 !important;
            border: 1px solid #ccc !important;
            box-sizing: border-box !important;
            height: 50px !important;
            margin-top: 18px !important;
            border-radius: 20px !important;
            border: 2px solid #d1a75b !important;
            box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.06) !important;
        }

        input:focus {
            filter: drop-shadow(0px 0px 10px #000);
        }

        select {
            background: #202020 !important;
            color: #fff !important;
            display: inline-block !important;
            width: 79% !important;
            padding: 18px 36px !important;
            margin: 8px 0 !important;
            border: 1px solid #ccc !important;
            box-sizing: border-box !important;
            height: 70px !important;
            margin-top: 18px !important;
            border-radius: 20px !important;
            border: 2px solid #d1a75b !important;
            box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.06) !important;
        }

        .card_btn {
            filter: drop-shadow(0px 0px 50px #000);
            border: 2px solid #202020 !important;
        }
    </style>
</head>

<body>
    <?php
    include('header.php');
    include('bg_video.php');

    // Retrieve and sanitize variables from query parameters
    $book_id = isset($_GET['book_id']) ? htmlspecialchars($_GET['book_id']) : '';
    $title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'N/A'; // Default value added
    $author = isset($_GET['author']) ? htmlspecialchars($_GET['author']) : 'N/A'; // Default value added
    $price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '0.00';
    $totalPrice = isset($_GET['totalPrice']) ? htmlspecialchars($_GET['totalPrice']) : '0.00';
    $total_products = isset($_GET['total_products']) ? htmlspecialchars($_GET['total_products']) : '0';
    ?>

    <div class="sec">
        <div class="container order_cont">
            <h2 class="text-white">Checkout</h2>
            <div class="card_sec2 p-5 w-50 text-start mb-5">
                <!-- Display total price -->
                <div class="mb-3">
                    <h3>Total Price: $<?php echo $totalPrice; ?></h3>
                </div>
            </div>
            <form action="submit_order.php" class="text-white" method="POST">
                <!-- Hidden input fields for book details -->
                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                <input type="hidden" name="title" value="<?php echo $title; ?>">
                <input type="hidden" name="author" value="<?php echo $author; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="total_products" value="<?php echo $total_products; ?>">
                <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <br>
                    <input type="text" class="form-control" id="name" name="name" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <br>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="method" class="form-label">Payment Method</label>
                    <br>
                    <select class="form-select" id="method" name="method" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash_on_delivery">Cash on Delivery</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="flat" class="form-label">Flat / Apartment</label>
                    <br>
                    <input type="text" class="form-control" id="flat" name="flat" required>
                </div>
                <div class="mb-3">
                    <label for="street" class="form-label">Street Address</label>
                    <br>
                    <input type="text" class="form-control" id="street" name="street" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <br>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <br>
                    <input type="text" class="form-control" id="country" name="country" required>
                </div>
                <div class="mb-3">
                    <label for="pin_code" class="form-label">Pin Code</label>
                    <br>
                    <input type="text" class="form-control" id="pin_code" name="pin_code" required>
                </div>
                <button type="submit" class="card_btn">Place Order</button>
            </form>
        </div>
    </div>

    <?php include('footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
