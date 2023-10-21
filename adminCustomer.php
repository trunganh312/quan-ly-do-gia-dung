<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | Shop đồ gia dụng</title>
</head>

<body>
    <table id="customers">
        <tr>
            <th style="width: 87px;">Họ và tên</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th colspan="2">Thao tác</th>
        </tr>
        <?php
        include 'connection.php';
        if (session_status() === PHP_SESSION_NONE) {
            // session_start();
        }
        $search_keyword = isset($_GET['searchName']) ? $_GET['searchName'] : '';
        if (isset($_GET['searchName']) === true && $_GET['searchName'] !== '') {
            $query = "SELECT * FROM customers WHERE first_name LIKE '%$search_keyword%' ";
        } else {
            $query = "SELECT * FROM customers";
        }

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Duyệt qua từng dòng kết quả
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td> <?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
                    <td> <?php echo $row["email"] ?></td>
                    <td> <?php echo $row["phone"] ?></td>
                    <td> <?php echo $row["password"] ?></td>
                    <td><a href="editCustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Edit</a> </td>
                    <td> <a href="xulyxoanguoidung.php?customer_id=<?php echo $row['customer_id']; ?>">Delete</a></td>
                </tr>

        <?php
            }
        } else {
            echo "Không có người dùng nào nào";
        }
        ?>
    </table>
</body>

</html>