<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include('server.php');
session_start();

if (!$_SESSION['user_id']) {
    header('location: ../login.php');
}

$user_id = $_SESSION['user_id'];
$sql_admin = "SELECT * from user_tbl where user_id = $user_id";
$qr_admin = $conn->query($sql_admin);
$row = $qr_admin->fetch_array();


// delete  product to get
if (isset($_GET['delete_cart'])) {
    $delete_p = $_GET['delete_cart'];

    $sql_delete_p = "DELETE from cart_tbl where cart_id = $delete_p";
    $qr_delete_p = $conn->query($sql_delete_p);

    echo "
    <script>
    $(document).ready(function(){
        Swal.fire({
            position: 'top',
            type: 'success',
            icon: 'success',
            title: 'Delete Cart Successfully',
        });
    });
    </script>
    ";
    header("refresh:2; url=cart.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="shortcut icon" href="assets/img/EA.png" type="image/x-icon">
    <title>Edit Product</title>
</head>

<body>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" id="togglemenu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
              Icon when menu is closed.
  
              Menu open: "hidden", Menu closed: "block"
            -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!--
              Icon when menu is open.
  
              Menu open: "block", Menu closed: "hidden"
            -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1  justify-center sm:items-stretch sm:justify-start">
                    <a href="##" class="flex flex-shrink-0 items-center">
                        <img class="h-8 w-auto" src="assets/img/EA.png" alt="Your Company" />
                        <p class="text-white" style="margin: 0;">Game shop</p>
                    </a>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="index.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                            <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Service</a>
                            <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Product</a>
                            <a href="cart.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">My Cart</a>
                        </div>
                    </div>
                </div>
                <div class="">
                    <!-- <a href="/login" class="me-5 bg-orange-500 text-white py-2 px-5 rounded-lg hover:bg-orange-400 duration-150 ease-in hover:shadow-md">Sign-in</a> -->
                    <div class="profile rounded-full overflow-hidden border-none" id="profile_btn">
                        <label>
                            <img class="cursor-pointer  w-[35px] h-[35px] object-cover" src="assets/img/<?php echo $row['profile_img']; ?>" alt="">
                        </label>
                    </div>
                    <div class="dropdow_profile absolute top-16" id="dropdown_profile">
                        <form action="" method="post" id="dropdown" class="z-10 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2" aria-labelledby="dropdownButton">
                                <li>
                                    <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <a href="admin/index.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Admin</a>
                                </li>
                                <li>
                                    <input type="submit" value="Logout" href="#" name="logout" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden menumoblie" id="mobilemenu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="index.php" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
                <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Service</a>
                <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Product</a>
                <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Contact</a>
            </div>
        </div>
    </nav>

    <div class="product lg:px-56 my-12 max-sm:px-12" id="about">
        <div class="head flex justify-between">
            <h1 class="text-2xl font-bold">Edit MyCart</h1>
            <form action="search_cart.php" method="post" class="search flex items-center border rounded-md overflow-hidden">
                <input type="text" name="search" class="px-2 outline-none" placeholder="Search" id="">
                <button class="fa-solid fa-magnifying-glass bg-black text-white py-2 px-3"></button>
            </form>
        </div>
        <?php
        $user_id = $_SESSION['user_id'];
        $sql_p =  "SELECT cart_tbl.user_id, SUM(cart_tbl.quantity * plant_tbl.price) AS total_price
            FROM cart_tbl
            JOIN plant_tbl ON cart_tbl.plant_id = plant_tbl.plant_id 
            where cart_tbl.user_id = $user_id
            GROUP BY cart_tbl.user_id";
        $qr_p = $conn->query($sql_p);
        $row_p = $qr_p->fetch_array();
        ?>

        <?php
        if (!is_null($row_p) && $row_p['total_price'] !== null) {
        ?>
            <div class="mt-5">
                <p class="font-bold text-right">รวมทั้งหมด <?php echo $row_p['total_price'] ?> บาท</p>
            </div>
        <?php
        } else {
        ?>
            <div class="mt-5">
                <p class="font-bold text-right">รวมทั้งหมด 0 บาท</p>
            </div>
        <?php
        }
        ?>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_c =  "SELECT user_tbl.*, plant_tbl.*, cart_tbl.* FROM cart_tbl 
                    INNER JOIN user_tbl on cart_tbl.user_id = user_tbl.user_id 
                    INNER JOIN plant_tbl on cart_tbl.plant_id = plant_tbl.plant_id where $user_id = cart_tbl.user_id";
                    $qr_c = $conn->query($sql_c);
                    if ($qr_c->num_rows > 0) {
                        foreach ($qr_c as $cart) {
                            $discount = $cart['discount'];
                            $price_old = $cart['price'];
                            $price = $price_old - ($price_old * $discount / 100);

                            $price = $price * $cart['quantity'];
                    ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $cart['plant_name'] ?>
                                </th>
                                <td class="px-6 py-4">
                                    <img src="assets/img/product/<?php echo $cart['plant_img'] ?>" alt="" class="w-20 h-20 object-cover rounded-md">
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $cart['quantity'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $price ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $cart['created_at'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="fa-regular fa-pen-to-square btn text-blue-500" onclick="openmodal_cart(<?php echo $cart['cart_id'] ?>)"></button>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="cart.php?delete_cart=<?php echo $cart['cart_id'] ?>" class="fa fa-trash-can text-red-500 btn"></a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan='10' class='text-center py-3'>ไม่มีสินค้า</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- ajax modal edit user -->
    <script>
        function openmodal_cart(cartid) {
            $.ajax({
                url: 'get_cart_id.php',
                type: 'POST',
                data: {
                    cart_id: cartid
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
    <form action="update_cart.php" method="post" enctype="multipart/form-data" class="modal" role="dialog">
        <div class="modal-box">

        </div>
    </form>
</body>
<script src="../assets/js/main.js"></script>

</html>