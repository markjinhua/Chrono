
@section('footer')    <!-- End Page-content -->

  
         <?php
    $site_settings=DB::table('site_settings')->select('cdn_url')->first();
    ?>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{$site_settings->cdn_url}}js/jquery.min.js"></script>
    <script src="{{$site_settings->cdn_url}}js/popper.min.js"></script>
    <script src="{{$site_settings->cdn_url}}js/bootstrap.min.js"></script>
    <!--plugins-->
    <script src="{{$site_settings->cdn_url}}plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{$site_settings->cdn_url}}plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{$site_settings->cdn_url}}plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Apex chart-->
    <script src="{{$site_settings->cdn_url}}plugins/apexcharts-bundle/js/apexcharts.min.js"></script>

    <script src="{{$site_settings->cdn_url}}js/index.js"></script>
    <!-- App JS -->
    <script src="{{$site_settings->cdn_url}}js/app.js"></script>
    
 <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
 
<script src="{{$site_settings->cdn_url}}plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{$site_settings->cdn_url}}plugins/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            //Default data table
            $('#example').DataTable({ordering:false});
            var table = $('#example2').DataTable({
                lengthChange: false,
                ordering:false,
                buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            });

            table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
     $('.js-example-basic-multiple').select2();
          
        });
    </script>

    
    
</body>

</html>
            @endsection('footer')
