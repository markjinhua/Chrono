  
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>DreamAff - Publisher Register</title>
    <!--favicon-->


        <link href="{{asset('dashboard_assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard_assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{asset('dashboard_assets/plugins/smart-wizard/css/smart_wizard_all.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- loader-->
    <link href="{{asset('dashboard_assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('dashboard_assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/bootstrap.min.css')}}" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/icons.css')}}" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/app.css')}}" />
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/dark-style.css')}}" />
    <style type="text/css">
      #smartwizard{
        border:none!important;
      }
    </style>
  </head>

  <body>
    <!-- wrapper -->
    <div class="wrapper">
     
     <div class="section-authentication">
       <div class="container-fluid mt-5" >
              <div class="row no-gutters">

         <div class="col-lg-6  d-flex align-items-stretch m-auto  "  >
        <div class="card mb-0 m-auto" style="height: 100%;width: 100%"  >
         <div class="card-body p-0">
        
           
              <div class="card mb-0 shadow-none bg-transparent w-100 login-ca rounded-0" style="border-right: none!important;">
                 <div class="card-body p-md-5 text-center">
                         <?php $qry=DB::table('site_settings')->first();?>
    

                  <img src="{{asset('site_images')}}/{{$qry->logo}}" width="180" alt=""/>
            
                     <h4 class="mt-2 "><strong>Publisher Register</strong></h4>

                     
                      @if($errors->any())

<div class="alert alert-danger"> 
    {!! implode('', $errors->all('<div>:message</div>')) !!}
 
</div>
@endif

                     <div class="form-group mt-4">
                     <form method="POST" action="{{ route('publisher.register.submit') }}">
                            @csrf
 <input type="hidden" name="hidden_country">
 <input type="hidden" name="affliate" value="{{ app('request')->input('id') }}">
                            <!-- SmartWizard html -->
                            <div id="smartwizard">
                                <ul class="nav ">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-1"> <strong>Step 1</strong> 
                                            <br>Account Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-2"> <strong>Step 2</strong> 
                                            <br>Website Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-3"> <strong>Step 3</strong> 
                                            <br>Additional Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-4"> <strong>Step 4</strong> 
                                            <br>Confirmation</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">

                                     
                                                <div class="col-lg-12 m-auto">
                                        <div class="form-group">
                                            <label><b>Select Account Type</b></label>
                                            <select class="form-control @error('account_type') is-invalid @enderror" name="account_type" id="account_type" >
                                                <option value="">Select Account Type </option>
                                                <option value="Individual">Individual</option>
                                                <option  value="Company">Company</option>
                                            </select>
                                   
                                    </div>
                                  </div>

                                    <div class="col-lg-12 m-auto"  id="account_type_hidden" style="visibility:hidden">
                                        <div class="form-group">
                                           
                                            <select class="form-control " name="publisher_type" id="publisher_type" >
                                               
                                                <option value="1">CPA NETWORK</option>
                                                <option  value="0">SMARTLINK NETWORK</option>
                                            </select>
                                   
                                    </div>
                                  </div>
                                       
                                 
                                      <div class="col-lg-12 m-auto  " >
                                        <div class="form-group" id="company_name" style="visibility:hidden" >
                                            <label><b>Company Name</b></label>
                                           <input type="text" placeholder="Enter Your Company Name" class="form-control @error('company_name') is-invalid @enderror" name="company_name">
                                       
                                    </div>
                                  </div>
                              </div>
                                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                       
                                      <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Full Name</b></label>
                                           <input type="text" placeholder="Enter Your Full Name" class="form-control @error('name') is-invalid @enderror" name="name">
                                   
                                    </div>
                                  </div>
                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Email</b></label>
                                           <input type="text" placeholder="Enter Your Email" class="form-control @error('email') is-invalid @enderror" name="email">
                                   
                                    </div>
                                  </div>
                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Password</b></label>
                                           <input type="text" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password">
                                     @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                  </div>
                                 

                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Address</b></label>
                                           <input type="text" placeholder="Enter Your Address" class="form-control @error('address') is-invalid @enderror" name="address">
                                   
                                    </div>
                                  </div>
                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Country</b></label>
  <select class="form-control" name="country" > 

        <?php 
    $qry=DB::table('countries')->where('country_name','!=','All')->get();
    
    foreach($qry as $q){
      ?>
        <option value="{{$q->country_name}}" >{{$q->country_name}}</option>
    <?php }?>

