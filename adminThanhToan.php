<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | Shop đồ gia dụng</title>
</head>

<body>
    <h1 style="font-size:    30px; text-align: center; ">DANH SÁCH ĐƠN HÀNG</h1>
    <table id="customers">
        <tr>
            <th style="width: 87px;">Họ và tên</th>
            <th>Tên sản phẩm</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php
        include 'connection.php';
        if (session_status() === PHP_SESSION_NONE) {
            // session_start();
        }

        $query = "SELECT payments.*, customers.first_name,customers.last_name, products.product_name
        FROM payments
        JOIN customers ON payments.customer_id = customers.customer_id
        JOIN products ON payments.product_id = products.product_id";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Duyệt qua từng dòng kết quả
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td> <?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                    <td> <?php echo $row["product_name"] ?></td>
                    <td> <?php echo $row["amount"] ?></td>
                    <td> <?php echo $row["status"] ?></td>
                    <td> <a href="xulyxoadonhang.php?payment_id=<?php echo $row['payment_id']; ?>">Delete</a></td>
                </tr>

        <?php
            }
        } else {
            echo "Không có đơn hàng  nào";
        }
        ?>
    </table>
</body>

</html>