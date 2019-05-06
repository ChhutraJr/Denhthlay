@extends('admin.master')
@section('content')

    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">

            <h4 class="m-t-0 header-title">Categories</h4>

            <div class="col-md-12">
                <button class="btn btn-primary waves-effect waves-light pull-right btn-lg" data-toggle="modal" data-target="#con-close-modal"><span class="fa fa-plus-circle btn-add-new"></span> Add New</button>
                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <form class="" role="form" method="POST" id="form-add">
                                {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Add New Category</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Name <span class="req">*</span></label>
                                            <input type="text" class="form-control input-name" name="name" placeholder="Enter Name...">
                                            <span class="text-danger">
                                                   <strong id="name-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Slug <span class="req">*</span></label>
                                            <input type="text" class="form-control input-slug" name="slug" placeholder="Enter Slug...">
                                            <span class="text-danger">
                                                   <strong id="slug-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img class="img-rounded" id="pic" width="25px" /> <label class="control-label">Image <span class="req">*</span></label>
                                            <input type="file" class="filestyle input-icon" data-buttontext="Select file" name="image" id="image" data-buttonname="btn-default" onchange="readURL(this,25,25);">
                                            <span class="text-danger">
                                                   <strong id="icon-error"></strong>
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Order</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($cats as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img class="img img-rounded" src="{{url('storage/'.$item->image)}}" alt=""  height="35px"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->slug}}</td>
                    <td>
                        @if(!$loop->first)
                            <a href="{{url('system/categories/order/'.$item->id.'/'.$item->order.'/up')}}"><i class=" glyphicon glyphicon-chevron-up"></i></a>
                        @endif

                        @if(!$loop->last)
                            <a href="{{url('system/categories/order/'.$item->id.'/'.$item->order.'/down')}}"><i class="glyphicon glyphicon-chevron-down"></i></a>
                        @endif
                    </td>
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
                                <h4 class="modal-title">Update: <img src="{{url('storage/'.$item->image)}}" alt="" class="img-circle" width="25px"> {{$item->name}}</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Name <span class="req">*</span></label>
                                            <input type="text" class="form-control input-name-{{$item->id}}" value="{{$item->name}}" name="name" placeholder="Enter Name...">
                                            <span class="text-danger">
                                                   <strong id="name-error-{{$item->id}}"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Slug <span class="req">*</span></label>
                                            <input type="text" class="form-control input-slug-{{$item->id}}" value="{{$item->slug}}" name="slug" placeholder="Enter Slug...">
                                            <span class="text-danger">
                                                   <strong id="slug-error-{{$item->id}}"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <img class="img-rounded" id="pic-{{$item->id}}" width="25px" src="{{url('storage/'.$item->image)}}" /> <label class="control-label">Image <span class="req">*</span></label>
                                            <input type="file" class="filestyle input-icon-{{$item->id}}" data-buttontext="Select file" name="image" data-buttonname="btn-default" onchange="readURL{{$item->id}}(this,25,25);">
                                            <span class="text-danger">
                                                   <strong id="icon-error-{{$item->id}}"></strong>
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
                                    <h4 class="modal-title" id="myModalLabel">Delete: <img src="{{url('storage/'.$item->image)}}" alt="" class="img-circle" width="25px"> {{$item->name}}</h4>
                                </div>

                                <div class="modal-body">
                                    Continue ?
                                </div>

                                <div class="modal-footer">
                                    <form action="{{ url('/system/categories/delete') }}" method="POST">
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
                    function readURL{{$item->id}}(input,width,height) {

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#pic-{{$item->id}}').fadeIn();
                                $('#pic-{{$item->id}}')
                                    .attr('src', e.target.result)
                                    .width(width)
                                    .height(height)
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(function () {

                        //Change image when input file


                        //Update
                        $('#form-update-{{$item->id}}').submit(function (e) {
                            e.preventDefault();


                            has_errors('.input-name-{{$item->id}}', '#name-error-{{$item->id}}');
                            has_errors('.input-slug-{{$item->id}}', '#slug-error-{{$item->id}}');
                            has_errors('.input-icon-{{$item->id}}', '#icon-error-{{$item->id}}');

                            /* Create new varaible that store all values from form From User\*/
                            var form = new FormData($("#form-update-{{$item->id}}")[0]);
                            $.ajax({
                                /* location to go*/
                                url: "{{route('categories.update')}}",
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
                                        if (data.errors.name) {
                                            errors('#name-error-{{$item->id}}', data.errors.name[0], '.input-name-{{$item->id}}');
                                        }

                                        if (data.errors.slug) {
                                            errors('#slug-error-{{$item->id}}', data.errors.slug[0], '.input-slug-{{$item->id}}');
                                        }

                                        if (data.errors.image) {
                                            errors('#icon-error-{{$item->id}}', data.errors.image[0], '.input-icon-{{$item->id}}');
                                        }
                                    }

                                    /* Clear all the value when send is success*/
                                    if (data.verify == 'true') {

                                        window.location.href = '{{URL::to('/system/categories')}}';
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
        $('#pic').fadeOut();
        $('#datatable-responsive').DataTable();

        $('#form-add').submit(function (e) {
            e.preventDefault();

            has_errors('.input-name', '#name-error');
            has_errors('.input-slug', '#slug-error');
            has_errors('.input-icon', '#icon-error');

            /* Create new varaible that store all values from form From User\*/
            var form = new FormData($("#form-add")[0]);
            $.ajax({
                /* location to go*/
                url: "{{route('categories.create')}}",
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
                        if (data.errors.name) {
                            errors('#name-error', data.errors.name[0], '.input-name');
                        }

                        if (data.errors.slug) {
                            errors('#slug-error', data.errors.slug[0], '.input-slug');
                        }

                        if (data.errors.image) {
                            errors('#icon-error', data.errors.image[0], '.input-icon');
                        }
                    }

                    /* Clear all the value when send is success*/
                    if (data.verify == 'true') {
                        $("#form-add")[0].reset();

                        window.location.href = '{{URL::to('/system/categories')}}';
                    }
                },
                error: function (er) {
                }
            });
        });

    </script>
@endsection