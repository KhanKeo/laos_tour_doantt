<!doctype html>
<html lang="en">

<head>
    <title>LAO TOUR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="<?= asset('images/main/logo.png') ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <?php
    if (isset($bs4) && $bs4 == true) {
    ?>
        <!-- Bootstrap Stylesheet -->
        <link rel="stylesheet" href="<?= asset('css/bootstrap4.min.css') ?>">
    <?php
    } else {
    ?>
        <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
    <?php
    }
    ?>

    <!-- Font Awesome Stylesheet -->
    <link rel="stylesheet" href="<?= asset('font-awesome/css/font-awesome.min.css') ?>">

    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <link rel="stylesheet" id="cpswitch" href="<?= asset('css/orange.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">

    <!-- Owl Carousel Stylesheet -->
    <link rel="stylesheet" href="<?= asset('css/owl.carousel.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/owl.theme.css') ?>">

    <!-- Flex Slider Stylesheet -->
    <link rel="stylesheet" href="<?= asset('css/flexslider.css') ?>" type="text/css" />

    <!--Date-Picker Stylesheet-->
    <link rel="stylesheet" href="<?= asset('css/datepicker.css') ?>">

    <!-- Magnific Gallery -->
    <link rel="stylesheet" href="<?= asset('css/magnific-popup.css') ?>">

    <!-- Slick Stylesheet -->
    <link rel="stylesheet" href="<?= asset('css/slick.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/slick-theme.css') ?>">

    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <script src="<?= asset('js/app.js') ?>" defer></script>
    <script src="<?= asset('js/nic-edit/nicEdit.js') ?>"></script>
    <script src="<?= asset('js/chartjs.js') ?>"></script>
</head>


<body id="main-homepage">

    <!--====== LOADER =====-->
    <div class="loader"></div>

    <style>
        td {
            vertical-align: middle !important;
        }

        .nicEdit-main {
            overflow: auto !important;
            height: 600px;
        }
    </style>