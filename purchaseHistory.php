<?php
session_start();

include("DBConn.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

$sql = "SELECT order_id, order_date, total_amount, status
        FROM tblorder
        WHERE user_id = ?
        ORDER BY order_date DESC";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("i", $userID);

$stmt->execute();

$result = $stmt->get_result();

$totalPurchases = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase History</title>

    <style>

        body{
            font-family:Arial,sans-serif;
            background:#f5f2ee;
            margin:0;
            color:#3d2f2f;
        }

        .container{
            max-width:1000px;
            margin:60px auto;
        }

        h1{
            text-align:center;
            font-size:50px;
        }

        .card{
            background:white;
            padding:40px;
            border-radius:25px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            padding:18px;
            border-bottom:1px solid #ddd;
            text-align:left;
        }

        th{
            background:#f5f2ee;
        }

        .total{
            margin-top:30px;
            text-align:right;
            font-size:28px;
            font-weight:bold;
        }

        .back-btn{
            display:inline-block;
            margin-top:30px;
            padding:15px 30px;
            background:#d4a756;
            color:white;
            text-decoration:none;
            border-radius:10px;
            font-weight:bold;
        }

    </style>

</head>


<body>

<div class="container">

    <h1>Purchase History</h1>

    <div class="card">

        <table>

            <tr>
                <th>Order Number</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>

            <?php

while($row = mysqli_fetch_assoc($result)){

    $totalPurchases += $row['total_amount'];

?>

<tr>

    <td>
        ORD<?php echo $row['order_id']; ?>
    </td>

    <td>
        <?php echo $row['order_date']; ?>
    </td>

    <td>
        R<?php echo number_format($row['total_amount'],2); ?>
    </td>

    <td>
        <?php echo $row['status']; ?>
    </td>

</tr>

<?php } ?>

</table>

<div class="total">

    Total Purchases:
    R<?php echo number_format($totalPurchases,2); ?>

</div>

<a href="index.php" class="back-btn">
    Continue Shopping
</a>

</div>

</div>

</body>
</html>
