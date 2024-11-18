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
                                <img style="background:#ffffff00;border-radius:14px;height: 50px;" src="{{asset('site_images')}}/{{$qry->logo}}" alt="logo">
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
                <h1>Privacy Policy for {{ config('app.name') }}</h1> <br/>

<p>At {{ config('app.name') }}, accessible from {{ config('app.url') }}, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by {{ config('app.name') }} and how we use it.</p>

<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in {{ config('app.name') }}. This policy is not applicable to any information collected offline or via channels other than this website.</p><br/>


<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms. For our Terms and Conditions.</p><br/>

<h2>Information we collect</h2><br/>

<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p><br/>
<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p><br/>

<br/>
<h2>Log Files</h2>
<br/>
<p>{{ config('app.name') }} follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>
<br/>
<h2>Cookies and Web Beacons</h2>
<br/>
<p>Like any other website, {{ config('app.name') }} uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>
<br/>
<p>For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/">"What Are Cookies" from Cookie Consent</a>.</p>
<br/>


<h2>Advertising Partners Privacy Policies</h2>
<br/>
<P>You may consult this list to find the Privacy Policy for each of the advertising partners of {{ config('app.name') }}.</p>
<br/>
<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on {{ config('app.name') }}, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
<br/>
<p>Note that {{ config('app.name') }} has no access to or control over these cookies that are used by third-party advertisers.</p>
<br/>
<h2>Third Party Privacy Policies</h2>
<br/>
<p>{{ config('app.name') }}'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>
<br/>
<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>
<br/>
<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>
<br/>
<p>Under the CCPA, among other rights, California consumers have the right to:</p><br/>
<p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p><br/>
<p>Request that a business delete any personal data about the consumer that a business has collected.</p><br/>
<p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p><br/>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p><br/>

<h2>GDPR Data Protection Rights</h2><br/>

<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p><br/>
<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p><br/>
<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p><br/>
<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p><br/>
<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p><br/>
<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p><br/>
<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p><br/>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p><br/>

<h2>Children's Information</h2><br/>

<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p><br/>

<p>{{ config('app.name') }} does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p><br/>
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
