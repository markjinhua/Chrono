<!doctype html>
 <!DOCTYPE html>
<html lang="en">

<head>
    <script data-ad-client="ca-pub-8033965373394508" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Publisher Panel</title>
    <!--favicon-->
        <?php
    $site_settings=DB::table('site_settings')->select('cdn_url')->first();
    ?>


    <link rel="icon" href="{{$site_settings->cdn_url}}site/dashboard_assets/images/favicon-32x32.png" type="image/png" />
    <link href="{{$site_settings->cdn_url}}plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <!--plugins-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link href="{{$site_settings->cdn_url}}plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{$site_settings->cdn_url}}plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{$site_settings->cdn_url}}plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <link href="{{$site_settings->cdn_url}}plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{$site_settings->cdn_url}}plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- loader-->

    <link href="{{$site_settings->cdn_url}}plugins/apexcharts-bundle/css/apexcharts.css" rel="stylesheet" />
    <link href="{{$site_settings->cdn_url}}/css/pace.min.css" rel="stylesheet" />
    <script src="{{$site_settings->cdn_url}}js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/app.css" />
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/dark-style.css" />


    <link href="{{$site_settings->cdn_url}}plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js" defer></script>

    <link href="{{$site_settings->cdn_url}}plugins/highcharts/css/highcharts.css" rel="stylesheet" />
 <style type="text/css">
     @media only screen and (max-width:1000px){
.affliate,.balance{
    display: none;
}
     }
 </style>



</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--header-->
        <header class="top-header">
            <nav class="navbar navbar-expand">
                <div class="left-topbar d-flex align-items-center border-right">
                    <a href="javaScript:;" class="toggle-btn">  <i class="bx bx-menu"></i>
                    </a>

                    <div class="logo-white">
                       <?php $qry=DB::table('site_settings')->first();?>
                       <a href="{{url('/publisher')}}">
                        <img src="{{asset('site_images')}}/{{$qry->logo}}" style="width:160px!important" class="logo-icon" alt="">
                        </a>
                    </div>
                    <div class="logo-dark">
                        <a href="{{url('/publisher')}}">
                        <img src="{{asset('site_images')}}/{{$qry->logo}}"  style="width:160px!important"  class="logo-icon" alt="">
                    </a>
                    </div>
                </div>

                <div class="right-topbar ml-auto ">
                    <ul class="navbar-nav">
<?php $affliate=DB::table('affliates')->where('id',Auth::guard('publisher')->user()->affliate_manager_id)->first()

?>
<li class="nav-item dropdown dropdown-user-profile affliate">
      @if($affliate!=null && $affliate->photo!=null)
                            <a class="nav-link" href="skype:{{@$affliate->skype}}?chat" >
                                <div class="media user-box align-items-center">

                                      <img src="{{asset('uploads')}}/{{@$affliate->photo}}" class="user-img rounded-circle mr-2" style="width:62!important;height: 60!important" alt="user avatar">
                                      <div class="media-body text user-info">
                                        <p class="user-name mb-0 ">{{@$affliate->name}}</p>
                                        <p class="designattion mb-0">Affliate Manager</p>
                                    </div>

                                </div>
                            </a>
                      @else

   <a class="nav-link" href="" >
                                <div class="media user-box align-items-center">

                                      <img src="{{$site_settings->cdn_url}}site/dashboard_assets/images/avatars/avatar-1.png" class="user-img rounded-circle mr-2" style="width:62!important;height: 60!important" alt="user avatar">
                                      <div class="media-body text user-info">
                                        <p class="user-name mb-0 ">No Name</p>
                                        <p class="designattion mb-0">No Affliate Manager</p>
                                    </div>

                                </div>
                            </a>
                      @endif
                        </li>

                      <?php $id=Auth::guard('publisher')->id();
$date=date('Y-m-01 00:00:00');

$qry=DB::select("select sum(amount) as balance from publisher_transactions where publisher_id='$id' and created_at>='$date'");

