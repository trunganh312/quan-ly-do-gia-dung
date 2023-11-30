<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | Shop đồ gia dụng</title>
</head>

<body>
    <table id="customers" style="margin-top: 20px">
        <tr>
            <th style="min-width: 200px;">Tên người phản hồi</th>
            <th style="min-width: 100px;">Nội dung</th>
        </tr>
        <?php
        include 'connection.php';
        if (session_status() === PHP_SESSION_NONE) {
            // session_start();
        }


        $query = "SELECT rp.*, c.first_name, c.last_name
        FROM customers c 
        INNER JOIN reports rp ON c.customer_id = rp.customer_id";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Duyệt qua từng dòng kết quả
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td> <?php echo $row["first_name"]. " ". $row["last_name"]; ?></td>
            <td> <?php echo $row["report_content"]?></td>
        </tr>

        <?php
            }
        } else {
            echo "Không có người dùng nào nào";
        }
        ?>
    </table>
</body>

</html>