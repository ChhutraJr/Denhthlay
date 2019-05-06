

<!--left navigation start-->
<aside class="sidebar-navigation">
    <div class="scrollbar-wrapper">
        <div>

            <button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
                <i class="mdi mdi-close"></i>
            </button>
            <!-- User Detail box -->
            <div class="user-details">
                <div class="pull-left">
                    <img src="{{url('storage/'.Auth::user()->profile)}}" alt="" class="thumb-md img-circle">
                </div>
                <div class="user-info">
                    <a href="{{url('system/users')}}">{{Auth::user()->name}}</a>
                </div>
            </div>
            <!--- End User Detail box -->

            <!-- Left Menu Start -->
            <ul class="metisMenu nav" id="side-menu">
                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-user"></i> User Management <span class="fa arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="{{url('/system/users')}}">All Users</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-package"></i> Products <span class="fa arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="{{url('/system/products')}}">All Products</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-menu"></i> Categories <span class="fa arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="{{url('/system/categories')}}">All Categories</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-layout-slider-alt"></i> Slideshow <span class="fa arrow"></span></a>
                    <ul class="nav-second-level nav" aria-expanded="true">
                        <li><a href="{{url('/system/slide_show')}}">All Slideshow</a></li>

                    </ul>
                </li>


            </ul>
        </div>
    </div><!--Scrollbar wrapper-->
</aside>
<!--left navigation end-->

<!-- START PAGE CONTENT -->
<div id="page-right-content">