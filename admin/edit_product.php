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


if (isset($_POST['edit_product'])) {
    $name = $_POST['name_p'];
    $type = $_POST['type_p'];
    $price = $_POST['price_p'];
    $discount = $_POST['discount_p'];
    $img = $_FILES['img_p']['name'];
    $tmp_name = $_FILES['img_p']['tmp_name'];

    $plant_id = $_POST['plant_id'];
    $part = "../assets/img/product/";

    $uploaded = move_uploaded_file($tmp_name, $part . $img);
    $sql_p = "UPDATE plant_tbl set plant_name = '$name', plant_type = '$type', price = '$price', discount = '$discount' where plant_id = $plant_id";
    $qr_p = $conn->query($sql_p);
    echo "
            <script>
            $(document).ready(function(){
                Swal.fire({
                    position: 'top',
                    type: 'succrss',
                    icon: 'success',
                    title: 'Successfully Edit product',
                });
            });
            </script>
            ";
    header("refresh:2; url=editproduct.php");

    if ($img) {
        $sql_p_img = "UPDATE plant_tbl set plant_img = '$img' where plant_id = $plant_id";
        $qr_p_img = $conn->query($sql_p_img);
        echo "
        <script>
        $(document).ready(function(){
            Swal.fire({
                position: 'top',
                type: 'success',
                icon: 'success',
                title: 'image updated successfully',
            });
        });
        </script>
        ";
        header("refresh:2; url=editproduct.php");
    } else {
        echo "
        <script>
        $(document).ready(function(){
            Swal.fire({
                position: 'top',
                type: 'error',
                icon: 'question',
                title: 'Please select image product',
            });
        });
        </script>
        ";
        header("refresh:2; url=editproduct.php");
    }
}
