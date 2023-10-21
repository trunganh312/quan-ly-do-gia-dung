<?php

include_once "connection.php";

// Lấy product_id từ yêu cầu
$product_id = $_GET['product_id'];
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
// Truy vấn để tìm kiếm sản phẩm dựa trên product_id
$sql = "SELECT * FROM products WHERE product_id = '$product_id'";
$result = $conn->query($sql);

// Kiểm tra kết quả
if ($result->num_rows > 0) {
    // Tìm thấy sản phẩm, render kết quả ra view
    $product = $result->fetch_assoc();
?>

<div class="row product__content">
    <div class="col p-5 t-12 m-12">
        <div class="product__content-left">
            <div class="show-on-tablet">
                <div class="product__content-heading">
                    <div class="product__content-type">
                        <svg width="34" height="20" class="_2fakLZ" viewBox="0 0 30 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 2C0 0.895431 0.895431 0 2 0L28 0C29.1046 0 30 0.895431 30 2V14C30 15.1046 29.1046 16 28 16H2C0.89543 16 0 15.1046 0 14L0 2Z"
                                fill="#D0011B"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.8045 3.00128H10.8673C10.8403 3.00132 10.8137 3.00752 10.7895 3.01939C10.7652 3.03126 10.744 3.0485 10.7274 3.0698L10.151 3.70154C10.1108 3.74133 10.0736 3.78149 10.0397 3.82129L10.0109 3.85512L9.73645 4.1559C9.26611 4.63346 8.55272 5.15874 7.50601 5.1696H7.47399C6.35562 5.1696 5.61724 4.53545 5.18223 4.084L4.2545 3.06788C4.23787 3.04676 4.21666 3.02968 4.19249 3.01792C4.16831 3.00617 4.14178 3.00004 4.1149 3H3.17803C3.13084 3.00008 3.08561 3.01887 3.05224 3.05223C3.01887 3.0856 3.00008 3.13084 3 3.17803V12.8198C3.00008 12.867 3.01887 12.9123 3.05224 12.9456C3.08561 12.979 3.13084 12.9978 3.17803 12.9979H4.11458C4.16177 12.9978 4.207 12.979 4.24037 12.9456C4.27373 12.9123 4.29252 12.867 4.2926 12.8198V5.00726C4.51669 5.20068 4.74894 5.38439 4.9887 5.55788C5.57807 5.9956 6.40375 6.40585 7.47655 6.40585H7.51722C8.53818 6.3953 9.32642 6.03468 9.89137 5.64233L9.89877 5.64155L9.97012 5.58642C10.0506 5.52802 10.1262 5.46926 10.1969 5.41116L10.689 5.03095V12.8198C10.6892 12.867 10.708 12.9122 10.7413 12.9455C10.7747 12.9789 10.8199 12.9977 10.867 12.9979H11.8042C11.8514 12.9977 11.8966 12.9789 11.9299 12.9455C11.9633 12.9122 11.9821 12.867 11.9822 12.8198V3.17931C11.9821 3.1322 11.9633 3.08706 11.93 3.05372C11.8967 3.02038 11.8516 3.00153 11.8045 3.00128ZM19.3506 6.74843H18.4154C18.3682 6.74851 18.3229 6.76729 18.2896 6.80066C18.2562 6.83403 18.2374 6.87926 18.2373 6.92645V7.5172C17.6712 7.03692 16.8957 6.70776 16.087 6.70776C14.307 6.70776 12.8639 8.11659 12.8639 9.85105C12.8639 11.5855 14.307 12.9947 16.087 12.9947C16.8743 12.9882 17.6348 12.7074 18.2373 12.2006V12.8195C18.2372 12.843 18.2417 12.8663 18.2506 12.888C18.2595 12.9097 18.2726 12.9295 18.2891 12.9461C18.3057 12.9628 18.3253 12.976 18.347 12.9851C18.3686 12.9941 18.3919 12.9988 18.4154 12.9988H19.3522C19.3994 12.9987 19.4446 12.98 19.478 12.9466C19.5114 12.9132 19.5302 12.868 19.5303 12.8208V6.92933C19.5306 6.90559 19.5262 6.88202 19.5173 6.86C19.5084 6.83798 19.4952 6.81796 19.4785 6.80111C19.4618 6.78426 19.4418 6.77092 19.4199 6.76187C19.3979 6.75283 19.3744 6.74825 19.3506 6.74843ZM16.1455 11.8375C14.9929 11.8375 14.0586 10.9493 14.0586 9.85425C14.0586 8.75921 14.9929 7.87133 16.1455 7.87133C17.2982 7.87133 18.2329 8.75921 18.2329 9.85425C18.2329 10.9493 17.2982 11.8375 16.1455 11.8375ZM23.7506 12.02C23.7618 11.9746 23.7547 11.9266 23.7307 11.8865C23.7067 11.8464 23.6678 11.8174 23.6225 11.8058L23.2034 11.7005L23.1918 11.6976C22.5499 11.5653 22.3174 11.354 22.287 10.769V3.17897C22.2866 3.13204 22.2677 3.08715 22.2344 3.05414C22.201 3.02114 22.1559 3.0027 22.109 3.00287H21.2445C21.1975 3.0027 21.1524 3.02114 21.1191 3.05414C21.0857 3.08715 21.0668 3.13204 21.0664 3.17897V10.4472C21.0082 12.1513 21.9818 12.6863 22.8857 12.8864L23.3174 12.9947C23.363 13.0061 23.4113 12.999 23.4517 12.975C23.4922 12.951 23.5216 12.9121 23.5335 12.8666L23.6318 12.4888C23.6348 12.4786 23.6374 12.4681 23.6399 12.4576L23.6427 12.4465L23.7506 12.02ZM26.9708 11.8864C26.9948 11.9266 27.0019 11.9746 26.9905 12.02L26.8826 12.4465C26.8794 12.4606 26.8759 12.475 26.8718 12.4888L26.7738 12.8666C26.7618 12.9121 26.7324 12.9511 26.6918 12.975C26.6513 12.999 26.603 13.0061 26.5573 12.9947L26.1257 12.8864C25.2218 12.6863 24.2485 12.1513 24.3064 10.4472V3.17897C24.3067 3.13204 24.3257 3.08715 24.359 3.05414C24.3924 3.02114 24.4375 3.0027 24.4844 3.00287H25.3489C25.3959 3.0027 25.441 3.02114 25.4743 3.05414C25.5077 3.08715 25.5266 3.13204 25.527 3.17897V10.769C25.5574 11.354 25.7914 11.5653 26.4318 11.6976C26.436 11.6982 26.4395 11.7005 26.4437 11.7005L26.8625 11.8058C26.9078 11.8173 26.9468 11.8463 26.9708 11.8864Z"
                                fill="white"></path>
                        </svg>
                    </div>
                    <h3 class="product__content-name">
                        <?php echo $product['product_name']; ?>
                    </h3>
                </div>
                <div class="product__content-view-control">
                    <div class="product__content-rating">
                        <span class="product__content-view-text content-text--red">4.9</span>
                        <div class="product__content-rate--list">
                            <i class="product-item__star--normal product-item__star--red fas fa-star"></i>
                            <i class="product-item__star--normal product-item__star--red fas fa-star"></i>
                            <i class="product-item__star--normal product-item__star--red fas fa-star"></i>
                            <i class="product-item__star--normal product-item__star--red fas fa-star"></i>
                            <i class="product-item__star--normal fas fa-star"></i>
                        </div>
                    </div>
                    <span class="product__content-border--mid"></span>
                    <div class="product__content-cmt">
                        <span class="product__content-view-text">8.8k</span>
                        <span class="product__content-text">Đánh giá</span>
                    </div>
                    <span class="product__content-border--mid"></span>
                    <div class="product__content-cmt">
                        <span class="product__content-view-text content-text--none">9.9k</span>
                        <span class="product__content-text">Đã bán</span>
                    </div>
                </div>
                <div class="product__content-price">
                    <div class="content-price--old">
                        <?php echo $product['product_price'] + 50000; ?><span class="vnd-class">₫</span>
                    </div>
                    <div class="content-price--new">
                        <?php echo $product['product_price']; ?><span class="vnd-class">₫</span>
                    </div>
                    <div class="content-price--discount">
                        45% GIẢM
                    </div>
                </div>
            </div>
            <div class="product__content-img" style="background-image: url(<?php echo $product['image_url']; ?>);">
            </div>


        </div>
    </div>
    <div class="col p-7 t-12 m-12">
        <div class="product__content-right">
            <div class="show-on-pc-mobile flex-head--product">
                <div class="product__content-heading">
                    <div class="product__content-type">
                        <svg width="34" height="20" class="_2fakLZ" viewBox="0 0 30 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 2C0 0.895431 0.895431 0 2 0L28 0C29.1046 0 30 0.895431 30 2V14C30 15.1046 29.1046 16 28 16H2C0.89543 16 0 15.1046 0 14L0 2Z"
                                fill="#D0011B"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.8045 3.00128H10.8673C10.8403 3.00132 10.8137 3.00752 10.7895 3.01939C10.7652 3.03126 10.744 3.0485 10.7274 3.0698L10.151 3.70154C10.1108 3.74133 10.0736 3.78149 10.0397 3.82129L10.0109 3.85512L9.73645 4.1559C9.26611 4.63346 8.55272 5.15874 7.50601 5.1696H7.47399C6.35562 5.1696 5.61724 4.53545 5.18223 4.084L4.2545 3.06788C4.23787 3.04676 4.21666 3.02968 4.19249 3.01792C4.16831 3.00617 4.14178 3.00004 4.1149 3H3.17803C3.13084 3.00008 3.08561 3.01887 3.05224 3.05223C3.01887 3.0856 3.00008 3.13084 3 3.17803V12.8198C3.00008 12.867 3.01887 12.9123 3.05224 12.9456C3.08561 12.979 3.13084 12.9978 3.17803 12.9979H4.11458C4.16177 12.9978 4.207 12.979 4.24037 12.9456C4.27373 12.9123 4.29252 12.867 4.2926 12.8198V5.00726C4.51669 5.20068 4.74894 5.38439 4.9887 5.55788C5.57807 5.9956 6.40375 6.40585 7.47655 6.40585H7.51722C8.53818 6.3953 9.32642 6.03468 9.89137 5.64233L9.89877 5.64155L9.97012 5.58642C10.0506 5.52802 10.1262 5.46926 10.1969 5.41116L10.689 5.03095V12.8198C10.6892 12.867 10.708 12.9122 10.7413 12.9455C10.7747 12.9789 10.8199 12.9977 10.867 12.9979H11.8042C11.8514 12.9977 11.8966 12.9789 11.9299 12.9455C11.9633 12.9122 11.9821 12.867 11.9822 12.8198V3.17931C11.9821 3.1322 11.9633 3.08706 11.93 3.05372C11.8967 3.02038 11.8516 3.00153 11.8045 3.00128ZM19.3506 6.74843H18.4154C18.3682 6.74851 18.3229 6.76729 18.2896 6.80066C18.2562 6.83403 18.2374 6.87926 18.2373 6.92645V7.5172C17.6712 7.03692 16.8957 6.70776 16.087 6.70776C14.307 6.70776 12.8639 8.11659 12.8639 9.85105C12.8639 11.5855 14.307 12.9947 16.087 12.9947C16.8743 12.9882 17.6348 12.7074 18.2373 12.2006V12.8195C18.2372 12.843 18.2417 12.8663 18.2506 12.888C18.2595 12.9097 18.2726 12.9295 18.2891 12.9461C18.3057 12.9628 18.3253 12.976 18.347 12.9851C18.3686 12.9941 18.3919 12.9988 18.4154 12.9988H19.3522C19.3994 12.9987 19.4446 12.98 19.478 12.9466C19.5114 12.9132 19.5302 12.868 19.5303 12.8208V6.92933C19.5306 6.90559 19.5262 6.88202 19.5173 6.86C19.5084 6.83798 19.4952 6.81796 19.4785 6.80111C19.4618 6.78426 19.4418 6.77092 19.4199 6.76187C19.3979 6.75283 19.3744 6.74825 19.3506 6.74843ZM16.1455 11.8375C14.9929 11.8375 14.0586 10.9493 14.0586 9.85425C14.0586 8.75921 14.9929 7.87133 16.1455 7.87133C17.2982 7.87133 18.2329 8.75921 18.2329 9.85425C18.2329 10.9493 17.2982 11.8375 16.1455 11.8375ZM23.7506 12.02C23.7618 11.9746 23.7547 11.9266 23.7307 11.8865C23.7067 11.8464 23.6678 11.8174 23.6225 11.8058L23.2034 11.7005L23.1918 11.6976C22.5499 11.5653 22.3174 11.354 22.287 10.769V3.17897C22.2866 3.13204 22.2677 3.08715 22.2344 3.05414C22.201 3.02114 22.1559 3.0027 22.109 3.00287H21.2445C21.1975 3.0027 21.1524 3.02114 21.1191 3.05414C21.0857 3.08715 21.0668 3.13204 21.0664 3.17897V10.4472C21.0082 12.1513 21.9818 12.6863 22.8857 12.8864L23.3174 12.9947C23.363 13.0061 23.4113 12.999 23.4517 12.975C23.4922 12.951 23.5216 12.9121 23.5335 12.8666L23.6318 12.4888C23.6348 12.4786 23.6374 12.4681 23.6399 12.4576L23.6427 12.4465L23.7506 12.02ZM26.9708 11.8864C26.9948 11.9266 27.0019 11.9746 26.9905 12.02L26.8826 12.4465C26.8794 12.4606 26.8759 12.475 26.8718 12.4888L26.7738 12.8666C26.7618 12.9121 26.7324 12.9511 26.6918 12.975C26.6513 12.999 26.603 13.0061 26.5573 12.9947L26.1257 12.8864C25.2218 12.6863 24.2485 12.1513 24.3064 10.4472V3.17897C24.3067 3.13204 24.3257 3.08715 24.359 3.05414C24.3924 3.02114 24.4375 3.0027 24.4844 3.00287H25.3489C25.3959 3.0027 25.441 3.02114 25.4743 3.05414C25.5077 3.08715 25.5266 3.13204 25.527 3.17897V10.769C25.5574 11.354 25.7914 11.5653 26.4318 11.6976C26.436 11.6982 26.4395 11.7005 26.4437 11.7005L26.8625 11.8058C26.9078 11.8173 26.9468 11.8463 26.9708 11.8864Z"
                                fill="white"></path>
                        </svg>
                    </div>
                    <h3 class="product__content-name">
                        <?php echo $product['product_name']; ?>
                    </h3>
                </div>

                <div class="product__content-price">
                    <div class="content-price--old">
                        <?php echo $product['price'] + 10; ?><span class="vnd-class">₫</span>
                    </div>
                    <div class="content-price--new">
                        <?php echo $product['price']; ?> <span class="vnd-class">₫</span>
                    </div>
                    <div class="content-price--discount">
                        45% GIẢM
                    </div>
                </div>
            </div>
            <div class="product__content-body hide-on-mobile">
                <div class="product__content-discount">
                    <div class="content-discount--title">Mã giảm giá</div>
                    <div class="content-discount--code">
                        <div class="content-discount--item">
                            10% GIẢM
                        </div>
                        <div class="content-discount--item">
                            5% GIẢM
                        </div>
                    </div>


                </div>


                <div class="product__content-count">
                    <div class="content-count--title">Số lượng</div>
                    <form
                        action="product.php?quantity=<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : 0; ?>&product_id=<?php echo $product['product_id']; ?>"
                        method="post" class="content-count--control"
                        style="display: flex; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px">
                        <div class="content-count--item">
                            <input type="number" name="quantity" class="content-count--input "
                                value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : 0 ?>">
                        </div>
                        <div>
                            <button class="content-cart-text" type="submit">
                                <i class="content-cart-icon fas fa-cart-plus"></i>
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product__content-cart">
                <button class="content-chat-text show-on-mobile">
                    <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" class="content-chat-icon">
                        <g stroke="none">
                            <path
                                d="m11.2 4.1c-1.1-1.3-3-2.2-5-2.2-3.4 0-6.2 2.3-6.2 5.2 0 1.7.9 3.2 2.4 4.2l-.7 1.4s-.2.4.1.6c.3.3 1.1-.1 1.1-.1l2.4-.9c.3.1.6.1.9.1.7 0 1.5-.1 2.1-.3.5.2 1 .2 1.6.2h.6l2.1 1.5c.6.4.8.1.8-.4v-2.2c.9-.8 1.5-1.8 1.5-3 0-2-1.6-3.6-3.7-4.1zm-5.6 7.3h-.5-.2l-1.8.7.5-1.1-.7-.5c-1.3-.8-2-2-2-3.4 0-2.3 2.3-4.2 5.2-4.2 2.8 0 5.2 1.9 5.2 4.2s-2.4 4.3-5.2 4.3c-.2 0-.4 0-.5 0zm6.8-.8v1.2c0 .6-.1.4-.4.2l-1-.8c-.4.1-.8.1-1.2.1 1.5-1 2.5-2.5 2.5-4.2 0-.6-.1-1.1-.3-1.7 1.2.6 1.9 1.6 1.9 2.7 0 1-.5 1.9-1.5 2.5z">
                            </path>
                            <circle cx="3.1" cy="7.1" r=".8"></circle>
                            <circle cx="9.1" cy="7.1" r=".8"></circle>
                            <circle cx="6.1" cy="7.1" r=".8"></circle>
                        </g>
                    </svg>
                    Chat ngay
                </button>

            </div>
            <div class="product__content-slow">
                <span class="content-hr"></span>
                <div class="content-refund content-refund__free-refund">
                    <i class="content-refund--icon fas fa-history"></i>
                    <h3 class="refund-text show-on-mobile">Miễn phí trả hàng</h3>
                    <h3 class="refund-text show-on-pc">7 ngày miễn phí trả hàng</h3>
                    <div class="content-refund--detail-free">
                        <div class="refund-detail__header">Hoàn toàn yên tâm khi mua hàng ở Shopee Mall
                            với ưu đãi miễn phí trả hàng lên đến 7 ngày.</div>
                    </div>
                </div>
                <div class="content-refund content-refund__real">
                    <i class="content-refund--icon fas fa-shield-alt"></i>
                    <h3 class="refund-text show-on-pc">Hàng chính hãng 100%</h3>
                    <h3 class="refund-text show-on-mobile">Chính hãng 100%</h3>
                    <div class="content-refund--detail-real">
                        <div class="refund-detail__header">Nhận lại gấp đôi số tiền mà bạn đã thanh toán
                            cho sản phẩm không chính hãng từ Shopee Mall.</div>
                    </div>
                </div>
                <div class="content-refund content-refund__free-ship">
                    <i class="content-refund--icon fas fa-shipping-fast"></i>
                    <h3 class="refund-text show-on-pc">Miễn phí vận chuyển</h3>
                    <h3 class="refund-text show-on-mobile">Giao miễn phí</h3>
                    <div class="content-refund--detail-ship">
                        <div class="refund-detail__header">Ưu đãi miễn phí vận chuyển lên tới 40,000 VNĐ
                            cho đơn hàng của Shopee Mall từ 150,000 VNĐ.</div>
                    </div>
                </div>
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