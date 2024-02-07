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

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user_id = $_SESSION['user_id'];

    $sql_update = "UPDATE user_tbl set fullname='$fullname', username='$username', email='$email' where user_id = $user_id";
    $qr_update = $conn->query($sql_update);
    if ($sql_update) {
        echo "
            <script>
            $(document).ready(function(){
                Swal.fire({
                    position: 'top',
                    type: 'success',
                    icon: 'success',
                    title: 'Update Success',
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
                    title: 'Update Error',
                });
            });
            </script>
            ";
        header("refresh:2; url=index.php");
    }
}

if (isset($_POST['update_profile'])) {
    $profile = $_FILES['profile']['name'];
    $tmp = $_FILES['profile']['tmp_name'];
    $user_id = $_SESSION['user_id'];
    $part = "assets/img/";

    $uploaded = move_uploaded_file($tmp, $part . $profile);

    if ($profile) {
        $sql_profile = "UPDATE user_tbl set profile_img = '$profile' where user_id = $user_id";
        $qr_profile = $conn->query($sql_profile);
        echo "
       <script>
       $(document).ready(function(){
           Swal.fire({
               position: 'top',
               type: 'success',
               icon: 'success',
               title: 'Update Success',
           });
       });
       </script>
       ";
        header('refresh:2; url=profile.php');
    } else {
        echo "
       <script>
       $(document).ready(function(){
           Swal.fire({
               position: 'top',
               type: 'error',
               icon: 'error',
               title: 'Update Error',
           });
       });
       </script>
       ";
        header('refresh:2; url=profile.php');
    }
}
