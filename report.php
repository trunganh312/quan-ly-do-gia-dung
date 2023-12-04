<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>


<body>
    <form class="px-10 py-5" action="xulyguireport.php" method="POST">
        <h1 class="text-2xl font-bold text-center">Viết phản hồi</h1>
        <div class="flex justify-center mt-4">

            <textarea id="message" name="report_content" rows="4"
                class="block p-2.5 w-[50%] text-sm m-0 text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Your message..." pattern="^\S*$" required></textarea>
        </div>

        <div class="mb-6" style="
    display: flex;
    justify-content: flex-start;
    margin: 0 364px;
    margin-top: 10px;
">
            <select id="countries"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="product_id">
                <option selected>Choose a product</option>

                <?php
                include 'connection.php';
                if (session_status() === PHP_SESSION_NONE) {
                    // session_start();
                }


                $query = "SELECT * FROM products";

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

        <div class="flex justify-center mt-4"><button type="submit"
                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Gửi</button>
            <a href="index.php"
                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Quay
                lại</a>
        </div>
    </form>
</body>

</html>