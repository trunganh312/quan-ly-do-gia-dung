<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục - sản phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>


<body>

    <form class="px-[500px] py-4" method="POST" action="xulythemproductcategories.php">
        <h1 class="text-center text-3xl fw-bold">Thêm danh mục - sản phẩm</h1>
        <div class="mb-6">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                product</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_id">
                <option selected>Choose a product</option>

                <?php
                include 'connection.php';
                if (session_status() === PHP_SESSION_NONE) {
                    // session_start();
                }


                $query = "SELECT p.* FROM products AS p LEFT JOIN product_categories AS pc ON p.product_id = pc.product_id WHERE pc.product_id IS NULL";

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    // Duyệt qua từng dòng kết quả
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <option value="<?php echo $row['product_id'] ?>">
                            <?php echo $row['product_name'] ?>
                        </option>

                <?php
                    }
                    echo "</select>";
                } else {
                    echo "Không có người dùng nào nào";
                }
                ?>
        </div>

        <div class="mb-6">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                category</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="category_id">
                <option selected>Choose a category</option>

                <?php
                include 'connection.php';
                if (session_status() === PHP_SESSION_NONE) {
                    // session_start();
                }


                $query = "SELECT * FROM categories";

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    // Duyệt qua từng dòng kết quả
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <option value="<?php echo $row['category_id'] ?>">
                            <?php echo $row['category_name'] ?>
                        </option>

                <?php
                    }
                    echo "</select>";
                } else {
                    echo "Không có người dùng nào nào";
                }
                ?>
        </div>
        <button type="submit" name="submit" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Thêm
            danh mục - sản phẩm</button>
    </form>
</body>

</html>