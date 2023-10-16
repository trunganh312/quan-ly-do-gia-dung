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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="favico" rel="icon" type="image/png" href="https://bizweb.dktcdn.net/100/327/577/files/2.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>F8 Shop</title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        <?php include 'header.php'; ?>

        <div class="app__container">
            <div class="grid wide fix-wide-on-tablet">
                <div class="row app__content sm-gutter">
                    <!-- List -->
                    <div class="col p-2 t-3 m-0">
                        <nav class="category">
                            <h3 class="category__heading">Danh mục</h3>

                            <ul class="category-list">
                                <?php include 'category.php'; ?>
                            </ul>
                        </nav>
                    </div>

                    <div class="col p-10 t-9 m-12">
                        <!-- Filter -->
                        <div class="home-filter hide-on-mobile-tablet">
                            <span class="home-filter__label">Sắp xếp theo</span>
                            <button class="home-filter__btn btn">Phổ biến</button>
                            <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                            <button class="home-filter__btn btn">Bán chạy</button>

                            <div class="select-input">
                                <span class="select-input__label">Giá</span>
                                <i class="select-input__icon fas fa-angle-down"></i>

                                <ul class="select-input__list">
                                    <li class="select-input__item">
                                        <a href="?sortByASC=ASC" class="select-input__link">
                                            Giá: Thấp đến cao
                                        </a>
                                    </li>
                                    <li class="select-input__item">
                                        <a href="?sortByDESC=DESC" class="select-input__link">
                                            Giá: Cao đến thấp
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        </div>
                        <!-- Product -->
                        <div class="home-product">

                            <!-- grid->row->column -->
                            <div class="row sm-gutter" style="margin-bottom: 20px">
                                <!-- Product Item -->
                                <?php
                                include_once "productList.php";
                                ?>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include "./footer.php"; ?>
    </div>



</body>

</html>