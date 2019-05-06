@extends('admin.master')
@section('content')

    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">

            <h4 class="m-t-0 header-title">Users</h4>

            <div class="col-md-12">
                <button class="btn btn-primary waves-effect waves-light pull-right btn-lg" data-toggle="modal" data-target="#con-close-modal"><span class="fa fa-plus-circle btn-add-new"></span> Add New</button>
                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <form class="" role="form" method="POST" id="form-user">
                                {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Add New User</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Username <span class="req">*</span></label>
                                            <input type="text" class="form-control input-name" name="username" placeholder="Enter Username...">
                                            <span class="text-danger">
                                                   <strong id="name-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Email <span class="req">*</span></label>
                                            <input type="email" class="form-control input-email" name="email" placeholder="Enter Email...">
                                            <span class="text-danger">
                                                   <strong id="email-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Password <span class="req">*</span></label>
                                            <input type="password" class="form-control input-pass" name="password" placeholder="Enter Password...">
                                            <span class="text-danger">
                                                   <strong id="pass-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password <span class="req">*</span></label>
                                            <input type="password" class="form-control input-conf-pass" name="confirm_password" placeholder="Enter Confirm Password...">
                                            <span class="text-danger">
                                                   <strong id="conf-pass-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="{{url('storage/profile/avatar/user.png')}}" class="img-circle " id="pic" width="25px" /> <label class="control-label">Profile</label>
                                            <input type="file" class="filestyle input-profile" data-buttontext="Select file" name="profile" data-buttonname="btn-default" onchange="readURL(this,25,25);">
                                            <span class="text-danger">
                                                   <strong id="profile-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            </div>
                            </form>

                        </div>

                    </div>
                </div><!-- /.modal -->
            </div>

            </div>

            <table id="datatable-responsive"
                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Profile</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{url('storage/'.$item->profile)}}" alt="" class="img-circle" width="35px"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>

                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#edit-{{$item->id}}"><i class="glyphicon glyphicon-pencil btn-edit edit-cl"></i>Edit</a>
                        <!--<a href="{url('system/categories/sub/'.$item->id)}}"><i class="glyphicon glyphicon-th-large"></i></a>-->
                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#delete-{{$item->id}}"><i class="glyphicon glyphicon-trash btn-delete delete-cl"></i>Delete</a>

                    </td>

                </tr>

                <div class="modal fade modal-defualt" id="edit-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="" role="form" method="POST" id="form-update-{{$item->id}}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$item->id}}" name="update_id">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Update: <img src="{{url('storage/'.$item->profile)}}" alt="" class="img-circle" width="25px"> {{$item->name}}</h4>
                            </div>
                            <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Username <span class="req">*</span></label>
                                                <input type="text" class="form-control input-name-{{$item->id}}" name="username" value="{{$item->name}}" placeholder="Enter Username...">
                                                <span class="text-danger">
                                                   <strong id="name-error-{{$item->id}}"></strong>
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img src="{{url('storage/'.$item->profile)}}" class="img-circle " id="pic-{{$item->id}}" width="25px" /> <label class="control-label">Profile</label> <label class="control-label">Profile</label>
                                            <input type="file" class="filestyle input-profile-{{$item->id}}" data-buttontext="Select file" name="profile" data-buttonname="btn-default" onchange="readURL_{{$item->id}}(this,25,25);">
                                            <span class="text-danger">
                                                   <strong id="profile-error-{{$item->id}}"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Old Password</label>
                                                <input type="password" class="form-control input-old-pass-{{$item->id}}" name="old_password" placeholder="Enter Old Password...">
                                                <span class="text-danger">
                                                   <strong id="old-pass-error-{{$item->id}}"></strong>
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control input-new-pass-{{$item->id}}" name="new_password" placeholder="Enter New Password...">
                                                <span class="text-danger">
                                                       <strong id="new-pass-error-{{$item->id}}"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Confirm Password</label>
                                                <input type="password" class="form-control input-conf-pass-{{$item->id}}" name="confirm_password" placeholder="Enter Confirm Password...">
                                                <span class="text-danger">
                                                   <strong id="conf-pass-error-{{$item->id}}"></strong>
                                            </span>
                                            </div>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                    <!--Delete-->
                    <div class="modal fade modal-danger" id="delete-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Delete: <img src="{{url('storage/'.$item->profile)}}" alt="" class="img-circle" width="25px"> {{$item->name}}</h4>
                                </div>

                                <div class="modal-body">
                                    Continue ?
                                </div>

                                <div class="modal-footer">
                                    <form action="{{ url('/system/users/delete') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="delete_id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                <script type="text/javascript">
                    function readURL_{{$item->id}}(input,width,height) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#pic-{{$item->id}}')
                                    .attr('src', e.target.result)
                                    .width(width)
                                    .height(height)
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(function () {
                        //Update
                        $('#form-update-{{$item->id}}').submit(function (e) {
                            e.preventDefault();

                            has_errors('.input-name-{{$item->id}}', '#name-error-{{$item->id}}');
                            has_errors('.input-old-pass-{{$item->id}}', '#old-pass-error-{{$item->id}}');
                            has_errors('.input-new-pass-{{$item->id}}', '#new-pass-error-{{$item->id}}');
                            has_errors('.input-conf-pass-{{$item->id}}', '#conf-pass-error-{{$item->id}}');
                            has_errors('.input-profile-{{$item->id}}', '#profile-error-{{$item->id}}');

                            /* Create new varaible that store all values from form From User\*/
                            var form = new FormData($("#form-update-{{$item->id}}")[0]);
                            $.ajax({
                                /* location to go*/
                                url: "{{route('users.update')}}",
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
                                        if (data.errors.username) {
                                            errors('#name-error-{{$item->id}}', data.errors.username[0], '.input-name-{{$item->id}}');
                                        }

                                        if (data.errors.old_password) {
                                            errors('#old-pass-error-{{$item->id}}', data.errors.old_password[0], '.input-old-pass-{{$item->id}}');
                                        }

                                        if (data.errors.new_password) {
                                            errors('#new-pass-error-{{$item->id}}', data.errors.new_password[0], '.input-new-pass-{{$item->id}}');
                                        }

                                        if (data.errors.confirm_password) {
                                            errors('#conf-pass-error-{{$item->id}}', data.errors.confirm_password[0], '.input-conf-pass-{{$item->id}}');
                                        }

                                        if (data.errors.profile) {
                                            errors('#profile-error-{{$item->id}}', data.errors.profile[0], '.input-profile-{{$item->id}}');
                                        }
                                    }

                                    /* Clear all the value when send is success*/
                                    if (data.verify == 'true') {

                                        window.location.href = '{{URL::to('/system/users')}}';
                                    }

                                    if (data.wrong_pass == 'true') {
                                        // $("#form-user")[0].reset();
                                        errors('#old-pass-error-{{$item->id}}','The old password field is wrong.','.input-old-pass-{{$item->id}}');
                                    }


                                },
                                error: function (er) {
                                }
                            });
                        });

                    })
                </script>
                  @endforeach

                </tbody>
            </table>
        </div>

