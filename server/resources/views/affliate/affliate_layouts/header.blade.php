<!doctype html>
 <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Affliate Manager Panel</title>
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
    <link href="{{$site_settings->cdn_url}}plugins/apexcharts-bundle/css/apexcharts.css" rel="stylesheet" />
    <link href="{{$site_settings->cdn_url}}plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{$site_settings->cdn_url}}plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{$site_settings->cdn_url}}css/pace.min.css" rel="stylesheet" />
    <script src="{{$site_settings->cdn_url}}js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/app.css" />
    <link rel="stylesheet" href="{{$site_settings->cdn_url}}css/dark-style.css" />
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js" defer></script>
   
</head> 

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--header-->
        <header class="top-header">
            <nav class="navbar navbar-expand">
                <div class="left-topbar d-flex align-items-center">
                    <a href="javaScript:;" class="toggle-btn">  <i class="bx bx-menu"></i>
                    </a>
                    <div class="logo-white">
                    <?php $qry=DB::table('site_settings')->first();?>
                        <img src="{{asset('site_images')}}/{{$qry->logo}}" class="logo-icon" alt="">
                    </div>
                    <div class="logo-dark">
                        <img src="{{asset('site_images')}}/{{$qry->logo}}" class="logo-icon" alt="">
                    </div>
                </div>
               
                <div class="right-topbar ml-auto">
                    <ul class="navbar-nav">
                      
                        <?php  
                                        $name='affliate';
        $id=Auth::guard('affliate')->id();
                                         $qry=DB::select("select *,(select count(id) from messages where  (receiver='$id' or receiver='admin') and affliate_id='$id') as total_messages,(select count(id) from messages where (receiver='$id' or receiver='admin') and affliate_id='$id' and is_read=0) as unread_messages from messages where (receiver='$id' or receiver='admin') and affliate_id='$id' order by is_read,created_at limit 6");
                                  ?>
                        <li class="nav-item dropdown dropdown-lg">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javaScript:;" data-toggle="dropdown">   <span class="msg-count">{{isset($qry[0])?$qry[0]->unread_messages:0}}</span>
                                <i class="bx bx-comment-detail vertical-align-middle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javaScript:;">
                                    <div class="msg-header">
                                    
                                        <h6 class="msg-header-title">{{isset($qry[0])?$qry[0]->total_messages:0}}</h6>
                                        <p class="msg-header-subtitle">Your Messages</p>
                                    </div>
                                </a>
                                <div class="header-message-list">
                                    @foreach($qry as $q)
                                    <a class="dropdown-item" href="{{url('affliate/view-message')}}/{{$q->id}}">
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
                                                <h6 class="msg-name">{{$q->sender}} <span class="msg-time float-right">{{$q->created_at}}
                                                   </span></h6>
                                                <p class="msg-info">{{$q->subject}}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                           
                            
                                    
                                   
                             
                                </div>
                                <a href="{{url('affliate/view-publisher-messages')}}">
                                    <div class="text-center msg-footer">View All Messages</div>
                                </a>
                            </div>
                        </li>
                        
                      
                        <li class="nav-item dropdown dropdown-user-profile">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javaScript:;" data-toggle="dropdown">
                                <div class="media user-box align-items-center">
                                    <div class="media-body user-info">
                                        <p class="user-name mb-0">{{Auth::guard('affliate')->user()->name}}</p>
                                        <p class="designattion mb-0">Country Manager</p>
                                    </div>
                                           <?php 
                                  if(Auth::guard('affliate')->user()->photo!=null){
                                    ?>
                                  <img src="{{asset('uploads')}}/{{Auth::guard('affliate')->user()->photo}}" class="user-img" alt="user avatar">
                                 <?php  
                             }
                                 else
                                    {
                                        ?>
                                    <img src="{{ config('app.url') }}/site/dashboard_assets/images/avatars/avatar-1.png" class="user-img" alt="user avatar">
                                            <?php }?>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"> 
                                <a class="dropdown-item" href="{{url('affliate/settings')}}"><i
                                        class="bx bx-cog"></i><span>Settings</span></a>
                              
                                  <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                    <i
                                        class="bx bx-lock"></i>Logout
                            </a>
                              <form id="logout-form" action="{{ url('affliate/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                                <div class="dropdown-divider mb-0"></div> 

                                <!--    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  <a class="dropdown-item" href="javaScript:;"><i
                                        class="bx bx-power-off"></i><span>Logout</span></a>

                                @csrf
                            </form> -->
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