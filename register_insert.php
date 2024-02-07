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

if (isset($_POST['register_create_user'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['user'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $password = $_POST['password'];

    $sql_register = "INSERT INTO user_tbl (`fullname`, `username`, `password`, `email`, `sex`) values ('$fullname', '$username', '$password', '$email', '$sex')";
    $qr = mysqli_query($conn, $sql_register);
    echo "
            <script>
                $(document).ready(function(){
                    Swal.fire({
                        position: 'top',
                        type: 'success',
                        icon: 'success',
                        title: 'Create new user successfully',
                    });
                });
            </script>
        ";

    header("refresh:3; url=login.php");
} else {
    echo "
    <script>
    $(document).ready(function(){
        Swal.fire({
            position: 'top',
            type: 'error',
            icon: 'error',
            title: 'something went registered wrong',
        });
    });
</script>";
    header("refresh:2; url=register.php");
}
