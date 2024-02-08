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
            type: 'error',
            icon: 'error',
            title: 'You not admin'
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
    <title>Edit Product</title>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="product lg:px-56 my-12 max-sm:px-12" id="about">
        <h1 class="text-2xl font-bold">Edit Product</h1>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-5 my-5">
            <?php
            $sql = "SELECT * FROM plant_tbl";
            $qr = $conn->query($sql);
            if ($qr->num_rows > 0) {
                foreach ($qr as $product) {
            ?>
                    <div class="card-product w-60 bg-white rounded-md overflow-hidden shadow hover:scale-105 duration-150 ease-out">
                        <div class="card-body-product relative">
                            <img src="../assets/img/product/<?php echo $product['plant_img'] ?>" class="object-cover h-40 w-full" alt="">
                            <div class="discount absolute top-0 left-0 bg-green-700 text-white rounded-r-sm px-2">
                                <p><?php echo $product['discount'] ?></p>
                            </div>
                            <div class="delete absolute top-0 right-0 bg-red-500 text-white rounded-l-sm px-2">
                                <a href="editproduct.php?delete_product=<?php echo $product['plant_id'] ?>"><i class="fa fa-trash-can m-1"></i></a>
                            </div>
                        </div>
                        <div class="card-contect p-3">
                            <div class="flex justify-between">
                                <p class="text-base font-bold"><?php echo $product['plant_name'] ?></p>
                                <p class="font-bold text-lg text-red-500">$<?php echo $product['price'] ?></p>
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
                            <input type="hidden" name="plant_id" value="<?php echo $product['plant_id'] ?>">
                            <label for="my_modal_7" class="btn w-full bg-black text-white hover:bg-slate-700">Edit Product</label>
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

    <!-- modal edit product -->
    <input type="checkbox" id="my_modal_7" class="modal-toggle" />
    <form action="edit_product.php" method="post" enctype="multipart/form-data" class="modal" role="dialog">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Edit Product</h3>
            <div class="flex flex-col my-2">
                <label for="" class="font-bold">Name</label>
                <input type="text" name="name_p" placeholder="Name" required value="<?php echo $product['plant_name'] ?>" class="border outline-none py-2 px-2 rounded-md">
            </div>
            <div class="flex flex-col my-2">
                <label for="" class="font-bold">Type</label>
                <input type="text" name="type_p" placeholder="Type" value="<?php echo $product['plant_type'] ?>" required class="border outline-none py-2 px-2 rounded-md">
            </div>
            <div class="flex flex-col my-2">
                <label for="" class="font-bold">Price</label>
                <input type="number" name="price_p" placeholder="Price" required value="<?php echo $product['price'] ?>" class="border outline-none py-2 px-2 rounded-md">
            </div>
            <div class="flex flex-col my-2">
                <label for="" class="font-bold">Discount</label>
                <input type="number" name="discount_p" placeholder="Discount" value="<?php echo $product['discount'] ?>" required class="border outline-none py-2 px-2 rounded-md">
            </div>
            <input type="hidden" name="plant_id" value="<?php echo $product['plant_id'] ?>">
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file" value="<?php echo $product['plant_img'] ?>" type="file" name="img_p" class="hidden" />
                </label>
            </div>
            <div class="modal-action">
                <button name="edit_product" class="bg-black btn text-white hover:bg-slate-700">Agree</button>
                <label for="my_modal_7" class="btn bg-red-500 text-white">Close!</label>
            </div>
        </div>
    </form>
</body>
<script src="../assets/js/main.js"></script>

</html>