@endsection

@section('data')
    <script type="text/javascript">
        $('#datatable-responsive').DataTable();

        $('#form-user').submit(function (e) {
            e.preventDefault();

            has_errors('.input-name', '#name-error');
            has_errors('.input-email', '#email-error');
            has_errors('.input-pass', '#pass-error');
            has_errors('.input-conf-pass', '#conf-pass-error');
            has_errors('.input-profile', '#profile-error');

            /* Create new varaible that store all values from form From User\*/
            var form = new FormData($("#form-user")[0]);
            $.ajax({
                /* location to go*/
                url: "{{route('users.create')}}",
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
                        if (data.errors.username) {
                            errors('#name-error', data.errors.username[0], '.input-name');
                        }

                        if (data.errors.email) {
                            errors('#email-error', data.errors.email[0], '.input-email');
                        }

                        if (data.errors.password) {
                            errors('#pass-error', data.errors.password[0], '.input-pass');
                        }

                        if (data.errors.confirm_password) {
                            errors('#conf-pass-error', data.errors.confirm_password[0], '.input-conf-pass');
                        }

                        if (data.errors.profile) {
                            errors('#profile-error', data.errors.profile[0], '.input-profile');
                        }
                    }

                    /* Clear all the value when send is success*/
                    if (data.verify == 'true') {
                        $("#form-user")[0].reset();
                       // $("#select2").empty();
                       // $("#select2-1").empty();

                        var name = data.name;

                      //  Command: toastr["success"]("" + name + " have been added !");
                        window.location.href = '{{URL::to('/system/users')}}';
                    }
                },
                error: function (er) {
                }
            });
        });

    </script>
@endsection