

<!DOCTYPE html>
<html lang="en">
  <head>
        <?php
    $site_settings=DB::table('site_settings')->select('cdn_url')->first();
    ?>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>{{ config('app.name') }} - Login Publisher</title>
    <!--favicon-->
    <link rel="icon" href="{{$site_settings->cdn_url}}site/dashboard_assets/images/favicon-32x32.png" type="image/png"/>
    <!-- loader-->
    <link href="{{$site_settings->cdn_url}}site/dashboard_assets/css/pace.min.css" rel="stylesheet"/>
    <script src="{{$site_settings->cdn_url}}site/dashboard_assets/js/pace.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}site/dashboard_assets/css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}site/dashboard_assets/css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}site/dashboard_assets/css/app.css" />
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}site/dashboard_assets/css/dark-style.css" />
  </head>

  <body>
    <!-- wrapper -->
    <div class="wrapper">

     <div class="section-authentication">
       <div class="container-fluid mt-5" >
              <div class="row no-gutters">

         <div class="col-lg-12  d-flex align-items-stretch m-auto  "  >
        <div class="card mb-0 m-auto" style="height: 100%"  >
         <div class="card-body p-0">


              <div class="card mb-0 shadow-none bg-transparent w-100 login-card rounded-0" style="border-right: none!important;">
                 <div class="card-body p-md-5">
                        <form method="POST" action="{{ route('publisher.login.submit') }}">
                            @csrf
<div class="col-lg-12 text-center">
    <?php $qry=DB::table('site_settings')->first();?>

                  <img src="{{asset('site_images')}}/{{$qry->logo}}"  width="180" alt=""/>
                                </div><h4 class="mt-2"><strong>Login</strong></h4>

                     <p>Log in to your account using email & password</p>
                     <div class="form-group mt-4">
                           @if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">×</span>
                                </button>
  </div>
@endif
@if (session('warning'))
  <div class="alert alert-warning">
    {{ session('warning') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">×</span>
                                </button>
  </div>
@endif
                       <label>Email Address</label>
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                     </div>
                     <div class="form-group">
                       <label>Enter Password</label>
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                     </div>
                    <!--  <div class="form-row">
                       <div class="form-group col">
                         <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                          <label class="custom-control-label" for="customSwitch1">Remember Me</label>
                        </div>
                       </div>
                       <div class="form-group col text-right">
                         <a href="authentication-forgot-password.html"><i class='bx bxs-key mr-2'></i>Forget Password?</a>
                       </div>
                     </div> -->

                     <button type="submit" class="btn btn-primary btn-block mt-3"><i class='bx bxs-lock mr-1'></i>Login</button>
                          @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

                     <div class="text-center mt-4">
                        @if ($setting->disable_signup != '1')
                        <p class="mb-0">Dont' have an account yet? <a href="{{url('publisher/register')}}">Create an account</a></p>
                        @endif
                     </div>
                      <!--   <div class="text-center mt-1">
                       <p class="mb-0">Are you an<b> Advertiser</b> <a href="{{url('advertiser/login')}}">Login as Advertiser</a></p>
                     </div> -->
                 </div>
                 <input type="hidden" name="country">
                 <input type="hidden" name="city">
                 <input type="hidden" name="browser">
                 <input type="hidden" name="device">

             </form>
              </div>
            </div>

          </div>

           </div>
         </div>
      </div>

    </div>
    <!-- end wrapper -->

  <div id="id"></div>

     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('dashboard_assets/js/jquery.min.js')}}"></script>
      <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script>
      /*switcher*/
      $(function(){

    const getUA = () => {
    let device = "Unknown";
    const ua = {
        "Generic Linux": /Linux/i,
        "Android": /Android/i,
        "BlackBerry": /BlackBerry/i,
        "Bluebird": /EF500/i,
        "Chrome OS": /CrOS/i,
        "Datalogic": /DL-AXIS/i,
        "Honeywell": /CT50/i,
        "iPad": /iPad/i,
        "iPhone": /iPhone/i,
        "iPod": /iPod/i,
        "macOS": /Macintosh/i,
        "Windows": /IEMobile|Windows/i,
        "Zebra": /TC70|TC55/i,
    }
    Object.keys(ua).map(v => navigator.userAgent.match(ua[v]) && (device = v));
    return device;
}

console.log(getUA());

// Opera 8.0+
var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

// Firefox 1.0+
var isFirefox = typeof InstallTrigger !== 'undefined';

// Safari 3.0+ "[object HTMLElementConstructor]"
var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

// Internet Explorer 6-11
var isIE = /*@cc_on!@*/false || !!document.documentMode;

// Edge 20+
var isEdge = !isIE && !!window.StyleMedia;

// Chrome 1 - 79
var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);

// Edge (based on chromium) detection
var isEdgeChromium = isChrome && (navigator.userAgent.indexOf("Edg") != -1);

// Blink engine detection
var isBlink = (isChrome || isOpera) && !!window.CSS;


device='';
if(isOpera){
    device='Opera';
}
else if(isFirefox){
    device='Firefox';
}
else if(isSafari){
    device='Safari';
}
else if(isIE){
    device='Internet Explorer';
}
else if(isChrome){
    device='Chrome';

}
else if(isEdge){
    device='Edge';
}
else if(isEdgeChromium){
    device='Edge chromium';
}
else if(isBlink){
    device='Blink';
}


$('input[name=device]').val(device);
$('input[name=browser]').val(getUA());

  $.ajax('https://freegeoip.app/json/')
  .then(
      function success(response) {

   $('input[name=country]').val(response.country_name);
   $('input[name=city]').val(response.city);
        }
        )
        $(".switcher-btn").on("click", function () {
            $(".switcher-wrapper").toggleClass("switcher-toggled");
        });

        $("#darkmode").on("click", function () {
            $("html").addClass("dark-theme");
        });

        $("#lightmode").on("click", function () {
            $("html").removeClass("dark-theme");
        });

    })</script>


  </body>
</html>
