<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
    <?php
    include 'connection.php';
    $product_id = $_GET['product_id'];
    $manufacturer_id = $_GET['manufacturer_id'];
    $query = mysqli_query($conn, "SELECT * FROM products WHERE product_id=$product_id;");
    $row = mysqli_fetch_assoc($query);
    ?>
    <form class="px-[500px] py-4" method="POST" action="xulysuasanpham.php?product_id=<?php echo $product_id; ?>">
        <h1 class="text-center text-3xl fw-bold">Sửa sản phẩm</h1>
        <div class="mb-6">
            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên sản
                phẩm</label>
            <input required type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_name" value="<?php echo isset($row['product_name']) ? $row['product_name'] : ''; ?>">
        </div>
        <div class="mb-6">
            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mô tả</label>
            <input required type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="description" value="<?php echo isset($row['description']) ? $row['description'] : ''; ?>">
        </div>
        <div class="mb-6">
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link
                ảnh</label>
            <input required type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="image_url" value="<?php echo isset($row['image_url']) ? $row['image_url'] : ''; ?>">
        </div>
        <div class="mb-6">
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Giá
                tiền</label>
            <input required type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="price" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>">
        </div>
        <div>
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nhà sản
                xuất</label>
            <select required id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="manufacturer_id">
                <option selected>Nhà sản xuất</option>
                <?php
                include_once "connection.php";
                $query = "SELECT * FROM manufacturers";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    // Duyệt qua từng dòng kết quả
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <option <?php echo  $manufacturer_id == $row['manufacturer_id'] ? 'selected' : ''; ?> value="<?php echo $row['manufacturer_id'] ?>"><?php echo $row['manufacturer_name'] ?>
                        </option>
                <?php
                    }
                    echo "
            </select>";
                } else {
                    echo "";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="submit" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Sửa
            sản phẩm</button>
    </form>
</body>

</html>