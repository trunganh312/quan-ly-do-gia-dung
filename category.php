<?php
include_once "connection.php";
$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';
$sql = "SELECT * FROM categories ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
?>
        <li class="category-item <?php if ($categoryId == $row['category_id']) {
                                        echo 'category-item--active';
                                    } ?> ">
            <a href="index.php?categoryId=<?php echo $row['category_id']; ?>" class="category-item__link"><?php echo $row['category_name']; ?></a>
        </li>
<?php
    }
}

?>