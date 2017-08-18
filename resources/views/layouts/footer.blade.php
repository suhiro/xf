
<footer class="page-footer">
<div class="page-footer-inner">{{date("Y")}} &copy; Jingyi Su</div>
<div class="scroll-to-top" style="display: block;"><i class="icon-arrow-up"></i></div>
</footer>




<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>

<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="{{URL::asset('assets/global/plugins/jquery-migrate.min.js')}}" ></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" ></script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> -->
<script src="{{URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" ></script>

<script src="{{URL::asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jquery.blockui.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jquery.cokie.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{URL::asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/flot/jquery.flot.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jquery.pulsate.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" ></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="{{URL::asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" ></script>
<script src="{{URL::asset('assets/global/plugins/jquery.sparkline.min.js')}}" ></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{URL::asset('assets/global/scripts/metronic.js')}}" ></script>
<script src="{{URL::asset('assets/admin/layout/scripts/layout.js')}}" ></script>
<script src="{{URL::asset('assets/admin/layout/scripts/quick-sidebar.js')}}" ></script>
<script src="{{URL::asset('assets/admin/layout/scripts/demo.js')}}" ></script>
<script src="{{URL::asset('assets/admin/pages/scripts/index.js')}}" ></script>
<script src="{{URL::asset('assets/admin/pages/scripts/tasks.js')}}" ></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
});
</script>
<!-- END JAVASCRIPTS -->

