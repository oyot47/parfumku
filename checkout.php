<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'Keranjang Anda kosong!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'Pesanan sudah diproses sebelumnya!';
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'Pesanan berhasil diproses!';
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Checkout Pesanan</h3>
    <p> <a href="home.php">Beranda</a> / Checkout </p>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['name'] ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '.$fetch_cart['quantity']  ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">Keranjang Anda kosong</p>';
        }
    ?>
    <div class="grand-total">Total : <span>Rp. <?php echo $grand_total; ?>/-</span></div>
</section>

<section class="checkout">

    <form action="" method="POST">

        <h3>Lakukan Pemesanan</h3>

        <div class="flex">
            <div class="inputBox">
                <span> Nama Anda:</span>
                <input type="text" name="name" placeholder="masukkan nama Anda">
            </div>
            <div class="inputBox">
                <span>Nomor Anda :</span>
                <input type="number" name="number" min="0" placeholder="masukkan nomor Anda">
            </div>
            <div class="inputBox">
                <span>Email Anda :</span>
                <input type="email" name="email" placeholder="masukkan email Anda">
            </div>
            <div class="inputBox">
                <span> Metode Pembayaran:</span>
                <select name="method">
                    <option value="cash on delivery">Bayar di Tempat</option>
                    <option value="credit card">Kartu Kredit</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Nomor Rumah :</span>
                <input type="text" name="flat" placeholder="contoh: nomor flat">
            </div>
            <div class="inputBox">
                <span>Alamat :</span>
                <input type="text" name="street" placeholder="contoh: nama jalan">
            </div>
            <div class="inputBox">
                <span>Kota :</span>
                <input type="text" name="city" placeholder="contoh: Jakarta">
            </div>
            <div class="inputBox">
                <span>Provinsi :</span>
                <input type="text" name="state" placeholder="contoh: DKI Jakarta">
            </div>
            <div class="inputBox">
                <span>Negara :</span>
                <input type="text" name="country" placeholder="contoh: Indonesia">
            </div>
            <div class="inputBox">
                <span>Kode Pos :</span>
                <input type="number" min="0" name="pin_code" placeholder="contoh: 123456">
            </div>
        </div>

        <input type="submit" name="order" value="pesan sekarang" class="btn">

    </form>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
