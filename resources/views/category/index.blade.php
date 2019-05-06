@extends('master')
@section('content')

    <!-- In Process-->
    <div class="no-class">
        <div class="">

            <br>
            <div style="width: 100%; height: 20px; border-bottom: 1px solid rgba(255,0,0,0.22); text-align: center">
                  <span style="font-size: 20px; background-color: #f3f3f3; padding: 0 20px;">
                    <b class="font-bg hd-cl">កំពុងដេញថ្លៃ</b>
                  </span>
            </div>
            <br>
        </div>
        <div class="row">

            @foreach($latest_pro as $l_item)
                <div class="col-sm-6 col-md-3">
                    <div class="deal-entry">
                        <img class="pull-right" src="{{url('storage/icons/alert_pro_red.png')}}" alt="">
                        <div class="title mid">
                            <a class="max-lines" href="{{url('/product/'.$l_item->gen_key)}}"  >
                                {{$l_item->name}}
                            </a>

                        </div>
                        <div class="image mid">
                            <a href="{{url('/product/'.$l_item->gen_key)}}"  >
                                <img src="{{url('storage/'.$l_item->image)}}" alt="#" height="200px"  width="100%" >
                            </a>

                        </div>
                        <!-- /.image -->

                        <div class="entry-content mid">
                            <h3 class="df-cl font-bg" >@if(!empty($l_item->auctions->last()->price))
                                    <span id="price-show-{{$l_item->id}}">{{ number_format($l_item->auctions->last()->price, 0) }}</span>
                                @else
                                    <span id="price-show2-{{$l_item->id}}"> {{ number_format($l_item->price, 0) }} </span>
                                @endif KHR</h3>

                            <b class="df-cl font-bg price-font ">
                                <p id="timer_value-{{$l_item->id}}"></p>
                            </b>
                        </div>
                        <!--/.entry content -->

                        <a id="auction-submit-{{$l_item->id}}" data-toggle="modal" data-target="#myModal-{{$l_item->id}}" class="button circle red" style="margin-bottom: 30px;background: rgba(236, 31, 31, 0.84);" href="#"><b class="font-bg" style="color: #fff">ដេញថ្លៃ</b></a>

                    </div>
                </div>

                <!--Modal-->
                <div class="modal fade" id="myModal-{{$l_item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom:none">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                      &times;
                    </span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <h3 class="modal-title" id="myModalLabel" style="text-align: center">
                                    {{$l_item->name}}
                                </h3>
                                <div class="panel panel-default">
                                    <div class="panel-heading">

                                        <div class="row">

                                            <div class="col-md-12 mid">
                                                <div class="col-md-3 col-sm-1"></div>
                                                <div class="image mid mb-5 col-md-6 col-sm-10">
                                                    <a href="{{url('/product/'.$l_item->gen_key)}}"  >
                                                        <img src="{{url('storage/'.$l_item->image)}}" alt="#" height="200px" width="100%">
                                                    </a>
                                                </div>
                                                <div class="col-md-3 col-sm-1"></div>
                                                <br>
                                                <br>
                                                <div class="col-md-12 col-sm-12"></div>


                                            </div>

                                            <div class="col-md-12 mid">
                                                <div class="col-md-1 col-sm-0"></div>
                                                <div class="col-md-10 col-sm-12">
                                                    <b class="font-md mid font-ms "​​>តម្លៃចុងក្រោយ</b>

                                                    <h3 class="df-cl font-bg">
                                                        @if(!empty($l_item->auctions->last()->price))
                                                            <span id="price-modal-{{$l_item->price}}">{{ number_format($l_item->auctions->last()->price, 0) }}</span>
                                                        @else
                                                            <span id="price-modal2-{{$l_item->price}}"> {{ number_format($l_item->price, 0) }} </span>
                                                        @endif
                                                        KHR</h3>

                                                    <b class="df-cl font-md mid font-ms"​​>សូមបញ្ចូលលេខទូរសព្ឌ៏ និង តំលៃឲ្យបានត្រឹមត្រូវ</b>
                                                </div>
                                                <div class="col-md-1 col-sm-0"></div>
                                            </div>

                                        </div>
                                        <!-- / row -->
                                        <form class="" role="form" method="POST" id="form-{{$l_item->id}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="pro_id" value="{{$l_item->id}}">
                                            <div class="row " style="margin-top: 10px;font-weight: bold">
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-10">
                                                    <label class="col-md-4 font-md font-ms mt-10">លេខទូរសព្ឌ៏ :</label>
                                                    <div class="col-md-8">

                                                        <input class="form-control input-phone-{{$l_item->id}}" id="bar" placeholder="(0--) 000-0000" type="text"  name="phone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);">
                                                        <span class="text-danger ">
                                                        <strong class="df-cl" id="phone-error-{{$l_item->id}}"></strong>
                                                    </span>
                                                    </div>

                                                    <label class="col-md-4 font-md font-ms mt-10">តំលៃ :</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-price-{{$l_item->id}}" name="price" placeholder="KHR" id="price-{{$l_item->id}}">
                                                        <span class="text-danger">
                                                           <strong class="df-cl" id="price-error-{{$l_item->id}}"></strong>
                                                    </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-1">

                                                </div>
                                            </div>

                                            <br>
                                            <div class="row ">
                                                <a type="submit" id="submit-{{$l_item->id}}" class="button circle red" style="margin-bottom: 30px;background: rgba(236, 31, 31, 0.84);" ><b class="font-bg" style="color: #fff">ដេញថ្លៃ</b></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $(function () {


                        var btn=$('#submit-{{$l_item->id}}');
                        btn.click(function (e) {
                            e.preventDefault();

                            has_errors('.input-phone-{{$l_item->id}}', '#phone-error-{{$l_item->id}}');
                            has_errors('.input-price-{{$l_item->id}}', '#price-error-{{$l_item->id}}');

                            /* Create new varaible that store all values from form From User\*/
                            var form = new FormData($("#form-{{$l_item->id}}")[0]);
                            $.ajax({
                                /* location to go*/
                                url: "{{route('products.auction')}}",
                                method: "POST",
                                dataType: 'json',
                                /* Send all values from Users to controller to check*/
                                data: form,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    /* When controller is complete it send back value to data*/
                                    console.log(data);

                                    /* Display all the errors message*/
                                    if (data.errors) {
                                        if (data.errors.phone) {
                                            if (data.errors.phone=='The phone field is required.'){
                                                $('.input-phone-{{$l_item->id}}').parent().addClass('has-error');
                                                $('#phone-error-{{$l_item->id}}').html('សូមបញ្ចូលលេខទូរសព្ឌ៏របស់អ្នក។');
                                            }else if (data.errors.phone=='The phone must be at least 12 characters.'){
                                                $('.input-phone-{{$l_item->id}}').parent().addClass('has-error');
                                                $('#phone-error-{{$l_item->id}}').html('លេខទូរសព្ឌ៏មិនអាចតិចជាង៩ខ្ឌង់បានទេ។');
                                            }
                                            // errors('#phone-error-{{$l_item->id}}', data.errors.phone[0], '.input-phone-{{$l_item->id}}');
                                        }

                                        if (data.errors.price) {
                                            if (data.errors.price=='The price field is required.'){
                                                $('.input-price-{{$l_item->id}}').parent().addClass('has-error');
                                                $('#price-error-{{$l_item->id}}').html('សូមបញ្ចូលតំលៃដេញថ្លៃរបស់អ្នក។');
                                            }else if (data.errors.price=='The price may not be greater than 21 characters.'){
                                                $('.input-price-{{$l_item->id}}').parent().addClass('has-error');
                                                $('#price-error-{{$l_item->id}}').html('តំលៃមិនអាចលើសពី 1,000,000,000,000,000 KHR បានទេ។');
                                            }

                                            //errors('#price-error-{{$l_item->id}}', data.errors.price[0], '.input-price-{{$l_item->id}}');
                                        }

                                    }

                                    /* Clear all the value when send is success*/
                                    if (data.verify == 'true') {
                                        $("#form-{{$l_item->id}}")[0].reset();
                                        $('#myModal-{{$l_item->id}}').modal('hide');
                                        $('#price-show-{{$l_item->id}}').html(data.price);
                                        $('#price-show2-{{$l_item->id}}').html(data.price);
                                        $('#price-modal-{{$l_item->price}}').html(data.price);
                                        $('#price-modal2-{{$l_item->price}}').html(data.price);

                                        swal({
                                            position: 'center',
                                            type: 'success',
                                            title: 'អ្នកបានដេញថ្លៃចំនួន <br><span style="font-size: 55px;color: #ed1f1f;">'+data.price+' KHR</span><br>ទៅលើ <br> <a href="/product/'+data.key+'"><img class="img" src="/storage/'+data.image+'" height="200px" width="200px" style="margin-top: 10px"></a>',
                                            showConfirmButton: false,
                                            showCloseButton: true,
                                            // timer: 6500
                                        })

                                    }else if(data.price=='false'){
                                        $('.input-price-{{$l_item->id}}').parent().addClass('has-error');
                                        $('#price-error-{{$l_item->id}}').html('សូមបញ្ចូលតំលៃដេញថ្លៃឲ្យធំជាងតំលៃចុងក្រោយ។');
                                    }

                                },
                                error: function (er) {
                                }
                            });
                        });
                    });

                    $('input#price-{{$l_item->id}}').on('input', function() {

                        this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ;

                        if (this.value.length>21){

                            //    alert($('#price-{{$l_item->id}}').val());
                            var cut= $('#price-{{$l_item->id}}').val().substring(0,21);
                            $('#price-{{$l_item->id}}').val(cut);
                        }

                        //this.value = this.value.split('00')[0] + "KHR" ;


                        //  if (this.value.length > 21)


                    });

                </script>

                <input type="hidden" id="day-{{$l_item->id}}" value="{{date('d', strtotime($l_item->end_date))}}">
                <input type="hidden" id="month-{{$l_item->id}}" value="{{date('F', strtotime($l_item->end_date))}}">
                <input type="hidden" id="year-{{$l_item->id}}" value="{{date('Y', strtotime($l_item->end_date))}}">
                <input type="hidden" id="hour-{{$l_item->id}}" value="{{date('H', strtotime($l_item->end_date))}}">
                <input type="hidden" id="min-{{$l_item->id}}" value="{{date('i', strtotime($l_item->end_date))}}">

                <script>
                    //Set Timer
                    var timer{{$l_item->id}};
                    $(function () {
                        clearInterval(timer{{$l_item->id}});

                        var timer_month=document.getElementById("month-{{$l_item->id}}").value;
                        var timer_day=document.getElementById("day-{{$l_item->id}}").value;
                        var timer_year=document.getElementById("year-{{$l_item->id}}").value;

                        var timer_hour=document.getElementById("hour-{{$l_item->id}}").value;
                        if(timer_hour=="")timer_hour=0;

                        var timer_min=document.getElementById("min-{{$l_item->id}}").value;
                        if(timer_min=="")timer_min=0;

                        var timer_date=timer_month+"/"+timer_day+"/"+timer_year+" "+timer_hour+":"+timer_min;

                        var end = new Date(timer_date); // Arrange values in Date Time Format
                        var now = new Date(); // Get Current date time
                        var second = 1000; // Total Millisecond In One Sec
                        var minute = second * 60; // Total Sec In One Min
                        var hour = minute * 60; // Total Min In One Hour
                        var day = hour * 24; // Total Hour In One Day

                        function showtimer() {
                            var now = new Date();
                            var remain = end - now; // Get The Difference Between Current and entered date time
                            if(remain < 0)
                            {
                                clearInterval(timer{{$l_item->id}});
                                document.getElementById("timer_value-{{$l_item->id}}").innerHTML = 'បានបញ្ចប់';
                                //$('#myModal-{{$l_item->id}}').hide();
                                //  $('#myModal-{{$l_item->id}}').remove();
                                $('#myModal-{{$l_item->id}}').modal('hide');
                                document.getElementById("auction-submit-{{$l_item->id}}").innerHTML = '<a  class="button circle" style="margin-bottom: 30px;cursor: default" href="javascript:void(0)"><b class="font-bg" style="color: #fff;cursor: default">ដេញថ្លៃ</b></a>';
                                document.getElementById("auction-submit-{{$l_item->id}}").disabled = true;
                                document.getElementById("submit-{{$l_item->id}}").disabled = true;

                                return;

                            }
                            var days = Math.floor(remain / day); /// Get Remaining Days
                            var hours = Math.floor((remain % day) / hour); /// Get Remaining Hours
                            var minutes = Math.floor((remain % hour) / minute); /// Get Remaining Min
                            var seconds = Math.floor((remain % minute) / second); /// Get Remaining Sec

                            document.getElementById("timer_value-{{$l_item->id}}").innerHTML = days + 'ថ្ងៃ ';
                            document.getElementById("timer_value-{{$l_item->id}}").innerHTML += hours + 'ម៉ោង ';
                            document.getElementById("timer_value-{{$l_item->id}}").innerHTML += minutes + 'នាទី ';
                            document.getElementById("timer_value-{{$l_item->id}}").innerHTML += seconds + 'វិនាទី';
                        }
                        timer{{$l_item->id}} = setInterval(showtimer, 1000); // Display Timer In Every 1 Sec
                    })

                </script>
            @endforeach

        </div>
        <!--/.row -->
    </div>

    <div class="container" style="text-align: center">
        @if($paginate=='true')

            <ul class="pagination ">

                @if(!empty($latest_pro->previousPageUrl()))
                    <li class="page-item">
                        <a class="page-link" href="{{$latest_pro->previousPageUrl()}}" aria-label="Previous">
                            <span aria-hidden="true">&lt;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif

                @php
                    $page=0;
                    $total=$latest_pro->total();
                    $page=ceil($total/$per_page);
                    $active_page='';
                   // var_dump($page);
                @endphp

                @for($i=1;$i<=$page;$i++)
                    @if($i==$latest_pro->currentPage())
                        @php($active_page='active')
                    @else
                        @php($active_page='')
                    @endif

                    <li class="page-item {{$active_page}}">
                        <a class="page-link" href="{{$latest_pro->url($i)}}">{{$i}}</a>
                    </li>
                @endfor

                @if(!empty($latest_pro->nextPageUrl()))
                    <li class="page-item">
                        <a class="page-link" href="{{url($latest_pro->nextPageUrl())}}" aria-label="Next">
                            <span aria-hidden="true">&gt;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif
    </div>
@endsection