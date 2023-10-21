<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
    <?php
    include 'connection.php';
    $category_id = $_GET['category_id'];
    $query = mysqli_query($conn, "SELECT * FROM categories WHERE category_id=$category_id;");
    $row = mysqli_fetch_assoc($query);
    ?>
    <form class="px-[500px] py-4" method="POST" action="xulysuacategory.php?category_id=<?php echo $category_id; ?>">
        <h1 class="text-center text-3xl fw-bold">Sửa danh mục</h1>
        <div class="mb-6">
            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên danh
                mục</label>
            <input required type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="category_name" value="<?php echo isset($row['category_name']) ? $row['category_name'] : ''; ?>">
        </div>

        <button type="submit" name="submit" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Sửa
            danh mục</button>
    </form>
</body>

</html>