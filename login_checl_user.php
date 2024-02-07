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

if (isset($_POST['btn_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * from user_tbl where email = '$email' and password = '$password'";
    $qr = $conn->query($sql);
    if (mysqli_num_rows($qr) >= 1) {
        $row = $qr->fetch_array();
        $_SESSION['user_id'] = $row['user_id'];
        echo "
            <script>
            $(document).ready(function(){
                Swal.fire({
                    position: 'top',
                    type: 'success',
                    icon: 'success',
                    title: 'Login Success',
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
                    title: 'something went wrong email and password',
                });
            });
        </script>";
        header("refresh:2; url=login.php");
    }
}
