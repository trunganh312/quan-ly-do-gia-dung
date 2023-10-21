<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/grid.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="favico" rel="icon" type="image/png" href="https://bizweb.dktcdn.net/100/327/577/files/2.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Thanh toán | Shop đồ gia dụng</title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<?php

?>

<body>
    <div class="wrapper" class="p-10">
        <h1 class="text-center text-5xl mt-5 mb-5">Giỏ hàng</h1>
        <div class="flex flex-wrap gap-5 ">
            <?php
            // Kết nối đến cơ sở dữ liệu
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            include_once "connection.php";
            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
            }

            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            if (isset($_SESSION["customer_id"])) {
                $customer_id = $_SESSION['customer_id'];

                // Truy vấn thông tin sản phẩm từ bảng "cart"
                $sql = "SELECT product_id, quantity, cart_id FROM cart WHERE customer_id = '$customer_id'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Duyệt qua các hàng kết quả
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row["product_id"];
                        $quantity = $row["quantity"];
                        $cart_id = $row["cart_id"];

                        // Lấy thông tin sản phẩm từ bảng "product" dựa trên product_id
                        $product_sql = "SELECT * FROM products WHERE product_id = '$product_id'";
                        $product_result = $conn->query($product_sql);

                        if ($product_result->num_rows > 0) {


                            // Duyệt qua các hàng kết quả
                            while ($product_row = $product_result->fetch_assoc()) {

            ?>

                                <form style="
    display: <?php echo $quantity > 0 ? "flex" : "none" ?>;
    flex-direction: column;
" method="post" action="xulythanhtoan.php?cutomer_id=<?php echo $_SESSION['customer_id']; ?>&product_id=<?php echo $product_id; ?>&amount=<?php echo $product_row["price"] * $quantity ?>&cart_id=<?php echo $cart_id; ?>&quantity=<?php echo $quantity; ?>" class=" w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a class="flex-1" href="product.php?product_id=<?php echo $product_id; ?>">
                                        <img class="p-8 rounded-t-lg" src="<?php echo $product_row["image_url"] ?>" alt="product image" />
                                    </a>
                                    <div class="px-5 pb-5">
                                        <a href="#">
                                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                                <?php echo $product_row["product_name"] ?></h5>
                                        </a>

                                        <div class="flex items-center justify-between mt-3">
                                            <span class="text-3xl font-bold text-gray-900 dark:text-white"><?php echo $product_row["price"] * $quantity ?>$</span>
                                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Số
                                                lượng: <?php echo $quantity ?></a>

                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Thanh
                                                toán</button>
                                        </div>
                                    </div>
                                </form>
            <?php
                            }
                        }
                    }
                } else {
                    echo "<div class='p-4 mb-4 m-auto text-center text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 text-xl' role='alert'>
                    <span class='font-medium'>Không có sản phẩm nào!</span>
                  </div>";
                }
            } else {
                echo "Người dùng chưa đăng nhập";
            }
            ?>
        </div>
    </div>
    <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px"><button type="button" style="width: 100px; height: 40px; margin-right: 20px; border-radius: 5px; background-color: orange; color: white"><a href="index.php">Về trang
                chủ</a></button>
    </div>
</body>

</html>