</select>
</div>
  </div>
                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>City</b></label>
                                           <input type="text" placeholder="Enter Your City" class="form-control @error('city') is-invalid @enderror" name="city">
                                   
                                    </div>
                                  </div>
                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Region</b></label>
                                           <input type="text" placeholder="Enter Region" class="form-control @error('region') is-invalid @enderror" name="region">
                                   
                                    </div>
                                  </div>
                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Zip/Postal Code</b></label>
                                           <input type="text" placeholder="Enter Zip/Postal Code" class="form-control @error('zip') is-invalid @enderror" name="zip">
                                   
                                    </div>
                                  </div>
                                   <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Skype</b></label>
                                           <input type="text" placeholder="Enter Skype Name " class="form-control @error('skype') is-invalid @enderror" name="skype">
                                   
                                    </div>
                                  </div>
                                    <div class="col-lg-12 m-auto  pb-5" >
                                           <label><b>Phone</b></label>
                                        <div class="form-group"  >
                                         
                                        <select class="form-control" name="phone_code"   style="width: 20%;float: left;" > 

        
                <?php 
        $qry=DB::table('countries')->get();
      
        foreach($qry as $q){
            ?>
            <option value="{{$q->phonecode}}">{{$q->phonecode}}-{{$q->country_name}}</option>
        <?php }?>

     

</select>
                                           <input type="text" placeholder="Enter Phone Number " style="width: 80%;float: left" class="form-control @error('phone') is-invalid @enderror" name="phone">
                                   
                                    </div>
                                  </div>
                                    </div>
                                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">

      <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Website Url</b></label>
                                           <input type="text" placeholder="Enter Website Url " class="form-control @error('website_url') is-invalid @enderror" name="website_url">
                                   
                                    </div>
                                  </div>

      <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                            <label><b>Monthly Traffic</b></label>
                                       
                                              <select  class="form-control @error('monthly_traffic') is-invalid @enderror" name="monthly_traffic"  > 
            <option value="">Select  Traffic</option>
          <option value="Less than 1k">  Less than 1k</option>
            <option value="1K to 5K">1K to 5K</option>
              <option value="5K to 10K">5K to 10K</option>
              <option value="10K to 50K">10K to 50K</option>
              <option value="50K  to 100K">50K  to 100K</option>
              <option value="100K to 1M">100K to 1M</option>
              <option value="More than 1 M">More than 1 M</option>



                                   </select>
                                    </div>
                                  </div>
  <div class="col-lg-12 m-auto  " >
                                        <div class="form-group"  >
                                                <label><b>Site Category</b></label>
                                  <select  name="category" class="form-control @error('category') is-invalid @enderror"  > 
            <option value="">Select  Category</option>
            
            <?php 
        $qry=DB::table('site_category')->get();
        foreach($qry as $q){?>
 <option value="{{$q->site_category_name}}" >{{$q->site_category_name}}</option>
 
  <?php }
  ?>        </select>
</div>
</div>
                                     <div class="col-lg-12 m-auto  " >
                                    
                                        <div class="form-group"  >
                                      <label><b>Describe how do you do promotions of CPA or CPL Offers</b></label>
                                      <textarea rows="6" name="additional_information" class="form-control"></textarea>
                                    </div>
                                    </div>
                                      <div class="col-lg-12 m-auto  " >
                                    
                                        <div class="form-group"  >
                                      <label><b>How did you hear about Us ?</b></label>
                                      <textarea rows="3"  name="hereby" class="form-control"></textarea>
                                    </div>
                                    </div>
                                </div>
                                  
                                    <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                            <div class="col-lg-6 m-auto  " >
                                        <input type="checkbox" name="terms" checked="" value="1" readonly="true"><b style="font-size: 18px">
                                    
By submitting this form, You agree to Our <a href="https://hasprofit.com/privacy.html">Privacy Policy</a> and <a href="https://hasprofit.com/terms.html">Our Terms and Conditions</a></b>
                                  <br>

                                  <input type="checkbox" name="updates" checked="" value="1" readonly="true"><b style="font-size: 18px">
                                   Yes! Send me updates and Notificatios from DreamAff.com</b> 
