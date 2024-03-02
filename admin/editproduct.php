<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include('../server.php');
session_start();

if (!$_SESSION['user_id']) {
    header('location: ../login.php');
}

$user_id = $_SESSION['user_id'];
$sql_admin = "SELECT * from user_tbl where user_id = $user_id";
$qr_admin = $conn->query($sql_admin);
$row = $qr_admin->fetch_array();

if ($row['status'] == 'user') {
    header('location: ../index.php');
}

// delete  product to get
if (isset($_GET['delete_product'])) {
    $delete_p = $_GET['delete_product'];

    $sql_delete_p = "DELETE from plant_tbl where plant_id = $delete_p";
    $qr_delete_p = $conn->query($sql_delete_p);

    echo "
    <script>
    $(document).ready(function(){
        Swal.fire({
            position: 'top',
            type: 'success',
            icon: 'success',
            title: 'Delete Product Success'
        });
    });
    </script>
    ";
    header("refresh:2; url=editproduct.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../head.php'); ?>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="shortcut icon" href="../assets/img/EA.png" type="image/x-icon">
    <title>Edit Product</title>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="product lg:px-56 my-12 max-sm:px-12" id="about">
        <div class="head flex justify-between">
            <h1 class="text-2xl font-bold">Edit Product</h1>
            <form action="search.php" method="post" class="search flex items-center border rounded-md overflow-hidden">
                <input type="text" name="search" class="px-2 outline-none" placeholder="Search" id="">
                <button class="fa-solid fa-magnifying-glass bg-black text-white py-2 px-3"></button>
            </form>
        </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-5 my-5">
            <?php
            $sql = "SELECT * FROM plant_tbl";
            $qr = $conn->query($sql);
            if ($qr->num_rows > 0) {
                foreach ($qr as $product) {
                    $discount = $product['discount'];
                    $price_old = $product['price'];
                    $price = $price_old - ($price_old * $discount / 100);
            ?>
                    <div class="card-product w-60 bg-white rounded-md overflow-hidden shadow hover:scale-105 duration-150 ease-out">
                        <div class="card-body-product relative">
                            <img src="../assets/img/product/<?php echo $product['plant_img'] ?>" class="object-cover h-40 w-full" alt="">
                            <div class="discount absolute top-0 left-0 bg-green-700 text-white rounded-r-sm px-2">
                                <p><?php echo $product['discount'] ?>%</p>
                            </div>
                            <div class="delete absolute top-0 right-0 bg-red-500 text-white rounded-l-sm px-2">
                                <a href="editproduct.php?delete_product=<?php echo $product['plant_id'] ?>"><i class="fa fa-trash-can m-1"></i></a>
                            </div>
                        </div>
                        <div class="card-contect p-3">
                            <div class="flex justify-between">
                                <p class="text-base font-bold"><?php echo $product['plant_name'] ?></p>
                                <p class="font-bold text-lg text-red-500">$<?php echo $price ?></p>
                            </div>
                            <div class="flex my-2">
                                <div class="bg-green-700 rounded-full text-white px-2 shadow">
                                    <p class="text-sm"><?php echo $product['plant_type'] ?></p>
                                </div>
                            </div>
                            <div class="star flex items-center">
                                <i class="fa-solid text-yellow-500 fa-star"></i>
                                <p class="px-1">4.2</p>
                            </div>
                            <button class="btn w-full bg-black text-white hover:bg-slate-700" onclick="openmodal_product(<?php echo $product['plant_id'] ?>)"><i class="fa fa-edit text-white"></i>Edit Product</button>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="card-no-product flex justify-center w-full">
                    <p class="text-center">ไม่มีสินค้า</p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- ajax modal edit user -->
    <script>
        function openmodal_product(plantid) {
            $.ajax({
                url: 'get_product_id.php',
                type: 'POST',
                data: {
                    plant_id: plantid
                },
                success: function(data) {
                    $('.modal-box').html(data);
                    $('#my_modal_7').prop('checked', true); // เปิด Modal
                }
            })
        }
    </script>

    <!-- modal edit product -->
    <input type="checkbox" id="my_modal_7" class="modal-toggle" />
    <form action="edit_product.php" method="post" enctype="multipart/form-data" class="modal" role="dialog">
        <div class="modal-box">

        </div>
    </form>
</body>
<script src="../assets/js/main.js"></script>

</html>