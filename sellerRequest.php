<?php
// =========================================
// FILE: sellerRequest.php
// PURPOSE: Allows sellers to request
// approval to sell clothing items.
// RUBRIC: Seller can add description,
// image and brand.
// =========================================

include 'DBConn.php';

// Variable to display messages
$message = "";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get seller information
    $sellerName = trim($_POST["seller_name"]);
    $email = trim($_POST["email"]);

    // Get clothing information
    $brand = trim($_POST["brand"]);
    $description = trim($_POST["description"]);
    $size = trim($_POST["size"]);
    $condition = trim($_POST["condition"]);
    $imageName = trim($_POST["image_name"]);

    // Insert request into database
    $sql = "INSERT INTO tblSellRequest
            (seller_name, email, brand,
             description, size,
             clothing_condition, image_name)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param(
        "sssssss",
        $sellerName,
        $email,
        $brand,
        $description,
        $size,
        $condition,
        $imageName
    );

    // Execute query
    if ($stmt->execute()) {

        $message =
        "Your request has been sent to the administrator.";

    } else {

        $message =
        "An error occurred. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>

    <!-- =========================================
         PAGE TITLE
    ========================================= -->
    <title>Sell With Us - Pastimes</title>

    <!-- Link to CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- =========================================
         NAVIGATION BAR
    ========================================= -->
    <header class="navbar">

        <div class="logo">
            Pastimes
        </div>

        <nav>

            <a href="index.php">Home</a>

            <a href="products.php">Shop</a>

            <a href="cart.php">Cart</a>

            <a href="sellerRequest.php">Sell With Us</a>

        </nav>

    </header>

    <!-- =========================================
         SELLER REQUEST FORM
    ========================================= -->

    <div class="form-container">

        <h2>Request to Sell Clothing</h2>

        <p>
            Complete the form below to request approval
            to sell your clothing items through Pastimes.
        </p>

        <!-- Display system messages -->
        <p class="error">

            <?php echo $message; ?>

        </p>

        <form method="POST" action="sellerRequest.php">

            <!-- Seller Name -->
            <label>Full Name</label>

            <input
                type="text"
                name="seller_name"
                required
            >

            <!-- Seller Email -->
            <label>Email Address</label>

            <input
                type="email"
                name="email"
                required
            >

            <!-- Brand -->
            <label>Brand</label>

            <input
                type="text"
                name="brand"
                required
            >

            <!-- Description -->
            <label>Description</label>

            <textarea
                name="description"
                required
            ></textarea>

            <!-- Size -->
            <label>Size</label>

            <input
                type="text"
                name="size"
                required
            >

            <!-- Condition -->
            <label>Condition</label>

            <select
                name="condition"
                required
            >

                <option value="">
                    Select Condition
                </option>

                <option value="Excellent">
                    Excellent
                </option>

                <option value="Good">
                    Good
                </option>

                <option value="Fair">
                    Fair
                </option>

            </select>

            <!-- Image File Name -->
            <label>Image File Name</label>

            <input
                type="text"
                name="image_name"
                placeholder="example: jacket.jpg"
                required
            >

            <!-- Submit -->
            <button type="submit">

                Send Request

            </button>

        </form>

        <br>

        <a href="index.php" class="link">

            Back to Home

        </a>

    </div>

</body>
</html>
