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
include('../server.php');
session_start();

if (isset($_POST['addproduct'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $img = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $part = "../assets/img/product/";

    $uploaded = move_uploaded_file($tmp, $part . $img);

    if (!$img) {
        echo "
            <script>
            $(document).ready(function(){
                Swal.fire({
                    position: 'top',
                    type: 'error',
                    icon: 'error',
                    title: 'Please select image',
                });
            });
            </script>
            ";
        header("refresh:2; url=addproduct.php");
    } else {
        $sql_add = "INSERT into plant_tbl (`plant_name`, `plant_type`, `price`, `discount`, `plant_img`) values ('$name','$type','$price','$discount','$img')";
        $qr_add = $conn->query($sql_add);
        echo "
            <script>
            $(document).ready(function(){
                Swal.fire({
                    position: 'top',
                    type: 'succrss',
                    icon: 'success',
                    title: 'Successfully added product',
                });
            });
            </script>
            ";
        header("refresh:2; url=addproduct.php");
    }
}
