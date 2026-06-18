<?php
// =========================================
// FILE: index.php
// PURPOSE: Homepage for the Pastimes second-hand clothing store
// =========================================

// Start session so we can check if a user is logged in

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Makes the website responsive on phones and tablets -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pastimes | Second-Hand Clothing Store</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation bar -->
<header class="navbar">
    <div class="logo">Pastimes</div>

   <div class="nav-links">
    
    <?php if(isset($_SESSION['full_name'])){ ?>
        <span class="user-greeting">
            Welcome back, <?php echo htmlspecialchars($_SESSION['full_name']); ?>!
        </span>

    <a href="index.php">Home</a>

        <a href="purchaseHistory.php">Purchase History</a>
        <a href="logout.php">Logout</a>

    <?php } else { ?>

        <a href="login.php">Login</a>
        <a href="register.php">Register</a>

    <?php } ?>

    <a href="adminLogin.php">Admin</a>
    <a href="sellerRequest.php">Sell With Us</a>

</div>
</header>

<!-- Hero section -->
<section class="hero">
    <div class="hero-content">
        <h1>Give Fashion a Second Life</h1>

        <p>
            Shop affordable fashion while supporting sustainable choices.
        </p>

        <div class="hero-buttons">
            <a href="products.php" class="btn primary-btn">Shop Now</a>
        </div>
    </div>
</section>

<!-- Website goals section -->
<section class="goals">
    <h2>Why Choose Pastimes?</h2>

    <div class="goal-container">

        <div class="goal-card">
            <h3>Affordable Fashion</h3>
            <p>Buy branded clothing at lower prices.</p>
        </div>

        <div class="goal-card">
            <h3>Sustainable Shopping</h3>
            <p>Reduce waste by giving clothes a second chance.</p>
        </div>

        <div class="goal-card">
            <h3>Easy Selling</h3>
            <p>Registered sellers can request to sell their clothing online.</p>
        </div>

    </div>
</section>

<!-- Featured categories section -->
<section class="categories">
    <h2>Popular Categories</h2>

    <div class="category-container">
        <div class="category-card">Jackets</div>
        <div class="category-card">Dresses</div>
        <div class="category-card">Shoes</div>
        <div class="category-card">Jeans</div>
    </div>
</section>

<!-- =========================================
     SECTION: ABOUT PASTIMES
     PURPOSE: Explains the type of eShop and
     the goals of the business.
     RUBRIC: Startup page clearly states
     type of eShop and goals.
========================================= -->

<section class="goals-section">

    <!-- Heading describing the eShop -->
    <h2>About Pastimes</h2>

    <!-- Brief description of the online store -->
    <p>
        Pastimes is a sustainable online thrift fashion marketplace that allows
        customers to buy and sell quality pre-owned clothing items.
    </p>

    <!-- Goals heading -->
    <h3>Our Goals</h3>

    <!-- Goals of the eShop -->
    <ul class="goals-list">

        <li>
            Promote sustainable and environmentally friendly fashion.
        </li>

        <li>
            Provide affordable clothing options for everyone.
        </li>

        <li>
            Create a trusted community for buyers and sellers.
        </li>

        <li>
            Ensure clothing items are delivered in excellent condition.
        </li>

    </ul>

</section>

<!-- Footer -->
<footer>
    <p>&copy; 2026 Pastimes Clothing Store. Created for WEDE6021 POE.</p>
</footer>

</body>
</html>