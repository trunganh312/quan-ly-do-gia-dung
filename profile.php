<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
    <?php
    include 'connection.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $customer_id = $_SESSION['customer_id'];
    $query = mysqli_query($conn, "SELECT * FROM customers WHERE customer_id=$customer_id;");
    $row = mysqli_fetch_assoc($query);
    ?>
    <form class="px-[500px] py-4" method="POST" action="editProfile.php?customer_id=<?php echo $customer_id; ?>">
        <h1 class="text-center text-3xl fw-bold">PROFILE</h1>
        <div class="mb-6">
            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                name</label>
            <input required type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="first_name" value="<?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?>">
        </div>
        <div class="mb-6">
            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                name</label>
            <input required type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="last_name" value="<?php echo isset($row['last_name']) ? $row['last_name'] : ''; ?>">
        </div>
        <div class="mb-6">
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input required type="email" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
        </div>
        <div class="mb-6">
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Số điện
                thoại</label>
            <input required type="number" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="phone" value="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>">
        </div>
        <div class="mb-6">
            <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input required type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="password" value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>">
        </div>
        <button type="submit" name="submit" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Thay
            đổi</button>
    </form>
</body>

</html>