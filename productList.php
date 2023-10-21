<?php

$recordsPerPage = 10;

// Trang hiện tại
$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính toán vị trí bắt đầu
$startIndex = ($currentpage - 1) * $recordsPerPage;

include_once "connection.php";

$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
$search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
if (isset($_GET['sortByASC']) === true && $_GET['sortByASC'] === 'ASC') {
    $sql = "SELECT p.*, m.manufacturer_name
    FROM products p
    JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id ORDER BY price ASC LIMIT $startIndex, $recordsPerPage";
} else if (isset($_GET['sortByDESC']) === true && $_GET['sortByDESC'] === 'DESC') {
    $sql = "SELECT p.*, m.manufacturer_name
    FROM products p
    JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id ORDER BY price DESC LIMIT $startIndex, $recordsPerPage";
} else if (isset($_GET['categoryId']) === true && $_GET['categoryId'] !== '') {
    $sql = "SELECT p.*, m.manufacturer_name
        FROM products p
        JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id
        INNER JOIN product_categories pc ON p.product_id = pc.product_id
        WHERE pc.category_id = '$categoryId' LIMIT $startIndex, $recordsPerPage";
} else if (isset($_GET['search']) === true && $_GET['search'] !== '') {
    $sql = "SELECT p.*, m.manufacturer_name
    FROM products p
    JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id WHERE product_name LIKE '%$search_keyword%'LIMIT $startIndex, $recordsPerPage ";
} else {
    $sql = "SELECT p.*, m.manufacturer_name
    FROM products p
    JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id LIMIT $startIndex, $recordsPerPage ";
}
if ($sql !== null) {
    $result = $conn->query($sql);
}



// Kiểm tra và hiển thị dữ liệu
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="col p-2-4 t-4 m-6">
            <a class="home-product-item" href="product.php?product_id=<?php echo $row['product_id']; ?>">
                <div class="home-product-item__img" style="background-image: url(<?php echo $row['image_url']; ?>);">
                </div>
                <h4 class="home-product-item__name">
                    <?php echo $row['product_name']; ?>
                </h4>
                <div class="home-product-item__price">
                    <span class="home-product-item__price-old"><?php echo $row['price'] + 50000; ?>đ</span>
                    <span class="home-product-item__price-current"><?php echo $row['price']; ?>đ</span>
                </div>

                <div class="home-product-item__origin">
                    <span class="home-product-item__brand"><?php echo $row['manufacturer_name']; ?></span>
                </div>
                <div class="home-product-item__favorite">
                    <i class="fas fa-check"></i>
                    <span>Yêu thích</span>
                </div>
                <div class="home-product-item__sale-off">
                    <span class="home-product-item__sale-off-percent">45%</span>
                    <span class="home-product-item__sale-off-label">GIẢM</span>
                </div>
            </a>
        </div>
<?php

    }
} else {
    echo "<h1>Không có sản phẩm !!! </h1>";
}
?>