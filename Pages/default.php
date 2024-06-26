<?php
session_start();
require_once '../src/RandevuManager.php';
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/DB.php'; // Veritabanı bağlantısı
require_once '../src/User.php';
require_once '../src/Appointment.php';
require_once '../src/sweetAlert.php';

use vipBerber\Berber;
use vipBerber\DB;
use vipBerber\RandevuManager;
use vipBerber\sweetAlert;
use vipBerber\User;
use vipBerber\BerberWorkingDay;
use vipBerber\BerberWorkingHour;



$conn = DB::connect() or die($conn->errorCode().' '. $conn->errorInfo());
$allBarbers = Berber::all();
$b = new Berber();
$hours = new BerberWorkingHour();



$user = User::find($_SESSION['user_id']);






/*
if (isset($_SESSION["Perm"]) && $_SESSION["Perm"] == 'Berber') {
    $lblUserName = "Hoş Geldiniz \n" . $_SESSION["Perm"] . " " . $_SESSION["BerberFullName"];
} else {
    $lblUserName = "Hoş Geldiniz \n" . $_SESSION["FullName"];
} 
*/
if (isset($_POST['btnRandevuAl'])) {
    $randevuManager = new RandevuManager();
    $berberId = $_POST['selectBerber'] ?? null;
    $selectBerber = $_POST['selectBerber'] ?? '';
    if ($berberId !== null && $berberId != 0) {
        $randevuManager->randevuAl($_POST['tarih'], $_POST['berbersaat'], $_SESSION['user_id'], $selectBerber);
        sweetAlert::showSweetAlert('Başarılı', 'Randevunuz başarıyla oluşturulmuştur.', 'success');
    } else {
        echo "Lütfen geçerli bir berber seçin";
    }
}

?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="tr">
<head>
<title>Men's Salon Beauty Category Flat Bootstrap Responsive Web Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="Men's Salon Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

	<!-- css files -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link href="..//web/css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="..//web/css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->

    <link href="..//web/css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->
	
	<!-- //css files -->
	
	<link href="..//web/css/css_slider.css" type="text/css" rel="stylesheet" media="all">

	<!-- google fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
	<!-- //google fonts -->
	
</head>
<body>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- header -->
<header>
	<div class="container">
		<!-- nav -->
		<nav class="py-md-4 py-3 d-lg-flex">
			<div id="logo">
				<h1> <a href="/default.php"><span class="fa fa-scissors"></span> Men's Salon</a></h1>
			</div>
			<label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
			<input type="checkbox" id="drop" />
			<ul class="menu mt-lg-4 ml-auto align-content-lg-start">
				<li class="active"><a href="default.php">Home</a></li>
				<li class="active"><a href="../login/login.php">Login</a></li>
				<li class=""><a href="../web\about.html">About Us</a></li>
				<li class=""><a href="../web\services.html">Services</a></li>
				<li class=""><a href="../web\gallery.html">Gallery</a></li>
                <li class=""><a href="../Pages/profile.php">Profile</a></li>
				<li class="mr-2"><a href="../web\contact.html">Contact</a></li>
				<li class=""><span><span class="fa fa-phone"></span> +12 34 3456 7890</span></li>
			</ul>
		</nav>
		<!-- //nav -->
	</div>
</header>
<!-- //header -->

<!-- banner -->
<section class="banner_w3lspvt" id="home">
	<div class="csslider infinity" id="slider1">
		<input type="radio" name="slides" checked="checked" id="slides_1" />
		<input type="radio" name="slides" id="slides_2" />
		<input type="radio" name="slides" id="slides_3" />
		<input type="radio" name="slides" id="slides_4" />
		<ul>
			<li>
				<div class="banner-top">
					<div class="overlay">
						<div class="container">
							<div class="w3layouts-banner-info">
								<h3 class="text-wh">We make your hair <span>look <span class="clr">perfect</span></span></h3>
								<h4 class="text-wh">We make your hair <span>look Great, perfect!</span></h4>
								<a href="about.html" class="button-style mt-4 mr-2">Read More</a>
								<a href="#about" class="button-style mt-4">Book Now</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="banner-top1">
					<div class="overlay">
						<div class="container">
							<div class="w3layouts-banner-info">
								<h3 class="text-wh">Skilled Barbers Make<span>Great <span class="clr">Beards</span></span></h3>
								<h4 class="text-wh">We make your hair <span>look Great, perfect!</span></h4>
								<a href="about.html" class="button-style mt-4 mr-2">Read More</a>
								<a href="#about" class="button-style mt-4">Book Now</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="banner-top2">
					<div class="overlay">
						<div class="container">
							<div class="w3layouts-banner-info">
								<h3 class="text-wh">We make your hair <span>look <span class="clr">perfect</span></span></h3>
								<h4 class="text-wh">We make your hair <span>look Great, perfect!</span></h4>
								<a href="about.html" class="button-style mt-4 mr-2">Read More</a>
								<a href="#about" class="button-style mt-4">Book Now</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="banner-top3">
					<div class="overlay">
						<div class="container">
							<div class="w3layouts-banner-info">
								<h3 class="text-wh">Skilled Barbers Make<span>Great <span class="clr">Beards</span></span></h3>
								<h4 class="text-wh">We make your hair <span>look Great, perfect!</span></h4>
								<a href="about.html" class="button-style mt-4 mr-2">Read More</a>
								<a href="#about" class="button-style mt-4">Book Now</a>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<div class="arrows">
			<label for="slides_1"></label>
			<label for="slides_2"></label>
			<label for="slides_3"></label>
			<label for="slides_4"></label>
		</div>
	</div>
