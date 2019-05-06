@include('admin.inc.header')
@include('admin.inc.nav')

                    <div class="container">
                        <div class="row">
								@yield('content')
						</div>
                        <!--end row -->
                    </div>
                    <!-- end container -->

@include('admin.inc.footer')