<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css
" rel="stylesheet">

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
    header("refresh:2; url=../index.php");
}

if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $sql_delete = "DELETE from user_tbl where user_id = $delete";
    $qr_delete = $conn->query($sql_delete);
    echo "
    <script>
    $(document).ready(function(){
        Swal.fire({
            position: 'top',
            type: 'success',
            icon: 'success',
            title: 'Delete user successfully'
        });
    });
    </script>
    ";
    header("refresh:2; url=index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <?php include('../head.php') ?>
    <title>Admin Shop plant</title>
</head>

<body>
    <?php include('navbar.php') ?>
    <!-- component -->
    <div class="">
        <div class="flex items-center my-5 w-full justify-center">

            <div class="max-w-xs">
                <div class="bg-white shadow-xl rounded-lg py-3">
                    <div class="photo-wrapper p-2">
                        <img class="w-32 h-32 rounded-full mx-auto object-cover" src="../assets/img/<?php echo $row['profile_img'] ?>" alt="Admin">
                    </div>
                    <div class="p-2">
                        <h3 class="text-center text-xl text-gray-900 font-medium leading-8"><?php echo $row['fullname'] ?></h3>
                        <div class="text-center text-gray-400 text-xs font-semibold">
                            <p><?php echo $row['status'] ?></p>
                        </div>
                        <table class="text-xs my-3">
                            <tbody>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Username</td>
                                    <td class="px-2 py-2"><?php echo $row['username'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Password</td>
                                    <td class="px-2 py-2"><?php echo $row['password'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Email</td>
                                    <td class="px-2 py-2"><?php echo $row['email'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="my-3 flex items-center justify-center">
                            <p class="text-base text-blue-500 me-1">access</p>
                            <i class="fas fa-circle-check text-base text-green-500"></i>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-16 mb-12" id="showuser">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fullname
                        </th>
                        <th scope="col" class="px-6 py-3">
                            username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Password
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delete
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conut = 1;
                    $sql_user = "SELECT * from user_tbl";
                    $qr_user = $conn->query($sql_user);
                    if ($qr_user->num_rows > 0) {
                        foreach ($qr_user as $user) {
                    ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $conut++ ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $user['fullname'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $user['username'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $user['password'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $user['email'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="btn" onclick="openmodal(<?php echo $user['user_id']?>)"><i class="fa fa-edit text-blue-500"></i></button>
                                </td>
                                <td class="px-6 py-4">
                                    <a class="btn" href="index.php?delete=<?php echo $user['user_id'] ?>"><i class="fa fa-trash-can text-red-500"></i></a>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                    if ($user['status'] == 'user') {
                                    ?>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-user text-green-500 text-lg me-2"></i>
                                            <p><?php echo $user['status'] ?></p>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-user-tie text-red-500 text-lg me-2"></i>
                                            <p><?php echo $user['status'] ?></p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ajax modal edit user -->
    <script>
        function openmodal(userid) {
            $.ajax({
                url: 'get_user_id.php',
                type: 'POST',
                data: {
                    user_id: userid
                },
                success: function(data) {
                    $('.modal-box').html(data);
                    $('#my_modal_8').prop('checked', true); // เปิด Modal
                }
            })
        }
    </script>

    <!-- modal edit user -->
    <!-- Put this part before </body> tag -->
    <?php

    ?>


    <input type="checkbox" id="my_modal_8" class="modal-toggle" />
    <div class="modal" role="dialog">
        <form action="user_update.php" method="post" class="modal-box">
            
        </form>
    </div>

    <script src="../assets/js/main.js"></script>
</body>

</html>