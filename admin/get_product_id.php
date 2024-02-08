<?php
include('../server.php');
session_start();

if (isset($_POST['plant_id'])) {
    $plant_id = $_POST['plant_id'];

    $sql_g = "SELECT * from plant_tbl where plant_id = $plant_id ";
    $qr_g = $conn->query($sql_g);
    $product = $qr_g->fetch_array();
}
?>
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