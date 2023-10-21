<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table id="customers">
        <tr>
            <th style="width: 87px;">Tên sản phẩm</th>
            <th>Mô tả</th>
            <th>Giá</th>
            <th>Nhà sản xuất</th>
            <th>Link ảnh</th>
            <th colspan="2">Thao tác</th>

        </tr>
        <?php
        $recordsPerPage = 10;

        // Trang hiện tại
        $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Tính toán vị trí bắt đầu
        $startIndex = ($currentpage - 1) * $recordsPerPage;
        include 'connection.php';
        if (session_status() === PHP_SESSION_NONE) {
            // session_start();
        }
        $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
        if (isset($_GET['sortByASC']) === true && $_GET['sortByASC'] === 'ASC') {
            $query = "SELECT p.*, m.manufacturer_name
            FROM products p
            JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id ORDER BY price ASC LIMIT $startIndex, $recordsPerPage";
        } else if (isset($_GET['sortByDESC']) === true && $_GET['sortByDESC'] === 'DESC') {
            $query = "SELECT p.*, m.manufacturer_name
            FROM products p
            JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id ORDER BY price DESC LIMIT $startIndex, $recordsPerPage";
        } else if (isset($_GET['search']) === true && $_GET['search'] !== '') {
            $query = "SELECT p.*, m.manufacturer_name
            FROM products p
            JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id WHERE product_name LIKE '%$search_keyword%'LIMIT $startIndex, $recordsPerPage ";
        } else {
            $query = "SELECT p.*, m.manufacturer_name
            FROM products p
            JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id LIMIT $startIndex, $recordsPerPage ";
        }

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Duyệt qua từng dòng kết quả
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td> <?php echo $row["product_name"] ?></td>
                    <td> <?php echo $row["description"] ?></td>
                    <td> <?php echo $row["price"] ?></td>
                    <td> <?php echo $row["manufacturer_name"] ?></td>
                    <td> <?php echo $row["image_url"] ?></td>
                    <td><a href="editProduct.php?product_id=<?php echo $row['product_id']; ?>&manufacturer_id=<?php echo $row['manufacturer_id']; ?>">Edit</a>
                    </td>
                    <td><a href="xulyxoasanpham.php?product_id=<?php echo $row['product_id']; ?>">Delete</a></td>
                </tr>

        <?php
            }
        } else {
            echo "Không có sản phẩm nào";
        }
        ?>
    </table>
    <div class="pagination" style="margin-top: 20px;margin-bottom: 20px">
        <?php include 'adminPaginationProduct.php'; ?>
    </div>
</body>

</html>