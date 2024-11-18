
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
 <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  
<body>
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
     <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" style="overflow-y:auto ">

          <a class="nav-link navlogo text-center" href="index.php">
            <img src="https://vignette.wikia.nocookie.net/nationstates/images/2/29/WS_Logo.png/revision/latest?cb=20080507063620">
          </a>

        <li class="nav-item">
          <a class="nav-link sidefrst" href="{{url('admin')}}">
            <span class="textside">  Dashboard</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link sidesecnd" href="{{url('admin/manage-clicks')}}">
            <span class="textside">  Clicks</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link sidesecnd" href="{{url('admin/view-offer')}}">
            <span class="textside">  Offer</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link sidesecnd" href="{{url('admin/approval-request')}}">
            <span class="textside">  APPROVAL REQUEST</span>
          </a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link sidesthrd" href="{{url('admin/manage-domain')}}">
            <span class="textside">  Tracking Domain</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-categories')}}">
            <span class="textside">  Category</span>
          </a>
        </li>
              <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-affliatemanager')}}">
            <span class="textside">  Affliate Manager</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-publishers')}}">
            <span class="textside"> Publishers</span>
          </a>
        </li>
           <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-news')}}">
            <span class="textside">News/Announcements</span>
          </a>
        </li>
       
          <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-cashout')}}">
            <span class="textside"> Cashout Request</span>
          </a>
        </li>
       
         <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-advertiser')}}">
            <span class="textside">Advertiser </span>
          </a>
        </li>
           <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-postback')}}">
            <span class="textside">Postback</span>
          </a>
        </li>
           <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-postback-log')}}">
            <span class="textside">Postback Logs Sent</span>
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-postback-log-receive')}}">
            <span class="textside">Postback Logs Received</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link sidesforth" href="{{url('admin/manage-ban-ip')}}">
            <span class="textside">BAN IP</span>
          </a>
        </li>
       
      </ul>
      
      <ul class="navbar-nav2 ml-auto">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome WaLia</a>
            <ul class="dropdown-menu">
                <li class="resflset"><a href="profile.php"><i class="fa fa-fw fa-cog"></i> Edit profile</a></li>
                <li class="divider"></li>
                <li class="resflset"><a href="#"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
            </ul>
        </li>
      </ul>
      
    </div>

  </nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

  <script type="text/javascript">
     $('#datatable').DataTable({ordering:false});
  </script>