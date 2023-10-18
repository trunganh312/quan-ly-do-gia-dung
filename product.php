<?php
// Kết nối cơ sở dữ liệu (đã được thiết lập trước đó)
include_once "connection.php";
// Kiểm tra xem người dùng đã đăng nhập chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$quantity = isset($_POST['quantity']) ? $_GET['quantity'] : 0;
if (isset($_SESSION['customer_id']) && isset($_GET['product_id'])) {
    $customerId = $_SESSION['customer_id']; // Lấy customer_id từ session hoặc từ thông tin đăng nhập

    // Lấy product_id và quantity từ yêu cầu hoặc từ ô văn bản
    $productId = $_GET['product_id']; // Đảm bảo bạn có tên ô văn bản chứa product_id
    // Đảm bảo bạn có tên ô văn bản chứa quantity
    $quantity = isset($_POST['quantity']) ? $_GET['quantity'] : 0;
    $query = "SELECT * FROM cart WHERE customer_id = '$customerId' AND product_id = '$productId'";
    $result = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        $row = mysqli_fetch_assoc($result);
        $existingQuantity = $row['quantity'];
        $newQuantity = $existingQuantity + $quantity;

        $updateQuery = "UPDATE cart SET quantity = '$newQuantity' WHERE customer_id = '$customerId' AND product_id = '$productId'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "";
        } else {
            echo "Lỗi khi cập nhật giỏ hàng: " . mysqli_error($conn);
        }
    } else {
        // Sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
        $insertQuery = "INSERT INTO cart (customer_id, product_id, quantity) VALUES ('$customerId', '$productId', '$quantity')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "";
        } else {
            echo "Lỗi khi thêm sản phẩm vào giỏ hàng: " . mysqli_error($conn);
        }
    }
}
?>

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

    <title><?php
            include_once "connection.php";
            $product_id = $_GET['product_id'];
            $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Tìm thấy sản phẩm, render kết quả ra view
                $product = $result->fetch_assoc();
                echo $product['product_name'];
            ?>

        <?php
            }
        ?> | F8 Shop</title>
    <link href="assets/fonts/fontawesome-free-5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include 'header.php' ?>

        <div class="product__container product__container-detail">
            <div class="grid wide fix-wide-on-tablet product__container--padding">
                <!-- Nav list > -->


                <!-- Product -->
                <?php include "productDetails.php" ?>


                <!-- Sale on mobile -->


                <!-- Info shop -->
                <div class="row shop__content sm-gutter">
                    <div class="col p-12 t-12 m-12">
                        <div class="shop__content-all">
                            <div class="shop__content-first">
                                <div class="shop__content-info">
                                    <img src="https://cf.shopee.vn/file/9ce102789d156548395752b9978d13a4" alt="" class="shop__content-img">
                                </div>
                                <div class="shop__content-control">
                                    <div class="shop__content-control--text">
                                        <div class="shop__content-name">F8 Shop</div>
                                        <div class="shop__content-live">Online 2 tỉ năm trước</div>
                                    </div>
                                    <div class="shop__content-action">
                                        <button class="shop__content-action--btn btn--s btn-red hide-on-mobile">
                                            <svg viewBox="0 0 16 16" class="shop__content-svg-icon">
                                                <g fill-rule="evenodd">
                                                    <path d="M15 4a1 1 0 01.993.883L16 5v9.932a.5.5 0 01-.82.385l-2.061-1.718-8.199.001a1 1 0 01-.98-.8l-.016-.117-.108-1.284 8.058.001a2 2 0 001.976-1.692l.018-.155L14.293 4H15zm-2.48-4a1 1 0 011 1l-.003.077-.646 8.4a1 1 0 01-.997.923l-8.994-.001-2.06 1.718a.5.5 0 01-.233.108l-.087.007a.5.5 0 01-.492-.41L0 11.732V1a1 1 0 011-1h11.52zM3.646 4.246a.5.5 0 000 .708c.305.304.694.526 1.146.682A4.936 4.936 0 006.4 5.9c.464 0 1.02-.062 1.608-.264.452-.156.841-.378 1.146-.682a.5.5 0 10-.708-.708c-.185.186-.445.335-.764.444a4.004 4.004 0 01-2.564 0c-.319-.11-.579-.258-.764-.444a.5.5 0 00-.708 0z">
                                                    </path>
                                                </g>
                                            </svg>
                                            Chat ngay
                                        </button>
                                        <a href="#" class="shop__content-action--link-shop btn--s btn-light">
                                            <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" stroke-width="0" class="shop__content-svg-icon">
                                                <path d="m13 1.9c-.2-.5-.8-1-1.4-1h-8.4c-.6.1-1.2.5-1.4 1l-1.4 4.3c0 .8.3 1.6.9 2.1v4.8c0 .6.5 1 1.1 1h10.2c.6 0 1.1-.5 1.1-1v-4.6c.6-.4.9-1.2.9-2.3zm-11.4 3.4 1-3c .1-.2.4-.4.6-.4h8.3c.3 0 .5.2.6.4l1 3zm .6 3.5h.4c.7 0 1.4-.3 1.8-.8.4.5.9.8 1.5.8.7 0 1.3-.5 1.5-.8.2.3.8.8 1.5.8.6 0 1.1-.3 1.5-.8.4.5 1.1.8 1.7.8h.4v3.9c0 .1 0 .2-.1.3s-.2.1-.3.1h-9.5c-.1 0-.2 0-.3-.1s-.1-.2-.1-.3zm8.8-1.7h-1v .1s0 .3-.2.6c-.2.1-.5.2-.9.2-.3 0-.6-.1-.8-.3-.2-.3-.2-.6-.2-.6v-.1h-1v .1s0 .3-.2.5c-.2.3-.5.4-.8.4-1 0-1-.8-1-.8h-1c0 .8-.7.8-1.3.8s-1.1-1-1.2-1.7h12.1c0 .2-.1.9-.5 1.4-.2.2-.5.3-.8.3-1.2 0-1.2-.8-1.2-.9z">
                                                </path>
                                            </svg>
                                            Xem shop
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="shop__content-border hide-on-mobile"></div>
                            <div class="shop__content-last">
                                <div class="shop__content-text">
                                    <div class="shop__content-text--top">
                                        <label class="shop__content-cmt">Đánh giá</label>
                                        <span class="shop__content-cmt--number">9.9k</span>
                                    </div>
                                    <div class="shop__content-text--top">
                                        <label class="shop__content-cmt">Sản phẩm</label>
                                        <span class="shop__content-cmt--number">99</span>
                                    </div>
                                    <div class="shop__content-text--top">
                                        <label class="shop__content-cmt">Tỉ lệ phản hồi</label>
                                        <span class="shop__content-cmt--number">69%</span>
                                    </div>
                                </div>
                                <div class="shop__content-text hide-on-mobile">
                                    <div class="shop__content-text--top">
                                        <label class="shop__content-cmt">Thời gian phản hồi</label>
                                        <span class="shop__content-cmt--number">vài năm</span>
                                    </div>
                                    <div class="shop__content-text--top">
                                        <label class="shop__content-cmt">Tham gia</label>
                                        <span class="shop__content-cmt--number">2 triệu năm trước</span>
                                    </div>
                                    <div class="shop__content-text--top">
                                        <label class="shop__content-cmt">Người theo dõi</label>
                                        <span class="shop__content-cmt--number">7 tỉ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail product -->
                <div class="row detail__product sm-gutter">
                    <div class="col p-9-6 t-12 m-12">
                        <div class="detail__product-left">
                            <div class="detail__product-head">
                                CHI TIẾT SẢN PHẨM
                            </div>
                            <div class="product-caterogy hide-on-mobile">
                                <label class="product-caterogy--name">Danh mục</label>
                                <div class="product-caterogy--list">
                                    <a href="/" class="product-caterogy--link">F8 Shop</a>
                                    <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="product-caterogy--icon icon-arrow-right">
                                        <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                        </path>
                                    </svg>
                                    <a href="#" class="product-caterogy--link">Thời trang nữ</a>
                                    <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="product-caterogy--icon icon-arrow-right">
                                        <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                        </path>
                                    </svg>
                                    <a href="#" class="product-caterogy--link">Áo</a>
                                    <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="product-caterogy--icon icon-arrow-right">
                                        <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                        </path>
                                    </svg>
                                    <a href="#" class="product-caterogy--link">Áo hai dây & ba lỗ</a>
                                </div>
                            </div>
                            <div class="product-detail--content">
                                <label class="detail__content-name">Thương hiệu</label>
                                <span class="detail__content-text">CERA-Y</span>
                            </div>
                            <div class="product-detail--content">
                                <label class="detail__content-name">Kiểu tay</label>
                                <span class="detail__content-text">không tay</span>
                            </div>
                            <div class="product-detail--content">
                                <label class="detail__content-name">Chất liệu</label>
                                <span class="detail__content-text">Thun</span>
                            </div>
                            <div class="product-detail--content">
                                <label class="detail__content-name">Xuất xứ</label>
                                <span class="detail__content-text">Việt Nam</span>
                            </div>
                            <div class="product-detail--content">
                                <label class="detail__content-name">Kho hàng</label>
                                <span class="detail__content-text">3493</span>
                            </div>
                            <div class="product-detail--content">
                                <label class="detail__content-name">Gửi từ</label>
                                <span class="detail__content-text">Quận 12, TP. Hồ Chí Minh</span>
                            </div>
                            <div class="detail__product-head">
                                MÔ TẢ SẢN PHẨM
                            </div>
                            <div class="detail__product-post">
                                <p class="detail__product-post--content">
                                    Dòng sản phẩm The First được chiết xuất kết hợp từ thành phần Hoa mẫu đơn: có tính
                                    chất tăng cường vi tuần hoàn, tác dụng chống oxy hóa tương tự như Vitamin E, giúp
                                    ngăn ngừa oxy hóa lipid trong tế bào biểu bì. Nhờ vậy chiết xuất hoa mẫu đơn sẽ giúp
                                    làm giảm các dấu hiệu lão hóa, giảm nếp nhăn trên khuôn mặt, sửa chữa và phục hồi
                                    các tế bào, làm mềm và làm trắng da. </p>
                                <p class="detail__product-post--content">
                                    Đặc biệt, sự kết hợp tối ưu với công nghệ tế bào gốc EGF/hGF™ được cấp bằng sáng chế
                                    công nghệ tế bào gốc từ viện nghiên cứu toàn cầu nổi tiếng thế giới CHA Biotech thúc
                                    đẩy tế bào da hấp thụ chất dinh dưỡng giúp đẩy nhanh sự phát triển của tế bào trên
                                    da, giúp bảo vệ da khỏi các tác động từ bên ngoài, cải thiện độ đàn hồi của da như
                                    collagen và elastin, dưỡng ẩm làm da mềm mịn, làm trẻ hoá da, tái tạo tế bào chống
                                    lão hóa. Hơn hết, sản phẩm còn hỗ trợ việc điều trị nám, vết thâm sau mụn, làm da
                                    sáng hơn.
                                    <a href="#" class="content-info--link hide-on-mobile">Xem thêm</a>
                                </p>
                            </div>
                            <div class="review__pane-pagination--mobile show-on-mobile">
                                <a href="#" class="more__review-mobile">
                                    Xem thêm
                                    <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" class="breadcrumb--icon more__review-mobile--icon" style="position: relative; top: 2px;">
                                        <path stroke="none" d="m11 2.5c0 .1 0 .2-.1.3l-5 6c-.1.1-.3.2-.4.2s-.3-.1-.4-.2l-5-6c-.2-.2-.1-.5.1-.7s.5-.1.7.1l4.6 5.5 4.6-5.5c.2-.2.5-.2.7-.1.1.1.2.3.2.4z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="#" class="more__review-mobile" style="display: none;">
                                    Thu gọn
                                    <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" class="breadcrumb--icon more__review-mobile--icon" style="position: relative; top: 2px;">
                                        <path stroke="none" d="m11 8.5c0-.1 0-.2-.1-.3l-5-6c-.1-.1-.3-.2-.4-.2s-.3.1-.4.2l-5 6c-.2.2-.1.5.1.7s.5.1.7-.1l4.6-5.5 4.6 5.5c.2.2.5.2.7.1.1-.1.2-.3.2-.4z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Product review -->
                        <div class="row product__review">
                            <div class="col p-12 m-12 t-12">
                                <div class="product__review-page">
                                    <div class="product__review-head">
                                        ĐÁNH GIÁ SẢN PHẨM
                                    </div>
                                    <div class="product__review-action">
                                        <div class="review__point">
                                            <div class="review__point--head">
                                                <span class="review__point--text">4.9</span>
                                                trên 5
                                            </div>
                                            <div class="review__point--head review__point--head--mb show-on-mobile">
                                                (2.9k đánh giá)
                                            </div>
                                            <div class="product__content-rate--list">
                                                <i class="review__point-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__point-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__point-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__point-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__point-star product-item__star--normal fas fa-star"></i>
                                            </div>
                                        </div>
                                        <a href="#" class="product__related-link show-on-mobile">
                                            Xem tất cả
                                            <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="breadcrumb--icon">
                                                <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                                </path>
                                            </svg>
                                        </a>
                                        <div class="review-btn--list hide-on-mobile">
                                            <button class="review-btn--item review-btn--active">Tất cả</button>
                                            <button class="review-btn--item">5 sao (10k)</button>
                                            <button class="review-btn--item">4 sao (5.3k)</button>
                                            <button class="review-btn--item">3 sao (2k)</button>
                                            <button class="review-btn--item">2 sao (102)</button>
                                            <button class="review-btn--item">1 sao (10)</button>
                                            <button class="review-btn--item">Có bình luận (8.2k)</button>
                                            <button class="review-btn--item">Có hình ảnh / video (5k)</button>
                                        </div>
                                    </div>
                                    <div class="product__review-pane product__review-pane-first">
                                        <a href="#" class="product__review-link">
                                            <img src="https://cf.shopee.vn/file/f53558ea21555919f4d506ace10b7118" alt="Avatar" class="review__pane-img">
                                        </a>
                                        <div class="review__pane-info">
                                            <a href="#" class="product__review-link">
                                                <span class="review__pane-info--name">kodoku</span>
                                            </a>
                                            <div class="product__content-rate--list review__pane-rate--list">
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal fas fa-star"></i>
                                            </div>
                                            <span class="review__pane-type">Phân loại hàng: Trắng</span>
                                            <p class="review__pane-post">
                                                Đã nhận được hàng rồi, giao rất nhanh, hàng chất lượng, sale giá rẻ nữa,
                                                tính ra quá hời luôn
                                                ahiiiii😀😬😇😘😗😉😁😂😊😙☺😃😄😋😚😜😍😌😅😆😚😙😗😶😚😚😚
                                            </p>
                                            <div class="review__pane-feedback">
                                                <div class="review__pane-feedback--item">
                                                    Chất lượng sản phẩm tuyệt vời
                                                </div>
                                                <div class="review__pane-feedback--item">
                                                    Đóng gói sản phẩm rất đẹp và chắc chắn
                                                </div>
                                            </div>
                                            <div class="review__pane-feedback--img-list">
                                                <img src="https://cf.shopee.vn/file/90edda778e02f7bf14439fbed0de7cd4_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/ad8fda2186375c80d381c66f87aef14e_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/33f5f79770cac0eb33db2f02b2e7567c_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/2e98b7a2f7fc8b2845f6c8ecba91ac71_tn" alt="Img feedback" class="review__pane-feedback--img">
                                            </div>
                                            <div class="review__pane-action">
                                                <div class="review__pane-action--left">
                                                    <div class="review__pane-btn">
                                                        <svg class="svg-pointer" width="18px" height="16px" viewBox="0 0 14 13" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="Product-Ratings-Working" transform="translate(-245.000000, -855.000000)" fill-rule="nonzero">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 326.000000)">
                                                                                <g transform="translate(50.000000, 253.000000)">
                                                                                    <g>
                                                                                        <path d="M0,12.7272727 L2.54545455,12.7272727 L2.54545455,5.09090909 L0,5.09090909 L0,12.7272727 Z M14,5.72727273 C14,5.02727273 13.4272727,4.45454545 12.7272727,4.45454545 L8.71818182,4.45454545 L9.35454545,1.52727273 L9.35454545,1.33636364 C9.35454545,1.08181818 9.22727273,0.827272727 9.1,0.636363636 L8.4,0 L4.2,4.2 C3.94545455,4.39090909 3.81818182,4.70909091 3.81818182,5.09090909 L3.81818182,11.4545455 C3.81818182,12.1545455 4.39090909,12.7272727 5.09090909,12.7272727 L10.8181818,12.7272727 C11.3272727,12.7272727 11.7727273,12.4090909 11.9636364,11.9636364 L13.8727273,7.44545455 C13.9363636,7.31818182 13.9363636,7.12727273 13.9363636,7 L13.9363636,5.72727273 L14,5.72727273 C14,5.79090909 14,5.72727273 14,5.72727273 Z">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="review__pane-like-count">9</div>
                                                    <!-- <div class="review__pane-like-count">Hữu ích?</div> -->
                                                </div>
                                                <div class="review__pane-action--right">
                                                    <div class="review__pane-time">
                                                        2021-05-26 08:24
                                                    </div>
                                                    <div class="review__pane-rp svg-pointer">
                                                        <svg class="svg-support-icon" width="4px" height="16px" viewBox="0 0 4 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g transform="translate(-1301.000000, -550.000000)" fill="#CCCCCC">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 161.000000)">
                                                                                <g>
                                                                                    <g transform="translate(50.000000, 2.000000)">
                                                                                        <path d="M1058,122.2 C1056.895,122.2 1056,123.096 1056,124.2 C1056,125.306 1056.895,126.202 1058,126.202 C1059.104,126.202 1060,125.306 1060,124.2 C1060,123.096 1059.104,122.2 1058,122.2 M1058,116.6 C1056.895,116.6 1056,117.496 1056,118.6 C1056,119.706 1056.895,120.602 1058,120.602 C1059.104,120.602 1060,119.706 1060,118.6 C1060,117.496 1059.104,116.6 1058,116.6 M1058,111 C1056.895,111 1056,111.896 1056,113 C1056,114.106 1056.895,115.002 1058,115.002 C1059.104,115.002 1060,114.106 1060,113 C1060,111.896 1059.104,111 1058,111">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <div class="support-content-review">
                                                            Báo cáo
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product__review-pane">
                                        <a href="#" class="product__review-link">
                                            <img src="https://cf.shopee.vn/file/f53558ea21555919f4d506ace10b7118" alt="Avatar" class="review__pane-img">
                                        </a>
                                        <div class="review__pane-info">
                                            <a href="#" class="product__review-link">
                                                <span class="review__pane-info--name">kodoku</span>
                                            </a>
                                            <div class="product__content-rate--list review__pane-rate--list">
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal fas fa-star"></i>
                                            </div>
                                            <span class="review__pane-type">Phân loại hàng: Trắng</span>
                                            <p class="review__pane-post">
                                                Đã nhận được hàng rồi, giao rất nhanh, hàng chất lượng, sale giá rẻ nữa,
                                                tính ra quá hời luôn
                                                ahiiiii😀😬😇😘😗😉😁😂😊😙☺😃😄😋😚😜😍😌😅😆😚😙😗😶😚😚😚
                                            </p>
                                            <div class="review__pane-feedback">
                                                <div class="review__pane-feedback--item">
                                                    Chất lượng sản phẩm tuyệt vời
                                                </div>
                                                <div class="review__pane-feedback--item">
                                                    Đóng gói sản phẩm rất đẹp và chắc chắn
                                                </div>
                                            </div>
                                            <div class="review__pane-feedback--img-list">
                                                <img src="https://cf.shopee.vn/file/90edda778e02f7bf14439fbed0de7cd4_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/ad8fda2186375c80d381c66f87aef14e_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/33f5f79770cac0eb33db2f02b2e7567c_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/2e98b7a2f7fc8b2845f6c8ecba91ac71_tn" alt="Img feedback" class="review__pane-feedback--img">
                                            </div>
                                            <div class="review__pane-action">
                                                <div class="review__pane-action--left">
                                                    <div class="review__pane-btn">
                                                        <svg class="svg-pointer" width="18px" height="16px" viewBox="0 0 14 13" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="Product-Ratings-Working" transform="translate(-245.000000, -855.000000)" fill-rule="nonzero">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 326.000000)">
                                                                                <g transform="translate(50.000000, 253.000000)">
                                                                                    <g>
                                                                                        <path d="M0,12.7272727 L2.54545455,12.7272727 L2.54545455,5.09090909 L0,5.09090909 L0,12.7272727 Z M14,5.72727273 C14,5.02727273 13.4272727,4.45454545 12.7272727,4.45454545 L8.71818182,4.45454545 L9.35454545,1.52727273 L9.35454545,1.33636364 C9.35454545,1.08181818 9.22727273,0.827272727 9.1,0.636363636 L8.4,0 L4.2,4.2 C3.94545455,4.39090909 3.81818182,4.70909091 3.81818182,5.09090909 L3.81818182,11.4545455 C3.81818182,12.1545455 4.39090909,12.7272727 5.09090909,12.7272727 L10.8181818,12.7272727 C11.3272727,12.7272727 11.7727273,12.4090909 11.9636364,11.9636364 L13.8727273,7.44545455 C13.9363636,7.31818182 13.9363636,7.12727273 13.9363636,7 L13.9363636,5.72727273 L14,5.72727273 C14,5.79090909 14,5.72727273 14,5.72727273 Z">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="review__pane-like-count">9</div>
                                                    <!-- <div class="review__pane-like-count">Hữu ích?</div> -->
                                                </div>
                                                <div class="review__pane-action--right">
                                                    <div class="review__pane-time">
                                                        2021-05-26 08:24
                                                    </div>
                                                    <div class="review__pane-rp svg-pointer">
                                                        <svg class="svg-support-icon" width="4px" height="16px" viewBox="0 0 4 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g transform="translate(-1301.000000, -550.000000)" fill="#CCCCCC">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 161.000000)">
                                                                                <g>
                                                                                    <g transform="translate(50.000000, 2.000000)">
                                                                                        <path d="M1058,122.2 C1056.895,122.2 1056,123.096 1056,124.2 C1056,125.306 1056.895,126.202 1058,126.202 C1059.104,126.202 1060,125.306 1060,124.2 C1060,123.096 1059.104,122.2 1058,122.2 M1058,116.6 C1056.895,116.6 1056,117.496 1056,118.6 C1056,119.706 1056.895,120.602 1058,120.602 C1059.104,120.602 1060,119.706 1060,118.6 C1060,117.496 1059.104,116.6 1058,116.6 M1058,111 C1056.895,111 1056,111.896 1056,113 C1056,114.106 1056.895,115.002 1058,115.002 C1059.104,115.002 1060,114.106 1060,113 C1060,111.896 1059.104,111 1058,111">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <div class="support-content-review">
                                                            Báo cáo
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product__review-pane">
                                        <a href="#" class="product__review-link">
                                            <img src="https://cf.shopee.vn/file/f53558ea21555919f4d506ace10b7118" alt="Avatar" class="review__pane-img">
                                        </a>
                                        <div class="review__pane-info">
                                            <a href="#" class="product__review-link">
                                                <span class="review__pane-info--name">kodoku</span>
                                            </a>
                                            <div class="product__content-rate--list review__pane-rate--list">
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal fas fa-star"></i>
                                            </div>
                                            <span class="review__pane-type">Phân loại hàng: Trắng</span>
                                            <p class="review__pane-post">
                                                Đã nhận được hàng rồi, giao rất nhanh, hàng chất lượng, sale giá rẻ nữa,
                                                tính ra quá hời luôn
                                                ahiiiii😀😬😇😘😗😉😁😂😊😙☺😃😄😋😚😜😍😌😅😆😚😙😗😶😚😚😚
                                            </p>
                                            <div class="review__pane-feedback">
                                                <div class="review__pane-feedback--item">
                                                    Chất lượng sản phẩm tuyệt vời
                                                </div>
                                                <div class="review__pane-feedback--item">
                                                    Đóng gói sản phẩm rất đẹp và chắc chắn
                                                </div>
                                            </div>
                                            <div class="review__pane-feedback--img-list">
                                                <img src="https://cf.shopee.vn/file/90edda778e02f7bf14439fbed0de7cd4_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/ad8fda2186375c80d381c66f87aef14e_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/33f5f79770cac0eb33db2f02b2e7567c_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/2e98b7a2f7fc8b2845f6c8ecba91ac71_tn" alt="Img feedback" class="review__pane-feedback--img">
                                            </div>
                                            <div class="review__pane-action">
                                                <div class="review__pane-action--left">
                                                    <div class="review__pane-btn">
                                                        <svg class="svg-pointer" width="18px" height="16px" viewBox="0 0 14 13" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="Product-Ratings-Working" transform="translate(-245.000000, -855.000000)" fill-rule="nonzero">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 326.000000)">
                                                                                <g transform="translate(50.000000, 253.000000)">
                                                                                    <g>
                                                                                        <path d="M0,12.7272727 L2.54545455,12.7272727 L2.54545455,5.09090909 L0,5.09090909 L0,12.7272727 Z M14,5.72727273 C14,5.02727273 13.4272727,4.45454545 12.7272727,4.45454545 L8.71818182,4.45454545 L9.35454545,1.52727273 L9.35454545,1.33636364 C9.35454545,1.08181818 9.22727273,0.827272727 9.1,0.636363636 L8.4,0 L4.2,4.2 C3.94545455,4.39090909 3.81818182,4.70909091 3.81818182,5.09090909 L3.81818182,11.4545455 C3.81818182,12.1545455 4.39090909,12.7272727 5.09090909,12.7272727 L10.8181818,12.7272727 C11.3272727,12.7272727 11.7727273,12.4090909 11.9636364,11.9636364 L13.8727273,7.44545455 C13.9363636,7.31818182 13.9363636,7.12727273 13.9363636,7 L13.9363636,5.72727273 L14,5.72727273 C14,5.79090909 14,5.72727273 14,5.72727273 Z">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="review__pane-like-count">9</div>
                                                    <!-- <div class="review__pane-like-count">Hữu ích?</div> -->
                                                </div>
                                                <div class="review__pane-action--right">
                                                    <div class="review__pane-time">
                                                        2021-05-26 08:24
                                                    </div>
                                                    <div class="review__pane-rp svg-pointer">
                                                        <svg class="svg-support-icon" width="4px" height="16px" viewBox="0 0 4 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g transform="translate(-1301.000000, -550.000000)" fill="#CCCCCC">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 161.000000)">
                                                                                <g>
                                                                                    <g transform="translate(50.000000, 2.000000)">
                                                                                        <path d="M1058,122.2 C1056.895,122.2 1056,123.096 1056,124.2 C1056,125.306 1056.895,126.202 1058,126.202 C1059.104,126.202 1060,125.306 1060,124.2 C1060,123.096 1059.104,122.2 1058,122.2 M1058,116.6 C1056.895,116.6 1056,117.496 1056,118.6 C1056,119.706 1056.895,120.602 1058,120.602 C1059.104,120.602 1060,119.706 1060,118.6 C1060,117.496 1059.104,116.6 1058,116.6 M1058,111 C1056.895,111 1056,111.896 1056,113 C1056,114.106 1056.895,115.002 1058,115.002 C1059.104,115.002 1060,114.106 1060,113 C1060,111.896 1059.104,111 1058,111">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <div class="support-content-review">
                                                            Báo cáo
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product__review-pane">
                                        <a href="#" class="product__review-link">
                                            <img src="https://cf.shopee.vn/file/f53558ea21555919f4d506ace10b7118" alt="Avatar" class="review__pane-img">
                                        </a>
                                        <div class="review__pane-info">
                                            <a href="#" class="product__review-link">
                                                <span class="review__pane-info--name">kodoku</span>
                                            </a>
                                            <div class="product__content-rate--list review__pane-rate--list">
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal fas fa-star"></i>
                                            </div>
                                            <span class="review__pane-type">Phân loại hàng: Trắng</span>
                                            <p class="review__pane-post">
                                                Đã nhận được hàng rồi, giao rất nhanh, hàng chất lượng, sale giá rẻ nữa,
                                                tính ra quá hời luôn
                                                ahiiiii😀😬😇😘😗😉😁😂😊😙☺😃😄😋😚😜😍😌😅😆😚😙😗😶😚😚😚
                                            </p>
                                            <div class="review__pane-feedback">
                                                <div class="review__pane-feedback--item">
                                                    Chất lượng sản phẩm tuyệt vời
                                                </div>
                                                <div class="review__pane-feedback--item">
                                                    Đóng gói sản phẩm rất đẹp và chắc chắn
                                                </div>
                                            </div>
                                            <div class="review__pane-feedback--img-list">
                                                <img src="https://cf.shopee.vn/file/90edda778e02f7bf14439fbed0de7cd4_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/ad8fda2186375c80d381c66f87aef14e_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/33f5f79770cac0eb33db2f02b2e7567c_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/2e98b7a2f7fc8b2845f6c8ecba91ac71_tn" alt="Img feedback" class="review__pane-feedback--img">
                                            </div>
                                            <div class="review__pane-action">
                                                <div class="review__pane-action--left">
                                                    <div class="review__pane-btn">
                                                        <svg class="svg-pointer" width="18px" height="16px" viewBox="0 0 14 13" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="Product-Ratings-Working" transform="translate(-245.000000, -855.000000)" fill-rule="nonzero">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 326.000000)">
                                                                                <g transform="translate(50.000000, 253.000000)">
                                                                                    <g>
                                                                                        <path d="M0,12.7272727 L2.54545455,12.7272727 L2.54545455,5.09090909 L0,5.09090909 L0,12.7272727 Z M14,5.72727273 C14,5.02727273 13.4272727,4.45454545 12.7272727,4.45454545 L8.71818182,4.45454545 L9.35454545,1.52727273 L9.35454545,1.33636364 C9.35454545,1.08181818 9.22727273,0.827272727 9.1,0.636363636 L8.4,0 L4.2,4.2 C3.94545455,4.39090909 3.81818182,4.70909091 3.81818182,5.09090909 L3.81818182,11.4545455 C3.81818182,12.1545455 4.39090909,12.7272727 5.09090909,12.7272727 L10.8181818,12.7272727 C11.3272727,12.7272727 11.7727273,12.4090909 11.9636364,11.9636364 L13.8727273,7.44545455 C13.9363636,7.31818182 13.9363636,7.12727273 13.9363636,7 L13.9363636,5.72727273 L14,5.72727273 C14,5.79090909 14,5.72727273 14,5.72727273 Z">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="review__pane-like-count">9</div>
                                                    <!-- <div class="review__pane-like-count">Hữu ích?</div> -->
                                                </div>
                                                <div class="review__pane-action--right">
                                                    <div class="review__pane-time">
                                                        2021-05-26 08:24
                                                    </div>
                                                    <div class="review__pane-rp svg-pointer">
                                                        <svg class="svg-support-icon" width="4px" height="16px" viewBox="0 0 4 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g transform="translate(-1301.000000, -550.000000)" fill="#CCCCCC">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 161.000000)">
                                                                                <g>
                                                                                    <g transform="translate(50.000000, 2.000000)">
                                                                                        <path d="M1058,122.2 C1056.895,122.2 1056,123.096 1056,124.2 C1056,125.306 1056.895,126.202 1058,126.202 C1059.104,126.202 1060,125.306 1060,124.2 C1060,123.096 1059.104,122.2 1058,122.2 M1058,116.6 C1056.895,116.6 1056,117.496 1056,118.6 C1056,119.706 1056.895,120.602 1058,120.602 C1059.104,120.602 1060,119.706 1060,118.6 C1060,117.496 1059.104,116.6 1058,116.6 M1058,111 C1056.895,111 1056,111.896 1056,113 C1056,114.106 1056.895,115.002 1058,115.002 C1059.104,115.002 1060,114.106 1060,113 C1060,111.896 1059.104,111 1058,111">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <div class="support-content-review">
                                                            Báo cáo
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product__review-pane">
                                        <a href="#" class="product__review-link">
                                            <img src="https://cf.shopee.vn/file/f53558ea21555919f4d506ace10b7118" alt="Avatar" class="review__pane-img">
                                        </a>
                                        <div class="review__pane-info">
                                            <a href="#" class="product__review-link">
                                                <span class="review__pane-info--name">kodoku</span>
                                            </a>
                                            <div class="product__content-rate--list review__pane-rate--list">
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal fas fa-star"></i>
                                            </div>
                                            <span class="review__pane-type">Phân loại hàng: Trắng</span>
                                            <p class="review__pane-post">
                                                Đã nhận được hàng rồi, giao rất nhanh, hàng chất lượng, sale giá rẻ nữa,
                                                tính ra quá hời luôn
                                                ahiiiii😀😬😇😘😗😉😁😂😊😙☺😃😄😋😚😜😍😌😅😆😚😙😗😶😚😚😚
                                            </p>
                                            <div class="review__pane-feedback">
                                                <div class="review__pane-feedback--item">
                                                    Chất lượng sản phẩm tuyệt vời
                                                </div>
                                                <div class="review__pane-feedback--item">
                                                    Đóng gói sản phẩm rất đẹp và chắc chắn
                                                </div>
                                            </div>
                                            <div class="review__pane-feedback--img-list">
                                                <img src="https://cf.shopee.vn/file/90edda778e02f7bf14439fbed0de7cd4_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/ad8fda2186375c80d381c66f87aef14e_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/33f5f79770cac0eb33db2f02b2e7567c_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/2e98b7a2f7fc8b2845f6c8ecba91ac71_tn" alt="Img feedback" class="review__pane-feedback--img">
                                            </div>
                                            <div class="review__pane-action">
                                                <div class="review__pane-action--left">
                                                    <div class="review__pane-btn">
                                                        <svg class="svg-pointer" width="18px" height="16px" viewBox="0 0 14 13" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="Product-Ratings-Working" transform="translate(-245.000000, -855.000000)" fill-rule="nonzero">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 326.000000)">
                                                                                <g transform="translate(50.000000, 253.000000)">
                                                                                    <g>
                                                                                        <path d="M0,12.7272727 L2.54545455,12.7272727 L2.54545455,5.09090909 L0,5.09090909 L0,12.7272727 Z M14,5.72727273 C14,5.02727273 13.4272727,4.45454545 12.7272727,4.45454545 L8.71818182,4.45454545 L9.35454545,1.52727273 L9.35454545,1.33636364 C9.35454545,1.08181818 9.22727273,0.827272727 9.1,0.636363636 L8.4,0 L4.2,4.2 C3.94545455,4.39090909 3.81818182,4.70909091 3.81818182,5.09090909 L3.81818182,11.4545455 C3.81818182,12.1545455 4.39090909,12.7272727 5.09090909,12.7272727 L10.8181818,12.7272727 C11.3272727,12.7272727 11.7727273,12.4090909 11.9636364,11.9636364 L13.8727273,7.44545455 C13.9363636,7.31818182 13.9363636,7.12727273 13.9363636,7 L13.9363636,5.72727273 L14,5.72727273 C14,5.79090909 14,5.72727273 14,5.72727273 Z">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="review__pane-like-count">9</div>
                                                    <!-- <div class="review__pane-like-count">Hữu ích?</div> -->
                                                </div>
                                                <div class="review__pane-action--right">
                                                    <div class="review__pane-time">
                                                        2021-05-26 08:24
                                                    </div>
                                                    <div class="review__pane-rp svg-pointer">
                                                        <svg class="svg-support-icon" width="4px" height="16px" viewBox="0 0 4 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g transform="translate(-1301.000000, -550.000000)" fill="#CCCCCC">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 161.000000)">
                                                                                <g>
                                                                                    <g transform="translate(50.000000, 2.000000)">
                                                                                        <path d="M1058,122.2 C1056.895,122.2 1056,123.096 1056,124.2 C1056,125.306 1056.895,126.202 1058,126.202 C1059.104,126.202 1060,125.306 1060,124.2 C1060,123.096 1059.104,122.2 1058,122.2 M1058,116.6 C1056.895,116.6 1056,117.496 1056,118.6 C1056,119.706 1056.895,120.602 1058,120.602 C1059.104,120.602 1060,119.706 1060,118.6 C1060,117.496 1059.104,116.6 1058,116.6 M1058,111 C1056.895,111 1056,111.896 1056,113 C1056,114.106 1056.895,115.002 1058,115.002 C1059.104,115.002 1060,114.106 1060,113 C1060,111.896 1059.104,111 1058,111">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <div class="support-content-review">
                                                            Báo cáo
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product__review-pane product__review-pane-last">
                                        <a href="#" class="product__review-link">
                                            <img src="https://cf.shopee.vn/file/f53558ea21555919f4d506ace10b7118" alt="Avatar" class="review__pane-img">
                                        </a>
                                        <div class="review__pane-info">
                                            <a href="#" class="product__review-link">
                                                <span class="review__pane-info--name">kodoku</span>
                                            </a>
                                            <div class="product__content-rate--list review__pane-rate--list">
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal product-item__star--red fas fa-star"></i>
                                                <i class="review__pane-star product-item__star--normal fas fa-star"></i>
                                            </div>
                                            <span class="review__pane-type">Phân loại hàng: Trắng</span>
                                            <p class="review__pane-post">
                                                Đã nhận được hàng rồi, giao rất nhanh, hàng chất lượng, sale giá rẻ nữa,
                                                tính ra quá hời luôn
                                                ahiiiii😀😬😇😘😗😉😁😂😊😙☺😃😄😋😚😜😍😌😅😆😚😙😗😶😚😚😚
                                            </p>
                                            <div class="review__pane-feedback">
                                                <div class="review__pane-feedback--item">
                                                    Chất lượng sản phẩm tuyệt vời
                                                </div>
                                                <div class="review__pane-feedback--item">
                                                    Đóng gói sản phẩm rất đẹp và chắc chắn
                                                </div>
                                            </div>
                                            <div class="review__pane-feedback--img-list">
                                                <img src="https://cf.shopee.vn/file/90edda778e02f7bf14439fbed0de7cd4_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/ad8fda2186375c80d381c66f87aef14e_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/33f5f79770cac0eb33db2f02b2e7567c_tn" alt="Img feedback" class="review__pane-feedback--img">
                                                <img src="https://cf.shopee.vn/file/2e98b7a2f7fc8b2845f6c8ecba91ac71_tn" alt="Img feedback" class="review__pane-feedback--img">
                                            </div>
                                            <div class="review__pane-action">
                                                <div class="review__pane-action--left">
                                                    <div class="review__pane-btn">
                                                        <svg class="svg-pointer" width="18px" height="16px" viewBox="0 0 14 13" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="Product-Ratings-Working" transform="translate(-245.000000, -855.000000)" fill-rule="nonzero">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 326.000000)">
                                                                                <g transform="translate(50.000000, 253.000000)">
                                                                                    <g>
                                                                                        <path d="M0,12.7272727 L2.54545455,12.7272727 L2.54545455,5.09090909 L0,5.09090909 L0,12.7272727 Z M14,5.72727273 C14,5.02727273 13.4272727,4.45454545 12.7272727,4.45454545 L8.71818182,4.45454545 L9.35454545,1.52727273 L9.35454545,1.33636364 C9.35454545,1.08181818 9.22727273,0.827272727 9.1,0.636363636 L8.4,0 L4.2,4.2 C3.94545455,4.39090909 3.81818182,4.70909091 3.81818182,5.09090909 L3.81818182,11.4545455 C3.81818182,12.1545455 4.39090909,12.7272727 5.09090909,12.7272727 L10.8181818,12.7272727 C11.3272727,12.7272727 11.7727273,12.4090909 11.9636364,11.9636364 L13.8727273,7.44545455 C13.9363636,7.31818182 13.9363636,7.12727273 13.9363636,7 L13.9363636,5.72727273 L14,5.72727273 C14,5.79090909 14,5.72727273 14,5.72727273 Z">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="review__pane-like-count">9</div>
                                                    <!-- <div class="review__pane-like-count">Hữu ích?</div> -->
                                                </div>
                                                <div class="review__pane-action--right">
                                                    <div class="review__pane-time">
                                                        2021-05-26 08:24
                                                    </div>
                                                    <div class="review__pane-rp svg-pointer">
                                                        <svg class="svg-support-icon" width="4px" height="16px" viewBox="0 0 4 16" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                            <defs></defs>
                                                            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g transform="translate(-1301.000000, -550.000000)" fill="#CCCCCC">
                                                                    <g transform="translate(155.000000, 92.000000)">
                                                                        <g transform="translate(40.000000, 184.000000)">
                                                                            <g transform="translate(0.000000, 161.000000)">
                                                                                <g>
                                                                                    <g transform="translate(50.000000, 2.000000)">
                                                                                        <path d="M1058,122.2 C1056.895,122.2 1056,123.096 1056,124.2 C1056,125.306 1056.895,126.202 1058,126.202 C1059.104,126.202 1060,125.306 1060,124.2 C1060,123.096 1059.104,122.2 1058,122.2 M1058,116.6 C1056.895,116.6 1056,117.496 1056,118.6 C1056,119.706 1056.895,120.602 1058,120.602 C1059.104,120.602 1060,119.706 1060,118.6 C1060,117.496 1059.104,116.6 1058,116.6 M1058,111 C1056.895,111 1056,111.896 1056,113 C1056,114.106 1056.895,115.002 1058,115.002 C1059.104,115.002 1060,114.106 1060,113 C1060,111.896 1059.104,111 1058,111">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <div class="support-content-review">
                                                            Báo cáo
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="review__pane-pagination hide-on-mobile">
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn pane_pagination-btn--svg">
                                                <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="breadcrumb--icon pane__pangination--icon">
                                                    <g>
                                                        <path d="m8.5 11c-.1 0-.2 0-.3-.1l-6-5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4l6-5c .2-.2.5-.1.7.1s.1.5-.1.7l-5.5 4.6 5.5 4.6c.2.2.2.5.1.7-.1.1-.3.2-.4.2z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </li>
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn pane_pagination-btn--active">
                                                1
                                            </button>
                                        </li>
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn">
                                                2
                                            </button>
                                        </li>
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn">
                                                3
                                            </button>
                                        </li>
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn">
                                                4
                                            </button>
                                        </li>
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn">
                                                5
                                            </button>
                                        </li>
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn pane_pagination-btn--disabled">
                                                ...
                                            </button>
                                        </li>
                                        <li class="review__pane-pagination--item">
                                            <button class="pane_pagination-btn pane_pagination-btn--svg">
                                                <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="breadcrumb--icon pane__pangination--icon">
                                                    <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="review__pane-pagination--mobile show-on-mobile">
                                        <a href="#" class="more__review-mobile">
                                            Xem tất cả (2.9k)
                                            <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="breadcrumb--icon more__review-mobile--icon">
                                                <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product related -->
                        <div class="row product__related">
                            <div class="col p-12 m-12 t-12">
                                <div class="product__related-page">
                                    <div class="product__related-heading">
                                        <span class="product__related-title">
                                            CÁC SẢN PHẨM KHÁC CỦA SHOP
                                        </span>
                                        <a href="#" class="product__related-link">
                                            Xem tất cả
                                            <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="breadcrumb--icon">
                                                <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="product__related-body row sm-gutter">
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/6d5199bb9d2156e0de99183321d39e53_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra yếm nữ croptop CERA-Y màu trắng CRA034
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">
                                                        10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            50.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 1.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">43%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/0e4bbbc777412fd35bc21795edf61a90_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Quần thun thể thao CERA-Y lửng ngố ôm body màu đen CRQ013
                                                    </div>
                                                    <div class="product__related-sale product__related-sale--disabled content-discount--item">
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            150.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 190
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">27%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/b592121ddd925cc21599ab13c3bff5c7_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra croptop CERA-Y màu đen CRA028
                                                    </div>
                                                    <div class="product__related-sale product__related-sale--disabled content-discount--item">
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            100.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 9.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">10%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/5e58a3202032f1eecc722887331a7612_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thun thể thao form rộng croptop CERA-Y màu đen CR001
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            89.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 9.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">50%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/2eaaf9d13854346929ccd0ef6395fc74_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra hai dây CERA-Y bản 1cm croptop CRA018
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            80.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 2.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">16%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/05fd8241aaa4ec2e1e539ffa879bf16b_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo 2 dây basic vintage chất liệu vải cao cấp phong cách Hàn
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            99.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 189
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">43%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col p-12 m-12 t-12">
                                <div class="product__related-page">
                                    <div class="product__related-heading">
                                        <span class="product__related-title">
                                            SẢN PHẨM TƯƠNG TỰ
                                        </span>
                                        <a href="#" class="product__related-link">
                                            Xem tất cả
                                            <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="breadcrumb--icon">
                                                <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="product__related-body row sm-gutter">
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/6d5199bb9d2156e0de99183321d39e53_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra yếm nữ croptop CERA-Y màu trắng CRA034
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">
                                                        10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            50.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 1.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">43%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/0e4bbbc777412fd35bc21795edf61a90_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Quần thun thể thao CERA-Y lửng ngố ôm body màu đen CRQ013
                                                    </div>
                                                    <div class="product__related-sale product__related-sale--disabled content-discount--item">
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            150.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 190
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">27%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/b592121ddd925cc21599ab13c3bff5c7_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra croptop CERA-Y màu đen CRA028
                                                    </div>
                                                    <div class="product__related-sale product__related-sale--disabled content-discount--item">
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            100.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 9.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">10%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/5e58a3202032f1eecc722887331a7612_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thun thể thao form rộng croptop CERA-Y màu đen CR001
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            89.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 9.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">50%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/2eaaf9d13854346929ccd0ef6395fc74_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra hai dây CERA-Y bản 1cm croptop CRA018
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            80.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 2.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">16%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/05fd8241aaa4ec2e1e539ffa879bf16b_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo 2 dây basic vintage chất liệu vải cao cấp phong cách Hàn
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            99.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 189
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">43%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col p-12 m-12 t-12">
                                <div class="product__related-page">
                                    <div class="product__related-heading">
                                        <span class="product__related-title">
                                            CÓ THỂ BẠN CŨNG THÍCH
                                        </span>
                                        <a href="#" class="product__related-link">
                                            Xem tất cả
                                            <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="breadcrumb--icon">
                                                <path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="product__related-body row sm-gutter">
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/6d5199bb9d2156e0de99183321d39e53_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra yếm nữ croptop CERA-Y màu trắng CRA034
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">
                                                        10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            50.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 1.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">43%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/0e4bbbc777412fd35bc21795edf61a90_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Quần thun thể thao CERA-Y lửng ngố ôm body màu đen CRQ013
                                                    </div>
                                                    <div class="product__related-sale product__related-sale--disabled content-discount--item">
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            150.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 190
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">27%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/b592121ddd925cc21599ab13c3bff5c7_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra croptop CERA-Y màu đen CRA028
                                                    </div>
                                                    <div class="product__related-sale product__related-sale--disabled content-discount--item">
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            100.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 9.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">10%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/5e58a3202032f1eecc722887331a7612_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thun thể thao form rộng croptop CERA-Y màu đen CR001
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            89.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 9.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">50%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/2eaaf9d13854346929ccd0ef6395fc74_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo thể thao bra hai dây CERA-Y bản 1cm croptop CRA018
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            80.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 2.9k
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">16%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col p-2 t-4 m-6">
                                            <a href="#" class="product__related-item">
                                                <div class="product__related-img" style="background-image: url(&quot;https://cf.shopee.vn/file/05fd8241aaa4ec2e1e539ffa879bf16b_tn&quot;)">
                                                </div>
                                                <div class="product__related-content">
                                                    <div class="product__related-name">
                                                        Áo 2 dây basic vintage chất liệu vải cao cấp phong cách Hàn
                                                    </div>
                                                    <div class="product__related-sale content-discount--item">10% GIẢM
                                                    </div>
                                                    <div class="product__related-price">
                                                        <span class="product__related-price-text detail__top-product--price">
                                                            99.000
                                                            <span class="vnd-class">₫</span>
                                                        </span>
                                                        <span class="product__related-sell">
                                                            Đã bán 189
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="home-product-item__favorite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>

                                                <div class="home-product-item__sale-off">
                                                    <span class="home-product-item__sale-off-percent">43%</span>
                                                    <span class="home-product-item__sale-off-label">GIẢM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col p-2-4 t-0 m-12">
                        <div class="detail__product-right">
                            <div class="detail__top-product--head">
                                Sản Phẩm Bán Chạy
                            </div>
                            <a href="#" class="detail__top-product--link">
                                <div class="detail__top-product--img" style="background-image: url(&quot;https://cf.shopee.vn/file/6d5199bb9d2156e0de99183321d39e53_tn&quot;);">
                                </div>
                                <div class="detail__top-product--text">
                                    <h3 class="detail__top-product--name">
                                        Áo thể thao bra yếm nữ croptop CERA-Y màu trắng CRA034
                                    </h3>
                                    <div class="detail__top-price">
                                        <span class="detail__top-product--price">
                                            58.500
                                            <span class="vnd-class">₫</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="detail__top-product--link">
                                <div class="detail__top-product--img" style="background-image: url(&quot;https://cf.shopee.vn/file/2eaaf9d13854346929ccd0ef6395fc74_tn&quot;);">
                                </div>
                                <div class="detail__top-product--text">
                                    <h3 class="detail__top-product--name">
                                        Áo thể thao bra hai dây CERA-Y bản 1cm croptop CRA018
                                    </h3>
                                    <div class="detail__top-price">
                                        <span class="detail__top-product--price">
                                            40.500
                                            <span class="vnd-class">₫</span>
                                        </span>
                                        <span class="vnd-to-class"></span>
                                        <span class="detail__top-product--price">
                                            60.500
                                            <span class="vnd-class">₫</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="detail__top-product--link">
                                <div class="detail__top-product--img" style="background-image: url(&quot;https://cf.shopee.vn/file/a6a6082ec157bd1801c217a594995041_tn&quot;);">
                                </div>
                                <div class="detail__top-product--text">
                                    <h3 class="detail__top-product--name">
                                        Áo thể thao bra hai dây bản to 3cm croptop CERA-Y màu đen CRA032
                                    </h3>
                                    <div class="detail__top-price">
                                        <span class="detail__top-product--price">
                                            99.999
                                            <span class="vnd-class">₫</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="detail__top-product--link">
                                <div class="detail__top-product--img" style="background-image: url(&quot;https://cf.shopee.vn/file/f53558ea21555919f4d506ace10b7118_tn&quot;);">
                                </div>
                                <div class="detail__top-product--text">
                                    <h3 class="detail__top-product--name">
                                        Áo croptop ba lỗ CERA-Y chất thun co dãn CRA035
                                    </h3>
                                    <div class="detail__top-price">
                                        <span class="detail__top-product--price">
                                            110.000
                                            <span class="vnd-class">₫</span>
                                        </span>
                                        <span class="vnd-to-class"></span>
                                        <span class="detail__top-product--price">
                                            160.000
                                            <span class="vnd-class">₫</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="detail__top-product--link">
                                <div class="detail__top-product--img" style="background-image: url(&quot;https://cf.shopee.vn/file/c7ce41ce9cc32c1f40572c634b10eaef_tn&quot;);">
                                </div>
                                <div class="detail__top-product--text">
                                    <h3 class="detail__top-product--name">
                                        Áo thể thao bra croptop CERA-Y màu đen CRA025
                                    </h3>
                                    <div class="detail__top-price">
                                        <span class="detail__top-product--price">
                                            88.800
                                            <span class="vnd-class">₫</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'  ?>
    </div>
</body>

</html>