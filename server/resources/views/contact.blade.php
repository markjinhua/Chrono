<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
      <?php
    $site_settings=DB::table('site_settings')->select('cdn_url')->first();
    ?>
    <!--====== Title ======-->
    <title>{{ config('app.name') }} - Private CPA & Smartlink Network</title>
    
    <meta name="description" content="{{ config('app.name') }} is  Premium CPA Network that contains premiums offers based on CPL, CPC and CPA. Traffic Firenly smart links system and the echo system that protect our Advertisers from the Fraud. There is no limit for conversions and offers for long and lifetime">
    <meta name="keywords" content="{{ config('app.name') }}, Has Profit, Ogads, Cpabuild, adworkmedia, clickdealer, love revinue, trafee, top offers, cpa network, cpafull, opportunity, gamini, adting cpl offers, dating ppl offers, smartlink network, smartlink offers, adult offers, cpc offers, cpa offers, ecommerce offers, download offers, browser extion download offers, best cpa offers, peerfly offers, hastraffic, cpa dating, cpalead offers, adworkmedia offers, dating cpa offers, cpa dating site, peerfly offers list, orex cpa offers, highest paying cpa networks, dating cpa network, cpa best offer, worldwide cpa offers, cpa network instant approval, top cpa offers,pay per call dating offer, high paying cpa offers, nutra affiliate networks, best converting maxbounty offers, crypto cpa offers, gaming cpa offers, dating cpa network list, dating best offers, survey cpa offers, bizprofits offers, nutra offers affiliate, casino cpa offers, cpa dating offer promote">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{$site_settings->cdn_url}}site/dashboard_assets/images/favicon-32x32.png" type="image/png')}}">
        
   
        
   
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}home/css/slick.css">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}home/css/LineIcons.css">
        
    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}home/css/font-awesome.min.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}home/css/bootstrap.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}home/css/default.css">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}home/css/style.css">
    
</head>

