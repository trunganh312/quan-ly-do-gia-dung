<?php

include_once "connection.php";

// Lấy product_id từ yêu cầu
$product_id = $_GET['product_id'];
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
// Truy vấn để tìm kiếm sản phẩm dựa trên product_id
$sql = "SELECT p.*, m.manufacturer_name FROM products p JOIN manufacturers m ON p.manufacturer_id = m.manufacturer_id WHERE product_id = '$product_id'";
$result = $conn->query($sql);

// Kiểm tra kết quả
if ($result->num_rows > 0) {
    // Tìm thấy sản phẩm, render kết quả ra view
    $product = $result->fetch_assoc();
?>

<div class="row shop__content sm-gutter">
    <div class="col p-12 t-12 m-12">
        <div class="shop__content-all">
            <div class="shop__content-first">
                <div class="shop__content-info">
                    <img src="https://cf.shopee.vn/file/9ce102789d156548395752b9978d13a4" alt=""
                        class="shop__content-img">
                </div>
                <div class="shop__content-control">
                    <div class="shop__content-control--text">
                        <div class="shop__content-name"><?php echo $product['manufacturer_name']; ?></div>
                        <div class="shop__content-live">Online 2 tỉ năm trước</div>
                    </div>
                    <div class="shop__content-action">
                        <button class="shop__content-action--btn btn--s btn-red hide-on-mobile">
                            <svg viewBox="0 0 16 16" class="shop__content-svg-icon">
                                <g fill-rule="evenodd">
                                    <path
                                        d="M15 4a1 1 0 01.993.883L16 5v9.932a.5.5 0 01-.82.385l-2.061-1.718-8.199.001a1 1 0 01-.98-.8l-.016-.117-.108-1.284 8.058.001a2 2 0 001.976-1.692l.018-.155L14.293 4H15zm-2.48-4a1 1 0 011 1l-.003.077-.646 8.4a1 1 0 01-.997.923l-8.994-.001-2.06 1.718a.5.5 0 01-.233.108l-.087.007a.5.5 0 01-.492-.41L0 11.732V1a1 1 0 011-1h11.52zM3.646 4.246a.5.5 0 000 .708c.305.304.694.526 1.146.682A4.936 4.936 0 006.4 5.9c.464 0 1.02-.062 1.608-.264.452-.156.841-.378 1.146-.682a.5.5 0 10-.708-.708c-.185.186-.445.335-.764.444a4.004 4.004 0 01-2.564 0c-.319-.11-.579-.258-.764-.444a.5.5 0 00-.708 0z">
                                    </path>
                                </g>
                            </svg>
                            Chat ngay
                        </button>
                        <a href="#" class="shop__content-action--link-shop btn--s btn-light">
                            <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" stroke-width="0"
                                class="shop__content-svg-icon">
                                <path
                                    d="m13 1.9c-.2-.5-.8-1-1.4-1h-8.4c-.6.1-1.2.5-1.4 1l-1.4 4.3c0 .8.3 1.6.9 2.1v4.8c0 .6.5 1 1.1 1h10.2c.6 0 1.1-.5 1.1-1v-4.6c.6-.4.9-1.2.9-2.3zm-11.4 3.4 1-3c .1-.2.4-.4.6-.4h8.3c.3 0 .5.2.6.4l1 3zm .6 3.5h.4c.7 0 1.4-.3 1.8-.8.4.5.9.8 1.5.8.7 0 1.3-.5 1.5-.8.2.3.8.8 1.5.8.6 0 1.1-.3 1.5-.8.4.5 1.1.8 1.7.8h.4v3.9c0 .1 0 .2-.1.3s-.2.1-.3.1h-9.5c-.1 0-.2 0-.3-.1s-.1-.2-.1-.3zm8.8-1.7h-1v .1s0 .3-.2.6c-.2.1-.5.2-.9.2-.3 0-.6-.1-.8-.3-.2-.3-.2-.6-.2-.6v-.1h-1v .1s0 .3-.2.5c-.2.3-.5.4-.8.4-1 0-1-.8-1-.8h-1c0 .8-.7.8-1.3.8s-1.1-1-1.2-1.7h12.1c0 .2-.1.9-.5 1.4-.2.2-.5.3-.8.3-1.2 0-1.2-.8-1.2-.9z">
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

<div class="row detail__product sm-gutter">
    <div class="col p-9-6 t-12 m-12">
        <div class="detail__product-left">

            <div class="detail__product-head">
                MÔ TẢ SẢN PHẨM
            </div>
            <div class="detail__product-post">
                <p class="detail__product-post--content">
                    <?php echo $product['description']; ?>

                </p>
            </div>
            <div class="review__pane-pagination--mobile show-on-mobile">
                <a href="#" class="more__review-mobile">
                    Xem thêm
                    <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11"
                        class="breadcrumb--icon more__review-mobile--icon" style="position: relative; top: 2px;">
                        <path stroke="none"
                            d="m11 2.5c0 .1 0 .2-.1.3l-5 6c-.1.1-.3.2-.4.2s-.3-.1-.4-.2l-5-6c-.2-.2-.1-.5.1-.7s.5-.1.7.1l4.6 5.5 4.6-5.5c.2-.2.5-.2.7-.1.1.1.2.3.2.4z">
                        </path>
                    </svg>
                </a>
                <a href="#" class="more__review-mobile" style="display: none;">
                    Thu gọn
                    <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11"
                        class="breadcrumb--icon more__review-mobile--icon" style="position: relative; top: 2px;">
                        <path stroke="none"
                            d="m11 8.5c0-.1 0-.2-.1-.3l-5-6c-.1-.1-.3-.2-.4-.2s-.3.1-.4.2l-5 6c-.2.2-.1.5.1.7s.5.1.7-.1l4.6-5.5 4.6 5.5c.2.2.5.2.7.1.1-.1.2-.3.2-.4z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>

    </div>

</div>

<?php

} else {
    // Không tìm thấy sản phẩm
    echo "Product not found.";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();