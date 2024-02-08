<?php
include('server.php');
session_start();

if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

    $sql_g = "SELECT * from cart_tbl where cart_id = $cart_id ";
    $qr_g = $conn->query($sql_g);
    $cart = $qr_g->fetch_array();
}
?>
<h3 class="font-bold text-lg">Edit Cart</h3>
<div class="flex flex-col my-2">
    <label for="" class="font-bold">Quantity</label>
    <input type="hidden" name="cart_id" value="<?php echo $cart['cart_id']?>">
    <input type="number" name="quantity" placeholder="Discount" value="<?php echo $cart['quantity'] ?>" required class="border outline-none py-2 px-2 rounded-md">
</div>
<div class="modal-action">
    <button name="edit_product" class="bg-black btn text-white hover:bg-slate-700">Agree</button>
    <label for="my_modal_7" class="btn bg-red-500 text-white">Close!</label>
</div>