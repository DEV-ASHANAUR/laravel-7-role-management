<script src="{{ asset('backend') }}/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('backend') }}/assets/js/popper.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/metisMenu.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    {{-- toastr js --}}
    <script src="{{ asset('backend') }}/alert/toastr.min.js"></script>
    <!-- all line chart activation -->
    <script src="{{ asset('backend') }}/assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="{{ asset('backend') }}/assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="{{ asset('backend') }}/assets/js/plugins.js"></script>
    <script src="{{ asset('backend') }}/assets/js/scripts.js"></script>

    <script>
        @if(Session::has('message'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
            case 'info':
                  toastr.info("{{ Session::get('message') }}");
                  break;
            case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
            case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
            case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif  
      </script>