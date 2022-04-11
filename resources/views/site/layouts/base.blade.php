<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- master stylesheet -->
    <link rel="stylesheet" href="/css/style.css?v1.0.2">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicon/favicon-16x16.png" sizes="16x16">

    <!-- Fixing Internetkateogri başlık eklendi Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="/js/html5shiv.js"></script>
    <![endif]-->

    @yield('header')
    <title>@yield('title')</title>

</head>
<body>
<div class="boxed_wrapper">
    @include('site.layouts.partials.header')
    @yield('content')
    @include('site.layouts.partials.footer')
</div>
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-chevron-circle-up"></span></div>

<!-- main jQuery -->
<script src="/js/jquery-latest.js"></script>
<!-- Wow Script -->
<script src="/js/wow.js"></script>
<!-- bootstrap -->
<script src="/js/bootstrap.min.js"></script>
<!-- bx slider -->
<script src="/js/jquery.bxslider.min.js"></script>
<!-- count to -->
<script src="/js/jquery.countTo.js"></script>
<!-- owl carousel -->
<script src="/js/owl.carousel.min.js"></script>
<!-- validate -->
<script src="/js/validation.js"></script>
<!-- mixit up -->
<script src="/js/jquery.mixitup.min.js"></script>
<!-- easing -->
<script src="/js/jquery.easing.min.js"></script>
<!-- gmap helper -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A"></script>
<!--gmap script-->
<script src="/js/gmaps.js"></script>
<script src="/js/map-helper.js"></script>
<!-- fancy box -->
<script src="/js/jquery.fancybox.pack.js"></script>
<script src="/js/jquery.appear.js"></script>
<!-- isotope script-->
<script src="/js/isotope.js"></script>
<script src="/js/jquery.prettyPhoto.js"></script>
<script src="/js/jquery.bootstrap-touchspin.js"></script>
<!-- jQuery timepicker js -->
<script src="/assets/timepicker/timePicker.js"></script>
<!-- Bootstrap select picker js -->
<script src="/assets/bootstrap-sl-1.12.1/bootstrap-select.js"></script>
<!-- Bootstrap bootstrap touchspin js -->
<!-- jQuery ui js -->
<script src="/assets/jquery-ui-1.11.4/jquery-ui.js"></script>
<!-- Language Switche  -->
<script src="/assets/language-switcher/jquery.polyglot.language.switcher.js"></script>
<!-- Html 5 light box script-->
<script src="/assets/html5lightbox/html5lightbox.js"></script>


<!-- revolution slider js -->
<script src="/assets/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="/assets/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="/assets/revolution/js/extensions/revolution.extension.video.min.js"></script>


<!-- thm custom script -->
<script src="/js/custom.js"></script>


</body>
</html>
