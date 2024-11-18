
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
          <a class="nav-link sidefrst" href="{{url('affliate')}}">
            <span class="textside">  Dashboard</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link sidesecnd" href="{{url('affliate/manage-publisher')}}">
            <span class="textside">  Publisher</span>
          </a>
        </li> <li class="nav-item">
          <a class="nav-link sidesecnd" href="{{url('affliate/mail-room')}}">
            <span class="textside">  Mail Room</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link sidesecnd" href="{{url('affliate/settings')}}">
            <span class="textside">  Settings</span>
          </a>
        </li>
      
       
      </ul>
      
      <ul class="navbar-nav2 ml-auto">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome Huzaifa</a>
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