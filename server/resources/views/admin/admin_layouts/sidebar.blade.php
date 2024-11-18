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
                        <a href="{{url('/admin')}}">
                            <div class="parent-icon"><i class="bx bx-tachometer"></i>
                            </div>
                            <div class="menu-title">Dashboard</div>
                        </a>
                    </li>
                  
                      <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="lni lni-offer"></i>
                            </div>
                            <div class="menu-title">Offers</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('admin/add-offer')}}"><i class="bx bx-right-arrow-alt"></i>Add Offer</a>
                            </li>
                            <li> <a href="{{url('admin/view-offer')}}"><i class="bx bx-right-arrow-alt"></i>View Offers</a>
                            </li>
                                                          
                           
                        </ul>
                    </li>
                    
                     <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class='bx bx-pointer'></i>
                            </div>
                            <div class="menu-title">Leads Process</div>
                        </a>
                        <ul>
                              <li> <a href="{{url('admin/pending-offer-process')}}"><i class="bx bx-right-arrow-alt"></i>Pending Leads Process</a>
                            </li>
                                
                                <li> <a href="{{url('admin/wait-offer-process')}}"><i class="bx bx-right-arrow-alt"></i>Waited Leads Process</a>
                                </li>
                                <li> <a href="{{url('admin/approve-offer-process')}}"><i class="bx bx-right-arrow-alt"></i>Approved Leads Process</a>
                                </li>

                                 <li> <a href="{{url('admin/reject-offer-process')}}"><i class="bx bx-right-arrow-alt"></i>Rejected Leads Process</a>
                                  </li>                             
                           
                        </ul>
                    </li>
                 
                <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-link"></i>
                            </div>
                            <div class="menu-title">Smartlink Process</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('admin/smartlink-pending-process')}}"><i class="bx bx-right-arrow-alt"></i>Pending Smartlink Process</a>
                            </li>
                           <li> <a href="{{url('admin/smartlink-approve-process')}}"><i class="bx bx-right-arrow-alt"></i>Approve  Smartlink Process</a>
                            </li>
                              <li> <a href="{{url('admin/smartlink-waited-process')}}"><i class="bx bx-right-arrow-alt"></i>Waited  Smartlink Process</a>
                            </li>
                         
                           <li> <a href="{{url('admin/smartlink-rejected-process')}}"><i class="bx bx-right-arrow-alt"></i>Rejected Smartlink Process</a>
                            </li>
                         
                           
                        </ul>
                    </li>
                    
                   
                        <li>
                                
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-time"></i>
                            </div>
                            <div class="menu-title">APPROVAL REQUEST</div>
                        </a>
                        <ul>
                            <li> <a href="{{url('admin/approval-request')}}"><i class="bx bx-right-arrow-alt"></i>Offer Approval Request</a>
                            </li>
                
                         
                           <li> <a href="{{url('admin/publisher-approval-request')}}"><i class="bx bx-right-arrow-alt"></i>Publisher Approval Request</a>
                            </li>
                         
                            <li> <a href="{{url('admin/manage-smartlink-request')}}"><i class="bx bx-right-arrow-alt"></i>Smartlink Request</a>
                            </li>
                         
                           
                        </ul>
                    </li>
                           
                <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-current-location"></i>
                            </div>
                            <div class="menu-title">Domain</div>
                        </a>
                        <ul>
                    
                              <li> <a href="{{url('admin/manage-smartlink-domain')}}"><i class="bx bx-right-arrow-alt"></i>Smartlink Domain</a>
                            </li>
                         
                           <li> <a href="{{url('admin/manage-domain')}}"><i class="bx bx-right-arrow-alt"></i>Tracking Domain</a>
                            </li>
                         
                           
                        </ul>
                    </li>
                     
                          <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-diamond"></i>
                            </div>
                            <div class="menu-title">Category</div>
                        </a>
                        <ul>
                    
                              <li> <a href="{{url('admin/manage-categories')}}"><i class="bx bx-right-arrow-alt"></i>Offer Category</a>
                            </li>
                              <li> <a href="{{url('admin/manage-site-categories')}}"><i class="bx bx-right-arrow-alt"></i>Site Category</a>
                            </li>
                        </ul>
                    </li>
             
                     <li>
                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-user"></i>
                            </div>
                            <div class="menu-title">Manage Accounts </div>
                        </a>
                        <ul>
                    
                              <li> <a href="{{url('admin/manage-affliatemanager')}}"><i class="bx bx-right-arrow-alt"></i>Affliate Manager</a>
                            </li>
                               <li> <a href="{{url('admin/manage-publishers')}}"><i class="bx bx-right-arrow-alt"></i> Publishers</a>
                            </li>
                               <li> <a href="{{url('admin/manage-advertiser')}}"><i class="bx bx-right-arrow-alt"></i>Advertisers</a>
                            </li>
                        </ul>
                    </li>
                   
  


                        <li>
                        <a href="  {{url('admin/manage-news')}}">
                            <div class="parent-icon"><i class="bx bx-file"></i>
                            </div>
                            <div class="menu-title">News/Announcements</div>
                        </a>
                    </li>
                      <li>
                        <a href="  {{url('admin/messages')}}">
                            <div class="parent-icon"><i class="bx bx-comment-detail"></i>
                            </div>
                            <div class="menu-title">Messages</div>
                        </a>
                    </li>
                  
                           <li>



                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-refresh"></i>
                            </div>
                            <div class="menu-title">Cashout Request</div>
                        </a>
                        <ul>
                            
                             <li> <a href="{{url('admin/manage-cashout')}}"><i class="bx bx-right-arrow-alt"></i>Publisher</a>
                            </li>
                             <li> <a href="{{url('admin/manage-cashout-affliate')}}"><i class="bx bx-right-arrow-alt"></i>Affliate</a>
                            </li>
                             
                         
                           
                        </ul>
                    </li>
                        
                     
                      <li>



                        <a class="has-arrow" href="javaScript:;">
                            <div class="parent-icon"><i class="bx bx-link-external"></i>
                            </div>
                            <div class="menu-title">Postback</div>
                        </a>
                        <ul>
                            
                             <li> <a href="{{url('admin/manage-postback-log')}}"><i class="bx bx-right-arrow-alt"></i>Postback Logs Sent</a>
                            </li>
                             <li> <a href="{{url('admin/manage-postback-log-receive')}}"><i class="bx bx-right-arrow-alt"></i>Postback Logs Received</a>
                            </li>
                             
                         
                           
                        </ul>
                    </li>
                          <li>
                        <a href="{{url('admin/manage-ban-ip')}}">
                            <div class="parent-icon"><i class="bx bx-notification-off"></i>
                            </div>
                            <div class="menu-title">Ban Ip</div>
                        </a>
                    </li>
                    
                     <li>
                        <a href="{{url('admin/settings')}}">
                            <div class="parent-icon"><i class="bx bx-cog"></i>
                            </div>
                            <div class="menu-title">Settings</div>
                        </a>
                    </li>
                        <li>
                        <a href="{{url('admin/2fa')}}">
                            <div class="parent-icon"><i class="bx bx-lock"></i>
                            </div>
                            <div class="menu-title">Two Factor Authentication</div>
                        </a>
                    </li>
                      
                    
                </ul>
                <!--end navigation-->
            </div>
            <!--end sidebar-wrapper-->
            <!-- Left Sidebar End -->
@endsection('sidebar')