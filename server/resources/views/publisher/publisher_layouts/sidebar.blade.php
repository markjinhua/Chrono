  @section('sidebar')
      <!--page-wrapper-->
        <div class="page-wrapper">
            <!--sidebar-wrapper-->
            <div class="sidebar-wrapper" data-simplebar="true">
                <div class="sidebar-header">
                    <a href="javaScript:;" class="toggle-btn"> <i class="bx bx-menu"></i>
                    </a>
                    
                </div>
                <!--navigation-->
                <ul class="metismenu" id="menu">
                      <li>
                        <a href="{{url('/publisher')}}">
                            <div class="parent-icon"><i class="bx bx-tachometer"></i>
                            </div>
                            <div class="menu-title">Dashboard</div>
                        </a>
                    </li>
 
                    @if(Auth::guard('publisher')->user()->expert_mode==1)
                      <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="lni lni-offer"></i>
                            </div>
                            <div class="menu-title">CPA Offers</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('publisher/public-offers')}}"><i class="bx bx-right-arrow-alt"></i>Public Offers</a>
                            </li>
                            <li> <a href="{{url('publisher/private-offers')}}"><i class="bx bx-right-arrow-alt"></i>Private Offers</a>
                            </li>
                              <li> <a href="{{url('publisher/special-offers')}}"><i class="bx bx-right-arrow-alt"></i>Special Offers</a>
                            </li>
                              <li> <a href="{{url('publisher/new-offers')}}"><i class="bx bx-right-arrow-alt"></i>New Offers</a>
                            </li>
                              <li> <a href="{{url('publisher/top-offers')}}"><i class="bx bx-right-arrow-alt"></i>Top Offers</a>
                            </li>
                           
                        </ul>
                    </li>
                 @endif
                    <li>
                        <a href="{{url('publisher/show-smartlink')}}">
                            <div class="parent-icon"><i class="bx bx-link"></i>
                            </div>
                            <div class="menu-title">Smart Link</div>
                        </a>
                    </li>

                    @if(Auth::guard('publisher')->user()->expert_mode==1)
                       <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-repeat"></i>
                            </div>
                            <div class="menu-title">Parking Domain</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('publisher/add-site')}}"><i class="bx bx-right-arrow-alt"></i>Add Parking Domain</a>
                            </li>
                            <li> <a href="{{url('publisher/manage-site')}}"><i class="bx bx-right-arrow-alt"></i>Parking Domain List</a>
                            </li>
                           
                        </ul>
                    </li>
                     @endif
                    <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-file"></i>
                            </div>
                            <div class="menu-title">Reports</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('publisher/reports')}}"><i class="bx bx-right-arrow-alt"></i>Conversion Report</a>
                            </li>
                          <li> <a href="{{url('publisher/daily-report')}}"><i class="bx bx-right-arrow-alt"></i>Daily Report</a>
                            </li>
                           
                        </ul>
                    </li>
                      <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-user-circle"></i>
                            </div>
                            <div class="menu-title">My Account</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('publisher/account-information')}}"><i class="bx bx-right-arrow-alt"></i>Account Information</a>
                            </li>
                              <li> <a href="{{url('publisher/2fa')}}"><i class="bx bx-right-arrow-alt"></i>Two Factor Authentication</a>
                            </li>
                           
                           <!--   <li> <a href="content-grid-system.html"><i class="bx bx-right-arrow-alt"></i>Notification Settings</a>
                            </li> -->
                             <li> <a href="{{url('publisher/login-history')}}"><i class="bx bx-right-arrow-alt"></i>Login History</a>
                            </li>
                         
                           
                        </ul>
                    </li>
                    <!--   <li>
                        <a href="chat-box.html">
                            <div class="parent-icon"> <i class="lni lni-offer"></i>
                            </div>
                            <div class="menu-title">Chat Box</div>
                        </a>
                    </li> -->
                    @if(Auth::guard('publisher')->user()->expert_mode==1)
                        <li>
                        <a href="{{url('publisher/top-10-members')}}">
                            <div class="parent-icon"> <i class="bx bx-medal"></i>
                            </div>
                            <div class="menu-title">Top 10 Members</div>
                        </a>
                    </li>
                     @endif
                    <li>
                        <a href="{{url('publisher/payment-history')}}">
                            <div class="parent-icon"><i class="lni lni-revenue"></i>
                            </div>
                            <div class="menu-title">Payment History</div>
                        </a>
                    </li>
                      
                    <li>
                        <a href="{{url('publisher/support')}}">
                            <div class="parent-icon"><i class="lni lni-headphone-alt"></i>
                            </div>
                            <div class="menu-title">Support</div>
                        </a>
                    </li>
                      <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="lni lni-link"></i>
                            </div>
                            <div class="menu-title">Postback</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('publisher/postback')}}"><i class="bx bx-right-arrow-alt"></i>Postback</a>
                            </li>
                         
                          <li> <a href="{{url('publisher/send-postback')}}"><i class="bx bx-right-arrow-alt"></i>Postback Sent</a>
                            </li>
                         
                           
                        </ul>
                    </li>
                      @if(Auth::guard('publisher')->user()->expert_mode==1)
                       <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="lni lni-code"></i>
                            </div>
                            <div class="menu-title">Api</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('publisher/api')}}"><i class="bx bx-right-arrow-alt"></i>Offer Api</a>
                            </li>
                         
                         
                           
                        </ul>
                    </li>
                       @endif
                    
                    
                </ul>
                <!--end navigation-->
            </div>
            <!--end sidebar-wrapper-->
            <!-- Left Sidebar End -->
@endsection('sidebar')