?>


                             <li class="nav-item balance">
                            <a class="nav-link  position-relative" href="javaScript:;" data-toggle="dropdown" style="display: none">
                                @php
                                $month_earning = DB::table('offer_process')->where('publisher_id', Auth::guard('publisher')->user()->id)
                                ->where('status', 'Approved')
                                ->whereMonth('created_at', Carbon\Carbon::now()->month)
                                ->sum('payout');
                                if($month_earning != null){
                                    $site=DB::table('site_settings')->first();

                                    $monthearn = ($month_earning/100) * $site->payout_percentage;
                                }else{
                                    $monthearn = 0;
                                }
                                @endphp
                                <i class="bx bx-wallet vertical-align-middle"></i><span style="font-size: 20px"> ${{$monthearn}}</span>
                            </a>

                        </li>

                             <?php
                                        $email=Auth::guard('publisher')->user()->email;

                                         $qry=DB::select("select *,(select count(id) from messages where receiver='$email') as total_messages,(select count(id) from messages where receiver='$email' and is_read=0) as unread_messages from messages where receiver='$email' order by is_read,created_at limit 6");
                                  ?>
                        <li class="nav-item dropdown dropdown-lg">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javaScript:;" data-toggle="dropdown">   <span class="msg-count">{{isset($qry[0])?$qry[0]->unread_messages:0}}</span>
                                <i class="bx bx-comment-detail vertical-align-middle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javaScript:;">
                                    <div class="msg-header">

                                        <h6 class="msg-header-title">{{isset($qry[0])?$qry[0]->total_messages:0}}</h6>
                                        <p class="msg-header-subtitle"> Messages</p>
                                    </div>
                                </a>
                                <div class="header-message-list">
                                    @foreach($qry as $q)
                                    <a class="dropdown-item" href="{{url('publisher/view-message')}}/{{$q->id}}">
                                        <div class="media align-items-center">
                                            <div class=" ml-1 mr-3">

                                               @if($q->is_read==0)
                                               <i class="lni lni-envelope text-primary"></i>
                                               @else

                                <div class="icon-base"> <i class="fadeIn animated bx bx-envelope-open text-primary"></i>
                                </div>


                                                @endif
                                            </div>
                                            <div class="media-body">
                                                <h6 class="msg-name">Support Team <span class="msg-time float-right">{{$q->created_at}}
                                                   </span></h6>
                                                <p class="msg-info">{{$q->subject}}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach





                                </div>
                                <a href="{{url('publisher/support')}}">
                                    <div class="text-center msg-footer">View All Messages</div>
                                </a>
                            </div>
                        </li>
                        <?php
$news=DB::table('notification as n')->select('*','n.id as nid')->leftjoin('news_and_announcement as a','a.id','=','n.news_id')->where('n.publisher_id',Auth::guard('publisher')->id())->orderBy('n.id','desc')->limit(6)->get();
                    $news_count=DB::table('notification as n')->where('n.publisher_id',Auth::guard('publisher')->id())->where('is_read',0)->count();
                        ?>
                        <li class="nav-item dropdown dropdown-lg">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javaScript:;" data-toggle="dropdown">   <i class="bx bx-bell vertical-align-middle"></i>
                                <span class="msg-count">{{$news_count}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javaScript:;">
                                    <div class="msg-header">
                                        <h6 class="msg-header-title">{{$news_count}} New</h6>
                                        <p class="msg-header-subtitle">News/Announcements</p>
                                    </div>
                                </a>
                                <div class="header-notifications-list">
                                    @foreach($news as $n)
                                    <a class="dropdown-item" href="{{url('publisher/view-notification')}}/{{$n->nid}}">
                                        <div class="media align-items-center">
                                            <div class="notify bg-light-primary text-primary"><i class="bx bx-bell"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="msg-name">{{$n->title}}<br>From Support Team<span class="msg-time float-right">{{$n->created_at}}</span></h6>

                                            </div>
                                        </div>
                                    </a>
                                    @endforeach

                                </div>
                                <a href="{{url('publisher/show-all-notifications')}}">
                                    <div class="text-center msg-footer">View All Notifications</div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-user-profile">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javaScript:;" data-toggle="dropdown">
                                <div class="media user-box align-items-center">
                                    <div class="media-body user-info">
                                        <p class="user-name mb-0">{{Auth::guard('publisher')->user()->name}}</p>
                                        <p class="designattion mb-0"><?php
                          if(Auth::guard('publisher')->user()->total_earnings<10){
                            echo "Beginner";
                          }
                          else if(Auth::guard('publisher')->user()->total_earnings>=10 && Auth::guard('publisher')->user()->total_earnings<35){
                            echo "Expert";
                          }
                        else if(Auth::guard('publisher')->user()->total_earnings>=35 && Auth::guard('publisher')->user()->total_earnings<100){
                            echo "Genious";
                        }
                          else if(Auth::guard('publisher')->user()->total_earnings>=100 && Auth::guard('publisher')->user()->total_earnings<1000){
                          echo "Boss";
                        }
                          else if(Auth::guard('publisher')->user()->total_earnings>=1000 && Auth::guard('publisher')->user()->total_earnings<15000){
                            echo "Rock";
                        }
                          else if(Auth::guard('publisher')->user()->total_earnings>=15000){
                              echo "Superman";
                          }
                          ?></p>
                                    </div>
                                  <?php
                                  if(Auth::guard('publisher')->user()->publisher_image!=null){
                                    ?>
                                  <img src="{{asset('uploads')}}/{{Auth::guard('publisher')->user()->publisher_image}}" class="user-img" alt="user avatar">
                                 <?php
                             }
                                 else
                                    {
                                        ?>
                                    <img src="{{$site_settings->cdn_url}}site/dashboard_assets/images/avatars/avatar-1.png" class="user-img" alt="user avatar">
                                            <?php }?>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="{{url('publisher/payment-history')}}"><i
                                        class="bx bx-user"></i><span>Wallet</span></a>
                                <a class="dropdown-item" href="{{url('publisher/account-information')}}"><i
                                        class="bx bx-cog"></i><span>Settings</span></a>

                                  <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                    <i
                                        class="bx bx-lock"></i>Logout
                            </a>
                              <form id="logout-form" action="{{ url('publisher/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                                <div class="dropdown-divider mb-0"></div>


                            </div>
                        </li>


                    </ul>
                </div>
            </nav>
        </header>
        <!--end header-->
            @yield('sidebar')
            @yield('content')
            @yield('footer')
