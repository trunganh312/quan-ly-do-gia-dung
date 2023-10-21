<ul style="display: flex; justify-content: center; gap: 20px; align-items: center">
    <?php
    $recordsPerPage = 10;

    // Trang hiện tại
    $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

    // Tính toán vị trí bắt đầu
    $startIndex = ($currentpage - 1) * $recordsPerPage;

    include_once "connection.php";

    $countSql = "SELECT COUNT(*) FROM products";
    $countResult = $conn->query($countSql);
    $totalRecords = $countResult->fetch_row()[0];
    echo  '<li class="pagination-item">
        <a href="?page=1" class="pagination-item__link">
            <i class="pagination-item__icon fas fa-angle-left"></i>
        </a>
    </li>';

    // Tính toán số trang
    $totalPages = ceil($totalRecords / $recordsPerPage);

    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentpage) {
            $pagination .= "  <li style='padding: 5px 10px; border-radius: 5px; background-color: orange; color: white'><a href='?page=$i' >$i</a></li>";
        } else {
            $pagination .= "  <li style='padding: 5px 10px; border-radius: 5px; '>
        <a href='?page=$i' >
            $i
        </a>
        </li>";
        }
    }
    echo $pagination;

    echo ' <li class="pagination-item">
        <a href="?page=' . $totalPages . '" class="pagination-item__link">
            <i class="pagination-item__icon fas fa-angle-right"></i>
        </a>
    </li>'

    ?>
</ul>