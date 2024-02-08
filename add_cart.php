<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css
" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<?php
include('server.php');
session_start();

$user_id = $_SESSION['user_id'];
$plant_id = $_POST['plant_id'];
$quantity = $_POST['quantity'];

$sql_c = "SELECT * from cart_tbl where user_id = $user_id and plant_id = $plant_id";
// print_r($sql_c);
$qr_c = $conn->query($sql_c);

if ($qr_c->num_rows > 0) {
    $row = $qr_c->fetch_array();
    $quantity = $row['quantity'] + $quantity;
    $sql_update = "UPDATE cart_tbl set quantity = $quantity where user_id = $user_id and plant_id = $plant_id";
    $qr_update = $conn->query($sql_update);
    echo "
        <script>
        $(document).ready(function(){
            Swal.fire({
                position: 'top',
                type: 'success',
                icon: 'success',
                title: 'Update Cart Successfully',
            });
        });
        </script>
        ";
    header("refresh:2; url=index.php");
} else {
    $sql_insert = "INSERT into cart_tbl (user_id, plant_id, quantity) values ($user_id, $plant_id, $quantity)";
    $qr_inert = $conn->query($sql_insert);
    echo "
        <script>
        $(document).ready(function(){
            Swal.fire({
                position: 'top',
                type: 'success',
                icon: 'success',
                title: 'Add Cart Successfully',
            });
        });
        </script>
        ";
    header("refresh:2; url=index.php");
}
