<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
    <?php include('head.php') ?>
    <link rel="shortcut icon" href="assets/img/logo (2).png" type="image/x-icon">
    <title>Shop plants</title>
</head>

<body>
    <?php include('navbar.php') ?>
    <!-- slide banner -->
    <div class="banner" id="banner">
        <div class="img max-sm:flex max-sm:justify-center max-sm:text-center max-sm:h-[350px] max-full max-h-screen overflow-hidden">
            <img src="assets/img/banner.jpg" class="" alt="">
        </div>
        <div class="text-img absolute inset-x-0 mx-auto lg:top-64 text-center lg:w-[650px] max-sm:w-[450px] sm:top-36 max-sm:top-36 md:top-36">
            <p class="font-bold lg:text-3xl mb-2 max-sm:text-2xl sm:text-2xl md:text-2xl">Welcome to Shop Plant</p>
            <p class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Assumenda veritatis magni autem commodi officiis explicabo recusandae sunt aliquam deleniti. Maiores magnam laborum, sint sit iusto vero a maxime voluptatum impedit!</p>
            <button class="bg-green-600 text-white py-3 px-6 rounded-full mt-2 hover:bg-green-400 duration-150 ease">
                Get Started
            </button>
        </div>
    </div>

    <!-- card-plant -->
    <div class="card-slide-plant lg:px-40 my-12">
        <div class="title-plant">
            <p class="font-bold text-2xl mb-5 ms-28 ps-2">New Product</p>
        </div>
        <div class="swiper w-[100%] relative h-[350px] flex justify-center">
            <div class="swiper-container mySwiper w-[80%]">
                <div class="swiper-wrapper">
                    <?php
                    $sql = "SELECT * FROM `plant_tbl` ORDER BY `plant_tbl`.`plant_id` DESC";
                    $qr_product = $conn->query($sql);
                    if ($qr_product->num_rows > 0) {
                        foreach ($qr_product as $row) {
                    ?>
                            <div class="swiper-slide">
                                <div class="card-plant w-60 overflow-hidden rounded-md bg-white shadow" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="card-body-product">
                                        <img class="h-40 w-full bg-no-repeat bg-center bg-cover object-cover" src="assets/img/product/<?php echo $row['plant_img'] ?>" alt="">
                                    </div>
                                    <div class="card-contact p-3">
                                        <p class="name-product text-green-600 text-lg"><?php echo $row['plant_name'] ?></>
                                        <div class="text-cantact">
                                            <p><?php echo $row['price'] ?> บาท</p>
                                        </div>
                                        <div class="card-footer">
                                            <button class="bg-black text-white w-full py-2 rounded-md my-2">Add Card</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="card-no-product flex justify-center w-full">
                            <p class="text-center">สินค้าหมด</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="service lg:px-40 my-12 max-sm:flex justify-center flex-col sm:px-0" id="service">
        <p class="text-2xl font-bold text-center">Service</p>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 justify-items-center my-5">
            <div class="card-items w-76 h-[300px] bg-white p-5 rounded-md shadow grid grid-rows-2 justify-items-center hover:translate-y-5 duration-200 ease-out m-5" data-aos="fade-up" data-aos-duration="1000">
                <div class="rounded-full bg-white overflow-hidden flex items-center justify-center p-5 w-[85px] h-[85px] shadow">
                    <i class="fa-solid fa-seedling text-4xl m-0"></i>
                </div>
                <div class="text-service text-center w-60">
                    <p class="text-lg font-bold">Consultation</p>
                    <span class="text-sm">This service can include providing advice on plant care aspects such as watering, fertilizing, and managing diseases and pests</span>
                </div>
            </div>
            <div class="card-items w-76 h-[300px] bg-white p-5 rounded-md shadow grid grid-rows-2 justify-items-center hover:translate-y-5 duration-200 ease-out m-5" data-aos="fade-up" data-aos-duration="1300">
                <div class="rounded-full bg-white overflow-hidden flex items-center justify-center p-5 w-[85px] h-[85px] shadow">
                    <i class="fa-solid fa-truck text-4xl m-0"></i>
                </div>
                <div class="text-service text-center w-60">
                    <p class="text-lg font-bold">Delivery</p>
                    <span class="text-sm">Providing fast and secure delivery services to ensure that plants reach customers in good condition</span>
                </div>
            </div>
            <div class="card-items w-76 h-[300px] bg-white p-5 rounded-md shadow grid grid-rows-2 justify-items-center hover:translate-y-5 duration-200 ease-out m-5" data-aos="fade-up" data-aos-duration="1500">
                <div class="rounded-full bg-white overflow-hidden flex items-center justify-center p-5 w-[85px] h-[85px] shadow">
                    <i class="fa-solid fa-book-open text-4xl m-0"></i>
                </div>
                <div class="text-service text-center w-60">
                    <p class="text-lg font-bold">Plant History Content</p>
                    <span class="text-sm">Creating a knowledge hub related to plant care and the benefits of growing plants at home</span>
                </div>
            </div>
        </div>
    </div>

    <div class="product lg:px-56 my-12 max-sm:px-12" id="about">
        <h1 class="text-2xl font-bold">Product</h1>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-5 my-5">

            <?php
            $limit = 8;
            if (isset($_GET['loadmore'])) {
                $loremore = $_GET['loadmore'] = 8;
                $limit = $loremore + 8;
            }
            $sql = "SELECT * FROM plant_tbl Limit $limit";
            $qr = $conn->query($sql);
            if ($qr->num_rows > 0) {
                foreach ($qr as $product) {
            ?>
                    <div class="card-product w-60 bg-white rounded-md overflow-hidden shadow hover:scale-105 duration-150 ease-out" data-aos="fade-up" data-aos-duration="1500">
                        <div class="card-body-product relative">
                            <img src="assets/img/product/<?php echo $product['plant_img'] ?>" class="object-cover h-40 w-full" alt="">
                            <div class="discount absolute top-0 left-0 bg-green-700 text-white rounded-r-sm px-2">
                                <p><?php echo $product['discount'] ?></p>
                            </div>
                        </div>
                        <div class="card-contect p-3">
                            <div class="flex justify-between">
                                <p class="text-base font-bold"><?php echo $product['plant_name'] ?></p>
                                <p class="font-bold text-lg text-red-500">$<?php echo $product['price'] ?></p>
                            </div>
                            <div class="flex my-2">
                                <div class="bg-green-700 rounded-full text-white px-2 shadow">
                                    <p class="text-sm"><?php echo $product['plant_type'] ?></p>
                                </div>
                            </div>
                            <div class="star flex items-center">
                                <i class="fa-solid text-yellow-500 fa-star"></i>
                                <p class="px-1">4.2</p>
                            </div>
                            <button class="w-full bg-black text-white rounded-md py-2 my-2">Add to card</button>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="card-no-product flex justify-center w-full">
                    <p class="text-center">ไม่มีสินค้า</p>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        if (count($product) > 8) {
        ?>
            <div class="w-full flex justify-center">
                <a href="index.php?loadmore" class="text-center py-2 px-4 bg-black text-white load-more">Load more</a>
            </div>
        <?php
        } else{
            echo '';
        }
        ?>
    </div>


    <footer class="bg-black text-white dark:bg-gray-900 border-t-2">
        <div class="mx-auto w-full max-w-screen-xl">
            <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4">
                <div class="mb-6 md:mb-0">
                    <a href="index.php" class="flex items-center">
                        <img src="assets/img/logo (2).png" class="h-8 me-3 bg-white rounded-full" alt="FlowBite Logo" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Shop plant</span>
                    </a>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Company</h2>
                    <ul class="text-white-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#banner" class=" hover:underline">Home</a>
                        </li>
                        <li class="mb-4">
                            <a href="#service" class="hover:underline">Service</a>
                        </li>
                        <li class="mb-4">
                            <a href="#product" class="hover:underline">Product</a>
                        </li>
                        <li class="mb-4">
                            <a href="#blog" class="hover:underline">Blog</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Help center</h2>
                    <ul class="text-white dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">GitHub</a>
                        </li>
                        <li class="mb-4">
                            <a href="" class="hover:underline">Facebook</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Email</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Legal</h2>
                    <ul class="text-white dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Licensing</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="px-4 py-6 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">© 2023 <a href="https://flowbite.com/">Flowbite™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                            <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                            <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Dribbble account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
                1040: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1240: {
                    slidesPerView: 4,
                    spaceBetween: 95,
                }
            },
        });
    </script>
    </script>

    <script src="assets/js/main.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>