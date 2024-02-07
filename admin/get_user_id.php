<?php
include('../server.php');
session_start();

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $sql_g = "SELECT * from user_tbl where user_id= $user_id ";
    $qr_g = $conn->query($sql_g);
    $row = $qr_g->fetch_array();
}
?>

<h3 class="font-bold text-lg">Edit user</h3>
<div class="flex flex-col my-3">
    <label for="">Username</label>
    <input type="text" class="bg-gray-50 outline-none duration-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="" required disabled value="<?php echo $row['username'] ?>" id="">
</div>
<div class="flex flex-col">
    <label for="">Email</label>
    <input type="text" class="bg-gray-50 outline-none duration-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="" required disabled value="<?php echo $row['email'] ?>" id="">
</div>
<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
<div class="mt-2">
    <label for="">Status user</label>
    <select name="status" id="" class="border w-full py-2 rounded-lg outline-none px-2">
        <option value="select" hidden class="text-slate-200"><?php echo $row['status'] ?></option>
        <option value="user" class="">User</option>
        <option value="admin">Admin</option>
    </select>
</div>
<div class="modal-action">
    <button class="btn bg-black text-white hover:bg-slate-700" name="update_user">Agree</button>
    <label for="my_modal_8" class="btn">Close!</label>
</div>