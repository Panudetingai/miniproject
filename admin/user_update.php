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

if (isset($_POST['update_user'])) {
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];

    $sql_u = "UPDATE user_tbl SET status='$status' WHERE user_id ='$user_id'";
    $qr_u = $conn->query($sql_u);

    if ($sql_u) {
        echo "
    <script>
    $(document).ready(function(){
        Swal.fire({
            position: 'top',
            type: 'success',
            icon: 'success',
            title: 'Update user successfully'
        });
    });
    </script>
    ";
        header("refresh:2; url=index.php");
    } else {
        echo "
    <script>
    $(document).ready(function(){
        Swal.fire({
            position: 'top',
            type: 'error',
            icon: 'error',
            title: 'something wrong update user'
        });
    });
    </script>
    ";
        header("refresh:2; url=index.php");
    }
}