</section>
<!-- //banner -->

<!-- about -->
<section class="about py-5" id="about">
	<div class="container py-lg-5">
		<div class="row about-grids">
			<div class="col-lg-8">
				<h2 class="mt-lg-3">Welcome to our Hair salon</h2>
				<h5 class="plane mt-md-4 mt-3">We make your hair <span>look Great, perfect!</span></h5>
				<p class="">Sed ut perspiciatis unde omnis iste natus error ipsum voluptatem ut accusa ntium dolor remque laudantium, totam rem
				aperiam, eaque ipsa quae abse illo quasi sed architecto beatae vitae dicta sut dolor etr explicabo. Morbi a luctus magna, eut rutrum
				turpis. Sed perspiciatis unde omnis iste natus error ipsum voluptatem ut accusantium dolor.</p>
				<p class="mt-3">Eaque ipsa quae abse illo quasi sed architecto beatae vitae dicta sut dolor etr explicabo. Morbi a luctus magna, eu rutrum
				turpis. Sed perspiciatis unde omnis iste natus error et ipsum voluptatem ut accusantium dolor voluptatem ut accusa ntium dolor.</p>
			</div>
			<div class="col-lg-4 col-md-8 mt-lg-0 mt-5">
				<div class="padding">
					<img src="../web/images/mustache.png" class="img-fluid" alt="" />
					<form action="default.php" method="post">
					<div class="form-group">
						<label for="name">Adınız:</label>
						<input type="text" class="form-control" id="name" name="name" required autofocus data-toggle="tooltip" value="<?= $user->user_full_name ?>" data-placement="top" title="Lütfen tam adınızı girin.">
					</div>
					<div class="form-group">
						<label for="number">İletişim Numarası:</label>
						<input type="text" class="form-control" id="number" name="number" required data-toggle=tooltip" value="<?= $user->user_telefon ?>" data-placement="top" title="Lütfen geçerli bir telefon numarası girin.">
					</div>
                        <div class="form-group">
                            <label for="selectBerber">Berber Seçin:</label>
                            <select class="form-control" id="selectBerber" name="selectBerber" data-toggle="tooltip" data-placement="top" title="Lütfen bir berber seçin.">
                                <option value="0" disabled selected>Berber Seçin</option>
                                <?php foreach ($allBarbers as $barber): ?>
                                    <option value="<?= $barber->berber_id; ?>"><?= $barber->full_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#selectBerber').change(function () {
                                        var berberId = $(this).val(); // Seçilen berberin ID'sini alıyoruz
                                        if (berberId !== '0') { // 0 seçeneği seçilmişse işlem yapma
                                            // AJAX isteği gönderiyoruz
                                            $.ajax({
                                                url: 'getBerberHours.php',
                                                type: 'GET',
                                                dataType: 'json',
                                                data: { berber_id: berberId }, // Berber ID'sini GET parametresi olarak gönderiyoruz
                                                success: function(data) {

                                                    // Veriyi kullanarak saat seçeneklerini doldurma
                                                    var selectSaat = $('#berbersaat');
                                                    selectSaat.empty(); // Önceki seçenekleri temizle
                                                    selectSaat.append('<option value="0" disabled>Saat Seçin</option>'); // Başlangıç seçeneği
                                                    // Veriden gelen saatleri doldurma
                                                    $.each(data, function(index, hour) {
                                                        selectSaat.append('<option value="' + hour + '">' + hour + '</option>');
                                                    });
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('AJAX Hatası:', status, error);
                                                    console.log(xhr.responseText); // Hata detaylarını konsola yazdırın
                                                }
                                            });
                                        } else {
                                            // Eğer 0 seçildiyse saat seçimini sıfırla
                                            $('#berbersaat').empty().append('<option value="0" disabled>Saat Seçin</option>');
                                        }
                                    });
                                });
                            </script>
                        </div>
					<div class="form-group">
						<label for="tarih">Tarih Seçin:</label>
						<input type="date" class="form-control" id="tarih" name="tarih" required autofocus data-toggle="tooltip" data-placement="top" title="Lütfen tam adınızı girin.">
					</div>
					<div class="form-group">
                        <label for="berbersaat">Saat Seçin:</label>
                        <select class="form-control" id="berbersaat" name="berbersaat" data-toggle="tooltip" data-placement="top" title="Lütfen bir saat seçin.">
                            <option value="0" disabled selected>Saat Seçin</option>

                        </select>
					</div>
                        <button type="submit" name="btnRandevuAl" class="btn btn-outline-success btn-lg btn-block">Randevu Al</button>
                    </form>
                    <button type="submit" name="btnRandevuAl" class="btn btn-outline-success btn-lg btn-block">
                    <a href="ShowAppointments.php" class="d-block">Randevularım</a>
                </div>
			</div>
		</div>
	</div>
