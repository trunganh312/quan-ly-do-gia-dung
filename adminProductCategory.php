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
            <th style="min-width: 200px;">Sản phẩm</th>
            <th style="min-width: 100px;">Danh mục</th>
            <th style="min-width: 100px;">Thao tác</th>
        </tr>
        <?php
        include 'connection.php';
        if (session_status() === PHP_SESSION_NONE) {
            // session_start();
        }


        $query = "SELECT pc.*, p.product_name, c.category_name 
        FROM products p 
        INNER JOIN product_categories pc ON p.product_id = pc.product_id 
        JOIN categories c ON c.category_id = pc.category_id";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Duyệt qua từng dòng kết quả
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td> <?php echo $row["product_name"] ?></td>
                    <td> <?php echo $row["category_name"] ?></td>
                    <td><a href="editProductCategory.php?product_id=<?php echo $row['product_id']; ?>&category_id=<?php echo $row['category_id']; ?>">Edit</a>
                    </td>

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