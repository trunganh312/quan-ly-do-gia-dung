<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý đồ gia dụng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
    <div class="app">
        <div class="wrapper">
            <header class="header">
                <div class="header__text">QUẢN LÝ THÔNG TIN BÁN ĐỒ GIA DỤNG</div>
            </header>
        </div>
        <div class="main">
            <div class="main__sidebar">
                <div class="main__user">
                    <div class="main__img">
                        <a href="index.php">
                            <img src="https://inkythuatso.com/uploads/images/2021/12/logo-truong-dai-hoc-kinh-te-ky-thuat-cong-nghiep-inkythuatso-01-25-09-30-52.jpg"
                                alt="" />
                        </a>
                    </div>
                </div>

                <ul class="main__list">
                    <li class="main__item active">SẢN PHẨM</li>
                    <li class="main__item">NGƯỜI DÙNG</li>
                    <li class="main__item">THANH TOÁN</li>
                    <li class="main__item">DANH MỤC</li>
                    <li class="main__item">DANH MỤC - SẢN PHẨM</li>
                    <li class="main__item">PHẢN HỒI</li>

                </ul>

            </div>
            <div class="main__content">


                <div class="tab__pane active">
                    <a href="createProduct.php"><button type="button"
                            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Thêm
                            sản phẩm</button></a>
                    <form class="m-3">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" name="search" id="default-search"
                                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Tên sản phẩm..."
                                value="<?php echo isset($_GET["search"]) ? $_GET["search"] : "" ?>">
                            <button type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                    <form>
                        <div class="flex items-center mb-4">
                            <input id="default-checkbox" type="checkbox" value="ASC" name="sortByASC"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sắp xếp tăng dần theo
                                giá</label>
                        </div>
                        <div class="flex items-center">
                            <input id="checked-checkbox" type="checkbox" name="sortByDESC" value="DESC" class="w-4 h-4
                            text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                            dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700
                            dark:border-gray-600">
                            <label for="checked-checkbox"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sắp xếp giảm dần theo
                                giá</label>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-2">Sắp
                            xếp</button>
                    </form>
                    <?php include 'adminProduct.php' ?>
                </div>

                <div class="tab__pane">
                    <a href="createCustomer.php"><button type="button"
                            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Thêm
                            người dùng</button></a>
                    <form class="m-3 form-customer">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" name="searchName" id="default-search-name"
                                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Tên người dùng..."
                                value="<?php echo isset($_GET["searchName"]) ? $_GET["searchName"] : "" ?>">
                            <button type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                    <?php include 'adminCustomer.php' ?>
                </div>
                <div class="tab__pane">
                    <?php include 'adminThanhToan.php' ?>
                </div>
                <div class="tab__pane">
                    <a href="createCategory.php"><button type="button"
                            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Thêm
                            danh mục</button></a>
                    <?php include 'adminCategories.php' ?>
                </div>
                <div class="tab__pane">
                    <a href="createProductCategory.php"><button type="button"
                            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none mt-4 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Thêm
                            danh mục - sản phẩm</button></a>
                    <?php include 'adminProductCategory.php' ?>
                </div>

                <div class="tab__pane">
                    <?php include 'adminReports.php' ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    const menuBlock = document.querySelectorAll(".main__item");
    const tabBlock = document.querySelectorAll(".tab__pane");
    const buttonBlock = document.querySelectorAll(".button-5");
    menuBlock.forEach((item, i) => {
        const tab = tabBlock[i];
        item.addEventListener("click", (e) => {
            document.querySelector(".main__item.active").classList.remove("active");
            document.querySelector(".tab__pane.active").classList.remove("active");
            item.classList.add("active");
            tab.classList.add("active");
        });
    });
    </script>

</body>

</html>