</section>

<!-- //about -->
<!-- about bottom -->
<section class="bottom-banner-w3layouts">
	<div class="d-lg-flex">
		<div class="col-lg-7 p-lg-0 text-lg-right text-center mt-lg-0 mt-4 bottom-left">
		</div>
		<div class="col-lg-5 banner-about text-center">
			<span class="fa fa-scissors"></span>
				<h4 class="mt-sm-4 mt-2">making hair style</h4>
				<h5 class="bottom mt-m-4 mt-3">For man growing beards!</h5>
				<p class="">Sed ut perspiciatis unde omnis iste natus error ipsum voluptatem ut accusa ntium dolor remque laudantium, totam rem
				aperiam, eaque ipsa quae abse illo quasi sed architecto beatae vitae dicta sut dolor etr explicabo. Morbi a luctus magna, eu rutrum
				turpis. Sed perspiciatis unde.</p>
		</div>
	</div>
</section>
<!-- //about bottom -->

<!-- services -->
<section class="services py-5" id="services">
	<div class="container py-lg-5 py-3">
		<div class="row service-grid-grids text-center">
			<div class="col-lg-4 col-md-6 service-grid service-grid1">
				<div class="service-icon">
					<span class="fa fa-puzzle-piece"></span>
				</div>
				<h4 class="mt-3">Skilled Barbers</h4>
				<p class="mt-3">Perspiciatis unde omnis iste natus doloret ipsum volupte ut accusal ntium dolor remque laudantium, totam dolor.</p>
			</div>
			<div class="col-lg-4 col-md-6 service-grid service-grid2 mt-md-0 mt-5">
				<div class="service-icon">
					<span class="fa fa-scissors"></span>
				</div>
				<h4 class="mt-3">Hair stylists</h4>
				<p class="mt-3">Perspiciatis unde omnis iste natus doloret ipsum volupte ut accusal ntium dolor remque laudantium, totam dolor.</p>
			</div>
			
			<div class="col-lg-4 col-md-6 service-grid service-grid3 mt-lg-0 mt-5">
				<div class="service-icon">
					<span class="fa fa-sliders"></span>
				</div>
				<h4 class="mt-3">Beard Grooming</h4>
				<p class="mt-3">Perspiciatis unde omnis iste natus doloret ipsum volupte ut accusal ntium dolor remque laudantium, totam dolor.</p>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-6 p-md-0">
				<div class="bg-image-left">	
					<h4>skilled barbers</h4>
				</div>
			</div>
			<div class="col-md-6 p-md-0">
				<div class="bg-image-right">
					<h4>skilled barbers</h4>
				</div>
				<div class="row">
					<div class="col-md-6 pr-md-0">
						<div class="bg-image-bottom1">
							<h4>Trimming</h4>
						</div>
					</div>
					<div class="col-md-6 pl-md-0">
						<div class="bg-image-bottom2">
							<h4>Shaving</h4>
						</div>
					</div>
				</div>	
			</div>	
		</div>		
	</div>		
</section>
<!-- //services -->

<!-- facts -->
<section class="facts" id="facts">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 py-5">
				<div class="row inner-heading">
					<h2 class="heading text-capitalize my-md-4"> Why Choose Us</h2>
					<p class="mt-md-0 mt-2">Donec cursus congue risus, quis varius velit accumsan aliquam. Morbi semper nunc. Perspiciatis unde omnis iste
					natus doloret ipsum volupte ut accusal ntium dolor remque laudantium, totam dolor</p>
				</div>
				<div class="row mt-5 fact-grid-main">
					<div class="col-sm-4 stats-grid">
						<span class="fa fa-trophy"></span>
						<span>250</span>
						<h4>Experienced Barbers</h4>
					</div>
					<div class="col-sm-4 stats-grid">
						<span class="fa fa-scissors"></span>
						<span>50+</span>
						<h4>Amazing Hairstyles</h4>
					</div>
					<div class="col-sm-4 stats-grid">
						<span class="fa fa-smile-o"></span>
						<span>2000+</span>
						<h4>Satisfied clients</h4>
					</div>
				</div>
			</div>
			<div class="col-lg-5 p-lg-0 text-lg-right text-center">
				<img src="web/images/facts.png" class="img-fluid" alt="">
			</div>
		</div>
	</div>
