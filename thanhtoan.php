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
    <title>Thanh toán | F8 Shop</title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
    <div class="wrapper" class="p-5">
        <h1 class="text-center text-5xl">Thanh toán</h1>
        <ul class="">
            <li class="header__cart-item">
                <img src="" alt="Bộ kem sáng da mềm mịn" class="header__cart-img">
                <div class="header__cart-item-info">
                    <div class="header__cart-item-head">
                        <h5 class="header__cart-item-name">trung
                        </h5>
                        <div class="header__cart-item-price-wrap">
                            <span class="header__cart-item-price">2000</span>
                            <span class="header__cart-item-multiply">x</span>
                            <span class="header__cart-item-qnt">10</span>
                        </div>
                    </div>

                    <div class="header__cart-item-body">
                        <span class="header__cart-item-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum sunt unde perspiciatis sit,
                            rem maxime id voluptates incidunt odit molestiae similique dolorum ipsa temporibus accusamus
                            autem aut consequuntur facere debitis.
                        </span>
                        <span class="header__cart-item-del">
                            Xóa
                        </span>
                    </div>
                </div>
            </li>
        </ul>
        <h1 class="text-3xl">Tổng tiền: 2000$</h1>
        <form action="" class="mt-10">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded">
                Button
            </button>
        </form>
        <div class="fixed right-0 bottom-0 left-0 h-[350px]"><?php include('footer.php'); ?></div>
    </div>
</body>

</html>