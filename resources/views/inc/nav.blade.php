<div class="container">
    <div class="row">
        <div class="col-sm-3 sidebar" >
            <div class="bg-white shadow" >
                <div class="widget-menu"​ >
                    <!-- Sidebar navigation -->
                    <ul class="nav sidebar-nav nav-cus">

                        @foreach($cats as $item)
                        <li>
                                <a href="{{url('/category/'.$item->slug)}}">
                                    <img class="img img-rounded" src="{{url('storage/'.$item->image)}}" alt=""  height="20px">
                                       <b>{{$item->name}}</b>
                                <span class="sidebar-badge badge-circle">
                                    @php
                                        $n=0;
                                    @endphp
                                    @foreach($count_pro as $c_p)
                                        @if($c_p->cat_id==$item->id)
                                            @php
                                                $n++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    {{$n}}
                                </span>
                            </a>
                        </li>
                        @endforeach


                    </ul>
                    <!-- Sidebar divider -->
                </div>
                <!-- /.widget -->



            </div>
            <!-- /col 4 - sidebar -->
        </div>
        <div class="col-sm-9">
            <div class="slider">

                <div class="row">
                    <div class="carousel slide" data-ride="carousel" id="carousel-example-generic">
                        <!-- Indicators -->
                        <ol class="carousel-indicators col-lg-10">
                            @php
                                $active='active';
                            @endphp
                            @foreach($slides as $sl)
                            <li data-target="#carousel-example-generic" data-slide-to="{{$loop->iteration-1}}" class="{{$active}}"></li>
                            @php
                                $active='';
                            @endphp
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @php
                                $active='active';
                            @endphp
                            @foreach($slides as $sl)
                            <div class="item {{$active}}">
                                <img src="{{url('storage/'.$sl->image)}}" style="width:863px;height:420px"/>
                            </div>
                                @php
                                    $active='';
                                @endphp
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <a class="" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                </div>

            </div>
            <!-- /slider -->
        </div><!-- /.col -9  -->

    </div><!-- /.row -->
</div><!-- /.container -->