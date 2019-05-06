@extends('master')
@section('content')
    <div class="col-md-12">

    </div>
    <h3 class=" font-bg">{{$product->name}}</h3>

    <!-- if want to change size change in image on line 15 and 35 -->

    <div class="col-md-12" style="background: white">

        <div class="col-md-4" style="border-right: 1px solid rgba(255,0,0,0.09)">

                <div class="image mid">

                        <img  src="{{url('storage/'.$product->image)}}" alt="#" height="302px" width="100%" >

                </div>

        </div>
        <div class="col-md-4" style="border-right: 1px solid rgba(255,0,0,0.09)">

            <div class="col-md-12 mid" style="margin-top: 23px">
                <b class="font-md mid font-ms"​​>តម្លៃចុងក្រោយ</b>

                <h3 class="df-cl font-bg" >@if(!empty($product->auctions->last()->price))
                        <span id="price-show-{{$product->id}}">{{ number_format($product->auctions->last()->price, 0) }}</span>
                    @else
                        <span id="price-show2-{{$product->id}}"> {{ number_format($product->price, 0) }} </span>
                    @endif KHR</h3>
                <b class="df-cl font-bg price-font">
                    <p id="timer_value-{{$product->id}}"></p>
                </b>

                <a id="auction-submit-{{$product->id}}" data-toggle="modal" data-target="#myModal-{{$product->id}}" class="button circle red" style="margin-bottom: 109px;margin-top: 15px;background: rgba(236, 31, 31, 0.84);" href="#"><b class="font-bg" style="color: #fff">ដេញថ្លៃ</b></a>

            </div>

        </div>
        <div class="col-md-4">
                <div class="col-md-12 mid" style="margin-top: 23px;margin-bottom: 5px">
                    <b class="font-md mid font-ms"​​>ប្រវត្តិដេញថ្លៃ</b>
                </div>

                <table class="cart-contents blk" style="font-size: 12px">
                    <thead>
                    <tr>
                        <th class="hidden-xs">
                            ពេលវេលា
                        </th>
                        <th>
                            តំលៃ
                        </th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($auctions as $au)
                        @if($loop->iteration==3)
                            <tr style="border-bottom: 1px solid transparent">
                                <td class="qty">
                                    <b>ថ្ងៃទី {{$au->created_at}}</b>
                                </td>
                                <td class="qty">
                                    <b>{{ number_format($au->price, 0) }} KHR</b>
                                </td>
                            </tr>
                            @break($au)
                        @endif
                     <tr>
                        <td class="qty">
                            <b>ថ្ងៃទី {{$au->created_at}}</b>
                        </td>
                        <td class="qty">
                            <b>{{ number_format($au->price, 0) }} KHR</b>
                        </td>
                    </tr>
                    @endforeach



                    </tbody>

                </table>
                <!-- /Cart Contents -->

          <!--  <style>
                .table-wrapper
                {
                    width: 370px;
                    height: 250px;
                    overflow: auto;
                }

                table
                {
                    margin-right: 20px;
                }

                td
                {
                    width: 20px;
                    height: 20px;
                }
            </style>
            -->
        </div>
    </div>

    <div class="col-md-12" style="background: white;">
        <div role="tabpanel"  class="tabbable responsive">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab-1" aria-controls="home" role="tab" data-toggle="tab" class="font-bg font-ms">
                        <b class="font-md font-ms">ការបរិយាយ</b>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">
                        <b class="font-md font-ms">ការដឹកជញ្ចូន</b>
                    </a>
                </li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab-1">
                            <h4>
                                {!! $product->description !!}
                            </h4>

                        </div>
                        <!-- /tab content -->
                        <div role="tabpanel" class="tab-pane" id="reviews">
                            <h4>
                                {!! $product->delivery_info !!}
                            </h4>
                        </div>

                    </div>
                </div>
                <!--/tabs -->
            </div>
            <!-- /inner widget -->

        </div>
    </div>

    <div class="modal fade" id="myModal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        {{$product->name}}
                    </h3>
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-md-12 mid">
                                    <div class="image mid mb-5">
                                        <a href="{{url('/product/'.$product->gen_key)}}" target="_blank" >
                                            <img src="{{url('storage/'.$product->image)}}" alt="#" height="200px" >
                                        </a>
                                    </div>

                                    <b class="font-md mid font-ms "​​>តម្លៃចុងក្រោយ</b>

                                    <h3 class="df-cl font-bg">
                                        @if(!empty($product->auctions->last()->price))
                                            <span id="price-modal-{{$product->price}}">{{ number_format($product->auctions->last()->price, 0) }}</span>
                                        @else
                                            <span id="price-modal2-{{$product->price}}"> {{ number_format($product->price, 0) }} </span>
                                        @endif
                                        KHR</h3>

                                    <b class="df-cl font-md mid font-ms"​​>សូមបញ្ចូលលេខទូរសព្ឌ៏ និង តំលៃឲ្យបានត្រឹមត្រូវ</b>

                                </div>

                            </div>
                            <!-- / row -->
                            <form class="" role="form" method="POST" id="form-{{$product->id}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="pro_id" value="{{$product->id}}">
                                <div class="row " style="margin-top: 10px;font-weight: bold">
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-10">
                                        <label class="col-md-4 font-md font-ms mt-10">លេខទូរសព្ឌ៏ :</label>
                                        <div class="col-md-8">

                                            <input class="form-control input-phone-{{$product->id}}" id="bar" placeholder="(0--) 000-0000" type="text"  name="phone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);">
                                            <span class="text-danger ">
                                                        <strong class="df-cl" id="phone-error-{{$product->id}}"></strong>
                                                    </span>
                                        </div>

                                        <label class="col-md-4 font-md font-ms mt-10">តំលៃ :</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control input-price-{{$product->id}}" name="price" placeholder="KHR" id="price-{{$product->id}}">
                                            <span class="text-danger">
                                                           <strong class="df-cl" id="price-error-{{$product->id}}"></strong>
                                                    </span>
                                        </div>
                                    </div>

                                    <div class="col-md-1">

                                    </div>
                                </div>

                                <br>
                                <div class="row ">
                                    <a type="submit" id="submit-{{$product->id}}" class="button circle red" style="margin-bottom: 30px;background: rgba(236, 31, 31, 0.84);" ><b class="font-bg" style="color: #fff">ដេញថ្លៃ</b></a>
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


            var btn=$('#submit-{{$product->id}}');
            btn.click(function (e) {
                e.preventDefault();

                has_errors('.input-phone-{{$product->id}}', '#phone-error-{{$product->id}}');
                has_errors('.input-price-{{$product->id}}', '#price-error-{{$product->id}}');

                /* Create new varaible that store all values from form From User\*/
                var form = new FormData($("#form-{{$product->id}}")[0]);
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
                                    $('.input-phone-{{$product->id}}').parent().addClass('has-error');
                                    $('#phone-error-{{$product->id}}').html('សូមបញ្ចូលលេខទូរសព្ឌ៏របស់អ្នក។');
                                }else if (data.errors.phone=='The phone must be at least 12 characters.'){
                                    $('.input-phone-{{$product->id}}').parent().addClass('has-error');
                                    $('#phone-error-{{$product->id}}').html('លេខទូរសព្ឌ៏មិនអាចតិចជាង៩ខ្ឌង់បានទេ។');
                                }
                                // errors('#phone-error-{{$product->id}}', data.errors.phone[0], '.input-phone-{{$product->id}}');
                            }

                            if (data.errors.price) {
                                if (data.errors.price=='The price field is required.'){
                                    $('.input-price-{{$product->id}}').parent().addClass('has-error');
                                    $('#price-error-{{$product->id}}').html('សូមបញ្ចូលតំលៃដេញថ្លៃរបស់អ្នក។');
                                }else if (data.errors.price=='The price may not be greater than 21 characters.'){
                                    $('.input-price-{{$product->id}}').parent().addClass('has-error');
                                    $('#price-error-{{$product->id}}').html('តំលៃមិនអាចលើសពី 1,000,000,000,000,000 KHR បានទេ។');
                                }

                                //errors('#price-error-{{$product->id}}', data.errors.price[0], '.input-price-{{$product->id}}');
                            }

                        }

                        /* Clear all the value when send is success*/
                        if (data.verify == 'true') {
                            $("#form-{{$product->id}}")[0].reset();
                            $('#myModal-{{$product->id}}').modal('hide');
                            $('#price-show-{{$product->id}}').html(data.price);
                            $('#price-show2-{{$product->id}}').html(data.price);
                            $('#price-modal-{{$product->price}}').html(data.price);
                            $('#price-modal2-{{$product->price}}').html(data.price);

                            swal({
                                position: 'center',
                                type: 'success',
                                title: 'អ្នកបានដេញថ្លៃចំនួន <br><span style="font-size: 55px;color: #ed1f1f;">'+data.price+' KHR</span><br>ទៅលើ <br> <a href="/product/'+data.key+'"><img class="img" src="/storage/'+data.image+'" height="200px" width="200px" style="margin-top: 10px"></a>',
                                showConfirmButton: false,
                                showCloseButton: true,
                                // timer: 6500
                            })

                        }else if(data.price=='false'){
                            $('.input-price-{{$product->id}}').parent().addClass('has-error');
                            $('#price-error-{{$product->id}}').html('សូមបញ្ចូលតំលៃដេញថ្លៃឲ្យធំជាងតំលៃចុងក្រោយ។');
                        }

                    },
                    error: function (er) {
                    }
                });
            });
        });

        $('input#price-{{$product->id}}').on('input', function() {

            this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ;

            if (this.value.length>21){

                //    alert($('#price-{{$product->id}}').val());
                var cut= $('#price-{{$product->id}}').val().substring(0,21);
                $('#price-{{$product->id}}').val(cut);
            }

            //this.value = this.value.split('00')[0] + "KHR" ;


            //  if (this.value.length > 21)


        });

    </script>

    <input type="hidden" id="day-{{$product->id}}" value="{{date('d', strtotime($product->end_date))}}">
    <input type="hidden" id="month-{{$product->id}}" value="{{date('F', strtotime($product->end_date))}}">
    <input type="hidden" id="year-{{$product->id}}" value="{{date('Y', strtotime($product->end_date))}}">
    <input type="hidden" id="hour-{{$product->id}}" value="{{date('H', strtotime($product->end_date))}}">
    <input type="hidden" id="min-{{$product->id}}" value="{{date('i', strtotime($product->end_date))}}">

    <script>

        //Set Timer
        var timer{{$product->id}};
        $(function () {
            clearInterval(timer{{$product->id}});

            var timer_month=document.getElementById("month-{{$product->id}}").value;
            var timer_day=document.getElementById("day-{{$product->id}}").value;
            var timer_year=document.getElementById("year-{{$product->id}}").value;

            var timer_hour=document.getElementById("hour-{{$product->id}}").value;
            if(timer_hour=="")timer_hour=0;

            var timer_min=document.getElementById("min-{{$product->id}}").value;
            if(timer_min=="")timer_min=0;

            var timer_date=timer_month+"/"+timer_day+"/"+timer_year+" "+timer_hour+":"+timer_min;

            var end = new Date(timer_date); // Arrange values in Date Time Format
          //  var end = new Date(timer_year,timer_month,timer_day,timer_hour,timer_min,0,0)
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
                    clearInterval(timer{{$product->id}});
                    document.getElementById("timer_value-{{$product->id}}").innerHTML = 'បានបញ្ចប់';
                    //$('#myModal-{{$product->id}}').hide();
                    //  $('#myModal-{{$product->id}}').remove();
                    $('#myModal-{{$product->id}}').modal('hide');
                    document.getElementById("auction-submit-{{$product->id}}").innerHTML = '<a  class="button circle" style="margin-bottom: 30px;cursor: default" href="javascript:void(0)"><b class="font-bg" style="color: #fff;cursor: default">ដេញថ្លៃ</b></a>';
                    document.getElementById("auction-submit-{{$product->id}}").disabled = true;
                    document.getElementById("submit-{{$product->id}}").disabled = true;

                    return;

                }
                var days = Math.floor(remain / day); /// Get Remaining Days
                var hours = Math.floor((remain % day) / hour); /// Get Remaining Hours
                var minutes = Math.floor((remain % hour) / minute); /// Get Remaining Min
                var seconds = Math.floor((remain % minute) / second); /// Get Remaining Sec

                document.getElementById("timer_value-{{$product->id}}").innerHTML = days + 'ថ្ងៃ ';
                document.getElementById("timer_value-{{$product->id}}").innerHTML += hours + 'ម៉ោង ';
                document.getElementById("timer_value-{{$product->id}}").innerHTML += minutes + 'នាទី ';
                document.getElementById("timer_value-{{$product->id}}").innerHTML += seconds + 'វិនាទី';
            }
            timer{{$product->id}} = setInterval(showtimer, 1000); // Display Timer In Every 1 Sec
        });


    </script>
@endsection