<div class="footer">

    <div>
        <strong>Denhthlay Admin</strong> - Copyright &copy; 2018
    </div>
</div> <!-- end footer -->

</div>
<!-- End #page-right-content -->

</div>
<!-- end .page-contentbar -->
</div>
<!-- End #page-wrapper -->



<!-- js placed at the end of the document so the pages load faster -->
<script src="{{url('admin/assets/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{url('admin/assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('admin/assets/js/metisMenu.min.js')}}"></script>
<script src="{{url('admin/assets/js/jquery.slimscroll.min.js')}}"></script>


<!-- Datatable js -->

<script src="{{url('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/dataTables.colVis.js')}}"></script>
<script src="{{url('admin/assets/plugins/datatables/dataTables.fixedColumns.min.js')}}"></script>

<script src="{{url('admin/assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{url('admin/assets/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/dropzone/dropzone.js')}}"></script>
<script src="{{url('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
<script src="{{url('admin/assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>

<!-- Dashboard init -->
<script src="{{url('admin/assets/pages/jquery.dashboard.js')}}"></script>
<!-- form advanced init js -->
<script src="{{url('admin/assets/pages/jquery.form-advanced.init.js')}}"></script>

<!-- App Js -->
<script src="{{url('admin/assets/js/jquery.app.js')}}"></script>

@yield('data')

<script type="text/javascript">
    function has_errors(input_name,label_error) {
        $(input_name).parent().removeClass('has-error');
        $(label_error).html( "" );
    }

    function errors(label_error,error_text,input_name) {
        $(input_name).parent().addClass('has-error');
        $(label_error).html(error_text);
    }

    //Alert
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr["info"]("{{Session::get('message')}}", "{{Session::get('title')}}");
            break;

        case 'warning':
            toastr["warning"]("{{Session::get('message')}}", "{{Session::get('title')}}");
            break;

        case 'success':
            toastr["success"]("{{Session::get('message')}}", "{{Session::get('title')}}");
            break;

        case 'error':
            toastr["error"]("{{Session::get('message')}}", "{{Session::get('title')}}");
            break;
    }
    @endif

    //Change image when input file
    function readURL(input,width,height) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#pic').fadeIn();
                $('#pic')
                    .attr('src', e.target.result)
                    .width(width)
                    .height(height)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#datepicker-autoclose').datepicker({
        format: 'mm/dd/yyyy',
        todayHighlight:'TRUE',
        autoclose: true
    })

    $('.clockpicker').clockpicker();

</script>


</body>
</html>