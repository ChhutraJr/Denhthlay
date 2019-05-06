
<!-- /.CTA -->
<footer id="footer">
    <div class="container " style="padding-left: 90px;">
        <div class="col-sm-1 ">

        </div>
        <div class="col-sm-3 mid" style="border-right: 1px solid rgba(0,0,0,0.17)">
            <img src="{{url('storage/icons/denhthlay_logo4.jpg')}}" alt="#" class="img-responsive " width="200px">
            <ul class="list-unstyled mid" style="font-weight: bold">
                <li>
                    <a href="javascript:void(0)" >អំពីយើង</a>
                </li>
                <li>
                    <a href="javascript:void(0)">លក្ខខណ្ឌ</a>
                </li>
                <li>
                    <a href="javascript:void(0)">គោលការណ៏ភាពឯកជន</a>
                </li>
            </ul>
        </div>


        <div class="col-sm-4 mid" style="border-right: 1px solid rgba(0,0,0,0.17);padding-bottom: 33px;">
            <b class="font-bg">
                បណ្តាញសង្គម
            </b>
            <ul class="list-unstyled">
                <div id="social" >
                    <a class="facebookBtn smGlobalBtn" href="javascript:void(0)" ></a>
                    <a class="twitterBtn smGlobalBtn" href="javascript:void(0)" ></a>
                    <a class="linkedinBtn smGlobalBtn" href="javascript:void(0)" ></a>
                    <a class="googleplusBtn smGlobalBtn" href="javascript:void(0)" ></a>
                    <a class="pinterestBtn smGlobalBtn" href="javascript:void(0)" ></a>

                </div>
            </ul>
        </div>

        <div class="col-sm-3 mid">
            <b class="font-bg">
                ទំនាក់ទំនង
            </b>
            <ul class="list-unstyled">
                <li class="blk">
                    <b>០៩៦ ៥៥ ៨៩ ០៩៦</b>
                </li>
                <li class="blk">
                    <b>info@denhthlay.com</b>
                </li>

            </ul>
        </div>
        <div class="col-sm-1" >

        </div>
    </div>

</footer>
</div>
<!-- /animitsion -->
<!-- JS files -->
<script src="{{url('home/js/jquery.min.js')}}">
</script>
<script src="{{url('home/js/kupon.js')}}">
</script>
<script src="{{url('home/js/bootstrap.min.js')}}">
</script>
<script src="{{url('home/js/jquery.animsition.min.js')}}">
</script>
<script src="{{url('home/owl.carousel/owl.carousel.js')}}">
</script>
<script src="{{url('home/js/jquery.flexslider-min.js')}}">
</script>
<script src="{{url('home/js/plugins.js')}}"></script>
<script src="{{url('home/js/phone.js')}}"></script>
<script src="{{url('home/sweetalert2/sweetalert2.all.js')}}"></script>
<script type="text/javascript">
    var trigger = $('.language_selector');
    var list = $('.languages');

    trigger.click(function() {
        trigger.toggleClass('active');
        list.slideToggle(200);
    });

    // this is optional to close the list while the new page is loading
    list.click(function() {
        trigger.click();
    });

    $(function () {


    })

    function has_errors(input_name,label_error) {
        $(input_name).parent().removeClass('has-error');
        $(label_error).html( "" );
    }

    function errors(label_error,error_text,input_name) {
        $(input_name).parent().addClass('has-error');
        $(label_error).html(error_text);
    }
</script>


<script type="text/javascript">

    //Search Product
    $('#form-search').submit(function (e) {
        e.preventDefault();
        var search_pro=$('#s_search_header').val();


        $('.input-search').parent().removeClass('has-error');

        $.ajax({
            type:"POST",
            url:"{{route('search.search')}}",
            dataType: 'json',
            data:{
                'search':search_pro,
                '_token': "{{ csrf_token() }}"
            },
            success:function (data) {

                console.log(data);
                if (data.errors){

                    if(data.errors.search){
                        $('.input-search').parent().addClass('has-error');
                    }

                }

                if (data.verify=='true'){
                    window.location.href='/search/'+data.search;
                }

            }
        })


    });
</script>

</body>
</html>