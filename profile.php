<?php
include("server.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login.php');
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * from user_tbl WHERE user_id = $user_id";
$qr  = $conn->query($sql);
$row = $qr->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('head.php') ?>
    <title>Profile</title>
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
                        <img class="h-8 w-auto" src="assets/img/EA.png" />
                        <p class="text-white" style="margin: 0;">Game shop</p>
                    </a>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="index.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                            <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Service</a>
                            <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Product</a>
                            <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="">
                    <!-- <a href="/login" class="me-5 bg-orange-500 text-white py-2 px-5 rounded-lg hover:bg-orange-400 duration-150 ease-in hover:shadow-md">Sign-in</a> -->
                    <div class="profile rounded-full overflow-hidden border-none" id="profile_btn">
                        <label>
                            <img class="cursor-pointer w-[35px] h-[35px] object-cover" src="assets/img/<?php echo $row['profile_img']; ?>" alt="" width="35" height="35">
                        </label>
                    </div>
                    <div class="dropdow_profile absolute top-16" id="dropdown_profile">
                        <form action="" method="post" id="dropdown" class="z-10 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2" aria-labelledby="dropdownButton">
                                <li>
                                    <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a> -->
                                </li>
                                <li>
                                    <input value="Logout" type="submit" name="logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"></input>
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
    <!-- component -->
    <!-- This is an example component -->

    <div class="max-w-4xl mx-auto mt-24">

        <div class="block md:flex">

            <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md rounded-md">
                <div class="flex justify-between">
                    <span class="text-xl font-semibold block">My Profile</span>
                    <label for="my_modal_6" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">Edit</label>
                </div>

                <span class="text-gray-600">This information is secret so be careful</span>
                <div class="w-full my-5 flex justify-center relative">
                    <img id="showImage" class="max-w-xs w-[150px] h-[150px] object-cover items-center border rounded-full " src="assets/img/<?php echo $row['profile_img'] ?>" alt="">
                    <?php
                    if ($row['status'] == 'admin') {
                    ?>
                        <i class="fa-solid fa-user-tie text-red-500 absolute bg-white rounded-full p-2 top-1 right-20 shadow"></i>
                    <?php
                    } else {
                    ?>
                        <i class="fa-solid fa-user text-green-500 absolute bg-white rounded-full p-2 top-1 right-20 shadow"></i>
                    <?php
                    }
                    ?>
                </div>
                <form action="profile_update.php" method="post" enctype="multipart/form-data" class="update-profile flex justify-center">
                    <label for="upload" class="bg-black btn text-white hover:bg-slate-700 px-2 py-2 rounded-md text-center">Upload profile</label>
                    <input type="file" name="profile" class="hidden" id="upload">
                    <button class="btn ms-3" name="update_profile">Confirm</button>
                </form>
            </div>

            <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md rounded-md">
                <div class="rounded  shadow p-6">
                    <div class="pb-6">
                        <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
                        <div class="flex">
                            <input disabled id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text" value="<?php echo $row['fullname'] ?>" />
                        </div>
                    </div>
                    <div class="pb-4">
                        <label for="about" class="font-semibold text-gray-700 block pb-1">Email</label>
                        <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" value="<?php echo $row['email'] ?>" />
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="assets/js/main.js"></script>
</body>

</html>



<!-- Put this part before </body> tag -->
<input type="checkbox" id="my_modal_6" class="modal-toggle" />
<form action="profile_update.php" method="post" class="modal" role="dialog">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Edit Profile</h3>
        <div class="flex flex-col my-2">
            <label for="" class="font-bold">Fullname</label>
            <input type="text" name="fullname" placeholder="fullname" required class="border outline-none py-2 px-2 rounded-md">
        </div>
        <div class="flex flex-col my-2">
            <label for="" class="font-bold">Username</label>
            <input type="text" name="username" placeholder="username" required class="border outline-none py-2 px-2 rounded-md">
        </div>
        <div class="flex flex-col my-2">
            <label for="" class="font-bold">Email</label>
            <input type="email" name="email" placeholder="email" required class="border outline-none py-2 px-2 rounded-md">
        </div>
        <div class="modal-action">
            <button name="update" class="bg-black btn text-white hover:bg-slate-700">Agree</button>
            <label for="my_modal_6" class="btn">Close!</label>
        </div>
    </div>
</form>