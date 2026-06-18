<?php
// =========================================
// FILE: manageSellRequests.php
// PURPOSE: Allows administrators to view,
// approve and reject seller requests.
// RUBRIC: Administrator communicates with
// sellers and manages requests.
// =========================================

// Start session
session_start();

// Include database connection
include 'DBConn.php';

// =========================================
// CHECK IF ADMIN IS LOGGED IN
// =========================================
if (!isset($_SESSION["admin_id"])) {

    // Redirect to admin login page
    header("Location: adminLogin.php");
    exit();
}

// =========================================
// APPROVE OR REJECT REQUESTS
// =========================================
if (isset($_GET["action"]) && isset($_GET["id"])) {

    // Get request ID
    $requestId = $_GET["id"];

    // Determine action
    if ($_GET["action"] == "approve") {

        $status = "Approved";

    } elseif ($_GET["action"] == "reject") {

        $status = "Rejected";

    }

    // Update request status
    $sql = "UPDATE tblSellRequest
            SET status = ?
            WHERE request_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $status, $requestId);

    $stmt->execute();
}

// =========================================
// FETCH ALL SELL REQUESTS
// =========================================
$sql = "SELECT * FROM tblSellRequest
        ORDER BY request_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Sell Requests</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
  <header class="navbar">
    <div class="logo">Pastimes Admin</div>


    <nav>
        <a href="adminDashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
</nav>
</header>
<div class="admin-section">

    <h1>Manage Seller Requests</h1>

    <p class="admin-intro">
        Review seller requests and approve or reject submissions.
    </p>
        <div class="seller-requests-card">

       <table class="seller-table">
           <thead>
    <tr>
        <th>ID</th>
        <th>Seller</th>
        <th>Email</th>
        <th>Brand</th>
        <th>Description</th>
        <th>Size</th>
        <th>Condition</th>
        <th>Image</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

    <td><?= $row['request_id']; ?></td>

    <td><?= htmlspecialchars($row['seller_name']); ?></td>

    <td><?= htmlspecialchars($row['email']); ?></td>

    <td><?= htmlspecialchars($row['brand']); ?></td>

    <td><?= htmlspecialchars($row['description']); ?></td>

    <td><?= htmlspecialchars($row['size']); ?></td>

    <td><?= htmlspecialchars($row['clothing_condition']); ?></td>

    <td>
        <img src="images/<?= htmlspecialchars($row['image_name']); ?>"
             class="request-image"
             alt="Product Image">
    </td>

    <td>
<?php if($row['status'] == 'Approved'){ ?>
    <span class="status-approved">Approved</span>

<?php } elseif($row['status'] == 'Rejected'){ ?>
    <span class="status-rejected">Rejected</span>

<?php } else { ?>
    <span class="status-pending">Pending</span>
<?php } ?>
</td>

    <td class="action-links">

<?php if($row['status'] == 'Pending'){ ?>

<a href="manageSellRequests.php?action=approve&id=<?= $row['request_id']; ?>"
   class="approve-link">
   Approve
</a>

<a href="manageSellRequests.php?action=reject&id=<?= $row['request_id']; ?>"
   class="reject-link">
   Reject
</a>

<?php } ?>


<a href="deleteRequest.php?id=<?= $row['request_id']; ?>"
   class="delete-link"
   onclick="return confirm('Delete this request?')">
   Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

  </table>

</div>
</div>

</section>

</body>
</html>
