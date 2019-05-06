<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{url('storage/icons/lv-furniture.png')}}">

        <!-- Bootstrap core CSS -->
        <link href="{{url('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="{{url('admin/assets/css/metisMenu.min.css')}}" rel="stylesheet">
        <!-- Icons CSS -->
        <link href="{{url('admin/assets/css/icons.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{url('admin/assets/css/style.css')}}" rel="stylesheet">

    </head>


    <body>

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="{{url('/system')}}" class="text-success">
                                            <span><img src="{{url('storage/icons/denhthlay_logo4.jpg')}}" alt="" height="140" ></span>
                                        </a>

                                    </h2>

                                    <span id="msg-not-verify"></span>

                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" role="form" id="formLogin"  method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control input-email" type="email" id="email" placeholder="Enter your email">
                                                <span class="text-danger">
                                                   <strong id="email-error"></strong>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">

                                                <label for="password">Password</label>
                                                <input class="form-control input-pass" type="password"  id="pass" placeholder="Enter your password">
                                                <span class="text-danger">
                                                   <strong id="pass-error"></strong>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">

                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{{url('admin/assets/js/jquery-2.1.4.min.js')}}"></script>
        <script src="{{url('admin/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{url('admin/assets/js/metisMenu.min.js')}}"></script>
        <script src="{{url('admin/assets/js/jquery.slimscroll.min.js')}}"></script>

        <!-- App Js -->
        <script src="{{url('admin/assets/js/jquery.app.js')}}"></script>

    </body>
</html>

<script type="text/javascript">
    $('#formLogin').submit(function (e) {
        e.preventDefault();
        /*   var  name= $('#name').val();
         var email=$('#email').val();
         var password=$('#password').val();
         var confirm_password=$('#confirm_password').val();
         var profile=$('#file2').val();
         //  console.log('hi');
         */
        /* លុបនូវអក្សរពី Error */
        has_errors('.input-email', '#email-error');
        has_errors('.input-pass', '#pass-error');

        $('#msg-not-verify').html("");

        var email=$('#email').val();
        var pass=$('#pass').val();
        /* Create new varaible that store all values from form From User\*/
        $.ajax({
            type: "POST",
            url: "{{route('login.login')}}",
            dataType: 'json',
            data: {
                'email':email,
                'password':pass,
                '_token': "{{ csrf_token() }}"
            },
            success: function(data){
                /* When controller is complete it send back value to data*/
                console.log(data);

                /* Display all the errors message*/
                if (data.errors){
                    if (data.errors.email) {
                        errors('#email-error', data.errors.email[0], '.input-email');
                    }

                    if (data.errors.password) {
                        errors('#pass-error', data.errors.password[0], '.input-pass');
                    }
                }

                /* Clear all the value when send is success*/
                if (data.verify=='true'){
                    $("#formLogin")[0].reset();

                    $('#msg-not-verify').html("<div class='alert alert-success'>Your account is ready. </div>");
                    window.location.href = '/system/products';
                }

                if (data.verify=='false'){
                    $('#msg-not-verify').html("<div class='alert alert-danger'>Your Email or Password is incorrect ! </div>");
                }
            },
            error: function(er){}
        });

    });

    function has_errors(input_name,label_error) {
        $(input_name).parent().removeClass('has-error');
        $(label_error).html( "" );
    }

    function errors(label_error,error_text,input_name) {
        $(input_name).parent().addClass('has-error');
        $(label_error).html(error_text);
    }
</script>
