<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tentang Kami</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Tentang Kami</h3>
    <p> <a href="home.php">Beranda</a> / Tentang Kami </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about.jfif" alt="">
        </div>

        <div class="content">
            <h3>Mengapa Memilih Kami?</h3>
            <p>Dengan situs penjualan online kami yang mudah diakses dan mudah digunakan, temukan parfum terbaik.</p>
            <a href="shop.php" class="btn">Belanja Sekarang</a>
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about.webp" alt="">
        </div>

        <div class="content">
            <h3>Siapa Kami?</h3>
            <p>Dibuat pada Mei 2012, Parfum Ku adalah situs e-commerce No. 1 di Indonesia dengan tujuan dan visi untuk menyediakan parfum dengan harga terbaik untuk semua orang Indonesia.</p>
            <a href="#reviews" class="btn">Ulasan Pelanggan</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">Ulasan Pelanggan</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Nour</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Salma</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia animi consequatur nostrum cumque itaque ducimus, iure expedita voluptates. Minima, minus.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Hasnaa</h3>
        </div>

    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