<body>
     
   
   
    <!--====== PRELOADER PART START ======-->

    <!--<div class="preloader">-->
    <!--    <div class="loader">-->
    <!--        <div class="ytp-spinner">-->
                
    <!--            <img src="https://media.giphy.com/media/3d4EEHTCGQqTMnazQM/source.gif"/>-->
                <!--<div class="ytp-spinner-container">-->
                <!--    <div class="ytp-spinner-rotator">-->
                <!--        <div class="ytp-spinner-left">-->
                <!--            <div class="ytp-spinner-circle"></div>-->
                <!--        </div>-->
                <!--        <div class="ytp-spinner-right">-->
                <!--            <div class="ytp-spinner-circle"></div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== HEADER PART START ======-->
    
    <header class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <!--<a class="navbar-brand" href="{{ config('app.url')}}">-->
                            <!--    <?php $qry=DB::table('site_settings')->first();?>-->
                            <!--    <img src="{{asset('site_images')}}/{{$qry->logo}}" alt="Logo">-->
                            <!--</a>-->
                            <a class="logo" href="{{ config('app.url') }}">
                                <img style="background:white;border-radius:14px;height: 50px;" src="{{asset('site_images')}}/{{$qry->logo}}" alt="logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#features">Payout Model</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#about">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#facts">Why Choose Us?</a>
                                    </li>
                                    
                                    
                                </ul>
                            </div> <!-- navbar collapse -->
                            
                            <div class="navbar-btn d-none d-sm-inline-block">
                                <a class="main-btn" data-scroll-nav="0" href="{{ config('app.url')}}/publisher">Login</a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
        
        <div id="home" class="header-hero bg_cover" style="background-image: url({{$site_settings->cdn_url}}home/images/banner-bg.svg)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="header-hero-content text-center">
                            
                            <h4 class="header-title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">A CPA Network that contains Premium CPC, CPL and CPA Offers</h4>
                            <p class="text wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">We focus on cloud and AI for faster speed of the network perfermance</p>
                            <a href="{{ config('app.url')}}/publisher/register" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s">Get Started</a>
                        </div> <!-- header hero content -->
                    </div>
                </div> <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
                            <img src="{{$site_settings->cdn_url}}home/images/header-hero.png" alt="hero">
                        </div> <!-- header hero image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div id="particles-1" class="particles"></div>
        </div> <!-- header hero -->
    </header>
    
    <!--====== HEADER PART ENDS ======-->
    
    <!--====== BRAMD PART START ======-->
    
   
    
    <!--====== BRAMD PART ENDS ======-->
    
    <!--====== SERVICES PART START ======-->
    
    <section id="features" class="services-area pt-120">
        <div class="container">
            <div class="row justify-content-center">
               

 
            <div class="entry-content clearfix">
                <p>
                    We are 24/7 Ready to help you with better solutions.

                </p>
                <p>
                    <ul>
                        <li>
                          We usually support by Tickets and Skype. In case of query conacts are available by email
                        </li>
                    </ul>
                
                <p>
                    <code>
                        {{ env('MAIL_FROM_ADDRESS') }}
                    </code>
                </p>
            </div>


            </div> <!-- row -->

        </div> <!-- container -->
    </section>
    
    <!--====== SERVICES PART ENDS ======-->
    
    <!--====== ABOUT PART START ======-->
    
    
    
    <!--====== ABOUT PART ENDS ======-->
    
    <!--====== ABOUT PART START ======-->


  
    
    <!--====== FOOTER PART START ======-->
    
     <footer id="footer" class="footer-area pt-120">
        <div class="container">
            
            <div class="footer-widget pb-100">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="footer-about mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                            <a class="logo" href="{{ config('app.url')}}">
                                <img style="background:white;border-radius:14px;height: 50px;" src="{{asset('site_images')}}/{{$qry->logo}}" alt="logo">
                            </a>
                            
                            
                            <p class="text">{{ config('app.name') }} is  Premium CPA Network that contains premiums offers based on CPL, CPC and CPA. Traffic Firenly smart links system and the echo system that protect our Advertisers from the Fraud. There is no limit for conversions and offers for long and lifetime</p>
                          <!--  <ul class="social">
                                <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni-twitter-filled"></i></a></li>
                                <li><a href="#"><i class="lni-instagram-filled"></i></a></li>
                                <li><a href="#"><i class="lni-linkedin-original"></i></a></li>
                            </ul> -->
                        </div> <!-- footer about -->
                    </div>
                    <div class="col-lg-5 col-md-7 col-sm-7">
                        <div class="footer-link d-flex mt-50 justify-content-md-between">
                            <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                                <div class="footer-title">
                                    <h4 class="title">Quick Link</h4>
                                </div>
                                <ul class="link">
                                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ url('/refund') }}">Refund Policy</a></li>
                                    <li><a href="{{ url('/terms') }}">Terms of Service</a></li>
                                    <li><a href="{{ url('/dmca') }}">DMCA</a></li>
                                </ul>
                            </div> <!-- footer wrapper -->
                            <div class="link-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="footer-title">
                                    <h4 class="title">Resources</h4>
                                </div>
                                <ul class="link">
                                    <li><a href="#"></a></li>
                                    <li><a href="{{ config('app.url')}}/publisher/register">Register</a></li>
                                    <li><a href="{{ config('app.url')}}/publisher">Sign In</a></li>
                                    <!--<li><a href="https://form.jotform.com/203461172856456">Apply For Affiliate Manager</a></li>-->
                                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                                </ul>
                            </div> <!-- footer wrapper -->
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-5">
                        <div class="footer-contact mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                            <div class="footer-title">
                                <h4 class="title">Contact Us</h4>
                            </div>
                            <br> <br> <br> <br> <br> <br>
                            <ul class="contact">

                               
                                <li>{{ config('app.url')}}</li>
                            </ul>
                        </div> <!-- footer contact -->
                    </div>
                </div> <!-- row -->
            </div> <!-- footer widget -->
            <div class="footer-copyright">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright d-sm-flex justify-content-between">
                            <div class="copyright-content">
                                <p class="text">Designed and Developed by <a href="{{ config('app.url')}}" rel="nofollow">{{ config('app.name')}} Tech Team</a></p>
                            </div> <!-- copyright content -->
                        </div> <!-- copyright -->
                    </div>
                </div> <!-- row -->
            </div> <!-- footer copyright -->
        </div> <!-- container -->
        <div id="particles-2"></div>
    </footer>
    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->   
    
    <!--====== PART START ======-->
    
<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->
    
    <!--====== PART ENDS ======-->




    <!--====== Jquery js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{$site_settings->cdn_url}}home/js/vendor/modernizr-3.7.1.min.js"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/popper.min.js"></script>
    <script src="{{$site_settings->cdn_url}}home/js/bootstrap.min.js"></script>
    
    <!--====== Plugins js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/plugins.js"></script>
    
    <!--====== Slick js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/slick.min.js"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/ajax-contact.js"></script>
    
    <!--====== Counter Up js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/waypoints.min.js"></script>
    <script src="{{$site_settings->cdn_url}}home/js/jquery.counterup.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/jquery.magnific-popup.min.js"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/jquery.easing.min.js"></script>
    <script src="{{$site_settings->cdn_url}}home/js/scrolling-nav.js"></script>
    
    <!--====== wow js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/wow.min.js"></script>
    
    <!--====== Particles js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/particles.min.js"></script>
    
    <!--====== Main js ======-->
    <script src="{{$site_settings->cdn_url}}home/js/main.js"></script>
    
</body>

</html>