</div>
                     
                    </div>
                </div>

            </div>

         
            </div>
    
                   
              
              </div>
              <button type="submit" style="visibility: hidden;" id="submit">Submit</button>
           <div class="row  pb-5 ">
<div class="col-lg-12 text-center">
         <a  href="{{url('publisher/login')}}"><u>Have an account ? Login here</u></a>

       </div>
            </div>
          </form>
 
             
          </div>
          
           </div>
         </div>
      </div>
      
    </div>
       <p class="m-auto text-center " style="margin-top: 20px!important"><b>&copy; Copyright Hasprofit </b></p>
    <!-- end wrapper -->
   
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="{{asset('dashboard_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/bootstrap.min.js')}}"></script>
    <!--plugins-->
    
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard_assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('dashboard_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('dashboard_assets/plugins/smart-wizard/js/jquery.smartWizard.min.js')}}"></script><!DOCTYPE html> 
<html> 
 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 


<script type="text/javascript"> 


    $.ajax({
        method:'get',
        url:"{{url('countries')}}",
        dataType:'json',
        async:'false',
success:function(res){
 var html='';
 let response;
     $.ajax('https://freegeoip.app/json/')
  .then(
      function success(response) {
 
      $('input[name=hidden_country]').val(response.country_name);
         for(var i=0;i<res.length;i++){
if(response.country_code==res[i].iso){

    html+='<option value='+res[i].phonecode+' selected="selected">'+res[i].phonecode+'-'+res[i].country_name+'</option>';
  
}else{
    html+='<option value='+res[i].phonecode+'>'+res[i].phonecode+'-'+res[i].country_name+'</option>';
  }
}  

  $('select[name=phone_code]').html(html);
},
      function fail(data, status) {
          console.log('Request failed.  Returned status of',
                      status);
      }
    );}
})

  var geocoder;
 
</script> 
    <script>
        $(document).ready(function () {
     

 

 
            // Toolbar extra buttons
            var btnFinish = $('<button id="finish"></button>').text('Finish').addClass('btn btn-info').on('click', function () {
               $('#submit').click();
            });
            var btnCancel = $('<button></button>').text('Cancel').addClass('btn btn-danger').on('click', function () {
                $('#smartwizard').smartWizard("reset");
            });
            // Step show event
            $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
                $('#finish').addClass('disabled');
                            if (stepPosition === 'first') {

                    $("#prev-btn").addClass('disabled');
                } else if (stepPosition === 'last') {
                    $('#finish').removeClass('disabled');
                    $("#next-btn").addClass('disabled');
                } else {
                      $('#finish').addClass('disabled');
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });
            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                transition: {
                    animation: 'fade', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                },
                  enableURLhash: false, 
                toolbarSettings: {
                    toolbarPosition: '', // both bottom
                    toolbarExtraButtons: [btnFinish]
                }
            });
            // External Button Events
            $("#reset-btn").on("click", function () {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });
            $("#prev-btn").on("click", function () {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });
            $("#next-btn").on("click", function () {
                // Navigate next

                $('#smartwizard').smartWizard("next");
                return true;
            });
            // Demo Button Events
            $("#got_to_step").on("change", function () {
                // Go to step

                var step_index = $(this).val() - 1;
                $('#smartwizard').smartWizard("goToStep", step_index);
                return true;
            });
            $("#is_justified").on("click", function () {
                // Change Justify
                var options = {
                    justified: $(this).prop("checked")
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
            $("#animation").on("change", function () {
                // Change theme
                var options = {
                    transition: {
                        animation: $(this).val()
                    },
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
            $("#theme_selector").on("change", function () {
                // Change theme
                var options = {
                    theme: $(this).val()
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
        });
                  $('#account_type').change(function(){
                if($('#account_type').val()=='Company'){
$('#account_type_hidden').removeAttr('style','visibility:hidden');
                    $('#company_name').removeAttr('style','visibility:hidden');
                }
                else if($('#account_type').val()=='Individual'){
$('#account_type_hidden').removeAttr('style','visibility:hidden');
  $('#company_name').attr('style','visibility:hidden');
                }
                else{
                           $('#company_name').attr('style','visibility:hidden');
                           $('#account_type_hidden').attr('style','visibility:hidden');
                }
            })
    </script>
    <!-- App JS -->
    <script src="{{asset('assets/js/app.js')}}"></script>
  </body>
</html>
