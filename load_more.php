<?php
// load_more.php
$start = $_POST['start'];
$limit = $_POST['limit'];

$sql = "SELECT * FROM plant_tbl LIMIT $start, $limit";
$qr = $conn->query($sql);

if ($qr->num_rows > 0) {
    while ($row = $qr->fetch_assoc()) {
        echo '<div class="product">' . $row['product_name'] . '</div>';
        // เพิ่มข้อมูลอื่น ๆ ตามต้องการ
    }
} else {
    echo 'ไม่มีข้อมูลเพิ่มเติม';
}
?>