</section>
<!-- //facts -->

<!-- team -->
<section class="team py-5" id="team">
	<div class="container py-md-4">
		<div class="title-desc text-center">
			<h3 class="heading text-capitalize mb-md-5 mb-4">our expert stylists</h3>
		</div>
		<div class="row team-grid">
			<div class="col-lg-3 col-sm-6">
				<div class="box13">
					<img src="web/images/team1.jpg" class="img-fluid img-thumbnail" alt="" />
					<div class="box-content">
						<h3 class="title">Williamson</h3>
						<span class="post">role in detail</span>
						<ul class="social">
							<li><a href="#"><span class="fa fa-facebook"></span></a></li>
							<li><a href="#"><span class="fa fa-twitter"></span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 mt-sm-0 mt-4">
				<div class="box13">
					<img src="web/images/team2.jpg" class="img-fluid img-thumbnail" alt="" />
					<div class="box-content">
						<h3 class="title">Kristiana</h3>
						<span class="post">role in detail</span>
						<ul class="social">
							<li><a href="#"><span class="fa fa-facebook"></span></a></li>
							<li><a href="#"><span class="fa fa-twitter"></span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 mt-lg-0 mt-4">
				<div class="box13">
					<img src="web/images/team3.jpg" class="img-fluid img-thumbnail" alt="" />
					<div class="box-content">
						<h3 class="title">Thomson</h3>
						<span class="post">role in detail</span>
						<ul class="social">
							<li><a href="#"><span class="fa fa-facebook"></span></a></li>
							<li><a href="#"><span class="fa fa-twitter"></span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 mt-lg-0 mt-4">
				<div class="box13">
					<img src="web/images/team4.jpg" class="img-fluid img-thumbnail" alt="" />
					<div class="box-content">
						<h3 class="title">Watson</h3>
						<span class="post">role in detail</span>
						<ul class="social">
							<li><a href="#"><span class="fa fa-facebook"></span></a></li>
							<li><a href="#"><span class="fa fa-twitter"></span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //team -->

<!-- footer top-->
<div class="footer-top py-md-4">
	<div class="container py-4">
		<div class="row">
			<div class="col-lg-9">
				<h4 class="footer-top-text text-capitalize">A wide range of male grooming services</h4>
			</div>
			<div class="col-lg-3 text-lg-right mt-lg-0 mt-4">
				<a href="services.html" class="text-capitalize serv_link btn">Go to our Services</a>
			</div>
		</div>
	</div>
</div>
<!-- //footer top-->

<!-- footer -->
<footer class="py-sm-5 py-4">
	<div class="container py-md-3">
		<div class="footer-logo text-center">
			<a class="navbar-brand" href="/default.php"><span class="fa fa-scissors"></span>Men's Salon</a>
		</div>
		<div class="row my-4 footer-middle">
			<div class="col-md-5 text-md-right address">
				<p><span class="fa fa-map-marker"></span>Location : 123 Street W, Seattle WA 99999 Paris, France.</p>
			</div>
			<div class="col-md-2 text-md-center my-md-0 my-sm-4 my-2 footer-icon">
				<span class="fa fa-scissors"></span>
			</div>
			<div class="col-md-5 text-md-left phone">
				<p><span class="fa fa-phone"></span>Phone : +121 568 789 901</p>
				<p><span class="fa fa-envelope-open"></span>Email : <a href="mailto:example@mail.com">example@mail.com</a></p>
			</div>
		</div>
		<div class="footer-grid">
			<div class="social text-center">
				<ul class="d-flex justify-content-center">
					<li class="mx-2"><a href="#"><span class="fa fa-facebook"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fa fa-twitter"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fa fa-rss"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fa fa-linkedin"></span></a></li>
					<li class="mx-2"><a href="#"><span class="fa fa-google-plus"></span></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!-- footer -->

<!-- copyright -->
<div class="copyright py-3 text-center">
	<p>© 2019 Men's Salon. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="=_blank"> W3layouts </a></p>
</div>
<!-- //copyright -->

<!-- move top icon -->
<a href="#home" class="move-top text-center"></a>
<!-- //move top icon -->
	
</body>
</html>