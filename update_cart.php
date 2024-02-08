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

$quantity = $_POST['quantity'];
$cart_id = $_POST['cart_id'];

$sql_update_cart = "UPDATE cart_tbl set quantity = $quantity where cart_id = $cart_id";
$qr_update_cart = $conn->query($sql_update_cart);
if ($sql_update_cart) {
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
    header("refresh:2; url=cart.php");
}else{
    echo "
    <script>
    $(document).ready(function(){
        Swal.fire({
            position: 'top',
            type: 'error',
            icon: 'error',
            title: 'Update Cart Failed',
        });
    });
    </script>
    ";
    header("refresh:2; url=cart.php");
}
?>