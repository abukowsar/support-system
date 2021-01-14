<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@if(isset($assets) && in_array('chart', $assets))
    <!-- Optional JS -->
    <script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
@endif

<!-- Argon JS -->
<script src="{{ asset('js/argon.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@if(isset($assets) && in_array('datatable', $assets))
    <!-- Datatables Js  -->
    <script src="{{ asset('assets/vendor/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@endif

@if(isset($assets) && (in_array('textarea',$assets) || in_array('editor',$assets)))
    <script src="{{ asset("vendor/tinymce/js/tinymce/tinymce.min.js") }}"></script>
    <script src="{{ asset("vendor/tinymce/js/tinymce/jquery.tinymce.min.js") }}"></script>
@endif

@if(isset($assets) && in_array('simditor', $assets))
<script type="text/javascript" src=" {{ asset('assets/vendor/simditor/js/module.js')}}"></script>
<script type="text/javascript" src=" {{ asset('assets/vendor/simditor/js/hotkeys.js')}}"></script>
<script type="text/javascript" src=" {{ asset('assets/vendor/simditor/js/simditor.js')}}"></script>
@endif

<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<!-- Global Message -->
@include('helper.app_mesage')

<!-- Dynamic Add script-->
@include('partials._dynamic_script')
